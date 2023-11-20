<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Perangkingan extends BaseController
{
    public function index()
    {
        $module = 'Perangkingan';
        return view('admin.perangkingan.index', compact('module'));
    }

    // Fungsi untuk map atribut ke skor
    private function mapAttributeToScore($attribute)
    {
        $attributeMapping = [
            'Sangat Baik' => 5,
            'Baik' => 4,
            'Cukup' => 3,
            'Kurang' => 2,
            'Sangat Kurang' => 1,
        ];

        return $attributeMapping[$attribute] ?? ''; // Menggunakan null coalescing operator untuk default value
    }

    public function kalkulasiRangking()
    {
        // Ambil data alternatif dari database
        $alternatifs = Alternatif::all()->toArray();
        $alternatives = [];

        foreach ($alternatifs as $alternatif) {
            // Gunakan array_push untuk menambahkan data ke dalam array
            $alternatives[] = [
                'mobile' => $this->mapAttributeToScore($alternatif['mobile']),
                'web' => $this->mapAttributeToScore($alternatif['web']),
                'desain' => $this->mapAttributeToScore($alternatif['desain']),
                'jaringan' => $this->mapAttributeToScore($alternatif['jaringan']),
            ];
        }

        // Tentukan bobot kriteria dan jenis kriteria (benefit atau cost)
        $kriterias = Kriteria::all()->toArray();
        $weights = [];
        foreach ($kriterias as $kriteria) {
            $weights[$kriteria['nama_kriteria']] = ['weight' => $kriteria['bobot'], 'type' => strtolower($kriteria['atribut'])];
        }

        // Lakukan normalisasi kriteria
        $normalizedMatrix = $this->normalizeCriteria($alternatives, $weights);
        // Hitung matriks preferensi
        $preferenceMatrix = $this->calculatePreferenceMatrix($normalizedMatrix);
        // Hitung peringkat
        $ranking = $this->calculateRanking($preferenceMatrix);

        // Tampilkan hasil atau lakukan sesuai kebutuhan
        return $this->sendResponse($ranking, 'Get data success');
    }

    private function normalizeValue($rawValue, $criterion, $type)
    {
        $minValue = Alternatif::all()->toArray();
        $mobileValues = array_column($minValue, $criterion);

        // Mapping nilai ke angka
        $mapping = [
            "Sangat Baik" => 5,
            "Baik" => 4,
            "Cukup" => 3,
            "Kurang" => 2,
            "Sangat Kurang" => 1,
        ];

        // Mengonversi nilai-nilai menggunakan array_map
        $convertedData = array_map(function ($value) use ($mapping) {
            return $mapping[$value] ?? $value;
        }, $mobileValues);

        $min = min($convertedData);
        $max = max($convertedData);

        // Pastikan nilai min dan max sudah numerik sebelum dilakukan perhitungan
        if (is_numeric($rawValue) && is_numeric($min) && is_numeric($max) && $max - $min != 0) {
            if ($type === 'benefit') {
                return ($max - $rawValue) / ($max - $min);
            } elseif ($type === 'cost') {
                return ($rawValue - $min) / ($max - $min);
            }
        }

        return 0;
    }

    private function normalizeCriteria($alternatives, $weights)
    {
        $normalizedMatrix = [];

        foreach ($alternatives as $alternative) {
            $normalizedValues = [];

            foreach ($weights as $criterion => $criterionInfo) {
                if (isset($alternative[$criterion], $criterionInfo['weight'], $criterionInfo['type'])) {
                    $rawValue = $alternative[$criterion];
                    $normalizedValue = $this->normalizeValue($rawValue, $criterion, $criterionInfo['type']);
                    $normalizedValues[$criterion] = $normalizedValue * $criterionInfo['weight'];
                }
            }

            $normalizedMatrix[] = $normalizedValues;
        }

        return $normalizedMatrix;
    }

    private function calculatePreferenceMatrix($normalizedMatrix)
    {
        $preferenceMatrix = [];

        foreach ($normalizedMatrix as $row) {
            $preferences = [];

            foreach ($normalizedMatrix as $otherRow) {
                // Menggunakan fungsi bawaan PHP untuk menghitung perbedaan antara dua array
                $preference = array_sum(array_map(function ($value, $otherValue) {
                    return $otherValue - $value;
                }, $row, $otherRow));

                // Menambahkan validasi untuk menghindari pembagian oleh nol
                $preferences[] = $preference != 0 ? 1 / $preference : 0;
            }

            $preferenceMatrix[] = $preferences;
        }

        return $preferenceMatrix;
    }

    private function calculateRanking($preferenceMatrix)
    {
        $ranking = [];

        // Pindahkan pencarian alternatif di luar loop untuk efisiensi
        $alternatives = Alternatif::all();

        foreach ($preferenceMatrix as $index => $row) {
            $netFlow = array_sum($row);

            // Pastikan indeks valid
            if ($index < count($alternatives)) {
                $alternatif = $alternatives[$index];

                // Hitung nilai tertinggi dari setiap bidang
                $mobileScore = $this->mapAttributeToScore($alternatif->mobile);
                $webScore = $this->mapAttributeToScore($alternatif->web);
                $desainScore = $this->mapAttributeToScore($alternatif->desain);
                $jaringanScore = $this->mapAttributeToScore($alternatif->jaringan);

                $maxScore = max($mobileScore, $webScore, $desainScore, $jaringanScore);

                // Simpan nama bidang dengan nilai tertinggi
                $maxBidang = '';
                if ($maxScore === $mobileScore) {
                    $maxBidang = 'mobile';
                } elseif ($maxScore === $webScore) {
                    $maxBidang = 'web';
                } elseif ($maxScore === $desainScore) {
                    $maxBidang = 'desain';
                } elseif ($maxScore === $jaringanScore) {
                    $maxBidang = 'jaringan';
                }

                if ($alternatif) {
                    $ranking[] = (object)[
                        'alternatif' => $alternatif->nama_mahasiswa,
                        'maxBidang' => $maxBidang,
                        'rank' => $netFlow,
                        'ranking' => null, // Inisialisasi peringkat sementara
                    ];
                }
            }
        }

        // Urutkan berdasarkan nilai net flow secara menurun
        usort($ranking, function ($a, $b) {
            return $b->rank <=> $a->rank;
        });

        // Tentukan peringkat berdasarkan urutan setelah diurutkan
        $rankingCount = count($ranking);
        for ($i = 0; $i < $rankingCount; $i++) {
            $ranking[$i]->ranking = $i + 1;
        }

        return $ranking;
    }
}

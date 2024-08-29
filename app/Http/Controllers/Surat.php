<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use App\Models\Mahasiswa;
use App\Models\Surat as ModelsSurat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Barryvdh\Snappy\Facades\SnappyPdf;

class Surat extends BaseController
{
    public function index()
    {
        $module = 'Surat PPl';
        return view('admin.surat.index', compact('module'));
    }

    public function get()
    {
        $data = ModelsSurat::all();
        return $this->sendResponse($data, 'Get data success');
    }

    public function pdf()
    {
        $mailData = [
            'nomor' => 53453,
            'mitra' => "kominfo",
            'tanggal' => "12-02-00",
            'nama_mahasiswa' => "Wahyu",
            'nim' => 60900118037,
        ];
        return view('admin.surat.pdf', compact('mailData'));
    }

    public function store(Request $request, $params)
    {
        // Memisahkan tanggal berdasarkan kata kunci "to"
        $dateParts = explode(' to ', $request->tanggal);

        // Pastikan tanggal memiliki dua bagian (awal dan akhir)
        if (count($dateParts) !== 2) {
            return $this->sendError('Format tanggal tidak valid', 'Tanggal harus dipisahkan dengan kata kunci "to"', 400);
        }

        // $dateParts[0] akan berisi tanggal awal dan $dateParts[1] akan berisi tanggal akhir
        $startDateStr = trim($dateParts[0]);
        $endDateStr = trim($dateParts[1]);

        // Ubah string tanggal menjadi objek Carbon atau format tanggal yang sesuai
        $startDate = \Carbon\Carbon::parse($startDateStr);
        $endDate = \Carbon\Carbon::parse($endDateStr);

        // Hitung jumlah data mahasiswa
        $jumlahData = Mahasiswa::count();

        // Pisahkan UUID yang dipisahkan koma menjadi array
        $uuidArray = explode(',', $params);

        // Hapus spasi yang mungkin ada di sekitar UUID
        $uuidArray = array_map('trim', $uuidArray);

        // Ambil data mahasiswa berdasarkan UUID yang ada dalam array
        $dataMahasiswaList = Mahasiswa::whereIn('uuid', $uuidArray)->get();

        // Inisialisasi variabel untuk data mahasiswa terakhir
        $lastDataMahasiswa = [];

        foreach ($dataMahasiswaList as $item) {
            // Update data mahasiswa
            $item->uuid_dosen = $request->uuid_dosen;
            $item->save();

            // Simpan data mahasiswa terakhir untuk digunakan dalam pembuatan PDF dan pengiriman email
            $lastDataMahasiswa[] = $item;
        }

        if (empty($lastDataMahasiswa)) {
            return $this->sendError('Tidak ada data mahasiswa yang diperbarui', 'Pastikan UUID yang diberikan valid', 404);
        }

        $mailData = [
            'nomor' => $jumlahData,
            'mitra' => $request->mitra,
            'tanggal' => $startDateStr . ' s/d ' . $endDateStr,
            'data_mahasiswa' => $lastDataMahasiswa,
        ];

        // Generate PDF
        $html = view('admin.surat.pdf', compact('mailData'))->render();

        $pdfFileName = 'Surat PPl ' . time() . '.pdf';
        $pdfFilePath = 'pdf/' . $pdfFileName; // Direktori dalam direktori public

        SnappyPdf::loadHTML($html)->save(public_path($pdfFilePath));

        // Send Email with Attachment to each student
        foreach ($lastDataMahasiswa as $dataMahasiswa) {
            // Update data mahasiswa dengan path file PDF
            $dataMahasiswa->file_surat = $pdfFileName;
            $dataMahasiswa->save();

            // Send Email with Attachment
            Mail::to($dataMahasiswa->nim . '@uin-alauddin.ac.id')->send(new Email($mailData, $pdfFilePath));
        }

        return $this->sendResponse($lastDataMahasiswa, 'Added data success');
    }
}

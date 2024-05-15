<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Penetapan Lokasi PPL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 90%;
            margin-top: 15px;
            font-size: 15px;
        }

        .kop-surat {
            border-bottom: 3px solid #333;
            padding-bottom: 10px;
            margin-bottom: 15px;
            display: grid;
            align-items: center;
        }

        .logo {
            float: left;
            /* margin-right: 20px; */
            position: absolute;
        }

        .logo img {
            max-width: 100px;
            max-height: 90px;
        }

        .perusahaan-info {
            overflow: hidden;
            text-align: center;
            display: grid;
            gap: 3px;
            /* Untuk menangani float */
        }

        .perusahaan-info p {
            margin: 0;
        }

        .alamat {
            margin-top: 10px;
        }

        .content {
            display: flex;
            width: 100%;
        }

        .footer {
            float: right;
            margin-right: 50px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="kop-surat">
            <div class="logo">
                <img src="https://uin-alauddin.ac.id/themes//images/favicon.png" alt="Logo UIN">
                {{-- <img src="{{ asset('logo_uin.png') }}" alt="Logo UIN"> --}}
            </div>

            <div class="perusahaan-info">
                <div style="font-size: 16px;">KEMENTERIAN AGAMA</div>
                <div style="font-weight: bold; font-size: 15px;">UNIVERSITAS ISLAM NEGERI (UIN) ALAUDDIN MAKASSAR</div>
                <div style="font-weight: bolder; font-size: 18px;">FAKULTAS SAINS DAN TEKNOLOGI</div>
                <div style="font-weight: bold; font-size: 19px;">PROGRAM STUDI SISTEM INFORMASI</div>
                <div style="font-size: 10px">Kampus I: JL. Sultan Alauddin No. 63 Makassar Telp. (0411)868720 (Fax
                    864923)<br>
                    Kampus II: JL. H. M. Yasin Limpo No. 36 Romang Polong Gowa Telp. (0411)841879 (Fax
                    8221400)</div>
            </div>
        </div>

        <div class="content">
            <div style="width: 8%">Nomor <br> Perihal </div>
            <div style="width: 2%">: <br> :</div>
            <div style="width: 90%">
                @php
                    setlocale(LC_TIME, 'id_ID.utf8'); // Set locale ke bahasa Indonesia

                    $tanggalSekarang = strftime('%d %B %Y');
                @endphp
                <div style="display: flex; justify-content: space-between;">
                    <div>{{ $mailData['nomor'] }}</div>
                    <div>Gowa,
                        {{ $tanggalSekarang }}</div>
                </div>
                <div>Permohonan Penerbitan Surat Izin <br> Praktek pengalaman Lapangan (PPL)
                </div>
                <div style="margin-top: 30px;">Kepada Yth <br> <span style="font-weight: bold;">Dekan Fakultas Sains dan
                        Teknologi</span> <br> Di-
                    <br>Tempat
                </div>
                <div style="font-weight: bold; font-style: italic; margin-top: 30px">Assalamu
                    Alaikum Wr. Wb.</div>
                <div style="margin-top: 25px; margin-left: 10px">
                    <div style="margin-bottom: 30px">Sehubungan dengan pelaksanaan Praktek Pengalaman Lapangan (PPL)
                        bagi mahasiswa S1 Prodi Sistem
                        Informasi Fakultas Sains dan Teknologi UIN Alauddin Makassar tahun akademik
                        {{ date('Y') . '/' . date('Y', strtotime('+1 year')) }}, maka dengan ini kami mengajukan
                        permohonan
                        surat pengantar ke tempat PPL dengan rincian sebagai berikut:</div>
                    <div style="display: flex">
                        <div style="width: 20%">Instansi <br> Tgl. Masuk <br> Peserta</div>
                        <div style="width: 10px">: <br> :</div>
                        <div>{{ $mailData['mitra'] }} <br> {{ $mailData['tanggal'] }}</div>
                    </div>
                </div>
                <div style="margin-top: 10px">
                    <table style="width: 60%; border-collapse: collapse; border: 1px solid #000;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid #000; width: 35px">No.</th>
                                <th style="border: 1px solid #000;">NIM</th>
                                <th style="border: 1px solid #000;">Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border: 1px solid #000;">1.</td>
                                <td style="border: 1px solid #000;">{{ $mailData['nim'] }}</td>
                                <td style="border: 1px solid #000;">{{ $mailData['nama_mahasiswa'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="margin-top: 25px; margin-left: 10px">
                    <div style="margin-bottom: 30px">Demikian surat ulasan ini disampaikan, atas perhatian dan
                        kerjasamanya diucapkan terimah kasih.</div>
                </div>
            </div>

            <!-- ... Isi surat lainnya ... -->
        </div>

        <div class="footer">
            <p>
                Ketua Prodi Sistem Informasi
            </p>
            <br><br>
            <p style="text-align: center">
                Farida Yusuf
            </p>
        </div>
    </div>
</body>

</html>

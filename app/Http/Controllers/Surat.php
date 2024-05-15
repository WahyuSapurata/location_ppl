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

        // $dateParts[0] akan berisi tanggal awal dan $dateParts[1] akan berisi tanggal akhir
        $startDateStr = trim($dateParts[0]);
        $endDateStr = trim($dateParts[1]);

        $jumlahData = Mahasiswa::count();

        $dataMahasiswa = Mahasiswa::where('uuid', $params)->first();
        $dataMahasiswa->uuid_dosen = $request->uuid_dosen;
        $dataMahasiswa->save();

        $mailData = [
            'nomor' => $jumlahData,
            'mitra' => $request->mitra,
            'tanggal' => $startDateStr . ' s/d ' . $endDateStr,
            'nama_mahasiswa' => $dataMahasiswa->nama_mahasiswa,
            'nim' => $dataMahasiswa->nim,
        ];

        // Generate PDF
        $html = view('admin.surat.pdf', compact('mailData'))->render();

        $pdfFileName = 'Surat PPl ' . $dataMahasiswa->nama_mahasiswa . time() . '.pdf';

        $pdfFilePath = 'pdf/' . $pdfFileName; // Direktori dalam direktori public

        SnappyPdf::loadHTML($html)->save(public_path($pdfFilePath));

        $dataMahasiswa->file_surat = $pdfFileName;
        $dataMahasiswa->save();

        // Send Email with Attachment
        Mail::to($dataMahasiswa->nim . '@uin-alauddin.ac.id')->send(new Email($mailData, $pdfFilePath));

        return $this->sendResponse($dataMahasiswa, 'Added data success');
    }
}

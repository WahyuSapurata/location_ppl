<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use App\Models\Mahasiswa;
use App\Models\Surat as ModelsSurat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function store(Request $request)
    {
        // Memisahkan tanggal berdasarkan kata kunci "to"
        $dateParts = explode(' to ', $request->tanggal);

        // $dateParts[0] akan berisi tanggal awal dan $dateParts[1] akan berisi tanggal akhir
        $startDateStr = trim($dateParts[0]);
        $endDateStr = trim($dateParts[1]);

        $nim = Mahasiswa::where('nama_mahasiswa', $request->nama_mahasiswa)->first();
        $mailData = [
            'nomor' => $request->nomor,
            'mitra' => $request->mitra,
            'tanggal' => $startDateStr . ' s/d ' . $endDateStr,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'nim' => $nim->nim,
        ];

        // Generate PDF
        $pdf = PDF::loadView('admin.surat.pdf', compact('mailData'));
        $pdfPath = storage_path('app/surat_ppl.pdf');
        $pdf->save($pdfPath);

        // Save to database and send email
        $data = new ModelsSurat();
        $data->nama_mahasiswa = $request->nama_mahasiswa;
        $data->mitra = $request->mitra;
        $data->status = 'terkirim';
        $data->save();

        // Send Email with Attachment
        Mail::to($nim->nim . '@uin-alauddin.ac.id')->send(new Email($mailData, $pdfPath));

        return $this->sendResponse($data, 'Added data success');
    }
}

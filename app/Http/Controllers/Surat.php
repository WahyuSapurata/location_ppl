<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use App\Models\Mahasiswa;
use App\Models\Surat as ModelsSurat;
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

    public function store(Request $request)
    {
        // Memisahkan tanggal berdasarkan kata kunci "to"
        $dateParts = explode(' to ', $request->tanggal);

        // $dateParts[0] akan berisi tanggal awal dan $dateParts[1] akan berisi tanggal akhir
        $startDateStr = trim($dateParts[0]);
        $endDateStr = trim($dateParts[1]);

        $nim = Mahasiswa::where('nama_mahasiswa', $request->nama_mahasiswa)->first();
        $dataEmail = [
            'nomor' => $request->nomor,
            'mitra' => $request->mitra,
            'tanggal' => $startDateStr . 's/d' . $endDateStr,
            'nim' => $nim->nim,
        ];
        Mail::to($nim->nim . '@uin-alauddin.ac.id')->send(new Email($dataEmail));
        // Mail::to('wm337708@gmail.com')->send(new Email($dataEmail));

        $data = array();
        try {
            $data = new ModelsSurat();
            $data->nama_mahasiswa = $request->nama_mahasiswa;
            $data->mitra = $request->mitra;
            $data->status = 'terkirim';
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Added data success');
    }
}

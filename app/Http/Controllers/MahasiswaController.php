<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends BaseController
{
    public function index()
    {
        $module = 'Daftar Mahasiswa';
        return view('admin.mahasiswa.index', compact('module'));
    }

    public function get()
    {
        $data = Mahasiswa::all();
        return $this->sendResponse($data, 'Get data success');
    }

    public function store(StoreMahasiswaRequest $storeMahasiswaRequest)
    {
        $data = array();
        try {
            $data = new Mahasiswa();
            $data->nama_mahasiswa = $storeMahasiswaRequest->nama_mahasiswa;
            $data->nim = $storeMahasiswaRequest->nim;
            $data->angkatan = $storeMahasiswaRequest->angkatan;
            $data->minat = $storeMahasiswaRequest->minat;

            if ($storeMahasiswaRequest->hasFile('file')) {
                $file = $storeMahasiswaRequest->file('file');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('file', $fileName, 'public'); // Simpan file ke direktori 'public/images'
                $data->file = $fileName;
            }

            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Added data success');
    }

    public function show($params)
    {
        $data = array();
        try {
            $data = Mahasiswa::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(UpdateMahasiswaRequest $updateMahasiswaRequest, $params)
    {
        try {
            $data = Mahasiswa::where('uuid', $params)->first();
            $data->nama_mahasiswa = $updateMahasiswaRequest->nama_mahasiswa;
            $data->nim = $updateMahasiswaRequest->nim;
            $data->angkatan = $updateMahasiswaRequest->angkatan;
            $data->minat = $updateMahasiswaRequest->minat;

            if ($updateMahasiswaRequest->hasFile('file')) {
                // Hapus file yang lama sebelum menyimpan yang baru
                if ($data->file) {
                    Storage::disk('public')->delete('file/' . $data->file);
                }

                $file = $updateMahasiswaRequest->file('file');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('file', $fileName, 'public'); // Simpan file ke direktori 'public/file'
                $data->file = $fileName;
            }

            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }

        return $this->sendResponse($data, 'Update data success');
    }

    public function delete($params)
    {
        $data = array();
        try {
            $data = Mahasiswa::where('uuid', $params)->first();

            // Hapus file terkait sebelum menghapus data dari database
            if ($data->file) {
                Storage::disk('public')->delete('file/' . $data->file);
            }
            $data->delete();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Delete data success');
    }
}

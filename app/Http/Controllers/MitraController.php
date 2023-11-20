<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMitraRequest;
use App\Http\Requests\UpdateMitraRequest;
use App\Models\Mitra;
use Illuminate\Support\Facades\Storage;

class MitraController extends BaseController
{
    public function index()
    {
        $module = 'Daftar Mitra';
        return view('admin.mitra.index', compact('module'));
    }

    public function get()
    {
        $data = Mitra::all();
        return $this->sendResponse($data, 'Get data success');
    }

    public function store(StoreMitraRequest $storeMitraRequest)
    {
        $data = array();
        try {
            $data = new Mitra();
            $data->nama_perusahaan = $storeMitraRequest->nama_perusahaan;
            $data->bidang = $storeMitraRequest->bidang;

            if ($storeMitraRequest->hasFile('logo')) {
                $logo = $storeMitraRequest->file('logo');
                $logoName = time() . '.' . $logo->getClientOriginalExtension();
                $logo->storeAs('logo', $logoName, 'public'); // Simpan file ke direktori 'public/images'
                $data->logo = $logoName;
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
            $data = Mitra::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(UpdateMitraRequest $updateMitraRequest, $params)
    {
        try {
            $data = Mitra::where('uuid', $params)->first();
            $data->nama_perusahaan = $updateMitraRequest->nama_perusahaan;
            $data->bidang = $updateMitraRequest->bidang;

            if ($updateMitraRequest->hasFile('logo')) {
                // Hapus file yang lama sebelum menyimpan yang baru
                if ($data->logo) {
                    Storage::disk('public')->delete('logo/' . $data->logo);
                }

                $logo = $updateMitraRequest->file('logo');
                $logoName = time() . '.' . $logo->getClientOriginalExtension();
                $logo->storeAs('logo', $logoName, 'public'); // Simpan logo ke direktori 'public/logo'
                $data->logo = $logoName;
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
            $data = Mitra::where('uuid', $params)->first();

            // Hapus file terkait sebelum menghapus data dari database
            if ($data->file) {
                Storage::disk('public')->delete('logo/' . $data->logo);
            }
            $data->delete();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Delete data success');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlternatifRequest;
use App\Http\Requests\UpdateAlternatifRequest;
use App\Models\Alternatif;

class AlternatifController extends BaseController
{
    public function index()
    {
        $module = 'Alternatif';
        return view('admin.alternatif.index', compact('module'));
    }

    public function get()
    {
        $data = Alternatif::all();
        return $this->sendResponse($data, 'Get data success');
    }

    public function store(StoreAlternatifRequest $storeAlternatifRequest)
    {
        $data = array();
        try {
            $data = new Alternatif();

            $data->mobile = $storeAlternatifRequest->mobile;
            $data->web = $storeAlternatifRequest->web;
            $data->desain = $storeAlternatifRequest->desain;
            $data->jaringan = $storeAlternatifRequest->jaringan;
            $data->nama_mahasiswa = $storeAlternatifRequest->nama_mahasiswa;

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
            $data = Alternatif::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(StoreAlternatifRequest $storeAlternatifRequest, $params)
    {
        try {
            $data = Alternatif::where('uuid', $params)->first();
            $data->mobile = $storeAlternatifRequest->mobile;
            $data->web = $storeAlternatifRequest->web;
            $data->desain = $storeAlternatifRequest->desain;
            $data->jaringan = $storeAlternatifRequest->jaringan;
            $data->nama_mahasiswa = $storeAlternatifRequest->nama_mahasiswa;

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
            $data = Alternatif::where('uuid', $params)->first();
            $data->delete();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Delete data success');
    }
}

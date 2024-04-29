<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDosenRequest;
use App\Http\Requests\UpdateDosenRequest;
use App\Models\Dosen;

class DosenController extends BaseController
{
    public function index()
    {
        $module = 'Pembimbing';
        return view('admin.dosen.index', compact('module'));
    }

    public function get()
    {
        $data = Dosen::all();
        return $this->sendResponse($data, 'Get data success');
    }

    public function store(StoreDosenRequest $storeDosenRequest)
    {
        $data = array();
        try {
            $data = new Dosen();
            $data->nama_dosen = $storeDosenRequest->nama_dosen;
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
            $data = Dosen::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(StoreDosenRequest $storeDosenRequest, $params)
    {
        try {
            $data = Dosen::where('uuid', $params)->first();
            $data->nama_dosen = $storeDosenRequest->nama_dosen;
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
            $data = Dosen::where('uuid', $params)->first();
            $data->delete();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Delete data success');
    }
}

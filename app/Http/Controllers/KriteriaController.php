<?php

namespace App\Http\Controllers;

use App\Http\Requests\Kriteria as RequestsKriteria;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends BaseController
{
    public function index()
    {
        $module = 'Kriteria';
        return view('admin.kriteria.index', compact('module'));
    }

    public function get()
    {
        $data = Kriteria::all();
        return $this->sendResponse($data, 'Get data success');
    }

    public function store(RequestsKriteria $kriteria)
    {
        $data = array();
        try {
            $data = new Kriteria();
            $data->nama_kriteria = $kriteria->nama_kriteria;
            $data->atribut = $kriteria->atribut;
            $data->bobot = $kriteria->bobot;
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
            $data = Kriteria::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(RequestsKriteria $kriteria, $params)
    {
        $data = array();
        try {
            $data = Kriteria::where('uuid', $params)->first();
            $data->nama_kriteria = $kriteria->nama_kriteria;
            $data->atribut = $kriteria->atribut;
            $data->bobot = $kriteria->bobot;
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
            $data = Kriteria::where('uuid', $params)->delete();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Delete data success');
    }
}

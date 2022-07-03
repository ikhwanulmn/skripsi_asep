<?php

namespace App\Controllers;

use App\Models\KecamatanModel;
use App\Models\PrediksiModel;

class Maps extends BaseController
{
    public function index()
    {
        $kecamatan = new KecamatanModel();
        $data['kecamatan'] = $kecamatan->findAll();
        return view('maps/visualisasi', $data);
    }

    public function prediction_page()
    {
        $prediksi = new PrediksiModel();
        $prediksi->join('kecamatan', 'prediksi.name_kecamatan = kecamatan.name_kecamatan', 'inner');
        $prediksi->select('prediksi.*');
        $prediksi->select('kecamatan.*');

        $data['prediksi'] = $prediksi->findAll();
        return view('maps/prediksi', $data);
    }
}

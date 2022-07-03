<?php

namespace App\Controllers;

use App\Models\KecamatanModel;
use App\Models\PrediksiModel;

class Prediksi extends BaseController
{
    public function index()
    {
        $prediksi = new PrediksiModel();
        $prediksi->join('kecamatan', 'prediksi.name_kecamatan = kecamatan.name_kecamatan', 'inner');
        $prediksi->select('prediksi.*');
        $prediksi->select('kecamatan.*');

        $data['prediksi'] = $prediksi->findAll();
        return view('maps/prediksi', $data);
    }
    public function importCsvToDb()
    { 
        $input = $this->validate([
            'file' => 'uploaded[file]|max_size[file,2048]|ext_in[file,csv],'
        ]);
        if (!$input) {
            session()->setFlashdata('message', 'CSV file coud not be found.');
            session()->setFlashdata('alert-class', 'alert-danger');

            redirect()->to($_SERVER['HTTP_REFERER']);
        } else {
            if ($file = $this->request->getFile('file')) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('../public/csvfile', $newName);
                    $file = fopen("../public/csvfile/" . $newName, "r");
                    $i = 0;
                    $numberOfFields = 4;
                    $csvArr = array();

                    //Untuk perhitungan hasil SAR dan Nilai UN terbaru
                    $intercept = 67.6482;
                    $p = 0.14241;

                    while (($filedata = fgetcsv($file, 1000, ";")) !== FALSE) {
                        $num = count($filedata);
                        if ($i > 0 && $num == $numberOfFields) {
                            $csvArr[$i]['name_kecamatan'] = $filedata[0];
                            $csvArr[$i]['wy'] = floatval(str_replace(',', '.', trim($filedata[1])));
                            $csvArr[$i]['beta_1'] = floatval(str_replace(',', '.', trim($filedata[2])));
                            $csvArr[$i]['beta_2'] = floatval(str_replace(',', '.', trim($filedata[3])));
                            //Y = pWY + XB + Intercept
                            $csvArr[$i]['nilai_un_updated'] = ($p * $csvArr[$i]['wy']) + $csvArr[$i]['beta_1'] + $csvArr[$i]['beta_2'] + $intercept;
                        }
                        $i++;
                    }
                    fclose($file);

                    $count = 0;
                    foreach ($csvArr as $userdata) {
                        $prediksi = new PrediksiModel();
                        $findRecord = $prediksi->where('name_kecamatan', $userdata['name_kecamatan'])->countAllResults();
                        if ($findRecord == 0) {
                            if ($prediksi->insert($userdata)) {
                                $count++;
                            }
                        } else {
                            $db      = \Config\Database::connect();
                            $builder = $db->table('prediksi');
                            $builder->emptyTable('prediksi');

                            if ($prediksi->insert($userdata)) {
                                $count++;
                            }
                        }
                    }
                    session()->setFlashdata('message', $count . ' rows successfully added.');
                    session()->setFlashdata('alert-class', 'alert-success');
                } else {
                    session()->setFlashdata('message', 'CSV file coud not be imported.');
                    session()->setFlashdata('alert-class', 'alert-danger');
                }
            } else {
                session()->setFlashdata('message', 'CSV file coud not be imported.');
                session()->setFlashdata('alert-class', 'alert-danger');
            }
        }
        return redirect()->to($_SERVER['HTTP_REFERER']);
    }
}

<?php

namespace App\Controllers;

use App\Models\SekolahModel;
use Config\Services;

class Sekolah extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'List Sekolah'
        ];

        return view('sekolah', $data);
    }

    public function ajaxList()
    {
        $request = Services::request();
        $datatable = new SekolahModel($request);

        if ($request->getMethod(true) === 'POST') {
            $lists = $datatable->getDatatables();
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->name_sekolah;
                $row[] = $list->address;
                $row[] = $list->jml_guru;
                $row[] = $list->jml_ruang_kelas;
                $row[] = $list->jml_siswa;
                $row[] = $list->rmg;
                $row[] = $list->rmk;
                $row[] = $list->nilai_un;
                $data[] = $row;
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $datatable->countAll(),
                'recordsFiltered' => $datatable->countFiltered(),
                'data' => $data
            ];

            echo json_encode($output);
        }
    }

}
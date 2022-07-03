<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class PrediksiModel extends Model
{
    protected $table = 'prediksi';
    protected $allowedFields = [
        'name_kecamatan',
        'wy',
        'beta_1',
        'beta_2',
        'nilai_un_updated'
    ];
}

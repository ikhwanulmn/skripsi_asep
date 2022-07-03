<?php
namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;
 
class KecamatanModel extends Model {

    protected $table = 'kecamatan';
    protected $primaryKey = 'id_kecamatan';
    protected $allowedFields = [
        'name_kecamatan',
        'geoJSON'
    ];
}
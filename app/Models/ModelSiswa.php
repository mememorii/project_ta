<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSiswa extends Model
{
   public $builder;
    public $db;
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_siswa';
    protected $primaryKey       = 'nisn';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nisn', 'kelas','nama','nipd','jenis_kelamin', 'tempat_lahir','tanggal_lahir','nik','agama','alamat','rt','rw','kelurahan','rombel', 'status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation 
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function __construct()
    {
        parent::__construct();
        $this->db=  \Config\Database::connect();
    }
//untuk menampilkan list data siswa didik
    function get_all_data()
    {
        $builder = $this->builder();
        $query = $builder->select('*')
                         ->get()
                         ->getResultArray();
        
        return $query;
    }
//untuk menampilkan detail data siswa didik
    function get_didikBy_id($id)
    {
        $builder = $this->builder();
        $allData = $builder->select('*')->where('nisn',$id)->get()->getRow();
        return $allData;
    }

    public function getByKelas()
    {
        $query = $this->select('kelas, COUNT(*) as total')
                      ->groupBy('kelas')
                      ->get()
                      ->getResultArray();

        $jumlahSiswa = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
        ];

        foreach ($query as $row) {
            $jumlahSiswa[$row['kelas']] = $row['total'];
        }

        return $jumlahSiswa;
    }

    public function totalSiswa()
    {
        return $this->where('status', 'aktif')->countAllResults();
    }

    public function getKelasByIdReferensi($idReferensi)
    {
        return $this->asArray()
                    ->select('kelas')
                    ->where(['id' => $idReferensi])
                    ->first();
    }
  
}

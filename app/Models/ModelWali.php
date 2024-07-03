<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelwali extends Model
{
   public $builder;
    public $db;
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_wali';
    protected $primaryKey       = 'id_wali';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_wali', 'id_siswa','jk','nik','nama','pekerjaan', 'pendidikan', 'kelas_siswa', 'rombel_siswa'];

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
//untuk menampilkan list data wali
    function get_all_data()
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_wali tw')
        ->select('tw.*, ts.nama as nama_siswa')
        ->join('tbl_siswa ts', 'ts.id_siswa = tw.id_siswa')
        ->get()
        ->getResultArray();

        return $query;
        //menampilkan query join tabel antara tabel peserta didik dengan table wali
        
    }

    function get_waliBy_id($id)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_wali tw')
        ->select('tw.*, ts.nama as nama_siswa')
        ->join('tbl_siswa ts', 'ts.id_siswa = tw.id_siswa')
        ->where('tw.id_wali', $id)
        ->get()
        ->getRowArray();

        return $query;
        //menampilkan query join tabel antara tabel peserta didik dengan table wali
        
    }

    public function totalWali()
    {
        $builder = $this->builder();
        $allData = $builder->select('*')->countAllResults();
        return $allData;
    }
}

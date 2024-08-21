<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelwali extends Model
{
   public $builder;
    public $db;
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_wali';
    protected $primaryKey       = 'nik';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nik', 'nisn_siswa','jenis_kelamin','nama','pekerjaan', 'pendidikan', 'alamat', 'kelas_siswa', 'rombel_siswa'];

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
        ->join('tbl_siswa ts', 'ts.nisn = tw.nisn_siswa')
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
        ->join('tbl_siswa ts', 'ts.nisn = tw.nisn_siswa')
        ->where('tw.nik', $id)
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

    function editCek($idCek)
    {
        $builder = $this->builder();
        $query = $builder->select('*')
        ->where('nik', $idCek)
        ->get()
        ->getRowArray();

        return $query;
        
    }
    
    public function getNotActive($nik)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_wali tw')
                ->select('tw.*, ts.status as status')
                ->join('tbl_siswa ts', 'ts.nisn = tw.nisn_siswa')
                ->where('tw.nik', $nik)
                ->where('ts.status', 'Tidak Aktif')
                ->get()
                ->getRowArray();
        
        return $query;
        
    }
}

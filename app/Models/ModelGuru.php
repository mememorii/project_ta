<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelGuru extends Model
{
   public $builder;
    public $db;
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_guru';
    protected $primaryKey       = 'nip';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nip', 'nik','jabatan','nama','jenis_kelamin','pendidikan','pangkat','agama', 'guru_kelas', 'rombel'];

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
//untuk menampilkan list data guru
    function get_all_data()
    {
        $builder = $this->builder();
        $allData = $builder->select('*')
                    ->get()
                    ->getResultArray();
                    
        return $allData;
    }
//untuk menampilkan detail data guru
    function get_guruBy_id($id)
    {
        $builder = $this->builder();
        $allData = $builder->select('*')
        ->where('nip',$id)
        ->get()
        ->getRowArray();
        return $allData;
    }

    public function totalGuru()
    {
        $builder = $this->builder();
        $allData = $builder->select('*')->countAllResults();
        return $allData;
    }
}

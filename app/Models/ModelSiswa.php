<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSiswa extends Model
{
   public $builder;
    public $db;
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_siswa';
    protected $primaryKey       = 'id_siswa';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_siswa','kelas','nama','nipd','jk','nisn','tempat_lahir','tanggal_lahir','nik','agama','alamat','rt','rw','kelurahan','rombel', 'status'];

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
        $allData = $builder->select('*')->where('id_siswa',$id)->get()->getRow();
        return $allData;
    }
    public function getData($year){
        return $this->db->table('tbl_siswa')->where('tanggal_lahir',$year)->get()->getResult();
    }

    public function getByKelas()
    {
        $query = $this->select('kelas, COUNT(*) as total')
                      ->groupBy('kelas')
                      ->get()
                      ->getResultArray();

        $jumlahSiswa = [
            'Satu' => 0,
            'Dua' => 0,
            'Tiga' => 0,
            'Empat' => 0,
            'Lima' => 0,
            'Enam' => 0,
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

<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKomentar extends Model
{
   public $builder;
    public $db;
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_komentar';
    protected $primaryKey       = 'id_komentar';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_komentar','id_crm','notes','timestamp','user_comment'];

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
//untuk menampilkan list data peserta didik
    function get_all_data()
    {
        $builder = $this->builder();
        $allData = $builder->select('*')->get()->getResult();
        return $allData;
    }
//untuk menampilkan detail data peserta didik
    function get_komentarBy_id($id)
    {
        $builder = $this->builder();
        $allData = $builder->select('*')->where('id_komentar',$id)->get()->getRow();
        return $allData;
    }

    function getDataTimeline($id_crm){
        $builder = $this->builder();
        $allData = $builder->select('*')->where('id_crm', $id_crm)->get()->getResult();
        $data = [];
        foreach($allData as $row => $value){
            $data[substr($value->timestamp,0,10)][] = $value;
        }
        return $data;
    }
}

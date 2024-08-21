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
    protected $allowedFields    = ['id_komentar','id_feedback','notes','timestamp','user_comment', 'read'];

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

    function getDataTimeline($id_feedback)
    {
        $builder = $this->builder();
        $allData = $this->db->table('tbl_komentar tk')
        ->select('tk.* , COALESCE(ts.nama, tw.nama, tg.nama) as namaKomentar')
        ->join('tbl_guru tg', 'tg.nip = tk.user_comment', 'left')
        ->join('tbl_siswa ts', 'ts.nisn = tk.user_comment', 'left')
        ->join('tbl_wali tw', 'tw.nik = tk.user_comment', 'left')
        ->where('id_feedback', $id_feedback)
        ->get()
        ->getResult();
        $data = [];
        foreach($allData as $row => $value){
            $data[substr($value->timestamp,0,10)][] = $value;
        }
        return $data;
    }

    function readKomentarUser($crm, $id_referensi)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_komentar tk')
        ->select('tk.*')
        ->join('tbl_feedback tc', 'tc.id_feedback = tk.id_feedback', 'left')
        ->where('tk.id_feedback', $crm)
        ->where('tk.user_comment', $id_referensi)
        ->get()
        ->getResultArray();

        return $query;
    }

    function readKomentarGuru($crm, $id_responden)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_komentar tk')
        ->join('tbl_feedback tc', 'tc.id_feedback = tk.id_feedback', 'left')
        ->where('tk.id_feedback', $crm)
        ->where('tk.user_comment', $id_responden)
        ->get()
        ->getResultArray();

        return $query;
    }

    public function newKomentarUser()
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_komentar tk')
                ->join('tbl_feedback tc', 'tc.id_feedback = tk.id_feedback', 'left')
                ->where('tk.read', 0)
                ->countAllResults();

                return $query;
    }

    public function newKomentarGuru($id_feedback, $id_responden)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_komentar tk')
                ->where('id_feedback', $id_feedback)
                ->where('id_feedback', $id_responden)
                ->where('read', 0)
                ->countAllResults();

                return $query;
    }
}

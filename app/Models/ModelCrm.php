<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelCrm extends Model
{
   public $builder;
    public $db;
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_crm';
    protected $primaryKey       = 'id_crm';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_crm', 'id_referensi', 'tanggal','judul','deskripsi','status','closed_at', 'rating'];

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

    function get_all_data()
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_crm tc')
                ->select('tc.*, COALESCE(ts.nama, tw.nama) as nama, COALESCE(ts.kelas, tw.kelas_siswa) as kelas_siswa')
                ->join('tbl_siswa ts', 'ts.id_siswa = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.id_wali = tc.id_referensi', 'left')
                ->get()
                ->getResultArray();

        return $query;
    }

    public function count_tickets()
    {
        $builder = $this->builder();
        $ticketCount = $builder->select('*')->countAllResults();
        return $ticketCount;
    }

    public function count_ticketsByKelas($kelas)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_crm tc')
                ->select('tc.*, COALESCE(ts.kelas, tw.kelas_siswa) as kelas')
                ->join('tbl_siswa ts', 'ts.id_siswa = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.id_wali = tc.id_referensi', 'left')
                ->where('kelas', $kelas)
                ->countAllResults();

        return $query;
    }

    public function count_openTicketsByKelas($kelas)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_crm tc')
                ->select('tc.*, COALESCE(ts.kelas, tw.kelas_siswa) as kelas')
                ->join('tbl_siswa ts', 'ts.id_siswa = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.id_wali = tc.id_referensi', 'left')
                ->where('kelas', $kelas)
                ->where('tc.status', 'open')
                ->countAllResults();

        return $query;
    }

    public function count_closedTicketsByKelas($kelas)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_crm tc')
                ->select('tc.*, COALESCE(ts.kelas, tw.kelas_siswa) as kelas')
                ->join('tbl_siswa ts', 'ts.id_siswa = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.id_wali = tc.id_referensi', 'left')
                ->where('kelas', $kelas)
                ->where('tc.status', 'closed')
                ->countAllResults();

        return $query;
    }

    // function autoCode()
    // {
    //     $builder = $this->table('tbl_crm');
    //     $builder->selectMax('kode_crm', 'kodeMax');
    //     $query = $builder->get()->getResult();
    //     $kd = '';
    //     if ($query > 0){
    //         foreach ($query as $key){
    //             $ambilKode = substr($key->kodeMax, -4);
    //             $counter = (intval($ambilKode)) + 1;
    //             $kd = sprintf('%04s', $counter);
    //         }
    //     }else{
    //         $kd = '0001';
    //     }
    //     return 'CRM'.$kd;
    // }

    public function closeTicket($id)
    {
        return $this->update($id, [
            'status' => 'closed',
            'closed_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function getStatusCounts()
    {
        $query = $this->select('status, COUNT(*) as total')
                      ->groupBy('status')
                      ->get()
                      ->getResultArray();

        $statusCounts = [
            'open' => 0,
            'closed' => 0
        ];

        foreach ($query as $row) {
            $statusCounts[$row['status']] = $row['total'];
        }

        return $statusCounts;
    }

    public function getOpenTicket($id_referensi)
    {
        return $this->where('id_referensi', $id_referensi)
                    ->where('status', 'open')
                    ->countAllResults();
    }
    
    public function getClosedTicket($id_referensi)
    {
        return $this->where('id_referensi', $id_referensi)
                    ->where('status', 'closed')
                    ->countAllResults();
    }

    public function getTicketsCreatedToday()
    {
        return $this->where('DATE(tanggal)', date('Y-m-d'))->countAllResults();
    }

    public function updateRating($id, $rating)
    {
        $this->where('id_crm', $id)
             ->set('rating', $rating)
             ->update();
    }
    
    function getDataByStatus($status)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_crm tc')
                ->select('tc.*, COALESCE(ts.nama, tw.nama) as nama, ts.kelas as kelas_siswa')
                ->join('tbl_siswa ts', 'ts.id_siswa = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.id_wali = tc.id_referensi', 'left')
                ->where('tc.status', $status)
                ->get()
                ->getResultArray();
        
        return $query;
        
    }

    function get_crmBy_id($id)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_crm tc')
        ->select('tc.*, COALESCE(ts.nama, tw.nama) as nama, tu.role as role')
        ->join('tbl_siswa ts', 'ts.id_siswa = tc.id_referensi', 'left')
        ->join('tbl_wali tw', 'tw.id_wali = tc.id_referensi', 'left')
        ->join('tbl_users tu', 'tu.id_referensi = tc.id_referensi', 'left')
        ->where('tc.id_crm', $id)
        ->get()
        ->getRowArray();

        return $query;
    }
   
}

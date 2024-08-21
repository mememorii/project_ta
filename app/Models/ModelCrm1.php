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
    protected $allowedFields    = ['id_crm', 'id_referensi', 'tanggal','judul','deskripsi','status','closed_at', 'rating', 'responden'];

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

    function get_all_data($kelas, $rombel)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_crm tc')
                ->select('tc.*, COALESCE(ts.nama, tw.nama) as nama')
                ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                ->where('COALESCE(ts.kelas, tw.kelas_siswa)', $kelas)
                ->where('COALESCE(ts.rombel, tw.rombel_siswa)', $rombel)
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

    public function count_ticketsByKelas($kelas, $rombel)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_crm tc')
                ->select('tc.*')
                ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                ->where('COALESCE(ts.kelas, tw.kelas_siswa)', $kelas)
                ->where('COALESCE(ts.rombel, tw.rombel_siswa)', $rombel)
                ->countAllResults();

        return $query;
    }

    public function count_openTicketsByKelas($kelas, $rombel)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_crm tc')
                ->select('tc.*')
                ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                ->where('COALESCE(ts.kelas, tw.kelas_siswa)', $kelas)
                ->where('COALESCE(ts.rombel, tw.rombel_siswa)', $rombel)
                ->where('tc.status', 'open')
                ->countAllResults();

        return $query;
    }

    public function count_closedTicketsByKelas($kelas, $rombel)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_crm tc')
                ->select('tc.*')
                ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                ->where('COALESCE(ts.kelas, tw.kelas_siswa)', $kelas)
                ->where('COALESCE(ts.rombel, tw.rombel_siswa)', $rombel)
                ->where('tc.status', 'closed')
                ->countAllResults();

        return $query;
    }

    public function closeTicket($id)
    {
        return $this->update($id, [
            'status' => 'closed',
            'closed_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function getStatusCounts($kelas, $rombel)
    {
        $query = $this->db->table('tbl_crm tc')
                ->select('tc.status, COUNT(*) as total')
                ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                ->where('COALESCE(ts.kelas, tw.kelas_siswa)', $kelas)
                ->where('COALESCE(ts.rombel, tw.rombel_siswa)', $rombel)
                ->groupBy('tc.status')
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

    public function getTicketsCreatedToday($kelas, $rombel)
    {
        $today = date('Y-m-d H:i:s');

        return $this->db->table('tbl_crm tc')
                        ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                        ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                        ->where('tanggal >=', $today) 
                        ->where('COALESCE(ts.kelas,tw.kelas_siswa)', $kelas)
                        ->where('COALESCE(ts.rombel, tw.rombel_siswa)', $rombel)
                        ->countAllResults();
    }

    public function updateRating($id, $rating)
    {
        $this->where('id_crm', $id)
             ->set('rating', $rating)
             ->update();
    }
    
    function getDataByStatus($status, $kelas, $rombel)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_crm tc')
                ->select('tc.*, COALESCE(ts.nama, tw.nama) as nama')
                ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                ->where('COALESCE(ts.kelas,tw.kelas_siswa)', $kelas)
                ->where('COALESCE(ts.rombel, tw.rombel_siswa)', $rombel)
                ->where('tc.status', $status)
                ->get()
                ->getResultArray();
        
        return $query;
        
    }

    function getUserCrm($id_referensi, $status)
    {
        $builder = $this->builder();
        $query = $builder->select('*')->where('id_referensi',$id_referensi)
                ->where('status', $status)
                ->get()
                ->getResultArray();
                
        return $query;
    }

    function get_crmBy_id($id)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_crm tc')
        ->select('tc.*, COALESCE(ts.nama, tw.nama) as nama, tg.nama as responder, tu.role as role')
        ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
        ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
        ->join('tbl_guru tg', 'tg.nip = tc.responden', 'left')
        ->join('tbl_users tu', 'tu.id_referensi = tc.id_referensi', 'left')
        ->where('tc.id_crm', $id)
        ->get()
        ->getRowArray();

        return $query;
    }
   
    public function countRatings($kelas, $rombel)
    {
        $query = $this->db->table('tbl_crm tc')
                    ->select('rating, COUNT(*) as total')
                    ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                    ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                    ->where('rating IS NOT NULL')
                    ->where('COALESCE(ts.kelas, tw.kelas_siswa)', $kelas)
                    ->where('COALESCE(ts.rombel, tw.rombel_siswa)', $rombel)
                    ->groupBy('rating')
                    ->get()
                    ->getResultArray();

        $ratings = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
        ];

        foreach ($query as $row) {
            $ratings[$row['rating']] = $row['total'];
        }

        return $ratings;
    }
}

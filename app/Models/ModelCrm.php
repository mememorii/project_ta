<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelCrm extends Model
{
   public $builder;
    public $db;
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_feedback';
    protected $primaryKey       = 'id_feedback';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_feedback', 'id_referensi', 'tanggal','judul','deskripsi','status','closed_at', 'rating', 'responden', 'resolusi', 'kategori'];

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
        $query = $this->db->table('tbl_feedback tc')
                ->select('tc.*, COALESCE(ts.nama, tw.nama) as nama, tg.nama as responder,  tu.role as role, COALESCE(ts.kelas, tw.kelas_siswa) as kelas')
                ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                ->join('tbl_guru tg', 'tg.nip = tc.responden', 'left')
                ->join('tbl_users tu', 'tu.id_referensi = tc.id_referensi', 'left')
                ->get()
                ->getResultArray();

        return $query;
    }

    function get_all_dataResponden($userAktif)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_feedback tc')
                ->select('tc.*, COALESCE(ts.nama, tw.nama) as nama, tg.nama as responder,  tu.role as role, COALESCE(ts.kelas, tw.kelas_siswa) as kelas,
                (SELECT COUNT(*) FROM tbl_komentar tk WHERE tk.id_feedback = tc.id_feedback AND tk.read = 0 AND user_comment = tc.id_referensi) AS unread_count')
                ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                ->join('tbl_guru tg', 'tg.nip = tc.responden', 'left')
                ->join('tbl_users tu', 'tu.id_referensi = tc.id_referensi', 'left')
                ->where('responden', $userAktif)
                ->get()
                ->getResultArray();

        return $query;
    }

    function get_all_dataUser($id_referensi)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_feedback tc')
                ->select('tc.*, COALESCE(ts.nama, tw.nama) as nama, tg.nama as responder, COALESCE(ts.kelas, tw.kelas_siswa) as kelas, (SELECT COUNT(*) FROM tbl_komentar tk WHERE tk.id_feedback = tc.id_feedback AND tk.read = 0 AND user_comment = tc.responden) AS unread_count')
                ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                ->join('tbl_guru tg', 'tg.nip = tc.responden', 'left')
                ->where('id_referensi', $id_referensi)
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

    public function count_ticketsByKelas()
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_feedback tc')
                ->select('tc.*')
                ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                ->countAllResults();

        return $query;
    }

    public function count_openTicketsByKelas()
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_feedback tc')
                ->select('tc.*')
                ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                ->where('tc.status', 'open')
                ->countAllResults();

        return $query;
    }

    public function countStatusProgress()
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_feedback tc')
                ->select('tc.*')
                ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                ->where('tc.status', 'progress')
                ->countAllResults();

        return $query;
    }

    public function count_closedTicketsByKelas()
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_feedback tc')
                ->select('tc.*')
                ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
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

    public function getStatusCounts()
    {
        $query = $this->db->table('tbl_feedback tc')
                ->select('tc.status, COUNT(*) as total')
                ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                ->groupBy('tc.status')
                ->get()
                ->getResultArray();
    
        $statusCounts = [
            'open' => 0,
            'closed' => 0,
            'progress' => 0
        ];
    
        foreach ($query as $row) {
            $statusCounts[$row['status']] = $row['total'];
        }
    
        return $statusCounts;
    }

    public function getKategoriCounts()
    {
        $query = $this->db->table('tbl_feedback tc')
                ->select('tc.kategori, COUNT(*) as total')
                ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                ->groupBy('tc.kategori')
                ->get()
                ->getResultArray();
    
        $kategoriCounts = [
            'Sarana Prasarana' => 0,
            'Akademik' => 0,
            'Administrasi' => 0,
            'Tenaga Pendidik' => 0,
            'Lainnya' => 0,
        ];
    
        foreach ($query as $row) {
            $kategoriCounts[$row['kategori']] = $row['total'];
        }
    
        return $kategoriCounts;
    }

    public function getKategoriCountsUser($id)
    {
        $query = $this->db->table('tbl_feedback tc')
                ->select('tc.kategori, COUNT(*) as total')
                ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                ->groupBy('tc.kategori')
                ->where('id_referensi', $id)
                ->get()
                ->getResultArray();
    
        $kategoriCounts = [
            'Sarana Prasarana' => 0,
            'Akademik' => 0,
            'Administrasi' => 0,
            'Tenaga Pendidik' => 0,
            'Lainnya' => 0,
        ];
    
        foreach ($query as $row) {
            $kategoriCounts[$row['kategori']] = $row['total'];
        }
    
        return $kategoriCounts;
    }

    public function getKategoriStatusCounts()
    {
        $query = $this->db->table('tbl_feedback tc')
            ->select('tc.kategori, tc.status, COUNT(*) as total')
            ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
            ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
            ->groupBy('tc.kategori, tc.status')
            ->get()
            ->getResultArray();

        $kategoriStatusCounts = [
            'Sarana Prasarana' => [
                'open' => 0,
                'progress' => 0,
                'closed' => 0,
            ],
            'Akademik' => [
                'open' => 0,
                'progress' => 0,
                'closed' => 0,
            ],
            'Administrasi' => [
                'open' => 0,
                'progress' => 0,
                'closed' => 0,
            ],
            'Tenaga Pendidik' => [
                'open' => 0,
                'progress' => 0,
                'closed' => 0,
            ],
            'Lainnya' => [
                'open' => 0,
                'progress' => 0,
                'closed' => 0,
            ],
        ];

        foreach ($query as $row) {
            $kategori = $row['kategori'];
            $status = $row['status'];
            $count = $row['total'];
            $kategoriStatusCounts[$kategori][$status] = $count;
        }

        return $kategoriStatusCounts;
    }

    public function getKategoriStatusCountsUser($id_referensi)
    {
        $query = $this->db->table('tbl_feedback tc')
            ->select('tc.kategori, tc.status, COUNT(*) as total')
            ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
            ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
            ->groupBy('tc.kategori, tc.status')
            ->where('id_referensi', $id_referensi)
            ->get()
            ->getResultArray();

        $kategoriStatusCounts = [
            'Sarana Prasarana' => [
                'open' => 0,
                'progress' => 0,
                'closed' => 0,
            ],
            'Akademik' => [
                'open' => 0,
                'progress' => 0,
                'closed' => 0,
            ],
            'Administrasi' => [
                'open' => 0,
                'progress' => 0,
                'closed' => 0,
            ],
            'Tenaga Pendidik' => [
                'open' => 0,
                'progress' => 0,
                'closed' => 0,
            ],
            'Lainnya' => [
                'open' => 0,
                'progress' => 0,
                'closed' => 0,
            ],
        ];

        foreach ($query as $row) {
            $kategori = $row['kategori'];
            $status = $row['status'];
            $count = $row['total'];
            $kategoriStatusCounts[$kategori][$status] = $count;
        }

        return $kategoriStatusCounts;
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

    public function getProgressTicket()
    {
        return $this->where('status', 'progress')
                    ->countAllResults();
                    
    }

    public function getProgressTicketUser($id_referensi)
    {
        return $this->where('id_referensi', $id_referensi)
                    ->where('status', 'progress')
                    ->countAllResults();
    }

    public function getUnrated($id_referensi)
    {
        return $this->where('id_referensi', $id_referensi)
                    ->where('status', 'closed')
                    ->groupStart()  
                    ->where('rating IS NULL', null, false)  
                    ->orWhere('rating', '')  
                    ->groupEnd() 
                    ->countAllResults();
    }

    public function getTicketsCreatedToday()
    {
        $today = date('Y-m-d');
    
        return $this->db->table('tbl_feedback tc')
                        ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                        ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                        ->where('DATE(tc.tanggal)', $today) 
                        ->countAllResults();
    }

    public function updateRating($id, $rating)
    {
        $this->where('id_feedback', $id)
             ->set('rating', $rating)
             ->update();
    }
    
    function getDataByStatus($status)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_feedback tc')
                ->select('tc.*, COALESCE(ts.nama, tw.nama) as nama, tg.nama as responder, tu.role as role, COALESCE(ts.kelas, tw.kelas_siswa) as kelas')
                ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                ->join('tbl_guru tg', 'tg.nip = tc.responden', 'left')
                ->join('tbl_users tu', 'tu.id_referensi = tc.id_referensi', 'left')
                ->where('tc.status', $status)
                ->get()
                ->getResultArray();
        
        return $query;
        
    }

    function getDataByStatusResponden($status, $userAktif)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_feedback tc')
                ->select('tc.*, COALESCE(ts.nama, tw.nama) as nama, tg.nama as responder, tu.role as role, COALESCE(ts.kelas, tw.kelas_siswa) as kelas')
                ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                ->join('tbl_guru tg', 'tg.nip = tc.responden', 'left')
                ->join('tbl_users tu', 'tu.id_referensi = tc.id_referensi', 'left')
                ->where('tc.status', $status)
                ->where('tc.responden', $userAktif)
                ->get()
                ->getResultArray();
        
        return $query;
        
    }

    function getDataByStatusUser($status, $id_referensi)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_feedback tc')
                ->select('tc.*, COALESCE(ts.nama, tw.nama) as nama, tg.nama as responder, COALESCE(ts.kelas, tw.kelas_siswa) as kelas')
                ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                ->join('tbl_guru tg', 'tg.nip = tc.responden', 'left')
                ->where('tc.status', $status)
                ->where('tc.id_referensi', $id_referensi)
                ->get()
                ->getResultArray();
        
        return $query;
        
    }

    function getDataByKategori($kategori)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_feedback tc')
                ->select('tc.*, COALESCE(ts.nama, tw.nama) as nama, tg.nama as responder, tu.role as role, COALESCE(ts.kelas, tw.kelas_siswa) as kelas')
                ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                ->join('tbl_guru tg', 'tg.nip = tc.responden', 'left')
                ->join('tbl_users tu', 'tu.id_referensi = tc.id_referensi', 'left')
                ->where('tc.kategori', $kategori)
                ->get()
                ->getResultArray();
        
        return $query;
        
    }

    function getDataByKategoriResponden($kategori, $userAktif)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_feedback tc')
                ->select('tc.*, COALESCE(ts.nama, tw.nama) as nama, tg.nama as responder, tu.role as role, COALESCE(ts.kelas, tw.kelas_siswa) as kelas')
                ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                ->join('tbl_guru tg', 'tg.nip = tc.responden', 'left')
                ->join('tbl_users tu', 'tu.id_referensi = tc.id_referensi', 'left')
                ->where('tc.kategori', $kategori)
                ->where('tc.responden', $userAktif)
                ->get()
                ->getResultArray();
        
        return $query;
        
    }

    function getDataByKategoriUser($kategori, $id_referensi)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_feedback tc')
                ->select('tc.*, COALESCE(ts.nama, tw.nama) as nama, tg.nama as responder, COALESCE(ts.kelas, tw.kelas_siswa) as kelas')
                ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                ->join('tbl_guru tg', 'tg.nip = tc.responden', 'left')
                ->where('tc.kategori', $kategori)
                ->where('tc.id_referensi', $id_referensi)
                ->get()
                ->getResultArray();
        
        return $query;
        
    }

    function getDataByStatusAndKategori($status, $kategori)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_feedback tc')
                    ->select('tc.*, COALESCE(ts.nama, tw.nama) as nama, tg.nama as responder, tu.role as role, COALESCE(ts.kelas, tw.kelas_siswa) as kelas')
                    ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                    ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                    ->join('tbl_guru tg', 'tg.nip = tc.responden', 'left')
                    ->join('tbl_users tu', 'tu.id_referensi = tc.id_referensi', 'left')
                    ->where('tc.status', $status)
                    ->where('tc.kategori', $kategori)
                    ->get()
                    ->getResultArray();

        return $query;
    }

    function getDataByStatusAndKategoriResponden($status, $kategori, $userAktif)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_feedback tc')
                    ->select('tc.*, COALESCE(ts.nama, tw.nama) as nama, tg.nama as responder, tu.role as role, COALESCE(ts.kelas, tw.kelas_siswa) as kelas')
                    ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                    ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                    ->join('tbl_guru tg', 'tg.nip = tc.responden', 'left')
                    ->join('tbl_users tu', 'tu.id_referensi = tc.id_referensi', 'left')
                    ->where('tc.status', $status)
                    ->where('tc.kategori', $kategori)
                    ->where('tc.responden', $userAktif)
                    ->get()
                    ->getResultArray();

        return $query;
    }

    function getDataByStatusAndKategoriUser($status, $kategori, $id_referensi)
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_feedback tc')
                    ->select('tc.*, COALESCE(ts.nama, tw.nama) as nama, tg.nama as responder, COALESCE(ts.kelas, tw.kelas_siswa) as kelas')
                    ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                    ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                    ->join('tbl_guru tg', 'tg.nip = tc.responden', 'left')
                    ->where('tc.status', $status)
                    ->where('tc.kategori', $kategori)
                    ->where('tc.id_referensi', $id_referensi)
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
        $query = $this->db->table('tbl_feedback tc')
        ->select('tc.*, COALESCE(ts.nama, tw.nama) as nama, tg.nama as responder, tu.role as role')
        ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
        ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
        ->join('tbl_guru tg', 'tg.nip = tc.responden', 'left')
        ->join('tbl_users tu', 'tu.id_referensi = tc.id_referensi', 'left')
        ->where('tc.id_feedback', $id)
        ->get()
        ->getRowArray();

        return $query;
    }
   
    public function countRatings()
    {
        $query = $this->db->table('tbl_feedback tc')
                    ->select('rating, COUNT(*) as total')
                    ->join('tbl_siswa ts', 'ts.nisn = tc.id_referensi', 'left')
                    ->join('tbl_wali tw', 'tw.nik = tc.id_referensi', 'left')
                    ->where('rating IS NOT NULL')
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

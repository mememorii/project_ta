<?php

namespace App\Controllers;
use App\Models\ModelWali;
use App\Models\ModelGuru;
use App\Models\ModelSiswa;
use App\Models\ModelCrm;
use App\Models\AuthModel;
use App\Models\ModelForgot;
use App\Models\ModelImage;
use App\Controllers\BaseController;
use Codeigniter\HTTP\RequestInterface;
use Config\services;

class DashboardController extends BaseController
{
    function __construct()
    { 
        $this->ModelGuru = new \App\Models\ModelGuru();
        $this->ModelWali = new \App\Models\ModelWali();
        $this->ModelSiswa = new \App\Models\ModelSiswa();
        $this->ModelCrm = new \App\Models\ModelCrm();
        $this->AuthModel = new \App\Models\AuthModel();
        $this->ModelForgot = new \App\Models\ModelForgot();
        $this->ModelImage = new \App\Models\ModelImage();
    }

    public function index()
    {
        
        $forgot = $this->ModelForgot
        ->where('id_referensi', session()->get('id_referensi'))
        ->first();

       if(!$forgot){
        return redirect()->to('saveForgot');
       }

        $kelas = session()->get('kelas');
        $rombel = session()->get('rombel');
        $statusCounts = $this->ModelCrm->getStatusCounts($kelas, $rombel);
        $jumlahSiswa = $this->ModelSiswa->getByKelas();
        $ratings = $this->ModelCrm->countRatings($kelas, $rombel);
        $createdAtDates = $this->AuthModel->getCreatedAtDates();
       
        $dates = [];
        foreach ($createdAtDates as $row) {
            $dates[] = $row['created_at'];
        }

        $data=[
            'title' => 'Dashboard',
            'menu'=> 'Dashboard',
            'totalGuru' => $this->ModelGuru->totalGuru(),
            'ticketsToday' => $this->ModelCrm->getTicketsCreatedToday($kelas, $rombel),
            'hitungSiswa' => $this->ModelSiswa->totalSiswa(),
            'tiketKelas' => $this->ModelCrm->count_ticketsByKelas($kelas, $rombel),
            'tiketKelasOpen' => $this->ModelCrm->count_openTicketsByKelas($kelas, $rombel),
            'tiketKelasClosed' => $this->ModelCrm->count_closedTicketsByKelas($kelas, $rombel),
            'totalWali' => $this->ModelWali->totalWali(),
            'totalUser' => $this->AuthModel->totalUser(),
            'openCount' => $statusCounts['open'],
            'closedCount' => $statusCounts['closed'],
            'kelas1' => $jumlahSiswa[1],
            'kelas2' => $jumlahSiswa[2],
            'kelas3' => $jumlahSiswa[3],
            'kelas4' => $jumlahSiswa[4],
            'kelas5' => $jumlahSiswa[5],
            'kelas6' => $jumlahSiswa[6],
            'ratings' => $ratings,
            'dates' => $dates,
        ];
        
        
        return view ('Dashboard/Dashboard',$data);
    }

    public function index_user()
    {
        $forgot = $this->ModelForgot
        ->where('id_referensi', session()->get('id_referensi'))
        ->first();

       if(!$forgot){
        return redirect()->to('saveForgot');
       }
        $id_referensi = session()->get('id_referensi');
        $id = session()->get('id_referensi');
        $data=[
            'title' => 'Home',
            'menu'=> 'Home',
            'crm' => $this->ModelCrm->get_crmBy_id($id),
            'ticket' => $this->ModelCrm->where('id_referensi', $id_referensi)->countAllResults(),
            'open' => $this->ModelCrm->getOpenTicket($id_referensi),
            'closed' => $this->ModelCrm->getClosedTicket($id_referensi),
        ];
        
        return view('Dashboard/DashboardUser', $data);
    }

    public function profileUpdate()
    {
        return redirect('user/dashboard');
    }

   
    
}
<?php

namespace App\Controllers;
use App\Models\ModelWali;
use App\Models\ModelGuru;
use App\Models\ModelSiswa;
use App\Models\ModelCrm;
use App\Models\AuthModel;
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
    }

    public function index()
    {
       
        // Get status counts
        $kelas = session()->get('kelas');
        $statusCounts = $this->ModelCrm->getStatusCounts();
        $jumlahSiswa = $this->ModelSiswa->getByKelas();
       
       
        // Pass data to view
        $data=[
            'title' => 'Dashboard',
            'menu'=> 'Dashboard',
            // 'totalTiket' => $this->ModelCrm->count_tickets(),
            'totalGuru' => $this->ModelGuru->totalGuru(),
            'ticketsToday' => $this->ModelCrm->getTicketsCreatedToday(),
            'hitungSiswa' => $this->ModelSiswa->totalSiswa(),
            'tiketKelas' => $this->ModelCrm->count_ticketsByKelas($kelas),
            'tiketKelasOpen' => $this->ModelCrm->count_openTicketsByKelas($kelas),
            'tiketKelasClosed' => $this->ModelCrm->count_closedTicketsByKelas($kelas),
            'totalWali' => $this->ModelWali->totalWali(),
            'totalUser' => $this->AuthModel->totalUser(),
            'openCount' => $statusCounts['open'],
            'closedCount' => $statusCounts['closed'],
            'kelas1' => $jumlahSiswa['Satu'],
            'kelas2' => $jumlahSiswa['Dua'],
            'kelas3' => $jumlahSiswa['Tiga'],
            'kelas4' => $jumlahSiswa['Empat'],
            'kelas5' => $jumlahSiswa['Lima'],
            'kelas6' => $jumlahSiswa['Enam'],
        ];
        
        return view ('Dashboard/Dashboard',$data);
    }

    public function index_user()
    {
        $id_referensi = session()->get('id_referensi');
        $data=[
            'title' => 'Home',
            'menu'=> 'Home',
            'crm' => $this->ModelCrm->get_all_data(),
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
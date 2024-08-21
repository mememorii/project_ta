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
        ->where('id_referensi', session()->get('id'))
        ->first();

       if(!$forgot){
        $setForgot = 'true';
       }else{
        $setForgot = 'false';
       }

        $kategoriStatusCounts = $this->ModelCrm->getKategoriStatusCounts();
        $statusCounts = $this->ModelCrm->getStatusCounts();
        $kategoriCounts = $this->ModelCrm->getkategoriCounts();
        $jumlahSiswa = $this->ModelSiswa->getByKelas();
        $ratings = $this->ModelCrm->countRatings();
        $createdAtDates = $this->AuthModel->getCreatedAtDates();
       
        $dates = [];
        foreach ($createdAtDates as $row) {
            $dates[] = $row['created_at'];
        }

        $data=[
            'title' => 'Dashboard',
            'menu'=> 'Dashboard',
            'totalGuru' => $this->ModelGuru->totalGuru(),
            'ticketsToday' => $this->ModelCrm->getTicketsCreatedToday(),
            'hitungSiswa' => $this->ModelSiswa->totalSiswa(),
            'tiketKelas' => $this->ModelCrm->count_ticketsByKelas(),
            'tiketKelasOpen' => $this->ModelCrm->count_openTicketsByKelas(),
            'tiketKelasClosed' => $this->ModelCrm->count_closedTicketsByKelas(),
            'tiketProgress' => $this->ModelCrm->countStatusProgress(),
            'totalWali' => $this->ModelWali->totalWali(),
            'totalUser' => $this->AuthModel->totalUser(),
            'openCount' => $statusCounts['open'],
            'progress' => $this->ModelCrm->getProgressTicket(),
            'closedCount' => $statusCounts['closed'],
            'progressCount' => $statusCounts['progress'],
            'saranaPrasarana' => $kategoriCounts['Sarana Prasarana'],
            'akademik' => $kategoriCounts['Akademik'],
            'administrasi' => $kategoriCounts['Administrasi'],
            'tenagaPendidik' => $kategoriCounts['Tenaga Pendidik'],
            'lainnya' => $kategoriCounts['Lainnya'],
            'kelas1' => $jumlahSiswa[1],
            'kelas2' => $jumlahSiswa[2],
            'kelas3' => $jumlahSiswa[3],
            'kelas4' => $jumlahSiswa[4],
            'kelas5' => $jumlahSiswa[5],
            'kelas6' => $jumlahSiswa[6],
            'ratings' => $ratings,
            'dates' => $dates,
            'showForgotPopup' => $setForgot,
            'kategoriStatusCounts' => $kategoriStatusCounts,
        ];
        
        
        return view ('Dashboard/Dashboard',$data);
    }

    public function index_user()
    {
        $forgot = $this->ModelForgot
        ->where('id_referensi', session()->get('id'))
        ->first();

       if(!$forgot){
        $setForgot = 'true';
       }else{
        $setForgot = 'false';
       }

        $id_referensi = session()->get('id_referensi');
        $kategoriStatusCountsUser = $this->ModelCrm->getKategoriStatusCountsUser($id_referensi);
        $kategoriCounts = $this->ModelCrm->getkategoriCountsUser($id_referensi);
        $data=[
            'title' => 'Home',
            'menu'=> 'Home',
            'crm' => $this->ModelCrm->get_crmBy_id($id_referensi),
            'ticket' => $this->ModelCrm->where('id_referensi', $id_referensi)->countAllResults(),
            'open' => $this->ModelCrm->getOpenTicket($id_referensi),
            'closed' => $this->ModelCrm->getClosedTicket($id_referensi),
            'progress' => $this->ModelCrm->getProgressTicketUser($id_referensi),
            'unrated' => $this->ModelCrm->getUnrated($id_referensi),
            'showForgotPopup' => $setForgot,
            'saranaPrasarana' => $kategoriCounts['Sarana Prasarana'],
            'akademik' => $kategoriCounts['Akademik'],
            'administrasi' => $kategoriCounts['Administrasi'],
            'tenagaPendidik' => $kategoriCounts['Tenaga Pendidik'],
            'lainnya' => $kategoriCounts['Lainnya'],
            'kategoriStatusCountsUser' => $kategoriStatusCountsUser,
        ];
        
        return view('Dashboard/DashboardUser', $data);
    }

    public function profileUpdate()
    {
        return redirect('user/dashboard');
    }

   
    
}
<?php

namespace App\Controllers;
use App\Models\ModelSiswa;
use App\Models\AuthModel;
use App\Controllers\BaseController;
use Codeigniter\HTTP\RequestInterface;
use Config\services;

class UserController extends BaseController
{
    function __construct()
    { 
        $this->ModelSiswa = new \App\Models\ModelSiswa();
        $this->AuthModel = new \App\Models\AuthModel();
    }

    // tampil dashboard user
  

    public function create ()
    {
        $data=[
            'title' => 'Tambah Data User',
            'menu'=> 'Data User',
          
            'getData' => $this-> ModelSiswa ->get_all_data()
        ];
        return view('User/create',$data);
    }

   
    
    public function history()
    {   
        $data=[
            'title' => 'History',
            'menu'=> 'History',
            'getData' => $this-> ModelUser ->get_all_data()
        ];
        return view ('User/History',$data);
        // echo "<pre>";
        // print_r($data);
    }

    public function profile()
    {   
        $data=[
            'title' => 'Profile',
            'menu'=> 'Profile',
            'getData' => $this-> ModelUser ->get_all_data()
        ];
        return view ('User/Profile',$data);
        // echo "<pre>";
        // print_r($data);
    }

    public function delete($id = null)
    {
        $model = new AuthModel();
        $model->delete($id);
        session()->setFlashdata("success","This is success message");
        return redirect()->to('user');
    }
}
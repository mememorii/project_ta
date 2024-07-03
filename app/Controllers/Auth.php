<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\ModelSiswa;
use App\Models\ModelGuru;
use App\Models\ModelWali;
use App\Models\ModelCrm;
use App\Models\ModelKomentar;
use DateTime;
use App\Libraries\AuthLibrary;

class Auth extends BaseController
{
	public function __construct()
	{
		$this->AuthModel =	new AuthModel();
		$this->ModelSiswa = new \App\Models\ModelSiswa();
		$this->ModelGuru = new \App\Models\ModelGuru();
		$this->ModelWali = new \App\Models\ModelWali();
		$this->ModelCrm = new \App\Models\ModelCrm();
		$this->ModelKomentar = new \App\Models\ModelKomentar();
		$this->Session = session();		
		$this->Auth = new AuthLibrary;
		$this->config = config('Auth');
	}

	public function index()
	{
		return redirect()->to('login');
	}


	public function login()
	{
		// IF ITS A POST REQUEST DO YOUR STUFF ELSE SHOW VIEW
		if ($this->request->getMethod() == 'post') {

			
			$rules = [
				'nik' => [
					'label' => 'NIK',
					'rules' =>'required|min_length[16]|max_length[16]',
					'errors' => [	
						'min_length' => 'Panjang {field} setidaknya {param} karakter.',
						'max_length' => 'Panjang {field} melebihi {param} karakter.',
						'required' => 'NIK tidak boleh kosong.',
					],
				],
				'password' => 'required|min_length[6]|max_length[255]|validateUser[nik,password]',
			];

			//validasi rules
			$errors = [
				'password' => [
					'min_length' => 'Panjang {field} setidaknya {param} karakter.',
					'max_length' => 'Panjang {field} melebihi {param} karakter.',
					'required' => 'Password tidak boleh kosong.',
					'validateUser' => 'Nik atau Password salah',
				]
			];

			if (!$this->validate($rules, $errors)) {

				$data['validation'] = $this->validator;

			} else {				
				$nik = $this->request->getVar('nik');
				$this->Auth->Loginuser($nik);
				return redirect()->to($this->Auth->autoRedirect());
			}
		}
		return view('login',['config' => $this->config]);
	}

	public function list()
    {   
        $data=[
            'title' => 'Data User Account',
            'menu'=> 'Data User Account',
            'getData' => $this-> AuthModel ->get_all_data(),
        ];
        return view ('User/User',$data);
    }

	public function detail ($id = null)
    {
        $data=[
            'title' => 'Detail Data User Account',
            'menu'=> 'Data User Account',
            'back'=>'',
        ];
        
        $data['account'] = $this->AuthModel->find($id);
		$data['referensi'] = $this->AuthModel->get_all_data();
        return view('User/detail',$data);
    }

	public function edit($id = null)
    {
        $data=[
            'title' => 'Edit Data Guru',
            'menu'=> 'Data Guru',
            'back'=>'',
        ];
        
        $data['user'] = $this->AuthModel->find($id);

        return view('User/edit', $data);
    }

	public function update()
	{
		$password = $this->request->getVar('password');
		$hash = password_hash($password, PASSWORD_ARGON2ID);
		
		$data=[
            'title' => 'Edit User Account',
            'menu'=> 'Edit User Account',
            'back' => '/dashboard',
			'password' => $hash,
        ];

		$rules = [
			'password' => 'required|min_length[6]|max_length[255]',
			'password_confirm' => 'matches[password]',
		];

		// VALIDATE RULES
		if (!$this->validate($rules)) {
			$data['validation'] = $this->validator;
		} else {

			$id = $this->request->getPost('id');
			$this->AuthModel->update($id,$data);
			session()->setFlashdata("success","Password Berhasil Diubah");
		}

		return redirect()->to('user');
	}

	public function account()
	{
		$data=[
            'title' => 'Edit Password',
            'menu'=> 'Edit Password',
            'back' => '/dashboard'
        ];
		// IF ITS A POST REQUEST DO YOUR STUFF ELSE SHOW VIEW
		if ($this->request->getMethod() == 'post') {

			// SET UP RULES
			$rules = [
				'password' => 'required|min_length[6]|max_length[255]',
				'password_confirm' => 'matches[password]',
			];

			// VALIDATE RULES
			if (!$this->validate($rules)) {
				$data['validation'] = $this->validator;
			} else {

				$user = [
					'id' => $this->Session->get('id'),
					'nama' => $this->request->getVar('nama'),
					'nik' => $this->request->getVar('nik'),
					'role'	=> $this->Session->get('role'),
					'id_referensi'	=> $this->Session->get('id_referensi'),
					'password' => $this->request->getVar('password'),
				];

				// PASS TO LIBRARY
				$this->Auth->editProfile($user);

				return redirect()->to($this->Auth->autoRedirect() . '/account');
			}
		}		
		return view('account', $data);
	}

	public function profile($id = null)
	{
		$data=[
            'title' => 'Profile',
            'menu'=> 'Profile',
            'back' => '/dashboard'
        ];

		if(session()->get('role') == 1 || session()->get('role') == 2){
			$data['profile'] = $this->ModelGuru->find($id);
		}elseif(session()->get('role') == 3){
			$data['profile'] = $this->ModelSiswa->find($id);
		}else{
			$data['profile'] = $this->ModelWali->get_waliBy_id($id);
		}
		return view('profile', $data);
	}

	public function logout()
	{
		$this->Auth->logout();

		return redirect()->to('/');
	}
}

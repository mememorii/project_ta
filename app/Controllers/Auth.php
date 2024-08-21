<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\ModelSiswa;
use App\Models\ModelGuru;
use App\Models\ModelWali;
use App\Models\ModelCrm;
use App\Models\ModelKomentar;
use App\Models\ModelForgot;
use DateTime;
use CodeIgniter\I18n\Time;
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
		$this->ModelForgot = new \App\Models\ModelForgot();
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
		if ($this->request->getMethod() == 'post') {
			
			$data = [
				'nik' => $this->request->getVar('nik'),
				'password' => $this->request->getVar('password')
			];

			$nik = $this->request->getVar('nik');

			$cek = $this->AuthModel
			->where('nik', $data['nik'])
			->first();

			if (!$cek|| !password_verify($data['password'], $cek['password'])) {
				session()->setFlashdata('error', 'NIK Atau Password Yang Anda Masukkan Salah.');
				return redirect('login');
			}elseif($cek['role'] == 3){
				$cekAktif = $this->ModelSiswa->where('nik', $data['nik'])->first();
				if($cekAktif['status'] == 'Tidak Aktif'){
					session()->setFlashdata('error', 'Akun anda sudah tidak aktif');
					return redirect()->to('login');
				}
			}elseif($cek['role'] == 4){
				$cekAktifWali = $this->ModelWali->getNotActive($nik);
				if($cekAktifWali){
					session()->setFlashdata('error', 'Akun anda sudah tidak aktif');
					return redirect()->to('login');
				}
			}

			$nik = $this->request->getVar('nik');
			$this->Auth->Loginuser($nik);
			return redirect()->to($this->Auth->autoRedirect());
			
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
            'back'=>'user',
        ];
        
        $data['account'] = $this->AuthModel->find($id);
		$data['referensi'] = $this->AuthModel->get_all_data();
        return view('User/detail',$data);
    }

	public function edit($id = null)
    {
        $data=[
            'title' => 'Edit Password',
            'menu'=> 'Data User Account',
            'back'=>'user',
        ];
        
        $data['user'] = $this->AuthModel->find($id);

        return view('User/edit', $data);
    }

	public function update()
	{
		$user = [
			'id_users' => $this->request->getVar('id'),
			'nama' => $this->request->getVar('nama'),
			'nik' => $this->request->getVar('nik'),
			'role'	=> $this->request->getVar('role'),
			'id_referensi'	=> $this->request->getVar('id_referensi'),
			'password' => $this->request->getVar('password'),
		];

		$this->Auth->editPassword($user);
		session()->setFlashdata("success","Password Berhasil Diubah");

		return redirect()->to('user');
		
		
	}

	public function account()
	{
		$back = session()->get('id_referensi');
		$data=[
            'title' => 'Edit Password',
            'menu'=> 'Edit Password',
            'back' => "user/profile/$back"
        ];
		if ($this->request->getMethod() == 'post') {

				$user = [
					'id_users' => $this->Session->get('id'),
					'nama' => $this->request->getVar('nama'),
					'nik' => $this->request->getVar('nik'),
					'email' => $this->Session->get('email'),
					'role'	=> $this->Session->get('role'),
					'id_referensi'	=> $this->Session->get('id_referensi'),
					'password' => $this->request->getVar('password'),
				];

				$this->Auth->editProfile($user);

				return redirect()->to('user/profile/' . $user['id_referensi']);
			
		}		
		return view('account', $data);
	}

	public function profile($id = null)
	{
		if(session()->get('role') == 1){
			$back = 'admin/dashboard';
		}elseif(session()->get('role') == 2){
			$back = 'guru/dashboard';
		}elseif(session()->get('role') == 3){
			$back = 'siswa/dashboard';
		}else{
			$back = 'wali/dashboard';
		}
		$data=[
            'title' => 'Profile',
            'menu'=> 'Profile',
            'back' => $back,
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

	public function transferHak($id)
	{
		$newAdmin = $id;
		$oldAdmin = $this->Session->get('id');
		$this->AuthModel->update($oldAdmin, ['role' => 2]); 
		$this->AuthModel->update($newAdmin, ['role' => 1]); 
		$this->Auth->logout();

		return redirect()->to('/');
	}

	public function saveForgot()
	{
		if ($this->request->getMethod() == 'post') {
			$data = [
				'pertanyaan_1' => $this->request->getPost('pertanyaanLain1'),
				'pertanyaan_2' => $this->request->getPost('pertanyaanLain2'),
				'pertanyaan_3' => $this->request->getPost('pertanyaanLain3'),
				'pertanyaan_4' => $this->request->getPost('pertanyaanLain4'),
				'pertanyaan_5' => $this->request->getPost('pertanyaanLain5'),
				'jawaban_1' => $this->request->getPost('jawaban_1'),
				'jawaban_2' => $this->request->getPost('jawaban_2'),
				'jawaban_3' => $this->request->getPost('jawaban_3'),
				'jawaban_4' => $this->request->getPost('jawaban_4'),
				'jawaban_5' => $this->request->getPost('jawaban_5'),
				'id_referensi' => session()->get('id_referensi')
			];
			
			$this->ModelForgot->insert($data);
			return redirect()->to($this->Auth->autoRedirect());
		}

		return view('saveForgot');
	}

	public function toForgot()
	{
		$data = [
			'title' => 'Identifikasi akun'
		];

		return view('toForgot', $data);
	}

	public function changeQuestion($id)
	{
		$id_users = session()->get('id');
		$id_referensi = session()->get('id_referensi');
		$data = [
			'title' => 'Edit Security Question',
			'menu' => '',
			'back' => 'user/profile/' . $id_referensi,
			'forgot' => $this->ModelForgot->where('id_referensi', $id)->get()->getRowArray(),
		];
		
		return view('changeQuestion', $data);
	}

	public function changeQuestionSave()
	{
		$id = $this->request->getPost('id_pertanyaan');
		$id_referensi = session()->get('id_referensi');
		$question = [
			'pertanyaan_1' => $this->request->getPost('pertanyaanLain1'),
			'pertanyaan_2' => $this->request->getPost('pertanyaanLain2'),
			'pertanyaan_3' => $this->request->getPost('pertanyaanLain3'),
			'pertanyaan_4' => $this->request->getPost('pertanyaanLain4'),
			'pertanyaan_5' => $this->request->getPost('pertanyaanLain5'),
			'jawaban_1' => $this->request->getPost('jawaban_1'),
			'jawaban_2' => $this->request->getPost('jawaban_2'),
			'jawaban_3' => $this->request->getPost('jawaban_3'),
			'jawaban_4' => $this->request->getPost('jawaban_4'),
			'jawaban_5' => $this->request->getPost('jawaban_5'),
		];

		$this->ModelForgot->where('id_pertanyaan', $id)->set($question)->update();
		session()->setFlashdata('success', 'Security question berhasil diedit.');
		return redirect()->to('user/profile/' . $id_referensi);
	}

	public function changeEmail()
	{
		$id_users = session()->get('id_referensi');
		$data = [
			'title' => 'Ganti Email',
			'menu' => 'Ganti Email',
			'email' => $this->AuthModel->where('id_referensi', $id_users)->get()->getRowArray(),
			'back' => 'user/profile/' . $id_users,
		];

		if ($this->request->getMethod() == 'post') {

			$email = $this->request->getPost('email');

			$this->AuthModel->where('id_referensi', $id_users)->set('email', $email)->update();
			session()->set('email', $email);
			session()->setFlashdata('success', 'Email Berhasil Diubah');
			return redirect()->to('user/profile/' . $id_users);
		}

		return view('changeEmail', $data);
	}

	public function securityQuestion()
	{
		// $role = $this->request->getPost('role');
		$nik = $this->request->getPost('nik');
		// $nip = $this->request->getPost('nip');
		// $nisn = $this->request->getPost('nisn');
		$id_referensi = $this->request->getPost('id_referensi');

		$forgot=[
			'forgot' => $this->ModelForgot->get_all_data($nik, $id_referensi),
			'nama' => $this->AuthModel->where('nik', $nik)->get()->getRowArray(),
			'title' => 'Security Question',
			'nik' => $nik,
			'id_referensi2' => $id_referensi,
		];

		if(!$forgot['forgot']){
			session()->setFlashdata('error', 'Nomor identifikasi yang anda masukkan tidak terdaftar.');
			return redirect()->to('toForgot');
		}else{
			return view('securityQuestion', $forgot);
		}

	}

	public function securityQuestionWali()
	{
		$nik = $this->request->getPost('id_referensi');
		$nisn = $this->request->getPost('nisn');
		$id_referensi = $this->request->getPost('id_referensi');

		$forgot=[
			'forgot' => $this->ModelForgot->get_all_dataWali($nisn, $id_referensi),
			'nama' => $this->AuthModel->where('nik', $id_referensi)->get()->getRowArray(),
			'title' => 'Security Question',
			'nik' => $nik,
			'id_referensi2' => $id_referensi,
		];

		if(!$forgot['forgot']){
			session()->setFlashdata('error', 'Nomor identifikasi yang anda masukkan tidak terdaftar.');
			return redirect()->to('toForgot');
		}else{
			return view('securityQuestion', $forgot);
		}

	}

	public function cekPertanyaan()
	{
		$data = [
			'jawaban_1' => $this->request->getPost('jawaban_1'),
			'jawaban_2' => $this->request->getPost('jawaban_2'),
			'jawaban_3' => $this->request->getPost('jawaban_3'),
			'jawaban_4' => $this->request->getPost('jawaban_4'),
			'jawaban_5' => $this->request->getPost('jawaban_5'),
			'id_referensi' => $this->request->getPost('id_referensi'),
			'id_referensi2' => $this->request->getPost('id_referensi2'),
			'nik' => $this->request->getPost('nik'),
		];
		
		$nik = $data['nik'];
		$role = $this->AuthModel->where('nik', $nik)->get()->getRowArray();
		$id_referensi = $data['id_referensi2'];
		$forgot=[
			'forgot' => $this->ModelForgot->get_all_data($nik, $id_referensi),
			'nama' => $this->AuthModel->where('nik', $nik)->get()->getRowArray(),
			'title' => 'Security Question',
			'nik' => $nik,
			'id_referensi2' => $id_referensi,
		];

		$idCek = $data['id_referensi'];
		$nikCek = $this->ModelForgot->getIdReferensi($idCek);

		if(
			$data['jawaban_1'] !== $nikCek['jawaban_1'] || 
			$data['jawaban_2'] !== $nikCek['jawaban_2'] || 
			$data['jawaban_3'] !== $nikCek['jawaban_3'] || 
			$data['jawaban_4'] !== $nikCek['jawaban_4'] || 
			$data['jawaban_5'] !== $nikCek['jawaban_5']
		)	{
				session()->setFlashdata("error","Jawaban Pertanyaan Salah");
				return view('securityQuestion', $forgot);
			}
			
		$id_users = $data['id_referensi'];
		return redirect()->to('viewResetPassword/' . $id_users);
	}

	public function viewResetPassword($id_users)
	{
		$data = [
			'user' => $this->AuthModel->find($id_users),
			'title' => 'Reset password'
		];

		// $getIdUser['user'] = $this->AuthModel->find($id_users);
		return view('resetPassword', $data);
	}

	public function resetPassword($id, $token)
	{
		  // DECODE THE TOKEN
        $decodedtoken = base64_decode($token);
		$id_users = $id;
        // GET USERS DETAILS FROM DB
        $user = $this->AuthModel->find($id);

        // FETCH THE EXPIRY TIME FOR TOKEN
        $resetexpiry = $user['reset_expire'];
        $timenow = new Time('now');

        // CHECK TO SEE IF TOKEN HAS EXPIRED
        if (!$timenow->isBefore($resetexpiry)) {

            // IT HAS SO SET SOME FLASH DATA     
            $this->Session->setFlashData('danger', lang('Kode Reset Password Sudah Kadaluwarsa'));

			return redirect()->to('login');
        }

        // CHECK TOKEN AGAINST TOKEN IN DB
        if (!password_verify($decodedtoken, $user['reset_token'])) {

            // DOES NOT MATCH SO SET SOME FLASH DATA          
            $this->Session->setFlashData('danger', lang('Kode Reset Password Salah'));
            

			return redirect()->to('login');
        } else {

            // RETURN USER ID TO USE ON PASSWORD RESET FORM
            $this->Session->setFlashData('success', lang('Auth.passwordAuthorised'));
			return redirect()->to('viewResetPassword/' . $id_users);
        }
	
	}

	public function logout()
	{
		$this->Auth->logout();

		return redirect()->to('/');
	}

	public function security()
	{
		$session = $this->Session->get('id_referensi');
		$id_users = session()->get('id');
		$user = [
			'id_users' => $this->Session->get('id'),
			'nama' => $this->request->getVar('nama'),
			'nik' => $this->request->getVar('nik'),
			'role'	=> $this->Session->get('role'),
			'id_referensi'	=> $session,
			'password' => $this->request->getVar('password'),
			'email' => $this->request->getVar('email'),
		];

		$data = [
			'pertanyaan_1' => $this->request->getPost('pertanyaanLain1'),
			'pertanyaan_2' => $this->request->getPost('pertanyaanLain2'),
			'pertanyaan_3' => $this->request->getPost('pertanyaanLain3'),
			'pertanyaan_4' => $this->request->getPost('pertanyaanLain4'),
			'pertanyaan_5' => $this->request->getPost('pertanyaanLain5'),
			'jawaban_1' => $this->request->getPost('jawaban_1'),
			'jawaban_2' => $this->request->getPost('jawaban_2'),
			'jawaban_3' => $this->request->getPost('jawaban_3'),
			'jawaban_4' => $this->request->getPost('jawaban_4'),
			'jawaban_5' => $this->request->getPost('jawaban_5'),
			'id_referensi' => $id_users
		];
		
		$getEmail = $this->request->getPost('email');

		if($getEmail){
			if(session()->get('role') == 3){
				$siswaEmail = $this->AuthModel->where('role', 3)->where('email', $user['email'])->countAllResults();

				if($siswaEmail){
					session()->setFlashdata('error', 'Email sudah digunakan');
					return redirect()->to($this->Auth->autoRedirect());
				}
			}
			
			if(session()->get('role') == 1 || session()->get('role') == 2 || session()->get('role') == 4){
				$email = $this->AuthModel->where('email', $user['email'])->countAllResults();

				if($email){
					session()->setFlashdata('error', 'Email sudah digunakan');
					return redirect()->to($this->Auth->autoRedirect());
				}
			}
		}

		$this->Auth->editProfile2($user);
		$this->ModelForgot->insert($data);
		session()->setFlashdata('success', 'Selamat Anda Sudah Bisa Menggunakan Sistem.');
		return redirect()->to($this->Auth->autoRedirect());
	}

	public function viewKirimEmail()
	{
		$data = [
			'title' => 'Kirim email'
		];

		return view('kirimEmail', $data);
	}

	public function viewKirimEmailUser()
	{
		$data = [
			'title' => 'Kirim ke email wali'
		];

		return view('kirimEmailUser', $data);
	}

	public function kirimEmail()
	{
		$email = $this->request->getPost('email');
		$user = $this->AuthModel->where('email', $email)
		->first();

		if (!$user) {
			session()->setFlashdata('error', 'Alamat Email Yang Anda Masukkan Tidak Terdaftar.');
			return redirect()->to('viewKirimEmail');
		} 
		
		$this->Auth->ForgotPassword($this->request->getVar('email'));
		return redirect()->to('login');
	}

	public function kirimEmailUser()
	{
		$email = $this->request->getPost('email');
		$user = $this->AuthModel->where('email', $email)->where('role', 3)
		->first();

		if (!$user) {
			session()->setFlashdata('error', 'Alamat Email Yang Anda Masukkan Tidak Terdaftar.');
			return redirect()->to('viewKirimEmailUser');
		} 
		
		$this->Auth->ForgotPasswordUser($this->request->getVar('email'));
		return redirect()->to('login');
	}

	public function lupaPassword()
	{
		$data = [
			'title' => '',
			'menu' => '',
		];
		return view('lupaPassword', $data);
	}

	public function email()
	{
		return view('email');
	}
}

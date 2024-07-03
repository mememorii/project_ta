<?php
namespace App\Libraries;
use CodeIgniter\I18n\Time;
use App\Models\AuthModel;
use App\Models\ModelGuru;
use App\Models\ModelSiswa;
use App\Models\ModelWali;
use App\Libraries\SendEmail;
use Config\Auth;
use Config\Email;
use Config\App;
use \Config\Services;
    
class AuthLibrary
{
    public function __construct()
    {
        $this->AuthModel =    new AuthModel();
        $this->ModelGuru =    new ModelGuru();
        $this->ModelSiswa =    new ModelSiswa();
        $this->ModelWali =    new ModelWali();
        $this->SendEmail = new SendEmail;        
        $this->config = new Auth;
        $this->emailconfig = new Email;
        $this->AppConfig = new App;
        $this->Session = session();
        $this->request = Services::request();
        
    }

    public function LoginUser($nik)
    {
        // GET USER DETAILS FROM DB
        $user = $this->AuthModel->where('nik', $nik)->first();
        // SET USER ID AS A VARIABLE
        $userID = $user['id'];
        //SET USER SESSION 
        $this->setUserSession($user);       
    }

    public function editProfile($user)
    {
        // SAVE TO DB
        $this->AuthModel->save($user);

        // SAVE USER DATA IN SESSION
        $this->setUserSession($user);

        // SET FLASH DATA
        $this->Session->setFlashData('success', lang('Password Berhasil Diubah'));
        
        return;
    }
   
    public function updatePassword($user)
    {
        // UPDATE DB
        $this->AuthModel->save($user);

        // SET SOME FLASH DATA
        $this->Session->setFlashData('success', lang('Auth.resetSuccess'));
    }
 
    public function setUserSession($user)
    {   
        $data = [
            'id' => $user['id'],
            'nama' => $user['nama'],
            'nik' => $user['nik'],
            'role' => $user['role'],
            'id_referensi' => $user['id_referensi'],
            'isLoggedIn' => true,
            'ipaddress' => $this->request->getIPAddress(),
        ];

        $this->Session->set($data);
        
        $userId = $this->Session->get('id');
        $user = $this->AuthModel->find($userId);
        if($this->Session->get('role') == 1 || $this->Session->get('role') == 2){
            $siswa = $this->ModelGuru->find($user['id_referensi']);
            $this->Session->set('kelas', $siswa['guru_kelas']);
        }elseif($this->Session->get('role') == 3){
            $siswa = $this->ModelSiswa->find($user['id_referensi']);
            $this->Session->set('kelas', $siswa['kelas']);
        }else{
            $siswa = $this->ModelWali->find($user['id_referensi']);
        }

        return true;
    }
  
    public function IsLoggedIn()
    {
        if (session()->get('isLoggedIn')) {
            return true;
        }
        
    }
  
    public function logout()
    {
        //DESTROY SESSION
        $this->Session->destroy();

        return;
    }

    public function autoredirect()
    {
        // AUTO REDIRECTS BASED ON ROLE 
        $redirect = $this->config->assignRedirect;

        return  $redirect[$this->Session->get('role')];
    }
}

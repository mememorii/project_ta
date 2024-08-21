<?php
namespace App\Libraries;
use CodeIgniter\I18n\Time;
use App\Models\AuthModel;
use App\Models\ModelGuru;
use App\Models\ModelSiswa;
use App\Models\ModelWali;
use Config\Auth;
use Config\App;
use App\Libraries\SendEmail;
use Config\Email;
use \Config\Services;
    
class AuthLibrary
{
    public function __construct()
    {
        $this->AuthModel =    new AuthModel();
        $this->ModelGuru =    new ModelGuru();
        $this->ModelSiswa =    new ModelSiswa();
        $this->ModelWali =    new ModelWali();
        $this->config = new Auth;
        $this->AppConfig = new App;
        $this->Session = session();
        $this->request = Services::request();
        $this->emailconfig = new Email;
        $this->SendEmail = new SendEmail;      
    }

    public function LoginUser($nik)
    {
        $user = $this->AuthModel->where('nik', $nik)->first();
        $userID = $user['id_users'];
        $this->setUserSession($user);       
    }

    public function editPassword($user)
    {
        $this->AuthModel->save($user);
        $this->Session->setFlashData('success', lang('Password Berhasil Diubah'));
        
        return;
    }

    public function editProfile($user)
    {
        $this->AuthModel->save($user);
        $this->setUserSession($user);
        $this->Session->setFlashData('success', lang('Password Berhasil Diubah'));
        
        return;
    }

    public function editProfile2($user)
    {
        $this->AuthModel->save($user);
        $this->setUserSession($user);
        
        
        return;
    }
   
    public function updatePassword($user)
    {
        $this->AuthModel->save($user);
        $this->Session->setFlashData('success', lang('Auth.resetSuccess'));
    }
 
    public function setUserSession($user)
    {   
        $data = [
            'id' => $user['id_users'],
            'nama' => $user['nama'],
            'nik' => $user['nik'],
            'email' => $user['email'],
            'role' => $user['role'],
            'id_referensi' => $user['id_referensi'],
            'isLoggedIn' => true,
            'ipaddress' => $this->request->getIPAddress(),
        ];

        $this->Session->set($data);
        
        $userId = $this->Session->get('id');
        $user = $this->AuthModel->find($userId);
        if($this->Session->get('role') == 1 || $this->Session->get('role') == 2){
            $guru = $this->ModelGuru->find($user['id_referensi']);
            $this->Session->set('kelas', $guru['guru_kelas']);
            $this->Session->set('rombel', $guru['rombel']);
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
        $this->Session->destroy();

        return;
    }

    public function autoredirect()
    {
        $redirect = $this->config->assignRedirect;

        return  $redirect[$this->Session->get('role')];
    }

    public function Forgotpassword($email)
    {

        // FIND USER BY EMAIL
        $user = $this->AuthModel->where('email', $email)
            ->first();

        // GENERATE A NEW TOKEN
        // SET THE TOKEN TYPE AS SECOND PARAMETER. Reset password token = 'reset_token'	
        $encodedtoken  = $this->GenerateToken($user, 'reset_token');

        // GENERATE AND SEND RESET EMAIL
        $this->ResetEmail($user, $encodedtoken);

        return;
    }

    public function ForgotpasswordUser($email)
    {

        // FIND USER BY EMAIL
        $user = $this->AuthModel->where('email', $email)->where('role', 3)
            ->first();

        // GENERATE A NEW TOKEN
        // SET THE TOKEN TYPE AS SECOND PARAMETER. Reset password token = 'reset_token'	
        $encodedtoken  = $this->GenerateToken($user, 'reset_token');

        // GENERATE AND SEND RESET EMAIL
        $this->ResetEmail($user, $encodedtoken);

        return;
    }

    public function GenerateToken($user, $tokentype)
    {
        // GENERATE A TOKEN
        $token = random_string('crypto', 20);

        // ENCODE THE TOKEN
        $encodedtoken = base64_encode($token);

        // HASH THE ENCODED TOKEN FOR EXTRA SECURITY 
        $authtoken = password_hash($token, $this->config->hashAlgorithm);

        // CHECK WHAT TYPE OF TOKEN WE ARE SETTING SO WE CAN SET THE EXPIRY TIME
        if ($tokentype == 'reset_token') {
            $tokenexpire = 'reset_expire';
            $expireTime = $this->config->resetTokenExpire;
        }

        // SET THE EXPIRY TIME FOR THE RESET TOKEN
        $TokenExpireTime = new Time('+' . $expireTime . 'hours');

        // DEFINE AN ARRAY WITH VARIABLES WE NEED TO PASS
        $user = [
            'id_users' => $user['id_users'],
            'email' => $user['email'],
            'nama' => $user['nama'],
            $tokentype => $authtoken,
            $tokenexpire => $TokenExpireTime,
        ];

        // UPDATE DB WITH HASHED TOKEN
        $this->AuthModel->save($user);

        // RETURN THE TOKEN
        return $encodedtoken;
    }

    public function ResetEmail($user, $encodedtoken)
    {
        // RESET LINK TO INCLUDE IN EMAIL TEMPLATE
        $resetlink = base_url() . 'resetpassword/' . $user['id_users'] . '/' . $encodedtoken;

        // SET DATA TO SEND TO EMAIL CONTENT
        $data = [
            'id_users' => $user['id_users'],
            'nama' => $user['nama'],
            'resetlink' => $resetlink,
        ];

        // SET DATA FOR EMAIL HEADERS
        $emaildata = [
            'to' => $user['email'],
            'subject' => $this->config->resetEmailSubject,
            'fromEmail' => $this->emailconfig->fromEmail,
            'fromName' => $this->emailconfig->fromName,
            'message_view' => 'forgotpassword.php',
            'messagedata' => $data,
        ];

        // SEND DATA TO SEND EMAIL LIBRARY
        $result = $this->SendEmail->build($emaildata);

        if ($result) {
            $this->Session->setFlashData('success', 'Kode Reset Password Berhasil Dikirim.');
            return true;
        } else {
            $this->Session->setFlashData('danger', 'Terdapat Masalah Dalam Pengiriman Kode.');
            return false;
        }
    }
  
}

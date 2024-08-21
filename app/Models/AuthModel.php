<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model{

    
    protected $table = 'tbl_users';
    protected $primaryKey = 'id_users';
    protected $allowedFields = ['nama', 'nik', 'password', 'role', 'id_referensi', 'email', 'reset_token', 'reset_expire'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];  

    public function __construct()
    {
        parent::__construct();
        $this->db=  \Config\Database::connect();
    }
   
    function get_all_data()
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_users u')
        ->select('u.*, COALESCE(g.nama, s.nama, w.nama) as referensi_name')
        ->join('tbl_guru g', 'g.nip = u.id_referensi', 'left')
        ->join('tbl_siswa s', 's.nisn = u.id_referensi', 'left')
        ->join('tbl_wali w', 'w.nik = u.id_referensi', 'left')
        ->get()
        ->getResultArray();

        return $query;
    }
    
     protected function beforeInsert(array $data){

        $data = $this->passwordHash($data);
        return $data;
      
    }
 
    protected function beforeUpdate(array $data)
    {

        $data = $this->passwordHash($data);
        return $data;
    }
    
    protected function passwordHash(array $data)
    {

        if (isset($data['data']['password']))
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_ARGON2ID);
        return $data;

    }
   
    public function getUserById($id)
    {
        return $this->asArray()
                    ->where(['id' => $id])
                    ->first();
    }

    public function getUserByNik($nik)
    {
        return $this->asArray()
                    ->where(['nik' => $nik])
                    ->first();
    }

    public function deleteUser($id_referensi)
    {
        return $this->where('id_referensi', $id_referensi)->delete();
    }

    public function totalUser()
    {
        $builder = $this->builder();
        $allData = $builder->select('*')->countAllResults();
        return $allData;
    }

    public function getCreatedAtDates()
    {
        return $this->select('created_at')->findAll();
    }

    public function updateUser($id, $data)
    {
        // Check if password field is provided and hash it
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_ARGON2ID);
        }

        // Perform the update operation
        return $this->where('id_users', $id)
                    ->update($data);
    }

    function cekEmail()
    {
        $builder = $this->builder();
        $query = $this->db->table('tbl_users u')
        ->select('u.*, COALESCE(g.nama, s.nama, w.nama) as referensi_name')
        ->join('tbl_guru g', 'g.nip = u.id_referensi', 'left')
        ->join('tbl_siswa s', 's.nisn = u.id_referensi', 'left')
        ->join('tbl_wali w', 'w.nik = u.id_referensi', 'left')
        ->where('')
        ->get()
        ->getResultArray();

        return $query;
    }

}

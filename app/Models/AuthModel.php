<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model{

    
    protected $table = 'tbl_users';
    protected $allowedFields = ['nama', 'nik', 'password', 'role', 'id_referensi'];
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
        ->join('tbl_guru g', 'g.id_guru = u.id_referensi', 'left')
        ->join('tbl_siswa s', 's.id_siswa = u.id_referensi', 'left')
        ->join('tbl_wali w', 'w.id_wali = u.id_referensi', 'left')
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
}

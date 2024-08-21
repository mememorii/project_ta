<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelForgot extends Model{

    
    protected $table = 'tbl_forgot';
    protected $primaryKey = 'id_pertanyaan';
    protected $allowedFields = ['id_pertanyaan', 'id_referensi', 'pertanyaan_1', 'pertanyaan_2', 'pertanyaan_3','pertanyaan_4','pertanyaan_5','jawaban_1','jawaban_2','jawaban_3','jawaban_4','jawaban_5'];

    public function __construct()
    {
        parent::__construct();
        $this->db=  \Config\Database::connect();
    }
   
    function get_all_data($nik, $id_referensi)
    {
        
        $builder = $this->db->table('tbl_forgot tf')
            ->select('tf.*, tu.id_users as id_user')
            ->join('tbl_users tu', 'tu.id_users = tf.id_referensi', 'left')
            // ->join('tbl_siswa ts', 'ts.nisn = tf.id_referensi', 'left')
            // ->join('tbl_wali tw', 'tw.nik = tf.id_referensi', 'left')
            // ->join('tbl_guru tg', 'tg.nip = tf.id_referensi', 'left')
            ->where('tu.id_referensi', $id_referensi)
            ->where('tu.nik', $nik);

            // if ($role == 2) {
            //     $builder->where('tg.nip', $nip);
            // }

            // if ($role == 3) {
            //     $builder->where('ts.nisn', $nisn);
            // }

            // if($role == 4){
            //     $builder->where('tw.nisn_siswa', $nisn);
            // }

            $query = $builder->get()->getRowArray();
            return $query;
    }

    function get_all_dataWali($nisn, $id_referensi)
    {
        $builder = $this->db->table('tbl_forgot tf')
        ->select('tf.*, tu.id_users as id_user')
        ->join('tbl_users tu', 'tu.id_users = tf.id_referensi', 'left')
        ->join('tbl_wali tw', 'tw.nik = tu.id_referensi', 'left')
        ->where('tu.id_referensi', $id_referensi)
        ->where('tw.nisn_siswa', $nisn);

        $query = $builder->get()->getRowArray();
        return $query;
    }

    function getIdReferensi($idCek)
    {
        $builder = $this->builder();
        $query = $builder->select('*')
        ->where('id_referensi', $idCek)
        ->get()
        ->getRowArray();

        return $query;
    }
}

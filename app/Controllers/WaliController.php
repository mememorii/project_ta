<?php

namespace App\Controllers;
use App\Models\ModelWali;
use App\Models\AuthModel;
use App\Models\ModelSiswa;
use App\Models\ModelCrm;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers\BaseController;
use Codeigniter\HTTP\RequestInterface;
use Config\services;

class WaliController extends BaseController
{
    function __construct()
    { 
        $this->AuthModel = new \App\Models\AuthModel();
        $this->ModelWali = new \App\Models\ModelWali();
        $this->ModelSiswa = new \App\Models\ModelSiswa();
        $this->ModelCrm = new \App\Models\ModelCrm();
    }

    // tampil data wali
    public function index()
    {   
        $data=[
            'title' => 'Data Wali Siswa',
            'menu'=> 'Data Wali Siswa',
            'getData' => $this-> ModelWali ->get_all_data()
        ];
        return view ('Wali/Wali',$data);
    }

    // tampil form tambah data
    public function create ()
    {
        $data=[
            'title' => 'Tambah Data Wali Siswa',
            'menu'=> 'Data Wali Siswa',
            'back'=>'admin/wali',
            'getData' => $this-> ModelSiswa ->get_all_data(),
        ];
        return view('Wali/create',$data);
    }
    
    // menyimpan data
    public function store() {
        
        $data = [
            'nisn_siswa' => $this->request->getPost('nisn_siswa'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'nik'  => $this->request->getPost('nik'),
            'nama'  => $this->request->getPost('nama'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'pendidikan' => $this->request->getPost('pendidikan'),
            'kelas_siswa' => $this->request->getPost('kelas'),
            'rombel_siswa' => $this->request->getPost('rombel'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        $cek = $this->ModelWali->where('nik', $data['nik'])
        ->first();

        $cekSiswa = $this->ModelWali->where('nisn_siswa', $data['nisn_siswa'])
        ->first();

        if ($cek) {
            session()->setFlashdata('error', 'NIK Sudah Terdaftar.');
            return redirect('wali/create');
        }elseif($cekSiswa){
            session()->setFlashdata('error', 'Wali Dari Siswa Sudah Terdaftar.');
            return redirect('wali/create');
        }else{
            $this->ModelWali->insert($data);

            $user = [
                'id_referensi'  => $data['nik'],
                'nik'  => $this->request->getPost('nik'),
                'password'  => $this->request->getPost('nik'),
                'nama'  => $this->request->getPost('nama'),
                'role'  =>  '4'
            ];
            
            $this->AuthModel->insert($user);
            session()->setFlashdata("success","Data Berhasil Disimpan");
            return $this->response->redirect(site_url('admin/wali'));
        }
    }

    // tampil edit data
    public function edit($id)
    {
        $data=[
            'title' => 'Edit Data Wali Siswa',
            'menu'=> 'Data Wali Siswa',
            'back'=>'admin/wali',
            'getData' => $this-> ModelSiswa ->get_all_data()
        ];
        $data['wali'] = $this->ModelWali->find($id);

        return view('Wali/edit', $data);
    }

    public function detail($id)
    {
        if(session()->get('role') == 1){
            $back = 'admin/wali';
        }else{
            $back = 'guru/wali';
        }
        $data=[
            'title' => 'Detail Data Wali Siswa',
            'menu'=> 'Data Wali Siswa',
            'back'=> $back,
        ];
        $data['wali'] = $this->ModelWali->get_waliBy_id($id);

        return view('Wali/detail', $data);
    }

    // update data
    public function update()
    {
        $data = [
            'id_data' => $this->request->getPost('id_data'),
            'nisn_siswa'    => $this->request->getPost('nisn_siswa'),
            'jenis_kelamin'    => $this->request->getPost('jenis_kelamin'),
            'nik'  => $this->request->getPost('nik'),
            'nama'  => $this->request->getPost('nama'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'pendidikan' => $this->request->getPost('pendidikan'),
            'kelas_siswa' => $this->request->getPost('kelas'),
            'rombel_siswa' => $this->request->getPost('rombel'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        $oldData = $this->ModelWali->find($data['id_data']);
        $oldNik = $oldData['nik'];
        $oldNisn = $oldData['nisn_siswa'];

        $nikCek = $this->ModelWali->where('nik', $data['nik'])
        ->first();

        $siswaCek = $this->ModelWali->where('nisn_siswa', $data['nisn_siswa'])
        ->first();
       
        if($oldNik != $data['nik']){
            if ($nikCek) {
                session()->setFlashdata('error', 'NIK Sudah Terdaftar.');
                return redirect()->to('wali/edit/' . $data['id_data']);
            }
           
        }

        if($oldNisn != $data['nisn_siswa']){
            if($siswaCek){
                session()->setFlashdata('error', 'Wali Dari Siswa Sudah Terdaftar.');
                return redirect()->to('wali/edit/' . $data['id_data']);
            }
        }

        $user = [
            'nama' => $this->request->getPost('nama'),
            'nik' => $this->request->getPost('nik'),
        ];
        
        $id = $this->request->getPost('nik');
        $this->ModelWali->update($id,$data);
        $this->AuthModel->where('id_referensi', $id)->set($user)->update();
        session()->setFlashdata("success","Data Berhasil di Edit");
        
        return redirect()->to('admin/wali');
    }
    
    // delete data
    public function delete($id = null)
    {
        $id_referensi = $id;
        $this->ModelWali->delete($id);
        $this->AuthModel->deleteUser($id_referensi);
        session()->setFlashdata("success","Data Berhasil Dihapus");
        return redirect()->to('admin/wali');
    }

   
}
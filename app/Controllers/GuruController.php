<?php

namespace App\Controllers;
use App\Models\ModelGuru;
use App\Models\AuthModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers\BaseController;
use Codeigniter\HTTP\RequestInterface;
use Config\services;

class GuruController extends BaseController
{
    function __construct()
    { 
        $this->ModelGuru = new \App\Models\ModelGuru();
        $this->AuthModel = new \App\Models\AuthModel();
    }

    // menampilkan halaman data guru
    public function index()
    {   
        $data=[
            'title' => 'Data Guru',
            'menu'=> 'Data Guru',
            'getData' => $this-> ModelGuru ->get_all_data()
        ];
        return view ('Guru/Guru',$data);
    }

    // menampilkan form tambah data guru
    public function create ()
    {
        $data=[
            'title' => 'Tambah Data Guru',
            'menu'=> 'Data Guru',
            'back'=>'admin/guru',
        ];
        return view('Guru/create',$data);
    }
    
    // menyimpan data guru
    public function store() 
    {
        $data = [
            'nip'  => $this->request->getPost('nip'),
            'nik'  => $this->request->getPost('nik'),
            'jabatan'  => $this->request->getPost('jabatan'),
            'nama'  => $this->request->getPost('nama'),
            'jenis_kelamin'  => $this->request->getPost('jenis_kelamin'),
            'pendidikan'  => $this->request->getPost('pendidikan'),
            'pangkat'  => $this->request->getPost('pangkat'),
            'agama'  => $this->request->getPost('agama'),
            'guru_kelas'  => $this->request->getPost('guru_kelas'),
            'rombel'  => $this->request->getPost('rombel'),
        ];

        $cek = $this->ModelGuru->where('nik', $data['nik'])
        ->first();

        $cekNip = $this->ModelGuru->where('nip', $data['nip'])
        ->first();

        if ($cek) {
            session()->setFlashdata('error', 'NIK Sudah Terdaftar.');
            return redirect('guru/create');
        }elseif($cekNip){
            session()->setFlashdata('error', 'NIP Sudah Terdaftar.');
            return redirect('guru/create');
        }else{
            $this->ModelGuru->insert($data);
            $id = $this->ModelGuru->getInsertID();

            $user = [
                'id_referensi'  => $data['nip'],
                'nik'  => $this->request->getPost('nik'),
                'password'  => $this->request->getPost('nik'),
                'nama'  => $this->request->getPost('nama'),
                'role'  => '2'
            ];
            
            $this->AuthModel->insert($user);
            session()->setFlashdata("success","Data Berhasil Disimpan");
            return $this->response->redirect(site_url('admin/guru'));
        }
    }

    public function detail($id)
    {   
        if(session()->get('role') == 1){
            $back = 'admin/guru';
        }else{
            $back = 'guru/guru';
        }
        $data=[
            'title' => 'Detail Data Guru',
            'menu'=> 'Data Guru',
            'back'=> $back,
        ];
        $data['guru'] = $this->ModelGuru->find($id);
        return view ('Guru/detail',$data);
    }

    // menampilkan halaman edit data guru
    public function edit($id)
    {
        $data=[
            'title' => 'Edit Data Guru',
            'menu'=> 'Data Guru',
            'back'=>'admin/guru',
        ];
        $data['guru'] = $this->ModelGuru->find($id);

        return view('Guru/edit', $data);
    }

    // mengupdate data guru
    public function update()
    {
        $data = [
            'id_data'  => $this->request->getPost('id_data'),
            'nip'  => $this->request->getPost('nip'),
            'nik'  => $this->request->getPost('nik'),
            'jabatan'  => $this->request->getPost('jabatan'),
            'nama'  => $this->request->getPost('nama'),
            'jenis_kelamin'  => $this->request->getPost('jenis_kelamin'),
            'pendidikan'  => $this->request->getPost('pendidikan'),
            'pangkat'  => $this->request->getPost('pangkat'),
            'agama'  => $this->request->getPost('agama'),
            'guru_kelas'  => $this->request->getPost('guru_kelas'),
            'rombel'  => $this->request->getPost('rombel'),
        ];

        $user = [
            'nama' => $this->request->getPost('nama'),
            'nik' => $this->request->getPost('nik'),
        ];

        $oldData = $this->ModelGuru->find($data['id_data']);
        $oldNik = $oldData['nik'];
        $oldNip = $oldData['nip'];

        $cekNik = $this->ModelGuru->where('nik', $data['nik'])
        ->first();

        $cekNip = $this->ModelGuru->where('nip', $data['nip'])
        ->first();

        if($oldNip !== $data['nip']){
            if($cekNip){
                session()->setFlashdata('error', 'NIP Sudah Terdaftar.');
                return redirect()->to('guru/edit/' . $data['id_data']);
            }
        }

        if($oldNik !== $data['nik']){
            if ($cekNik) {
                session()->setFlashdata('error', 'NIK Sudah Terdaftar.');
                return redirect()->to('guru/edit/' . $data['id_data']);
            }
        }

        $id = $this->request->getPost('id_data');
        $this->ModelGuru->update($id,$data);
        $this->AuthModel->where('id_referensi', $id)->set($user)->update();
        session()->setFlashdata("success","Data Berhasil Diedit");
        
        return redirect()->to('admin/guru');
    }
    
    // delete data
    public function delete($id = null)
    {
        $id_referensi = $id;
        $this->ModelGuru->delete($id);
        $this->AuthModel->deleteUser($id_referensi);
        session()->setFlashdata("success","Data Berhasil Dihapus");
        return redirect()->to('admin/guru');
    }

  
}
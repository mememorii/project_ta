<?php

namespace App\Controllers;
use App\Models\ModelSiswa;
use App\Models\AuthModel;
use App\Models\ModelCrm;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers\BaseController;
use Codeigniter\HTTP\RequestInterface;
use Config\services;

class SiswaController extends BaseController
{
    function __construct()
    { 
        $this->ModelSiswa = new \App\Models\ModelSiswa();
        $this->AuthModel = new \App\Models\AuthModel();
        $this->ModelCrm = new \App\Models\ModelCrm();
    }
    
    //menampilkan halaman data Siswa
    public function index()
    {   
        $data=[
            'title' => 'Data Siswa',
            'menu'=> 'Data Siswa',
            'getData' => $this-> ModelSiswa ->get_all_data()
        ];
        return view ('Siswa/Siswa',$data);
    }

    //menampilkan form tambah Siswa
    public function create ()
    {
        $data=[
            'title' => 'Tambah Data Siswa',
            'menu'=> 'Data Siswa',
            'back'=>'admin/siswa',
        ];
        return view('Siswa/create.php',$data);
    }
    
    // menyimpan input form
    public function store() 
    {
       
        $data = [
            'kelas'  => $this->request->getPost('kelas'),
            'nama'  => $this->request->getPost('nama'),
            'nipd'  => $this->request->getPost('nipd'),
            'jenis_kelamin'  => $this->request->getPost('jenis_kelamin'),
            'nisn'  => $this->request->getPost('nisn'),
            'tempat_lahir'  => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir'  => $this->request->getPost('tanggal_lahir'),
            'nik'  => $this->request->getPost('nik'),
            'agama'  => $this->request->getPost('agama'),
            'alamat'  => $this->request->getPost('alamat'),
            'rt'  => $this->request->getPost('rt'),
            'rw'  => $this->request->getPost('rw'),
            'kelurahan'  => $this->request->getPost('kelurahan'),
            'rombel'  => $this->request->getPost('rombel'),
        ];
        $cekNik = $this->ModelSiswa->where('nik', $data['nik'])
        ->first();

        $cekNipd = $this->ModelSiswa->where('nipd', $data['nipd'])
        ->first();

        $cekNisn = $this->ModelSiswa->where('nisn', $data['nisn'])
                      ->first();

        if ($cekNik) {
            session()->setFlashdata('error', 'NIK Sudah Terdaftar.');
            return redirect('siswa/create');
        }elseif ($cekNipd) {
            session()->setFlashdata('error', 'NIPD Sudah Terdaftar.');
            return redirect('siswa/create');
        }elseif ($cekNisn) {
            session()->setFlashdata('error', 'NISN Sudah Terdaftar.');
            return redirect('siswa/create');
        }else{
        
            $this->ModelSiswa->insert($data);

            $user = [
                'id_referensi'  => $data['nisn'],
                'nik'  => $this->request->getPost('nik'),
                'password'  => $this->request->getPost('nik'),
                'nama'  => $this->request->getPost('nama'),
                'role'  => '3'
            ];

            $this->AuthModel->insert($user);
            session()->setFlashdata("success","Data Berhasil Disimpan");
            return $this->response->redirect(site_url('admin/siswa'));
        }
    }

    public function detail ($id)
    {
        if(session()->get('role') == 1){
            $back = 'admin/siswa';
        }else{
            $back = 'guru/siswa';
        }
        $data=[
            'title' => 'Detail Data Siswa',
            'menu'=> 'Data Siswa',
            'back'=> $back,
        ];
        $data['siswa'] = $this->ModelSiswa->find($id);
        return view('Siswa/detail',$data);
    }

    //menampilkan halaman edit data siswa siswa
    public function edit($id)
    {
        $data=[
            'title' => 'Edit Data Siswa',
            'menu'=> 'Data Siswa',
            'back'=>'admin/siswa',
        ];
        $data['siswa'] = $this->ModelSiswa->find($id);

        return view('Siswa/edit', $data);
    }

    // mengupdate data
    public function update()
    {
        $data = [
            'id_data'  => $this->request->getPost('id_data'),
            'nisn'  => $this->request->getPost('nisn'),
            'kelas'  => $this->request->getPost('kelas'),
            'nama'  => $this->request->getPost('nama'),
            'nipd'  => $this->request->getPost('nipd'),
            'jenis_kelamin'  => $this->request->getPost('jenis_kelamin'),
            'nisn'  => $this->request->getPost('nisn'),
            'tempat_lahir'  => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir'  => $this->request->getPost('tanggal_lahir'),
            'nik'  => $this->request->getPost('nik'),
            'agama'  => $this->request->getPost('agama'),
            'alamat'  => $this->request->getPost('alamat'),
            'rt'  => $this->request->getPost('rt'),
            'rw'  => $this->request->getPost('rw'),
            'kelurahan'  => $this->request->getPost('kelurahan'),
            'rombel'  => $this->request->getPost('rombel'),
            'status'  => $this->request->getPost('status'),
            
        ];
       
        $oldData = $this->ModelSiswa->find($data['id_data']);
        $oldNik = $oldData['nik'];
        $oldNipd = $oldData['nipd'];
        $oldNisn = $oldData['nisn'];

        $nikCek = $this->ModelSiswa->where('nik', $data['nik'])
        ->first();

        $nipdCek = $this->ModelSiswa->where('nipd', $data['nipd'])
        ->first();
        
        $nisnCek = $this->ModelSiswa->where('nisn', $data['nisn'])
        ->first();

        if($oldNik != $data['nik']){
            if ($nikCek) {
                session()->setFlashdata('error', 'NIK Sudah Terdaftar.');
                return redirect()->to('siswa/edit/' . $data['id_data']);
            }
           
        }

        if($oldNipd != $data['nipd']){
            if($nipdCek){
                session()->setFlashdata('error', 'NIPD Sudah Terdaftar.');
                return redirect()->to('siswa/edit/' . $data['id_data']);
            }
        }

        if($oldNisn != $data['nisn']){
            if($nisnCek){
                session()->setFlashdata('error', 'NISN Sudah Terdaftar.');
                return redirect()->to('siswa/edit/' . $data['id_data']);
            }
        }

        $user = [
            'nama' => $this->request->getPost('nama'),
            'nik' => $this->request->getPost('nik'),
        ];
        $id = $this->request->getPost('nisn');
        $this->ModelSiswa->update($id,$data);
        $this->AuthModel->where('id_referensi', $id)->set($user)->update();
        session()->setFlashdata("success","Data Berhasil Diedit");

        return redirect()->to('admin/siswa');
    }
    
    // delete data Siswa
    public function delete($id = null)
    {
        $id_referensi = $id;
        $this->ModelSiswa->delete($id);
        $this->AuthModel->deleteUser($id_referensi);
        session()->setFlashdata("success","Data Berhasil Dihapus");
        return redirect()->to('admin/siswa');
    }

    
}
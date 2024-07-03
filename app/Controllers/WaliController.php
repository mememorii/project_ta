<?php

namespace App\Controllers;
use App\Models\ModelWali;
use App\Models\AuthModel;
use App\Models\ModelSiswa;
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
            'back'=>'',
            'getData' => $this-> ModelSiswa ->get_all_data(),
        ];
        return view('Wali/create',$data);
    }
    
    // menyimpan data
    public function store() {
        
        $data = [
            'id_siswa'    => $this->request->getPost('id_siswa'),
            'jk'    => $this->request->getPost('jk'),
            'nik'  => $this->request->getPost('nik'),
            'nama'  => $this->request->getPost('nama'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'pendidikan' => $this->request->getPost('pendidikan'),
            'kelas_siswa' => $this->request->getPost('kelas'),
            'rombel_siswa' => $this->request->getPost('rombel'),
        ];
        $this->ModelWali->insert($data);
        $id = $this->ModelWali->getInsertID();

        $user = [
            'id_referensi'  => $id,
            'nik'  => $this->request->getPost('nik'),
            'password'  => $this->request->getPost('nik'),
            'nama'  => $this->request->getPost('nama'),
            'role'  =>  '4'
        ];
        
        $this->AuthModel->insert($user);
        session()->setFlashdata("success","Data Berhasil Disimpan");
        return $this->response->redirect(site_url('admin/wali'));
    }

    // tampil edit data
    public function edit($id = null)
    {
        $data=[
            'title' => 'Edit Data Wali Siswa',
            'menu'=> 'Data Wali Siswa',
            'back'=>'',
            'getData' => $this-> ModelSiswa ->get_all_data()
        ];
        $data['wali'] = $this->ModelWali->find($id);

        return view('Wali/edit', $data);
    }

    public function detail($id = null)
    {
        $data=[
            'title' => 'Detail Data Wali Siswa',
            'menu'=> 'Data Wali Siswa',
            'back'=>'',
        ];
        $data['wali'] = $this->ModelWali->get_waliBy_id($id);

        return view('Wali/detail', $data);
    }

    // update data
    public function update()
    {
        $data = [
            'id_wali'   => $this->request->getPost('id_wali'),
            'id_siswa'    => $this->request->getPost('id_siswa'),
            'jk'    => $this->request->getPost('jk'),
            'nik'  => $this->request->getPost('nik'),
            'nama'  => $this->request->getPost('nama'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'pendidikan' => $this->request->getPost('pendidikan'),
            'kelas_siswa' => $this->request->getPost('kelas'),
            'rombel_siswa' => $this->request->getPost('rombel'),
        ];

        $id = $this->request->getPost('id_wali');
        $this->ModelWali->update($id,$data);

       

        $user = [
            'id_referensi'  => $id,
            'nik'  => $this->request->getPost('nik'),
            'password'  => $this->request->getPost('nik'),
            'nama'  => $this->request->getPost('nama'),
            'role'  =>  '4'
        ];
        
        $this->AuthModel->insert($user);
        session()->setFlashdata("success","Data Berhasil di Edit");
        return redirect()->to('admin/wali');
    }

    // tampil alert
    public function showSweetAlertMessages()
    {
        session()->setFlashdata("success","This is success message");
        
        session()->setFlashdata("warning","This is warning message");

        session()->setFlashdata("info","This is info message");

        session()->setFlashdata("error","This is error message");

        return view("sweetalert-notification");
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

    public function cetak($id)
    {
        
        $user = $this->ModelWali->get_waliBy_id($id);
        // Buat objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Data yang akan diekspor ke Excel
        $data = [
            ['Nama', 'Nama Siswa', 'Jenis Kelamin', 'NIK', 'Pekerjaan', 'Pendidikan', 'Kelas Siswa'],
            [$user['nama'], $user['nama_siswa'], $user['jk'], $user['nik'], $user['pekerjaan'], $user['pendidikan'], $user['kelas_siswa']],
        ];

        // Menambahkan gaya pada header
        $headerStyle = [
            'font' => ['bold' => true],
            'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'CCCCCC']],
        ];

        $sheet->fromArray($data, null, 'A1');

        // Aplikasikan gaya pada header
        $sheet->getStyle('A1:E1')->applyFromArray($headerStyle);

        // Simpan sebagai file Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'user_' . $user['id_wali'] . '.xlsx';

        // Set header untuk download file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;

    }

    public function exportAll()
    {
        $data = $this->ModelWali->get_all_data(); // Retrieve all data from tbl_crm

        // Create a new Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        $columns = [
            'A' => ['width' => 20, 'header' => 'Nama'],
            'B' => ['width' => 20, 'header' => 'NIK'],
            'C' => ['width' => 20, 'header' => 'Jenis Kelamin'],
            'D' => ['width' => 20, 'header' => 'Pekerjaan'],
            'E' => ['width' => 20, 'header' => 'Pendidikan'],
            'F' => ['width' => 25, 'header' => 'Nama Siswa'],
            'G' => ['width' => 25, 'header' => 'Kelas Siswa'],
        ];
    
        // Set column widths and headers dynamically
        foreach ($columns as $column => $config) {
            $sheet->getColumnDimension($column)->setWidth($config['width']);
            $sheet->setCellValue($column . '1', $config['header']);
        }
       
        // Add headers with specified fields
        $sheet ->setCellValue('A1', 'Nama')
               ->setCellValue('B1', 'NIK')
               ->setCellValue('C1', 'Jenis Kelamin')
               ->setCellValue('D1', 'Pekerjaan')
               ->setCellValue('E1', 'Pendidikan')
               ->setCellValue('F1', 'Nama Siswa')
               ->setCellValue('G1', 'Kelas Siswa');

        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFF']], // White font color for visibility
            'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FFD700']], // Yellow background color
            'borders' => [
                'outline' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            ],
        ];
    
        // Apply style to header row A1 to E1
        $sheet->getStyle('A1:G1')->applyFromArray($headerStyle);
        
        // Add data from database
        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item['nama']);
            $sheet->setCellValue('B' . $row, $item['nik']);
            $sheet->setCellValue('C' . $row, $item['jk']);
            $sheet->setCellValue('D' . $row, $item['pekerjaan']);
            $sheet->setCellValue('E' . $row, $item['pendidikan']);
            $sheet->setCellValue('F' . $row, $item['nama_siswa']);
            $sheet->setCellValue('G' . $row, $item['kelas_siswa']);
            
            $sheet->getStyle('A' . $row . ':G' . $row)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            $row++;
        }
       
        $filename = 'tbl_crm_' . date('Ymd_His') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Save spreadsheet as file
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
<?php

namespace App\Controllers;
use App\Models\ModelSiswa;
use App\Models\AuthModel;
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
            'back'=>'',
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
            'jk'  => $this->request->getPost('jk'),
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
        
        $this->ModelSiswa->insert($data);
        $id = $this->ModelSiswa->getInsertID();

        $user = [
            'id_referensi'  => $id,
            'nik'  => $this->request->getPost('nik'),
            'password'  => $this->request->getPost('nik'),
            'nama'  => $this->request->getPost('nama'),
            'role'  => '3'
        ];

        $this->AuthModel->insert($user);
       
        return $this->response->redirect(site_url('admin/siswa'));
    }

    public function detail ($id = null)
    {
        $data=[
            'title' => 'Detail Data Siswa',
            'menu'=> 'Data Siswa',
            'back'=>'',
        ];
        $data['siswa'] = $this->ModelSiswa->find($id);
        return view('Siswa/detail',$data);
    }

    //menampilkan halaman edit data siswa siswa
    public function edit($id = null)
    {
        $data=[
            'title' => 'Edit Data Siswa',
            'menu'=> 'Data Siswa',
            'back'=>'',
        ];
        $data['siswa'] = $this->ModelSiswa->find($id);

        return view('Siswa/edit', $data);
    }

    // mengupdate data
    public function update()
    {
        $data = [
            'id_siswa'  => $this->request->getPost('id_siswa'),
            'kelas'  => $this->request->getPost('kelas'),
            'nama'  => $this->request->getPost('nama'),
            'nipd'  => $this->request->getPost('nipd'),
            'jk'  => $this->request->getPost('jk'),
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

        $id = $this->request->getPost('id_siswa');
        $this->ModelSiswa->update($id,$data);

      

        $user = [
            'id_referensi'  => $id,
            'nik'  => $this->request->getPost('nik'),
            'password'  => $this->request->getPost('nik'),
            'nama'  => $this->request->getPost('nama'),
            'role'  => '3'
        ];

        $this->AuthModel->insert($user);
        session()->setFlashdata("success","Data Berhasil Diedit");
        return redirect()->to('admin/siswa');
    }

    // menampilkan alert
    public function showSweetAlertMessages()
    {
        session()->setFlashdata("success","This is success message");
        
        session()->setFlashdata("warning","This is warning message");

        session()->setFlashdata("info","This is info message");

        session()->setFlashdata("error","This is error message");

        return view("sweetalert-notification");
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

    public function cetak($id)
    {
        $userModel = new ModelSiswa();
        $user = $userModel->find($id);
        // Buat objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Data yang akan diekspor ke Excel
        $data = [
            ['Nama', 'NIK', 'NIPD', 'NISN', 'Jenis Kelamin', 'Tempat Lahir', 'Tanggal Lahir', 'Kelas', 'Rombel', 'Status'],
            [$user['nama'], $user['nik'], $user['nipd'], $user['nisn'], $user['jk'], $user['tempat_lahir'], $user['tanggal_lahir'], $user['kelas'], $user['rombel'], $user['status']],
        ];

        // Menambahkan gaya pada header
        $headerStyle = [
            'font' => ['bold' => true],
            'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'CCCCCC']],
        ];

        $sheet->fromArray($data, null, 'A1');

        // Aplikasikan gaya pada header
        $sheet->getStyle('A1:J1')->applyFromArray($headerStyle);

        // Simpan sebagai file Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'user_' . $user['id_siswa'] . '.xlsx';

        // Set header untuk download file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;

    }

    public function exportAll()
    {
        $data = $this->ModelSiswa->get_all_data(); // Retrieve all data from tbl_crm

        // Create a new Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $columns = [
            'A' => ['width' => 30, 'header' => 'Nama'],
            'B' => ['width' => 20, 'header' => 'NIK'],
            'C' => ['width' => 20, 'header' => 'NIPD'],
            'D' => ['width' => 20, 'header' => 'NISN'],
            'E' => ['width' => 10, 'header' => 'Jenis Kelamin'],
            'F' => ['width' => 20, 'header' => 'Tempat Lahir'],
            'G' => ['width' => 10, 'header' => 'Tanggal Lahir'],
            'H' => ['width' => 10, 'header' => 'Kelas'],
            'I' => ['width' => 10, 'header' => 'Rombel'],
            'J' => ['width' => 10, 'header' => 'Status'],
        ];
    
        // Set column widths and headers dynamically
        foreach ($columns as $column => $config) {
            $sheet->getColumnDimension($column)->setWidth($config['width']);
            $sheet->setCellValue($column . '1', $config['header']);
        }
    
        // Add headers with specified fields
        $sheet ->setCellValue('A1', 'Nama')
               ->setCellValue('B1', 'NIK')
               ->setCellValue('C1', 'NIPD')
               ->setCellValue('D1', 'NISN')
               ->setCellValue('E1', 'Jenis Kelamin')
               ->setCellValue('F1', 'Tempat Lahir')
               ->setCellValue('G1', 'Tanggal Lahir')
               ->setCellValue('H1', 'Kelas')
               ->setCellValue('I1', 'Rombel')
               ->setCellValue('J1', 'Status');

        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFF']], // White font color for visibility
            'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FFD700']], // Yellow background color
            'borders' => [
                'outline' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            ],
        ];
    
        // Apply style to header row A1 to E1
        $sheet->getStyle('A1:J1')->applyFromArray($headerStyle);
       
        // Add data from database
        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item['nama']);
            $sheet->setCellValue('B' . $row, $item['nik']);
            $sheet->setCellValue('C' . $row, $item['nipd']);
            $sheet->setCellValue('D' . $row, $item['nisn']);
            $sheet->setCellValue('E' . $row, $item['jk']);
            $sheet->setCellValue('F' . $row, $item['tempat_lahir']);
            $sheet->setCellValue('G' . $row, $item['tanggal_lahir']);
            $sheet->setCellValue('H' . $row, $item['kelas']);
            $sheet->setCellValue('I' . $row, $item['rombel']);
            $sheet->setCellValue('J' . $row, $item['status']);
            
            $sheet->getStyle('A' . $row . ':J' . $row)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

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
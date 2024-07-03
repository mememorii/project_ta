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
            'back'=>'',
        ];
        return view('Guru/create',$data);
    }
    
    // menyimpan data guru
    public function store() 
    {
        $data = [
            'id_guru'  => $this->request->getPost('id_guru'),
            'nip'  => $this->request->getPost('nip'),
            'nik'  => $this->request->getPost('nik'),
            'jabatan'  => $this->request->getPost('jabatan'),
            'nama'  => $this->request->getPost('nama'),
            'jk'  => $this->request->getPost('jk'),
            'pendidikan'  => $this->request->getPost('pendidikan'),
            'pangkat'  => $this->request->getPost('pangkat'),
            'agama'  => $this->request->getPost('agama'),
            'guru_kelas'  => $this->request->getPost('guru_kelas'),
            'rombel'  => $this->request->getPost('rombel'),
        ];
        $this->ModelGuru->insert($data);
        $id = $this->ModelGuru->getInsertID();

        $user = [
            'id_referensi'  => $id,
            'nik'  => $this->request->getPost('nik'),
            'password'  => $this->request->getPost('nik'),
            'nama'  => $this->request->getPost('nama'),
            'role'  => '2'
        ];
        
        $this->AuthModel->insert($user);
        session()->setFlashdata("success","Data Berhasil Disimpan");
        return $this->response->redirect(site_url('admin/guru'));
    }

    public function detail($id = null)
    {   
        $data=[
            'title' => 'Detail Data Guru',
            'menu'=> 'Data Guru',
            'back'=>'',
        ];
        $data['guru'] = $this->ModelGuru->find($id);
        return view ('Guru/detail',$data);
    }

    // menampilkan halaman edit data guru
    public function edit($id = null)
    {
        $data=[
            'title' => 'Edit Data Guru',
            'menu'=> 'Data Guru',
            'back'=>'',
        ];
        $data['guru'] = $this->ModelGuru->find($id);

        return view('Guru/edit', $data);
    }

    // mengupdate data guru
    public function update()
    {
        $data = [
            'id_guru'  => $this->request->getPost('id_guru'),
            'nip'  => $this->request->getPost('nip'),
            'nik'  => $this->request->getPost('nik'),
            'jabatan'  => $this->request->getPost('jabatan'),
            'nama'  => $this->request->getPost('nama'),
            'jk'  => $this->request->getPost('jk'),
            'pendidikan'  => $this->request->getPost('pendidikan'),
            'pangkat'  => $this->request->getPost('pangkat'),
            'agama'  => $this->request->getPost('agama'),
            'guru_kelas'  => $this->request->getPost('guru_kelas'),
            'rombel'  => $this->request->getPost('rombel'),
        ];

        $id = $this->request->getPost('id_guru');
        $this->ModelGuru->update($id,$data);

      

        $user = [
            'id_referensi'  => $id,
            'nik'  => $this->request->getPost('nik'),
            'password'  => $this->request->getPost('nik'),
            'nama'  => $this->request->getPost('nama'),
            'role'  => '2'
        ];
        
        $this->AuthModel->insert($user);
        session()->setFlashdata("success","Data Berhasil Diedit");
        return redirect()->to('admin/guru');
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
        $this->ModelGuru->delete($id);
        $this->AuthModel->deleteUser($id_referensi);
        session()->setFlashdata("success","Data Berhasil Dihapus");
        return redirect()->to('admin/guru');
    }

    public function cetak($id)
    {
        
        $user = $this->ModelGuru->get_guruBy_id($id);
        // Buat objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Data yang akan diekspor ke Excel
        $data = [
            ['Nama', 'NIP', 'NIK', 'Jabatan', 'Jenis Kelamin', 'Tempat Lahir', 'Tanggal Lahir', 'Pendidikan', 'Pangkat', 'Agama', 'guru_kelas', 'Rombel'],
            [$user['nama'], $user['nip'], $user['nik'], $user['jabatan'], $user['jk'], $user['tempat_lahir'], $user['tanggal_lahir'], $user['pendidikan'], $user['pangkat'], $user['agama'], $user['guru_kelas'], $user['rombel']],
        ];

        // Menambahkan gaya pada header
        $headerStyle = [
            'font' => ['bold' => true],
            'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'CCCCCC']],
        ];

        $sheet->fromArray($data, null, 'A1');

        // Aplikasikan gaya pada header
        $sheet->getStyle('A1:L1')->applyFromArray($headerStyle);

        // Simpan sebagai file Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'user_' . $user['id_guru'] . '.xlsx';

        // Set header untuk download file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;

    }

    public function exportAll()
    {
        $data = $this->ModelGuru->get_all_data(); // Retrieve all data from tbl_crm

        // Create a new Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
       
        $columns = [
            'A' => ['width' => 30, 'header' => 'Nama'],
            'B' => ['width' => 20, 'header' => 'NIP'],
            'C' => ['width' => 20, 'header' => 'NIK'],
            'D' => ['width' => 20, 'header' => 'Jabatan'],
            'E' => ['width' => 15, 'header' => 'Jenis Kelamin'],
            'F' => ['width' => 20, 'header' => 'Tempat Lahir'],
            'G' => ['width' => 12, 'header' => 'Tanggal Lahir'],
            'H' => ['width' => 10, 'header' => 'Pendidikan'],
            'I' => ['width' => 20, 'header' => 'Pangkat'],
            'J' => ['width' => 10, 'header' => 'Agama'],
            'K' => ['width' => 10, 'header' => 'guru_kelas'],
            'L' => ['width' => 10, 'header' => 'Rombel'],
        ];
    
        // Set column widths and headers dynamically
        foreach ($columns as $column => $config) {
            $sheet->getColumnDimension($column)->setWidth($config['width']);
            $sheet->setCellValue($column . '1', $config['header']);
        }
       
        // Add headers with specified fields
        $sheet ->setCellValue('A1', 'Nama')
               ->setCellValue('B1', 'NIP')
               ->setCellValue('C1', 'NIK')
               ->setCellValue('D1', 'Jabatan')
               ->setCellValue('E1', 'Jenis Kelamin')
               ->setCellValue('F1', 'Tempat Lahir')
               ->setCellValue('G1', 'Tanggal Lahir')
               ->setCellValue('H1', 'Pendidikan')
               ->setCellValue('I1', 'Pangkat')
               ->setCellValue('J1', 'Agama')
               ->setCellValue('K1', 'guru_kelas')
               ->setCellValue('L1', 'Rombel');

        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFF']], // White font color for visibility
            'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FFD700']], // Yellow background color
            'borders' => [
                'outline' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            ],
        ];
    
        // Apply style to header row A1 to E1
        $sheet->getStyle('A1:L1')->applyFromArray($headerStyle);
       
        // Add data from database
        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item['nama']);
            $sheet->setCellValue('B' . $row, $item['nip']);
            $sheet->setCellValue('C' . $row, $item['nik']);
            $sheet->setCellValue('D' . $row, $item['jabatan']);
            $sheet->setCellValue('E' . $row, $item['jk']);
            $sheet->setCellValue('F' . $row, $item['tempat_lahir']);
            $sheet->setCellValue('G' . $row, $item['tanggal_lahir']);
            $sheet->setCellValue('H' . $row, $item['pendidikan']);
            $sheet->setCellValue('I' . $row, $item['pangkat']);
            $sheet->setCellValue('J' . $row, $item['agama']);
            $sheet->setCellValue('K' . $row, $item['guru_kelas']);
            $sheet->setCellValue('L' . $row, $item['rombel']);
            
            $sheet->getStyle('A' . $row . ':L' . $row)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

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
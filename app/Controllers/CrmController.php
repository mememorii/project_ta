<?php

namespace App\Controllers;
use App\Models\ModelCrm;
use App\Models\ModelKomentar;
use App\Models\ModelImage;
use App\Models\AuthModel;
use App\Models\ModelWali;
use App\Models\ModelSiswa;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers\BaseController;
use Codeigniter\HTTP\RequestInterface;
use Config\services;

class CrmController extends BaseController
{
    function __construct()
    { 
        $this->ModelImage = new \App\Models\ModelImage();
        $this->ModelCrm = new \App\Models\ModelCrm();
        $this->ModelKomentar = new \App\Models\ModelKomentar();
        $this->ModelWali = new \App\Models\ModelWali();
        $this->ModelSiswa = new \App\Models\ModelSiswa();
        $this->Session = session();	
    }

    // tampil data 
    public function index()
    {   
        
        $status = $this->request->getGet('status');

        if ($status === 'all') {
            $crmData = $this->ModelCrm->get_all_data(); // Retrieve all data
        } else {
            $status = $status ?? 'open'; // Default to 'open' if no status is provided
            $crmData = $this->ModelCrm->getDataByStatus($status); // Filter by status
        }

        $data=[
            'title' => 'Feedback',
            'menu'=> 'Feedback',
            'crmData' => $crmData,
            'siswa' => $this->ModelSiswa->get_all_data(),
            'wali' => $this->ModelWali->get_all_data(),
            'selectedStatus' => $status,
           
        ];
       

        return view ('Crm/crm',$data);
    }

    public function index_user()
    {   
        $status = $this->request->getGet('status');

        if ($status === 'all') {
            $crmData = $this->ModelCrm->findAll(); // Retrieve all data
        } else {
            $status = $status ?? 'open'; // Default to 'open' if no status is provided
            $crmData = $this->ModelCrm->getDataByStatus($status); // Filter by status
        }

        // Get data based on status
       

        $data=[
            'title' => 'Feedback',
            'menu'=> 'Feedback',
            'crmData' => $crmData,
            'selectedStatus' => $status
            //'getData' => $this-> ModelKritik ->get_all_data(),
        ];
       

        return view ('Crm/CrmUser',$data);
    }

    // tampil form data
    public function create ()
    {
        $data=[
            'title' => 'Feedback',
            'menu'=> 'Feedback',
            'back'=> '',
        ];
       
        return view('Crm/create',$data);
    }

    // tampil detail 
    public function detail ($id = null)
    {
        $data=[
            'title' => 'Feedback',
            'menu'=> 'Feedback',
            'back'=>'',
            'crm' => $this->ModelCrm->get_crmBy_id($id),
            'komentar' => $this->ModelKomentar->getDataTimeline($id),
            'images' => $this->ModelImage->where('id_crm', $id)->findAll()
        ];
        
        return view('Crm/detail',$data);
    }

    // update 
    function update_komentar(){
        $data['id_crm'] = $this->request->getPost('id_crm');
        $data['notes'] = $this->request->getPost('komentar');
        $data['user_comment'] = $this->request->getPost('user_comment'); // disi menggunkana session login

        $this->ModelKomentar->insert($data);

        return redirect()->to(site_url('crm/detail/'.$data['id_crm']));
    }

    public function close()
    {
        $id = $this->request->getPost('id_crm');
        $rating = $this->request->getPost('rating');
        $this->ModelCrm->update($id, ['status' => 'closed', 'rating' => $rating]);
       
        if ($this->Session->get('role') == 3) {
            return redirect()->to('siswa/crm');
        } else {
            return redirect()->to('wali/crm');
        }
    }

    // simpan saran kritik user
    public function Userstore() {
        $data = [
            'id_crm' => $this->request->getPost('id_crm'),
            'id_referensi' => $this->request->getPost('id_referensi'),
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
        ];
       
        $this->ModelCrm->insert($data);
        $id = $this->ModelCrm->getInsertID();

        $filesUploaded = 0;
 
        if($this->request->getFileMultiple('fileuploads'))
        {
            $files = $this->request->getFileMultiple('fileuploads');
 
            foreach ($files as $file) {
 
                if ($file->isValid() && ! $file->hasMoved())
                {
                    $newName = $file->getRandomName();
                    $file->move('public/assets/dist/uploads', $newName);
                    $data = [
                        'id_crm'  => $id,
                        'filename' => $file->getClientName(),
                        'filepath' => 'public/assets/dist/uploads/' . $newName,
                        'type' => $file->getClientExtension()
                    ];
                    
                    $this->ModelImage->save($data);
                    $filesUploaded++;
                }
                 
            }
 
        }
 
        if($filesUploaded <= 0) {
            return redirect()->back()->with('error', 'Choose files to upload.');
        }
 
        return redirect()->back()->with('success', $filesUploaded . ' File/s uploaded successfully.');
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
    
    public function comment_delete($id = null)
    {
        $id_crm = $this->request->getGet('id_crm');
        $this->ModelKomentar->delete($id);
        session()->setFlashdata("success","This is success message");
        
        return redirect()->to(site_url('crm/detail/'.$id_crm));
    }

    // delete data
    public function delete($id = null)
    {
        $this->ModelCrm->delete($id);
        session()->setFlashdata("success","This is success message");
        return redirect()->to('/crm');
    }

    public function cetak($id)
    {
        
        $user = $this->ModelCrm->get_crmBy_id($id);
        // Buat objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Data yang akan diekspor ke Excel
        $data = [
            ['Kode Crm', 'Nama', 'Judul', 'Deskripsi', 'Status', 'Rating'],
            [$user['kode_crm'], $user['nama'], $user['judul'], $user['deskripsi'], $user['status'], $user['rating']],
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
        $filename = 'user_' . $user['id_crm'] . '.xlsx';

        // Set header untuk download file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;

    }

    public function exportAll()
    {
        $data = $this->ModelCrm->get_all_data(); // Retrieve all data from tbl_crm

        // Create a new Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $columns = [
            'A' => ['width' => 10, 'header' => 'Kode Crm'],
            'B' => ['width' => 30, 'header' => 'Nama'],
            'C' => ['width' => 40, 'header' => 'Judul'],
            'D' => ['width' => 50, 'header' => 'Deskripsi'],
            'E' => ['width' => 10, 'header' => 'Status'],
            'F' => ['width' => 10, 'header' => 'Rating'],
        ];
    
        // Set column widths and headers dynamically
        foreach ($columns as $column => $config) {
            $sheet->getColumnDimension($column)->setWidth($config['width']);
            $sheet->setCellValue($column . '1', $config['header']);
        }
    

        // Add headers with specified fields
        $sheet ->setCellValue('A1', 'Kode Crm')
               ->setCellValue('B1', 'Nama')
               ->setCellValue('C1', 'Judul')
               ->setCellValue('D1', 'Deskripsi')
               ->setCellValue('E1', 'Status')
               ->setCellValue('F1', 'Rating');

        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFF']], // White font color for visibility
            'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FFD700']], // Yellow background color
            'borders' => [
                'outline' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            ],
        ];
    
        // Apply style to header row A1 to E1
        $sheet->getStyle('A1:F1')->applyFromArray($headerStyle);

        // Add data from database
        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item['kode_crm']);
            $sheet->setCellValue('B' . $row, $item['nama']);
            $sheet->setCellValue('C' . $row, $item['judul']);
            $sheet->setCellValue('D' . $row, $item['deskripsi']);
            $sheet->setCellValue('E' . $row, $item['status']);
            $sheet->setCellValue('F' . $row, $item['rating']);
            
            $sheet->getStyle('A' . $row . ':F' . $row)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

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
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
    public function tab()
    {   
        $data= [
            'title' => '',
            'menu' => '',
        ];
        return view('Crm/tab', $data);
    }
    // tampil data 
    public function index()
    {   
        // $id_referensi = $crm['id_referensi'];
        // $id_feedback = $crm['id_feedback'];
        $userAktif = session()->get('id_referensi');
        $status = $this->request->getGet('status') ?? 'all';
        $kategori = $this->request->getGet('kategori') ?? 'Semua';
        if($status === 'all' && $kategori === 'Semua') {
            $crmData = $this->ModelCrm->get_all_data(); 
        }elseif($status === 'all' && $kategori !== 'Semua'){
            $crmData = $this->ModelCrm->getDataByKategori($kategori);
        }elseif($status !== 'all' && $kategori === 'Semua'){
            $crmData = $this->ModelCrm->getDataByStatus($status);
        }else{
            $crmData = $this->ModelCrm->getDataByStatusAndKategori($status, $kategori);
        }

        $status2 = $this->request->getGet('status2') ?? 'all';
        $kategori2 = $this->request->getGet('kategori2') ?? 'Semua';
        if($status2 === 'all' && $kategori2 === 'Semua') {
            $crmData2 = $this->ModelCrm->get_all_dataResponden($userAktif); 
        }elseif($status2 === 'all' && $kategori2 !== 'Semua'){
            $crmData2 = $this->ModelCrm->getDataByKategoriResponden($kategori2, $userAktif);
        }elseif($status2 !== 'all' && $kategori2 === 'Semua'){
            $crmData2 = $this->ModelCrm->getDataByStatusResponden($status2, $userAktif);
        }else{
            $crmData2 = $this->ModelCrm->getDataByStatusAndKategoriResponden($status2, $kategori2, $userAktif);
        }

        

        $data=[
            'title' => 'Feedback',
            'menu'=> 'Feedback',
            'crmData' => $crmData,
            'crmData2' => $crmData2,
            'siswa' => $this->ModelSiswa->get_all_data(),
            'wali' => $this->ModelWali->get_all_data(),
            'selectedStatus' => $status,
            'selectedKategori' => $kategori,
            'selectedStatus2' => $status2,
            'selectedKategori2' => $kategori2,
        ];

        return view ('Crm/crm',$data);
    }

    public function index_user()
    {   
        // $id_responden = $crm['responden'];
        // $id_feedback = $crm['id_feedback'];
        $id_referensi = session()->get('id_referensi');
        $status = $this->request->getGet('status') ?? 'all';
        $kategori = $this->request->getGet('kategori') ?? 'Semua';

        // if($status === 'all' && $kategori === 'Semua') {
        //     $crmData = $this->ModelCrm->get_all_dataUser($id_referensi);
        // }elseif($status === 'all' && $kategori !== 'Semua'){
        //     $crmData = $this->ModelCrm->getDataByKategoriUser($kategori, $id_referensi);
        // }elseif($status !== 'all' && $kategori === 'Semua'){
        //     $crmData = $this->ModelCrm->getDataByStatusUser($status, $id_referensi);
        // }else{
        //     $crmData = $this->ModelCrm->getDataByStatusAndKategoriUser($status, $kategori, $id_referensi);
        // }

        if($status === 'all' && $kategori === 'Semua') {
            $crmData = $this->ModelCrm->get_all_dataUser($id_referensi); 
        }elseif($status === 'all' && $kategori !== 'Semua'){
            $crmData = $this->ModelCrm->getDataByKategoriUser($kategori, $id_referensi);
        }elseif($status !== 'all' && $kategori === 'Semua'){
            $crmData = $this->ModelCrm->getDataByStatusUser($status, $id_referensi);
        }else{
            $crmData = $this->ModelCrm->getDataByStatusAndKategoriUser($status, $kategori, $id_referensi);
        }

        // $newKomentar = $this->ModelKomentar->newKomentarGuru($id_feedback, $id_responden);
        
        $data=[
            'title' => 'Feedback',
            'menu'=> 'Feedback',
            'crmData' => $crmData,
            'selectedStatus' => $status,
            'selectedKategori' => $kategori,
            // 'newKomentar' => $newKomentar
        ];
        
        return view ('Crm/CrmUser',$data);
    }

    // tampil form data
    public function create ()
    {
        if(session()->get('role') == 2){
            $back = 'crm';
        }elseif(session()->get('role') == 3){
            $back = 'siswa/crm';
        }else{
            $back = 'wali/crm';
        }
        $data=[
            'title' => 'Feedback',
            'menu'=> 'Feedback',
            'back'=> $back,
        ];
       
        return view('Crm/create',$data);
    }

    // tampil detail 
    public function detail ($id)
    {
        $userAktif = session()->get('id_referensi');
        $crm = $this->ModelCrm->get_crmBy_id($id);
        $id_referensi = $crm['id_referensi'];
        $id_feedback = $crm['id_feedback'];
        $id_responden = $crm['responden'];

        if(session()->get('role') == 2){
            $getKomentar = $this->ModelKomentar->readKomentarUser($id_feedback, $id_referensi);
        }else{
            $getKomentar = $this->ModelKomentar->readKomentarGuru($id_feedback, $id_responden);
        }
        
        if($crm['responden'] == $userAktif || $crm['id_referensi'] == session()->get('id_referensi'))
        {
            // Iterate over each comment and update it to mark as read
            foreach ($getKomentar as $komentar) {
                $this->ModelKomentar->update($komentar['id_komentar'], ['read' => '1']);
            }
        }
        if($crm['rating'] == 5){
            $label = 'Sangat Bagus';
        }elseif($crm['rating'] == 4){
            $label = 'Bagus';
        }elseif($crm['rating'] == 3){
            $label = 'Biasa';
        }elseif($crm['rating'] == 2){
            $label = 'Jelek';
        }else{
            $label = 'Sangat Jelek';
        }

        if(session()->get('role') == 2){
            $back = 'crm';
        }elseif(session()->get('role') == 3){
            $back = 'siswa/crm';
        }else{
            $back = 'wali/crm';
        }
        $editData = session()->getFlashdata('edit_data');
        $data=[
            'title' => 'Feedback',
            'menu'=> 'Feedback',
            'back'=> $back,
            'crm' => $crm,
            'ratingLabel' => $label,
            'komentar' => $this->ModelKomentar->getDataTimeline($id),
            'images' => $this->ModelImage->where('id_feedback', $id)->findAll(),
            'editData' => $editData,
        ];
        
        return view('Crm/detail',$data);
    }

    public function upload_image()
    {
        $validated = $this->validate([
            'upload' => [
                'uploaded[upload]',
                'mime_in[upload,image/jpg,image/jpeg,image/png]',
                'max_size[upload,1024]',
            ],
        ]);

        if($validated)
        {
            $file = $this->request->getFile('upload');
            $fileName = $file->getRandomName();
            $writePath = 'public/assets/dist/uploads';
            $file->move($writePath, $fileName);
            $data = [
                "uploaded" => true,
                "url" => base_url('public/assets/dist/uploads/'.$fileName),
            ];
        }else{
            $data = [
                "uploaded" => false,
                "error" => [
                    "messsages" => $file
                ],
            ];
        }
        
        return $this->response->setJSON($data);
    }

    // update 
    function update_komentar(){
        $data['id_feedback'] = $this->request->getPost('id_feedback');
        $data['notes'] = $this->request->getPost('komentar');
        $data['user_comment'] = $this->request->getPost('user_comment'); // disi menggunkana session login

        $this->ModelKomentar->insert($data);

        return redirect()->to(site_url('crm/detail/'.$data['id_feedback']));
    }

    public function resolusi()
    {   
        $id_feedback = $this->request->getPost('id_feedback');
        $data= [
            'resolusi' => $this->request->getPost('resolusi'),
        ];

        $this->ModelCrm->update($id_feedback, $data);
        session()->setFlashdata("success","Resolusi Feedback Berhasil Dikirim");
        return redirect()->to(site_url('crm/detail/'.$id_feedback));
    }

    public function editResolusi($id)
    {   
        $data= [
            'edit' => '1',
        ];
        session()->setFlashdata('edit_data', $data);
        return redirect()->to(site_url('crm/detail/'.$id));
    }

    public function rating()
    {
        $id = $this->request->getPost('id_feedback');
        $rating = $this->request->getPost('rating');
        $this->ModelCrm->update($id, ['rating' => $rating]);

        if ($this->Session->get('role') == 3) {
            return redirect()->to('siswa/crm');
        } else {
            return redirect()->to('wali/crm');
        }
    }

    public function close()
    {
        $id = $this->request->getPost('id_feedback');
        session()->setFlashdata("success","Tiket Feedback Berhasil Ditutup");
        $this->ModelCrm->update($id, ['status' => 'closed']);
       
        if ($this->Session->get('role') == 3) {
            return redirect()->to('siswa/crm');
        } else {
            return redirect()->to('wali/crm');
        }
    }

    // simpan saran kritik user
    public function Userstore() 
    {
        $data = [
            'id_referensi' => $this->request->getPost('id_referensi'),
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'kategori' => $this->request->getPost('kategori'),
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
                        'id_feedback'  => $id,
                        'filename' => $file->getClientName(),
                        'filepath' => 'public/assets/dist/uploads/' . $newName,
                    ];
                    
                    $this->ModelImage->save($data);
                    $filesUploaded++;
                }
                 
            }
 
        }
        
        session()->setFlashdata("success","Tiket Feedback Berhasil Dibuat");
        if(session()->get('role') == 3){
            return redirect('siswa/crm');
        }else{
            return redirect('wali/crm');
        };
        
    }
    
    public function comment_delete($id = null)
    {
        $id_feedback = $this->request->getGet('id_feedback');
        $this->ModelKomentar->delete($id);
        session()->setFlashdata("success","Komentar Berhasil Dihapus");
        
        return redirect()->to(site_url('crm/detail/'.$id_feedback));
    }

    // delete data
    public function delete($id = null)
    {
        $this->ModelCrm->delete($id);
        session()->setFlashdata("success","This is success message");
        return redirect()->to('/crm');
    }

    public function respond()
    {
        $id_feedback = $this->request->getPost('id_feedback');
        $data = [
            'responden' => session()->get('id_referensi'),
            'status' => 'progress',
        ];

        $this->ModelCrm->update($id_feedback,$data);
        session()->setFlashdata("success","Anda Telah Menjadi Responden Feedback");
        return redirect()->to('crm/detail/' . $id_feedback);
    }

    public function survey()
    {
        $data= [
            'title' => '',
            'menu' => '',
        ];
        return view('Crm/survey', $data);
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
        $filename = 'user_' . $user['id_feedback'] . '.xlsx';

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
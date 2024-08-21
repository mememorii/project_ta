<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <style>
        body{
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px; /* Ensure content is within margins */
            width: 100%; /* Set body width to 100% */
            max-width: 100%; /* Ensure content does not exceed the width */
        }
        .clearfix:after {
        content: "";
        display: table;
        clear: both;
        }

        a {
        color: #5D6975;
        text-decoration: underline;
        }

        body {
        position: relative;
        width: 21cm;  
        height: 29.7cm; 
        margin: 0 auto; 
        color: #001028;
        background: #FFFFFF; 
        font-family: Arial, sans-serif; 
        font-size: 12px; 
        font-family: Arial;
        }

        header {
        padding: 10px 0;
        margin-bottom: 30px;
        }

        #logo {
        text-align: center;
        margin-bottom: 10px;
        }

        #logo img {
        width: 90px;
        }

        h1 {
        border-top: 1px solid  #5D6975;
        border-bottom: 1px solid  #5D6975;
        color: #5D6975;
        font-size: 2.4em;
        line-height: 1.4em;
        font-weight: normal;
        text-align: center;
        margin: 0 0 20px 0;
        background: url(dimension.png);
        }

        #project {
        float: left;
        }

        #project span {
        color: #5D6975;
        text-align: right;
        width: 52px;
        margin-right: 10px;
        display: inline-block;
        font-size: 0.8em;
        }

        #company {
        float: right;
        text-align: right;
        }

        #project div,
        #company div {
        white-space: nowrap;        
        }

        table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
        background: #F5F5F5;
        }

        table th,
        table td {
        text-align: center;
        }

        table th {
        padding: 5px 20px;
        color: #5D6975;
        border-bottom: 1px solid #C1CED9;
        white-space: nowrap;        
        font-weight: normal;
        }

        table .service,
        table .desc {
        text-align: left;
        }

        table td {
        padding: 20px;
        text-align: center;
        }

        table td.service,
        table td.desc {
        vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
        font-size: 1.2em;
        }

        table td.grand {
        border-top: 1px solid #5D6975;;
        }

        #notices .notice {
        color: #5D6975;
        font-size: 1.2em;
        }

        footer {
        color: #5D6975;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #C1CED9;
        padding: 8px 0;
        text-align: center;
        }
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="<?= base_url()?>public/assets/dist/img/83790f2b43f00be.png">
      </div>
      <h1>Data Siswa</h1>
      <div id="project">
        <div><span>Nama</span><?=$siswa['nama']?></div>
        <div><span>NIK</span><?=$siswa['nik'] ?? '-' ?></div>
        <div><span>NIPD</span><?=$siswa['nipd'] ?? '-' ?></div>
        <div><span>NISN</span><?=$siswa['nisn'] ?? '-' ?></div>
        <div><span>Jenis Kelamin</span><?=$siswa['jenis_kelamin']?></div>
        <div><span>Tempat Lahir</span><?=$siswa['tempat_lahir']?></div>
        <div><span>Tanggal Lahir</span><?=$siswa['tanggal_lahir']?></div>
        <div><span>Agama</span><?=$siswa['agama']?></div>
        <div><span>Alamat</span><?=$siswa['alamat']?></div>
        <div><span>RT</span><?=$siswa['rt']?></div>
        <div><span>RW</span><?=$siswa['rw']?></div>
        <div><span>Kelurahan</span><?=$siswa['kelurahan']?></div>
        <div><span>Kelas</span><?=$siswa['kelas']?></div>
        <div><span>Rombel</span><?=$siswa['rombel'] ?? '-' ?></div>
        <div><span>Status</span><?=$siswa['status'] ?? '-' ?></div>
      </div>
    </header>
    <header class="clearfix">
            <h1>Data Feedback</h1>
            </header>
    <main>
      <table>
        <thead>
            <tr>
                <th>Nomor</th>
                <th>Tanggal</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach($crmData as $value){
            ?>
                <tr>
                    <td><?=$no++?></td>
                    <td><?=$value['tanggal']?></td>
                    <td><?=$value['judul']?></td>
                    <td><?=$value['deskripsi']?></td>
                    <td><?=$value['status']?></td>
                    <td><?=$value['rating'] ?? 'Belum Dirating' ?></td>
                </tr>
            <?php 
            } 
            ?>
        </tbody>
      </table>
    </main>
  </body>
</html>
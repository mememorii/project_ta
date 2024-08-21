<?= $this->extend('layout_login/header_forgot') ?>
<?= $this->section('content') ?>
<style>
.parent-container {
    display: flex;
    justify-content: center;
    align-items: center;
}

.centered {
    display: flex;
    justify-content: center;
    align-items: center;
}
h3{
    text-align:center;
    margin-bottom:20px;
}
</style>
    <div class="container-fluid mt-lg-5 mb-lg-5">
        <div class="card" style="width:800px;  margin: 0 auto; /* Added */
        float: none; /* Added */">
            <div class="card-header">
                <h3 class="card-title">Set Pertanyaan Keamanan</h3>
            </div>
            <div class="card-body">
                <div class="parent-container">
                    <span class="centered">
                        <img src="public/assets/dist/img/stock-vector-security-icon-with-question-mark-security-icon-and-help-how-to-info-query-symbol-security-1045910569-transformed.jpeg" style="width:300px">
                    </span>
                </div>
                <h3>Sebelum Anda Menggunakan Sistem Tolong untuk Membuat Pertanyaan Keamanan Terlebih Dahulu Untuk Mereset Password</h3>
                <hr>
                <?php if(session()->get('role') == 3) { ?>
                    <form class="" action="<?= base_url() ?>saveForgot" id="form" method="post">
                        <input type="hidden" class="form-control" name="id_users" id="id_users" value="<?= session()->get('id') ?>">
                        <div class="row">
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label>Pertanyaan 1</label>
                                    <select class="form-control" name="pertanyaan_1" id="pertanyaan_1" onchange="toggleInputField1()" required>
                                        <option value="" selected hidden disabled>Pilih Pertanyaan</option>
                                        <option value="Siapa Nama Orang Tua Anda?">Siapa Nama Ayah Anda?</option>
                                        <option value="Siapa Nama Ibu Anda?">Siapa Nama Ibu Anda?</option>
                                        <option value="Apa Nama Hewan Peliharaan Anda?">Apa Nama Hewan Peliharaan Anda?</option>           
                                        <option value="Siapa nama lengkap guru favoritmu di sekolah?">Siapa nama lengkap guru favoritmu di sekolah?</option>           
                                        <option value="Apa judul buku favoritmu?">Apa judul buku favoritmu?</option>           
                                        <option value="Siapa nama teman sebangkumu di kelas?">Apa nama teman sebangkumu di kelas?</option>           
                                        <option value="Apa warna kesukaanmu?">Apa warna kesukaanmu?</option>           
                                        <option value="Apa nama sekolah taman kanak-kanakmu?">Apa nama sekolah taman kanak-kanakmu?</option>           
                                        <option value="Apa nama panggilan kesayangan keluargamu?">Apa nama panggilan kesayangan keluargamu?</option>           
                                        <option value="Apa nama jalan tempat tinggalmu?">Apa nama jalan tempat tinggalmu?</option>           
                                        <option value="Apa nama kota tempatmu lahir?">Apa nama kota tempatmu lahir?</option>           
                                        <option value="Apa nama mainan favoritmu?">Apa nama mainan favoritmu?</option>           
                                        <option value="lainnya_1">Lainnya</option>
                                    </select>
                                    <div id="containerLain1" style="display:none; margin-top:10px;">
                                        <input type="text" class="form-control" name="pertanyaanLain1" id="pertanyaanLain1" placeholder="Masukkan pertanyaan lainnya">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label>Jawaban 1</label>
                                    <input type="text" class="form-control" name="jawaban_1" id="jawaban_1" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">    
                                <div class="form-group">
                                <label>Pertanyaan 2</label>
                                    <select class="form-control" name="pertanyaan_2" id="pertanyaan_2" onchange="toggleInputField2()" required>
                                        <option value="" selected hidden disabled>Pilih Pertanyaan</option>
                                        <option value="Siapa Nama Orang Tua Anda?">Siapa Nama Ayah Anda?</option>
                                        <option value="Siapa Nama Ibu Anda?">Siapa Nama Ibu Anda?</option>
                                        <option value="Apa Nama Hewan Peliharaan Anda?">Apa Nama Hewan Peliharaan Anda?</option>           
                                        <option value="Siapa nama lengkap guru favoritmu di sekolah?">Siapa nama lengkap guru favoritmu di sekolah?</option>           
                                        <option value="Apa judul buku favoritmu?">Apa judul buku favoritmu?</option>           
                                        <option value="Siapa nama teman sebangkumu di kelas?">Apa nama teman sebangkumu di kelas?</option>           
                                        <option value="Apa warna kesukaanmu?">Apa warna kesukaanmu?</option>           
                                        <option value="Apa nama sekolah taman kanak-kanakmu?">Apa nama sekolah taman kanak-kanakmu?</option>           
                                        <option value="Apa nama panggilan kesayangan keluargamu?">Apa nama panggilan kesayangan keluargamu?</option>           
                                        <option value="Apa nama jalan tempat tinggalmu?">Apa nama jalan tempat tinggalmu?</option>           
                                        <option value="Apa nama kota tempatmu lahir?">Apa nama kota tempatmu lahir?</option>           
                                        <option value="Apa nama mainan favoritmu?">Apa nama mainan favoritmu?</option>     
                                        <option value="lainnya_2">Lainnya</option>
                                    </select>
                                    <div id="containerLain2" style="display:none; margin-top:10px;">
                                        <input type="text" class="form-control" name="pertanyaanLain2" id="pertanyaanLain2" placeholder="Masukkan pertanyaan lainnya">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">    
                                <div class="form-group">
                                <label>Jawaban 2</label>
                                <input type="text" class="form-control" name="jawaban_2" id="jawaban_2" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label>Pertanyaan 3</label>
                                    <select class="form-control" name="pertanyaan_3" id="pertanyaan_3" onchange="toggleInputField3()" required>
                                        <option value="" selected hidden disabled>Pilih Pertanyaan</option>
                                        <option value="Siapa Nama Orang Tua Anda?">Siapa Nama Ayah Anda?</option>
                                        <option value="Siapa Nama Ibu Anda?">Siapa Nama Ibu Anda?</option>
                                        <option value="Apa Nama Hewan Peliharaan Anda?">Apa Nama Hewan Peliharaan Anda?</option>  
                                        <option value="Siapa nama lengkap guru favoritmu di sekolah?">Siapa nama lengkap guru favoritmu di sekolah?</option>           
                                        <option value="Apa judul buku favoritmu?">Apa judul buku favoritmu?</option>           
                                        <option value="Siapa nama teman sebangkumu di kelas?">Apa nama teman sebangkumu di kelas?</option>           
                                        <option value="Apa warna kesukaanmu?">Apa warna kesukaanmu?</option>           
                                        <option value="Apa nama sekolah taman kanak-kanakmu?">Apa nama sekolah taman kanak-kanakmu?</option>           
                                        <option value="Apa nama panggilan kesayangan keluargamu?">Apa nama panggilan kesayangan keluargamu?</option>           
                                        <option value="Apa nama jalan tempat tinggalmu?">Apa nama jalan tempat tinggalmu?</option>           
                                        <option value="Apa nama kota tempatmu lahir?">Apa nama kota tempatmu lahir?</option>           
                                        <option value="Apa nama mainan favoritmu?">Apa nama mainan favoritmu?</option>              
                                        <option value="lainnya_3">Lainnya</option>
                                    </select>    
                                    <div id="containerLain3" style="display:none; margin-top:10px;">
                                        <input type="text" class="form-control" name="pertanyaanLain3" id="pertanyaanLain3" placeholder="Masukkan pertanyaan lainnya">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label for="password_confirm">Jawaban 3</label>
                                    <input type="text" class="form-control" name="jawaban_3" id="jawaban_3" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label>Pertanyaan 4 (Opsional)</label>
                                    <select class="form-control" name="pertanyaan_4" id="pertanyaan_4" onchange="toggleInputField4()">
                                        <option value="" selected hidden>Pilih Pertanyaan</option>
                                        <option value="Siapa Nama Orang Tua Anda?">Siapa Nama Ayah Anda?</option>
                                        <option value="Siapa Nama Ibu Anda?">Siapa Nama Ibu Anda?</option>
                                        <option value="Apa Nama Hewan Peliharaan Anda?">Apa Nama Hewan Peliharaan Anda?</option>           
                                        <option value="Siapa nama lengkap guru favoritmu di sekolah?">Siapa nama lengkap guru favoritmu di sekolah?</option>           
                                        <option value="Apa judul buku favoritmu?">Apa judul buku favoritmu?</option>           
                                        <option value="Siapa nama teman sebangkumu di kelas?">Apa nama teman sebangkumu di kelas?</option>           
                                        <option value="Apa warna kesukaanmu?">Apa warna kesukaanmu?</option>           
                                        <option value="Apa nama sekolah taman kanak-kanakmu?">Apa nama sekolah taman kanak-kanakmu?</option>           
                                        <option value="Apa nama panggilan kesayangan keluargamu?">Apa nama panggilan kesayangan keluargamu?</option>           
                                        <option value="Apa nama jalan tempat tinggalmu?">Apa nama jalan tempat tinggalmu?</option>           
                                        <option value="Apa nama kota tempatmu lahir?">Apa nama kota tempatmu lahir?</option>           
                                        <option value="Apa nama mainan favoritmu?">Apa nama mainan favoritmu?</option>     
                                        <option value="lainnya_4">Lainnya</option>
                                    </select>
                                    <div id="containerLain4" style="display:none; margin-top:10px;">
                                        <input type="text" class="form-control" name="pertanyaanLain4" id="pertanyaanLain4" placeholder="Masukkan pertanyaan lainnya">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label for="password_confirm">Jawaban 4</label>
                                    <input type="text" class="form-control" name="jawaban_4" id="jawaban_4">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label>Pertanyaan 5 (Opsional)</label>
                                    <select class="form-control" name="pertanyaan_5" id="pertanyaan_5" onchange="toggleInputField5()">
                                        <option value="" selected hidden>Pilih Pertanyaan</option>
                                        <option value="Siapa Nama Orang Tua Anda?">Siapa Nama Ayah Anda?</option>
                                        <option value="Siapa Nama Ibu Anda?">Siapa Nama Ibu Anda?</option>
                                        <option value="Apa Nama Hewan Peliharaan Anda?">Apa Nama Hewan Peliharaan Anda?</option>
                                        <option value="Siapa nama lengkap guru favoritmu di sekolah?">Siapa nama lengkap guru favoritmu di sekolah?</option>           
                                        <option value="Apa judul buku favoritmu?">Apa judul buku favoritmu?</option>           
                                        <option value="Siapa nama teman sebangkumu di kelas?">Apa nama teman sebangkumu di kelas?</option>           
                                        <option value="Apa warna kesukaanmu?">Apa warna kesukaanmu?</option>           
                                        <option value="Apa nama sekolah taman kanak-kanakmu?">Apa nama sekolah taman kanak-kanakmu?</option>           
                                        <option value="Apa nama panggilan kesayangan keluargamu?">Apa nama panggilan kesayangan keluargamu?</option>           
                                        <option value="Apa nama jalan tempat tinggalmu?">Apa nama jalan tempat tinggalmu?</option>           
                                        <option value="Apa nama kota tempatmu lahir?">Apa nama kota tempatmu lahir?</option>           
                                        <option value="Apa nama mainan favoritmu?">Apa nama mainan favoritmu?</option>     
                                        <option value="lainnya_5">Lainnya</option>
                                    </select>
                                    <div id="containerLain5" style="display:none; margin-top:10px;">
                                        <input type="text" class="form-control" name="pertanyaanLain5" id="pertanyaanLain5" placeholder="Masukkan pertanyaan lainnya">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label for="password_confirm">Jawaban 5</label>
                                    <input type="text" class="form-control" name="jawaban_5" id="jawaban_5">
                                </div>
                            </div>
                        </div>
                        <div class=" row">
                            <div class="col-12 col-sm-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                <?php }else{ ?>
                    <form class="" action="<?= base_url() ?>saveForgot" id="form" method="post">
                        <input type="hidden" class="form-control" name="id_users" id="id_users" value="<?= session()->get('id') ?>">
                        <div class="row">
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label>Pertanyaan 1</label>
                                    <select class="form-control" name="pertanyaan_1" id="pertanyaan_1" onchange="toggleInputField1()" required>
                                        <option value="" selected hidden disabled>Pilih Pertanyaan</option>
                                        <option value="Siapa Nama Orang Tua Anda?">Siapa Nama Ayah Anda?</option>
                                        <option value="Siapa Nama Ibu Anda?">Siapa Nama Ibu Anda?</option>
                                        <option value="Apa Nama Hewan Peliharaan Anda?">Apa Nama Hewan Peliharaan Anda?</option>           
                                        <option value="Siapa nama lengkap guru favoritmu di sekolah?">Siapa nama lengkap guru favoritmu di sekolah?</option>           
                                        <option value="Apa judul buku favoritmu?">Apa judul buku favoritmu?</option>           
                                        <option value="Siapa nama teman sebangkumu di kelas?">Apa nama teman sebangkumu di kelas?</option>           
                                        <option value="Apa warna kesukaanmu?">Apa warna kesukaanmu?</option>           
                                        <option value="Apa nama sekolah taman kanak-kanakmu?">Apa nama sekolah taman kanak-kanakmu?</option>           
                                        <option value="Apa nama panggilan kesayangan keluargamu?">Apa nama panggilan kesayangan keluargamu?</option>           
                                        <option value="Apa nama jalan tempat tinggalmu?">Apa nama jalan tempat tinggalmu?</option>           
                                        <option value="Apa nama kota tempatmu lahir?">Apa nama kota tempatmu lahir?</option>           
                                        <option value="Apa nama mainan favoritmu?">Apa nama mainan favoritmu?</option>           
                                        <option value="lainnya_1">Lainnya</option>
                                    </select>
                                    <div id="containerLain1" style="display:none; margin-top:10px;">
                                        <input type="text" class="form-control" name="pertanyaanLain1" id="pertanyaanLain1" placeholder="Masukkan pertanyaan lainnya">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label>Jawaban 1</label>
                                    <input type="text" class="form-control" name="jawaban_1" id="jawaban_1" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">    
                                <div class="form-group">
                                <label>Pertanyaan 2</label>
                                    <select class="form-control" name="pertanyaan_2" id="pertanyaan_2" onchange="toggleInputField2()" required>
                                        <option value="" selected hidden disabled>Pilih Pertanyaan</option>
                                        <option value="Siapa Nama Orang Tua Anda?">Siapa Nama Ayah Anda?</option>
                                        <option value="Siapa Nama Ibu Anda?">Siapa Nama Ibu Anda?</option>
                                        <option value="Apa Nama Hewan Peliharaan Anda?">Apa Nama Hewan Peliharaan Anda?</option>           
                                        <option value="Siapa nama lengkap guru favoritmu di sekolah?">Siapa nama lengkap guru favoritmu di sekolah?</option>           
                                        <option value="Apa judul buku favoritmu?">Apa judul buku favoritmu?</option>           
                                        <option value="Siapa nama teman sebangkumu di kelas?">Apa nama teman sebangkumu di kelas?</option>           
                                        <option value="Apa warna kesukaanmu?">Apa warna kesukaanmu?</option>           
                                        <option value="Apa nama sekolah taman kanak-kanakmu?">Apa nama sekolah taman kanak-kanakmu?</option>           
                                        <option value="Apa nama panggilan kesayangan keluargamu?">Apa nama panggilan kesayangan keluargamu?</option>           
                                        <option value="Apa nama jalan tempat tinggalmu?">Apa nama jalan tempat tinggalmu?</option>           
                                        <option value="Apa nama kota tempatmu lahir?">Apa nama kota tempatmu lahir?</option>           
                                        <option value="Apa nama mainan favoritmu?">Apa nama mainan favoritmu?</option>     
                                        <option value="lainnya_2">Lainnya</option>
                                    </select>
                                    <div id="containerLain2" style="display:none; margin-top:10px;">
                                        <input type="text" class="form-control" name="pertanyaanLain2" id="pertanyaanLain2" placeholder="Masukkan pertanyaan lainnya">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">    
                                <div class="form-group">
                                <label>Jawaban 2</label>
                                <input type="text" class="form-control" name="jawaban_2" id="jawaban_2" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label>Pertanyaan 3</label>
                                    <select class="form-control" name="pertanyaan_3" id="pertanyaan_3" onchange="toggleInputField3()" required>
                                        <option value="" selected hidden disabled>Pilih Pertanyaan</option>
                                        <option value="Siapa Nama Orang Tua Anda?">Siapa Nama Ayah Anda?</option>
                                        <option value="Siapa Nama Ibu Anda?">Siapa Nama Ibu Anda?</option>
                                        <option value="Apa Nama Hewan Peliharaan Anda?">Apa Nama Hewan Peliharaan Anda?</option>  
                                        <option value="Siapa nama lengkap guru favoritmu di sekolah?">Siapa nama lengkap guru favoritmu di sekolah?</option>           
                                        <option value="Apa judul buku favoritmu?">Apa judul buku favoritmu?</option>           
                                        <option value="Siapa nama teman sebangkumu di kelas?">Apa nama teman sebangkumu di kelas?</option>           
                                        <option value="Apa warna kesukaanmu?">Apa warna kesukaanmu?</option>           
                                        <option value="Apa nama sekolah taman kanak-kanakmu?">Apa nama sekolah taman kanak-kanakmu?</option>           
                                        <option value="Apa nama panggilan kesayangan keluargamu?">Apa nama panggilan kesayangan keluargamu?</option>           
                                        <option value="Apa nama jalan tempat tinggalmu?">Apa nama jalan tempat tinggalmu?</option>           
                                        <option value="Apa nama kota tempatmu lahir?">Apa nama kota tempatmu lahir?</option>           
                                        <option value="Apa nama mainan favoritmu?">Apa nama mainan favoritmu?</option>              
                                        <option value="lainnya_3">Lainnya</option>
                                    </select>    
                                    <div id="containerLain3" style="display:none; margin-top:10px;">
                                        <input type="text" class="form-control" name="pertanyaanLain3" id="pertanyaanLain3" placeholder="Masukkan pertanyaan lainnya">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label for="password_confirm">Jawaban 3</label>
                                    <input type="text" class="form-control" name="jawaban_3" id="jawaban_3" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label>Pertanyaan 4 (Opsional)</label>
                                    <select class="form-control" name="pertanyaan_4" id="pertanyaan_4" onchange="toggleInputField4()">
                                        <option value="" selected hidden>Pilih Pertanyaan</option>
                                        <option value="Siapa Nama Orang Tua Anda?">Siapa Nama Ayah Anda?</option>
                                        <option value="Siapa Nama Ibu Anda?">Siapa Nama Ibu Anda?</option>
                                        <option value="Apa Nama Hewan Peliharaan Anda?">Apa Nama Hewan Peliharaan Anda?</option>           
                                        <option value="Siapa nama lengkap guru favoritmu di sekolah?">Siapa nama lengkap guru favoritmu di sekolah?</option>           
                                        <option value="Apa judul buku favoritmu?">Apa judul buku favoritmu?</option>           
                                        <option value="Siapa nama teman sebangkumu di kelas?">Apa nama teman sebangkumu di kelas?</option>           
                                        <option value="Apa warna kesukaanmu?">Apa warna kesukaanmu?</option>           
                                        <option value="Apa nama sekolah taman kanak-kanakmu?">Apa nama sekolah taman kanak-kanakmu?</option>           
                                        <option value="Apa nama panggilan kesayangan keluargamu?">Apa nama panggilan kesayangan keluargamu?</option>           
                                        <option value="Apa nama jalan tempat tinggalmu?">Apa nama jalan tempat tinggalmu?</option>           
                                        <option value="Apa nama kota tempatmu lahir?">Apa nama kota tempatmu lahir?</option>           
                                        <option value="Apa nama mainan favoritmu?">Apa nama mainan favoritmu?</option>     
                                        <option value="lainnya_4">Lainnya</option>
                                    </select>
                                    <div id="containerLain4" style="display:none; margin-top:10px;">
                                        <input type="text" class="form-control" name="pertanyaanLain4" id="pertanyaanLain4" placeholder="Masukkan pertanyaan lainnya">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label for="password_confirm">Jawaban 4</label>
                                    <input type="text" class="form-control" name="jawaban_4" id="jawaban_4">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label>Pertanyaan 5 (Opsional)</label>
                                    <select class="form-control" name="pertanyaan_5" id="pertanyaan_5" onchange="toggleInputField5()">
                                        <option value="" selected hidden>Pilih Pertanyaan</option>
                                        <option value="Siapa Nama Orang Tua Anda?">Siapa Nama Ayah Anda?</option>
                                        <option value="Siapa Nama Ibu Anda?">Siapa Nama Ibu Anda?</option>
                                        <option value="Apa Nama Hewan Peliharaan Anda?">Apa Nama Hewan Peliharaan Anda?</option>
                                        <option value="Siapa nama lengkap guru favoritmu di sekolah?">Siapa nama lengkap guru favoritmu di sekolah?</option>           
                                        <option value="Apa judul buku favoritmu?">Apa judul buku favoritmu?</option>           
                                        <option value="Siapa nama teman sebangkumu di kelas?">Apa nama teman sebangkumu di kelas?</option>           
                                        <option value="Apa warna kesukaanmu?">Apa warna kesukaanmu?</option>           
                                        <option value="Apa nama sekolah taman kanak-kanakmu?">Apa nama sekolah taman kanak-kanakmu?</option>           
                                        <option value="Apa nama panggilan kesayangan keluargamu?">Apa nama panggilan kesayangan keluargamu?</option>           
                                        <option value="Apa nama jalan tempat tinggalmu?">Apa nama jalan tempat tinggalmu?</option>           
                                        <option value="Apa nama kota tempatmu lahir?">Apa nama kota tempatmu lahir?</option>           
                                        <option value="Apa nama mainan favoritmu?">Apa nama mainan favoritmu?</option>     
                                        <option value="lainnya_5">Lainnya</option>
                                    </select>
                                    <div id="containerLain5" style="display:none; margin-top:10px;">
                                        <input type="text" class="form-control" name="pertanyaanLain5" id="pertanyaanLain5" placeholder="Masukkan pertanyaan lainnya">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label for="password_confirm">Jawaban 5</label>
                                    <input type="text" class="form-control" name="jawaban_5" id="jawaban_5">
                                </div>
                            </div>
                        </div>
                        <div class=" row">
                            <div class="col-12 col-sm-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('form');

            form.addEventListener('submit', function(event) {
                event.preventDefault();
                
                // Ambil nilai input
                const password = document.getElementById('password').value;
                const password_confirm = document.getElementById('password_confirm').value;

                // Validasi karakter minimal
                if (password.length < 6 || password_confirm < 6) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Password harus memiliki minimal 6 karakter.',
                    });
                }else if(password !== password_confirm){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Password dan konfirmasi password tidak sama.',
                    });
                }else{
                    form.submit();
                }
            });
        });
    </script> -->

    <script>
        function toggleInputField1() {
            var selectElement1 = document.getElementById('pertanyaan_1');
            var containerLain1 = document.getElementById('containerLain1');
            var inputField = document.getElementById('pertanyaanLain1');
            if (selectElement1.value === 'lainnya_1') {
                containerLain1.style.display = 'block';
                inputField.value = '';
                inputField.setAttribute('required', 'true');
            } else {
                containerLain1.style.display = 'none';
                inputField.value = selectElement1.value;
            
            }
    
        }

        function toggleInputField2() {
            var selectElement2 = document.getElementById('pertanyaan_2');
            var containerLain2 = document.getElementById('containerLain2');
            var inputField = document.getElementById('pertanyaanLain2');
            if (selectElement2.value === 'lainnya_2') {
                containerLain2.style.display = 'block';
                inputField.value = '';
                inputField.setAttribute('required', 'true');
            } else {
                containerLain2.style.display = 'none';
                inputField.value = selectElement2.value;
            }
        }

        function toggleInputField3() {
            var selectElement3 = document.getElementById('pertanyaan_3');
            var containerLain3 = document.getElementById('containerLain3');
            var inputField = document.getElementById('pertanyaanLain3');
            if (selectElement3.value === 'lainnya_3') {
                containerLain3.style.display = 'block';
                inputField.value = '';
                inputField.setAttribute('required', 'true');
            } else {
                containerLain3.style.display = 'none';
                inputField.value = selectElement3.value;
            }
        }

        function toggleInputField4() {
            var selectElement4 = document.getElementById('pertanyaan_4');
            var containerLain4 = document.getElementById('containerLain4');
            var inputField = document.getElementById('pertanyaanLain4');

            if (selectElement4.value === 'lainnya_4') {
                containerLain4.style.display = 'block';
                inputField.value = '';
                inputField.setAttribute('required', 'true');
            } else {
                containerLain4.style.display = 'none';
                inputField.value = selectElement4.value;
            }
        }

        function toggleInputField5() {
            var selectElement5 = document.getElementById('pertanyaan_5');
            var containerLain5 = document.getElementById('containerLain5');
            var inputField = document.getElementById('pertanyaanLain5');
            if (selectElement5.value === 'lainnya_5') {
                containerLain5.style.display = 'block';
                inputField.value = '';
                inputField.setAttribute('required', 'true');
            } else {
                containerLain5.style.display = 'none';
                inputField.value = selectElement5.value;
            }
        }
</script>

<?= $this->endSection()?>







     
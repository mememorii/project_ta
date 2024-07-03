<?= $this->extend('layout_user/master') ?>
<?= $this->section('content') ?>
<div class="container-fluid" style="padding-left:99px;padding-right:99px">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Feedback</h3>
              </div>
        <form action="<?= base_url() ?>crm/store" method="post" enctype="multipart/form-data">
          <input type="hidden" id="id_referensi" name="id_referensi" value="<?= session()->get('id_referensi') ?>">
          <input type="hidden" id="jenis_id" name="jenis_id" value="<?= session()->get('role') ?>">
          <input type="hidden" id="user_create" name="user_create" value="<?= session()->get('firstname') ?>">
          <div class="card-body">
            <!-- <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                    <label>Kode</label>
                    <input required type="text" class="form-control" name="kode_crm" id="kode_crm" readonly>
                  </div>
              </div>   
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tipe</label>
                  <select class="form-control" style="width: 100%;" name="tipe_crm" id="tipe_crm" required>
                    <option value="" selected hidden disabled>Pilih</option>
                    <option value="Saran">Saran</option>
                    <option value="Kritik">Kritik</option>
                    <option value="Kritik">Keluhan</option>
                    <option value="Kritik">Masukan</option>
                  </select>
                </div>
              </div>  
            </div> -->
            <div class="form-group">
                <label>Judul</label>
                <input required type="text" class="form-control" name="judul" id="judul">
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" class="form-control"  required></textarea>
            </div>
            <div class="form-group">
              <label>Foto (Opsional)</label>
              <input type="file" name="fileuploads[]" class="form-control" multiple >
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection()?>
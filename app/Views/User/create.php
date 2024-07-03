<?= $this->extend('layout_user/master') ?>
<?= $this->section('content') ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Detail</h3>
          </div>
            <form action="<?= base_url() ?>kritik/store" method="post">
              <input type="hidden" name="id_crm">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Username</label>
                      <input required type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input required type="password" class="form-control" name="password" id="username">
                    </div>
                  </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Tanggal</label>
                        <input required type="date" class="form-control" name="tanggal" id="tanggal">
                      </div>
                    </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Tipe Crm</label>
                      <select class="form-control" style="width: 100%;" name="tipe_crm" id="tipe_crm" required>
                        <option value="" selected hidden disabled>Pilih</option>
                        <option value="Saran">Saran</option>
                        <option value="Kritik">Kritik</option>
                      </select>
                    </div>
                  </div>  
                </div>
                <div class="form-group">
                    <label>Judul</label>
                    <input required type="text" class="form-control" name="judul" id="judul">
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" class="form-control"  required></textarea>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea id="keterangan" name="keterangan" rows="4" class="form-control"  required></textarea>
                </div>
    </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

  <script>
    $(document).ready(function(){
      $.ajax({
        url:'<?=site_url()?>/kritik/kode',
        type:'GET',
        success:function(hasil){
          console.log(hasil)
          var obj = $.parseJSON(hasil);
          $('#kode_crm').val(obj);
        }
      });
    });
  </script>
  <script>
  var sel1 = document.querySelector('#jenis_user');
  var sel2 = document.querySelector('#id_referensi');
  var options2 = sel2.querySelectorAll('option');

  function giveSelection(selValue) {
    sel2.innerHTML = '';
    for(var i = 0; i < options2.length; i++) {
      if(options2[i].dataset.option === selValue) {
        sel2.appendChild(options2[i]);
      }
    }
  }

  giveSelection(sel1.value);
  </script>
        </div>
      </div>
    </div>
  </div>


<?= $this->endSection()?>
<div class="content-header">
      <div class="container">
        <?php if (isset($back)): ?>
          <a href="javascript:history.back()" class="btn btn-primary"><i class="nav-icon fa-solid fa-circle-chevron-left"></i><span class="ml-2">Kembali</span></a><br><br>
        <?php endif; ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= $title?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <?php if (session()->get('role') == 3) { ?>    
                  <a href="<?= base_url('siswa/dashboard') ?>">Home</a>
                <?php }else{ ?> 
                  <a href="<?= base_url('wali/dashboard') ?>">Home</a>
                <?php } ?>
              </li>
              <li class="breadcrumb-item active"><?= $menu?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
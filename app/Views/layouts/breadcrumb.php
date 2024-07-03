
<div class="content-header">
      <div class="container-fluid">
        <?php if (isset($back)): ?>
          <a href="javascript:history.back()" class="btn btn-primary"><i class="nav-icon fa-solid fa-circle-chevron-left"></i><span class="ml-2">Kembali</span></a><br><br>
        <?php endif; ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= $title?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <?php if (session()->get('role') == 1) { ?>  
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
            <?php }else{ ?>
              <li class="breadcrumb-item"><a href="<?= base_url('guru/dashboard') ?>">Home</a></li>
            <?php } ?>
            <li class="breadcrumb-item active "><?= $menu?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
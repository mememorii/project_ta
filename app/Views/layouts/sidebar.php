<style>
.nav-pills .nav-link.active, .nav-pills .show > .nav-link {
        color: #F0F8FF;
        background-color: #7bb3ff !important;
    }
</style>
 <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:#0d3b66">
    <!-- Brand Logo -->
    <?php if(session()->get('role') == 1){ ?>
      <a href="<?= base_url('admin/dashboard') ?>" class="brand-link">
    <?php }else{ ?>
      <a href="<?= base_url('guru/dashboard') ?>" class="brand-link">
    <?php } ?>
        <img src="<?= base_url()?>public/assets/dist/img/83790f2b43f00be.png" alt="TUT WURI HANDAYANI Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>SIPESANTIK</b></span>
      </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="<?= base_url()?>public/assets/dist/img/profile-icon-design-free-vector.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="<?= base_url () ?>user/profile/<?= session()->get('id_referensi') ?>" class="d-block"><?= session()->get('nama') ?></a>
            </div>
      </div>  
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <?php if (session()->get('role') == 1){ ?>
              <a href="<?= base_url ('admin/dashboard') ?>" class="nav-link <?= $menu=='Dashboard' ? 'active' : ''; ?>" >
            <?php }else{ ?>
              <a href="<?= base_url ('guru/dashboard') ?>" class="nav-link <?= $menu=='Dashboard' ? 'active' : ''; ?>" >
            <?php }?>
            <i class="nav-icon fa-solid fa-house"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php if (session()->get('role') == '2') {  ?>
          <li class="nav-item">
            <a href="<?= base_url ('crm') ?>" class="nav-link <?= $menu=='Feedback' ? 'active' : ''; ?>" >
            <i class="nav-icon fa-solid fa-file-invoice"></i>
              <p>
                Feedback
              </p>
            </a>
          </li>
          <?php }else{} ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-solid fa-database"></i>
              <p>
               Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
              <?php if (session()->get('role') == 1){ ?>
                <a href="<?= base_url ('admin/guru') ?>" class="nav-link <?= $menu=='Data Guru' ? 'active' : ''; ?>" >
              <?php }else{ ?>
                  <a href="<?= base_url ('guru/guru') ?>" class="nav-link <?= $menu=='Data Guru' ? 'active' : ''; ?>" >
              <?php }?>
                <i class="nav-icon fa-solid fa-chalkboard-user"></i>
                  <p>
                    Data Guru
                  </p>
                </a>
            </li>
            <li class="nav-item">
            <?php if (session()->get('role') == 1){ ?>
              <a href="<?= base_url ('admin/siswa') ?>" class="nav-link <?= $menu=='Data Siswa' ? 'active' : ''; ?>" >
            <?php }else{ ?>
              <a href="<?= base_url ('guru/siswa') ?>" class="nav-link <?= $menu=='Data Siswa' ? 'active' : ''; ?>" >
            <?php }?>
            <i class="nav-icon fa-solid fa-user"></i>
              <p>
                Data Siswa
              </p>
            </a>
          </li>
          <li class="nav-item">
          <?php if (session()->get('role') == 1){ ?>
            <a href="<?= base_url ('admin/wali') ?>" class="nav-link <?= $menu=='Data Wali Siswa' ? 'active' : ''; ?>" >
          <?php }else{ ?>
              <a href="<?= base_url ('guru/wali') ?>" class="nav-link <?= $menu=='Data Wali Siswa' ? 'active' : ''; ?>" >
          <?php }?>
            <i class="nav-icon fa-solid fa-person-breastfeeding"></i>
              <p>
                Data Wali Siswa
              </p>
            </a>
          </li>  
          <?php if (session()->get('role') == '1') { ?>
            <li class="nav-item">
              <a href="<?= base_url ('user') ?>" class="nav-link <?= $menu=='Data User Account' ? 'active' : ''; ?>" >
              <i class="nav-icon fa-solid fa-id-badge"></i>
                <p>
                  Data User Account
                </p>
              </a>
            </li>
          <?php }else{} ?>
        </ul>
          </li>
          <li class="nav-item">
              <a href="<?= base_url ('logout') ?>" class="nav-link <?= $menu=='' ? 'active' : ''; ?>" >
              <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                <p>
                  Logout
                </p>
              </a>
          </li>     
        </ul>
      </nav>
    </div>
  </aside>
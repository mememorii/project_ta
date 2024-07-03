<style>
.light{
    background-color:#7bb3ff;
}
.navbar{
    
}
</style>

<div class="px-4 py-5 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 text-white" style="background-color:#0d3b66;">
  <div class="relative flex items-center justify-between">
    <div class="flex items-center">
      <?php if (session()->get('role') == 3){ ?>
        <a href="<?= base_url('siswa/dashboard') ?>" aria-label="Company" title="Company" class="inline-flex items-center mr-8">
      <?php }elseif(session()->get('role') == 4){ ?>
        <a href="<?= base_url('wali/dashboard') ?>" aria-label="Company" title="Company" class="inline-flex items-center mr-8">
      <?php }?>
          <div class="logo">
            <img src="<?= base_url()?>public/assets/dist/img/83790f2b43f00be.png" alt="TUT WURI HANDAYANI Logo" class="h-16 w-auto">
          </div>
          <span class="ml-2 text-xl font-bold tracking-wide uppercase">SIPESANTIK</span>
        </a>
      <ul class="flex items-center hidden space-x-8 lg:flex">
        <?php if (session()->get('role') == 3){ ?>
            <li><a href="<?= base_url('siswa/dashboard') ?>" aria-label="Our product" title="Our product" class="font-medium tracking-wide transition-colors duration-200 hover:text-deep-purple-accent-400">Home</a></li>
        <?php }elseif(session()->get('role') == 4){ ?>
            <li><a href="<?= base_url('wali/dashboard') ?>" aria-label="Our product" title="Our product" class="font-medium tracking-wide transition-colors duration-200 hover:text-deep-purple-accent-400">Home</a></li>
        <?php }?>
        <li>
          <?php if (session()->get('role') == 3){ ?>
            <a href="<?= base_url('siswa/crm') ?>" aria-label="Our product" title="Our product" class="font-medium tracking-wide transition-colors duration-200 hover:text-deep-purple-accent-400">Feedback</a>
          <?php }elseif(session()->get('role') == 4){ ?>
            <a href="<?= base_url('wali/crm') ?>" aria-label="Our product" title="Our product" class="font-medium tracking-wide transition-colors duration-200 hover:text-deep-purple-accent-400">Feedback</a>
          <?php }?>
        </li>
      </ul>
    </div>
    <ul class="flex items-center hidden space-x-8 lg:flex">
        <li>
            <?php if(session()->role == 3){ ?>
                <a
                href="<?= base_url("siswa/crm/create") ?>"
                class="light inline-flex items-center justify-center h-12 px-6 font-medium tracking-wide text-white transition duration-200 rounded shadow-md ocus:shadow-outline focus:outline-none"
                aria-label="Sign up"
                title="Sign up"
                >
                <i class="fa-solid fa-circle-plus" style="padding-right:10px;padding-top:3px;"></i>Open Tiket
                </a>
            <?php }else{ ?>
                <a
                href="<?= base_url("wali/crm/create") ?>"
                class="light inline-flex items-center justify-center h-12 px-6 font-medium tracking-wide text-white transition duration-200 rounded shadow-md ocus:shadow-outline focus:outline-none"
                aria-label="Sign up"
                title="Sign up"
                >
                <i class="fa-solid fa-circle-plus" style="padding-right:10px;padding-top:3px;"></i>Open Ticket
                </a>
            <?php } ?>
        </li>
        <li>
          <div class="relative inline-block text-left">
            <div>
              <button type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="false" aria-haspopup="true">
                <?= session()->get('nama') ?>
                <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                </svg>
              </button>
            </div>
            <div class="hidden absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" id="dropdown-menu">
              <div class="py-1" role="none">
                <a href="<?= base_url () ?>user/profile/<?= session()->get('id_referensi') ?>" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Profile</a>
                <a href="<?= base_url('logout') ?>" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-1">Logout</a>
              </div>
            </div>
          </div>
        </li>
    </ul>
  </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
      const menuButton = document.getElementById('menu-button');
      const dropdownMenu = document.getElementById('dropdown-menu');

      // Ensure the dropdown menu is hidden initially
      dropdownMenu.classList.add('hidden');

      menuButton.addEventListener('click', function() {
        dropdownMenu.classList.toggle('hidden');
        menuButton.setAttribute('aria-expanded', dropdownMenu.classList.contains('hidden') ? 'false' : 'true');
      });

      window.addEventListener('click', function(e) {
        if (!menuButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
          dropdownMenu.classList.add('hidden');
          menuButton.setAttribute('aria-expanded', 'false');
        }
      });
    });
  </script>
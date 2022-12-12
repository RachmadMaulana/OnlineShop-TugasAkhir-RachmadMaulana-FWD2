   <!-- Sidebar -->
   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

       <!-- Sidebar - Brand -->
       <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('manajer/dashboard') ?>">
           <div class="sidebar-brand-icon">
               <i class="fa-solid fa-fw fa-shop"></i>
           </div>
           <div class="sidebar-brand-text mx-3">Toko RahNik</div>
       </a>

       <!-- Divider -->



       <hr class="sidebar-divider">

       <?php

        $role_id = $this->session->userdata['role_id'];

        $queryMenu = "
            SELECT um.id,um.menu
            FROM user_menu um
            INNER JOIN user_acces_menu uam
            ON um.id = uam.menu_id
            WHERE uam.role_id = $role_id
            ORDER BY uam.menu_id ASC
            ";

        $menu = $this->db->query($queryMenu)->result_array();
        ?>

       <?php foreach ($menu as $m) :  ?>
           <div class="sidebar-heading">
               <?= $m['menu']; ?>
           </div>
           <?php
            $menuId = $m['id'];
            $querySubMenu = "
                    SELECT sb.*
                    FROM user_sub_menu sb
                    JOIN user_menu um
                    ON sb.menu_id = um.id
                    WHERE sb.menu_id = $menuId
                    ";
            $subMenu = $this->db->query($querySubMenu)->result_array();
            ?>

           <?php foreach ($subMenu as $sb) :  ?>
               <li class="nav-item <?= $title == $sb['title'] ? 'active' : ''; ?>">
                   <a class="nav-link" href="<?= base_url($sb['url']); ?>">
                       <i class="<?= $sb['icon']; ?>"></i>
                       <span><?= $sb['title']; ?></span></a>
               </li>

           <?php endforeach; ?>
           <hr class="sidebar-divider">
       <?php endforeach; ?>

       <!-- Nav Item - Dashboard -->


       <!-- Divider -->


       <!-- Heading -->

       <!-- Nav Item - Pages Collapse Menu -->

       <!-- Divider -->
       <hr class="sidebar-divider d-none d-md-block">

       <!-- Sidebar Toggler (Sidebar) -->
       <div class="text-center d-none d-md-inline">
           <button class="rounded-circle border-0" id="sidebarToggle"></button>
       </div>



   </ul>
   <!-- End of Sidebar -->
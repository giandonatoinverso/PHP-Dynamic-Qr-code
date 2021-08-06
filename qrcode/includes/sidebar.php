
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="./index.php" class="brand-link" style="text-align:center; padding:0">
      <img src="dist/img/logo_horizontal_blanco_expressionway.png" alt="Logo" class="brand-image"
           style="opacity: .8; margin-right:auto; margin-left:auto; text-align:center; float:none; max-height:90px">
      <!--span class="brand-text font-weight-light">QR</span-->
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="margin-top: calc(6.5rem + 1px);">
       <!--Sidebar user panel (optional) 
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Superadmin</a>
        </div>
      </div>

      -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <li class="nav-item">
           <a href="./index.php" <?php echo (CURRENT_PAGE == 'index.php') ? ' class="nav-link active"' : ' class="nav-link"'; ?>>
             <i class="nav-icon fas fa-tachometer-alt"></i>
             <p>
               Panel de Control
             </p>
           </a>
         </li>
          <li <?php echo (CURRENT_PAGE == 'dynamic_qrcodes.php' || CURRENT_PAGE == 'add_dynamic.php' || (substr(CURRENT_PAGE, 0, 16) == 'edit_dynamic.php')) ? ' class="nav-item has-treeview menu-open"' : ' class="nav-item has-treeview"'; ?>> 
            <a href="#" <?php echo (CURRENT_PAGE == 'dynamic_qrcodes.php' || CURRENT_PAGE == 'add_dynamic.php' || (substr(CURRENT_PAGE, 0, 16) == 'edit_dynamic.php')) ? ' class="nav-link active"' : ' class="nav-link"'; ?>>
              <i class="nav-icon fa fa-qrcode"></i>
              <p>
                 QR Dinámicos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./dynamic_qrcodes.php" <?php echo (CURRENT_PAGE == 'dynamic_qrcodes.php') ? ' class="nav-link active"' : ' class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ver Todos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./add_dynamic.php" <?php echo (CURRENT_PAGE == 'add_dynamic.php') ? ' class="nav-link active"' : ' class="nav-link"'; ?>>
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Añadir nuevo</p>
                </a>
              </li>
            </ul>
          </li>
          <li <?php echo (CURRENT_PAGE == 'static_qrcodes.php' || CURRENT_PAGE == 'add_static.php' || (substr(CURRENT_PAGE, 0, 15) == 'edit_static.php')) ? ' class="nav-item has-treeview menu-open"' : ' class="nav-item has-treeview"'; ?>>
            <a href="#" <?php echo (CURRENT_PAGE == 'static_qrcodes.php' || CURRENT_PAGE == 'add_static.php' || (substr(CURRENT_PAGE, 0, 15) == 'edit_static.php')) ? ' class="nav-link active"' : ' class="nav-link"'; ?>>
              <i class="nav-icon fa fa-qrcode"></i>
              <p>
                   QR Estáticos
                  <i class="right fas fa-angle-left"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./static_qrcodes.php" <?php echo (CURRENT_PAGE == 'static_qrcodes.php') ? ' class="nav-link active"' : ' class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ver Todos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./add_static.php" <?php echo (CURRENT_PAGE == 'add_static.php') ? ' class="nav-link active"' : ' class="nav-link"'; ?>>
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Añadir nuevo</p>
                </a>
              </li>
            </ul>
          </li>
          <?php if ($_SESSION['admin_type'] == 'super'): ?>
          <li class="nav-item">
            <a href="./admin_users.php" <?php echo (CURRENT_PAGE == 'admin_users.php' || CURRENT_PAGE == 'add_admin.php' || (substr(CURRENT_PAGE, 0, 14) == 'edit_admin.php')) ? ' class="nav-link active"' : ' class="nav-link"'; ?>>
                <i class="fas fa-users nav-icon"></i>
              <p>Usuarios</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./setting_list.php" <?php echo (CURRENT_PAGE == 'setting_list.php' || CURRENT_PAGE == 'add_setting.php' || (substr(CURRENT_PAGE, 0, 16) == 'edit_setting.php')) ? ' class="nav-link active"' : ' class="nav-link"'; ?>>
                <i class="fas fa-cog nav-icon"></i>
              <p>Ajustes</p>
            </a>
          </li>
          <?php endif ?>
          <li class="nav-item">
            <a href="./admin_user_profile.php" <?php echo (CURRENT_PAGE == 'admin_user_profile.php' || (substr(CURRENT_PAGE, 0, 12) == 'admin_user_profile.php')) ? ' class="nav-link active"' : ' class="nav-link"'; ?>>
                <i class="nav-icon fa fa-id-card" aria-hidden="true"></i>
              <p>Mi Perfil</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./users_directory.php" <?php echo (CURRENT_PAGE == 'users_directory.php' || (substr(CURRENT_PAGE, 0, 14) == 'user_profile.php')) ? ' class="nav-link active"' : ' class="nav-link"'; ?>>
                <i class="nav-icon fas fa-address-book"></i>
              <p>Todos los Usuarios</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
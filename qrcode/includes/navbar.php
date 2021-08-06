<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-user"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <div class="dropdown-divider"></div>
        <a href="admin_user_profile.php" class="dropdown-item">
          <i class="fas fa-user"></i> Perfil
        </a>
        <div class="dropdown-divider"></div>
        <?php if ($_SESSION['admin_type'] == 'super'): ?>
        <a href="setting_list.php" class="dropdown-item">
          <i class="fa fa-cog"></i> Settings
        </a>
        <?php endif; ?>
        <div class="dropdown-divider"></div>
        <a href="./logout.php" class="dropdown-item">
          <i class="fas fa-sign-out-alt"></i> Salir
        </a>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-th-large"></i></a>
    </li>
  </ul>
</nav>
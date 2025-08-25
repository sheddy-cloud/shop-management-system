<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
  <div class="container">
    <a href="<?php echo base_url ?>" class="navbar-brand">
      <img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="<?php echo $_settings->info('name') ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-bold"><?php echo $_settings->info('name') ?></span>
    </a>

    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="<?php echo base_url ?>" class="nav-link">
            <i class="fas fa-home mr-1"></i> Dashboard
          </a>
        </li>
        <li class="nav-item dropdown">
          <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
            <i class="fas fa-cog mr-1"></i> Management
          </a>
          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <li><a href="<?php echo base_url ?>maintenance/" class="dropdown-item">
              <i class="fas fa-tools mr-2"></i>System Settings
            </a></li>
            <li><a href="<?php echo base_url ?>user/" class="dropdown-item">
              <i class="fas fa-users mr-2"></i>User Management
            </a></li>
            <li class="dropdown-divider"></li>
            <li><a href="<?php echo base_url ?>system_info/" class="dropdown-item">
              <i class="fas fa-info-circle mr-2"></i>System Information
            </a></li>
          </ul>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-0 ml-md-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search..." aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
    </div>

    <!-- Right navbar links -->
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-bell"></i>
          <span class="badge badge-warning navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">3 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-exclamation-triangle mr-2 text-warning"></i>
            Low stock alert for Item #123
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-truck mr-2 text-info"></i>
            New delivery received
            <span class="float-right text-muted text-sm">1 hour</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-chart-line mr-2 text-success"></i>
            Sales target achieved
            <span class="float-right text-muted text-sm">2 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>

      <!-- User Dropdown Menu -->
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="<?php echo base_url ?>dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline"><?php echo $_SESSION['userdata']['firstname'] . ' ' . $_SESSION['userdata']['lastname'] ?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-primary">
            <img src="<?php echo base_url ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            <div class="user-info">
              <a href="#" class="d-block"><?php echo $_SESSION['userdata']['firstname'] . ' ' . $_SESSION['userdata']['lastname'] ?></a>
              <small><?php echo $_SESSION['userdata']['type'] == 1 ? 'Administrator' : 'Staff' ?></small>
            </div>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="<?php echo base_url ?>user/" class="btn btn-default btn-flat">
              <i class="fas fa-user mr-1"></i> Profile
            </a>
            <a href="<?php echo base_url ?>logout.php" class="btn btn-default btn-flat float-right">
              <i class="fas fa-sign-out-alt mr-1"></i> Sign out
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
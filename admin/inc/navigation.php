</style>
<!-- Main Sidebar Container -->
<aside class="sidebar">
        <!-- Brand Logo -->
  <div class="sidebar-header p-3 border-bottom">
    <a href="<?php echo base_url ?>admin" class="d-flex align-items-center text-decoration-none">
      <img src="<?php echo validate_image($_settings->info('logo'))?>" alt="Store Logo" class="rounded-circle me-2" style="width: 2rem; height: 2rem;">
      <span class="fw-bold text-primary"><?php echo $_settings->info('short_name') ?></span>
    </a>
          </div>
  
                <!-- Sidebar Menu -->
  <div class="sidebar-body p-3">
    <nav class="nav flex-column">
      
      <!-- Dashboard -->
      <div class="nav-item mb-2">
        <a href="./" class="nav-link d-flex align-items-center text-decoration-none rounded p-2 <?php echo $page == 'home' ? 'bg-primary text-white' : 'text-dark' ?>">
          <i class="fas fa-tachometer-alt me-2"></i>
          <span>Dashboard</span>
        </a>
      </div>

      <!-- Operations Section -->
      <div class="nav-header text-uppercase fw-bold text-muted small mt-4 mb-2">
        <i class="fas fa-cogs me-2"></i>Operations
      </div>

      <div class="nav-item mb-1">
        <a href="<?php echo base_url ?>admin/?page=purchase_order" class="nav-link d-flex align-items-center text-decoration-none rounded p-2 <?php echo $page == 'purchase_order' ? 'bg-primary text-white' : 'text-dark' ?>">
          <i class="fas fa-th-list me-2"></i>
          <span>Purchase Order</span>
        </a>
      </div>

      <div class="nav-item mb-1">
        <a href="<?php echo base_url ?>admin/?page=receiving" class="nav-link d-flex align-items-center text-decoration-none rounded p-2 <?php echo $page == 'receiving' ? 'bg-primary text-white' : 'text-dark' ?>">
          <i class="fas fa-boxes me-2"></i>
          <span>Receiving</span>
        </a>
      </div>

      <div class="nav-item mb-1">
        <a href="<?php echo base_url ?>admin/?page=return" class="nav-link d-flex align-items-center text-decoration-none rounded p-2 <?php echo $page == 'return' ? 'bg-primary text-white' : 'text-dark' ?>">
          <i class="fas fa-undo me-2"></i>
          <span>Return List</span>
        </a>
      </div>

      <div class="nav-item mb-1">
        <a href="<?php echo base_url ?>admin/?page=stocks" class="nav-link d-flex align-items-center text-decoration-none rounded p-2 <?php echo $page == 'stocks' ? 'bg-primary text-white' : 'text-dark' ?>">
          <i class="fas fa-table me-2"></i>
          <span>Stocks</span>
        </a>
      </div>

      <div class="nav-item mb-1">
        <a href="<?php echo base_url ?>admin/?page=sales" class="nav-link d-flex align-items-center text-decoration-none rounded p-2 <?php echo $page == 'sales' ? 'bg-primary text-white' : 'text-dark' ?>">
          <i class="fas fa-file-invoice-dollar me-2"></i>
          <span>Sale List</span>
        </a>
      </div>

                    <?php if($_settings->userdata('type') == 1): ?>
      <!-- Maintenance Section -->
      <div class="nav-header text-uppercase fw-bold text-muted small mt-4 mb-2">
        <i class="fas fa-tools me-2"></i>Maintenance
      </div>

      <div class="nav-item mb-1">
        <a href="<?php echo base_url ?>admin/?page=maintenance/supplier" class="nav-link d-flex align-items-center text-decoration-none rounded p-2 <?php echo $page == 'maintenance/supplier' ? 'bg-primary text-white' : 'text-dark' ?>">
          <i class="fas fa-truck-loading me-2"></i>
          <span>Supplier List</span>
        </a>
      </div>

      <div class="nav-item mb-1">
        <a href="<?php echo base_url ?>admin/?page=maintenance/item" class="nav-link d-flex align-items-center text-decoration-none rounded p-2 <?php echo $page == 'maintenance/item' ? 'bg-primary text-white' : 'text-dark' ?>">
          <i class="fas fa-boxes me-2"></i>
          <span>Item List</span>
        </a>
      </div>

      <div class="nav-item mb-1">
        <a href="<?php echo base_url ?>admin/?page=maintenance/client" class="nav-link d-flex align-items-center text-decoration-none rounded p-2 <?php echo $page == 'maintenance/client' ? 'bg-primary text-white' : 'text-dark' ?>">
          <i class="fas fa-users me-2"></i>
          <span>Client List</span>
        </a>
      </div>

      <!-- System Section -->
      <div class="nav-header text-uppercase fw-bold text-muted small mt-4 mb-2">
        <i class="fas fa-cog me-2"></i>System
      </div>

      <div class="nav-item mb-1">
        <a href="<?php echo base_url ?>admin/?page=user" class="nav-link d-flex align-items-center text-decoration-none rounded p-2 <?php echo $page == 'user' ? 'bg-primary text-white' : 'text-dark' ?>">
          <i class="fas fa-user-shield me-2"></i>
          <span>User List</span>
        </a>
      </div>

      <div class="nav-item mb-1">
        <a href="<?php echo base_url ?>admin/?page=system_info" class="nav-link d-flex align-items-center text-decoration-none rounded p-2 <?php echo $page == 'system_info' ? 'bg-primary text-white' : 'text-dark' ?>">
          <i class="fas fa-info-circle me-2"></i>
          <span>System Info</span>
        </a>
      </div>

                    <?php endif; ?>

      <!-- Reports Section -->
      <div class="nav-header text-uppercase fw-bold text-muted small mt-4 mb-2">
        <i class="fas fa-chart-bar me-2"></i>Reports
              </div>

      <div class="nav-item mb-1">
        <a href="<?php echo base_url ?>admin/?page=reports/sales" class="nav-link d-flex align-items-center text-decoration-none rounded p-2 <?php echo $page == 'reports/sales' ? 'bg-primary text-white' : 'text-dark' ?>">
          <i class="fas fa-chart-line me-2"></i>
          <span>Sales Report</span>
        </a>
            </div>

      <div class="nav-item mb-1">
        <a href="<?php echo base_url ?>admin/?page=reports/inventory" class="nav-link d-flex align-items-center text-decoration-none rounded p-2 <?php echo $page == 'reports/inventory' ? 'bg-primary text-white' : 'text-dark' ?>">
          <i class="fas fa-chart-pie me-2"></i>
          <span>Inventory Report</span>
        </a>
          </div>

      <!-- Account Section -->
      <div class="nav-header text-uppercase fw-bold text-muted small mt-4 mb-2">
        <i class="fas fa-user me-2"></i>Account
            </div>

      <div class="nav-item mb-1">
        <a href="<?php echo base_url ?>admin/?page=profile" class="nav-link d-flex align-items-center text-decoration-none rounded p-2 <?php echo $page == 'profile' ? 'bg-primary text-white' : 'text-dark' ?>">
          <i class="fas fa-user-circle me-2"></i>
          <span>My Profile</span>
        </a>
          </div>

      <div class="nav-item mb-1">
        <a href="<?php echo base_url ?>admin/logout.php" class="nav-link d-flex align-items-center text-decoration-none rounded p-2 text-danger">
          <i class="fas fa-sign-out-alt me-2"></i>
          <span>Logout</span>
        </a>
            </div>

    </nav>
        </div>
      </aside>
      <script>
        var page;
    $(document).ready(function(){
      page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
      page = page.replace(/\//gi,'_');

      if($('.nav-link.nav-'+page).length > 0){
             $('.nav-link.nav-'+page).addClass('active')
        if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
            $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
          $('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
        }
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

      }
      
		$('#receive-nav').click(function(){
      $('#uni_modal').on('shown.bs.modal',function(){
        $('#find-transaction [name="tracking_code"]').focus();
      })
			uni_modal("Enter Tracking Number","transaction/find_transaction.php");
		})
    })
  </script>
<?php 
  require_once('sess_auth.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<title><?php echo $_settings->info('title') != false ? $_settings->info('title').' | ' : '' ?><?php echo $_settings->info('name') ?></title>
    <link rel="icon" href="<?php echo validate_image($_settings->info('logo')) ?>" />
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- DataTables -->
      <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    
   <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    
     <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    
    <!-- Minimal Custom Styling -->
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --info-color: #0dcaf0;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .main-wrapper {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            margin: 20px;
            min-height: calc(100vh - 40px);
        }
        
        .sidebar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            height: calc(100vh - 40px);
            position: fixed;
            left: 20px;
            top: 20px;
            width: 280px;
            z-index: 1000;
            overflow-y: auto;
            transition: transform 0.3s ease;
        }
        
        .sidebar.collapsed {
            transform: translateX(-100%);
        }
        
        .content-area {
            margin-left: 320px;
            padding: 30px;
            transition: margin-left 0.3s ease;
        }
        
        .content-area.expanded {
            margin-left: 40px;
        }
        
        .sidebar-toggle {
            position: fixed;
            top: 30px;
            left: 30px;
            z-index: 1001;
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .sidebar-toggle:hover {
            background: rgba(255, 255, 255, 1);
            transform: scale(1.05);
        }
        
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        
        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color), #0056b3);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            border: none;
            font-weight: 600;
        }
        
        .btn {
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table thead th {
            background: linear-gradient(135deg, var(--primary-color), #0056b3);
            color: white;
            border: none;
            font-weight: 600;
        }
        
        .table tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.1);
        }
        
        .form-control {
            border-radius: 10px;
            border: 1px solid rgba(13, 110, 253, 0.2);
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
        
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        }
        
        .modal-header {
            background: linear-gradient(135deg, var(--primary-color), #0056b3);
            color: white;
            border-radius: 15px 15px 0 0;
            border: none;
        }
        
        .dropdown-menu {
            border-radius: 10px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
        
        .nav-link {
            border-radius: 10px;
            margin: 2px 0;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            background-color: rgba(13, 110, 253, 0.1);
            transform: translateX(5px);
        }
        
        .nav-link.active {
            background: linear-gradient(135deg, var(--primary-color), #0056b3);
            color: white !important;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                left: 10px;
                top: 10px;
                height: calc(100vh - 20px);
                width: 260px;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .content-area {
                margin-left: 0;
                padding: 20px;
            }
            
            .content-area.expanded {
                margin-left: 0;
            }
            
            .main-wrapper {
                margin: 10px;
            }
            
            .sidebar-toggle {
                top: 20px;
                left: 20px;
            }
        }
        
        /* Custom utility classes */
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
        }
        
        .gradient-primary {
            background: linear-gradient(135deg, var(--primary-color), #0056b3);
        }
        
        .gradient-success {
            background: linear-gradient(135deg, var(--success-color), #146c43);
        }
        
        .gradient-warning {
            background: linear-gradient(135deg, var(--warning-color), #e0a800);
        }
        
        .gradient-danger {
            background: linear-gradient(135deg, var(--danger-color), #b02a37);
        }
        
        .gradient-info {
            background: linear-gradient(135deg, var(--info-color), #0aa2c0);
        }
    </style>

     <!-- jQuery -->
    <script src="<?php echo base_url ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?php echo base_url ?>plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?php echo base_url ?>plugins/toastr/toastr.min.js"></script>
    
    <script>
        var _base_url_ = '<?php echo base_url ?>';
    </script>
    <script src="<?php echo base_url ?>dist/js/script.js"></script>

    <!-- Sidebar and responsive script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const contentArea = document.querySelector('.content-area');
            
            // Sidebar toggle functionality
            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    contentArea.classList.toggle('expanded');
                    
                    // Update toggle button icon
                    const icon = this.querySelector('i');
                    if (sidebar.classList.contains('collapsed')) {
                        icon.className = 'fas fa-bars';
                    } else {
                        icon.className = 'fas fa-times';
                    }
                });
            }
            
            // Mobile sidebar toggle (for the navbar button)
            const mobileSidebarToggle = document.querySelector('[data-bs-toggle="sidebar"]');
            if (mobileSidebarToggle && sidebar) {
                mobileSidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768 && 
                    sidebar && 
                    !sidebar.contains(e.target) && 
                    !sidebarToggle.contains(e.target) &&
                    !mobileSidebarToggle.contains(e.target) &&
                    sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                }
            });
            
            // Add smooth animations to cards
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
            
            // Initialize sidebar state based on screen size
            if (window.innerWidth <= 768) {
                sidebar.classList.add('collapsed');
                contentArea.classList.add('expanded');
            }
        });
    </script>
  </head>
<body>
    <!-- Sidebar Toggle Button -->
    <button class="sidebar-toggle" id="sidebarToggle" type="button">
        <i class="fas fa-bars"></i>
    </button>
    
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <?php include 'navigation.php'; ?>
    </div>
    
    <!-- Main Content Wrapper -->
    <div class="main-wrapper">
        <div class="content-area">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <button class="btn btn-outline-primary d-lg-none" type="button" data-bs-toggle="sidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <span class="navbar-brand mb-0 h1 text-primary fw-bold">
                        <i class="fas fa-store me-2"></i>
                        <?php echo $_settings->info('name') ?>
                    </span>
                    
                    <div class="navbar-nav ms-auto">
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i>
                                <?php echo $_SESSION['userdata']['firstname'] . ' ' . $_SESSION['userdata']['lastname'] ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../user/profile.php">
                                    <i class="fas fa-user me-2"></i> Profile
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="../logout.php">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
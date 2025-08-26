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
            background: #f8f9fa;
            min-height: 100vh;
        }
        
        .main-wrapper {
            background: #ffffff;
            min-height: 100vh;
            position: relative;
            margin-left: 300px;
        }
        
        .sidebar {
            background: #ffffff;
            border-right: 1px solid #e9ecef;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            z-index: 1003;
            overflow-y: auto;
        }
        

        
        /* Sidebar content styling */
        .sidebar-header {
            background: rgba(255, 255, 255, 0.1);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .sidebar-body {
            overflow-y: auto;
            max-height: calc(100% - 80px);
        }
        
        .nav-link {
            transition: all 0.2s ease;
            border-radius: 8px;
            margin: 2px 0;
        }
        
        .nav-link:hover {
            background-color: rgba(13, 110, 253, 0.1);
            transform: translateX(3px);
        }
        
        .nav-link.active,
        .nav-link.bg-primary {
            background: linear-gradient(135deg, var(--primary-color), #0056b3) !important;
            color: white !important;
            box-shadow: 0 2px 8px rgba(13, 110, 253, 0.3);
        }
        
        .nav-header {
            color: #6c757d;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        
        .content-area {
            margin-left: 10px;
            padding: 30px;
            min-height: 100vh;
        }
        
        .sidebar-toggle {
            display: none;
        }
        
        .sidebar-toggle:hover {
            background: rgba(255, 255, 255, 1);
            transform: scale(1.05);
        }
        
        .sidebar-toggle:active {
            transform: scale(0.95);
        }
        
        .navbar {
            background: #ffffff;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 20px;
        }
        
        .card {
            background: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
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
        
        /* Table action buttons */
        .table .btn-sm {
            margin: 0.1rem;
            transition: all 0.2s ease;
            border-radius: 6px;
        }
        
        .table .btn-sm:hover {
            transform: scale(1.1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
        
        .table td {
            vertical-align: middle;
            position: relative;
        }
        
        /* Dropdown positioning */
        .dropdown {
            position: relative;
        }
        
        .dropdown-toggle::after {
            display: inline-block;
            margin-left: 0.255em;
            vertical-align: 0.255em;
            content: "";
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
        }
        
        /* Ensure dropdowns are visible */
        .dropdown-menu.show {
            display: block !important;
            opacity: 1 !important;
            visibility: visible !important;
        }
        
        /* Fix dropdown positioning in tables */
        .table .dropdown {
            position: relative;
        }
        
        .table .dropdown-menu {
            position: absolute !important;
            top: 100% !important;
            left: 0 !important;
            z-index: 1050 !important;
            min-width: 120px;
            margin-top: 2px;
            border: 1px solid rgba(0,0,0,.15);
            border-radius: 0.375rem;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,.175);
        }
        
        /* Ensure dropdown items are properly styled */
        .dropdown-item {
            display: block;
            width: 100%;
            padding: 0.375rem 1rem;
            clear: both;
            font-weight: 400;
            color: #212529;
            text-align: inherit;
            text-decoration: none;
            white-space: nowrap;
            background-color: transparent;
            border: 0;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out;
        }
        
        .dropdown-item:hover {
            color: #1e2125;
            background-color: #e9ecef;
        }
        
        .dropdown-item:focus {
            color: #1e2125;
            background-color: #e9ecef;
        }
        
        /* Dropdown divider styling */
        .dropdown-divider {
            height: 0;
            margin: 0.5rem 0;
            overflow: hidden;
            border-top: 1px solid rgba(0,0,0,.15);
        }
        
        /* Responsive table improvements */
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
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
            position: absolute !important;
            z-index: 1000;
            display: none;
        }
        
        .dropdown-menu.show {
            display: block !important;
        }
        
        .dropdown-item {
            padding: 8px 16px;
            color: #333;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        
        .dropdown-item:hover {
            background-color: rgba(13, 110, 253, 0.1);
            color: #333;
        }
        
        .dropdown-divider {
            margin: 4px 0;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
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
            .main-wrapper {
                margin-left: 0;
            }
            
            .content-area {
                margin-left: 0;
            }
            
            .sidebar {
                position: fixed;
                left: -100%;
                top: 0;
                height: 100vh;
                width: 50vw;
                max-width: 300px;
                min-width: 250px;
                border-right: 1px solid #e9ecef;
                z-index: 1003;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                transition: left 0.3s ease;
            }
            
            .sidebar.show {
                left: 0;
            }
        
        /* Mobile Sidebar Toggle Button */
        .navbar-toggler {
            border: none;
            background: transparent;
            color: #0d6efd;
            font-size: 1.2rem;
            padding: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .navbar-toggler:hover {
            color: #0056b3;
            transform: scale(1.1);
        }
        
        /* Sidebar Close Button */
        .sidebar-close-btn {
            border: none;
            background: transparent;
            color: #6c757d;
            font-size: 1.2rem;
            padding: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .sidebar-close-btn:hover {
            color: #dc3545;
            background: rgba(220, 53, 69, 0.1);
            transform: scale(1.1);
        }
        
        /* Mobile Sidebar Overlay */
        .mobile-sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1002;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            backdrop-filter: blur(2px);
        }
        
        .mobile-sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }
        
        /* Mobile-specific sidebar improvements */
        @media (max-width: 768px) {
            .sidebar {
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            
            .sidebar-body {
                padding: 20px 15px !important;
            }
            
            .nav-link {
                padding: 15px 20px !important;
                margin: 5px 0;
                font-size: 1rem;
                border-radius: 12px;
            }
            
            .nav-header {
                margin-top: 20px;
                margin-bottom: 10px;
                padding: 0 20px;
            }
        }
            
            .sidebar-body {
                max-height: calc(100% - 70px);
                padding: 15px !important;
            }
            
            .sidebar-header {
                padding: 15px !important;
            }
            
            .nav-link {
                padding: 12px 15px !important;
                font-size: 0.95rem;
            }
            
            .content-area {
                margin-left: 0 !important;
                padding: 15px;
                width: 100%;
                position: relative;
            }
            
            .main-wrapper {
                margin: 0;
            }
            
            .sidebar-toggle {
                display: none !important;
            }
            
            /* Mobile table improvements */
            .table-responsive {
                font-size: 0.875rem;
            }
            
            .table th,
            .table td {
                padding: 0.5rem 0.25rem;
            }
            
            .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
            }
            
            /* Mobile card improvements */
            .card-body {
                padding: 1rem;
            }
            
            .card-header {
                padding: 0.75rem 1rem;
            }
            
            /* Mobile text adjustments */
            h4 {
                font-size: 1.25rem;
            }
            
            h5 {
                font-size: 1.1rem;
            }
            
            .fs-4 {
                font-size: 1.5rem !important;
            }
            
            .fs-6 {
                font-size: 0.875rem !important;
            }
        }
        
        @media (max-width: 576px) {
            .main-wrapper {
                margin-left: 0;
            }
            
            .content-area {
                margin-left: 0 !important;
            }
            
            .sidebar {
                left: -100%;
                top: 0;
                height: 100vh;
                width: 60vw;
                max-width: 280px;
                min-width: 240px;
                border-radius: 0 20px 20px 0;
                position: fixed;
                transition: left 0.3s ease;
            }
            
            .sidebar.show {
                left: 0;
            }
            
            .content-area {
                margin-left: 0 !important;
                padding: 10px;
                width: 100%;
                position: relative;
            }
            
            .main-wrapper {
                margin: 0;
            }
            
            .sidebar-toggle {
                display: none !important;
            }
            
            .table-responsive {
                font-size: 0.8rem;
            }
            
            .btn-sm {
                padding: 0.2rem 0.4rem;
                font-size: 0.7rem;
            }
            
            .card-body {
                padding: 0.75rem;
            }
            
            .card-header {
                padding: 0.5rem 0.75rem;
            }
        }
        
        @media (max-width: 480px) {
            .main-wrapper {
                margin-left: 0;
            }
            
            .content-area {
                margin-left: 0 !important;
            }
            
            .sidebar {
                width: 70vw;
                max-width: 260px;
                min-width: 220px;
                left: -100%;
                top: 0;
                height: 100vh;
                position: fixed;
                transition: left 0.3s ease;
            }
            
            .sidebar.show {
                left: 0;
            }
            
            .sidebar-toggle {
                display: none !important;
            }
            
            .content-area {
                padding: 8px;
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
    
    <!-- 
    DROPDOWN STRUCTURE GUIDE:
    ========================
    For Action buttons in tables, use this structure:
    
    <div class="dropdown">
        <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle" data-bs-toggle="dropdown">
            Action
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="...">View</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="...">Edit</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item delete_data" href="javascript:void(0)" data-id="...">Delete</a></li>
        </ul>
    </div>
    -->
    <!-- SweetAlert2 -->
    <script src="<?php echo base_url ?>plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?php echo base_url ?>plugins/toastr/toastr.min.js"></script>
    
    <script>
        var _base_url_ = '<?php echo base_url ?>';
    </script>
    <script src="<?php echo base_url ?>dist/js/script.js"></script>

    <!-- JavaScript for dropdowns and mobile sidebar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile sidebar functionality
            const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const mobileSidebarOverlay = document.getElementById('mobileSidebarOverlay');
            const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');
            
            // Function to toggle mobile sidebar
            function toggleMobileSidebar() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.toggle('show');
                    mobileSidebarOverlay.classList.toggle('show');
                    
                    // Prevent body scroll when sidebar is open
                    if (sidebar.classList.contains('show')) {
                        document.body.style.overflow = 'hidden';
                    } else {
                        document.body.style.overflow = '';
                    }
                }
            }
            
            // Toggle button click event
            if (mobileSidebarToggle) {
                mobileSidebarToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleMobileSidebar();
                });
            }
            
            // Close button click event
            if (sidebarCloseBtn) {
                sidebarCloseBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (window.innerWidth <= 768 && sidebar.classList.contains('show')) {
                        toggleMobileSidebar();
                    }
                });
            }
            
            // Close sidebar when clicking overlay
            if (mobileSidebarOverlay) {
                mobileSidebarOverlay.addEventListener('click', function() {
                    if (window.innerWidth <= 768 && sidebar.classList.contains('show')) {
                        toggleMobileSidebar();
                    }
                });
            }
            
            // Close sidebar when clicking outside
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768 && 
                    sidebar && 
                    !sidebar.contains(e.target) && 
                    mobileSidebarToggle && !mobileSidebarToggle.contains(e.target) &&
                    sidebar.classList.contains('show')) {
                    toggleMobileSidebar();
                }
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    // Desktop: remove mobile classes
                    if (sidebar) sidebar.classList.remove('show');
                    if (mobileSidebarOverlay) mobileSidebarOverlay.classList.remove('show');
                    document.body.style.overflow = '';
                }
            });
            
            // Initialize Bootstrap dropdowns properly
            function initializeDropdowns() {
                // Close all other dropdowns when one is opened
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.dropdown')) {
                        document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                            menu.classList.remove('show');
                        });
                    }
                });
                
                // Handle dropdown toggle clicks
                document.addEventListener('click', function(e) {
                    if (e.target.classList.contains('dropdown-toggle') || e.target.closest('.dropdown-toggle')) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        const dropdown = e.target.closest('.dropdown');
                        const dropdownMenu = dropdown.querySelector('.dropdown-menu');
                        
                        // Close all other dropdowns
                        document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                            if (menu !== dropdownMenu) {
                                menu.classList.remove('show');
                            }
                        });
                        
                        // Toggle current dropdown
                        dropdownMenu.classList.toggle('show');
                    }
                });
                
                // Close dropdown when clicking on dropdown items
                document.addEventListener('click', function(e) {
                    if (e.target.classList.contains('dropdown-item')) {
                        const dropdown = e.target.closest('.dropdown');
                        const dropdownMenu = dropdown.querySelector('.dropdown-menu');
                        dropdownMenu.classList.remove('show');
                    }
                });
            }
            
            // Initialize dropdowns
            initializeDropdowns();
            
            // Add this to any page that needs dropdown functionality
            // This ensures dropdowns work even if the page loads dynamically
            window.addEventListener('load', function() {
                initializeDropdowns();
            });
            
            // For dynamically loaded content (like DataTables)
            $(document).on('draw.dt', function() {
                setTimeout(initializeDropdowns, 100);
            });
        });
    </script>
    </script>
  </head>
<body>
    <!-- Mobile Sidebar Overlay -->
    <div class="mobile-sidebar-overlay" id="mobileSidebarOverlay"></div>
    
    <!-- Main Content Wrapper -->
    <div class="main-wrapper">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <?php include 'navigation.php'; ?>
        </div>
        
        <div class="content-area">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    
                    <div class="d-flex align-items-center">
                        <!-- Mobile Sidebar Toggle Button -->
                        <button class="navbar-toggler d-lg-none me-3" type="button" id="mobileSidebarToggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        
                        <span class="navbar-brand mb-0 h1 text-primary fw-bold">
                            <?php echo $_settings->info('name') ?>
                        </span>
                    </div>
                    
                    <div class="navbar-nav ms-auto">
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i>
                                <?php 
                                    if(isset($_SESSION['userdata']) && isset($_SESSION['userdata']['firstname']) && isset($_SESSION['userdata']['lastname'])) {
                                        echo $_SESSION['userdata']['firstname'] . ' ' . $_SESSION['userdata']['lastname'];
                                    } else {
                                        echo 'User';
                                    }
                                ?>
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
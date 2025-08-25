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
            position: relative;
            overflow: hidden;
        }
        
        .sidebar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px 0 0 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            height: 100%;
            position: absolute;
            left: 0;
            top: 0;
            width: 280px;
            z-index: 1003;
            overflow-y: auto;
            transition: transform 0.3s ease;
        }
        
        .sidebar.collapsed {
            transform: translateX(-100%);
        }
        
        .sidebar.show {
            transform: translateX(0) !important;
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
            margin-left: 280px;
            padding: 30px;
            transition: margin-left 0.3s ease;
            min-height: 100%;
        }
        
        .content-area.expanded {
            margin-left: 0;
        }
        
        .sidebar-toggle {
            position: absolute;
            top: 20px;
            left: 20px;
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
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
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
            .sidebar {
                transform: translateX(-100%);
                left: 0;
                top: 0;
                height: 100%;
                width: 260px;
                border-radius: 20px 0 0 20px;
                z-index: 1003;
            }
            
            .sidebar.show {
                transform: translateX(0) !important;
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
            }
            
            .content-area.expanded {
                margin-left: 0 !important;
            }
            
            .main-wrapper {
                margin: 5px;
            }
            
            .sidebar-toggle {
                top: 15px;
                left: 15px;
                display: block !important;
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
            .sidebar {
                left: 0;
                top: 0;
                height: 100%;
                width: 250px;
                border-radius: 20px 0 0 20px;
            }
            
            .content-area {
                margin-left: 0 !important;
                padding: 10px;
            }
            
            .content-area.expanded {
                margin-left: 0 !important;
            }
            
            .main-wrapper {
                margin: 2px;
            }
            
            .sidebar-toggle {
                top: 10px;
                left: 10px;
                padding: 8px;
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
            .sidebar {
                width: 240px;
                left: 0;
                top: 0;
                height: 100%;
            }
            
            .sidebar-toggle {
                top: 8px;
                left: 8px;
                padding: 6px;
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

    <!-- Sidebar and responsive script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const contentArea = document.querySelector('.content-area');
            
            // Function to update toggle button icon
            function updateToggleIcon() {
                const icon = sidebarToggle.querySelector('i');
                if (window.innerWidth <= 768) {
                    // Mobile: show/hide based on sidebar.show
                    if (sidebar.classList.contains('show')) {
                        icon.className = 'fas fa-times';
                    } else {
                        icon.className = 'fas fa-bars';
                    }
                } else {
                    // Desktop: show/hide based on sidebar.collapsed
                    if (sidebar.classList.contains('collapsed')) {
                        icon.className = 'fas fa-bars';
                    } else {
                        icon.className = 'fas fa-times';
                    }
                }
            }
            
            // Function to handle sidebar toggle
            function toggleSidebar() {
                if (window.innerWidth <= 768) {
                    // Mobile behavior
                    sidebar.classList.toggle('show');
                } else {
                    // Desktop behavior
                    sidebar.classList.toggle('collapsed');
                    contentArea.classList.toggle('expanded');
                }
                
                // Update toggle button icon
                updateToggleIcon();
            }
            
            // Sidebar toggle functionality
            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', toggleSidebar);
            }
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768 && 
                    sidebar && 
                    !sidebar.contains(e.target) && 
                    !sidebarToggle.contains(e.target) &&
                    sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                    updateToggleIcon();
                }
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    // Desktop: remove mobile classes
                    sidebar.classList.remove('show');
                    if (!sidebar.classList.contains('collapsed')) {
                        contentArea.classList.remove('expanded');
                    }
                } else {
                    // Mobile: remove desktop classes
                    sidebar.classList.remove('collapsed');
                    contentArea.classList.remove('expanded');
                    sidebar.classList.remove('show');
                }
                
                // Update toggle button icon after resize
                updateToggleIcon();
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
                        const isOpen = dropdownMenu.classList.contains('show');
                        
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
            
            // Initialize sidebar state based on screen size
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('collapsed');
                contentArea.classList.remove('expanded');
                sidebar.classList.remove('show');
            }
            
            // Initialize toggle button icon
            updateToggleIcon();
        });
    </script>
  </head>
<body>
    <!-- Main Content Wrapper -->
    <div class="main-wrapper">
        <!-- Sidebar Toggle Button -->
        <button class="sidebar-toggle" id="sidebarToggle" type="button">
            <i class="fas fa-bars"></i>
        </button>
        
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <?php include 'navigation.php'; ?>
        </div>
        
        <div class="content-area">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    
                    <span class="navbar-brand mb-0 h1 text-primary fw-bold">
                        <i class="fas fa-store me-2"></i>
                        <?php echo $_settings->info('name') ?>
                    </span>
                    
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
<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?php echo $_settings->info('name') ?></title>
    <link rel="icon" href="<?php echo validate_image($_settings->info('logo')) ?>" />
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
  <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 3rem;
            width: 100%;
            max-width: 400px;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .login-header h1 {
            color: #0d6efd;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .login-header p {
            color: #6c757d;
            margin-bottom: 0;
        }
        
        .form-control {
            border-radius: 10px;
            border: 1px solid rgba(13, 110, 253, 0.2);
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }
        
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
        
        .input-group-text {
            background: transparent;
            border: 1px solid rgba(13, 110, 253, 0.2);
            border-left: none;
            border-radius: 0 10px 10px 0;
            cursor: pointer;
        }
        
        .input-group .form-control {
            border-right: none;
            border-radius: 10px 0 0 10px;
        }
        
        .btn-login {
            background: linear-gradient(135deg, #0d6efd, #0056b3);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(13, 110, 253, 0.3);
        }
        
        .signup-link {
            text-align: center;
            margin-top: 1.5rem;
        }
        
        .signup-link a {
            color: #0d6efd;
            text-decoration: none;
            font-weight: 500;
        }
        
        .signup-link a:hover {
            text-decoration: underline;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
        }
        
        .alert-danger {
            background: rgba(220, 53, 69, 0.1);
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        
        .alert-success {
            background: rgba(25, 135, 84, 0.1);
            color: #0f5132;
            border-left: 4px solid #198754;
        }
        
        .err_msg {
            margin-bottom: 1rem;
        }
        
        .is-invalid {
            border-color: #dc3545 !important;
    }
  </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1><i class="fas fa-store me-2"></i>Sign In</h1>
            <p>Welcome to <?php echo $_settings->info('name') ?></p>
    </div>
        
        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?php echo $_SESSION['error']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        
        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo $_SESSION['success']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        
        <form action="" method="POST" id="login-frm">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
        </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" required>
                    <span class="input-group-text" onclick="togglePassword()">
                        <i class="fas fa-eye" id="password-toggle"></i>
                    </span>
            </div>
          </div>
            
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Sign In
                </button>
        </div>
      </form>
        
        <div class="signup-link">
            <p class="mb-0">Don't have an account? <a href="signup.php">Sign Up</a></p>
  </div>
</div>

<!-- jQuery -->
    <script src="<?php echo base_url ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?php echo base_url ?>plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
        var _base_url_ = '<?php echo base_url ?>';
        
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordToggle = document.getElementById('password-toggle');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggle.classList.remove('fa-eye');
                passwordToggle.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordToggle.classList.remove('fa-eye-slash');
                passwordToggle.classList.add('fa-eye');
            }
        }
        
        // Form validation and AJAX submission
        $('#login-frm').submit(function(e) {
            e.preventDefault();
            
            const username = $('#username').val().trim();
            const password = $('#password').val().trim();
            
            if (!username || !password) {
                alert('Please fill in all fields.');
                return false;
            }
            
            // Remove previous error messages
            if ($('.err_msg').length > 0) {
                $('.err_msg').remove();
            }
            
            // Remove invalid classes
            $('.form-control').removeClass('is-invalid');
            
            // Show loading state
            const btn = $(this).find('.btn-login');
            const originalText = btn.html();
            btn.html('<i class="fas fa-spinner fa-spin me-2"></i>Signing In...');
            btn.prop('disabled', true);
            
            $.ajax({
                url: _base_url_ + 'classes/Login.php?f=login',
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                error: function(err) {
                    console.log(err);
                    alert('An error occurred. Please try again.');
                    btn.html(originalText);
                    btn.prop('disabled', false);
                },
                success: function(resp) {
                    if (resp.status == 'success') {
                        location.replace(_base_url_ + 'admin');
                    } else if (resp.status == 'incorrect') {
                        var _frm = $('#login-frm');
                        var _msg = "<div class='alert alert-danger err_msg'><i class='fas fa-exclamation-triangle me-2'></i> Incorrect username or password</div>";
                        _frm.prepend(_msg);
                        _frm.find('input').addClass('is-invalid');
                        $('#username').focus();
                    } else {
                        alert('An error occurred. Please try again.');
                    }
                    btn.html(originalText);
                    btn.prop('disabled', false);
                }
            });
        });
</script>
</body>
</html>
          btn.prop('disabled', false);
          btnText.text('Sign In');
          spinner.hide();
        }
      });
    });
</script>
</body>

</html>
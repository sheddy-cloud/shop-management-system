<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
 <?php require_once('inc/header.php') ?>
<body class="hold-transition login-page">
  <script>
    start_loader()
  </script>
  <style>
    body {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      position: relative;
      overflow-x: hidden;
    }
    
    body::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.1)"/><circle cx="10" cy="60" r="0.5" fill="rgba(255,255,255,0.1)"/><circle cx="90" cy="40" r="0.5" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
      pointer-events: none;
    }

    .login-title {
      text-align: center;
      color: white;
      font-size: 2.5rem;
      font-weight: 700;
      text-shadow: 0 4px 8px rgba(0,0,0,0.3);
      margin-bottom: 2rem;
      position: relative;
      z-index: 2;
    }

    .login-title::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 4px;
      background: linear-gradient(90deg, #ff6b6b, #4ecdc4);
      border-radius: 2px;
    }

    .signup-container {
      max-width: 500px;
      margin: 0 auto;
      position: relative;
      z-index: 2;
    }

    .signup-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 20px;
      box-shadow: 0 20px 40px rgba(0,0,0,0.1);
      border: 1px solid rgba(255,255,255,0.2);
      overflow: hidden;
      transform: translateY(0);
      transition: all 0.3s ease;
    }

    .signup-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 30px 60px rgba(0,0,0,0.15);
    }

    .card-header {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      text-align: center;
      padding: 2rem 1.5rem 1.5rem;
      position: relative;
    }

    .card-header::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="header-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23header-pattern)"/></svg>');
      pointer-events: none;
    }

    .card-header h1 {
      font-size: 2rem;
      font-weight: 700;
      margin: 0;
      position: relative;
      z-index: 1;
    }

    .card-header .subtitle {
      font-size: 0.9rem;
      opacity: 0.9;
      margin-top: 0.5rem;
      position: relative;
      z-index: 1;
    }

    .card-body {
      padding: 2rem;
    }

    .form-group {
      margin-bottom: 1.5rem;
      position: relative;
    }

    .input-group {
      position: relative;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
    }

    .input-group:focus-within {
      box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
      transform: translateY(-2px);
    }

    .form-control {
      border: none;
      padding: 1rem 1rem 1rem 3rem;
      font-size: 1rem;
      background: white;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      box-shadow: none;
      background: #f8f9ff;
    }

    .input-group-text {
      position: absolute;
      left: 0;
      top: 0;
      bottom: 0;
      width: 50px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      z-index: 2;
    }

         .input-group-text i {
       font-size: 1.1rem;
     }

     .password-toggle {
       background: white !important;
       border: none !important;
       transition: all 0.3s ease;
     }

     .password-toggle:hover {
       background: #f8f9ff !important;
     }

     .password-toggle i {
       color: #667eea;
       transition: all 0.3s ease;
     }

     .password-toggle:hover i {
       color: #764ba2;
     }

     .error-message {
      color: #e74c3c;
      font-size: 0.85rem;
      margin-top: 0.5rem;
      padding: 0.5rem;
      background: rgba(231, 76, 60, 0.1);
      border-radius: 8px;
      border-left: 4px solid #e74c3c;
      animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .btn-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 2rem;
    }

    .btn-link {
      color: #667eea;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
      padding: 0.5rem 1rem;
      border-radius: 8px;
    }

    .btn-link:hover {
      color: #764ba2;
      background: rgba(102, 126, 234, 0.1);
      text-decoration: none;
    }

    .btn-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      padding: 1rem 2rem;
      border-radius: 12px;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
      background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
    }

    .btn-primary:active {
      transform: translateY(0);
    }

    .floating-shapes {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      pointer-events: none;
      z-index: 1;
    }

    .shape {
      position: absolute;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      animation: float 6s ease-in-out infinite;
    }

    .shape:nth-child(1) {
      width: 80px;
      height: 80px;
      top: 20%;
      left: 10%;
      animation-delay: 0s;
    }

    .shape:nth-child(2) {
      width: 120px;
      height: 120px;
      top: 60%;
      right: 10%;
      animation-delay: 2s;
    }

    .shape:nth-child(3) {
      width: 60px;
      height: 60px;
      top: 80%;
      left: 20%;
      animation-delay: 4s;
    }

    @keyframes float {
      0%, 100% {
        transform: translateY(0px) rotate(0deg);
      }
      50% {
        transform: translateY(-20px) rotate(180deg);
      }
    }

    .success-animation {
      animation: successPulse 0.6s ease;
    }

    @keyframes successPulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }

    .loading-spinner {
      display: inline-block;
      width: 20px;
      height: 20px;
      border: 3px solid rgba(255,255,255,.3);
      border-radius: 50%;
      border-top-color: #fff;
      animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }

    @media (max-width: 768px) {
      .login-title {
        font-size: 2rem;
      }
      
      .card-body {
        padding: 1.5rem;
      }
      
      .btn-container {
        flex-direction: column;
        gap: 1rem;
      }
      
      .btn-primary {
        width: 100%;
      }
    }
  </style>

  <div class="floating-shapes">
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>
  </div>

  <div class="container-fluid d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="signup-container">
      <h1 class="login-title"><?php echo $_settings->info('name') ?></h1>
      
      <div class="signup-card">
        <div class="card-header">
          <h1>Create Account</h1>
          <div class="subtitle">Join our community today</div>
        </div>
        
        <div class="card-body">
          <form id="signup-frm" action="" method="post">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-text">
                  <i class="fas fa-user"></i>
                </div>
                <input type="text" class="form-control" autofocus name="firstname" id="firstname" placeholder="First Name" required>
              </div>
              <div id="firstNameError" class="error-message"></div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-text">
                  <i class="fas fa-user"></i>
                </div>
                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" required>
              </div>
              <div id="lastNameError" class="error-message"></div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-text">
                  <i class="fas fa-at"></i>
                </div>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
              </div>
              <div id="usernameError" class="error-message"></div>
            </div>

                         <div class="form-group">
               <div class="input-group">
                 <div class="input-group-text">
                   <i class="fas fa-lock"></i>
                 </div>
                 <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                 <div class="input-group-append">
                   <div class="input-group-text password-toggle" style="cursor: pointer; border-left: 1px solid #dee2e6;">
                     <i class="fas fa-eye" id="passwordToggle"></i>
                   </div>
                 </div>
               </div>
               <div id="passwordError" class="error-message"></div>
             </div>

             <div class="form-group">
               <div class="input-group">
                 <div class="input-group-text">
                   <i class="fas fa-shield-alt"></i>
                 </div>
                 <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                 <div class="input-group-append">
                   <div class="input-group-text password-toggle" style="cursor: pointer; border-left: 1px solid #dee2e6;">
                     <i class="fas fa-eye" id="confirmPasswordToggle"></i>
                   </div>
                 </div>
               </div>
               <div id="confirmPasswordError" class="error-message"></div>
             </div>

            <div class="btn-container">
              <a href="login.php" class="btn-link">
                <i class="fas fa-arrow-left"></i> Already have an account?
              </a>
              <button type="submit" class="btn btn-primary">
                <span class="btn-text">Create Account</span>
                <span class="loading-spinner" style="display: none;"></span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>

  <script>
         $(document).ready(function(){
       end_loader();
       
       // Add floating animation to card on load
       $('.signup-card').addClass('success-animation');

       // Password toggle functionality
       $('#passwordToggle').click(function() {
         const passwordField = $('#password');
         const icon = $(this);
         
         if (passwordField.attr('type') === 'password') {
           passwordField.attr('type', 'text');
           icon.removeClass('fa-eye').addClass('fa-eye-slash');
         } else {
           passwordField.attr('type', 'password');
           icon.removeClass('fa-eye-slash').addClass('fa-eye');
         }
       });

       $('#confirmPasswordToggle').click(function() {
         const confirmPasswordField = $('#confirm_password');
         const icon = $(this);
         
         if (confirmPasswordField.attr('type') === 'password') {
           confirmPasswordField.attr('type', 'text');
           icon.removeClass('fa-eye').addClass('fa-eye-slash');
         } else {
           confirmPasswordField.attr('type', 'password');
           icon.removeClass('fa-eye-slash').addClass('fa-eye');
         }
       });
     });

    $('#signup-frm').submit(function(e) {
      e.preventDefault();

      // Show loading state
      const btn = $(this).find('.btn-primary');
      const btnText = btn.find('.btn-text');
      const spinner = btn.find('.loading-spinner');
      
      btn.prop('disabled', true);
      btnText.text('Creating Account...');
      spinner.show();

      // Clear previous error messages
      $('.error-message').html('');

      // Get form data
      const form = $(this);
      const firstName = form.find('input[name="firstname"]').val().trim();
      const lastName = form.find('input[name="lastname"]').val().trim();
      const username = form.find('input[name="username"]').val().trim();
      const password = form.find('input[name="password"]').val().trim();
      const confirmPassword = form.find('input[name="confirm_password"]').val().trim();

      // Regular expressions for validation
      const nameRegex = /^[a-zA-Z\s]+$/;
      const usernameRegex = /^[a-zA-Z0-9_]+$/;

      // Validation flags
      let isValid = true;

      // Helper function to display error
      const showError = (elementId, message) => {
        $('#' + elementId).html(message);
        $('#' + elementId).closest('.form-group').find('.input-group').addClass('error-shake');
        setTimeout(() => {
          $('#' + elementId).closest('.form-group').find('.input-group').removeClass('error-shake');
        }, 500);
      };

      // Validation for first name
      if (!firstName) {
        showError('firstNameError', 'First name is required.');
        isValid = false;
      } else if (!nameRegex.test(firstName)) {
        showError('firstNameError', 'First name should only contain letters.');
        isValid = false;
      } else if (firstName.length > 50) {
        showError('firstNameError', 'First name should not exceed 50 characters.');
        isValid = false;
      }

      // Validation for last name
      if (!lastName) {
        showError('lastNameError', 'Last name is required.');
        isValid = false;
      } else if (!nameRegex.test(lastName)) {
        showError('lastNameError', 'Last name should only contain letters.');
        isValid = false;
      } else if (lastName.length > 50) {
        showError('lastNameError', 'Last name should not exceed 50 characters.');
        isValid = false;
      }

      // Validation for username
      if (!username) {
        showError('usernameError', 'Username is required.');
        isValid = false;
      } else if (!usernameRegex.test(username)) {
        showError('usernameError', 'Username should only contain letters, numbers, and underscores.');
        isValid = false;
      } else if (username.length < 3 || username.length > 20) {
        showError('usernameError', 'Username should be between 3 and 20 characters.');
        isValid = false;
      }

      // Validation for password
      if (!password) {
        showError('passwordError', 'Password is required.');
        isValid = false;
      } else if (password.length < 3) {
        showError('passwordError', 'Password must be at least 3 characters long.');
        isValid = false;
      }

      // Validation for confirm password
      if (!confirmPassword) {
        showError('confirmPasswordError', 'Please confirm your password.');
        isValid = false;
      } else if (password !== confirmPassword) {
        showError('confirmPasswordError', 'Passwords do not match.');
        isValid = false;
      }

      // If validation fails, reset button and do not proceed
      if (!isValid) {
        btn.prop('disabled', false);
        btnText.text('Create Account');
        spinner.hide();
        return;
      }

      // If validation passes, proceed with AJAX request
      start_loader();
      $.ajax({
        url: '../classes/Users.php?f=signup',
        data: new FormData(form[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function(resp) {
          if (resp == 1) {
            // Success animation
            $('.signup-card').addClass('success-animation');
            
            alert_toast('Account created successfully! Redirecting to login...', 'success');
            setTimeout(function() {
              location.href = 'login.php';
            }, 2000);
          } else if (resp == 3) {
            showError('usernameError', 'Username already exists. Please choose a different username.');
          } else {
            alert_toast('An error occurred. Please try again.', 'error');
          }
          end_loader();
          
          // Reset button
          btn.prop('disabled', false);
          btnText.text('Create Account');
          spinner.hide();
        },
        error: function() {
          alert_toast('An error occurred. Please try again.', 'error');
          end_loader();
          
          // Reset button
          btn.prop('disabled', false);
          btnText.text('Create Account');
          spinner.hide();
        }
      });
    });

    // Add CSS for error shake animation
    $('<style>')
      .prop('type', 'text/css')
      .html(`
        .error-shake {
          animation: shake 0.5s ease-in-out;
        }
        @keyframes shake {
          0%, 100% { transform: translateX(0); }
          25% { transform: translateX(-5px); }
          75% { transform: translateX(5px); }
        }
      `)
      .appendTo('head');
  </script>
</body>
</html>

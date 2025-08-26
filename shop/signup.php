<?php 
require_once('../config.php');

// Check if user is already logged in
if(isset($_SESSION['userdata'])) {
    header('location: index.php');
    exit;
}

$error = '';
$success = '';

// Handle form submission
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
         // Validation
     if(empty($firstname) || empty($lastname) || empty($username) || empty($password) || empty($_POST['type'])) {
         $error = "All fields are required!";
     } elseif(strlen($password) < 3) {
         $error = "Password must be at least 3 characters!";
     } elseif(strlen($username) < 3) {
         $error = "Username must be at least 3 characters!";
     } elseif(!in_array($_POST['type'], ['1', '2'])) {
         $error = "Please select a valid role!";
    } else {
        // Check if username already exists
        $check = $conn->query("SELECT * FROM users WHERE username = '$username'");
        if($check->num_rows > 0) {
            $error = "Username already exists!";
        } else {
            // Hash password
            $hashed_password = md5($password);
            
            // Handle file upload
            $avatar_path = '';
            if(isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
                $allowed = ['jpg', 'jpeg', 'png', 'gif'];
                $filename = $_FILES['img']['name'];
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                
                if(in_array($ext, $allowed)) {
                    $new_filename = time() . '_' . $filename;
                    $upload_path = '../uploads/' . $new_filename;
                    
                    if(move_uploaded_file($_FILES['img']['tmp_name'], $upload_path)) {
                        $avatar_path = 'uploads/' . $new_filename;
                    }
                }
            }
            
                         // Insert user into database
             $user_type = $_POST['type'];
             $sql = "INSERT INTO users (firstname, lastname, username, password, type, avatar) 
                     VALUES ('$firstname', '$lastname', '$username', '$hashed_password', $user_type, " . 
                     ($avatar_path ? "'$avatar_path'" : "NULL") . ")";
            
                         if($conn->query($sql)) {
                 // Get the user ID of the newly created user
                 $user_id = $conn->insert_id;
                 
                 // Fetch the user data
                 $user_data = $conn->query("SELECT * FROM users WHERE id = $user_id")->fetch_assoc();
                 
                 // Set session data for automatic login
                 $_SESSION['userdata'] = $user_data;
                 $_SESSION['userdata']['login_type'] = $user_data['type'];
                 
                 // Redirect to dashboard
                 header('location: index.php');
                 exit;
             } else {
                 $error = "Database error: " . $conn->error;
             }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - <?php echo $_settings->info('name') ?></title>
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
            background-image: url('../image.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, 
                rgba(102, 126, 234, 0.85) 0%, 
                rgba(118, 75, 162, 0.85) 50%,
                rgba(0, 0, 0, 0.7) 100%);
            z-index: 1;
        }
        
        body::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
            z-index: 2;
        }
        
        .signup-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 3rem;
            width: 100%;
            max-width: 600px;
            position: relative;
            z-index: 3;
        }
        
        /* Mobile Responsive Adjustments */
        @media (max-width: 768px) {
            .signup-container {
                max-width: 90%;
                padding: 2rem;
                margin: 20px;
            }
            
            body {
                padding: 10px;
            }
        }
        
        @media (max-width: 576px) {
            .signup-container {
                max-width: 95%;
                padding: 1.5rem;
                margin: 10px;
            }
            
            body {
                padding: 5px;
            }
        }
        
        .signup-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .signup-header h1 {
            color: #0d6efd;
            font-weight: 700;
            margin-bottom: 0.5rem;
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
        
        .btn-signup {
            background: linear-gradient(135deg, #0d6efd, #0056b3);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .btn-signup:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(13, 110, 253, 0.3);
            color: white;
        }
        
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
        }
        
        .login-link a {
            color: #0d6efd;
            text-decoration: none;
            font-weight: 600;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        
        .alert-danger {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border-left: 4px solid #dc3545;
        }
        
        .alert-success {
            background: rgba(25, 135, 84, 0.1);
            color: #198754;
            border-left: 4px solid #198754;
        }
        
        .avatar-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #e9ecef;
            margin: 1rem auto;
            display: block;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <div class="signup-header">
            <h1>
                <i class="fas fa-user-plus me-2"></i>
                Create Account
            </h1>
            <p>Join our Shop Management System</p>
        </div>
        
        <?php if($error): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        
        
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="firstname" class="form-label">
                            <i class="fas fa-user me-1"></i>First Name *
                        </label>
                        <input type="text" class="form-control" id="firstname" name="firstname" 
                               value="<?php echo isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : ''; ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="lastname" class="form-label">
                            <i class="fas fa-user me-1"></i>Last Name *
                        </label>
                        <input type="text" class="form-control" id="lastname" name="lastname" 
                               value="<?php echo isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : ''; ?>" required>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="username" class="form-label">
                    <i class="fas fa-at me-1"></i>Username *
                </label>
                <input type="text" class="form-control" id="username" name="username" 
                       value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>
            </div>
            
                         <div class="mb-3">
                 <label for="password" class="form-label">
                     <i class="fas fa-lock me-1"></i>Password *
                 </label>
                 <input type="password" class="form-control" id="password" name="password" required>
             </div>
             
             <div class="mb-3">
                 <label for="type" class="form-label">
                     <i class="fas fa-user-tag me-1"></i>Select Role *
                 </label>
                 <select class="form-control" id="type" name="type" required>
                     <option value="">Select Role</option>
                     <option value="2" <?php echo (isset($_POST['type']) && $_POST['type'] == '2') ? 'selected' : ''; ?>>Staff</option>
                     <option value="1" <?php echo (isset($_POST['type']) && $_POST['type'] == '1') ? 'selected' : ''; ?>>Shop Owner</option>
                 </select>
             </div>
            
            <div class="mb-3">
                <label for="avatar" class="form-label">
                    <i class="fas fa-camera me-1"></i>Profile Picture (Optional)
                </label>
                <input type="file" class="form-control" id="avatar" name="img" accept="image/*" onchange="previewImage(this)">
                <img id="avatarPreview" class="avatar-preview" style="display: none;" alt="Avatar Preview">
            </div>
            
            <button type="submit" class="btn btn-signup">
                <i class="fas fa-user-plus me-2"></i>Create Account
            </button>
        </form>
        
        <div class="login-link">
            Already have an account? 
            <a href="login.php">
                <i class="fas fa-sign-in-alt me-1"></i>Sign In
            </a>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatarPreview').src = e.target.result;
                    document.getElementById('avatarPreview').style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>

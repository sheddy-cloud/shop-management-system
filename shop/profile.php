<?php 
$page = 'profile';
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">My Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="./">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" 
                                 src="<?php echo validate_image($_settings->userdata('avatar')) ?>" 
                                 alt="User profile picture" 
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <h3 class="profile-username text-center">
                            <?php echo $_settings->userdata('firstname') . ' ' . $_settings->userdata('lastname') ?>
                        </h3>
                        <p class="text-muted text-center">
                            <?php echo $_settings->userdata('type') == 1 ? 'Shop Owner' : 'Staff' ?>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <!-- Profile Details -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Profile Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <strong><i class="fas fa-user mr-1"></i> First Name</strong>
                                <p class="text-muted"><?php echo $_settings->userdata('firstname') ?></p>
                            </div>
                            <div class="col-md-6">
                                <strong><i class="fas fa-user mr-1"></i> Last Name</strong>
                                <p class="text-muted"><?php echo $_settings->userdata('lastname') ?></p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <strong><i class="fas fa-at mr-1"></i> Username</strong>
                                <p class="text-muted"><?php echo $_settings->userdata('username') ?></p>
                            </div>
                            <div class="col-md-6">
                                <strong><i class="fas fa-user-tag mr-1"></i> Role</strong>
                                <p class="text-muted"><?php echo $_settings->userdata('type') == 1 ? 'Shop Owner' : 'Staff' ?></p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <strong><i class="fas fa-calendar mr-1"></i> Date Added</strong>
                                <p class="text-muted"><?php echo date('F j, Y', strtotime($_settings->userdata('date_added'))) ?></p>
                            </div>
                            <div class="col-md-6">
                                <strong><i class="fas fa-clock mr-1"></i> Last Login</strong>
                                <p class="text-muted">
                                    <?php echo $_settings->userdata('last_login') ? date('F j, Y g:i A', strtotime($_settings->userdata('last_login'))) : 'Never' ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

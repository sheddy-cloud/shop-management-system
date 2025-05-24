
<?php 
if(isset($_GET['id']) && $_GET['id'] > 0){
    $user = $conn->query("SELECT * FROM users where id ='{$_GET['id']}'");
    foreach($user->fetch_array() as $k =>$v){
        $meta[$k] = $v;
    }
}
?>
<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-body">
		<div class="container-fluid">
			<div id="msg"></div>
			<form action="" id="manage-user">	
				<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
				<div class="form-group col-6">
				<div id="firstNameError"></div>
					<label for="name">First Name</label>
					<input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo isset($meta['firstname']) ? $meta['firstname']: '' ?>" required>
				</div>
				<div class="form-group col-6">
				<div id="lastNameError"></div>
					<label for="name">Last Name</label>
					<input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo isset($meta['lastname']) ? $meta['lastname']: '' ?>" required>
				</div>
				<div class="form-group col-6">
				<div id="usernameError"></div>
					<label for="username">Username</label>
					<input type="text" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>" required  autocomplete="off">
				</div>
				<div class="form-group col-6">
				<div id="passwordError"></div>
					<label for="password">Password</label>
					<input type="password" name="password" id="Password" class="form-control" value="" autocomplete="off" <?php echo isset($meta['id']) ? "": 'required' ?>>
                    <?php if(isset($_GET['id'])): ?>
					<small class="text-info"><i>Leave this blank if you dont want to change the password.</i></small>
                    <?php endif; ?>
				</div>
				<div class="form-group col-6">
					<label for="type">User Type</label>
					<select name="type" id="type" class="custom-select" value="<?php echo isset($meta['type']) ? $meta['type']: '' ?>" required>
						<option value="1" <?php echo isset($type) && $type == 1 ? 'selected': '' ?>>Administrator</option>
						<option value="2"> <?php echo isset($type) && $type == 2 ? 'selected': '' ?>Staff</option>
					</select>
				</div>
				<div class="form-group col-6">
					<label for="" class="control-label">picture</label>
					<div class="custom-file">
		              <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" onchange="displayImg(this,$(this))">
		              <label class="custom-file-label" for="customFile">Choose file</label>
		            </div>
				</div>
				<div class="form-group col-6 d-flex justify-content-center">
					<img src="<?php echo validate_image(isset($meta['avatar']) ? $meta['avatar'] :'') ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
				</div>
			</form>
		</div>
	</div>
	<div class="card-footer">
			<div class="col-md-12">
				<div class="row">
					<button class="btn btn-sm btn-primary mr-2" form="manage-user">Save</button>
					<a class="btn btn-sm btn-secondary" href="./?page=user/list">Cancel</a>
				</div>
			</div>
		</div>
</div>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>
<script>
	$(function(){
		$('.select2').select2({
			width:'resolve'
		})
	})
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$('#manage-user').submit(function(e) {
    e.preventDefault();

    // Clear previous error messages
    $('#firstNameError').html('');
    $('#lastNameError').html('');
    $('#usernameError').html('');
    $('#passwordError').html('');
    $('#msg').html('');

    // Get form data
    const form = $(this);
    const firstName = form.find('input[name="firstname"]').val().trim();
    const lastName = form.find('input[name="lastname"]').val().trim();
    const username = form.find('input[name="username"]').val().trim();
    const password = form.find('input[name="password"]').val().trim();

    // Regular expressions for validation
    const nameSpecialCharRegex = /[^a-zA-Z]/;
    const usernameSpecialCharRegex = /[^a-zA-Z]/;
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/;

    // Validation flags
    let isValid = true;

    // Helper function to display error and scroll to the input
    const showError = (elementId, message) => {
        $('#' + elementId).html('<div class="alert alert-danger">' + message + '</div>');
        $('html, body').animate({ scrollTop: $('#' + elementId).offset().top - 10 }, 'fast');
    };

    // Validation for first name
    if (nameSpecialCharRegex.test(firstName)) {
        showError('firstNameError', 'First name should only contain letters.');
        isValid = false;
    } else if (firstName.length > 20) {
        showError('firstNameError', 'First name should not exceed 10 characters.');
        isValid = false;
    }

    // Validation for last name
    if (nameSpecialCharRegex.test(lastName)) {
        showError('lastNameError', 'Last name should only contain letters.');
        isValid = false;
    } else if (lastName.length > 20) {
        showError('lastNameError', 'Last name should not exceed 10 characters.');
        isValid = false;
    }

    // Validation for username
    if (usernameSpecialCharRegex.test(username)) {
        showError('usernameError', 'Username should only contain letters.');
        isValid = false;
    } else if (username.length > 20) {
        showError('usernameError', 'Username should not exceed 10 characters.');
        isValid = false;
    }

    // Validation for password
    if (!passwordRegex.test(password)) {
        showError('passwordError', 'Password should be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.');
        isValid = false;
    }

    // If any validation fails, do not proceed with AJAX request
    if (!isValid) {
        return;
    }

    // If validation passes, proceed with AJAX request
    $.ajax({
        url: _base_url_ + 'classes/Users.php?f=save',
        data: new FormData(form[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function(resp) {
            if (resp === 1) {
                location.href = './?page=user/list';
            } else {
                $('#msg').html('<div class="alert alert-success">User added successfully</div>');
                $("html, body").animate({ scrollTop: 0 }, "fast");
				location.href = './?page=user/list';
            }
            end_loader();
        }
    });
});

</script>
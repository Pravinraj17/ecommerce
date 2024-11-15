
<?php
include "../database/connect.php";

if (isset($_GET['token'])) {
    $token = $_GET['token'];

 $sql="select * from `user_registration` WHERE reset_token_num='$token' AND token_interval > NOW()";
 $result=mysqli_query($con,$sql);
 

    if ($result->num_rows > 0) {
        // Token is valid, show reset password form
        if (isset($_POST['change_password']))
        {
           $new_password =password_hash($_POST['reset_newpassword'],PASSWORD_DEFAULT);
            
            // Update the password in the database
          $sql="update `user_registration` set user_password='$new_password',reset_token_num = NULL, token_interval=NULL WHERE reset_token_num ='$token'";

          $result=mysqli_query($con,$sql);

             echo "<script>alert('Password updated Successfully')</script>";
             echo "<script>window.open('login.php','_self')</script>";

        }
    } else {
        echo "Invalid or expired token.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../style.css">		

	<title>Reset</title>
</head>
<body class="reset_bg">

	<div class="container mt-5 w-25">

		<h1 class="text-center text-light ">Reset Password</h1>

		<form method="post" class="form">

		<div class="my-3 mt-5">
			<label for="text" class="form-label fw-semibold text-light">New password :</label>
			<input type="text" class="form-control form-control-sm" id="new_password" name="reset_newpassword" placeholder="Enter Your New Password">
		</div>

		<div class="my-4">
			<label for="text" class="form-label fw-semibold text-light">Confirm password :</label>
			<input type="text" class="form-control form-control-sm" id="confrim_password" name="reset_confirmpassword" required placeholder="Enter Your confirm Password">
		</div>
	

		
			<button class="btn btn-primary my-3 w-100" name="change_password">Change Password</button>



		</form>
	</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>

	$(document).ready(function() {

$.validator.addMethod("passwordRule", function(value, element) {
        return this.optional(element) 
            || /[A-Z]/.test(value)      // At least one uppercase letter
            && /[a-z]/.test(value)      // At least one lowercase letter
            && /[0-9]/.test(value)      // At least one digit
            && /[\W_]/.test(value)      // At least one special character
            && value.length >= 8;       // Minimum length of 8 characters
    }, "Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one digit, and one special character.");


    $(".form").validate({
        rules: {

            reset_newpassword: {
              required:true,
              passwordRule:true,
            },

            reset_confirmpassword:
            {
                required:true,  
                equalTo:"#new_password",
            },  
        },
        messages: {

            reset_newpassword: {
                required: "Please Enter a New Password !!",
                
            },
               reset_confirmpassword:
            {
                // required: "Please Re_enter the Password ",  
                equalTo:"Your password does not match with new password !!",
            },


        },
         errorPlacement: function(error, element) {
                // Place error message directly after the input element
                error.insertAfter(element);
            },

        submitHandler: function(form) {
            alert("Form successfully submitted!");
            form.submit();  // Submits the form if all validations pass
        }
    });
});
</script>
</html>
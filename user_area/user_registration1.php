<?php
include "../database/connect.php";


function getIPAddress() {  
 
         if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                    $ip = $_SERVER['HTTP_CLIENT_IP'];  
            }   
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
         }  
        else{  
                 $ip = $_SERVER['REMOTE_ADDR'];  
         }  
         return $ip;  
    }  


    if (isset($_POST['user_register'])) {
        $user_name=$_POST['user_name'];
        $user_email=$_POST['user_email'];
        $user_password=password_hash($_POST['user_password'], PASSWORD_DEFAULT);
        $confirm_password=$_POST['confirm_password'];
        $user_image=$_FILES['user_image']['name'];
        $user_image_tmp=$_FILES['user_image']['tmp_name'];
        $ip=getIPAddress();
        $user_address=$_POST['user_address'];
        $user_mobile=$_POST['user_mobile'];
        move_uploaded_file($user_image_tmp,"./user_images/$user_image");

        $select_query="SELECT * FROM `user_registration` where (user_name='$user_name') or (user_email='$user_email')";


        $select_result=mysqli_query($con,$select_query);
        if ($num_row=mysqli_num_rows($select_result)>0) {
           
           echo "data already stored";
        }
        // elseif($user_password!=$confirm_password) {
        //     echo "password mismatch";
        // }

else{
        $insert_query="insert into `user_registration` (user_name,user_email,user_password,user_image,user_ip,user_address,user_mobile) values ('$user_name','$user_email','$user_password','$user_image','$ip','$user_address','$user_mobile')";

        $result=mysqli_query($con,$insert_query);

        if ($result) {
            
            echo "data stored";
        }

}
// selecting cart ip address

$select_cart="select * from `cart_items` where  ip_address='$ip'";

  $result_cart=mysqli_query($con,$select_cart);

  $rows_count_cart=mysqli_num_rows($result_cart);

  if ($rows_count_cart>0) {
    $_SESSION['user_login']=$user_name;
    echo "<script>alert('you have an items in your cart')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
        }  else
        {
            echo "<script>window.open('../index.php','_self')</script>";
        }    
    }
    

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User_Registration</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body class="registration">
		<div class="container mt-3 w-50">
		<h1 class="text-center text-white">User Registration</h1>
		<form method="post" action="" class="form" enctype="multipart/form-data">
		<div class="my-2 mt-3">
			<label for="username" class="form-label fw-semibold text-white">Username</label>
			<input type="text" class="form-control" id="username" name="user_name" required placeholder="Create new Username">
		</div>

		<div class="my-3">
			<label for="email" class="form-label fw-semibold text-white">Email</label>
			<input type="email" class="form-control" id="email" name="user_email" required placeholder="Enter your Email">
		</div>

		  <div class="my-3">
        <label for="password" class="form-label fw-semibold text-white">Password</label>
        <input type="password" id="password" name="user_password" placeholder="Enter Password" class="form-control" required>
    </div>

    <div class="">
        <label class="form-label fw-semibold text-white">Confirm password</label>
        <input type="text" name="confirm_password" class="form-control" id="confirm_password">
    </div>

   
		<div class="my-3">
			<label for="image" class="form-label fw-semibold text-white">User Image</label>
			<input type="file" class="form-control" id="image" name="user_image" required>
		</div>
		<div class="my-3">
			<label for="address" class="form-label fw-semibold text-white">Address</label>
			<input type="text" class="form-control" id="address" name="user_address"  placeholder="Enter Your address">
		</div>
		<div class="my-3">
			<label for="mobile" class="form-label fw-semibold text-white">Mobile Number</label>
			<input type="text" class="form-control" id="mobile" name="user_mobile" placeholder="Enter your Mobile Number">
		</div>				

		
			<div class="my-3">
		
			<input type="submit" class="btn btn-primary btn-sm w-100"  name="user_register" value="Register">
		</div>

<div class="my-3">
	
			<p class="text-white">Already Have an account? <a href="login.php" class="text-decoration-none fw-3 text-white">Login</a></p>
		</div>

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
            user_name: {
                required: true,
                minlength: 3
            },
            user_email: {
                required: true,
                email: true
            },
            user_password: {
              required:true,passwordRule:true,
            },
            user_mobile:{
            	required:true,digits:true,minlength:10

            },
            confirm_password:
            {
                required:true,  
                equalTo:"#password",
            },  
        },
        messages: {
            user_name: {
                required: "Please enter a username",
                minlength: "Your username must be at least 3 characters long"
            },
            user_email: {
                required: "Please enter an email address",
                email: "Please enter a valid email address"
            },
            user_password: {
                required: "Please provide a password",
                
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


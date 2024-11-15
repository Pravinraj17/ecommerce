<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
include "../database/connect.php";
if (isset($_POST['reset_password'])){
    $verify_email = $_POST['verify_email'];

$sql="SELECT * FROM `user_registration` WHERE user_email='$verify_email'";

$result=mysqli_query($con,$sql);

    if ($result->num_rows > 0) {
 
        $token = bin2hex(random_bytes(50));

        $sql="UPDATE `user_registration` SET reset_token_num='$token', token_interval=DATE_ADD(NOW(), INTERVAL 10 MINUTE) WHERE user_email ='$verify_email'";

        $result=mysqli_query($con,$sql);

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username = 'practisemail03@gmail.com';
        $mail->Password = 'byfdrkpntbsvvviw';
        $mail->SMTPSecure = 'PHPMailer::ENCRYPTION_STARTTLS';
        $mail->Port = 587;

        $mail->setFrom('practisemail03@gmail.com', 'Owner');
        $mail->addAddress($verify_email);

        $mail->isHTML(true);
        $mail->Subject = 'Password Reset';
        $mail->Body    = "Click on the following link to reset your password: 
                          <a href='http://localhost/tutorial/practise/ecommerce/user_area/user_reset_password.php?token=$token'>Reset Password</a>";
        
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
             echo "<script>alert('Reset Password link has been sent to your Email')</script>";
             echo "<script>window.open('login.php','_self')</script>";
        }
    } else {
        echo 'No account associated with that email.';

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

	<title>Forget</title>
</head>

<body class="forget">

	<div class="container mt-5 w-25">
		<h1 class="text-center text-light ">Forget Password</h1>
		<form method="post" class="form">
		<div class="my-3 mt-5">
			<label for="email" class="form-label fw-semibold text-light">Email :</label>
			<input type="email" class="form-control form-control-sm" id="email" name="verify_email" required placeholder="Enter Your Email">
		</div>
	

		
			<button class="btn btn-primary my-3 w-100" name="reset_password" >Reset Password</button>



		</form>
	</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>

	$(document).ready(function() {

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
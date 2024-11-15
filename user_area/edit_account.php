 <?php
 include '../database/connect.php';
 @session_start();
         
         $user_name=$_SESSION['user_login'];

         $select_image_query="select * from `user_registration` where user_name='$user_name'";
         $result_img=mysqli_query($con,$select_image_query);
         $result_rows=mysqli_fetch_array($result_img);

         $user_image=$result_rows['user_image'];

        ?>

<?php 

if (isset($_GET['my_account'])) {

    $username=$_SESSION['user_login'];

    $select_edit_query="select * from  `user_registration` where user_name='$username'";


    $result_edit=mysqli_query($con,$select_edit_query);

    $row_edit=mysqli_fetch_assoc($result_edit);

    $user_id=$row_edit['user_id'];
    $user_name=$row_edit['user_name'];
    $user_email=$row_edit['user_email'];
    $user_address=$row_edit['user_address'];
    $user_mobile=$row_edit['user_mobile'];
    
}


if (isset($_POST['edit_user_account'])) {
     
     $update_user_name=$_POST['edit_user_name'];
     $update_user_email=$_POST['edit_user_email'];
     $update_user_address=$_POST['edit_user_address'];
     $update_user_mobile=$_POST['edit_user_mobile'];
     $update_user_image=$_FILES['edit_user_image']['name'];
     $update_user_image_tmp=$_FILES['edit_user_image']['tmp_name'];

     move_uploaded_file($update_user_image_tmp,"./user_images/$update_user_image");

     $update_user="update `user_registration` set user_name='$update_user_name', user_email='$update_user_email',user_image='$update_user_image',user_address='$update_user_address',user_mobile='$update_user_mobile' where user_id=$user_id";

     $update_result=mysqli_query($con,$update_user);

     if ($update_result) {
         echo "<script>alert('Your Data Updated Successfully')</script>";
         echo "<script>window.open('../index.php','_self')</script>";
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
	<title>edit_account</title>
</head>
<body class="bg-secondary">

      <h2 class="fst-italic text-center mt-0 text-light">Edit profile</h2>

	<div class="containerbg-primary">

		

		<form class="form " method="post" enctype="multipart/form-data">

			<div class="profile_img text-center my-3">
            <img src="./user_images/<?php echo $user_image; ?>" class="rounded-circle">

			</div>
          
          <div class="mt-3 input-group w-50 m-auto">
          	<span class="input-group-text"><i class="bi bi-pencil-square"></i></span>
          	<input type="text" name="edit_user_name" class="form-control form-control-sm" value="<?php echo $user_name;?>">
          </div>

          <div class="mt-3 input-group w-50 m-auto">
          	<span class="input-group-text"><i class="bi bi-pencil-square"></i></span>         	
          	<input type="email" name="edit_user_email" class="form-control form-control-sm" value="<?php echo $user_email;?>">	
          </div>

          <div class="mt-3 input-group w-50 m-auto">
              <input type="file" name="edit_user_image" class="form-control form-control-sm">       
          </div>

          <div class="mt-3 input-group w-50 m-auto">
          	<span class="input-group-text"><i class="bi bi-pencil-square"></i></span>
          	<input type="text" name="edit_user_address" class="form-control form-control-sm" value="<?php echo $user_address;?>">	
          </div>

          <div class="mt-3 input-group w-50 m-auto">
          	<span class="input-group-text"><i class="bi bi-pencil-square"></i></span>
          	<input type="text" name="edit_user_mobile" class="form-control form-control-sm" value="<?php echo $user_mobile;?>">	
          </div>

          <div class="my-3 text-center">
 
          	<button class="btn btn-warning" name="edit_user_account">update</button>
          
          </div>


			

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
            edit_user_name: {              
                minlength: 3
            },
            edit_user_email: {              
                email: true
            },
            edit_user_mobile:{
            	digits:true,minlength:10

            },  
        },
        messages: {
            edit_user_name: {
                minlength: "Your username must be at least 3 characters long",
            },
            edit_user_email: {
                email: "Please enter a valid email address"
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
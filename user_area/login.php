<?php
include "../database/connect.php";
@session_start();


if (isset($_POST['login'])) {
	include "../database/connect.php";

	$user_login_name=$_POST['user_login_name'];
	$user_login_password=$_POST['user_login_password'];
  $ip=getIPAddress();
   
   $sql="select * from `user_registration` where  user_name='$user_login_name'";
   $result=mysqli_query($con,$sql);
   
   $num_row=mysqli_num_rows($result);
     
   $row=mysqli_fetch_assoc($result);


   // select query to cart 

   $select_query_cart="select * from `cart_items` where  ip_address='$ip'";

   $result_cart=mysqli_query($con,$select_query_cart);

   $row_count_cart=mysqli_num_rows($result_cart);

   if ($num_row>0) {  
    $_SESSION['user_login']=$user_login_name;
   
   if (password_verify($user_login_password,$row['user_password'])) {
    if ($num_row==1 and $row_count_cart==0) {
      $_SESSION['user_login']=$user_login_name;
      echo "<script>alert('login successfully')</script>";
      echo "<script>window.open('profile.php','_self')</script>";
    }else
    {
      $_SESSION['user_login']=$user_login_name;
     echo "<script>alert('login successfully')</script>";
      echo "<script>window.open('payment.php','_self')</script>"; 
    }
   
            }else
            {
              echo "<script>alert('invalid credentials')</script>";
            }

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
	<title>login</title>
</head>
<body class="login">
	<div class="container-fluid mt-5 w-25">
		<h1 class=" mt-5 text-center text-white">Login</h1>

	<form action="" method="post">
  <div class="mb-3 mt-4">
    <label for="exampleInputEmail1" class="form-label text-white">User name :</label>
    <input type="text" class="form-control form-control-sm" id="exampleInputEmail1" name="user_login_name" required placeholder="Enter Your username">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label text-white">Password :</label>
    <input type="password" class="form-control form-control-sm" name="user_login_password" id="password" placeholder="Enter Your Password">
  </div>

  <div class="my-3">
    <a href="user_forget.php">Forget Password ?</a>
  </div>

  <div class="my-3">
    <a href="user_registration1.php">Dont have an account?  Register</a>
  </div>

  <button type="submit" class="btn btn-primary" name="login">Login</button>
</form>

</div>

</body>
</html>
<?php
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
    ?>
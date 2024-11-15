<?php

$delete_user_name=$_SESSION['user_login'];

if (isset($_POST['delete_account'])) {
	
	$delete_user_account="delete from `user_registration` where user_name = '$delete_user_name'";
	$result_delete=mysqli_query($con,$delete_user_account);

	if ($result_delete) {
		session_destroy();
		 echo "<script>alert('Account Deleted Successfully')</script>";
		 echo"<script>window.open('user_registration1.php','_self')</script>";
	}
}

if (isset($_POST['dont_delete_account'])) {
     echo "<script>alert('Your Account is not Deleted. Thank You!!!!!!!!')</script>";
	echo"<script>window.open('../index.php','_self')</script>";
	
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Delete account</title>
</head>
<body>

	<h3 class="text-danger text-center mt-5">Delete Account</h3>

	<form action="" method="post">
		
		<div class="text-center mt-5">
			<input type="submit" name="delete_account" class="btn btn-danger w-50" value="Delete Account">
		</div>

		<div class="text-center mt-5">
			<input type="submit" name="dont_delete_account" class="btn btn-primary w-50" value="Don't Delete Account">
		</div>

	</form>

</body>
</html>
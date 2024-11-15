<?php
include '../database/connect.php';

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="../style.css">
	<title>Payment</title>
</head>

<body style="background-image: url(../images/bg.jpg); background-repeat: no-repeat; object-fit: contain; background-size: cover;">

<?php


$ip=getIPAddress();

$select_user_query="select * from `user_registration`  where user_ip='$ip'";
$result=mysqli_query($con,$select_user_query);
$run_query=mysqli_fetch_array($result);
$user_id=$run_query['user_id'];
?>

<div class="container">

	<h2 class="mt-4 text-center text-info fst-italic img-thumbnail">Payment Method</h2>
	
	<div class="row d-flex align-items-center">
		
		<div class="col-md-6 my-5 img-thumbnail">
			<a href="javascript:void(0)" class="text-decoration-none text-dark btn btn-info w-100 fw-bold">
				 Pay-online
			</a>

			<p class="mt-4 p-5 text-dark text-center"> by using pay online method you can directly access with UPI payment, Credit and Debit card, to purchase items</p>
			

		</div>

		<div class="col-md-6 my-5 img-thumbnail">
			<a href="order.php?user_id=<?php echo $user_id;?>" class="text-decoration-none text-dark btn btn-info w-100 fw-bold">
				 Pay-offline
			</a>
				<p class="mt-1 p-5 text-dark text-center"> by using pay offline method  the items should be cash on delivery.once you recieved order items and then you should pay the cash<;p>

		</div>

	</div>

</div>	

</body>
</html>

<?php

        function getIPAddress() {  
        //whether ip is from the share internet  
         if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                    $ip = $_SERVER['HTTP_CLIENT_IP'];  
            }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
         }  
    //whether ip is from the remote address  
        else{  
                 $ip = $_SERVER['REMOTE_ADDR'];  
         }  
         return $ip;  
    }  
    $ip = getIPAddress(); 

?>
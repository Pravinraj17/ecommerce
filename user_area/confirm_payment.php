<?php
include '../database/connect.php';


if (isset($_GET['order_id'])) {

	$order_id=$_GET['order_id'];

	$select_query="select * from `user_orders` where order_id=$order_id";
     
     $result=mysqli_query($con,$select_query);

     $row_confirm_orders=mysqli_fetch_assoc($result);

     $invoice_number=$row_confirm_orders['invoice_number'];
     $amount_due=$row_confirm_orders['amount_due'];
     $total_products=$row_confirm_orders['total_products'];
}

if (isset($_POST['payment_confirm'])) {
	$invoice_pay_number=$_POST['invoice_number'];
	$amount_pay=$_POST['amount'];
	$total_pay_product=$_POST['total_product'];
	$payment_mode=$_POST['payment_mode'];

	$insert_payment_query="insert into `payment` (order_id,invoice_number,amount,total_product,payment_mode) values ($order_id,$invoice_pay_number,$amount_pay,$total_pay_product,'$payment_mode')";


	$result_pay=mysqli_query($con,$insert_payment_query);

	if ($result_pay) {
		 
		 echo "<script>alert('Your Payment has been Successfully Completed')</script>";
		 echo"<script>window.open('profile.php?my_orders','_self')</script>";
	}

	$update_pay_query="update `user_orders` set order_status='Completed' where order_id=$order_id";
	$result_update_pay=mysqli_query($con,$update_pay_query);


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
	<title>Confrim Payment</title>
</head>
<body class="confrim_payment">
	<h2 class="text-center mt-4 text-light">Confirm Payment</h2>
	

	<div class="container mt-5">



<div class="card w-25 m-auto">
	<form method="post" action="">

		<div class="my-2 ms-3">
			<input type="text" name="invoice_number" value="<?php echo $invoice_number;?>">
		</div>
		<div class="my-2 ms-3">
			<input type="text" name="amount" value="<?php echo $amount_due;?>">
		</div>
         
        <div class="my-2 ms-3">
        	<input type="text" name="total_product" value="<?php echo $total_products; ?>">
		</div>

		<div class="my-3 ms-3">
			<select class="" name="payment_mode">
				<option value ="">Select Payment Method</option>
				<option>UPI</option>
				<option>Paytm</option>
				<option>Credit card</option>
				<option>Debit card</option>
				<option>Cash on Delivery</option>
			</select>
		</div>

		<div class="text-center my-4">

			<input type="submit" class="btn btn-primary btn-sm" name="payment_confirm" value="confirm">
		</div>
		</form>
	</div>


</div>


</body>
</html>
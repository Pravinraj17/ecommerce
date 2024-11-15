<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../style.css">
	<title>Order details</title>
</head>
<body>
	<?php

	$user_name=$_SESSION['user_login'];

	$select_user_order="select * from `user_registration` where user_name='$user_name'";

	$result_order_details=mysqli_query($con,$select_user_order);

	$row_order_details=mysqli_fetch_assoc($result_order_details);

	$user_id=$row_order_details['user_id'];


	?>


<div class="container">
	<h3 class="text-center">Order Status</h3>
	<table class="table table-bordered">
<thead >
	<tr class="bg-primary">
		<th>SI no</th>
		<th>Order number</th>
		<th>Product_image</th>
		<th>Amount Due</th>
		<th>Quantity</th>
		<th> Total products</th>
		<th>Invoice number</th>
		<th>Date</th>
		<th>Complete/Incomplete</th>
		<th>Status</th>
	</tr>
</thead>

<tbody>

	<?php



	$get_order_details="select * from `user_orders` where user_id=$user_id";
	$result_get_orders=mysqli_query($con,$get_order_details);
	$number=1;

	while ($row_get_order_details=mysqli_fetch_assoc($result_get_orders)) {
		$order_id=$row_get_order_details['order_id'];

// quantity details
	$get_quantity_details="select * from `pending_orders` where order_id=$order_id";
	$result_quantity_detail=mysqli_query($con,$get_quantity_details);
	while ($row_get_quantity_details=mysqli_fetch_assoc($result_quantity_detail)) {
		$quantity_detail=$row_get_quantity_details['quantity'];
	}


		$amount_due=$row_get_order_details['amount_due'];
		$invoice_number=$row_get_order_details['invoice_number'];
		$total_products=$row_get_order_details['total_products'];
		$order_date=$row_get_order_details['order_date'];
		$order_status=$row_get_order_details['order_status'];

		if ($order_status=='pending') {
			$order_status='Incomplete';
		}
		echo "<tr>
		<td>$number</td>
		<td>$order_id</td>
		<td>product Image</td>		
		<td>$amount_due</td>
		<td>$quantity_detail </td>
		<td>$total_products</td>	
		<td>$invoice_number</td>
		<td>$order_date</td>
		<td>$order_status</td>";
?>
<?php
if ($order_status=='Completed') {

	echo "<td>Paid</td>";
	

}else
{
	echo 	"<td> <a href='confirm_payment.php?order_id=$order_id' class='btn btn-primary'> Confirm</a> </td>
	</tr>";
}


	
	$number++;
}

	


	?>

</tbody>

</table>


</div>

</body>
</html>
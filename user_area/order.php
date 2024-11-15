<?php
include('../database/connect.php');

// include('../function_files/common_function.php'); bug


if (isset($_GET['user_id'])) {
	
$user_id=$_GET['user_id'];
$ip=getIPAddress();
$total_price=0;
$invoice_number=mt_rand();
$status='pending';

$select_cart_price="select * from `cart_items` where ip_address='$ip'";

$cart_result=mysqli_query($con,$select_cart_price);

$cart_count_rows=mysqli_num_rows($cart_result);

while ($row_cart_list=mysqli_fetch_array($cart_result)) {

	$product_id=$row_cart_list['product_id'];

	$select_product_query="select * from `products` where product_id=$product_id";

	$result_product=mysqli_query($con,$select_product_query);

	$product_count_price=mysqli_num_rows($result_product);
	while ($row_product_price=mysqli_fetch_array($result_product)) {
		
		$product_price=array($row_product_price['product_price']);
		$product_total_price=array_sum($product_price);

		$total_price+=$product_total_price;
	}

}


}


// updating quantity into total price

$select_qunatity_query="select * from `cart_items`";
$run_quantity_cart=mysqli_query($con,$select_qunatity_query);
$get_quantity=mysqli_fetch_array($run_quantity_cart);

$quantity=$get_quantity['quantity'];

if ($quantity==0) {
	$quantity=1;
	$subtotal=$total_price;
}else
{
	$quantity=$quantity;
	$subtotal=$total_price*$quantity;
}

// inserting items into database `user_orders`;

$insert_orders_query="insert into `user_orders` (user_id,amount_due,invoice_number,total_products,order_date,order_status) values ($user_id,$subtotal,$invoice_number,$cart_count_rows,now(),'$status')";

$result_order=mysqli_query($con,$insert_orders_query);

if ($result_order) {
	echo "<script>'orders submitted successfully'</script>";
	echo"<script>window.open('profile.php','_self')</script>";
}


// inserting orders pending table

$insert_order_pending ="insert into `pending_orders` (user_id,invoice_number,product_id,quantity,order_status) values ($user_id,$invoice_number,$product_id,$quantity,'$status')";
$result_order_pending=mysqli_query($con,$insert_order_pending);

// delete cart items

$delete_cart_items="delete from `cart_items` where ip_address='$ip'";
$result_delete_cart=mysqli_query($con,$delete_cart_items);



?>





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
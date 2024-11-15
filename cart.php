<?php
include './database/connect.php';
include './function_files/common_function.php';
session_start();
$user_name=$_SESSION['user_login'];

         $select_image_query="select * from `user_registration` where user_name='$user_name'";
         $result_img=mysqli_query($con,$select_image_query);
         $result_rows=mysqli_fetch_array($result_img);
  
         $user_image=$result_rows['user_image'];
?>  
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="style.css">

	<title>E-commerce_cart_page</title>
</head>
<body>

  <div class="container-fluid p-0">


    <!-- first-child -->
	<nav class="navbar navbar-expand-lg p-0">
		
     <div class="container-fluid p-0 bg-primary">
     
  <div class="navbar-brand mx-5">
    <a href="./user_area/profile.php">   <img src="./user_area/user_images/<?php echo $user_image;?>" style="width:100% !important;height: 40px!important;" class="rounded-circle"></a>
     </div> 
     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar"></button>

     <div class="collapse navbar-collapse" id="mynavbar">
     	<ul class="navbar-nav">
     		<li class="nav-item mx-3">
     			<a href="index.php" class="nav-link fw-semibold">Home</a>
     		</li>
            <li class="nav-item mx-3">
          <a href="all_products.php" class="nav-link fw-semibold">products</a>
        </li>
            <li class="nav-item mx-3">
          <a href="javascript:void(0)" class="nav-link fw-semibold">Register</a>
        </li>
            <li class="nav-item mx-3">
          <a href="javascript:void(0)" class="nav-link fw-semibold">Contact</a>
        </li>
            <li class="nav-item mx-2">
          <a href="cart.php" class="nav-link fw-semibold"><i class="bi bi-cart-fill"></i> <sup><?php cart_item_display(); ?></sup> </a>
        </li>
          </li>

     	</ul>

     </div>

     </div>

	</nav>

  <!-- second child -->

  <nav class="navbar navbar-expand-lg bg-secondary">

     <ul class="navbar-nav">
       
      
        <?php
        if (!isset ($_SESSION['user_login'])) {
       echo " <li class='nav-item'><a class='nav-link' href='javascript:void(0)'>Welcome Guest</a></li>";
        
      }else
      {
        echo " <li class='nav-item'><a class='nav-link' href='javascript:void(0)'> Welcome ".$_SESSION['user_login']."</a></li>";
      }
      
       if (!isset($_SESSION['user_login'])) {
        echo "<li class='nav-item'><a class='nav-link' href='./user_area/login.php'>Login</a></li>";
       }else
       {
        echo "<li class='nav-item'><a class='nav-link' href='./user_area/logout.php'>Logout</a></li>";
       }

       ?>
     </ul>

  </nav>

  <!-- third child -->
  <div class="bg-light text-center">
    
      <h2> Hidden Store</h2>

       <h6 class="fw-semibold ">Communication is at all heart of e-commerce and community</h6>

  </div>

  <!-- fourth child -->
  
<div class="container">
  <div class="row">
    <form action="" method="post">

   <!--  <table class="table">
      <thead>
        <tr>
          <th>Product title</th>
          <th>Product Image</th>
          <th>Total price</th>
          <th>Quantity</th>
          <th>Remove</th>
          <th class="text-center">Operations</th>

        </tr>
      </thead>

      <tbody> -->
      <!-- php cart function -->

      <?php
        global $con; 

  $ip = getIPAddress();
  $total_price=0;

  $cart_query="SELECT * FROM `cart_items` where ip_address='$ip'";

  $result=mysqli_query($con,$cart_query);
  $result_count=mysqli_num_rows($result);

  if ($result_count>0) {
    echo "<table class='table'>
      <thead>
        <tr>
          <th>Product title</th>
          <th>Product Image</th>
          <th>Total price</th>
          <th>Quantity</th>
          <th>Remove</th>
          <th class='text-center'>Operations</th>

        </tr>
      </thead>

      <tbody>";


  while ($row=mysqli_fetch_array($result)) {

    $product_id=$row['product_id'];

    $select_products="SELECT * FROM `products` where product_id='$product_id'";

      $result_products=mysqli_query($con,$select_products);

      while ($row_product_price=mysqli_fetch_array($result_products)) {

        $product_price=array($row_product_price['product_price']);
         $product_price1=$row_product_price['product_price'];
        $product_title=$row_product_price['product_description'];
        $product_image1=$row_product_price['product_image1'];
        $product_values=array_sum($product_price);
        $total_price+=$product_values;

      ?>

      <?php
      
if (isset($_POST['update_cart_item'])) {

    $ip = getIPAddress();
    $qty = $_POST['qty'];

    // Validate that qty is a number and greater than 0
    if (is_numeric($qty) && $qty > 0) {
        // Sanitize qty
        $qty = mysqli_real_escape_string($con, $qty);

        // Prepare the query
        $update_cart_query = "UPDATE `cart_items` SET quantity = '$qty' WHERE ip_address = '$ip'";

        // Execute the query
        $result_cart = mysqli_query($con, $update_cart_query);

        // If the query succeeds
        if ($result_cart) {
            // Update the total price
            $total_price = $total_price * $qty;
        } else {
            // If there was an error executing the query
            echo "Error updating the cart: " . mysqli_error($con);
        }
    } else {
        echo "Invalid quantity value.";
    }
}



      ?>
        <tr>
          <td><?php echo $product_title; ?></td>  
          <td><img src="./product_images/<?php echo $product_image1; ?>" class="cart_img"></td>
          <td><?php echo $product_price1; ?> /-</td>

        <td><input type="text" name="qty" class="form-control form-control-sm w-50" values="<?php echo $product_id;?>"> </td>

          
          <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id;?>"><td>


          <td>
            <input type="submit" name="update_cart_item" class="btn btn-primary btn-sm" value="Update Item">
            <input type="submit" name="remove_cart_item" class="btn btn-danger btn-sm" value="Remove Item">
          </td>
        </tr>



        <?php
      }
    }  }else{
      echo "<h2 class='text-center text-danger fst-italic my-5'> No Cart items can been stored</h2>";
    }
        ?>
      </tbody>
    </table>

    <!-- subtotal -->

    <div class="d-flex">

          <?php
        global $con; 

  $ip = getIPAddress();
  

  $cart_query="SELECT * FROM `cart_items` where ip_address='$ip'";

  $result=mysqli_query($con,$cart_query);
  $result_count=mysqli_num_rows($result);

  if ($result_count>0) {

    echo "<h5 class='px-3'> Amount: <strong></strong>$total_price /-</h5>
      <a href='index.php' class='btn btn-primary btn-sm mb-3'>Continue Shopping</a>
      <a href='./user_area/checkout.php' class='btn btn-secondary btn-sm mb-3 mx-3'>Check Out</a>";
  }else
  {
    echo "<a href='index.php' class='btn btn-primary btn-sm mb-3'>Continue Shopping</a>";
  }
  ?>

  <!--     <h5 class='px-3'> Amount: <strong></strong><?php echo $total_price; ?> /-</h5>
      <a href='index.php' class='btn btn-primary btn-sm mb-3'>Continue Shopping</a>
      <a href='javascript:void(0)' class='btn btn-secondary btn-sm mb-3 mx-3'>Check Out</a> -->
    </div>
 
    
  </div>


</div>
   </form>

<!-- function to remove item from cart-->

<?php

function removecart_item() {
    global $con;

    if (isset($_POST['remove_cart_item'])) {
        // Check if 'removeitem' is set and is an array
        if (isset($_POST['removeitem']) && is_array($_POST['removeitem'])) {
            foreach ($_POST['removeitem'] as $removeid) {
                // Sanitize removeid
                $removeid = mysqli_real_escape_string($con, $removeid);

                $delete_query = "DELETE FROM `cart_items` WHERE product_id = '$removeid'";

                $delete = mysqli_query($con, $delete_query);

                if ($delete) {
                    echo "<script>window.open('cart.php', '_self')</script>";
                }
            }
        } else {
            echo "<script> alert('No items were selected for removal.')</script>";
        }
    }
}
echo $removeid = removecart_item();

?>





<!-- last-child -->
<div class="bg-primary">

    <p class="text-center text-muted fw-semibold fst-italic">All rights reserved &copy-Designed By Praveen web-Developer 2024</p>
    
  </div>

  </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</html>

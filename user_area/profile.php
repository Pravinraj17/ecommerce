<?php
include '../database/connect.php';

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
    
  <link rel="stylesheet" type="text/css" href="../style.css">   

	<title>E-commerce_Home</title>
</head>
<body>

  <div class="container-fluid p-0">


    <!-- first-child -->
	<nav class="navbar navbar-expand-lg p-0">
		
     <div class="container-fluid p-0 bg-primary">
     
  <div class="navbar-brand mx-5">
     	<img src="./user_images/<?php echo $user_image;?>" style="width:100% !important;height: 40px!important;" class="rounded-circle">
     </div> 
     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar"></button>

     <div class="collapse navbar-collapse" id="mynavbar">
     	<ul class="navbar-nav">
     		<li class="nav-item mx-3">
     			<a href="../index.php" class="nav-link fw-semibold">Home</a>
     		</li>
            <li class="nav-item mx-3">
          <a href="../all_products.php" class="nav-link fw-semibold">products</a>
        </li>
            <li class="nav-item mx-3">
          <a href="javascript:void(0)" class="nav-link fw-semibold">Register</a>
        </li>
            <li class="nav-item mx-3">
          <a href="javascript:void(0)" class="nav-link fw-semibold">Contact</a>
        </li>
            <li class="nav-item mx-2">
          <a href="../cart.php" class="nav-link fw-semibold"><i class="bi bi-cart-fill"></i> <sup><?php cart_item_display(); ?></sup> </a>
        </li>
          </li>
      <li class="nav-item mx-3">
          <a href="javascript:void(0)" class="nav-link fw-semibold">Total price:<?php total_cart_price(); ?>/-</a>
        </li>

     	</ul>

  <form action="../search_product.php" method="get">
    <div class="input-group ms-5">
      
      <input type="text" class="form-control form-control-sm" placeholder="Search" name="search_data">

      <input type="submit" name="search_data_products" value="search" class="btn btn-outline-light btn-sm">
     
    </div>
  </form>

     </div>

     </div>

	</nav>

  <!-- second child 

  <nav class="navbar navbar-expand-lg bg-secondary">

     <ul class="navbar-nav">
       
       
       <?php
      //  if (!isset ($_SESSION['user_login'])) {
      //  echo " <li class='nav-item'><a class='nav-link' href='javascript:void(0)'>Welcome Guest</a></li>";
        
      // }else
      // {
      //   echo " <li class='nav-item'><a class='nav-link' href='javascript:void(0)'> Welcome ".$_SESSION['user_login']."</a></li>";
      // }
      //  if (!isset($_SESSION['user_login'])) {
      //   echo "<li class='nav-item'><a class='nav-link' href='login.php'>Login</a></li>";
      //  }else
      //  {
      //   echo "<li class='nav-item'><a class='nav-link' href='logout.php'>Logout</a></li>";
      //  }

       ?>
     </ul>

  </nav>-->

  <!-- third child -->
  <div class="bg-light text-center">
    
      <h2 class="fst-italic"> Betta Store</h2>

       <!-- <h6 class="fw-semibold "></h6> -->

  </div>

  <!-- fourth child -->
  
<div class="row fourth-child1">
  <div class="col-md-2">
   <ul class="navbar-nav bg-secondary">

    <li class="nav-item text-center mt-2">
          <a href="javascript:void(0)" class="nav-link fw-semibold text-light fst-italic">Your Account</a>
        </li>

        <?php
         
         $user_name=$_SESSION['user_login'];

         $select_image_query="select * from `user_registration` where user_name='$user_name'";
         $result_img=mysqli_query($con,$select_image_query);
         $result_rows=mysqli_fetch_array($result_img);

         $user_image=$result_rows['user_image'];
         echo "<li class='nav-item mx-3 mt-2 profile_images text-center rounded-circle'>
                <img src='./user_images/$user_image'>
 
        </li>";

        ?>
        <li class="nav-item  mt-2 text-center ">
          <a href="profile.php" class="nav-link fw-semibold">Pending orders</a>
        </li>
        <li class="nav-item  text-center mt-2">
          <a href="profile.php?my_account" class="nav-link fw-semibold">Edit Account</a>
        </li>
        <li class="nav-item  text-center mt-2">
          <a href="profile.php?my_orders" class="nav-link fw-semibold">My orders</a>
        </li>
        <li class="nav-item  text-center mt-2">
          <a href="profile.php?delete_account" class="nav-link fw-semibold">Delete Account</a>
        </li>
        <li class="nav-item text-center mt-1">
          <a href="logout.php" class="nav-link fw-semibold">Logout</a>
        </li>

      

    </ul>
  </div>
  <div class="col-md-10">
    
    <?php
    pending_orders(); 

    if (isset($_GET['my_account'])) {
      include "edit_account.php";
    }
     if (isset($_GET['my_orders'])) {
      include "order_details.php";
    }
     if (isset($_GET['delete_account'])) {
      include "delete_account.php";
    }
    ?>

  </div>
</div>
  


<!-- last-child -->
<div class="bg-primary p-0">

    <p class="text-center text-muted fw-semibold fst-italic">All rights reserved &copy-Designed By Praveen web-Developer 2024</p>
    
  </div>

  </div>


</body>


</html>











































































<!-- functions -->

<?php
  include '../database/connect.php';


  function carditem_display()
  {
  global $con;

  if (!isset($_GET['category'])) {
    if (!isset($_GET['brand'])) {
 

    
     $select_query="select * from `products` order by rand() limit 0,6";

   $result=mysqli_query($con,$select_query);
   while ($row=mysqli_fetch_assoc($result)) {

    $product_id=$row['product_id'];
     $product_title=$row['product_title'];
      $product_description=$row['product_description'];
       $product_keyword=$row['product_keyword'];
        $cat_id=$row['cat_id'];
         $brand_id=$row['brand_id'];
           $product_image1=$row['product_image1'];
            $product_price=$row['product_price'];

            echo " <div class='col-md-4 my-2'>
         <div class='card'>
           <img src='./product_images/$product_image1'>
           <div class='card-body'>
             <h5 class='card-title'>$product_description</h5>
             <p class='fw-semibold'>$product_keyword</p>
               <p class='card-text'>Rs: $product_price  /-</p>
             <a href='index.php?add_to_cart=$product_id' class='btn btn-sm btn-primary'>Add to cart</a>
             <a href='view_more.php?view_more=$product_id' class='btn btn-sm btn-secondary'>View more</a>
           </div>
         </div>
       </div>";
  




    
   }
  }
    }
      }


    // all products display


        function all_products()
  {
  global $con;

  if (!isset($_GET['category'])) {
    if (!isset($_GET['brand'])) {
 

    
     $select_query="select * from `products`";

   $result=mysqli_query($con,$select_query);
   while ($row=mysqli_fetch_assoc($result)) {

    $product_id=$row['product_id'];
     $product_title=$row['product_title'];
      $product_description=$row['product_description'];
       $product_keyword=$row['product_keyword'];
        $cat_id=$row['cat_id'];
         $brand_id=$row['brand_id'];
           $product_image1=$row['product_image1'];
            $product_price=$row['product_price'];

            echo " <div class='col-md-4 my-2'>
         <div class='card'>
           <img src='./product_images/$product_image1'>
           <div class='card-body'>
             <h5 class='card-title'>$product_description</h5>
             <p class='fw-semibold'>$product_keyword</p>
               <p class='card-text'>Rs: $product_price  /-</p>
             <a href='index.php?add_to_cart=$product_id' class='btn btn-sm btn-primary'>Add to cart</a>
             <a href='view_more.php?view_more=$product_id' class='btn btn-sm btn-secondary'>View more</a>
           </div>
         </div>
       </div>";
  


    
   }
  }
    }
      }

// catergory item display
      function categoryitem_display()
  {
  global $con;

  if (isset($_GET['category'])) {

    $categories_id=$_GET['category'];

 

    
     $select_query="select * from `products` where cat_id='$categories_id' ";

   $result=mysqli_query($con,$select_query);

   $num_rows=mysqli_num_rows($result);

   if ($num_rows==0) {
      echo "<h2 class='text-center text-danger fst-italic mt-5'> Sorry!! These variety of betta Not Available in store. <br> We will update once it has available.. Thank you!</h2>";
   }
   while ($row=mysqli_fetch_assoc($result)) {

    $product_id=$row['product_id'];
     $product_title=$row['product_title'];  
      $product_description=$row['product_description'];
       $product_keyword=$row['product_keyword'];
        $cat_id=$row['cat_id'];
         $brand_id=$row['brand_id'];
           $product_image1=$row['product_image1'];
            $product_price=$row['product_price'];

            echo " <div class='col-md-4 my-2'>
         <div class='card'>
           <img src='./product_images/$product_image1'>
           <div class='card-body'>
             <h5 class='card-title'>$product_description</h5>
             <p class='fw-semibold'>$product_keyword</p>
               <p class='card-text'>Rs: $product_price  /-</p>
             <a href='index.php?add_to_cart=$product_id' class='btn btn-sm btn-primary'>Add to cart</a>
             <a href='view_more.php?view_more=$product_id' class='btn btn-sm btn-secondary'>View more</a>
           </div>
         </div>
       </div>";
  


    
   }
  }
    }


      function branditem_display()
  {
  global $con;

  if (isset($_GET['brand'])) {

    $brand_id=$_GET['brand'];

 

    
    $select_query="select * from `products` where brand_id='$brand_id'";

   $result=mysqli_query($con,$select_query);

   $num_rows=mysqli_num_rows($result);

   if ($num_rows==0) {
      echo "<h2 class='text-center text-danger fst-italic'> Sorry!! These type of tailed betta Not Available in store.. Thank you!</h2>";
   }



   while ($row=mysqli_fetch_assoc($result)) {

    $product_id=$row['product_id'];
     $product_title=$row['product_title'];
      $product_description=$row['product_description'];
       $product_keyword=$row['product_keyword'];
        $cat_id=$row['cat_id'];
         $brand_id=$row['brand_id'];
           $product_image1=$row['product_image1'];
            $product_price=$row['product_price'];

            echo " <div class='col-md-4 my-2'>
         <div class='card'>
           <img src='./product_images/$product_image1'>
           <div class='card-body'>
             <h5 class='card-title'>$product_description</h5>
             <p class='fw-semibold'>$product_keyword</p>
               <p class='card-text'>Rs: $product_price  /-</p>
             <a href='index.php?add_to_cart=$product_id' class='btn btn-sm btn-primary'>Add to cart</a>
             <a href='view_more.php?view_more=$product_id' class='btn btn-sm btn-secondary'>View more</a>
           </div>
         </div>
       </div>";
  


    
   }
  }
    }

    // category display

function categoriesdisplay(){
  global $con;

              $select_query='select * from `categories`';

             $result=mysqli_query($con,$select_query);

             while ($row=mysqli_fetch_assoc($result)) {

             $category_title=$row['cat_name'];
             $cat_id=$row['cat_id'];

             echo  "<li class='nav-item mt-3'>
                       <a href='index.php?category=$cat_id' class='nav-link text-center text-white'>$category_title</a>
                   </li>";
          }

}

// brand display

function brand_display()
{
  global $con;

   $select_query='select * from `brand`';

             $result=mysqli_query($con,$select_query);

             while ($row=mysqli_fetch_assoc($result)) {

             $brand_title=$row['brand_title'];
             $brand_id=$row['brand_id'];

             echo  "<li class='nav-item mt-3'>
                       <a href='index.php?brand=$brand_id' class='nav-link text-center text-white'>$brand_title</a>
                   </li>";
                }


}



// getting search product


function search_products()
{
    global $con;

    if (isset($_GET['search_data_products'])) {
      $search_data=$_GET['search_data'];
   
     $search_query="Select * from `products` where product_keyword like '%$search_data%'";

   $result=mysqli_query($con,$search_query);

    $num_rows=mysqli_num_rows($result);

   if ($num_rows==0) {
      echo "<h2 class='text-center text-danger fst-italic mt-5'> Sorry!! This variety not in Our Store...</h2>";
   }
   while ($row=mysqli_fetch_assoc($result)) {

    $product_id=$row['product_id'];
     $product_title=$row['product_title'];
      $product_description=$row['product_description'];
       $product_keyword=$row['product_keyword'];
        $cat_id=$row['cat_id'];
         $brand_id=$row['brand_id'];
           $product_image1=$row['product_image1'];
            $product_price=$row['product_price'];

            echo " <div class='col-md-4 my-2'>
         <div class='card'>
           <img src='./product_images/$product_image1'>
           <div class='card-body'>
             <h5 class='card-title'>$product_description</h5>
             <p class='fw-semibold'>$product_keyword</p>
               <p class='card-text'>Rs: $product_price  /-</p>
             <a href='index.php?add_to_cart=$product_id' class='btn btn-sm btn-primary'>Add to cart</a>
             <a href='view_more.php?view_more='.$product_id.' class='btn btn-sm btn-secondary'>View more</a>
           </div>
         </div>
       </div>";

   }
    
   }
  }


  // view more function

  function view_more()
  {

 global $con;
 if (isset($_GET['view_more'])) {
  if(!isset($_GET['category'])) {
    if(!isset($_GET['brand'])) {
  $product_id=$_GET['view_more'];
    
     $select_query="select * from `products` where product_id = '$product_id'";

   $result=mysqli_query($con,$select_query);
   while ($row=mysqli_fetch_assoc($result)) {

    $product_id=$row['product_id'];
     $product_title=$row['product_title'];
      $product_description=$row['product_description'];
       $product_keyword=$row['product_keyword'];
        $cat_id=$row['cat_id'];
         $brand_id=$row['brand_id'];
           $product_image1=$row['product_image1'];
            $product_price=$row['product_price'];

            echo " <div class='col-md-4 my-2'>
         <div class='card'>
           <img src='./product_images/$product_image1'>
           <div class='card-body'>
             <h5 class='card-title'>$product_description</h5>
             <p class='fw-semibold'>$product_keyword</p>
               <p class='card-text'>Rs: $product_price  /-</p>
             <a href='index.php?add_to_cart=$product_id' class='btn btn-sm btn-primary'>Add to cart</a>
       
           </div>
         </div>
       </div>";
   }
  }
    }

  }
 }

// ip function



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
 // echo 'User Real IP Address - '.$ip;


    // cart function


function cart()
{
global $con;

if (isset($_GET['add_to_cart'])) {
  
  
$ip = getIPAddress();

$get_product_id=$_GET['add_to_cart'];

$select_query="SELECT * FROM `cart_items` where ip_address='$ip' and product_id=$get_product_id";

$result=mysqli_query($con,$select_query);


    $num_rows=mysqli_num_rows($result);

   if ($num_rows>0) {
      echo "<script> alert('These item already  stored in cart')</script>";
      echo "<script> window.open('index.php','_self')</script>";
   }else
   {
    $insert_query="insert into `cart_items` (product_id,ip_address,quantity) values ($get_product_id,'$ip','0')";

    $result=mysqli_query($con,$insert_query);
       echo "<script> alert('These item stored in cart')</script>";

      echo "<script> window.open('index.php','_self')</script>";

   }


}
}
// cart item display


function cart_item_display()
{

if (isset($_GET['add_to_cart'])) {
  
   global $con; 
$ip = getIPAddress();

$select_query="SELECT * FROM `cart_items` where ip_address='$ip'";

$result=mysqli_query($con,$select_query);
 $count_cart_item=mysqli_num_rows($result);
}
else
   {
   global $con; 
$ip = getIPAddress();

$select_query="SELECT * FROM `cart_items` where ip_address='$ip'";

$result=mysqli_query($con,$select_query);
 $count_cart_item=mysqli_num_rows($result);

   }

echo $count_cart_item;


}

// total price function


function total_cart_price()
{
  global $con; 

  $ip = getIPAddress();
  $total_price=0;

  $cart_query="SELECT * FROM `cart_items` where ip_address='$ip'";

  $result=mysqli_query($con,$cart_query);

  while ($row=mysqli_fetch_array($result)) {

    $product_id=$row['product_id'];

    $select_products="SELECT * FROM `products` where product_id='$product_id'";

      $result_products=mysqli_query($con,$select_products);

      while ($row_product_price=mysqli_fetch_array($result_products)) {

        $product_price=array($row_product_price['product_price']);
        $product_values=array_sum($product_price);
        $total_price+=$product_values;
      }
  }
echo $total_price;
 
}


// pending orders

function pending_orders() {

global $con;

$user_name=$_SESSION['user_login'];

$select_pending_orders="select * from `user_registration` where user_name='$user_name'";

$result_pending_order=mysqli_query($con,$select_pending_orders);

while ($row_pending_orders=mysqli_fetch_array($result_pending_order)) {
 
 $user_id=$row_pending_orders['user_id'];

 if (!isset($_GET['my_account'])) {

  if (!isset($_GET['my_orders'])) {
    if (!isset($_GET['delete_account'])){

     $select_order_result="select * from `user_orders` where user_id=$user_id and order_status='pending'";

     $order_pending_result=mysqli_query($con,$select_order_result);

     $pending_order_count=mysqli_num_rows($order_pending_result);


     if ($pending_order_count>0) {
       
       echo "<h2 class='text-center text-success mt-5'>You have <span class=text-danger>$pending_order_count</span> pending orders</h2>
       <div class='d-flex justify-content-center mt-5'>
              <a href='profile.php?my_orders' class='btn btn-primary btn-sm text-decoration-none'>Order Details</a>
              </div>";
       }else
           echo "<h2 class='text-center text-success mt-5'>you have <span class=text-danger>0</span> pending orders</h2>
           <div class='d-flex justify-content-center mt-5'>

              <a href='../index.php' class='btn btn-primary btn-sm text-decoration-none'>Explore shopping</a></div>";

    }
   
  }
  
 }
}

}

?>

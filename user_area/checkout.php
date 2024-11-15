<?php
include '../database/connect.php';
@session_start();

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
     	<a href="profile.php">  <img src="./user_images/<?php echo $user_image;?>" style="width:100% !important;height: 40px!important;" class="rounded-circle"></a>
     </div> 
     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar"></button>

     <div class="collapse navbar-collapse" id="mynavbar">
     	<ul class="navbar-nav">
     		<li class="nav-item mx-3">
     			<a href="../../index.php" class="nav-link fw-semibold">Home</a>
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

     	</ul>

  <form action="search_product.php" method="get">
    <div class="input-group ms-5">
      
      <input type="text" class="form-control form-control-sm" placeholder="Search" name="search_data">

      <input type="submit" name="search_data_products" value="search" class="btn btn-outline-light btn-sm">
     
    </div>
  </form>

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

        echo "<li class='nav-item'><a class='nav-link' href='login.php'>Login</a></li>";
       }else
       {
        echo "<li class='nav-item'><a class='nav-link' href='logout.php'>Logout</a></li>";
       }

       ?>
       
     </ul>

  </nav>

  <!-- third child -->
  <div class="bg-light text-center">
    
      <h2 class="fst-italic"> Betta Store</h2>

  </div>

  <!-- fourth child -->
   <div class="row">
    <div class="col-md-12">
      
     <div class="row">


<?php


if (!isset($_SESSION['user_login'])) {
 include 'login.php';
}else
{
  include'payment.php';
}

?>


  </div>
    </div>

  </div>



<!-- last-child -->
<div class="bg-primary">

    <p class="text-center text-muted fw-semibold fst-italic">All rights reserved &copy-Designed By Praveen web-Developer 2024</p>
    
  </div>

  </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</html>

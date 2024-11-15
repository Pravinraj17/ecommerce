<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootsstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../style.css">
	<title>Admin dashboard</title>
</head>
<body>
	<div class="container-fluid p-0">
		<!-- first child -->
		
		<!--  -->
		<nav class="navbar navbar-expand-lg bg-primary p-0">
			<div class="container-fluid admin_guest">
				<img src="../images/profile.png">
						<nav class="navbar navbar-expand-lg bg-primary p-0">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a href="javascript:void(0)" class="nav-link d-inline-block">Welcome Guest</a>
					</li>
				</ul>

			</nav>
			</div>


		</nav>

		<!-- second child -->

	   <div class="container-fluid p-0 my-3">
	   	<h3 class="text-center">Manage Details</h3>
	   </div>

      <div class="row">
      	<div class="col-md-12 bg-secondary p-1 d-flex">


      		<div class="admin_profile mx-2"> 
                
                <a href="javascript:void(0)" class="ms-4 my-1"><img src="../images/profile.png"></a>
                <p class="text-light text-center"> Admin Name</p>

      		</div>

      		<div class=" mx-5 p-3">
      			<button class=" btn btn-warning btn-sm"> <a href="insert_products.php" class="nav-link text-light my-1"> Insert product</a> </button>

      			<button class="btn btn-warning btn-sm"> <a href="javascript:void(0)" class="nav-link text-light my-1">View Products</a> </button>

      			<button class="btn btn-warning btn-sm"> <a href="index.php?insert_category" class="nav-link text-light my-1">Insert Categories</a> </button>

      			<button class="btn btn-warning btn-sm"> <a href="javascript:void(0)" class="nav-link text-light my-1">View Categories</a> </button>

      			<button class="btn btn-warning btn-sm"> <a href="index.php?insert_brand" class="nav-link text-light my-1">Insert Brands</a> </button>

      			<button class="btn btn-warning btn-sm"> <a href="javascript:void(0)" class="nav-link text-light my-1">View Brands</a> </button>

      			<button class="btn btn-warning btn-sm"> <a href="javascript:void(0)" class="nav-link text-light my-1">All orders</a> </button>

      			<button class="btn btn-warning btn-sm"> <a href="javascript:void(0)" class="nav-link text-light my-1">All Payments</a> </button>

      			<button class="btn btn-warning btn-sm"> <a href="javascript:void(0)" class="nav-link text-light my-1">List users</a> </button>

      			<button class="btn btn-warning btn-sm"> <a href="javascript:void(0)" class="nav-link text-light my-1">Logout</a> </button>
      		</div>

      	</div>
      </div>


      <div class="container-fluid">
      	<?php 
      		if(isset($_GET['insert_category'])){
      		include'insert_categories.php';
      	}

      	if(isset($_GET['insert_brand'])){
      		include'insert_brand.php';
      	}
      	// 	if(isset($_GET['insert_product'])){
      	// 	include'insert_products.php';
      	// }
      	?>
      </div>

	</div>

	

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


</html>
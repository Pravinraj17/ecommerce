<?php
include '../database/connect.php';

if (isset($_POST['insert_product'])) {

	$product_title=$_POST['product_title'];
	$product_description=$_POST['product_description'];
	$product_keyword=$_POST['product_keyword'];
	$product_category=$_POST['product_category'];
	$product_brand=$_POST['product_brand'];

	// productimages
	$product_image1=$_FILES['product_image1']['name'];
	// $product_image2=$_FILES['product_image2']['name'];
	// $product_image3=$_FILES['product_image3']['name'];
	// tmpname
	$tmp_image1=$_FILES['product_image1']['tmp_name'];
	// $tmp_image2=$_FILES['product_image2']['tmp_name'];
	// $tmp_image3=$_FILES['product_image3']['tmp_name'];

	$product_price=$_POST['product_price'];
	$product_status=true;

	move_uploaded_file($tmp_image1,"../product_images/$product_image1");
	// move_uploaded_file($tmp_image2,"../product_images/$product_image2");
	// move_uploaded_file($tmp_image3,"../product_images/$product_image3");


	$insert_query="insert into `products`(product_title,product_description,product_keyword,cat_id,brand_id,product_image1,product_price,date,product_status) values ('$product_title','$product_description','$product_keyword','$product_category','$product_brand','$product_image1','$product_price',now(),'$product_status')";

	$result=mysqli_query($con,$insert_query);
	if ($result) {
		echo "<script> alert('products has been stored successfully')</script>";
	}
	
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Insert_products Admin Dashboard</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body class="bg-warning">

	<div class="container bg-light img-thumbnail my-3">
		
		<div class="mt-3">
			<h2 class="text-center">Insert Products</h2>
		</div>

		<form action="" method="post" enctype="multipart/form-data">
			<div class="my-3">
				<label for="product-title" class="form-label">Product Title</label>
				<input type="text" name="product_title" id="product-title" class="form-control form-control-sm" placeholder="Enter Product Title" required>
			</div>

			<div class="my-3">
				<label for="product-description" class="form-label">Product Description</label>
				<input type="text" name="product_description" id="product-description" class="form-control form-control-sm" placeholder="Enter Product Description" required>
			</div>

			<div class="my-3">
				<label for="product-keyword" class="form-label">Product Keyword</label>
				<input type="text" name="product_keyword" class="form-control form-control-sm" id="product-keyword" placeholder="Enter Product Keyword" required>
			</div>
			<div class="my-3">

				<select class="form-select form-select-sm" name="product_category">
					<option value="">Select a Category</option>
				

				<?php
                  
                  $select_query="SELECT * FROM `categories`";

                  $result=mysqli_query($con,$select_query);

                  while ($row=mysqli_fetch_assoc($result)) {
                   $cat_name=$row['cat_name'];
                   $cat_id=$row['cat_id'];

                   echo "<option value='$cat_id'>$cat_name</option>";
                   
                   }
                 

				?>
				</select>
				
			</div>

			<div class="my-3">
				<select class="form-select form-select-sm" name="product_brand">
					<option value="">Select a Brand</option>

				<?php
                  
                  $select_query="SELECT * FROM `brand`";

                  $result=mysqli_query($con,$select_query);

                  while ($row=mysqli_fetch_assoc($result)) {
                   $brand_title=$row['brand_title'];
                   $brand_id=$row['brand_id'];

                   echo "<option value='$brand_id'>$brand_title</option>";
                   
                   }
                 

				?>
				</select>	
			</div>
			<div class="my-3">
				<label for="product_image1" class="form-label">Product Image1</label>
				<input type="file" name="product_image1" class="form-control form-control-sm" id="product-image1" required>
			</div>
	<!-- 		<div class="my-3">
				<label for="product_image2" class="form-label">Product Image2</label>
				<input type="file" name="product_image2" class="form-control form-control-sm" id="product-image2" required>
			</div>
			<div class="my-3">
				<label for="product_image3" class="form-label">Product Image3</label>
				<input type="file" name="product_image3" class="form-control form-control-sm" id="product-image3" required>
			</div> -->

			<div class="my-3">
				<label for="product_price" class="form-label">Product price</label>
				<input type="text" name="product_price" class="form-control form-control-sm" id="product-price" placeholder="Enter Product Price" required>
			</div>
			<button class="btn btn-primary my-3" name="insert_product">Insert Product</button>


		</form>

	</div>



</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</html>
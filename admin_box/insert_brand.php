<?php

 include '../database/connect.php';

 if (isset($_POST['insert_brand'])) {

  $brand_title=$_POST['brand_title'];

  $select_query="select * from `brand` where brand_title='$brand_title'";
  // echo "$select_query";
  // exit();

  $result=mysqli_query($con,$select_query);

  if ($result) {
    $num=mysqli_num_rows($result);
    if ($num>0) {
      echo "<script> alert('Already this type of Category has been stored in Database')</script>";

     
    }else
    {
       $insert_query="insert into  `brand` (brand_title) values ('$brand_title')";
    
        $result=mysqli_query($con,$insert_query);
        if ($result) {
        echo "<script> alert('Category stored successfully in Database')</script>";
        }else
        {
          die(mysqli_error($con));
        }
    }
  }




 
 

 
 }

  


?>

<form action="" method="post" class="mb-2">
<div class="input-group my-3">
	<span class="input-group-text bg-warning">Insert</span>
	<input type="text" class="form-control form-control-sm" name="brand_title" placeholder="Insert brand">
</div>
<div class="input-group w-25 mb-3">
	<button class="btn btn-secondary btn-sm" name="insert_brand">Insert Brand</button>

	<!-- <input type="text" class="form-control form-control-sm" name="insert_brand" value="Insert Categories" placeholder="Insert Categories"> -->
</div>
</form>
<?php

 include '../database/connect.php';

 if (isset($_POST['insert_cate'])) {

  $cat_title=$_POST['cat_title'];

  $select_query="select * from `categories` where cat_name='$cat_title'";
  // echo "$select_query";
  // exit();

  $result=mysqli_query($con,$select_query);

  if ($result) {
    $num=mysqli_num_rows($result);
    if ($num>0) {
      echo "<script> alert('Already this type of Category has been stored in Database')</script>";

     
    }else
    {
       $insert_query="insert into  `categories` (cat_name) values ('$cat_title')";
    
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

<!-- // echo '<script> alert("success")</script>'; -->

<form action="" method="post" class="mb-2">
<div class="input-group my-3">
	<span class="input-group-text bg-warning">Insert</span>
	<input type="text" class="form-control form-control-sm" name="cat_title" placeholder="Insert Categories">
</div>
<div class="input-group w-25 mb-3">
	<button class="btn btn-secondary btn-sm" name="insert_cate">Insert Catergory</button>

	<!-- <input type="text" class="form-control form-control-sm" name="insert_cat" value="Insert Categories" placeholder="Insert Categories"> -->
</div>
</form>
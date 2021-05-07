<?php
    if(!isset($_SESSION['admin_email'])){
    echo "<script>window.open('login.php','_self')</script>";
}else {

?>

<?php
    if(isset($_GET['update_stock'])){
    $edit_id = $_GET['update_stock'];
    $get_p = "select * from products where product_id='$edit_id'";
    $run_edit = mysqli_query($con,$get_p) or die(mysqli_error($con));
    $row_edit = mysqli_fetch_array($run_edit);
    $pro_stock = $row_edit['stock'];
   
}

   

?>


<!DOCTYPE html>
<html>

<head>
    <title> Edit Products </title>
</head>

<body>
    <div class="row">
        <div class="col-lg-4">
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"> </i> Dashboard / Update Stock
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-money fa-fw"></i> Update Stock
                    </h3>
                </div>
                <div class="panel-body">
                
                    <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        <input type="text" name="stock_update_value" value="<?php echo $pro_stock; ?>" size="6" required>
                        <input type="submit" name="update_stock" value="Update" class="btn btn-primary">
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<?php

        if(isset($_POST['update_stock'])){

        $product_stock = $_POST['stock_update_value'];
       
            $update_product_stock = "UPDATE products SET stock='$product_stock' WHERE product_id='$edit_id'";

            $run_product_stock = mysqli_query($con,$update_product_stock) or die(mysqli_error($con));

            if($run_product_stock){
                echo "<script> alert('Product Stock has been updated successfully') </script>";
                echo "<script>window.open('index.php?view_product','_self')</script>";
            }

    }

?>

<?php } ?>
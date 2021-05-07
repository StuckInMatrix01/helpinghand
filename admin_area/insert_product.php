<?php

if(isset($_SESSION['admin_email'])){
   
?>
<!DOCTYPE html>
<html>

<head>
    <title> Insert Products </title>
   <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea'
        });
    </script>
</head>

<body>
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"> </i> Dashboard / Insert Products
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-money fa-fw"></i> Insert Products
                    </h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                            <label class="col-md-3 control-label">Vendor ID</label>
                            <div class="col-md-6">
                                <input type="text" name="vendor_id" class="form-control" required>
                            </div>
                    </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> Product Title </label>
                            <div class="col-md-6">
                                <input type="text" name="product_title" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> Product Category </label>
                            <div class="col-md-6">
                                <select name="product_cat" class="form-control">
                                    <option> Select a Product Category </option>
                                    <?php
                                        $get_p_cats = "select * from product_category";
                                        $run_p_cats = mysqli_query($con,$get_p_cats);
                                        while ($row_p_cats=mysqli_fetch_array($run_p_cats)) {
                                            $p_cat_id = $row_p_cats['p_cat_id'];
                                            $p_cat_title = $row_p_cats['p_cat_title'];
                                            echo "<option value='$p_cat_id' >$p_cat_title</option>";
                                        }

                                    ?>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> Category </label>
                            <div class="col-md-6">
                                <select name="cat" class="form-control">
                                    <option> Select a Category </option>
                                    <?php
                                        $get_cat = "select * from categories ";
                                        $run_cat = mysqli_query($con,$get_cat);
                                        while ($row_cat=mysqli_fetch_array($run_cat)) {
                                            $cat_id = $row_cat['cat_id'];
                                            $cat_title = $row_cat['cat_title'];
                                            echo "<option value='$cat_id'>$cat_title</option>";
                                        }
                                    ?>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> Product Image 1 </label>
                            <div class="col-md-6">
                                <input type="file" name="product_img1" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> Product Image 2 </label>
                            <div class="col-md-6">
                                <input type="file" name="product_img2" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> Product Image 3 </label>
                            <div class="col-md-6">
                                <input type="file" name="product_img3" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> Product Price </label>
                            <div class="col-md-6">
                                <input type="text" name="product_price" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> Product Keywords </label>
                            <div class="col-md-6">
                                <input type="text" name="product_keywords" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> Product Stock </label>
                            <div class="col-md-6">
                                <input type="text" name="product_stock" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> Product Description </label>
                            <div class="col-md-6">
                                <textarea name="product_desc" class="form-control" rows="6" cols="19"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <input type="submit" name="submit" value="Insert Product"
                                    class="btn btn-primary form-control">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<?php

    if(isset($_POST['submit'])){

        $product_title = $_POST['product_title'];
        $vendor_id = $_POST['vendor_id'];
        $product_cat = $_POST['product_cat'];
        $cat = $_POST['cat'];
        $product_price = $_POST['product_price'];
        $product_desc = $_POST['product_desc'];
        $product_keywords = $_POST['product_keywords'];
        $product_stock = $_POST['product_stock'];

        $product_img1 = $_FILES['product_img1']['name'];
        $product_img2 = $_FILES['product_img2']['name'];
        $product_img3 = $_FILES['product_img3']['name'];

        $temp_name1 = $_FILES['product_img1']['tmp_name'];
        $temp_name2 = $_FILES['product_img2']['tmp_name'];
        $temp_name3 = $_FILES['product_img3']['tmp_name'];

        move_uploaded_file($temp_name1,"product_images/$product_img1");
        copy("product_images/$product_img1","../vendor/product_images/$product_img1");

        move_uploaded_file($temp_name2,"product_images/$product_img2");
        copy("product_images/$product_img2","../vendor/product_images/$product_img2");

        move_uploaded_file($temp_name3,"product_images/$product_img3");
        copy("product_images/$product_img3","../vendor/product_images/$product_img3");
       

      

        $insert_product = "INSERT INTO products (vendor_id,p_cat_id,cat_id,dateandtime,product_title,product_img1,product_img2,product_img3,product_price,product_desc,stock,product_keywords) 
        VALUES ('$vendor_id','$product_cat','$cat',NOW(),'$product_title','$product_img1','$product_img2','$product_img3','$product_price','$product_desc','$product_stock','$product_keywords')";

        $run_product = mysqli_query($con,$insert_product);

        if($run_product){

        echo "<script>alert('Product has been inserted successfully')</script>";

        echo "<script>window.open('index.php?view_product','_self')</script>";

        }else{
            echo "<script>alert('Product has not been inserted')</script>";
        }

}

?>

<?php 
    }else {
        echo "<script>window.open('login.php','_self')</script>";
    }
 ?>
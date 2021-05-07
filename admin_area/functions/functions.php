<?php
    include("includes/db.php");

    //FOR GETTING USR IP ADDRESS
    function getUserIP(){
        switch(true){
            case (!empty($_SERVER['HTTP_X_REAL_IP'])) :  return $_SERVER['HTTP_X_REAL_IP'];

            case(!empty($_SERVER['HTTP_CLIENT_IP'])) :  return $_SERVER['HTTP_CLIENT_IP'];

            case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];

            default : return $_SERVER['REMOTE_ADDR'];
        }
    }

    function getPro(){
        global $con;
        $get_product="select * from products order by 1 DESC LIMIT 0,6";
        $run_products=mysqli_query($con,$get_product) or die(mysqli_error($con));
        while($row_product=mysqli_fetch_array($run_products)){
            $pro_id=$row_product['product_id'];
            $pro_title=$row_product['product_title'];
            $pro_price=$row_product['product_price'];
            $pro_img1=$row_product['product_img1'];

            echo"<div class='col-md-4 col-sm-6'>
                <div class='product'>
                    <a href='details.php?pro_id=$pro_id'>
                        <img src='admin_area/product_images/$pro_img1' class='img-responsive'>
                    </a>
                    <div class='text'>
                        <h3><a href='details.php?pro_id=$pro_id'>$pro_title</a></h3>
                        <p class='price'>INR $pro_price</p>
                        <p class='buttons'>
                        <a href='details.php?pro_id=$pro_id' class='btn btn-default'>View Details</a>
                        <a href='details.php?pro_id=$pro_id' class='btn bt-primary> <i class='fa fa-shopping'></i>Add to cart</a>
                        </p>
                    </div>
                </div>
            </div>";
        }

    }

?>
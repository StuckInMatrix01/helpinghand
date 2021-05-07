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
   
   function addCart(){
       global $con;
       if (isset($_GET['add_cart'])) {
           $ip_add= getUserIP();
           $p_id =$_GET['add_cart'];
           $product_qty =$_POST['product_qty'];
           $product_size =$_POST['product_size'];
           $check_product = "SELECT * FROM cart WHERE ip_add = '$ip_add' AND p_id ='$p_id'";
           $run_check =mysqli_query($con, $check_product) or die(mysqli_error($con));

           if(mysqli_num_rows($run_check)>0){
               echo"
                    <script> 
                        alert('This product is already added in cart'); 
                        window.open('details.php?pro_id=$p_id','_self');
                    
                    </script>
                   
               ";
              
           }else{
                $query="INSERT INTO cart(p_id,ip_add,qty,size) VALUES('$p_id','$ip_add','$product_qty','$product_size')";
                $run_query=mysqli_query($con, $query) or die(mysqli_error($con));
                echo"
                    <script>
                    window.open('details.php?pro_id=$p_id', '_self');
                    </script>
                
                ";

           }
       }

   }

   //item count
    function itemCount(){
        global $con;
        $ip_add= getUserIP();
        $get_items="SELECT * FROM cart WHERE ip_add='$ip_add'";
        $run_items= mysqli_query($con, $get_items) or die(mysqli_error($con));
        $count = mysqli_num_rows($run_items);
        echo $count;

    }   

    // total price

    function totalPrice(){

        global $con;
        $ip_add= getUserIP();
        $total = 0;
        $select_cart ="SELECT * FROM cart WHERE ip_add= '$ip_add'";
        $run_cart = mysqli_query($con, $select_cart) or die(mysqli_error($con));
        while($record = mysqli_fetch_array($run_cart)){
            $pro_id =$record['p_id'];
            $pro_qty =$record['qty'];
            $get_price ="SELECT * FROM products WHERE product_id='$pro_id'";
            $run_price = mysqli_query($con, $get_price) or die(mysqli_error($con));;
            while ($row_price = mysqli_fetch_array($run_price)){
                $sub_total =$row_price['product_price'] * $pro_qty;
                $total +=$sub_total;
                
            }
        }

        echo $total;

    }
   
   
   
   
   
   
   
    function getPro(){
        global $con;
        $get_product="SELECT * FROM products ORDER BY RAND() DESC LIMIT 0,6";
        $run_products=mysqli_query($con,$get_product) or die(mysqli_error($con));
        while($row_product=mysqli_fetch_array($run_products)){
            $pro_id=$row_product['product_id'];
            $pro_title=$row_product['product_title'];
            $pro_price=$row_product['product_price'];
            $pro_img1=$row_product['product_img1'];
            $pro_stock = $row_product['stock'];
            


            echo"<div class='col-md-4 col-sm-6'>
                <div class='product'>
                <a href='details.php?pro_id=$pro_id'>
                <img src='admin_area/product_images/$pro_img1' class='img-responsive'>";
                if($pro_stock == 0){
                        echo"
                        <div class='label'>
                            <span class=''>Out Of Stock</span>
                        </div>";
                }   
                    echo" </a>
                     <div class='text'>
                        <h3><a href='details.php?pro_id=$pro_id'>$pro_title</a></h3>
                        <p class='price'>INR $pro_price</p>
                        
                        
                        <p class='buttons'>
                        <a href='details.php?pro_id=$pro_id' class='btn btn-primary center'>View Details</a>
                      <!--  <a href='details.php?pro_id=$pro_id' class='btn btn-primary'> <i class='fa fa-shopping'></i>Add to cart</a>-->
                        </p>
                    </div>
                </div>
            </div>";
        }

    }

/*product_category*/

function getPCat(){
    global $con;

    $get_p_cat="SELECT * FROM product_category";
    $run_p_cat=mysqli_query($con,$get_p_cat) or die(mysqli_error($con));
    while ($row_p_cat=mysqli_fetch_array($run_p_cat)) {
        $p_cat_id=$row_p_cat['p_cat_id'];
        $p_cat_title=$row_p_cat['p_cat_title'];

        echo "<li><a href='shop.php?p_cat=$p_cat_id'>$p_cat_title</a></li>";
    }

}

/* categories*/

function getCat(){
    global $con;
    $get_cat="select * from categories";
    $run_cat=mysqli_query($con,$get_cat) or die(mysqli_error($con));
    while ($row_cat=mysqli_fetch_array($run_cat)) {
        $cat_id =$row_cat['cat_id'];
        $cat_title=$row_cat['cat_title'];
        echo "<li><a href='shop.php?cat_id=$cat_id'>$cat_title</a></li>";
    }
}


/* Get product categories product --> fitler*/

function getProCatFilter(){
    global $con;
    if (isset($_GET['p_cat'])){
       $p_cat_id=$_GET['p_cat'];
       $get_p_cat="select * from product_category where p_cat_id='$p_cat_id'";
       $run_p_cat=mysqli_query($con,$get_p_cat) or die(mysqli_error($con));
       $row_p_cat=mysqli_fetch_array($run_p_cat);
       $p_cat_title=$row_p_cat['p_cat_title'];
       $p_cat_desc=$row_p_cat['p_cat_desc'];

       $get_products="select * from products where p_cat_id='$p_cat_id'";
       $run_products=mysqli_query($con,$get_products) or die(mysqli_error($con));
       $count=mysqli_num_rows($run_products);

       if ($count==0) {
           echo "
            <div class='box'>
                <h1>No Product Found In This Product Category</h1>
            </div>

           ";
       }else{
            echo "
                <div class='box'>
                <h1>$p_cat_title</h1>
                <p>$p_cat_desc</p>
                </div>
            ";

       }

       while ($row_products=mysqli_fetch_array($run_products)) {
            $pro_id=$row_products['product_id'];
            $pro_title=$row_products['product_title'];
            $pro_price=$row_products['product_price'];
            $pro_img1=$row_products['product_img1'];
            $pro_stock = $row_products['stock'];
            
            echo "
                <div class='col-md-4 col-sm-6 center-responsive'>
                    <div class='product'>
                        <a href='details.php?pro_id=$pro_id'>
                            <img src=admin_area/product_images/$pro_img1 class='img-responsive'>";
                            if($pro_stock == 0){
                                echo"
                                <div class='label'>
                                    <span class=''>Out Of Stock</span>
                                </div>";
                        }   
                        echo"</a>
                        <div class='text'>
                            <h3>
                                <a href='details.php?pro_id=$pro_id'> $pro_title</a>
                            </h3>
                            <p class='price'>$pro_price</p>
                            <p class='buttons'>
                                <a href='details.php?pro_id=$pro_id' class='btn btn-primary center'>View Details</a>
                              <!--  <a href='details.php?pro_id=$pro_id' class='btn btn-primary'>
                                <i class='fa fa-shopping-cart'></i>Add to cart
                                </a>-->
                            </p>
                        </div>                    
                    </div>
                </div>
            ";
       }
    }
}
//same as above but for search
function getProCatFilterS(){
    global $con;
    if (isset($_GET['p_cat'])){
       $p_cat_id=$_GET['p_cat'];
       $get_p_cat="select * from product_category where p_cat_id='$p_cat_id'";
       $run_p_cat=mysqli_query($con,$get_p_cat) or die(mysqli_error($con));
       $row_p_cat=mysqli_fetch_array($run_p_cat);
       $p_cat_title=$row_p_cat['p_cat_title'];
       $p_cat_desc=$row_p_cat['p_cat_desc'];

       $get_products="SELECT * FROM products WHERE p_cat_id='$p_cat_id' AND vendor_id='$vendor_id'";
       $run_products=mysqli_query($con,$get_products) or die(mysqli_error($con));
       $count=mysqli_num_rows($run_products);

       if ($count==0) {
           echo "
            <div class='box'>
                <h1>No Product Found In This Product Category</h1>
            </div>

           ";
       }else{
            echo "
                <div class='box'>
                <h1>$p_cat_title</h1>
                <p>$p_cat_desc</p>
                </div>
            ";

       }

       while ($row_products=mysqli_fetch_array($run_products)) {
            $pro_id=$row_products['product_id'];
            $pro_title=$row_products['product_title'];
            $pro_price=$row_products['product_price'];
            $pro_img1=$row_products['product_img1'];
            $pro_stock = $row_products['stock'];
            
            echo "
                <div class='col-md-4 col-sm-6 center-responsive'>
                    <div class='product'>
                        <a href='details.php?pro_id=$pro_id'>
                            <img src=admin_area/product_images/$pro_img1 class='img-responsive'>";
                            if($pro_stock == 0){
                                echo"
                                <div class='label'>
                                    <span class=''>Out Of Stock</span>
                                </div>";
                        }   
                        echo"</a>
                        <div class='text'>
                            <h3>
                                <a href='details.php?pro_id=$pro_id'> $pro_title</a>
                            </h3>
                            <p class='price'>$pro_price</p>
                            <p class='buttons'>
                                <a href='details.php?pro_id=$pro_id' class='btn btn-primary center'>View Details</a>
                              <!--  <a href='details.php?pro_id=$pro_id' class='btn btn-primary'>
                                <i class='fa fa-shopping-cart'></i>Add to cart
                                </a>-->
                            </p>
                        </div>                    
                    </div>
                </div>
            ";
       }
    }
}
// Get Category

function getCatGfilter(){
    global $con;
    if(isset($_GET['cat_id'])){
        $cat_id=$_GET['cat_id'];
        $get_cat="select * from categories where cat_id='$cat_id'";
        $run_cats = mysqli_query($con, $get_cat) or die(mysqli_error($con));
        $row_cat = mysqli_fetch_array($run_cats);
        $cat_title = $row_cat['cat_title'];
        $cat_desc = $row_cat['cat_desc'];
        $get_products = "select * from products where cat_id ='$cat_id'";
        $run_products = mysqli_query($con, $get_products) or die(mysqli_error($con));
        $count = mysqli_num_rows($run_products);
            if($count==0){
                echo "
                <div class='box'>
                <h1>No Product Found In This Category</h1>
                </div>

            ";
            }else{
                echo "
                    <div class='box'>
                    <h1>$cat_title</h1>
                    <p>$cat_desc</p>
                    </div>
                ";

                }
                while ($row_products=mysqli_fetch_array($run_products)) {
                    $pro_id=$row_products['product_id'];
                    $pro_title=$row_products['product_title'];
                    $pro_price=$row_products['product_price'];
                    $pro_img1=$row_products['product_img1'];
                    $pro_stock = $row_products['stock'];
                    echo "
                        <div class='col-md-4 col-sm-6 center-responsive'>
                            <div class='product'>
                                <a href='details.php?pro_id=$pro_id'>
                                    <img src=admin_area/product_images/$pro_img1 class='img-responsive'>";
                                    if($pro_stock == 0){
                                        echo"
                                        <div class='label'>
                                            <span class=''>Out Of Stock</span>
                                        </div>";
                                }  
                                echo"
                                </a>
                                <div class='text'>
                                    <h3>
                                        <a href='details.php?pro_id=$pro_id'> $pro_title</a>
                                    </h3>
                                    <p class='price'>$pro_price</p>
                                    <p class='buttons'>
                                        <a href='details.php?pro_id=$pro_id' class='btn btn-default'>View Details</a>
                                     <!--   <a href='details.php?pro_id=$pro_id' class='btn btn-primary'>
                                        <i class='fa fa-shopping-cart'></i>Add to cart
                                        </a>-->
                                    </p>
                                </div>                    
                            </div>
                        </div>
                    ";
               }

    }

}
// same as above but for search


function getCatGfilterS(){
    global $con;
    if(isset($_GET['cat_id'])){
        $cat_id=$_GET['cat_id'];
        $get_cat="select * from categories where cat_id='$cat_id'";
        $run_cats = mysqli_query($con, $get_cat) or die(mysqli_error($con));
        $row_cat = mysqli_fetch_array($run_cats);
        $cat_title = $row_cat['cat_title'];
        $cat_desc = $row_cat['cat_desc'];
        $get_products = "SELECT * FROM products WHERE cat_id ='$cat_id' AND vendor_id='$vendor_id'";
        $run_products = mysqli_query($con, $get_products) or die(mysqli_error($con));
        $count = mysqli_num_rows($run_products);
            if($count==0){
                echo "
                <div class='box'>
                <h1>No Product Found In This Category</h1>
                </div>

            ";
            }else{
                echo "
                    <div class='box'>
                    <h1>$cat_title</h1>
                    <p>$cat_desc</p>
                    </div>
                ";

                }
                while ($row_products=mysqli_fetch_array($run_products)) {
                    $pro_id=$row_products['product_id'];
                    $pro_title=$row_products['product_title'];
                    $pro_price=$row_products['product_price'];
                    $pro_img1=$row_products['product_img1'];
                    $pro_stock = $row_products['stock'];
                    echo "
                        <div class='col-md-4 col-sm-6 center-responsive'>
                            <div class='product'>
                                <a href='details.php?pro_id=$pro_id'>
                                    <img src=admin_area/product_images/$pro_img1 class='img-responsive'>";
                                    if($pro_stock == 0){
                                        echo"
                                        <div class='label'>
                                            <span class=''>Out Of Stock</span>
                                        </div>";
                                }  
                                echo"
                                </a>
                                <div class='text'>
                                    <h3>
                                        <a href='details.php?pro_id=$pro_id'> $pro_title</a>
                                    </h3>
                                    <p class='price'>$pro_price</p>
                                    <p class='buttons'>
                                        <a href='details.php?pro_id=$pro_id' class='btn btn-default'>View Details</a>
                                     <!--   <a href='details.php?pro_id=$pro_id' class='btn btn-primary'>
                                        <i class='fa fa-shopping-cart'></i>Add to cart
                                        </a>-->
                                    </p>
                                </div>                    
                            </div>
                        </div>
                    ";
               }

    }

}






    function loginOut(){
        if(!isset($_SESSION['customer_email'])){
            echo"<a href='checkout.php'>Login</a> ";
        }else{
            echo"<a href='logout.php'>Logout</a>";
        }
    }

    function myaccount_section(){
        if(!isset($_SESSION['customer_email'])){
            echo"<a href='checkout.php'>My Account</a>  ";
        }else{
            echo"<a href='customer/my_account.php?my_orders'>My Account</a> ";

        }

    }

?>
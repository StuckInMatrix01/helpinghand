<?php
    session_start();
    include("includes/db.php");
    include_once("functions/functions.php");
?>
<?php
    if (isset($_GET['pro_id'])) {
        $pro_id = $_GET['pro_id'];
        $get_product="SELECT * FROM products WHERE product_id='$pro_id'";
        $run_product = mysqli_query($con, $get_product) or die(mysqli_error($con));
        $row_product = mysqli_fetch_array($run_product);
        $p_cat_id = $row_product['p_cat_id'];
        $p_title = $row_product['product_title'];
        $p_price= $row_product['product_price'];
        $p_desc = $row_product['product_desc'];
        $p_img1 = $row_product['product_img1'];
        $p_img2 = $row_product['product_img2'];
        $p_img3 = $row_product['product_img3'];
        $vendor_id = $row_product['vendor_id'];
        $pro_stock = $row_product['stock'];
        
        $get_p_cat = "SELECT * FROM product_category WHERE p_cat_id='$p_cat_id'";
        $run_p_cat = mysqli_query($con, $get_p_cat) or die(mysqli_error($con));
        $row_p_cat = mysqli_fetch_array($run_p_cat);
        $p_cat_id = $row_p_cat['p_cat_id'];
        $p_cat_title = $row_p_cat['p_cat_title'];

        $vendor_query ="SELECT * FROM vendor WHERE vendor_id='$vendor_id'";
        $run_vendor_query =mysqli_query($con, $vendor_query) or die(mysqli_error($con));
        $row_vendor = mysqli_fetch_array($run_vendor_query);
        $vendor_name= $row_vendor['vendor_name'];
        $vendor_area= $row_vendor['vendor_area'];
        $vendor_contact= $row_vendor['vendor_contact'];
      
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Helpinghand</title>
    <link rel="shortcut icon" type="image/jpg" href="images/logoOS.jpg" class="img-circle">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Font-Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body>
    <div id="top">
        <!-- top bar start -->
        <div class="container">
            <!-- container start, class for bootstrap, id for css -->
            <div class="col-md-6 offer">
                <!-- makeing columns Start-->
                <a href="#" class="btn btn-success btn-sm">
                    <?php
                         
                         if(!isset($_SESSION['customer_email'])){
                             echo"Welcome Guest";
                         }else{
                             echo" Welcome: " .$_SESSION['customer_email']. "";
                         }
                     
                    ?>
                </a>
                <a href="#">Shopping Cart Total Price: INR <?php totalPrice(); ?>,Total Items<?php itemCount(); ?> </a>
            </div><!-- makeing columns end-->
            <div class="col-md-6">
                <ul class="menu">
                    <li>
                        <a href="customer_registration.php">Register</a>
                    </li>
                    <li>
                        <?php 
                                    if(isset($_SESSION['customer_email'])){
                                        echo"<a href='checkout.php'>My Account</a>  ";
                                    }else{
                                        echo"<a href='customer/my_account.php?my_orders'>My Account</a> ";
                            
                                    }
                            
                        ?>
                    </li>
                    <li>
                        <a href="cart.php">Goto cart</a>
                    </li>
                    <li>
                        <?php
                            loginOut();
                        ?>
                    </li>
                </ul>

            </div>
        </div> <!-- container end -->
    </div> <!-- top bar end -->
    <nav class="navbar navbar-default" id="navbartext">
        <div class="container">
            <div class="navbar-header">
            <a class="navbar-brand home" href="index.php">
                    <img src="images/logoOS.jpg" alt="helpinghand" class="hidden-xs img-circle" width="60" height="60">
                    <img src="images/logoOS.jpg" alt="helpinghand" class="visible-xs img-circle" width="40" height="40">
                </a>

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigationtoggle" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                   <i class="fa fa-align-justify"></i>
                </button>
                
            </div>

            <!-- collecting all link and dropdowns for toggle  -->
            <div class="collapse navbar-collapse navbartext" id="navigationtoggle">
                <ul class="nav navbar-nav">
                    <li >
                        <a href="index.php">
                           Home
                        </a>
                    </li>
                    <li class="active">
                        <a href="shop.php">Shop

                        </a>
                    </li>
                    <li>
                        <?php myaccount_section(); ?>
                    </li>
                    <li>
                        <a href="cart.php">Shopping Cart</a>
                    </li>
                    <li>
                            <a href="contactus.php">Contact Us</a>
                    </li>                   
                </ul>  

               
            <a href="cart.php" class="btn btn-primary navbar-btn right">
                    <i class="fa fa-shopping-cart"></i>
                    <span><?php itemCount(); ?> items in cart</span>
            </a>

            <form  class="navbar-form navbar-left" action="search.php" method="get">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search vendor in your area.." name="search" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
            </form>
            </div>
           

        </div>

    </nav>

    <div id="content">
        <div class="container">
            <div class="col-md-12">
                
                <ul class="breadcrumb">
                    <li><a href="home.php">Home</a></li>
                    <li>Shop</li>
                    <!--<li><a href="shop.php?p_cat = <?php echo $p_cat_id ?>"> <?php echo $p_cat_title ?></a></li>-->
                    <li><?php echo $p_title ?></li>
                </ul>
            </div> 
            <div class="col-md-3">
                
                <?php
                    include("includes/sidebar.php")
                ?>
            </div>

            <div class="col-md-9">
                <div class="row" id="productmain">
                    <div class="col-sm-6">
                        <div id="mainimage">
                            <div id="mycarousel" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#mycarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#mycarousel" data-slide-to="1"></li>
                                    <li data-target="#mycarousel" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner"> <!--carousel-inner START-->
                                    <div class="item active">
                                        <center>
                                            <img src="admin_area/product_images/<?php echo $p_img1 ?>" alt="ProductImage" class="img-responsive">
                                        </center>
                                    </div>

                                    <div class="item">
                                        <center>
                                            <img src="admin_area/product_images/<?php echo $p_img2 ?>" alt="ProductImage" class="img-responsive">
                                        </center>
                                    </div>

                                    <div class="item">
                                        <center>
                                            <img src="admin_area/product_images/<?php echo $p_img3 ?>" alt="ProductImage" class="img-responsive">
                                        </center>
                                    </div>

                                </div><!--carousel-inner END-->

                                <a href="#mycarousel" class="left carousel-control" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                    <span class="sr-only">Previous</span>
                                </a>

                                <a href="#mycarousel" class="right carousel-control" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <span class="sr-only">Next</span>
                                </a>


                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="box">
                            <h1 class="text-centre"><?php echo $p_title ?></h1>
                            <?php  addCart();  ?>
                            <form action="details.php?add_cart=<?php echo $pro_id ?>" method="post" class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-md-5 control-label">Product Quatity</label>
                                    <div class="col-md-7">
                                        <select name="product_qty" class="form-control" required>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-5 control-label">Product Size</label>
                                    <div class="col-md-7 ">
                                        <select name="product_size"  class="form-control" required>
                                            <option disabled selected hidden value="">Select a size</option>
                                            <option>S</option>
                                            <option>M</option>
                                            <option>L</option>
                                            <option>XL</option>       
                                        </select>
                                    </div>
                                    
                                </div>
                                <p class="price"> INR <?php echo $p_price; ?></p>
                                <input type="hidden" name="product_price" value="<?php echo $p_price;?>">
                                <?php if($pro_stock ==0){ 
                                    echo" 
                                        <p class='text-center buttons' style='font-size: 40px; color: red;'>Out Of Stock</p>
                                    ";
                                } ?>
                                <?php if($pro_stock >0 ){
                                       echo" <p class=\"text-center buttons\">
                                            <button class=\"btn btn-primary\" type=\"submit\">
                                            <i class=\"fa fa-shopping-cart\"></i>Add to cart
                                            </button>
                                        </p>
                                    ";}  
                                ?>
                            </form>
                        </div>

                        <!--thumb images next to big image-->
                        <div class="col-xs-4">
                            <a href="#" id="thumb">
                                <img src="admin_area/product_images/<?php echo $p_img1 ?>" alt="product_thumb_img" class="img-responsive">
                            </a>
                        </div>

                        <div class="col-xs-4">
                            <a href="#" id="thumb">
                                <img src="admin_area/product_images/<?php echo $p_img2 ?>" alt="product_thumb_img" class="img-responsive">
                            </a>
                        </div>
                        <div class="col-xs-4">
                            <a href="#" id="thumb">
                                <img src="admin_area/product_images/<?php echo $p_img3 ?>" alt="product_thumb_img" class="img-responsive">
                            </a>
                        </div>
                        <!--******************************-->
                    </div>
                </div>

                <div class="box" id="details">
                    <h4>Product details:</h4>
                    <p>
                    <?php echo $p_desc ?>
                    </p>
                    <h4>Vendor details:</h4>
                    <p>
                       <b>Vendor name: </b> <?php echo $vendor_name ?>
                    </p>
                      <p>
                          <b>Vendor area: </b><?php echo $vendor_area ?>
                    </p>
                    <p>
                        <b>Vendor contact: </b><?php echo $vendor_contact ?>
                    </p>
                </div>

                <div id="row same-height-row">
                    <div class="col-md-3 col-sm-6">
                        <div class="box same-height headline">
                            <h3 class="text-center">You may also like</h3>
                        </div>
                    </div>

                   <?php
                        $get_product="SELECT * FROM products WHERE vendor_id ='$vendor_id' ORDER BY RAND() LIMIT 0,3 ";
                        $run_product =mysqli_query($con, $get_product) or die (mysqli_error($con));
                        while($row=mysqli_fetch_array($run_product)){
                            $pro_id =$row['product_id'];
                            $product_title =$row['product_title'];
                            $product_price = $row['product_price'];
                            $product_img1= $row['product_img1'];
                            $pro_stock =$row['stock'];

                            echo"
                            <div class='center-responsive col-md-3 col-sm-6'>
                            <div class='product same-height'>
                                <a href='details.php?pro_id=$pro_id'>
                                <img src='admin_area/product_images/$product_img1' class='img-responsive'>";
                                if($pro_stock == 0){
                                    echo"
                                        <div class='label'>
                                            <span>Out Of Stock</span>
                                        </div>";
                                }
                                echo"
                                </a>
                                <div class='text'>
                                    <h3><a href='details.php?pro_id=$pro_id'>$product_title</a> </h3>
                                    <p class='price'>
                                            $product_price
                                    </p>
                                    <p class='button text-center'>
                                    <a href='details.php?pro_id=$pro_id' class='btn btn-primary center'>View Details</a>
                                    <!-- <a href='details.php?pro_id=$pro_id' class='btn btn-primary'>
                                         <i class='fa fa-shopping-cart'></i>Add to cart
                                     </a>-->
                                 </p>

                                </div>
                            </div> 
                            
                            </div>
                            
                            
                            ";
                        }
                   
                   ?>
                

                </div>

            </div>

        </div>
    </div>


 <!--Footer Start-->

 <?php
    include("includes/footer.php");
    
    ?>
    <!--footer end-->

    <!-- javaSscript-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>

</html>
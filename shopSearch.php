<?php
    session_start();
    include("includes/db.php");
    include_once("functions/functions.php");
    if(isset($_GET['p_cat'], $_GET['vendor_id'])){
        $vendor_id = $_GET['vendor_id'];
        $p_cat = $_GET['p_cat'];
    }
    if(isset($_GET['cat_id'], $_GET['vendor_id'])){
        $vendor_id = $_GET['vendor_id'];
        $cat = $_GET['cat_id'];
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
                <a href="#">Shopping Cart Total Price: INR <?php totalPrice(); ?>,Total Items <?php itemCount(); ?> </a>
            </div><!-- makeing columns end-->
            <div class="col-md-6">
                <ul class="menu">
                    <li>
                        <a href="customer_registration.php">Register</a>
                    </li>
                    <li>
                        <?php myaccount_section(); ?>
                    </li>
                    <li>
                        <a href="cart.php">Goto cart</a>
                    </li>
                    <li>
                        <?php
                            loginOut();
                        ?>
                    </li>
                    <li>
                        <a href="vendor/login.php">Vendor</a>
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

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navigationtoggle" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <i class="fa fa-align-justify"></i>
                </button>

            </div>

            <!-- collecting all link and dropdowns for toggle  -->
            <div class="collapse navbar-collapse navbartext" id="navigationtoggle">
                <ul class="nav navbar-nav">
                    <li>
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

                <form class="navbar-form navbar-left" action="search.php" method="get">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search vendor in your area.." name="search"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>


        </div>

    </nav>

    <div id="content">
        <div class="container">
            <div class="col-md-12">
                <!--START col-md-12-->
                <ul class="breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li>Shop</li>
                </ul>
            </div> <!-- END col-md-12-->
            <div class="col-md-3">
                <div class="panel panel-default sidebar-menu">
                    <div class="panel-heading">
                        <!-- panel handing Start-->
                        <h3 class="panel-title">Product Categories</h3>
                    </div><!-- panel handing End-->
                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked category-menu">
                            <?php
               
                    global $con;
                
                    $get_p_cat="SELECT * FROM product_category";
                    $run_p_cat=mysqli_query($con,$get_p_cat) or die(mysqli_error($con));
                    while ($row_p_cat=mysqli_fetch_array($run_p_cat)) {
                        $p_cat_id=$row_p_cat['p_cat_id'];
                        $p_cat_title=$row_p_cat['p_cat_title'];
                
                        echo "<li><a href='shopSearch.php?p_cat=$p_cat_id&vendor_id=$vendor_id'>$p_cat_title</a></li>";
                    }
                
                
            ?>
                        </ul>
                    </div>
                </div>

                <div class="panel panel-default sidebar-menu">
                    <div class="panel-heading">
                        <!-- panel handing Start-->
                        <h3 class="panel-title">Filters</h3>
                    </div><!-- panel handing End-->
                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked category-menu">
                            <?php
                    global $con;
                    $get_cat="SELECT * FROM categories";
                    $run_cat=mysqli_query($con,$get_cat) or die(mysqli_error($con));
                    while ($row_cat=mysqli_fetch_array($run_cat)) {
                        $cat_id =$row_cat['cat_id'];
                        $cat_title=$row_cat['cat_title'];
                        echo "<li><a href='shopSearch.php?cat_id=$cat_id&vendor_id=$vendor_id'>$cat_title</a></li>";
                    }
                
           ?>
                        </ul>
                    </div>
                </div>

            </div><!-- col-md-13 END-->
            <div class="col-md-9">
                <!-- col-md-9 START-->
                <?php
                        if(!isset($_GET['p_cat'])){

                            if (!isset($_GET['cat_id'])){
                                echo "<div class='box'> 
                                    <h1>Shop</h1>
                                    <p>This Shop was created by IITM, G6.</p>
                                    </div>";
                            }
                        }
                   ?>

                <div class="row">
                    <?php
                        if (isset($_GET['p_cat'])) {

                                $per_page=6;
                                if (isset($_GET['page'])){
                                    $page=$_GET['page'];
                                }else{
                                    $page=1; 
                                }
                                $start_from=($page-1) *$per_page;
                                $get_product="SELECT * FROM products WHERE p_cat_id='$p_cat' AND vendor_id='$vendor_id' ORDER BY 1 DESC LIMIT $start_from, $per_page";
                            
                                $run_pro=mysqli_query($con,$get_product) or die(mysqli_error($con));
                               
                                while ($row=mysqli_fetch_array($run_pro)) {
                                    $pro_id=$row['product_id'];
                                    $pro_title=$row['product_title'];
                                    $pro_price=$row['product_price'];
                                    $pro_img1=$row['product_img1'];
                                    $pro_stock = $row['stock'];
                                    echo "
                                    <div class='col-md-4 col-sm-6 center-responsive'>
                                        <div class='product'>
                                        <a href='details.php?pro_id=$pro_id'>
                                            <img src='admin_area/product_images/$pro_img1' class='img-responsive'>";
                                            if($pro_stock == 0){
                                                echo"
                                                <div class='label'>
                                                    <span >Out Of Stock</span>
                                                </div>";
                                            }
                                       echo" </a>
                                        <div class='text'>
                                            <h3><a href='details.php?pro_id=$pro_id'>$pro_title</a></h3>
                                            <p class='price'>INR $pro_price</p>
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

                        }
                                if(isset($_GET['cat_id'])){

                                    $per_page=6;
                                    if (isset($_GET['page'])){
                                        $page=$_GET['page'];
                                    }else{
                                        $page=1; 
                                    }
                                    $start_from=($page-1) *$per_page;
                                    $get_product="SELECT * FROM products WHERE cat_id='$cat' AND vendor_id='$vendor_id' ORDER BY 1 DESC LIMIT $start_from, $per_page";
                                
                                    $run_pro=mysqli_query($con,$get_product) or die(mysqli_error($con));
                                   
                                    while ($row=mysqli_fetch_array($run_pro)) {
                                        $pro_id=$row['product_id'];
                                        $pro_title=$row['product_title'];
                                        $pro_price=$row['product_price'];
                                        $pro_img1=$row['product_img1'];
                                        $pro_stock = $row['stock'];
                                        echo "
                                        <div class='col-md-4 col-sm-6 center-responsive'>
                                            <div class='product'>
                                            <a href='details.php?pro_id=$pro_id'>
                                                <img src='admin_area/product_images/$pro_img1' class='img-responsive'>";
                                                if($pro_stock == 0){
                                                    echo"
                                                    <div class='label'>
                                                        <span >Out Of Stock</span>
                                                    </div>";
                                                }
                                           echo" </a>
                                            <div class='text'>
                                                <h3><a href='details.php?pro_id=$pro_id'>$pro_title</a></h3>
                                                <p class='price'>INR $pro_price</p>
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
                                        }

                                ?>

                </div>
                <!-- Pagination -->
                <center>
                    <ul class="pagination">
                        <?php
                                if(isset($_GET['p_cat'])){
                                $query="SELECT * FROM products";
                                $result=mysqli_query($con,$query) or die(mysqli_error($con));
                                $total_record=mysqli_num_rows($result);
                                $total_pages=ceil($total_record/$per_page);

                                echo "
                                    <li><a href='shopSearch.php?page=1&vendor_id=$vendor_id&p_cat=$p_cat'>".'First Page'."</a></li>
                                ";
                                for ($i=1; $i <=$total_pages; $i++) { 
                                    echo "
                                    <li><a href='shopSearch.php?page=".$i."&vendor_id=$vendor_id&p_cat=$p_cat'>".$i."</a></li>
                                    ";
                                };

                                echo "
                                    <li><a href='shopSearch.php?page=$total_pages&vendor_id=$vendor_id&p_cat=$p_cat'>".'Last Page'."</a></li>

                                ";

                            }if(isset($_GET['cat_id'])){
                                $query="SELECT * FROM products";
                                $result=mysqli_query($con,$query) or die(mysqli_error($con));
                                $total_record=mysqli_num_rows($result);
                                $total_pages=ceil($total_record/$per_page);

                                echo "
                                    <li><a href='shopSearch.php?page=1&vendor_id=$vendor_id&cat_id=$cat'>".'First Page'."</a></li>
                                ";
                                for ($i=1; $i <=$total_pages; $i++) { 
                                    echo "
                                    <li><a href='shopSearch.php?page=".$i."&vendor_id=$vendor_id&cat_id=$cat'>".$i."</a></li>
                                    ";
                                };

                                echo "
                                    <li><a href='shopSearch.php?page=$total_pages&vendor_id=$vendor_id&cat_id=$cat'>".'Last Page'."</a></li>

                                ";


                            }
                        

                            ?>

                    </ul>
                </center>




            </div>
        </div>
    </div>





    <?php
    include("includes/footer.php");
    
    ?>

    <!--footer end-->

    <!-- javaSscript-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>

</html>
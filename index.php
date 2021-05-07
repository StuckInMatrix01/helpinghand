<?php
    session_start();
    include("includes/db.php");
    include_once("functions/functions.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>helpinghand</title>
    <link rel="shortcut icon" type="image/jpg" href="images/logoOS.jpg" class="img-circle" >
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

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
    </div> 
   <!--nav bar-->
    <nav class="navbar navbar-default" id="navbartext">
        <div class="container">
            <div class="navbar-header">
            <a class="navbar-brand" href="index.php">
                        <img src="images/logoOS.jpg" alt="helpinghand" class="hidden-xs img-circle" width="50" height="50" style="{ left: 20px}">
                    <img src="images/logoOS.jpg" alt="helpinghand" class="visible-xs img-circle" width="30" height="30">
                </a>

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigationtoggle" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                   <i class="fa fa-align-justify"></i>
                </button>
                
            </div>

            <!-- collecting all link and dropdowns for toggle  -->
            <div class="collapse navbar-collapse navbartext" id="navigationtoggle">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.php">
                           Home
                        </a>
                    </li>
                    <li>
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
    <!-- slider-->

    <div class="container" id="slider">
        <div class="col-md-12">
            <div class="carousel slide" id="myCarousel" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="myCarousel" data-slide-to="0" class="action"></li>
                    <li data-target="myCarousel" data-slide-to="1"></li>
                    <li data-target="myCarousel" data-slide-to="2"></li>
                    <li data-target="myCarousel" data-slide-to="3"></li>
                </ol>
                <div class="carousel-inner">
                   <?php
                    $get_slider= "select * from slider LIMIT 0,1";
                    $run_slider= mysqli_query($con, $get_slider);
                    while($row=mysqli_fetch_array($run_slider)){
                            $slider_name=$row['slider_name'];
                            $slider_image=$row['slider_image'];
                        echo"<div class='item active'>
                            <img src='admin_area/slider_images/$slider_image'>
                            </div>
                        ";
                    }
                   ?>
                    <?php
                    $get_slider="select * from slider LIMIT 1,3";
                    $run_slider=mysqli_query($con, $get_slider);
                    while($row=mysqli_fetch_array($run_slider)){
                            $slider_name=$row['slider_name'];
                            $slider_image=$row['slider_image'];
                        echo"
                        <div class='item'>
                            <img src='admin_area/slider_images/$slider_image'>
                        </div>
                        ";
                    }
                    ?>
                </div>
                <a href="#myCarousel" class="left carousel-control" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a href="#myCarousel" class="right carousel-control" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>
    </div>
    <div id="advantage">
        <div class="container">
            <div class="same-height-row">
                <div class="col-sm-4">
                    <div class="box same-height">
                        <div class="icon">
                            <i class="fa fa-tags"></i>
                        </div>
                        <h3><a href="#"></a>BEST PRICES</h3>
                        <p>You get the best prices from us</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="box same-height">
                        <div class="icon">
                            <i class="fa fa-smile-o"></i>
                        </div>
                        <h3><a href="#"></a>100% SATISFACTION</h3>
                        <p>Free return policy</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="box same-height">
                        <div class="icon">
                            <i class="fa fa-life-ring"></i>
                        </div>
                        <h3><a href="#"></a>Support</h3>
                        <p>Great customer support</p>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <div id="hot">
        <!--hot box-->
        <div class="box">
            <div class="container">
                <div class="col-md-12">
                    <h2>Latest this week</h2>
                </div>
            </div>
        </div>
    </div>

    <div id="content" class="container">
        <div class="row">
           <?php
                getPro();
           ?>


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
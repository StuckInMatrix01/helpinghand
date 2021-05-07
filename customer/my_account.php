<?php
    session_start();
    if(!isset($_SESSION['customer_email'])){
        echo "<script>window.open('../checkout.php','_self')</script>";
    }else{

    
    include("includes/db.php");
    include("functions/functions.php");
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
                        <a href="../customer_registration.php">Register</a>
                    </li>
                    <li>
                        <?php myaccount_section(); ?>
                    </li>
                    <li>
                        <a href="../cart.php">Goto cart</a>
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
                    <li>
                        <a href="../index.php">
                           Home
                        </a>
                    </li>
                    <li>
                        <a href="../shop.php">Shop

                        </a>
                    </li>
                    <li class="active">
                        <?php myaccount_section(); ?>
                    </li>
                    <li>
                        <a href="../cart.php">Shopping Cart</a>
                    </li>
                    <li>
                            <a href="../contactus.php">Contact Us</a>
                    </li>                   
                </ul>  

               
            <a href="../cart.php" class="btn btn-primary navbar-btn right">
                    <i class="fa fa-shopping-cart"></i>
                    <span><?php itemCount(); ?> items in cart</span>
            </a>

            <form  class="navbar-form navbar-left" action="../search.php" method="get">
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
                <!--START col-md-12-->
                <ul class="breadcrumb">
                    <li><a href="home.php">Home</a></li>
                    <li>My Account</li>
                </ul>
            </div> <!-- END col-md-12-->
            <div class="col-md-3"><!-- col-md-13-->
                <?php
                    include("includes/sidebar.php")
                ?>
            </div><!-- col-md-13 END-->

            <div class="col-md-9">
               <?php
                    if(isset($_GET['my_orders'])){
                        include("my_orders.php");
                    }
               
                    if(isset($_GET['pay_offline'])){
                        include("pay_offline.php");
                    }
               
                    if(isset($_GET['edit_act'])){
                        include("edit_act.php");
                    }
                
                    if(isset($_GET['change_password'])){
                        include("change_password.php");
                    }
                
                    if(isset($_GET['delete_act'])){
                        include("delete_act.php");
                    }

                    if(isset($_GET['logout'])){
                        session_destroy();
                        echo"<script>window.open('../index.php','_self')</script>";
                    }
                ?>

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
<?php }  ?>
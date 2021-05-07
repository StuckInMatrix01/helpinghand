<?php
    session_start();
    include("includes/db.php");
    include_once("functions/functions.php");
    #var_dump($_SESSION);
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
                    <li>
                        <a href="shop.php">Shop

                        </a>
                    </li>
                    <li class="active">
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

            <form  class="navbar-form navbar-left" action="">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search vendor in your area.." name="search">
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
                    <li>Registration</li>
                </ul>
            </div> <!-- END col-md-12-->
          


            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <center>
                            <h2>Customer Registration</h2>
                            <p class="text-muted">Please fill the required information below</p>
                        </center>
                    </div>
                    <form action="customer_registration.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="c_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="c_email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="c_password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" name="c_number" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>City</label>
                            <input type="text" name="c_city" class="form-control" required>
                        </div>
                       
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="c_address" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="c_image" class="form-control" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-primary">
                                <i class="fa fa-user"></i>Register
                            </button>
                        </div>
                    </form>
                </div>
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

<?php
    if(isset($_POST['submit'])){
        $c_name = $_POST['c_name'];
        $c_email = $_POST['c_email'];
        $c_password = $_POST['c_password'];
        $c_number = $_POST['c_number'];
        $c_city = $_POST['c_city'];
        $c_address = $_POST['c_address'];
        $c_image = $_FILES['c_image']['name'];
        $c_tmp_image = $_FILES['c_image']['tmp_name'];
        $c_ip = getUserIP();

        #$_SESSION['customer_name'] = $c_name;

        move_uploaded_file( $c_tmp_image,"customer/customer_images/$c_image");
        $insert_customer ="INSERT INTO customers (customer_name, customer_email, customer_pass,
        customer_num, customer_city, customer_add, customer_img, customer_ip) VALUES('$c_name',
        '$c_email','$c_password','$c_number','$c_city ','$c_address','$c_image','$c_ip')";

        $run_customer = mysqli_query($con, $insert_customer) or die(mysqli_error($con));
        $sel_cart="SELECT * FROM cart where ip_add ='$c_ip'";
        $run_cart = mysqli_query($con, $sel_cart) or die(mysqli_error($con, $sel_cart));
        $check_cart = mysqli_num_rows($run_cart);

        if($check_cart > 0){
           # $_SESSION['customer_id'] = array();
            #$_SESSION['customer_id'][] = array('customer_email' => $c_email, 'customer_name'=>$c_name); 
           #$_SESSION['customer_name'] = $c_name;
            $_SESSION['customer_email']= $c_email; 
            echo"<script>alert('You have been registered successfully')</script>";
            echo"<script>window.open('checkout.php','_self')</script>";
        }else{
           # $_SESSION['customer_id'] = array();
           # $_SESSION['customer_id'][] = array('customer_email' => $c_email, 'customer_name'=>$c_name); 
            #$_SESSION['customer_name'] = $c_name;
           # $_SESSION['customer_email'] = array();
           $_SESSION['customer_email'] = $c_email; 
            echo"<script>alert('You have been registered successfully')</script>";
            echo"<script>window.open('index.php','_self')</script>";
        }
        
    }
    

#print_r($_SESSION['customer_name']);
?>
<?php
    session_start();
    if(!isset($_SESSION['customer_email'])){
        echo "<script>window.open('../checkout.php','_self')</script>";
    }else{

    include("includes/db.php");
    include("functions/functions.php");
    if(isset($_GET['order_id'])){
        $order_id = $_GET['order_id'];
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
    <div class="navbar navbar-default" id="navbar">
        <!--navbar navbar-default start-->
        <div class="container">
            <div class="navbar-header">
                <!-- navbar header start-->
                <a class="navbar-brand home" href="index.php">
                    <img src="images/logoOS.jpg" alt="helpinghand" class="hidden-xs img-circle" width="60" height="60">
                    <img src="images/logoOS.jpg" alt="helpinghand" class="visible-xs img-circle" width="40" height="40">
                </a>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                    <span class="sr-only">Toggle Navigation</span>
                    <i class="fa fa-align-justify"></i>
                </button>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
                    <span class="sr-only"></span>
                    <i class="fa fa-search"></i>
                </button>
            </div> <!-- navbar header end-->
            <div class="navbar-collapse collapse" id="navigation">
                <!-- navbar collapse start-->
                <div class="padding-nav">
                    <ul class="nav navbar-nav navbar-left">
                        <!-- padding nav start-->
                        <li>
                            <a href="../index.php">Home</a>
                        </li>
                        <li>
                            <a href="../shop.php">Shop</a>
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
                </div><!-- padding nav end-->
                <a href="cart.php" class="btn btn-primary navbar-btn right">
                    <i class="fa fa-shopping-cart"></i>
                    <span><?php itemCount(); ?> items in cart</span>
                </a>

                <div class="navbar-collapse collapse right">
                    <!-- navbar-collapse collapse right star-->
                    <button class="btn navbar-btn btn-primary" type="button" data-toggle="collapse"
                        data-target="#search">

                        <span class="sr-only"> Toggle Search</span>
                        <i class="fa fa-search"></i>

                    </button>
                </div><!-- navbar-collapse collapse right end-->
                <div class="collapse clearfix" id="search">
                    <form class="navbar-form" action="result.php" method="get">
                        <div class="input-group">
                            <input type="text" name="user_query" placeholder="Search" class="form-control" required>
                            <span class="input-group-btn">
                                <button type="submit" value="Search" name="search" class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>

                </div>
            </div><!-- navbar collapse end-->
        </div>
    </div>

    <div id="content">
        <div class="container">
            <div class="col-md-12">
                <!--START col-md-12-->
                <ul class="breadcrumb">
                    <li><a href="home.php">Home</a></li>
                    <li>My Account</li>
                </ul>
            </div> <!-- END col-md-12-->
            <div class="col-md-3">
                <!-- col-md-13-->
                <?php
                    include("includes/sidebar.php")
                ?>
            </div><!-- col-md-13 END-->

            <div class="col-md-9">
                <div class="box">
                    <h1 align="center">Please confirm your payment</h1>
                    <form action="confirm.php?update_id=<?php echo $order_id ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Invoice Number</label>
                            <input type="text" name="invoice_number" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="">Amount</label>
                            <input type="text" name="amount" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Select Payment Mode</label>
                            <select class="form-control" name="payment_mode">
                                <option value="">Bank Transfer</option>
                                <option value="paypal">Paypal</option>
                                <option value="">PayTM</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Transaction Number</label>
                            <input type="text" name="trfr_number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Payment Date</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="confirm_payment" class="btn btn-primary btn-lg">
                                Confirm Payment
                            </button>
                        </div>
                    </form>
                    
                   <?php
                        if(isset($_POST['confirm_payment'])){
                            $update_id = $_GET['update_id'];
                            $invoice_number=$_POST['invoice_number'];
                            $amount=$_POST['amount'];
                            $payment_mode = $_POST['payment_mode'];
                            $trfr_number=$_POST['trfr_number'];
                            $date=$_POST['date'];
                            $complete="Complete";

                            $insert = "INSERT INTO payments (invoice_id,amount,payment_mode,ref_no,payment_date) 
                            VALUES ('$invoice_number','$amount','$payment_mode','$trfr_number','$date')";

                            $run_insert= mysqli_query($con, $insert) or die(mysqli_error($con));

                            $update_q =" UPDATE customer_order SET  order_status = '$complete' WHERE order_id='$update_id'";
                            $run_update_q= mysqli_query($con, $update_q) or die(mysqli_error($con));

                            // $update_pending =" UPDATE pending_orders SET  order_status = '$complete' WHERE order_id='$update_id'";
                            // $run_update_p= mysqli_query($con, $update_pending) or die(mysqli_error($con));

                            echo"
                                <script>alert('Your order has been received')</script>
                            ";
                            echo"
                                <script>window.open('my_account.php?order','_self')</script>
                            ";

                            

                        }
                   
                   ?> 




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

<?php }  ?>
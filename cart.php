<?php
    session_start();
    include("includes/db.php");
    include_once("functions/functions.php");
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
                        <?php  myaccount_section();  ?>
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

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigationtoggle" aria-expanded="false">
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
                    <li>
                        <a href="shop.php">Shop

                        </a>
                    </li>
                    <li>
                        <?php myaccount_section(); ?>
                    </li>
                    <li class="active">
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

            <form  class="navbar-form navbar-left" action="search.php" method="GET">
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
            <div class="col-md-12"> <!--START col-md-12-->
                <ul class="breadcrumb">
                    <li><a href="home.php">Home</a></li>
                    <li>Cart</li>
                </ul>
            </div> <!-- END col-md-12-->
            
            <div class="col-md-9" id="cart">
                <div class="box">
                    <form action="cart.php" method="post" enctype="multipart/form-data">
                        <h1>Shopping Cart</h1>
                        <?php 
                        
                            $ip_add = getUserIP();
                            $select_cart ="SELECT * FROM cart WHERE ip_add ='$ip_add' ";
                            $run_cart = mysqli_query($con,$select_cart) or die(mysqli_error($con));
                            $count = mysqli_num_rows($run_cart);
                        
                        ?>
                        <p class="text-muted">Currently you have <?php echo $count ?> item(s) in your cart</p>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Product</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Size</th>
                                        <th colspan="1">Delete</th>
                                        <th colspan="1">Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $total=0;
                                       while ($row = mysqli_fetch_array($run_cart)) {
                                            $pro_id = $row['p_id'];
                                            $pro_size = $row['size'];
                                            $pro_qty = $row['qty'];

                                            $get_product = "SELECT * FROM products WHERE  product_id='$pro_id'";
                                            $run_pro = mysqli_query($con, $get_product) or die(mysqli_error($con));

                                        while ($row= mysqli_fetch_array($run_pro)) {

                                                $p_title = $row['product_title'];
                                                $p_img1 = $row['product_img1'];
                                                $p_price = $row['product_price'];
                                                $sub_total = $row['product_price'] * $pro_qty;
                                                $total +=$sub_total;   
                                    
                                    ?>

                                    <tr>
                                        <td><img src="admin_area/product_images/<?php echo $p_img1 ?>" alt="product_image"></td>
                                        <td><?php echo $p_title ?></td>
                                        <td><?php echo $pro_qty ?></td>
                                        <td>INR <?php echo $p_price ?></td>
                                        <td><?php echo $pro_size ?></td>
                                        <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id ?>"></td>
                                        <td>INR <?php echo $sub_total ?></td>
                                    </tr>

                                    <?php } } ?>
                                </tbody>

                                <tfoot>
                                
                                </tfoot>
                            </table>
                        </div>
                        
                        <div class="box-footer">
                           <div class="pull-left">
                                <h4><b>Total Price</b></h4>
                           </div> 
                           <div class="pull-right">
                               <h4><b> INR <?php echo  $total;  ?></b> </h4>
                           </div>
                        </div>
                        
                        
                        <div class="box-footer">
                           <div class="pull-left">
                               <a href="index.php" class="btn btn-default">
                                   <i class="fa fa-chevron-left"></i> Continue Shopping
                               </a>
                           </div> 
                           <div class="pull-right">
                               <button class="btn btn-default" type="submit" name="update" value="Update Cart">
                                   <i class="fa fa-refresh">Delete Selected Items</i>
                               </button>
                               <a href="checkout.php" class="btn btn-primary">
                                   Proceed to checkout<i class="fa fa-chevron-right"></i>
                               </a>
                           </div>
                        </div>
                    </form>
                </div>

                <?php
                    function update_cart(){
                        global $con;
                        if (isset($_POST['update'])) {
                            foreach ($_POST['remove'] as $remove_id ) {
                                    $delete_product = "DELETE FROM cart WHERE p_id='$remove_id'";
                                    $run_del = mysqli_query($con, $delete_product) or die(mysqli_error($con));
                                    if ($run_del){
                                        echo "<script> 
                                            window.open('cart.php','_self')
                                        </script>";
                                    }
                            }
                        }
                    }
                    echo @$up_cart = update_cart();
                ?>

                <div id="row same-height-row">
                    <div class="col-md-3 col-sm-6">
                        <div class="box same-height headline">
                            <h3 class="text-center">You may also like</h3>
                        </div>
                    </div>

                   <?php
                        $get_product="SELECT * FROM products WHERE stock>0 ORDER BY RAND() LIMIT 0,3 ";
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
            <!-- side panel to left of page of ckeckout-->
            <div class="col-md-3">
                <div class="box" id="order-summary">
                    <div class="box-header">
                        <h3>Order Summary</h3>
                    </div>
                    <p class="text-muted">
                        Shipping and additional are calculated based on the values entered
                    </p>
                    
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Order Subtotal</td>
                                    <th>INR <?php echo $total ?></th>
                                </tr>
                                
                                <tr>
                                    <td>Shipping and Handling</td>
                                    <td>INR 0</td>
                                </tr>

                                <tr>
                                    <td>Tax</td>
                                    <td>INR 0</td>
                                </tr>
                                <tr class="total">
                                    <td>Total</td>
                                    <th>INR <?php echo $total ?></th>
                                </tr>


                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>
    </div>

     <?php
        include("includes/footer.php");
    ?>

    <!-- javaSscript-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>

</html>
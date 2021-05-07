<?php
    include("includes/db.php");
    if(!isset($_SESSION['vendor_email'])){
        echo"<script>window.open('login.php','_self')</script>";
    }else{

   
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i>Dashboard

            </li>
        </ol>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-8">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-product-hunt fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $count_pro; ?></div>
                            <div>Products</div>
                        </div>
                    </div>
                </div>
                <a href="index.php?view_product">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-rigt"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fas fa-box-open fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $count_c_order; ?></div>
                            <div>Orders</div>
                        </div>
                    </div>
                </div>
                <a href="index.php?view_order">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-rigt"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-money fa-fw"></i>New Orders
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Order No:</th>
                                    <th>Customer Email:</th>
                                    <th>Invoice No:</th>
                                    <th>Product ID:</th>
                                    <th>Total:</th>
                                    <th>Date:</th>
                                    <th>Status:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                            $i=0;

                            $get_order="SELECT * FROM customer_order WHERE vendor_id = '$vendor_id' order by 1 DESC LIMIT 0, 3";
                            $run_order = mysqli_query($con,$get_order) or die(mysqli_error($con));
                            while($row_order=mysqli_fetch_array($run_order)){
                                $order_id = $row_order['order_id'];
                                $customer_id = $row_order['customer_id'];
                                $product_id = $row_order['product_id'];
                                $invoice_no = $row_order['invoice_no'];
                                $qty = $row_order['qty'];
                                $size = $row_order['size'];
                                $order_status = $row_order['order_status'];
                                $i++;


                            
                            
                            
                            ?>


                                <tr>
                                    <td><?php echo $i; ?> </td>
                                    <td>
                                        <?php 
                                        $get_cust= "SELECT * FROM customers WHERE customer_id='$customer_id'";
                                        $run_cust = mysqli_query($con, $get_cust) or die(mysqli_error($con));
                                        $row_customer = mysqli_fetch_array($run_cust);
                                        $customer_email = $row_customer['customer_email'];
                                        echo $customer_email;     
                                    ?>
                                    </td>
                                    <td> <?php echo $invoice_no; ?></td>
                                    <td><?php echo $product_id; ?> </td>
                                    <td><?php echo $qty; ?> </td>
                                    <td> <?php echo $size; ?></td>
                                    <td> <?php echo $order_status; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right"></div>
                    <a href="index.php?view_order">
                        View All Orders <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        
    </div>

    <div class="col-lg-4 col-md-12 sidebar">
            <div class="panel">
                <div class="panel-body">
                    <div class="thumb-info mb-md">
                        <img src="vendor_images/<?php echo $vendor_image; ?>" class="rounded img-responsive" alt=""
                            height="80" width="150">
                        <div class="thumb-info-title">
                            <span class="thumb-info-inner"><?php echo $vendor_name; ?></span>
                            <span class="thumb-info-type"><?php echo $vendor_area; ?></span>
                        </div>
                    </div>
                    <div class="mb-md">
                        <div class="widget-content-expanded">
                            <i class="fas fa-id-badge"></i><span>Vendor ID:</span><?php echo $vendor_id; ?><br>
                            <i class="fas fa-envelope"></i><span>Email:</span><?php echo $vendor_email; ?> <br>
                            <i class="fas fa-phone"></i><span>Contact:</span><?php echo $vendor_contact; ?> <br>
                            <i class="fas fa-map-marker"></i><span>Area:</span><?php echo $vendor_area; ?> <br>
                         <!--   <i class="fas fa-map-marker"></i><span>Address:</span><?php echo $vendor_add; ?> <br>-->
                           
                        </div>
                        <hr class="dotted short">
                        <h5 class="text-muted">About</h5>
                        <p>
                            <?php echo $vendor_about; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<?php  } ?>

<!--  <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
           <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php# echo $count_cust; ?></div>
                        <div>Customers</div>
                    </div>
                </div>
            </div>
            <a href="index.php?view_customer">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-rigt"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>-->
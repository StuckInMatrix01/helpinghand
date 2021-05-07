<?php
    if(!isset($_SESSION['vendor_email'])){
        echo"<script>window.open('login.php','_self')</script>";
    }else{
?>
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i>Dashboard / View Product
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                        <i class="fa fa-money fa-fw"></i>View Products
                </h3>

            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th>Product ID</th>
                                <th>Vendor ID</th>
                                <th>Product Title</th>
                                <th>Product Image</th>
                                <th>Product Price</th>
                                <th>Product Keyword</th>
                                <th>Product Date</th>
                                <th>Product Stock</th>
                                <th>Product Delete</th>
                             
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i=0;
                             /***************getting vendor id *********** */
                                $vendor_emailS = $_SESSION['vendor_email'];
                                $get_vendor= "SELECT vendor_id FROM vendor WHERE vendor_email ='$vendor_emailS'";
                                $run_vendor = mysqli_query($con, $get_vendor) or die(mysqli_error($con));
                                if($row_vendor_id=mysqli_fetch_array($run_vendor)){
                                        $vendor_id =$row_vendor_id['vendor_id'];
                                }
                             
                             /***************inserting vendor id to view producst where $vendorID{from vendor} == vendorID************ */
                                $get_product="SELECT * FROM products WHERE vendor_id='$vendor_id'";
                                $run_p = mysqli_query($con, $get_product) or die(mysqli_error($con));
                                while($row_p=mysqli_fetch_array($run_p)){
                                    $pro_id = $row_p['product_id'];
                                    $vendor_id = $row_p['vendor_id'];
                                    $product_title = $row_p['product_title'];
                                    $product_img1 = $row_p['product_img1'];
                                    $product_price = $row_p['product_price'];
                                    $product_stock =$row_p['stock'];
                                    $product_keywords = $row_p['product_keywords'];
                                    $pro_date = $row_p['dateandtime'];
                                    $i++;
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $pro_id ?></td>
                                <td><?php echo $vendor_id ?></td>
                                <td><?php echo $product_title ?></td>
                                <td><img src="product_images/<?php echo $product_img1 ?>" width="40" height="40" ></td>
                                <td><?php echo $product_price ?></td>
                                <td><?php echo $product_keywords ?></td>
                                <td><?php echo $pro_date ?></td>
                                <td>
                                    <p><?php echo $product_stock; ?></p>
                                    <a href="index.php?update_stock=<?php echo $pro_id; ?>">
                                    <i class="fa fa-pencil"></i>Update
                                    </a>
                                </td>
                                <td>
                                    <a href="index.php?delete_product=<?php echo $pro_id;  ?>">
                                        <i class="fa fa-trash-o"></i>Delete
                                    </a>
                                </td>

                               <?php
                                   # $get_sold = "SELECT * FROM customer order "

                               ?>
                            </tr>
                            <?php  } ?>
                        </tbody>

                    </table>

                </div>

            </div>


        </div>

    </div>

</div>


<?php } ?>
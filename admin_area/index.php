<!-- ADMIN AREA -->
<?php
    session_start();
    include("includes/db.php");
    if(!isset($_SESSION['admin_email'])){
        echo"<script>window.open('login.php','_self')</script>";
    }else{

?>

<?php
    $admin_session = $_SESSION['admin_email'];
    $get_admin= "SELECT * FROM admins where admin_email ='$admin_session'";
    $run_admin = mysqli_query($con, $get_admin) or die(mysqli_error($con));
    $row_admin = mysqli_fetch_array($run_admin);
    $admin_id = $row_admin['admin_id'];
    $admin_name = $row_admin['admin_name'];
    $admin_email = $row_admin['admin_email'];
    $admin_image = $row_admin['admin_image'];
    $admin_city = $row_admin['admin_city'];
    $admin_job = $row_admin['admin_job'];
    $admin_contact = $row_admin['admin_contact'];
    $admin_about = $row_admin['admin_about'];

    $get_product="SELECT * FROM products";
    $run_pro = mysqli_query($con, $get_product) or die(mysqli_error($con));
    $count_pro= mysqli_num_rows($run_pro);

    $get_cust ="SELECT * FROM customers";
    $run_cust = mysqli_query($con, $get_cust) or die(mysqli_error($con));
    $count_cust= mysqli_num_rows($run_cust);

    $get_p_cat = "SELECT * FROM product_category";
    $run_p_cat = mysqli_query($con, $get_p_cat) or die(mysqli_error($con));
    $count_p_cat= mysqli_num_rows($run_p_cat);

    $get_c_order = "SELECT * FROM customer_order";
    $run_c_order = mysqli_query($con, $get_c_order) or die(mysqli_error($con));
    $count_c_order= mysqli_num_rows($run_c_order);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Panel</title>
    <link rel="shortcut icon" type="image/jpg" href="images/logoOS.jpg" class="img-circle">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Font-Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body>
    <div id="wrapper">
        <?php include('includes/sidebar.php');  ?>
        <div id="page-wrapper">
            <div class="container-fluid main">
                <?php
                 if(isset($_GET['dashboard'])){
                     include('dashboard.php');
                 }
                 if(isset($_GET['insert_product'])){
                    include('insert_product.php');
                    #header("location: insert_product.php");
                }
                if(isset($_GET['view_product'])){
                    include('view_product.php');
                }
                if(isset($_GET['delete_product'])){
                    include('delete_product.php');
                }
                if(isset($_GET['edit_product'])){
                    include('edit_product.php');
                }
                if(isset($_GET['insert_product_cat'])){
                    include('insert_p_cat.php');
                }
                if(isset($_GET['view_product_cat'])){
                    include('view_product_cat.php');
                }
                if(isset($_GET['update_stock'])){
                    include('update_stock.php');
                }
                if(isset($_GET['delete_p_cat'])){
                    include('delete_product_cat.php');
                }
                if(isset($_GET['edit_p_cat'])){
                    include('edit_product_cat.php');
                }
                if (isset($_GET['insert_categories'])) {
                    include('insert_cat.php');
                }
                if(isset($_GET['view_categories'])){
                    include('view_cat.php');
                }
                if(isset($_GET['delete_cat'])){
                    include('delete_cat.php');
                }
                if(isset($_GET['edit_cat'])){
                    include('edit_cat.php');
                }
                if(isset($_GET['insert_slider'])){
                    include('insert_slider.php');
                }
                if(isset($_GET['view_slider'])){
                    include('view_slider.php');
                }
                if(isset($_GET['delete_slider'])){
                    include('delete_slider.php');
                }
                if(isset($_GET['edit_slider'])){
                    include('edit_slider.php');
                }
                if(isset($_GET['view_customer'])){
                    include('view_customer.php');
                }
                if(isset($_GET['customer_delete'])){
                    include('delete_customer.php');
                }
                if(isset($_GET['view_order'])){
                    include('view_order.php');
                }
                if(isset($_GET['order_delete'])){
                    include('delete_order.php');
                }
                if(isset($_GET['view_payments'])){
                    include('view_payments.php');
                }
                if(isset($_GET['payment_delete'])){
                    include('delete_payments.php');
                }
                if(isset($_GET['insert_user'])){
                    include('insert_user.php');
                }
                if(isset($_GET['view_user'])){
                    include('view_user.php');
                }
                if(isset($_GET['user_delete'])){
                    include('delete_user.php');
                }
                if(isset($_GET['edit_user'])){
                    include('edit_user.php');
                }
                if(isset($_GET['view_vendors'])){
                    include('view_vendors.php');
                }
                if(isset($_GET['registration_vendor'])){
                    include('registration_vendor.php');
                }
                if(isset($_GET['vendor_delete'])){
                    include('vendor_delete.php');
                }

                ?>
            </div>

    </div>

    </div>
    




    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>


</html>
<?php  } ?>
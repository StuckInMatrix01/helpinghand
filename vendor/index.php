<!-- ADMIN AREA -->
<?php
    session_start();
    include("includes/db.php");
    if(!isset($_SESSION['vendor_email'])){
        header("location:login.php");
    }else{

    $vendor_session = $_SESSION['vendor_email'];
    $get_vendor= "SELECT * FROM vendor where vendor_email ='$vendor_session'";
    $run_vendor = mysqli_query($con, $get_vendor) or die(mysqli_error($con));
    $row_vendor = mysqli_fetch_array($run_vendor);
    $vendor_id = $row_vendor['vendor_id'];
    $vendor_email = $row_vendor['vendor_email'];
    $vendor_name = $row_vendor['vendor_name'];
    $vendor_area = $row_vendor['vendor_area'];
    $vendor_add = $row_vendor['vendor_add'];
    $vendor_contact = $row_vendor['vendor_contact'];
    $vendor_image = $row_vendor['vendor_img'];
    $vendor_about = $row_vendor['vendor_about'];

    $get_product="SELECT * FROM products WHERE vendor_id = '$vendor_id'";
    $run_pro = mysqli_query($con, $get_product) or die(mysqli_error($con));
    $count_pro= mysqli_num_rows($run_pro);


    $get_c_order = "SELECT * FROM customer_order WHERE vendor_id = '$vendor_id'";
    $run_c_order = mysqli_query($con, $get_c_order) or die(mysqli_error($con));
    $count_c_order= mysqli_num_rows($run_c_order);

  //  header("location:index.php?dashboard");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Vendor Panel</title>
    <link rel="shortcut icon" type="image/jpg" href="images/logoOS.jpg" class="img-circle">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Font-Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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
                 }
                 if(isset($_GET['view_product'])){
                     include('view_product.php');
                 }
                 if(isset($_GET['delete_product'])){
                     include('delete_product.php');
                 }
                 if(isset($_GET['view_order'])){
                     include("view_order.php");
                 }
                 if(isset($_GET['delete_order'])){
                    include("delete_order.php");
                }
                if(isset($_GET['view_user'])){
                    include("view_user.php");
                }
                if(isset($_GET['delete_user'])){
                    include("delete_user.php");
                }
                if(isset($_GET['edit_user'])){
                    include("edit_user.php");
                }
                if(isset($_GET['logout.php'])){
                    include("logout.php");
                }
                if(isset($_GET['update_stock'])){
                    include("update_stock.php");
                }




                ?>
            </div>

    </div>

    </div>
    




    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>


</html>
<?php  } ?>
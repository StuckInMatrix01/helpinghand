<?php
    if(!isset($_SESSION['admin_email'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else {

?>

<?php
    if(isset($_GET['delete_product'])){
        $delete_id = $_GET['delete_product'];
        $delete_pro = "DELETE FROM products WHERE product_id='$delete_id'";
        $run_delete = mysqli_query($con,$delete_pro) or die(mysqli_error($con));

        if($run_delete){
            echo "<script>alert('Your 1 Product Has been deleted Successfully.')</script>";
            echo "<script>window.open('index.php?view_product','_self')</script>";
        }
    }

?>

<?php } ?>
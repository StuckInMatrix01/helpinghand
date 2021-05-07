<?php
    if(!isset($_SESSION['vendor_email'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else {
?>
<?php
    if(isset($_GET['delete_order'])){
    $delete_id = $_GET['delete_order'];
    $delete_order = "DELETE FROM customer_order WHERE order_id='$delete_id'";
    $run_delete = mysqli_query($con,$delete_order) or die(mysqli_error($con));
    if($run_delete){
        echo "<script>alert('Order Has Been Deleted')</script>";
        echo "<script>window.open('index.php?view_order','_self')</script>";
    }

}
?>
<?php }  ?>
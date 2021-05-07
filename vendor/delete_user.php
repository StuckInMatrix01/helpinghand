<?php
    if(!isset($_SESSION['vendor_email'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else {
?>
<?php
    if(isset($_GET['user_delete'])){
        $delete_id = $_GET['user_delete'];
        $delete_user = "DELETE FROM vendor WHERE vendor_id='$delete_id'";
        $run_delete = mysqli_query($con,$delete_user) or die(mysqli_error($con));
            if($run_delete){
                echo "<script>alert('Your account has been deleted')</script>";
                echo "<script>window.open('index.php?logout.php','_self')</script>";
            }
    }
?>
<?php } ?>
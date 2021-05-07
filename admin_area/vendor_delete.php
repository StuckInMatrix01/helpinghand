<?php
    if(!isset($_SESSION['admin_email'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else {
?>
<?php

    if(isset($_GET['vendor_delete'])){
        $delete_id = $_GET['vendor_delete'];
        $delete_user = "DELETE FROM vendor WHERE vendor_id='$delete_id'";
        $run_delete = mysqli_query($con,$delete_user) or die(mysqli_error($con));
            if($run_delete){
                echo "<script>alert('One Vendor Has Been Deleted')</script>";
                echo "<script>window.open('index.php?view_vendors','_self')</script>";
            }
    }else{
        echo "<script>alert('Not deleted')</script>";
    }
?>
<?php } ?>
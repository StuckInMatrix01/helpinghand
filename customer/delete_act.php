
<div class="box">
    <center>
        <h1>Do you really want to delete your account?</h1>
        <form action="" method="POST">
            <input type="submit" name="yes" value="Yes, I Want To Delete" class="btn btn-danger">
            <input type="submit" name="no" value="No, I Don't  Want To " class="btn btn-primary">
        </form>
    </center>

</div>

<?php
 $c_email = $_SESSION['customer_email'];
 if(isset($_POST['yes'])){
     $delete_q ="DELETE FROM customers  WHERE customer_email='$c_email'";
     $run_q = mysqli_query($con, $delete_q) or die(mysqli_error($con));
     if($run_q){
         session_destroy();
         echo"<script>alert('Your account has been deleted')</script>";
         echo"<script>window.open('../index.php','_self')</script>";
     }
 }

?>
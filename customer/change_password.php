<div class="box">
    <center>
        <h3>Change you Password</h3>
    </center>
    <form action="" method="POST">
        <div class="form-group">
            <label>Enter your current password</label>
            <input type="password" name="old_password" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Enter your new password</label>
            <input type="password" name="new_password" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Confirm your current password</label>
            <input type="password" name="c_n_password" class="form-control" required>
        </div>
        <div class="text-center">
            <button class="btn btn-primary btn-lg" name="update" type="submit">
                Update Now
            </button>
        </div>
    </form>
</div>

<?php
    if(isset($_POST['update'])){
        $c_email = $_SESSION['customer_email'];
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $c_n_password = $_POST['c_n_password'];
        $select_cust ="SELECT * FROM customers WHERE customer_email='$c_email' AND customer_pass='$old_password'";
        $run_q = mysqli_query($con, $select_cust) or die(mysqli_error($con));
        $check_old_pass = mysqli_num_rows($run_q);
        if($check_old_pass==0){
            echo"<script>alert('Your Current password is not valid...Try again!')</script>";
            exit();
        }
        if($old_password== $new_password){
            echo"<script>alert('Your new and old passwords can't be the same.')</script>";
            exit();

        }
        if($new_password!=$c_n_password){
            echo"<script>alert('Your password don't match, Try again')</script>";
            exit();
        }
        $update_q="UPDATE customers SET customer_pass='$new_password' WHERE customer_email='$c_email'";
        $run_q= mysqli_query($con, $update_q) or die(mysqli_error($con));
        echo" <script>alert('Your password has been changed successfully!')</script> ";
        echo"<script>window.open('../logout.php','_self')</script>";
        echo"<script>alert('Please Login again.')/script>";



    }

?>
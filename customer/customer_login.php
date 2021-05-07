<?php
    include("includes/db.php");
   # include_once("functions/functions.php"); # had fatal erro so commented it out.
?>

<div class="box">
    <div class="box-header">
        <center>
            <h2>
                Login
            </h2>
            <p class="lead">Already a customer?</p>
        </center>
    </div>
    <form action="checkout.php" method="POST">
        <div class="form-group">
            <label>Email:</label>
            <input type="text" class="form-control"  name="c_email" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" class="form-control"  name="c_password" required>
        </div>
        <div class="text-center">
            <button name="login" value="Login" class="btn btn-primary">
                <i class="fa fa-sig-in"></i>Log in
            </button>
        </div>
    </form>
    <center>
        <a href="customer_registration.php">
            <h3>New here? Register Now.</h3>
        </a>
    </center>

</div>
<?php
    if (isset($_POST['login'])) {
        $customer_email=$_POST['c_email'];
        $customer_password=$_POST['c_password'];
        $select_customers = "SELECT * FROM customers WHERE customer_email = '$customer_email' AND customer_pass= '$customer_password' ";

        $run_cust = mysqli_query($con, $select_customers) or die(mysqli_error($con));
        $get_ip = getUserIP();
        $check_customer = mysqli_num_rows($run_cust);
        $select_cart ="SELECT * FROM cart WHERE ip_add='$get_ip'";
        $run_cart =mysqli_query($con, $select_cart) or die(mysqli_error($con));
        $check_cart = mysqli_num_rows($run_cart);
        if($check_customer == 0){
            echo"<script>alert('Password/Email wrong')</script>";
            exit();
        }
        if($check_customer ==1 AND $check_cart ==0){
            $_SESSION['customer_email'] = $customer_email;
            echo"<script>alert('You are logged in.')</script>";
            echo"<script>window.open('customer/my_account.php?my_orders','_self')</script>";
        }else {
            $_SESSION['customer_email'] = $customer_email;
            echo"<script>alert('You are logged in.')</script>";
            echo"<script>window.open('checkout.php','_self')</script>";
        }
    }

?>
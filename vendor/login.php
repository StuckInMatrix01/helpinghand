<?php
session_start();
include ("includes/db.php");
if(isset($_SESSION['vendor_email'])){
	header("location:index.php?dashboard");
}else{
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Vendor Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
 
        <div class="bg-img">
            <div class="container">
                <form class="form-login" action="" method="post">
                    <h2 class="form-login-heading">Vendor Login</h2>
                    <input type="text" class="form-control" name="v_email" placeholder="Email Address" required>
                    <input type="password" class="form-control" name="v_pass" placeholder="Password" required>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="vendor_login">
                        Log in
                    </button>
                    <h4 class="forgot-password">
                        <a href="forgot_password.php">Forgot Password?</a>
                        <br>
                        <a href="registration_vendor.php">New here? Register.</a>
                    </h4>
                </form>
            </div>
        </div>

</body>
</html>
<?php
 if(isset($_POST['vendor_login'])){
	$vendor_email= mysqli_real_escape_string($con,$_POST['v_email']);
	$vendor_pass= mysqli_real_escape_string($con,$_POST['v_pass']);
	$get_vendor="SELECT * FROM vendor WHERE vendor_email='$vendor_email' AND vendor_pass='$vendor_pass'";
	$run_vendor=mysqli_query($con,$get_vendor) or die(mysqli_error($con));
	$count=mysqli_num_rows($run_vendor);
	if($count==1){
		$_SESSION['vendor_email']=$vendor_email;
		echo "<script>alert('You are logged in.')</script>";
		echo "<script>window.open('index.php?dashboard','_self')</script>";
	}else{
		echo "<script>alert('Email/Password Wrong')</script>";
	}
}

}
?>
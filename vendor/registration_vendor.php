<?php
	include("includes/db.php");
	include_once("functions/functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Registration</title>

    <link rel="shortcut icon" type="image/jpg" href="images/logoOS.jpg" class="img-circle">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/reg.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Font-Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>
<body>
<div class="bg-img">
                <div class="container">
                    <div class="">
                        <center>
                            <h2>Vendor Registration</h2>
                            <p>Please fill the required information below</p>
                        </center>
                    </div>
                    <form class="box" action="registration_vendor.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="v_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="v_email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="v_password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" name="v_number" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>City</label>
                            <input type="text" name="v_city" class="form-control" required>
                        </div>
                       
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="v_address" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="v_image" class="form-control" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-primary">
                                <i class="fa fa-user"></i>Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>



    
</body>
</html>
<?php
	if(isset($_POST['submit'])){
		$v_name = $_POST['v_name'];
        $v_email = $_POST['v_email'];
        $v_password = $_POST['v_password'];
        $v_number = $_POST['v_number'];
        $v_city = $_POST['v_city'];
        $v_address = $_POST['v_address'];
        $v_image = $_FILES['v_image']['name'];
        $v_tmp_image = $_FILES['v_image']['tmp_name'];
        $v_ip = getUserIP();


        move_uploaded_file($v_tmp_image, "vendor_images/$v_image");
        $insert_vendor ="INSERT INTO vendor (vendor_email, vendor_name, vendor_pass, vendor_contact, vendor_city, vendor_add, vendor_img, vendor_ip) 
        VALUES ('$v_name','$v_email','$v_password','$v_number','$v_city','$v_address','$v_image','$v_ip')";

        $run_vendor = mysqli_query($con, $insert_vendor) or die(mysqli_error($con));

        if ($run_vendor) {
        	$_SESSION['vendor_email']= $v_email;
        	echo "alert('You have been registered as a vendor')";
        	header("location:index.php?dashboard");
        }else{
            echo "alert('You have not been registered')";
        }
	}



?>
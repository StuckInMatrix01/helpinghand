<?php
include_once("functions/functions.php");

    if(!isset($_SESSION['admin_email'])){
    echo "<script>window.open('login.php','_self')</script>";
}else {

?>
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard / Vendor Registration
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money fa-fw"></i> Insert Vendor
                </h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Vendor Name: </label>
                        <div class="col-md-6">
                            <input type="text" name="v_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Vendor Email: </label>
                        <div class="col-md-6">
                            <input type="text" name="v_email" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Vendor Password: </label>
                        <div class="col-md-6">
                            <input type="password" name="v_password" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Vendor Area: </label>
                        <div class="col-md-6">
                            <input type="text" name="v_area" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Vendor Address: </label>
                        <div class="col-md-6">
                            <input type="text" name="v_address" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Vendor Contact: </label>
                        <div class="col-md-6">
                            <input type="text" name="v_contact" class="form-control" required>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label class="col-md-3 control-label">Vendor Image: </label>
                        <div class="col-md-6">
                            <input type="file" name="v_image" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <input type="submit" name="submit" value="Insert Vendor" class="btn btn-primary form-control">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

	if(isset($_POST['submit'])){
		$v_name = $_POST['v_name'];
        $v_email = $_POST['v_email'];
        $v_password = $_POST['v_password'];
        $v_number = $_POST['v_contact'];
        $v_area = $_POST['v_area'];
        $v_address = $_POST['v_address'];
        $v_image = $_FILES['v_image']['name'];
        $v_tmp_image = $_FILES['v_image']['tmp_name'];
        $v_ip = getUserIP();


        move_uploaded_file($v_tmp_image, "vendor_images/$v_image");
        $insert_vendor ="INSERT INTO vendor (vendor_email, vendor_name, vendor_pass, vendor_contact, vendor_area, vendor_add, vendor_img, vendor_ip) 
        VALUES ('$v_email','$v_name','$v_password','$v_number','$v_area','$v_address','$v_image','$v_ip')";

        $run_vendor = mysqli_query($con, $insert_vendor) or die(mysqli_error($con));

        if ($run_vendor) {
        	$_SESSION['vendor_email']= $v_email;
        	echo "<script>alert('You have been registered as a vendor')</script>";
            echo "<script>window.open('index.php?view_vendors','_self')</script>";
        }else{
            echo "alert('You have not been registered')";
        }
	}

}

?>
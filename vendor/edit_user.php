<?php
    if(!isset($_SESSION['vendor_email'])){
    echo "<script>window.open('login.php','_self')</script>";
}else {
?>
<?php
    if(isset($_GET['edit_user'])){
    $edit_id = $_GET['edit_user'];
    $get_vendor = "SELECT * FROM vendor WHERE vendor_id='$edit_id'";
    $run_vendor = mysqli_query($con,$get_vendor) or die(mysqli_error($con));
    $row_vendor = mysqli_fetch_array($run_vendor);
    $vendor_id = $row_vendor['vendor_id'];
    $vendor_email = $row_vendor['vendor_email'];
    $vendor_name = $row_vendor['vendor_name'];
    $vendor_pass = $row_vendor['vendor_pass'];
    $vendor_contact = $row_vendor['vendor_contact'];
    $vendor_area = $row_vendor['vendor_area'];
    $vendor_job = $row_vendor['vendor_add'];
    $vendor_image = $row_vendor['vendor_img'];
    $vendor_about = $row_vendor['vendor_about'];

}
?>

<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard / Edit Profile
            </li>

        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money fa-fw"></i> Edit Profile
                </h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label">User Name: </label>
                        <div class="col-md-6">
                            <input type="text" name="vendor_name" class="form-control" required
                                value="<?php echo $vendor_name; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">User Email: </label>
                        <div class="col-md-6">
                            <input type="text" name="vendor_email" class="form-control" required
                                value="<?php echo $vendor_email; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">User Password: </label>
                        <div class="col-md-6">
                            <input type="text" name="vendor_pass" class="form-control" required
                                value="<?php echo $vendor_pass; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">User area: </label>
                        <div class="col-md-6">
                            <input type="text" name="vendor_area" class="form-control" required
                                value="<?php echo $vendor_area; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">User Addresss: </label>
                        <div class="col-md-6">
                            <input type="text" name="vendor_add" class="form-control" required
                                value="<?php echo $vendor_add; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">User Contact: </label>
                        <div class="col-md-6">
                            <input type="text" name="vendor_contact" class="form-control" required
                                value="<?php echo $vendor_contact; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">User About: </label>
                        <div class="col-md-6">
                            <textarea name="vendor_about" class="form-control"
                                rows="3"> <?php echo $vendor_about; ?> </textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">User Image: </label>
                        <div class="col-md-6">
                            <input type="file" name="vendor_image" class="form-control" required>
                            <br>
                            <img src="vendor_images/<?Php echo $vendor_image; ?>" width="70" height="70">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <input type="submit" name="update" value="Update User" class="btn btn-primary form-control">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    if(isset($_POST['update'])){
    $vendor_email = $_POST['vendor_email'];
    $vendor_name = $_POST['vendor_name'];
    $vendor_pass = $_POST['vendor_pass'];
    $vendor_contact = $_POST['vendor_contact'];
    $vendor_area = $_POST['vendor_area'];
    $vendor_add = $_POST['vendor_add'];
    $vendor_about = $_POST['vendor_about'];
    $vendor_image = $_FILES['vendor_image']['name'];
    $temp_vendor_image = $_FILES['vendor_image']['tmp_name'];
    move_uploaded_file($temp_vendor_image,"vendor_images/$vendor_image");

    $update_vendor = "UPDATE vendor SET vendor_email='$vendor_email', vendor_name='$vendor_name', vendor_pass='$vendor_pass',
    vendor_img='$vendor_image',vendor_contact='$vendor_contact',vendor_area='$vendor_area',vendor_add='$vendor_add',vendor_about='$vendor_about' WHERE vendor_id='$vendor_id'";

    $run_vendor_update = mysqli_query($con,$update_vendor) or die(mysqli_error($con));
        if($run_vendor_update){
            echo "<script>alert('User Has Been Updated successfully and login again')</script>";
            session_destroy();
            echo "<script>window.open('login.php','_self')</script>";
        }
}

?>

<?php }  ?>
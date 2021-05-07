<?php

    $customer_email=$_SESSION['customer_email'];
    $get_customer ="SELECT * FROM customers WHERE customer_email='$customer_email'";
    $run_cust = mysqli_query($con, $get_customer) or die(mysqli_error($con));
    $row_cust = mysqli_fetch_array($run_cust);

    $customer_id = $row_cust['customer_id'];
    $customer_name = $row_cust['customer_name'];
    $customer_email_db = $row_cust['customer_email'];
    $customer_num = $row_cust['customer_num'];
    $customer_city = $row_cust['customer_city'];
    $customer_add = $row_cust['customer_add'];
    $customer_img = $row_cust['customer_img'];

?>

<div class="box">
    <form action="" method="POST" enctype="multipart/form-data">    
        <center>
            <h1>Edit Your Account</h1>
        </center>
    
        <div class="form-group">
            <label>Customer Name</label>
            <input type="text" name="c_name" class="form-control" value="<?php echo $customer_name;  ?>" required>
        </div>
        <div class="form-group">
            <label>Customer Email</label>
            <input type="text" name="c_email" class="form-control" value="<?php  echo  $customer_email_db; ?>" required>
        </div>
        <div class="form-group">
            <label>Contact Number</label>
            <input type="text" name="c_number" class="form-control" value="<?php  echo  $customer_num; ?>" required>
        </div>
        <div class="form-group">
            <label>City</label>
            <input type="text" name="c_city" class="form-control" value="<?php  echo $customer_city;  ?>" required>
        </div>
        <div class="form-group">
            <label>Customer Address</label>
            <input type="text" name="c_address" class="form-control" value="<?php echo  $customer_add;  ?>" required>
        </div>
        <div class="form-group">
            <label>Customer Image</label>
            <input type="file" name="c_image" class="form-control" required>
            <img src="customer_images/<?php  echo $customer_img; ?>" alt="customer_img" class="img_responsive"
                height="100" width="100">
        </div>
        <div class="text-center">
            <button class="btn btn-primary" name="update">
                Update Now
            </button>
        </div>

    </form>
</div>



<?php

if(isset($_POST['update'])){
    $update_id = $customer_id;
    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_cnumber = $_POST['c_number'];
    $c_city = $_POST['c_city'];
    $c_address = $_POST['c_address'];
    $c_image = $_FILES['c_image'] ['name'];
    $c_image_tmp = $_FILES['c_image'] ['tmp_name'];


    move_uploaded_file($c_image_tmp,"customer_images/$c_image");

    $update_customer = "UPDATE customers SET customer_name ='$c_name',
    customer_email ='$c_email', customer_num ='$c_cnumber', customer_city ='$c_city',
    customer_add ='$c_address', customer_img ='$c_image' WHERE customer_id = '$update_id'";

    $run_customer = mysqli_query($con, $update_customer) or die(mysqli_error($con));

    if($run_customer){
        echo"<script>alert('Your details have been updated.');</script>";
        echo"<script>window.open('../logout.php','_self')</script>";
    }


}



?>
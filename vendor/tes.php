<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
</head>
<body><?php
session_start();
/***************getting vendor id *********** */
            include("includes/db.php");
            $get_vendor= "SELECT vendor_id FROM vendor WHERE vendor_email ='waninaveed21@gmail.com'";
            $run_vendor = mysqli_query($con, $get_vendor) or die(mysqli_error($con));
            if($row_vendor=mysqli_fetch_array($run_vendor)){
                $vid = $row_vendor['vendor_id'];
                echo $vid;
            }

?>
</body>
</html>
<?php
if(!isset($_SESSION['admin_email'])){
echo "<script>window.open('login.php','_self')</script>";
}else {
?>
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard / View Profile
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fas fa-id-badge fa-fw"></i> View Profile
                </h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Vendor ID:</th>
                                <th>Vendor Name:</th>
                                <th>Vendor Email:</th>
                                <th>Vendor Image:</th>
                                <th>Vendor area:</th>
                                <th>Vendor address:</th>
                                <th>Delete Vendor:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $get_vendor = "SELECT * FROM vendor";
                                $run_vendor = mysqli_query($con,$get_vendor) or die(mysqli_error($con));
                                while($row_vendor = mysqli_fetch_array($run_vendor)){
                                    $vendor_id = $row_vendor['vendor_id'];
                                    $vendor_name = $row_vendor['vendor_name'];
                                    $vendor_email = $row_vendor['vendor_email'];
                                    $vendor_img = $row_vendor['vendor_img'];
                                    $vendor_area = $row_vendor['vendor_area'];
                                    $vendor_add = $row_vendor['vendor_add'];
                            ?>

                            <tr>
                            <td><?php echo $vendor_id; ?></td>
                                <td><?php echo $vendor_name; ?></td>
                                <td><?php echo $vendor_email; ?></td>
                                <td><img src="vendor_images/<?php echo $vendor_img; ?>" width="60" height="60"></td>
                                <td><?php echo $vendor_area; ?></td>
                                <td><?php echo $vendor_add; ?></td>
                                <td>
                                    <a href="index.php?vendor_delete=<?php echo $vendor_id; ?>">
                                        <i class="fa fa-trash-o"></i> Delete
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }  ?>
<?php
if(!isset($_SESSION['admin_email'])){
echo "<script>window.open('login.php','_self')</script>";
}else {
?>
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard / View Users
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money fa-fw"></i> View Users
                </h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>User Name:</th>
                                <th>User Email:</th>
                                <th>User Image:</th>
                                <th>User City:</th>
                                <th>User Job:</th>
                                <th>Delete User:</th>
                                <th>Edit User:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $get_admin = "SELECT * FROM admins";
                                $run_admin = mysqli_query($con,$get_admin) or die(mysqli_error($con));
                                while($row_admin = mysqli_fetch_array($run_admin)){
                                    $admin_id = $row_admin['admin_id'];
                                    $admin_name = $row_admin['admin_name'];
                                    $admin_email = $row_admin['admin_email'];
                                    $admin_image = $row_admin['admin_image'];
                                    $admin_city = $row_admin['admin_city'];
                                    $admin_job = $row_admin['admin_job'];
                            ?>

                            <tr>
                                <td><?php echo $admin_name; ?></td>
                                <td><?php echo $admin_email; ?></td>
                                <td><img src="admin_images/<?php echo $admin_image; ?>" width="60" height="60"></td>
                                <td><?php echo $admin_city; ?></td>
                                <td><?php echo $admin_job; ?></td>
                                <td>
                                    <a href="index.php?user_delete=<?php echo $admin_id; ?>">
                                        <i class="fa fa-trash-o"></i> Delete
                                    </a>
                                </td>
                                <td>
                                <a href="index.php?edit_user=<?php echo $admin_id; ?>">
                                        <i class="fa fa-pencil"></i> Edit 
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
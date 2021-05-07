<div class="panel panel-default sidebar-menu">
    <div class="panel-heading">
        <?php
            $session_customer= $_SESSION['customer_email'];
            $get_cust = "SELECT * FROM customers WHERE  customer_email='$session_customer'";
            $run_cust = mysqli_query($con, $get_cust) or die(mysqli_error($con));
            $row_customer = mysqli_fetch_array($run_cust);
            
            $customer_img = $row_customer['customer_img'];
            $customer_name = $row_customer['customer_name'];
            if(!isset($_SESSION['customer_email'])){
               #echo" <script>alert('')</script>";

            }else{
                echo"
                <center>
                    <img src='customer_images/$customer_img' class='img-responsive'>
                <br>
                    <h3 align='center' class='panel-title'>Name: $customer_name</h3>
                </center>
                ";
            }
        ?>
    </div>

    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
            <li class="<?php if(isset($_GET['my_orders'])){echo "active";}?> ">
                <a href="my_account.php?my_orders">
                    <i class="fa fa-list"></i>My Orders
                </a>
            </li>
          <!--  <li class="<?php if(isset($_GET['pay_offline'])) {echo "active";} ?>">
                <a href="my_account.php?pay_offline">
                    <i class="fa fa-bolt"></i>Pay Offline
                </a>
            </li>-->
     <!--       <li class="<?php if(isset($_GET['my_address'])) {echo "active";} ?>">
                <a href="my_account.php?my_address">
                    <i class="fa fa-address-card"></i>My Address
                </a>
            </li>-->
            <li class="<?php if(isset($_GET['edit_act'])) {echo "active";} ?>">
                <a href="my_account.php?edit_act">
                    <i class="fa fa-pencil"></i>Edit Account
                </a>
            </li>
            <li class="<?php if(isset($_GET['change_password'])) {echo "active";} ?>">
                <a href="my_account.php?change_password">
                    <i class="fa fa-unlock-alt"></i>Change Password
                </a>
            </li>
          <!--  <li class="<?php if(isset($_GET['my_wishlist'])) {echo "active";} ?>">
                <a href="my_account.php?my_wishlist">
                    <i class="fa fa-heart"></i>My Wishlist
                </a>
            </li>-->
            <li class="<?php if(isset($_GET['delete_act'])) {echo "active";} ?>">
                <a href="my_account.php?delete_act">
                    <i class="fa fa-trash"></i>Delete Account
                </a>
            </li>
            <li class="<?php if(isset($_GET['logout'])) {echo "active";} ?>">
                <a href="my_account.php?logout">
                    <i class="fa fa-sign-out"></i>Log Out
                </a>
            </li>

        </ul>

    </div>

</div>
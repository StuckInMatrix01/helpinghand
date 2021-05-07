<?php
    include("includes/db.php");
    if(!isset($_SESSION['vendor_email'])){
        echo"<script>window.open('login.php','_self')</script>";
    }else
?>
<nav class="navbar navbar-inverse navbar-fixed-top" style="background: #001a33">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collpase" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>

        </button>
        <a href="index.php?dashboard" class="navbar-brand">Vendor Panel</a>
    </div>
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user"></i><?php echo $vendor_name; ?>
            </a>
    
            <ul class="dropdown-menu">
                <li>
                    <a href="index.php?view_user">
                        <i class="fa fa-user-circle-o"></i>Profile
                    </a>
                </li>
                <li>
                    <a href="index.php?view_product">
                        <i class="fa fa-fw-user"></i>Products
                        <span class="badge">
                                <?php echo $count_pro; ?>
                        </span>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="logout.php">
                        <i class="fa fa-fw fa-power-off"></i>Logout
                    </a>
                </li>

            </ul>
        </li>
    </ul>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav sidebar-nav">
            <li>
                <a href="index.php?dashboard">
                    <i class="fa fa-fw fa-dashboard"></i>Dashboard
                </a>
            </li>
            <li>
                <a href="#" data-toggle="collapse" data-target="#products">
                    <i class="fa fa-fw fa-table"></i>Products</a>
                <i class="fa fa-fw fa-caret-down"></i>

                <ul id="products" class="collapse">
                    <li>
                        <a href="index.php?insert_product">Insert Product</a>
                    </li>
                    <li>
                        <a href="index.php?view_product">View Product</a>
                    </li>
                </ul>
            </li>
           
            <li>
                <a href="index.php?view_order">
                    <i class="fa fa-fw fa-list"></i>View Order
                </a>
            </li>
            <li>
                <a href="index.php?view_payments">
                    <i class="fa fa-fw fa-pencil"></i>View Payments
                </a>
            </li>
            <li>
                <a href="index.php?view_user"  data-target="#users">
                    <i class="fa fa-fw fa-table"></i>View Profile</a>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<?php  #} ?>
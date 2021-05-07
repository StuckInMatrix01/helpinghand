<?php
    session_start();
    include("includes/db.php");
    include_once("functions/functions.php");
    #var_dump($_SESSION);
?>

<?php
    if(isset($_GET['c_id'])){
        $customer_id = $_GET['c_id'];
    }
    $ip_add = getUserIP();
    $status = "pending";
    $invoice_no = mt_rand();
    $select_cart = "SELECT * FROM cart WHERE ip_add='$ip_add' ";
    $run_cart = mysqli_query($con, $select_cart) or die(mysqli_error($con));
    while ($row_cart = mysqli_fetch_array($run_cart)) {
        $pro_id =$row_cart['p_id'];
        $size = $row_cart['size'];
        $qty = $row_cart['qty'];
        $get_product = "SELECT * FROM products WHERE product_id ='$pro_id'";
        $run_pro = mysqli_query($con, $get_product) or die(mysqli_error($con));
        while ($row_pro = mysqli_fetch_array($run_pro)) {
            $sub_total = $row_pro['product_price'] * $qty;
            $vendor_id = $row_pro['vendor_id'];

            $insert_customer_order ="INSERT INTO customer_order 
            (customer_id, vendor_id, product_id, due_amount, invoice_no, qty, size, order_date, order_status) VALUES 
            ('$customer_id','$vendor_id','$pro_id','$sub_total','$invoice_no','$qty','$size',NOW(),'$status');
            ";

            $run_cust_order = mysqli_query($con, $insert_customer_order) or die(mysqli_error($con));

            // $insert_pending_order = "INSERT INTO pending_orders(customer_id, invoice_no, product_id, qty, size, order_status) 
            // VALUES ('$customer_id','$invoice_no','$pro_id','$qty','$size','$status')";

            // $run_pending_order = mysqli_query($con, $insert_pending_order) or die(mysqli_error($con));

           

            $update_product = "UPDATE products SET stock = stock-'$qty' WHERE product_id='$pro_id'";
            $run_update_product_db = mysqli_query($con,$update_product) or die(mysqli_error($con));

            $delete_cart = "DELETE FROM cart where ip_add = '$ip_add'";
            $run_delete_cart = mysqli_query($con,$delete_cart) or die(mysqli_error($con));

           

            echo"<script>alert('Your Order has been submitted, Thank you.')</script>";
            echo"<script>window.open('customer/my_account.php?my_orders','_self')</script>";
        }
    }


?>
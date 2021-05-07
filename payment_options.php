<?php

    include("includes/db.php");
    include_once("functions/functions.php");
    #var_dump($_SESSION);
?> 
 <div class="box">
    <?php 
        $session_email =$_SESSION['customer_email'];
        $select_customer = "SELECT * FROM customers WHERE customer_email='$session_email'";

        $run_cust = mysqli_query($con, $select_customer) or die(mysqli_error($con));
        $row_customer= mysqli_fetch_array($run_cust);
        $customer_id = $row_customer['customer_id'];
    
    ?>




     <h1 class="text-center"> Payment options</h1>
     <p class="lead text-center">
         <a href="order.php?c_id=<?php echo $customer_id ?>">COD</a>
     </p>
    <center>
        <p class="text-center text-secondary">OR</p>
    </center>
     <center>
       <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="business" value="sb-ecdcq2391649@business.example.com">
        <input type="hidden" name="cmd" value="_cart">
        <input type="hidden" name="upload" value="1">
        <input type="hidden" name="currency_code" value="INR">
        <input type="hidden" name="return" value="http://localhost/helpinghand/paypal_order.php?c_id=<?php $customer_id ?>">
        <input type="hidden" name="cancel_return" value="http://localhost/helpinghand/index.php">

        <?php 
            $i = 0;

            $ip_add = getUserIP();
            $get_cart="SELECT * FROM cart WHERE ip_add ='$ip_add'"; 
            $run_cart=mysqli_query($con, $get_cart) or die(mysqli_error($con));
                while($row_cart = mysqli_fetch_array($run_cart)){
                    $pro_id = $row_cart['p_id'];
                    $pro_qty = $row_cart['qty'];
                    $pro_price = $row_cart['p_price'];

            $get_products="SELECT * FROM products WHERE  product_id='$pro_id'";

            $run_products =mysqli_query($con, $get_products);

            $row_products = mysqli_fetch_array($run_products) or die(mysqli_error($con));

            $product_title = $row_products['product_title'];
            $i++;
        ?>

        <input type="hidden" name="item_name_<?php echo $i ?>" value="<?php echo $product_title; ?>">

        <input type="hidden" name="item_number_<?php echo $i ?>" value="<?php echo $i; ?>">

        <input type="hidden" name="amount_<?php echo $i ?>" value="<?php echo $pro_price; ?>">

        <input type="hidden" name="quantity_<?php echo $i ?>" value="<?php echo $pro_qty; ?>">

        <?php   }?>
        
        <button  name="submit" width="500" height="270" class="fa fa-cc-paypal fa-5x">
         </button>
       </form>
     </center>
 </div>
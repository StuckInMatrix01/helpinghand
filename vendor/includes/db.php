<?php
    $con = mysqli_connect("localhost","root","","hh_db");
    if ($con->connect_error) {
        die("Connection failed: " . mysqli_connect_error());
     } 
?>
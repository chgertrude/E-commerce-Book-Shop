<?php 
    include_once("connection.php");

    $pid = $_GET['pid']; //get value from url,  variable from view.php

    $query = $pdo->prepare("DELETE FROM product_info WHERE productID = '$pid'");
    $query->execute();

    echo "<script>window.open('view.php','_self')</script>";

?>
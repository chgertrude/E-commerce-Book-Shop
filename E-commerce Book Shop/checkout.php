<?php
    include_once("connection.php");
    include_once "session.php";

    if (isset($_POST['check'])) {

        if(isset($_SESSION["shopping_cart"])){
            $total_price = 0;
            $sf = 50;
            $total_sf = 0;

    
            foreach ($_SESSION["shopping_cart"] as $product) {
                $pname = $product['productName'];
                $price = $product['productPrice'];
                $qty = $product["quantity"];
                

            
                $query = $pdo->prepare("INSERT INTO orders (userID, itemName, itemPrice, itemQuantity)  VALUES ('$aid','$pname', '$price', '$qty')");
                $query->execute();

                $total_price += ($product["productPrice"]*$product["quantity"]);

                $query = $pdo->prepare("SELECT * FROM product_info WHERE productName = '$pname' ");
				$query->execute();
				while($rows = $query->fetch())
				{
					$product_name = $rows['productName'];
					$product_quantity = $rows['productQuantity'];
				}
				
				$update_quantity = $product_quantity - $qty;
				
	
				$query = $pdo->prepare("UPDATE product_info SET productQuantity = '$update_quantity' WHERE productName = '$product_name'");
                $query->execute();
            } 

            $total_sf = $total_price+$sf;

            $query = $pdo->prepare("INSERT INTO total (userID, userName, userTotal)  VALUES ('$aid','$name', '$total_sf')");
            $query->execute();

    
        } 
    }

    unset($_SESSION["shopping_cart"]); //delete items in cart

    echo "<script>alert('Successfully Checkout!')</script>";
    echo "<script>window.open('index-customer.php','_self')</script>";


?>
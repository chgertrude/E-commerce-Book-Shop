<?php
    include_once("connection.php");

    if(isset($_POST['insert'])){ //inside the parenthesis is the name of submit button
        $category = $_POST['category']; //inside is the name of the input
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $description = $_POST['description'];
        $code = $_POST['cd'];

        //to process image upload
        $imgFile = $_FILES['image']['name']; //whole file name
        $temp_name = $_FILES['image']['tmp_name']; //temporary name of image
        $imgSize = $_FILES['image']['size'];

        $upload_dir = "photos/"; //directory

        $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); //get extension only of whole file name, strlower convert to all lowercase
        $valid_ext = array('jpeg', 'jpg', 'gif', 'png'); //valid extension

        //rename file name to avoid overwritten file
        $newname = rand(1000,10000000).".".$imgExt;

        //image extension validation and file size
        if(in_array($imgExt, $valid_ext )){ 
            if($imgSize < 5242880 ){ //5MB
                move_uploaded_file($temp_name, $upload_dir.$newname); //if true upload
            }else{
                echo "<script>alert('Sorry, your file is too large! Upload lower than 5MB.')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            }
        }else{
            echo "<script>alert('Sorry, only JPEG, JPG, GIF and PNG is allowed!')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }

        //to insert in DB table
        $query = $pdo->prepare("INSERT INTO product_info (productCategory, productName, productPrice, productQuantity, productDescription, productImage, code ) 
            VALUES (:ctg, :_name, :price, :qty, :dscp,:img, :cd )");
        $query->bindParam(':ctg',$category);
        $query->bindParam(':_name',$name);
        $query->bindParam(':price',$price);
        $query->bindParam(':qty',$quantity);
        $query->bindParam(':dscp',$description);
        $query->bindParam(':img',$newname);
        $query->bindParam(':cd',$code);
        $query->execute();

        echo "<script>alert('Successfully Inserted!')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }else{
        die();
    }
?>
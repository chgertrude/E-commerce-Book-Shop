<?php
    include_once("connection.php");

    if(isset($_POST['signup'])){ //inside the parenthesis is the name of submit button
        $username = $_POST['uname'];
        $password = $_POST['pword'];
        $password1 = $_POST['pword1'];
        $fullname = $_POST['fname']; //inside is the name of the input
        $email = $_POST['email'];
        $address = $_POST['address'];

        if ($password === $password1) {
           //to insert in DB table
            $password = sha1($_POST['pword']);
            $query = $pdo->prepare("INSERT INTO accounts (accUsername, accPassword, fullName, accEmail, accAddress, accStatus ) 
            VALUES (:uname, :pword, :fname, :email, :homeAdd, 'customer')");
            $query->bindParam(':uname',$username);
            $query->bindParam(':pword',$password);
            $query->bindParam(':fname',$fullname);
            $query->bindParam(':email',$email);
            $query->bindParam(':homeAdd',$address);
            $query->execute();

            echo "<script>alert('Successfully Inserted!')</script>";
            echo "<script>window.open('login.php','_self')</script>";
         }
         else {
            echo "<script>alert('Passwords do not match, please try again!')</script>";
            echo "<script>window.open('signup.php','_self')</script>";
         }
    }else{
        die();
    }
?>
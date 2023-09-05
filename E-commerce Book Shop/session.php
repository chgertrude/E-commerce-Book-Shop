<?php 
    include_once("connection.php");
    session_start();
    
    if(isset($_SESSION['accountID'])){
        $aid = $_SESSION['accountID'];
        //echo $aid; //for checking only
        $query = $pdo->prepare("SELECT accUsername FROM accounts WHERE accountID = :id");

        $query->bindParam(':id',$aid);
        $query->execute();
            while($data = $query->fetch()){
                $name = $data['accUsername'];
            }
    }else{
        header("location:login.php");
    }
?>
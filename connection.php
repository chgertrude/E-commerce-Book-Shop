<?php
   $host ="localhost";
   $username ="root";
   $password =""; //no password default
   $dbname ="ecommerce_db"; 

   try{
      $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //for error handling   
   }catch(PDOException $e){
      echo "Connection Failed: " .$e->getMessage();
   }

?>
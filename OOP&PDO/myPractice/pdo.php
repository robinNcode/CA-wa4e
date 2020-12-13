<?php
    $servername = "localhost";
    $user = "root";
    $password = "";
    $db = "pdo_practice";

    try{
        $connection = new PDO("mysql:host=$servername;dbname=$db",$user,$password);
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
    }catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    

?> 
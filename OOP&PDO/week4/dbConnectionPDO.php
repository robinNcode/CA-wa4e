<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "robin_misc";

    try{
        $connection  = new PDO("mysql:host=$servername;dbname=$dbName",$username,$password);
        $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $msg){
        echo "Connection Failed : " . $msg->getMessage();
    }
    
?>
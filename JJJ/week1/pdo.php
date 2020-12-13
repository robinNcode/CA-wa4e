<?php

    $servername = "localhost";
    $username = "root";
    $password = '';
    $dbName = "robin_misc";

    try{
        $pdo  = new PDO("mysql:host=$servername;dbname=$dbName",$username,$password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $msg){
        echo "Connection Failed : " . $msg->getMessage();
    }
    /// Email Pattern
    $emailPattern = "/\b[\w\.-]+@/";

?>

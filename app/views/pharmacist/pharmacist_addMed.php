<?php
    $dbHost="localhost";
    $dbUser="root";
    $dbPassword="";
    $dbName="medication";

    try{
        $dsn = "mysql:host=".$dbHost.";dbname=".$dbName;
        $pdo = new PDO($dsn, $dbUser, $dbPassword);
        echo "connection succesful";

    }catch(PDOException $e){
        echo "db connection failed".$e->getMessage();
    }
?>
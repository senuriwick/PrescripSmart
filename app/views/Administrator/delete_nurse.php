<?php
if (isset($_GET["id"])) { 
    $nurse_ID = $_GET["id"]; 
 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "prescripsmart";
 
    $connection = new mysqli($servername, $username, $password, $database);
 
    $sql = "DELETE FROM nurse WHERE nurse_id = $_ID";
    $connection->query($sql);
}
 
header("location: AdminSearchNurse.php");
exit;
?>

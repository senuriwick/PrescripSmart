<?php
if (isset($_GET["id"])) { 
    $labTech_ID = $_GET["id"]; 
 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "prescripsmart";
 
    $connection = new mysqli($servername, $username, $password, $database);
 
    $sql = "DELETE FROM lab_technician WHERE lab_tec_id = $labTech_ID";
    $connection->query($sql);
}
 
header("location: lab_technicians.php");
exit;
?>

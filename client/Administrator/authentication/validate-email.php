<?php

$mysqli = require __DIR__ . "/database.php";

$sql = sprintf("SELECT * FROM administrator
                WHERE email = '%s'",
                $mysqli->real_escape_string($_GET["email_address"]));
                
$result = $mysqli->query($sql);

$is_available = $result->num_rows === 0;

header("Content-Type: application/json");

echo json_encode(["available" => $is_available]);
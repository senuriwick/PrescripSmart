<?php

define("HOSTNAME" ,"localhost");
define("USERNAME","root");
define("PASSWORD", "");
define("DATABASE" , "prescripsmart");


$connection = mysqli_connect()(HOSTNAME,
USERNAME,
PASSWORD,
DATABASE);
                     
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

else{
    echo"yess";

}
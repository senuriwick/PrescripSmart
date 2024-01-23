<?php
// (A) LOAD QR CODE LIBRARY
require "vendor\autoload.php";
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

// (B) CREATE QR CODE
$url = $_GET['prescriptionID'];
$qr = new QrCode("http://localhost/prescripsmart/patient/public_prescriptionView?prescription=$url");
$writer = new PngWriter();
$result = $writer->write($qr);

// (C) OUTPUT QR CODE
// (C1) SAVE TO FILE
$result->saveToFile(__DIR__ . "/qr.png");

// (C2) DIRECT OUTPUT
header("Content-Type: " . $result->getMimeType());
echo $result->getString();

// (C3) GENERATE DATA URI
// echo "<img src='{$result->getDataUri()}'>";
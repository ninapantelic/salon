<?php
$host =   'localhost';
$uname   =   'root';
$pass   =   '';
$database     =   "salon";
$conn = new mysqli($host, $uname, $pass, "$database");
if ($conn->connect_errno) {
    die("<script>alert('Error while accessing database " . $conn->connect_error . "')</script>");
}

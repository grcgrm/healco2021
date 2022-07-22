<?php  

$sname = "localhost";
$uname = "root";
$password = "";

$db_name = "db_grumo";

$conn = new mysqli($sname, $uname, $password, $db_name);

if (!$conn) {
	echo "<script> alert('Connection Failed.')</script>";
}
<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "inv";

try
{
	$conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->exec("set names utf8");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e)
{
	echo "Connected failed: " . $e->getMessage();
}


?>
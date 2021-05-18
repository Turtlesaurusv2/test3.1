<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "rfs2";

try
{
	$connect = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $connect->exec("set names utf8");
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e)
{
	echo "connectected failed: " . $e->getMessage();
}


?>
<?php

$input = json_decode($_POST["query"], true);
$query = $input["query"];
$page = $input["page"];
$company_id = $input["company_id"];

$res = [];

$q = explode( " ", $query);
//เชื่อมฐานข้อมูลจากหน้า db_conn.php
include('rfs_conn.php'); 
/*
// ค้าหา
$dText = "";
foreach($q as $key => $value)
{
    if( $key == 0 )
        $dText .= "WHERE ";

    if($key > 0 )
        $dText .= " AND ";
//เอาcolumnมาต่อกัน
        $dText .= 
        "
            CONCAT(product_id, ' ', product_name, ' ', company_id, ' ') LIKE '%". $value ."%'
        ";
}
*/
$COUNT= $connect->prepare("

SELECT  COUNT(*)as ttt FROM inventory where company_id = $company_id

");

$COUNT->execute();

$rec = $COUNT->fetch(PDO::FETCH_ASSOC);

$ttt = $rec['ttt'];

$rpp = 10; // limit
$startPage = ( $page - 1 ) * $rpp; 

$ttp = ceil($ttt/$rpp);


 //ถ้าไม่ได้ input  จะแสดงข้อมูล ใน datadase
 $results = $connect->prepare("SELECT company_id, product_id, sum(buy - sell) as system 
 FROM inventory 
 WHERE company_id = $company_id 
 group by product_id 
 LIMIT {$startPage},{$rpp}");


//แสดงข้อมูล column database
$results->execute();

$res["result"] = $results->fetchAll(PDO::FETCH_ASSOC);
$res["page"] = $ttp;
$res["currentPage"] = $page;

exit( json_encode( $res ) );

?>
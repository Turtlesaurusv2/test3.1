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

SELECT  COUNT(*)as ttt FROM inventory where product_id = '$query'

");

$COUNT->execute();

$rec = $COUNT->fetch(PDO::FETCH_ASSOC);

$ttt = $rec['ttt'];

$rpp = 10; // limit
$startPage = ( $page - 1 ) * $rpp; 

$ttp = ceil($ttt/$rpp);


//รับค่า Query จากหน้า test2.php 
if(!empty($query))
{
// ค้นหาข้อมูลใน database ที่ตรงกับ input 
	
$results = $connect->prepare("SELECT company_id, product_id, sum(sell) as sell, sum(buy) as buy, sum(buy - sell) as system 
FROM inventory WHERE product_id LIKE '%{$query}%'
LIMIT {$startPage},{$rpp};
");

}
else
{
 //ถ้าไม่ได้ input  จะแสดงข้อมูล ใน datadase
 $results = $connect->prepare("SELECT company_id, product_id, sum(sell) as sell, sum(buy) as buy, sum(buy - sell) as system 
 FROM inventory 
 WHERE company_id = $company_id 
 group by product_id 
 LIMIT {$startPage},{$rpp}");

}
//แสดงข้อมูล column database
$results->execute();

$res["result"] = $results->fetchAll(PDO::FETCH_ASSOC);
$res["page"] = $ttp;
$res["currentPage"] = $page;

exit( json_encode( $res ) );

?>
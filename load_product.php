<?php
include('db_conn.php'); 

$load = json_decode($_POST["query"], true);
$query = $load["query"];

$sub_id = $load['sub_id'];

$res = [];

$result2 = $conn->prepare("SELECT * FROM product  WHERE  sub_id = $sub_id LIMIT 0,10 ");



$result2->execute();
$row = $result2->fetch(PDO::FETCH_ASSOC);
$inv = $row['sub_id']?? '';

if($id = $inv) {  

    $res = $conn->prepare("SELECT * FROM product   WHERE  sub_id = $sub_id  ");
    $res->execute();
    $data['res'] =  $res->fetchAll(PDO::FETCH_ASSOC);


    //แสดงข้อมูลจนกว่าข้อมูลจะหมด
    exit( json_encode( $data ) );

}else {

    $data['res'] = "";
    exit( json_encode( $data ) );
}

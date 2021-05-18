<?php

include('db_conn.php'); 

$res = [];

//รับค่า Query จากหน้า index.php 
if(isset($_POST["id"])){

    $id = $_POST["id"];

    $result2 = $conn->prepare("SELECT * FROM inv_sub  WHERE  inv_id = $id LIMIT 0,10 ");

}

$result2->execute();

$row = $result2->fetch(PDO::FETCH_ASSOC);
$inv = $row['inv_id']?? '';


//ถ้า id มีค่าเท่ากับ inv จะแสดงข้อมูล และถ้าไม่ตรง จะส่งข้อความกลัวว่า ไม่มีข้อมูล
if($id = $inv) {  

    $res = $conn->prepare("SELECT * FROM inv_sub   WHERE  inv_id = $id  ");
    $res->execute();
    $data['res'] =  $res->fetchAll(PDO::FETCH_ASSOC);


    //แสดงข้อมูลจนกว่าข้อมูลจะหมด
    exit( json_encode( $data ) );



}else {


    $data['res'] = "";
    exit( json_encode( $data ) );
}
?>


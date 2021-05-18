<?php
include('db_conn.php'); 

$load = json_decode($_POST["query"], true);
$query = $load["query"];
$sub_id = $load["sub_id"];
$company_id = $load["company_id"];

//group by ข้อมูลจากตาราง product
$results = $conn->prepare("SELECT  pd_c, SUM(quantity) as quantity,sub_id,company_id FROM product WHERE sub_id = $sub_id AND company_id = $company_id GROUP BY pd_c ");
$results->execute();

$res["result"] = $results->fetchAll(PDO::FETCH_ASSOC);


if($results){

    //เพิ่มข้อมูลไปที่ prob เพื่อเอาไว้เก็บข้อมูลชั่วคราว
    $stmt = $conn->prepare("INSERT INTO prod (pd_c ,quantity,sub_id,company_id)  SELECT  pd_c, SUM(quantity) as quantity,sub_id,company_id FROM product WHERE sub_id = $sub_id AND company_id = $company_id GROUP BY pd_c "); 
    $stmt->execute();

if($stmt){
    //ลบข้อมูลจากproductหลังจาก group by
    $resu = $conn->prepare("DELETE FROM product WHERE sub_id = $sub_id ");
    $resu->execute();

    if($resu){
        
        //บันทึกขอมูลไปที่ product โดนดึงข้อมูลจาก prob ที่เราเก็บข้อมูลไว้ชั่วคราว
        $stmt2 = $conn->prepare("INSERT INTO product (pd_c ,quantity,sub_id,company_id)  SELECT  pd_c, quantity,sub_id,company_id  FROM prod "); 
        $stmt2->execute();

        if($stmt2){
            //ลบข้อมูลทั้งหมดจากprob เพื่อเตรียมไว้ใช้งานครั้งต่อไป
            $resu = $conn->prepare("DELETE FROM prod  ");
            $resu->execute();
        }


    }

}
};













exit( json_encode( $res ) );



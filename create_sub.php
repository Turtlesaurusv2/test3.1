<?php 
include('db_conn.php');

$data = json_decode( $_POST["json"], true );


$sub_name = $data['sub_name'];
$inv_id = $data['inv_id'];
$company_id = $data['company_id'];

$response = [];


        //บันทึกข้อมูล
        $stmt = $conn->prepare("INSERT INTO inv_sub SET sub_name = :sub_name,company_id = :company_id, inv_id = :inv_id"); 
        $stmt->execute([":sub_name" => $sub_name,":company_id" => $company_id, ":inv_id" => $inv_id]);

        $response["message"] = "บันทึกข้อมูลเรียบร้อยแล้ว";
        $response["success"] = 1;



exit(json_encode( $response ));
?>
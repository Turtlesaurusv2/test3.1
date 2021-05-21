<?php 
include('db_conn.php');

$data = json_decode( $_POST["json"], true );

$name = $data['name'];
$company_id = $data['company_id'];


$response = [];


        //บันทึกข้อมูล
        $stmt = $conn->prepare("INSERT INTO inv_main SET name = :name, company_id = :company_id"); 
        $stmt->execute([":name" => $name,":company_id" => $company_id]);

        $response["message"] = "บันทึกข้อมูลเรียบร้อยแล้ว";
        $response["success"] = 1;



exit(json_encode( $response ));
?>
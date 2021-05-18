<?php 
include('db_conn.php');
include('rfs_conn.php');

$data = json_decode( $_POST["json"], true );

$pd_c = $data['pd_c'];
$quantity = $data['quantity'];
$sub_id = $data['sub_id'];
$company_id = $data['company_id'];


    $response = [];
    

    $result2 = $connect->prepare("SELECT * FROM inventory_summary  WHERE  product_id = '$pd_c' AND company_id = $company_id LIMIT 0,10 ");
   
   
    $result2->execute();

    $row = $result2->fetch(PDO::FETCH_ASSOC);
    $inv = $row['product_id']?? '';

    if($pd_c == $inv ){

        $stmt = $conn->prepare("INSERT INTO product SET pd_c = :pd_c, quantity = :quantity, sub_id = :sub_id,company_id = :company_id"); 
        $stmt->execute(["pd_c"=> $pd_c, ":quantity" => $quantity, ":sub_id" => $sub_id , "company_id" => $company_id]);
        $response["message"] = "บันทึกข้อมูลเรียบร้อยแล้ว";
        $response["success"] = 1;



    }else{

        $response["message"] = "product_id นี้ไม่มีอยู่";
        $response["success"] = 0;


    }
     exit(json_encode( $response ));



 //   RD1823 Signature Tea Mocktails
/*
//ห้ามมีตัวเลข
if( !preg_match("/^[a-zA-Zก-๏เ ]+$/", $pd_name) ) {
    $response["message"] = "name ห้ามมีตัวเลข";
    $response["success"] = 0;
    exit(json_encode( $response ));
}else{
        //บันทึกข้อมูล
        $stmt = $conn->prepare("INSERT INTO product SET pd_name = :pd_name, quantity = :quantity, sub_id = :sub_id"); 
        $stmt->execute([":pd_name" => $pd_name, ":quantity" => $quantity, ":sub_id" => $sub_id]);

        $response["message"] = "บันทึกข้อมูลเรียบร้อยแล้ว";
        $response["success"] = 1;
}


exit(json_encode( $response ));*/
?>
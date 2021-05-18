<?php
include('db_conn.php');
include('rfs_conn.php');


$load = json_decode($_POST["query"], true);
$query = $load["query"];

$company_id = $load["company_id"];


$results = $conn->prepare("SELECT product.pd_id, product.pd_c ,product.quantity , product.sub_id ,product.company_id,sum(rfs2.inventory.buy)as buy, sum(rfs2.inventory.sell) as sell, sum(rfs2.inventory.buy - rfs2.inventory.sell) as system from product  
RIGHT JOIN rfs2.inventory on product.pd_c = rfs2.inventory.product_id 
WHERE product.company_id = $company_id
GROUP BY pd_c ");

$results->execute();



$res["result"] = $results->fetchAll(PDO::FETCH_ASSOC);

exit( json_encode( $res ) );



?>
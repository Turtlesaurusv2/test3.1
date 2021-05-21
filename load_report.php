<?php
include('db_conn.php');
include('rfs_conn.php');


$load = json_decode($_POST["query"], true);
$query = $load["query"];

$company_id = $load["company_id"];


$results = $conn->prepare("SELECT  
product.pd_id, product.company_id,sum(product.quantity) as quantity,inv_sub.inv_id,product.pd_c,sum(rfs2.inventory.sell) as sell,sum(rfs2.inventory.buy) as buy,
sum(rfs2.inventory.buy - rfs2.inventory.sell) as system
FROM product 
INNER JOIN inv_sub on product.sub_id = inv_sub.sub_id
INNER JOIN rfs2.inventory on product.pd_c = inventory.product_id AND rfs2.inventory.company_id = $company_id
WHERE product.company_id = $company_id 
GROUP BY  inv_sub.inv_id, product.pd_c");
$results->execute();

$res["result"] = $results->fetchAll(PDO::FETCH_ASSOC);



exit( json_encode( $res ) );
/*
(SELECT  sum(rfs2.inventory.buy - rfs2.inventory.sell) as system 
FROM product
INNER JOIN inv_sub on product.sub_id = inv_sub.sub_id
INNER JOIN rfs2.inventory on product.pd_c = inventory.product_id AND rfs2.inventory.company_id = $company_id
WHERE product.company_id = $company_id ) as system,

*/
?>
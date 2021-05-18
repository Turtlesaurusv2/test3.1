<?php
include('db_conn.php');

$data = json_decode( $_POST["query"], true );

$company_id = $data["company_id"];


$results = $conn->prepare("SELECT * FROM inv_main WHERE company_id = $company_id LIMIT 0,50");
$results->execute();

$res["result"] = $results->fetchAll(PDO::FETCH_ASSOC);

exit( json_encode( $res ) );



?>
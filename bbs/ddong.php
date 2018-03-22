<?php
include '../common.php';
header("Content-Type:application/json");

$json = file_get_contents('php://input');

$obj =  json_decode($json,true); 

$wr_rent_type = $obj['myData'][0]['wr_rent_deposit'] ;
$wr_rent_type2 = $obj['myData'][1]['wr_rent_deposit'] ;
$wr_rent_type3 = $obj['myData'][2]['wr_rent_deposit'] ;
$wr_rent_type4= $obj['myData'][3]['wr_rent_deposit'] ;
// print_r (json_encode($obj['myData'][0]));
// echo json_encode($obj['myData'][0]['wr_room_type']);

// $var = $myData[0]['wr_rent_type'];

sql_query("Insert into `g5_write_test10` set wr_rent_type = '1'");
print_r ($wr_rent_type);
print_r ($wr_rent_type2);
print_r ($wr_rent_type3);
print_r ($wr_rent_type4);
?>
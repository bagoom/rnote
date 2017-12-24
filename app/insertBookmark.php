<?php
// include 'DBconfig.php';
include '../common.php';
header("Content-Type: text/html; charset=UTF-8");

// $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

// mysqli_set_charset($con,"utf8");


// $memberID = 'test10';

// echo "<br>";
// print_r ($emparray);
// echo "</br>";

$sql="Insert into bookmark_test10 (bm_date, bm_match_id, bm_from) values ('".G5_TIME_YMDHIS."', 137, 1 )";

$result = sql_query($sql);


?>

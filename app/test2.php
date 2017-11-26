<?php
include 'DBconfig.php';
include '../common.php';
header("Content-Type: text/html; charset=UTF-8");

$con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

mysqli_set_charset($con,"utf8");


// $memberID = 'test7';

// echo "<br>";
// print_r ($emparray);
// echo "</br>";

$sql="select mb_id from `g5_member` where mb_id = 'e0rua' ";
$result = sql_query($sql);
print_r ($result);

for ($i=0; $row=sql_fetch_array($result); $i++) {
   $sql2 = "update `g5_write_$row[mb_id]` set wr_writer_id = '$row[mb_id]' where wr_writer_id =0 ";
   echo $sql2;
   echo '<br>';
   sql_query($sql2);
}



// 멤버테이블 wr_writer_id 에 자신의 아이디 입력
// $sql2 = "update `g5_write_$row[mb_id]` set wr_writer_id = '$row[mb_id]' where wr_writer_id =0";

// 멤버테이블 wr_writer_id필드 VARCHAR 자료형 길이 변환 쿼리
// $sql2 = "ALTER TABLE `g5_write_$row[mb_id]` CHANGE `wr_writer_id` `wr_writer_id` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL; ";



?>

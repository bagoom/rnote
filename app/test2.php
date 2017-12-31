<?php
include '../common.php';




// $memberID = 'test7';

// echo "<br>";
// print_r ($emparray);
// echo "</br>";

$sql="select mb_id from `g5_member` where mb_id != 'admin' ";
$result = sql_query($sql);
print_r ($result);

for ($i=0; $row=sql_fetch_array($result); $i++) {
   $sql2 = "CREATE TABLE `realnote`.`bookmark_$row[mb_id]_folder` ( `bmf_id` INT NOT NULL AUTO_INCREMENT , `bmf_name` VARCHAR(20) NOT NULL DEFAULT '새폴더1' , `bmf_top` INT NOT NULL DEFAULT '0' , `bmf_top_date` DATETIME NOT NULL , `bmf_date` DATETIME NOT NULL , `bmf_1` INT NULL DEFAULT NULL , `bmf_2` INT NULL DEFAULT NULL , `bmf_3` INT NULL DEFAULT NULL , `bmf_4` INT NULL DEFAULT NULL , `bmf_5` INT NULL DEFAULT NULL , PRIMARY KEY (`bmf_id`)) ENGINE = InnoDB";
   echo $sql2;
   echo '<br>';
   sql_query($sql2);
}




// 멤버테이블 wr_writer_id 에 자신의 아이디 입력
// $sql2 = "update `g5_write_$row[mb_id]` set wr_writer_id = '$row[mb_id]' where wr_writer_id =0";

// 멤버테이블 wr_writer_id필드 VARCHAR 자료형 길이 변환 쿼리
// $sql2 = "ALTER TABLE `g5_write_$row[mb_id]` CHANGE `wr_writer_id` `wr_writer_id` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL; ";



?>

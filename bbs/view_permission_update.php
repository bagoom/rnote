<?php
include_once('./_common.php');

$write_table = 'g5_write_'.$member['mb_id'];

// echo $wr_id;
// echo $wr_office_permission;



sql_query("update `$write_table` set wr_office_permission = '$wr_office_permission'  where wr_id = '$wr_id' ");




// alert("해당 매물이 즐겨찾기가 해제 되었습니다.");

?>
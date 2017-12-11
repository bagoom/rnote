<?php
include_once('./_common.php');



$sql = " insert into rnote_contact_test10
set  rc_name = '$rc_name',
     rc_hp = '$rc_hp',
     rc_content = '$rc_content',
     rc_date = '".G5_TIME_YMDHIS."' ";

sql_query($sql);

?>

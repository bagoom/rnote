<?php
include_once('./_common.php');

if ($w == ''){
    $sql = " insert into rnote_contact_$member[mb_id]
    set  rc_name = '$rc_name',
         rc_hp = '$rc_hp',
         rc_content = '$rc_content',
         rc_date = '".G5_TIME_YMDHIS."' ";
    sql_query($sql);
}

if ($w =='u'){
    $sql = " update  rnote_contact_$member[mb_id]
    set  rc_name = '$rc_name',
         rc_hp = '$rc_hp',
         rc_content = '$rc_content'
         where rc_id = '$rc_id'
         ";
    sql_query($sql);
}
if ($w =='d'){
    $sql = "delete from rnote_contact_$member[mb_id] where rc_id='$rc_id'";
    sql_query($sql);
}


print_r ($_POST);
?>

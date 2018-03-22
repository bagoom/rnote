<?php
include_once('./_common.php');
$sql = "update rnote_contact_$member[mb_id] set rc_bookmark = '$rc_bookmark' where rc_id = '$rc_id'";
sql_query($sql);
?>
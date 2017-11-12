<?php
include_once('./_common.php');



//// 그누보드  익명닉네임  추가사항
$query = "
	select count(*) as cnt from {$g5['g5_srd_pushmsg']}
	where mb_id = '{$member['mb_id']}' and (msg_check != 'd' and msg_check = 'n')
";
$result = sql_fetch ($query);
$msg_count = $result['cnt'];
//$msg_count = 0;

echo "<input type='hidden' id='msg_count' value='{$msg_count}' />";

$query = "
	select * from {$g5['g5_srd_pushmsg']}
	where mb_id = '{$member['mb_id']}' and (msg_check != 'd' and msg_check = 'n') order by msg_id desc limit 0,5
";
$result = sql_query($query);
?>
<p class="tri"></p>

<dd id="arm_title">새로운 알림 <span ><?php echo $msg_count?>개</span></dd>
<?
for ($i=0; $row=sql_fetch_array($result); $i++) {
?>

	<dd class="comment">
	<a href="javascript:msg_link('<? echo $row['msg_link']?>','<?php echo $row['msg_type']?>','<?php echo $row['msg_id']?>');" class="redirect_link">
	<?php echo $row['msg_subject']?>
	<span class="arm_time"><?php echo srd_date_return($row['msg_wdate'])?></span></a>
	<a href="javascript:msg_del('<?php echo $row['msg_id']?>')" class="arm_del"><i class="fa fa-times" aria-hidden="true"></i></a>
	</dd>
<?php //알림이 없을경우
} if ($i == 0) {
?>
	<dd id="arm_empty">
	새로운 알림이 없습니다
	</dd>
<?php
} //for end
?>
	<dd id="arm_all"><a href="<?php echo G5_URL?>/plugin/srd-pushmsg/">모두보기</a></dd>
	</dl>

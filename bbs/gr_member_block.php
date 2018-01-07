<?php
include_once('./_common.php');


$sql = "select gm_block from g5_group_member where mb_id = '$mb_id'";
$result = sql_query($sql);
for ($i=0; $row3=sql_fetch_array($result); $i++) {

// 회원 차단
if(!$gm_block == '2')
sql_query(" update g5_group_member set gm_block = '2' where mb_id = '$mb_id' ");
// 회원 차단 해제
else if($gm_block == '2')
sql_query(" update g5_group_member set gm_block = '' where mb_id = '$mb_id' ");

}
if(!$gm_block == '2')
alert('해당 회원의 오피스매물 보기를 차단하였습니다.');
else if($gm_block == '2')
alert('해당 회원의 오피스매물 보기 차단을 해제 하였습니다.');
//   goto_url(G5_HTTP_BBS_URL.'/group_member_list.php?bo_table='.$bo_table.'&amp;page='.$page.$qstr);
?>

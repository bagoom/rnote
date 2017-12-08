<?php
include_once('./_common.php');


if ($mb_id)
alert('해당 회원의 오피스매물 보기를 차단하였습니다.');





//$wr = sql_fetch(" select * from $write_table where wr_id = '$wr_id' ");


// print_r ($mb_id);
// 나라오름님 수정 : 원글과 코멘트수가 정상적으로 업데이트 되지 않는 오류를 잡아 주셨습니다.
//$sql = " select wr_id, mb_id, wr_comment from $write_table where wr_parent = '$write[wr_id]' order by wr_id ";
$sql = "select mb_8 from g5_member where mb_id = '$mb_id'";
$result = sql_query($sql);
for ($i=0; $row3=sql_fetch_array($result); $i++) {

// 회원 차단
sql_query(" update g5_member set mb_8 = '2' where mb_id = '$mb_id' ");

}
//   goto_url(G5_HTTP_BBS_URL.'/group_member_list.php?bo_table='.$bo_table.'&amp;page='.$page.$qstr);
?>

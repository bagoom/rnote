<?php
include_once('./_common.php');
$wr_id_list = '';
if ($wr_id)
    $wr_id_list = $wr_id;
else {
    $comma = '';
    for ($i=0; $i<count($_POST['chk_wr_id']); $i++) {
        $wr_id_list .= $comma . $_POST['chk_wr_id'][$i];
        $comma = ',';
    }
}
$wr_id_list=explode(",",$wr_id_list);

for ($i=0; $i<count($wr_id_list); $i++) {

$get_sql ="select gr_id from `g5_group_member` where mb_id = '$member[mb_id]' ";
$resc = mysqli_fetch_row(sql_query($get_sql));
if ($resc[0]){
$group_table = "g5_write_".$resc[0];
}
else{
$group_table = "g5_write_".$member[mb_id];
}
// 원본 테이블은 '나의매물' g5_write_mb_id
// 대상 테이블은 '중요매물'  g5_write_gr_id
// echo $wr_id_list[$i] ;
$sql="select wr_id  FROM $group_table order by wr_id desc limit 1";
$result = mysqli_fetch_row(sql_query($sql));
$max_id = $result[0];
$next_wr_num = get_next_num($group_table); //복사할 게시판의 마지막 글번호를 가져와서 -1 시킴
$move_write_table = $write_table;
if($gr_admin){
  $write_table = 'g5_write_'.$gr_admin ;
}
$msg_wdate = G5_TIME_YMDHIS;

// print_r (array_values($col));
// echo $col[1];

//
$sql2 = "select wr_writer,wr_subject,wr_writer_id,wr_o_id from `$write_table` where wr_id = '$wr_id_list[$i]' ";
$result2 = sql_query($sql2);
while($row = mysqli_fetch_array($result2)) {
$sql3 = "select mb_id from `g5_member` where mb_name = '$row[wr_writer]'";
$id_list = sql_query($sql3);

// 승인거절 시 office 테이블에 해당 매물의 wr_o_id와 
// 작성자아이디 테이블의 wr_id가 같으면 wr_important = 2로 업데이트  
sql_query("update `g5_write_$row[wr_writer_id]` set wr_important =  2 , wr_office_permission = '3' where wr_id = '$row[wr_o_id]' ");


if($confirm_unaccept2){
  $confirm_unaccept = $confirm_unaccept2;
}
while($row2 = mysqli_fetch_array($id_list)) {
 sql_query("insert into `g5_srd_pushmsg` (msg_check,mb_id,msg_subject,msg_type,msg_wdate)
VALUES ('n', '$row2[mb_id]', '요청하신 <b>$row[wr_subject]</b>매물이 $confirm_unaccept 으(로) 거절되었습니다.', 'memo','{$msg_wdate}' ) ");
}
}
sql_query(" delete from $group_table where wr_id = '$wr_id_list[$i]' ");

}
alert("매물승인이 거절 되었습니다.");


//
// if($resc[0])
// goto_url(G5_HTTP_BBS_URL.'/board.php?bo_table='.$resc[0].'&office_write=1&wr_sale_type=1&wr_office_permission=1');
// else
// goto_url(G5_HTTP_BBS_URL.'/board.php?bo_table='.$member['mb_id'].'&office_write=1&wr_sale_type=1&wr_office_permission=1');
?>

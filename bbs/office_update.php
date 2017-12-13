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


// print_r (array_values($col));
// echo $col[1];

$sql2 = "select * from g5_write_ekdna8284 where wr_id = '$wr_id_list[$i]' ";
$result2 = mysqli_fetch_assoc(sql_query($sql2));
$wr_o_id = $result2['wr_o_id'];
$wr_writer_id = $result2['wr_writer_id'];


// 소장테이블의 해당글을 승인처리
sql_query("update $group_table set wr_office_permission =  '2'  where  wr_id = '$wr_id_list[$i]' ");
//  미승인 매물중에 원글 작성자를 찾아 해당 테이블에 해당글을 승인처리
sql_query("update `g5_write_$wr_writer_id` set wr_office_permission =  2 where wr_id = '$wr_o_id' ");



// sql_query("insert into `$group_table` select * from `$write_table` where wr_id = '$wr_id_list[$i]' ");
// echo $group_tabel;
// echo $wr_id;
// sql_query("update $group_table set wr_important = '1', wr_id = $max_id+1,wr_num = $next_wr_num, wr_parent = wr_id  where wr_id = '$wr_id_list[$i]' ");
}
alert(" Office 매물로 수락 되었습니다.");



// if($resc[0])
// goto_url(G5_HTTP_BBS_URL.'/board.php?bo_table='.$resc[0].'&sfl=wr_important&stx=1&wr_sale_type=1&wr_office_permission=2');
// else
// goto_url(G5_HTTP_BBS_URL.'/board.php?bo_table='.$member['mb_id'].'&sfl=wr_important&stx=1&wr_sale_type=1&wr_office_permission=2');
?>

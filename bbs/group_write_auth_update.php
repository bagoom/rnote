<?php
include_once('./_common.php');

$group_table = "g5_write_".$member[mb_id];


// print_r (array_values($col));
// echo $col[1];
sql_query("update `g5_group` set gr_write_permission =  '$gr_write_auth'  where  gr_id = '$member[mb_id]' ");



// sql_query("insert into `$group_table` select * from `$write_table` where wr_id = '$wr_id_list[$i]' ");
// echo $group_tabel;
// echo $wr_id;
// sql_query("update $group_table set wr_important = '1', wr_id = $max_id+1,wr_num = $next_wr_num, wr_parent = wr_id  where wr_id = '$wr_id_list[$i]' ");
// alert("중요매물 등록이 완료 되었습니다.");

alert("사무실 매물등록 권한이 수정 되었습니다.");

goto_url(G5_HTTP_BBS_URL.'/group_write_auth.php');
?>

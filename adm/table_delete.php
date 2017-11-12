<?php
$result = sql_query(" select bo_table from {$g5['board_table']} ");
while($row = sql_fetch_array($result)){
    $wr_table = $g5['write_prefix'].$row['bo_table'];

    $result2 = sql_query(" select wr_id from {$wr_table} where instr(wr_content, '[이 게시물은 최고관리자님에 의해') ");
    if($result2){
        while($row2 = sql_fetch_array($result2)){
            //echo $wr_table.' : '.$row2['wr_id'].'<br>'; //먼저 해당 게시물만 출력되는지 확인하고 아래의 쿼리를 실행하세요.
            sql_query(" update {$wr_table} set wr_content = left(wr_content, instr( wr_content, '[이 게시물은 최고관리자님에 의해')-1) where wr_content regexp '\\[이 게시물은.+이동 됨\\]' and wr_id = '{$row2['wr_id']}' ");
        }
    }
}
?>

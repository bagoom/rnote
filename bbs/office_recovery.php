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

if ($gr_admin)
$recovery_table = "g5_write_$member[mb_id]";

for ($i=0; $i<count($wr_id_list); $i++) {

sql_query("update $recovery_table set wr_sold_out = '' , wr_sold_out_date = '' where wr_id = '$wr_id_list[$i]' ");

}
alert("오피스노트에 복구 되었습니다.");
 
?>

<script>
   history.go(-1); // -2, -3 등의 숫자로 이전 페이지 이동가능
</script>

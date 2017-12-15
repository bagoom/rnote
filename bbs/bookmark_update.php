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

$write_table = 'g5_write_'.$member['mb_id'];

 
for ($i=0; $i<count($wr_id_list); $i++) {
// echo $wr_id_list[$i];
$sql2 = "select wr_id from `$write_table` where wr_id = '$wr_id_list[$i]' ";
$resc = mysqli_fetch_assoc(sql_query($sql2));

$wr_id = $resc['wr_id'];
sql_query("update `$write_table` set wr_bookmark = '0'  where wr_id = '$wr_id' ");

}



alert("해당 매물이 즐겨찾기가 해제 되었습니다.");

?>

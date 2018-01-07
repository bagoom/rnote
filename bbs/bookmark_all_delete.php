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

$bookmark_table = 'bookmark_'.$member['mb_id'];
$bookmark_folder_table = 'bookmark_'.$member['mb_id'].'_folder';

for ($i=0; $i<count($wr_id_list); $i++) {
$sql2 = "select bmf_id from `$bookmark_folder_table` where bmf_id = '$wr_id_list[$i]' ";
$result2 = mysqli_fetch_assoc(sql_query($sql2));
$bmf_id = $result2['bmf_id'];
// 폴더 삭제 쿼리
sql_query("delete from `$bookmark_folder_table` where bmf_id = '$bmf_id' ");
        // 해당 폴더의 아이디를 가지는 매물 삭제
        $sql3 = sql_query("select bm_id from `$bookmark_table` where bm_bmf_id = '$wr_id_list[$i]' ");
        while ($child = mysqli_fetch_assoc($sql3)){ 
        $bm_id = $child['bm_id'];
         sql_query("delete from `$bookmark_table` where bm_id = '$bm_id' ");
         }

} //  for exit

alert("해당 폴더가 삭제 되었습니다.");

?>

<?php

// include 'DBconfig.php';

include '../common.php';

header("Content-Type: text/html; charset=UTF-8");
$con = mysqli_connect("localhost","realnote","!dnwls1127","realnote");

if($gr_admin){
    if( $wr_writer_id == $member['mb_id'] || $wr_sold_out != "1" ){
        $bm_from = "1";
        
    }
    else if($wr_important == "1" || $wr_sold_out != "1"){
        $bm_from = "2";
    }
    
}
else{
    if($bo_table==$member['mb_id']){
        $bm_from = "1";
   }
   else if($bo_table==$gr_cp){
       $bm_from = "2";
   }
}
// $bm_from = 3;
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
$chk_sql = sql_fetch("select count(*) as cnt  from bookmark_$member[mb_id] where bm_bmf_id = '$bmf_id' and bm_match_id = '$wr_id_list[$i]' and (bm_from = '1' or bm_from = '2') ");

$sql10 = "select * from `g5_write_$member[mb_id]` a, `bookmark_$member[mb_id]` b where a.wr_id = bm_match_id and  b.bm_bmf_id = '$bmf_id' and b.bm_from = 1 and a.wr_id = '$wr_id_list[$i]' UNION ALL select * from `g5_write_ekdna8284` a, `bookmark_$member[mb_id]` b where a.wr_id = bm_match_id and b.bm_from = 2 and a.wr_id = '$wr_id_list[$i]'";
$result = mysqli_query($con,$sql10);
while($row2=mysqli_fetch_array($result)){
    echo $row2['wr_subject'].',';
    // echo $sql10;
} 



if ($chk_sql['cnt']>0){
    // return;
}else{
    $sql5 = ("update {$write_table}
    set wr_bookmark = '1' where wr_id =$wr_id_list[$i]");
    sql_query($sql5);
    // 회원테이블에 넣을떄 memberID변수 사용할것
    $memberID = $member['mb_id'];
    $sql6="Insert into bookmark_$member[mb_id] (bm_date, bm_match_id, bm_from,bm_bmf_id) values ('".G5_TIME_YMDHIS."', '$wr_id_list[$i]', '$bm_from' , '$bmf_id')";
    sql_query($sql6);
}




}



?>


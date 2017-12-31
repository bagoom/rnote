<?php

// include 'DBconfig.php';

include '../common.php';


header("Content-Type: text/html; charset=UTF-8");

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
$chk_sql = sql_fetch("select count(*) as cnt  from bookmark_test10 where bm_bmf_id = '$bmf_id' and bm_match_id = '$wr_id_list[$i]' and (bm_from = '1' or bm_from = '2') ");


if ($chk_sql['cnt']>0){
    echo "overlap";
    return;
}else{
    echo "success"; 
}



    $sql5 = ("update {$write_table}
                set wr_bookmark = '1' where wr_id =$wr_id_list[$i]");
    sql_query($sql5);
    // 회원테이블에 넣을떄 memberID변수 사용할것
    $memberID = $member['mb_id'];
    $sql6="Insert into bookmark_test10 (bm_date, bm_match_id, bm_from,bm_bmf_id) values ('".G5_TIME_YMDHIS."', '$wr_id_list[$i]', '$bm_from' , '$bmf_id')";
    sql_query($sql6);
}


?>


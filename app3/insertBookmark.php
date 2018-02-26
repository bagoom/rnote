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
    $sql5 = ("update {$write_table}
                set wr_bookmark = '1' where wr_id =$wr_id_list[$i]");
    sql_query($sql5);
    $memberID = $member['mb_id'];
    $sql6="Insert into bookmark_$memberID (bm_date, bm_match_id, bm_from) values ('".G5_TIME_YMDHIS."', '$wr_id_list[$i]', '$bm_from' )";
    sql_query($sql6);
    // echo $wr_id_list[$i] ;
    echo $wr_id_list[$i];
    echo $bm_from;
}



// $sql="Insert into bookmark_$memberID (bm_date, bm_match_id, bm_from) values ('".G5_TIME_YMDHIS."', 137, 1 )";



// $result = sql_query($sql);
;




?>


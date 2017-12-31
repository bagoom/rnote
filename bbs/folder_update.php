<?php
include_once('./_common.php');


print_r ($_POST);


if ($w == 'u'){

    if($folder_top == "1")
    $folder_top_date = G5_TIME_YMDHIS;
    $sql= "update `bookmark_test10_folder` 
    set bmf_name='$folder_name', 
    bmf_top = '$folder_top',  
    bmf_top_date = '$folder_top_date' where bmf_id = '$bmf_id' ";
    sql_query($sql);
}else{

    if($folder_top == "1")
    $folder_top_date = G5_TIME_YMDHIS;
    $sql = " insert into `bookmark_test10_folder`
    set  bmf_name = '$folder_name',
         bmf_top = '$folder_top',
         bmf_top_date = '$folder_top_date',
         bmf_date = '".G5_TIME_YMDHIS."' ";
    
    sql_query($sql);
}



?>

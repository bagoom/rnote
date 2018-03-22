<?php
include_once('./_common.php');


// print_r ($_POST);
if ($page_id_array){
    // $sql = " select MIN(bmf_order) as min_order from  `bookmark_$member[mb_id]_folder`";
    // $row = sql_fetch($sql);
    // $min_order = $row['min_order'];

    // $query = "update `bookmark_$member[mb_id]_folder` set bmf_order = ('$bmf_order'-1) where bmf_order = '$bmf_order' ";
    // sql_query($query); 

    for($i = 0; $i <=count($page_id_array); $i++){

        // print_r($page_id_array);
        $query = "update `bookmark_$member[mb_id]_folder` set bmf_order = $i where bmf_id = $page_id_array[$i] and bmf_top != '1' ";
        sql_query($query);
        echo $query;
       

    }

    
}else{


    if ($w == 'u'){

        if($folder_top == "1")
        $folder_top_date = G5_TIME_YMDHIS;
        $sql= "update `bookmark_$member[mb_id]_folder` 
        set bmf_name='$folder_name', 
        bmf_top = '$folder_top',  
        bmf_top_date = '$folder_top_date' where bmf_id = '$bmf_id' ";
        sql_query($sql);
    }else{
    
        if($folder_top == "1")
        $folder_top_date = G5_TIME_YMDHIS;
        $sql = " insert into `bookmark_$member[mb_id]_folder`
        set  bmf_name = '$folder_name',
             bmf_top = '$folder_top',
             bmf_2 = '$member[mb_3]',
             bmf_top_date = '$folder_top_date',
             bmf_date = '".G5_TIME_YMDHIS."' ";
        
        sql_query($sql);
    }

}





?>

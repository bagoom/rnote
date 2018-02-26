<?php
include 'DBconfig.php';
include '../common.php';
header("Content-Type: text/html; charset=UTF-8");

$con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

mysqli_set_charset($con,"utf8");


// $memberID = 'test7';

// echo "<br>";
// print_r ($emparray);
// echo "</br>";


    $sql_query = "select wr_writer, wr_address, wr_subject, wr_important, wr_office_permission from `g5_write_ekdna8284` where (wr_office_permission = 1 or wr_office_permission = 2) and wr_writer_id ='ekdna8284'";
    $result2 = mysqli_query($con, $sql_query) or die("Error in Selecting " . mysqli_error($con));
    $emparray = array();
       while($row =mysqli_fetch_assoc($result2))
       {
           $emparray[] = $row;
       }
    
    print_r ($emparray);
    
    // print_r (sizeof($emparray));
    for ($i=0; $i<=sizeof($emparray)-1; $i++){
        // echo $id;
        $writer= $emparray[$i]['wr_writer_id'];
        $address= $emparray[$i]['wr_address'];
        $subject = $emparray[$i]['wr_subject'];
        $sql_query2= "update `g5_write_ekdna8284` set wr_important = 1 where wr_writer_id ='ekdna8284' 
        and wr_address ='$address' and wr_subject ='$subject' and wr_office_permission =''";

        // echo $sql_query2;
        echo "</br>";
        sql_query($sql_query2);
    }



// }



?>

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

$sql="select mb_id from `g5_member` where mb_id !='admin' and mb_id != 'ekdna8284' ";
$result = sql_query($sql);
// print_r ($result);
    $emparray = array();
       while($row =mysqli_fetch_assoc($result))
       {
           $emparray[] = $row;
        }
        
        print_r ($emparray);

       

    for ($i=0; $i<=sizeof($emparray)-1; $i++){
        // echo $id;
        $writerID= $emparray[$i]['mb_id'];
        // $writerName= $emparray[$i]['mb_name'];
        
        $sql_query2= "update `g5_write_$writerID` set wr_office_permission = '2' where wr_important ='1'" ;
        
        echo $sql_query2;
        echo "</br>";
        sql_query($sql_query2);
    }







?>

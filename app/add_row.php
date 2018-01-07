<?php
include '../common.php';



// $memberID = 'test7';

// echo "<br>";
// print_r ($emparray);
// echo "</br>";
$sql="select mb_id from `g5_member` where mb_id != 'admin' ";
$result = sql_query($sql);

        

for ($i=0; $row=sql_fetch_array($result); $i++) {

    
   $sql2 = "ALTER TABLE `g5_write_$row[mb_id]`  ADD `wr_sale_price_b` INT NOT NULL DEFAULT '0' AFTER `wr_sale_price`";
   echo $sql2;
   echo '<br>';
   sql_query($sql2);
}


?>

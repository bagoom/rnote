<?php
include '../common.php';



// $memberID = 'test7';

// echo "<br>";
// print_r ($emparray);
// echo "</br>";
$sql="select mb_id from `g5_member` where mb_id != 'admin' ";
$result = sql_query($sql);

        

for ($i=0; $row=sql_fetch_array($result); $i++) {

    $sql2 = "    CREATE TABLE `realnote`.`rnote_contact_$row[mb_id]` (
        `rc_id` int(11) NOT NULL AUTO_INCREMENT,
        `rc_name` varchar(10) NOT NULL,
        `rc_hp` varchar(15) NOT NULL,
        `rc_content` varchar(255) NOT NULL,
        `rc_bookmark` int(11) NOT NULL DEFAULT '0',
        `rc_date` datetime NOT NULL,
        PRIMARY KEY (`rc_id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

    

   echo $sql2;
   echo '<br>';
   sql_query($sql2);
}


?>

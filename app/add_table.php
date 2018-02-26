<?php
include '../common.php';



// $memberID = 'test7';

// echo "<br>";
// print_r ($emparray);
// echo "</br>";
$sql="select mb_id from `g5_member` where mb_id != 'admin' ";
$result = sql_query($sql);

        

for ($i=0; $row=sql_fetch_array($result); $i++) {

    $sql2 = "CREATE TABLE `realnote`.`bld_$row[mb_id]` ( `bld_id` INT(11) NOT NULL AUTO_INCREMENT , `bld_name` VARCHAR(20) NOT NULL , `bld_address` VARCHAR(40) NOT NULL , `bld_contact` VARCHAR(20) NOT NULL , `bld_sale_type` INT(1) NOT NULL DEFAULT '0'  , `bld_floor` INT(3) NOT NULL DEFAULT '0' , `bld_roomPerFloor` INT(3) NOT NULL DEFAULT 1, `bld_Bfloor` INT(1) NOT NULL , `bld_firstRoomNumber` INT(1) NOT NULL , `bld_subway` VARCHAR(10) NOT NULL , `bld_posx` DOUBLE NULL  ,`bld_posy` DOUBLE  NULL  , `bld_hasElev` INT(1) NOT NULL DEFAULT '0', `bld_hasParking` INT(1) NOT NULL DEFAULT '0', `bld_permission` INT(1) NOT NULL , `bld_important` INT(1) NOT NULL DEFAULT '2', `bld_datetime` DATETIME NOT NULL , `bld_datetime_mod` DATETIME NOT NULL , `bld_memo` VARCHAR(250) NULL , PRIMARY KEY (`bld_id`)) ENGINE = InnoDB";

    
   echo $sql2;
   echo '<br>';
   sql_query($sql2);
}


?>

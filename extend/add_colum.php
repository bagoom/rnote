<?php
include_once('../common.php');


$sql="select * from `g5_member`";
$result = sql_query($sql);



for ($i=0; $row=sql_fetch_array($result); $i++) {
  // $mem = mysqli_fetch_array($row, MYSQLI ASSOC)['mb_id'];
// ALTER TABLE `g5_write_'$mem'` ADD `dewdwe` INT NOT NULL AFTER `wr_move__date`;
// ALTER TABLE `g5_write_test10` ADD `ddd` INT NOT NULL AFTER `wr_move_date`;
print_r($row);
}

?>

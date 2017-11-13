<?php
include_once('../common.php');


$sql="select mb_id from `g5_member`";
$result = sql_query($sql);



for ($i=0; $row=sql_fetch_array($result); $i++) {
// ALTER TABLE `g5_write_'$mem'` ADD `dewdwe` INT NOT NULL AFTER `wr_move__date`;
sql_query("ALTER TABLE `g5_write_$row[mb_id]` ADD `wr_mon_income` INT NOT NULL AFTER `wr_profit_rate`, ADD `wr_silinsu` INT NOT NULL AFTER `wr_mon_income`, ADD `wr_gross_area` INT NOT NULL AFTER `wr_silinsu`");

print_r ('g5_write_'.$row[mb_id].'<br>');
}

?>

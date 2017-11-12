<?php
include_once('./_common.php');
$dbname = 'woodonggoon';


if (!mysql_connect('localhost', 'woodonggoon', 'dnwls1127')) {
    echo 'Could not connect to mysql';
    exit;
}


$sql = "SHOW TABLES FROM $dbname WHERE who LIKE "%me%" ";
$result = mysql_query($sql);

if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

while ($row = mysql_fetch_row($result)) {?>


    <li>테이블명 :  <?= $row[0]?> </li>
<?}?>


<?
mysql_free_result($result);

?>

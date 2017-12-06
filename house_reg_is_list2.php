<?
include_once "./_common.php";

// 거리순 정열 끝
if($isnewaddr=="Y"){
$jibeon = $addr2;
$road = $addr1;
}
else
{
$jibeon = $addr1;
$road = $addr2;
}

$sql = " select * from g5_write_$bo_table where wr_address like '$jibeon'  limit 1 ";

$ishouse  = sql_fetch($sql);

if($ishouse[nh_jibeon_addr]){

  if(!$ishouse[nh_name])
  $ishouse[nh_name]="건물선택";


  echo "<a href='javascript:house_reg_searchMark2(".$lat.",".$lng.",\"".$jibeon."\",\"".$road."\",\"".$isnewaddr."\",\"{$ishouse[nh_no]}\")' ><div style='height:52px; width:100%; text-align:right;text-decoration:none;'> <i class='nice01 nice-house-fa red size17'></i> <span style='font-size:14px; color:#666666; font-weight:bold;text-decoration:none;'>".cut_str($ishouse[nh_name],4,'')."</span> </div></a>";
  //echo "<br><span style='font-size:11px'>$row[nh_jibeon_addr]</span><br>";
  //echo "<span style='font-size:10px'>$row[nh_addr1]</span><br>";
  }else{
    echo "<div onclick='javascript:house_reg_searchMark2(".$lat.",".$lng.",\"".$jibeon."\",\"".$road."\",\"".$isnewaddr."\",\"\")' class='address_box'> <i class='nice01 nice-house-plus size17'></i> 등록하기 </div>";
    }
  ?>
  <script type="text/javascript">
  $('#wr_address2').keyup(function(e) {
      if (e.keyCode == 13){
      $('.address_box').trigger('click');
    }
  });
  </script>
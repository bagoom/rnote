<?php
include_once('./_common.php');
$wr_id_list = '';
if ($wr_id)
    $wr_id_list = $wr_id;
else {
    $comma = '';
    for ($i=0; $i<count($_POST['chk_wr_id']); $i++) {
        $wr_id_list .= $comma . $_POST['chk_wr_id'][$i];
        $comma = ',';
    }
}
$wr_id_list=explode(",",$wr_id_list);



for ($i=0; $i<count($wr_id_list); $i++) {
$get_sql ="select gr_id from `g5_group_member` where mb_id = '$member[mb_id]' ";
$resc = mysqli_fetch_row(sql_query($get_sql));
if ($resc[0]){
$group_table = "g5_write_".$resc[0];
}
else{
$group_table = "g5_write_".$member[mb_id];
}
// 원본 테이블은 '나의매물' g5_write_mb_id
// 대상 테이블은 '중요매물'  g5_write_gr_id
$sql="select wr_id  FROM $group_table order by wr_id desc limit 1";
$result = mysqli_fetch_row(sql_query($sql));
$max_id = $result[0];
$next_wr_num = get_next_num($group_table); //복사할 게시판의 마지막 글번호를 가져와서 -1 시킴
$move_write_table = $write_table;
if($gr_admin){
  $write_table = 'g5_write_'.$gr_admin ;
}

$keyword = "wr_o_id,wr_num,wr_reply,wr_parent,wr_is_comment,wr_datetime,wr_subject,wr_writer,wr_writer_id,wr_hp,wr_sale_type,wr_sold_out,wr_content,wr_address,wr_address_sale,wr_district,wr_sale_area,wr_floor,wr_rent_p,wr_area_p,wr_area_m,wr_area_p_all,wr_area_m_all,wr_sale_price,wr_p_sale_price,wr_loan,wr_year_rate,wr_int_rate,wr_year_int,wr_mon_int,wr_year_income,wr_sale_deposit,wr_total_rfee,wr_rent_deposit,wr_profit_rate,wr_mon_income,wr_silinsu,wr_gross_area,wr_m_rate,wr_mt_cost,wr_mt_cost_p,wr_premium_o,wr_premium_b,wr_renter_contact,wr_lessor_contact,wr_parcel_contact,wr_seller_contact,wr_rand_type,wr_zoning_district,wr_room_type,wr_room_count,wr_rest_count,wr_o_air_cond,wr_o_fridger,wr_o_washer,wr_o_tv,wr_o_internet,wr_o_microwave,wr_o_desk,wr_o_bookshelf,wr_o_bed,wr_o_closet,wr_o_shoe_rack,wr_o_sink,wr_o_heating,wr_o_subway,wr_o_parking,wr_o_elevator,wr_o_vacant,wr_memo,wr_rec_sectors,wr_direction,wr_code,wr_extra_exp,wr_adver_subject,wr_file,board_list,wr_important,wr_bookmark,wr_office_permission,wr_posx,wr_posy,wr_move_date";


$temp = "select * FROM $write_table where wr_id = '$wr_id_list[$i]' order by  wr_id desc";
$col = mysqli_fetch_row(sql_query($temp));
// print_r($col);
sql_query("insert into `$group_table` ($keyword) values(
                                                                                  '$col[0]',
                                                                                  '$next_wr_num',
                                                                                  '$col[3]',
                                                                                  '$col[4]',
                                                                                  '$col[5]',
                                                                                  '".G5_TIME_YMDHIS."',
                                                                                  '$col[7]',
                                                                                  '$col[8]',
                                                                                  '$col[9]',
                                                                                  '$member[mb_hp]',
                                                                                  '$col[11]',
                                                                                  '$col[12]',
                                                                                  '$col[13]',
                                                                                  '$col[14]',
                                                                                  '$col[15]',
                                                                                  '$col[16]',
                                                                                  '$col[17]',
                                                                                  '$col[18]',
                                                                                  '$col[19]',
                                                                                  '$col[20]',
                                                                                  '$col[21]',
                                                                                  '$col[22]',
                                                                                  '$col[23]',
                                                                                  '$col[24]',
                                                                                  '$col[25]',
                                                                                  '$col[26]',
                                                                                  '$col[27]',
                                                                                  '$col[28]',
                                                                                  '$col[29]',
                                                                                  '$col[30]',
                                                                                  '$col[31]',
                                                                                  '$col[32]',
                                                                                  '$col[33]',
                                                                                  '$col[34]',
                                                                                  '$col[35]',
                                                                                  '$col[36]',
                                                                                  '$col[37]',
                                                                                  '$col[38]',
                                                                                  '$col[39]',
                                                                                  '$col[40]',
                                                                                  '$col[41]',
                                                                                  '$col[42]',
                                                                                  '$col[43]',
                                                                                  '$col[44]',
                                                                                  '$col[45]',
                                                                                  '$col[46]',
                                                                                  '$col[47]',
                                                                                  '$col[48]',
                                                                                  '$col[49]',
                                                                                  '$col[50]',
                                                                                  '$col[51]',
                                                                                  '$col[52]',
                                                                                  '$col[53]',
                                                                                  '$col[54]',
                                                                                  '$col[55]',
                                                                                  '$col[56]',
                                                                                  '$col[57]',
                                                                                  '$col[58]',
                                                                                  '$col[59]',
                                                                                  '$col[60]',
                                                                                  '$col[61]',
                                                                                  '$col[62]',
                                                                                  '$col[63]',
                                                                                  '$col[64]',
                                                                                  '$col[65]',
                                                                                  '$col[66]',
                                                                                  '$col[67]',
                                                                                  '$col[68]',
                                                                                  '$col[69]',
                                                                                  '$col[70]',
                                                                                  '$col[71]',
                                                                                  '$col[72]',
                                                                                  '$col[73]',
                                                                                  '$col[74]',
                                                                                  '$col[75]',
                                                                                  '$col[76]',
                                                                                  '$col[77]',
                                                                                  '1',
                                                                                  '0',
                                                                                  '1',
                                                                                  '$col[81]',
                                                                                  '$col[82]',
                                                                                  '$col[83]'
)");
sql_query("update $group_table set wr_parent =  wr_id ");
if(!$gr_admin){
sql_query("update $write_table set wr_important =  1 where wr_id = $wr_id_list[$i] ");
}
} //for exit
alert("사무실로 매물이 등록 되었습니다 승인을 기다려 주세요.");
if($resc[0])
location.reload(true);
else
goto_url(G5_HTTP_BBS_URL.'/board.php?bo_table='.$member['mb_id'].'&sfl=wr_important&stx=1&wr_sale_type=1&wr_office_permission=2');
?>

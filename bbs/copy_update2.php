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

$get_sql ="select gr_id from `g5_group_member` where mb_id = '$member[mb_id]' ";
$resc = mysqli_fetch_row(sql_query($get_sql));
$group_table = "g5_write_".$resc[0];

$wr_id_list=explode(",",$wr_id_list);
    for ($i=0; $i<count($_POST['chk_wr_id']); $i++)
    {
        $move_write_table = $group_table;

        $src_dir = G5_DATA_PATH.'/file/'.$bo_table; // 원본 디렉토리
        $dst_dir = G5_DATA_PATH.'/file/'.$move_bo_table; // 복사본 디렉토리

        $count_write = 0;
        $count_comment = 0;
        $wr_num = -$wr_id_list[0];
        $next_wr_num = get_next_num($move_write_table);

        $sql2 = " select * from $write_table where wr_num = '$wr_num' order by wr_parent";
        $result2 = sql_query($sql2);
        while ($row2 = sql_fetch_array($result2))
        {

          $sql = " insert into $move_write_table
                      set wr_num = '$next_wr_num',
                           wr_reply = '{$row2['wr_reply']}',
                           wr_subject = '{$row2['wr_subject']}',
                           wr_writer = '{$row2['wr_writer']}',
                           wr_content = '{$row2['wr_content']}',
                           wr_address = '{$row2['wr_address']}',
                           wr_district = '{$row2['wr_district']}',
                           wr_floor = '{$row2['wr_floor']}',
                           wr_sale_area = '{$row2['wr_sale_area']}',
                           wr_rent_p = '{$row2['wr_rent_p']}',
                           wr_area_p = '{$row2['wr_area_p']}',
                           wr_area_m = '{$row2['wr_area_m']}',
                           wr_area_p_all = '{$row2['wr_area_p_all']}',
                           wr_area_m_all = '{$row2['wr_area_m_all']}',
                           wr_sale_price = '{$row2['wr_sale_price']}',
                           wr_p_sale_price = '{$row2['wr_p_sale_price']}',
                           wr_loan = '{$row2['wr_loan']}',
                           wr_sale_deposit = '{$row2['wr_sale_deposit']}',
                           wr_total_rfee = '{$row2['wr_total_rfee']}',
                           wr_rent_deposit = '{$row2['wr_rent_deposit']}',
                           wr_profit_rate = '{$row2['wr_profit_rate']}',
                           wr_m_rate = '{$row2['wr_m_rate']}',
                           wr_mt_cost = '{$row2['wr_mt_cost']}',
                           wr_premium_o = '{$row2['wr_premium_o']}',
                           wr_premium_b = '{$row2['wr_premium_b']}',
                           wr_renter_contact = '{$row2['wr_renter_contact']}',
                           wr_lessor_contact = '{$row2['wr_lessor_contact']}',
                           wr_parcel_contact = '{$row2['wr_parcel_contact']}',
                           wr_room_type = '{$row2['wr_room_type']}',
                           wr_room_count = '{$row2['wr_room_count']}',
                           wr_rest_count = '{$row2['wr_rest_count']}',
                           wr_o_air_cond = '{$row2['wr_o_air_cond']}',
                           wr_o_fridger = '{$row2['wr_o_fridger']}',
                           wr_o_washer = '{$row2['wr_0_washer']}',
                           wr_o_tv = '{$row2['wr_o_tv']}',
                           wr_o_internet = '{$row2['wr_o_internet']}',
                           wr_o_microwave = '{$row2['wr_o_microwave']}',
                           wr_o_desk = '{$row2['wr_o_desk']}',
                           wr_o_bookshelf = '{$row2['wr_o_bookshelf']}',
                           wr_o_bed = '{$row2['wr_o_bed']}',
                           wr_o_closet = '{$row2['wr_o_closet']}',
                           wr_o_shoe_rack = '{$row2['wr_o_shoe_rack']}',
                           wr_o_sink = '{$row2['wr_o_sink']}',
                           wr_o_heating = '{$row2['wr_o_heating']}',
                           wr_o_subway = '{$row2['wr_o_subway']}',
                           wr_o_parking = '{$row2['wr_o_parking']}',
                           wr_o_elevator = '{$row2['wr_o_elevator']}',
                           wr_o_vacant = '{$row2['wr_o_vacant']}',
                           wr_direction = '{$row2['wr_direction']}',
                           wr_memo = '{$row2['wr_memo']}',
                           wr_rec_sectors = '{$row2['wr_rec_sectors']}',
                           wr_code = '{$row2['wr_code']}',
                           wr_extra_exp = '{$row2['wr_extra_exp']}',
                           wr_move_date = '{$row2['wr_move_date']}',
                           board_list = '{$row2['board_list']}',
                           wr_important = '{$row2['wr_important']}',
                           wr_posy = '{$row2['wr_posy']}',
                           wr_posx = '{$row2['wr_posx']}',
                           wr_datetime = '".G5_TIME_YMDHIS."' ";
          sql_query($sql);
          $insert_id = sql_insert_id();

}
}









// $keyword = "wr_num,wr_reply,wr_parent,	wr_is_comment,wr_datetime,wr_subject,wr_writer,wr_content,wr_address,wr_district,wr_sale_area,wr_floor,wr_rent_p,wr_area_p,wr_area_m,wr_area_p_all,wr_area_m_all,wr_sale_price,wr_p_sale_price,wr_loan,wr_sale_deposit,wr_total_rfee,wr_rent_deposit,wr_profit_rate,wr_m_rate,wr_mt_cost,wr_mt_cost_p,wr_premium_o,wr_premium_b,wr_renter_contact,wr_lessor_contact,wr_parcel_contact,wr_room_type,wr_room_count,wr_rest_count,wr_o_air_cond,wr_o_fridger,wr_o_washer,wr_o_tv,wr_o_internet,wr_o_microwave,wr_o_desk,wr_o_bookshelf,wr_o_bed,wr_o_closet,wr_o_shoe_rack,wr_o_sink,wr_o_heating,wr_o_subway,wr_o_parking,wr_o_elevator,wr_o_vacant,wr_memo,wr_rec_sectors,wr_direction,wr_code,wr_extra_exp,wr_adver_subject,wr_file,board_list,wr_important,wr_posx,wr_posy,wr_move_date";
//
// $keyword2 = "wr_num,wr_reply,wr_parent,	wr_is_comment,wr_datetime,wr_subject,wr_writer,wr_content,wr_address,wr_district,wr_sale_area,wr_floor,wr_rent_p,wr_area_p,wr_area_m,wr_area_p_all,wr_area_m_all,wr_sale_price,wr_p_sale_price,wr_loan,wr_sale_deposit,wr_total_rfee,wr_rent_deposit,wr_profit_rate,wr_m_rate,wr_mt_cost,wr_mt_cost_p,wr_premium_o,wr_premium_b,wr_renter_contact,wr_lessor_contact,wr_parcel_contact,wr_room_type,wr_room_count,wr_rest_count,wr_o_air_cond,wr_o_fridger,wr_o_washer,wr_o_tv,wr_o_internet,wr_o_microwave,wr_o_desk,wr_o_bookshelf,wr_o_bed,wr_o_closet,wr_o_shoe_rack,wr_o_sink,wr_o_heating,wr_o_subway,wr_o_parking,wr_o_elevator,wr_o_vacant,wr_memo,wr_rec_sectors,wr_direction,wr_code,wr_extra_exp,wr_adver_subject,wr_file,board_list,wr_important,wr_posx,wr_posy,wr_move_date";
//
// sql_query("insert into `$group_table` ($keyword) select $keyword2 from `$write_table` where wr_id = '$wr_id_list[$i]' ");
//
// // sql_query("insert into `$group_table` select * from `$write_table` where wr_id = '$wr_id_list[$i]' ");
// // echo $group_tabel;
// // echo $wr_id;
// sql_query("update $group_table set wr_important = '1', wr_id = $max_id+1,wr_num = -wr_id, wr_parent = wr_id  where wr_parent = '$wr_id_list[$i]' ");
// }
// alert("중요매물 등록이 완료 되었습니다.");




// goto_url(G5_HTTP_BBS_URL.'/board.php?bo_table='.$resc[0].'&amp;page='.$page.$qstr);
?>

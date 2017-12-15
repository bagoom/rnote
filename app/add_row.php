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


        
        $sql_query2= "INSERT INTO `g5_write_ekdna8284` (`wr_id`, `wr_o_id`, `wr_num`, `wr_reply`, `wr_parent`, `wr_is_comment`, `wr_datetime`, `wr_subject`, `wr_writer`, `wr_writer_id`, `wr_hp`, `wr_sale_type`, `wr_sold_out`, `wr_sold_out_date`, `wr_content`, `wr_address`, `wr_address_sale`, `wr_district`, `wr_sale_area`, `wr_floor`, `wr_rent_p`, `wr_area_p`, `wr_area_m`, `wr_area_p_all`, `wr_area_m_all`, `wr_sale_price`, `wr_p_sale_price`, `wr_loan`, `wr_year_rate`, `wr_int_rate`, `wr_year_int`, `wr_mon_int`, `wr_year_income`, `wr_sale_deposit`, `wr_total_rfee`, `wr_rent_deposit`, `wr_profit_rate`, `wr_mon_income`, `wr_silinsu`, `wr_gross_area`, `wr_m_rate`, `wr_mt_cost`, `wr_mt_cost_p`, `wr_premium_o`, `wr_premium_b`, `wr_renter_contact`, `wr_lessor_contact`, `wr_parcel_contact`, `wr_seller_contact`, `wr_rand_type`, `wr_zoning_district`, `wr_room_type`, `wr_room_count`, `wr_rest_count`, `wr_o_air_cond`, `wr_o_fridger`, `wr_o_washer`, `wr_o_tv`, `wr_o_internet`, `wr_o_microwave`, `wr_o_desk`, `wr_o_bookshelf`, `wr_o_bed`, `wr_o_closet`, `wr_o_shoe_rack`, `wr_o_sink`, `wr_o_heating`, `wr_o_subway`, `wr_o_parking`, `wr_o_elevator`, `wr_o_vacant`, `wr_memo`, `wr_rec_sectors`, `wr_direction`, `wr_code`, `wr_extra_exp`, `wr_adver_subject`, `wr_file`, `board_list`, `wr_important`, `wr_bookmark`, `wr_office_permission`, `wr_posx`, `wr_posy`, `wr_move_date`) VALUES (2608, 2608, -2453, '', 2608, 0, '2017-12-12 14:14:24', '올리브장작 정관', '다움부동산', 'ekdna8284', '010-2606-5002', 1, 0, '0000-00-00 00:00:00', '', '부산 기장군 정관읍 모전리 470-2', '', '', '정관신도시', '1', 0, '130', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5000, 0, 0, 0, 0, 440, 0, 0, 65000, 65000, '010-2560-2624', '', '', '', '', '', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '주차 16대 대지 400평', '음식점 고깃집 대형매장 ', '', 'NJX0650-B3FD', 0, '', 0, 3, 2, 0, '', 129.170705871, 35.3340637706, '0000-00-00 00:00:00')" ;
        
        echo $sql_query2;
        echo "</br>";
        sql_query($sql_query2);







?>

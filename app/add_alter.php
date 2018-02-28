<?php
include '../common.php';



// $memberID = 'test7';

// echo "<br>";
// print_r ($emparray);
// echo "</br>";
$sql="select mb_id from `g5_member` where mb_id = 'dm9329' ";
$result = sql_query($sql);

        

for ($i=0; $row=sql_fetch_array($result); $i++) {

   $sql2 = "CREATE TABLE `g5_write_dm9329` (
    `wr_id` int(11) NOT NULL AUTO_INCREMENT,
    `wr_o_id` int(11) NOT NULL,
    `wr_num` int(11) NOT NULL DEFAULT '0',
    `wr_reply` varchar(10) NOT NULL,
    `wr_parent` int(11) NOT NULL DEFAULT '0',
    `wr_is_comment` tinyint(4) NOT NULL DEFAULT '0',
    `wr_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `wr_subject` varchar(15) NOT NULL,
    `wr_writer` varchar(12) NOT NULL,
    `wr_writer_id` varchar(20) NOT NULL,
    `wr_hp` varchar(13) NOT NULL,
    `wr_sale_type` int(11) NOT NULL DEFAULT '0',
    `wr_sold_out` int(11) NOT NULL,
    `wr_sold_out_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `wr_content` text NOT NULL,
    `wr_address` varchar(255) NOT NULL,
    `wr_address_sale` varchar(255) NOT NULL,
    `wr_district` varchar(255) NOT NULL,
    `wr_sale_area` varchar(255) NOT NULL,
    `wr_floor` int(3) NOT NULL,
    `wr_rent_p` int(11) NOT NULL DEFAULT '0',
    `wr_area_p` varchar(255) NOT NULL DEFAULT '0',
    `wr_area_m` varchar(255) NOT NULL DEFAULT '0',
    `wr_area_p_all` int(11) NOT NULL DEFAULT '0',
    `wr_area_m_all` float NOT NULL DEFAULT '0',
    `wr_sale_price` int(11) NOT NULL DEFAULT '0',
    `wr_sale_price_b` int(11) NOT NULL DEFAULT '0',
    `wr_p_sale_price` int(11) NOT NULL DEFAULT '0',
    `wr_loan` int(11) NOT NULL DEFAULT '0',
    `wr_year_rate` int(11) NOT NULL DEFAULT '0',
    `wr_int_rate` int(11) NOT NULL DEFAULT '0',
    `wr_year_int` int(11) NOT NULL DEFAULT '0',
    `wr_mon_int` int(11) NOT NULL DEFAULT '0',
    `wr_year_income` int(11) NOT NULL DEFAULT '0',
    `wr_sale_deposit` int(11) NOT NULL DEFAULT '0',
    `wr_total_rfee` int(11) NOT NULL DEFAULT '0',
    `wr_rent_deposit` int(11) NOT NULL DEFAULT '0',
    `wr_profit_rate` int(11) NOT NULL DEFAULT '0',
    `wr_mon_income` int(11) NOT NULL,
    `wr_silinsu` int(11) NOT NULL,
    `wr_gross_area` int(11) NOT NULL,
    `wr_m_rate` int(11) NOT NULL DEFAULT '0',
    `wr_mt_cost` int(11) NOT NULL DEFAULT '0',
    `wr_mt_cost_p` int(11) NOT NULL DEFAULT '0',
    `wr_mt_separate` int(11) NOT NULL DEFAULT '0',
    `wr_mt_elec` int(11) NOT NULL DEFAULT '0',
    `wr_mt_water` int(11) NOT NULL DEFAULT '0',
    `wr_mt_gas` int(11) NOT NULL DEFAULT '0',
    `wr_mt_tv` int(11) NOT NULL DEFAULT '0',
    `wr_mt_internet` int(11) NOT NULL DEFAULT '0',
    `wr_premium_o` int(11) NOT NULL DEFAULT '0',
    `wr_premium_b` int(11) NOT NULL DEFAULT '0',
    `wr_renter_contact` varchar(255) NOT NULL,
    `wr_lessor_contact` varchar(255) NOT NULL,
    `wr_parcel_contact` varchar(255) NOT NULL,
    `wr_seller_contact` varchar(255) NOT NULL,
    `wr_rand_type` varchar(255) NOT NULL,
    `wr_zoning_district` varchar(255) NOT NULL,
    `wr_room_type` varchar(255) NOT NULL,
    `wr_rent_type` int(11) NOT NULL DEFAULT '0',
    `wr_room_number` int(11) NOT NULL DEFAULT '0',
    `wr_room_count` tinyint(4) NOT NULL DEFAULT '0',
    `wr_rest_count` tinyint(4) NOT NULL DEFAULT '0',
    `wr_o_air_cond` varchar(1) NOT NULL,
    `wr_o_fridger` varchar(1) NOT NULL,
    `wr_o_washer` varchar(1) NOT NULL,
    `wr_o_tv` varchar(1) NOT NULL,
    `wr_o_internet` varchar(1) NOT NULL,
    `wr_o_microwave` varchar(1) NOT NULL,
    `wr_o_desk` varchar(1) NOT NULL,
    `wr_o_bookshelf` varchar(1) NOT NULL,
    `wr_o_bed` varchar(1) NOT NULL,
    `wr_o_closet` varchar(1) NOT NULL,
    `wr_o_shoe_rack` varchar(1) NOT NULL,
    `wr_o_sink` varchar(1) NOT NULL,
    `wr_o_stove` varchar(1) DEFAULT NULL,
    `wr_o_elock` varchar(1) DEFAULT NULL,
    `wr_o_ind` varchar(1) DEFAULT NULL,
    `wr_o_elevator` varchar(1) NOT NULL,
    `wr_o_vacant` varchar(1) NOT NULL,
    `wr_memo` varchar(255) NOT NULL,
    `wr_rec_sectors` varchar(255) NOT NULL,
    `wr_o_bidet` varchar(1) DEFAULT NULL,
    `wr_code` varchar(255) NOT NULL,
    `wr_extra_exp` int(11) NOT NULL DEFAULT '0',
    `wr_adver_subject` varchar(255) NOT NULL,
    `wr_file` int(11) NOT NULL DEFAULT '0',
    `board_list` int(1) NOT NULL DEFAULT '0',
    `wr_important` int(1) NOT NULL DEFAULT '0',
    `wr_bookmark` int(1) NOT NULL DEFAULT '0',
    `wr_office_permission` varchar(1) NOT NULL,
    `wr_posx` double NOT NULL DEFAULT '0',
    `wr_posy` double NOT NULL DEFAULT '0',
    `wr_bld_match_id` int(11) NOT NULL DEFAULT '0',
    `wr_room_inactive` int(11) NOT NULL DEFAULT '0',
    `wr_move_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`wr_id`),
  KEY `wr_num_reply_parent` (`wr_num`,`wr_reply`,`wr_parent`),
  KEY `wr_is_comment` (`wr_is_comment`,`wr_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
";
   
   echo $sql2;
   echo '<br>';
   sql_query($sql2);
}


?>

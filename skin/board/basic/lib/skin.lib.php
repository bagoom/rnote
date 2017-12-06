<?
// 추가 및 변경 함수 시작
// $arr_search = array();
// for($j = 1; $j < 11; $j++){
// 	if($_GET["wr_".$j] && strlen($_GET["wr_".$j]) > 0){
// 		$qstr .= "&wr_".$j."=".urlencode($_GET["wr_".$j]);
// 	}
// }

// 검색 구문을 얻는다.
//function get_sql_search($search_ca_name, $search_field, $search_text, $search_operator=false)
function get_sql_search3($search_ca_name, $search_field, $search_text, $search_operator='and',$search_arr='')
{
    global $g5;
    global $gr_admin;
    global $wr_important;
    global $wr_sold_out;

    $str = "";

    $rent_deposit_min = $_GET["wr_rent_deposit_min"];
    $rent_deposit_max = $_GET["wr_rent_deposit_max"];
    if ($search_ca_name)
        $str = " ca_name = '$search_ca_name' ";

    $search_text = trim($search_text);

    if (!$search_text && !$search_arr)
        return $str;
		if(count($search_arr[name]) > 0){
			$se_flag = 0;
			for($j = 0; $j < count($search_arr[name]); $j++){
				if(is_array($search_arr[val][$j])){
					$str2 = "";

					for($x = 0; $x < count($search_arr[val][$j]);$x++){
						$str2 = append_sql2($str2, " or ", " {$search_arr[name][$j]} like '%{$search_arr[val][$j][$x]}%' ");
					}
					$str2 = " (".$str2.") ";
					$str = append_sql2($str, " and", $str2);

				}



        else if(strlen($search_arr[val][$j]) > 0 && $search_arr[val][$j] ){
         if($gr_admin && $wr_important && !$wr_sold_out){
            $str = append_sql2($str, " and ", "wr_sold_out !=1 and {$search_arr[name][$j]}  like '%{$search_arr[val][$j]}%' ");
            }else if($gr_admin && !$wr_important && !$wr_sold_out){
            $str = append_sql2($str, " and ", "wr_sold_out !=1 and wr_office_permission = '' and {$search_arr[name][$j]}  like '%{$search_arr[val][$j]}%' ");
            // 거래종료 필터 쿼리
            }else if($wr_sold_out == "1"){
                $str = append_sql2($str, " and ", "wr_sold_out = '1' and {$search_arr[name][$j]}  like '%{$search_arr[val][$j]}%' ");
            
            }else{
            $str = append_sql2($str, " and ", "wr_sold_out !=1 and {$search_arr[name][$j]}  like '%{$search_arr[val][$j]}%' ");
             }
				}



			}
    }


      // 층수 범위검색
      if($_GET["wr_floor_min"] && $_GET["wr_floor_max"]) {
         $str = append_sql2($str, " and ", " wr_floor between '$_GET[wr_floor_min]' and '$_GET[wr_floor_max]' ");
       }elseif ($_GET["wr_floor_min"]){
         $str = append_sql2($str, " and ", " wr_floor >= '$_GET[wr_floor_min]' ");
       }elseif ($_GET["wr_floor_max"]){
         $str = append_sql2($str, " and ", " wr_floor <= '$_GET[wr_floor_max]' ");
       }

        // 평수 범위검색
       if($_GET["wr_area_p_min"] && $_GET["wr_area_p_max"]) {
          $str = append_sql2($str, " and ", " wr_area_p+0 between '$_GET[wr_area_p_min]' and '$_GET[wr_area_p_max]'");
        }elseif ($_GET["wr_area_p_min"]){
          $str = append_sql2($str, " and ", " wr_area_p+0 >= '$_GET[wr_area_p_min]' ");
        }elseif ($_GET["wr_area_p_max"]){
          $str = append_sql2($str, " and ", " wr_area_p+0 <= '$_GET[wr_area_p_max]' ");
        }

        // 월세 범위검색
        if($_GET["wr_m_rate_min"] && $_GET["wr_m_rate_max"]) {
           $str = append_sql2($str, " and ", " wr_m_rate between  '$_GET[wr_m_rate_min]' and  '$_GET[wr_m_rate_max]'");
         }else if ($_GET["wr_m_rate_min"]){
           $str = append_sql2($str, " and ", " wr_m_rate >= '$_GET[wr_m_rate_min]' ");
         }else if ($_GET["wr_m_rate_max"]){
           $str = append_sql2($str, " and ", " wr_m_rate <= '$_GET[wr_m_rate_max]' ");
         }

        // 보증금 범위검색
         if($_GET["wr_rent_deposit_min"] && $_GET["wr_rent_deposit_max"]) {
            $str = append_sql2($str, " and ", " wr_rent_deposit between $rent_deposit_min and $rent_deposit_max");
          }else if ($_GET["wr_rent_deposit_min"]){
            $str = append_sql2($str, " and ", " wr_rent_deposit >= '$_GET[wr_rent_deposit_min]' ");
          }else if ($_GET["wr_rent_deposit_max"]){
            $str = append_sql2($str, " and ", " wr_rent_deposit <= '$_GET[wr_rent_deposit_max]' ");
          }

        // 권리금 범위검색
        if($_GET["wr_premium_o_min"] && $_GET["wr_premium_o_max"]) {
           $str = append_sql2($str, " and ", " wr_premium_o between '$_GET[wr_premium_o_min]' and '$_GET[wr_premium_o_max]'");
         }elseif ($_GET["wr_premium_o_min"] ){
           $str = append_sql2($str, " and ", " wr_premium_o >= '$_GET[wr_premium_o_min]' ");
         }elseif ($_GET["wr_premium_o_max"] ){
           $str = append_sql2($str, " and ", " wr_premium_o <= '$_GET[wr_premium_o_max]' ");
         }

        // 합예산 범위검색
        if($_GET["wr_sum_pay_min"] && $_GET["wr_sum_pay_max"]) {
           $str = append_sql2($str, " and ", " wr_rent_deposit+wr_premium_o between '$_GET[wr_sum_pay_min]' and '$_GET[wr_sum_pay_max]'");
         }elseif ($_GET["wr_sum_pay_min"] ){
           $str = append_sql2($str, " and ", " wr_rent_deposit+wr_premium_o >= '$_GET[wr_sum_pay_min]' ");
         }elseif ($_GET["wr_sum_pay_max"] ){
           $str = append_sql2($str, " and ", " wr_rent_deposit+wr_premium_o <= '$_GET[wr_sum_pay_max]' ");
         }


    // else if($search_arr[name][$j] == "wr_rent_deposit") {
    //   echo"ddd";
    //   $str = append_sql2($str, " and ", " {$search_arr[name][$j]}  like '%{$search_arr[val][$j]}%' ");
    // }

    // 쿼리의 속도를 높이기 위하여 ( ) 는 최소화 한다.
    $op1 = "";

    // 검색어를 구분자로 나눈다. 여기서는 공백
    $s = array();

    $s = explode(" ", $search_text);
		if(count($s) > 0 && strlen($s[0]) > 0 ){

			if ($str)
        $str .= " and ";
    // 검색필드를 구분자로 나눈다. 여기서는 +
    //$field = array();
    //$field = explode("||", trim($search_field));
    $tmp = array();
    $tmp = explode(",", trim($search_field));
    $field = explode("||", $tmp[0]);
    $not_comment = $tmp[1];

    $str .= "(";
    for ($i=0; $i<count($s); $i++) {
        // 검색어
        $search_str = trim($s[$i]);
        if ($search_str == "") continue;

        // 인기검색어
				/*
        $sql = " insert into $g4[popular_table] set pp_word = '$search_str', pp_date = '$g4[time_ymd]', pp_ip = '$_SERVER[REMOTE_ADDR]' ";
        sql_query($sql, FALSE);
				*/
				if(count($field) > 0){
        $str .= $op1;
        $str .= "(";

        $op2 = "";
        for ($k=0; $k<count($field); $k++) { // 필드의 수만큼 다중 필드 검색 가능 (필드1+필드2...)
            $str .= $op2;
            switch ($field[$k]) {
                case "mb_id" :
                case "wr_name" :
                    $str .= " $field[$k] = '$s[$i]' ";
                    break;
                case "wr_hit" :
                case "wr_good" :
                case "wr_nogood" :
                    $str .= " $field[$k] >= '$s[$i]' ";
                    break;
                // 번호는 해당 검색어에 -1 을 곱함
                case "wr_num" :
                    $str .= "$field[$k] = ".((-1)*$s[$i]);
                    break;
								case "wr_5" :
								case "wr_6" :
                    $str .= "$field[$k] > ".((-1)*$s[$i]);
                    break;
                // LIKE 보다 INSTR 속도가 빠름
                default :
                    if (preg_match("/[a-zA-Z]/", $search_str))
                        $str .= "INSTR(LOWER($field[$k]), LOWER('$search_str'))";
                    else
                        $str .= "INSTR($field[$k], '$search_str')";
                    break;
            }
            $op2 = " or ";
        }
        $str .= ")";
				}

        //$op1 = ($search_operator) ? ' and ' : ' or ';
        $op1 = " $search_operator ";
    }

    $str .= " ) ";
		}
    if ($not_comment){
        $str .= " and wr_is_comment = '0' ";
		}

    return $str;
}

function append_sql2($sql, $appender, $text) {
	if(strlen($sql) > 0) {
		$sql = $sql.$appender.$text;
	} else {
		$sql = $text;
	}
	return $sql;
}
// 추가 및 변경 함수 끝

//$_GET[wr_9] = "1";

// print_r($_GET);
$arr_search = array();
  if(($_GET["wr_subject"])) {
    $arr_search[name][] = "wr_subject";
    $arr_search[val][] = $_GET["wr_subject"];
  }
	if(($_GET["wr_area_p"])) {
		$arr_search[name][] = "wr_area_p";
		$arr_search[val][] = $_GET["wr_area_p"];
	}
  if(($_GET["wr_sale_area"])) {
    $arr_search[name][] = "wr_sale_area";
    $arr_search[val][] = $_GET["wr_sale_area"];
  }

	if(($_GET["wr_floor"])) {
		$arr_search[name][] = "wr_floor";
		$arr_search[val][] = $_GET["wr_floor"];
	}
	if(($_GET["wr_rec_sectors"])) {
		$arr_search[name][] = "wr_rec_sectors";
		$arr_search[val][] = $_GET["wr_rec_sectors"];
	}


// print_r ($_POST);

	if(($_GET["wr_rent_deposit"])) {
		$arr_search[name][] = "wr_rent_deposit";
		$arr_search[val][] = $_GET["wr_rent_deposit"];
	}
	if(($_GET["wr_m_rate"])) {
		$arr_search[name][] = "wr_m_rate";
		$arr_search[val][] = $_GET["wr_m_rate"];
	}
  if(($_GET["wr_premium_o"])) {
		$arr_search[name][] = "wr_premium_o";
		$arr_search[val][] = $_GET["wr_premium_o"];
	}
  if(($_GET["wr_sale_area"])) {
		$arr_search[name][] = "wr_sale_area";
		$arr_search[val][] = $_GET["wr_sale_area"];
	}
  if(($_GET["wr_address"])) {
		$arr_search[name][] = "wr_address";
		$arr_search[val][] = $_GET["wr_address"];
	}



  if(($_GET["wr_office_permission"])) {
    $arr_search[name][] = "wr_office_permission";
    $arr_search[val][] = $_GET["wr_office_permission"];
  }

  if(($_GET["board_list"])) {
    $arr_search[name][] = "board_list";
    $arr_search[val][] = $_GET["board_list"];
  }

	if(($_GET["wr_sale_type"])) {
		$arr_search[name][] = "wr_sale_type";
		$arr_search[val][] = $_GET["wr_sale_type"];
	}
    if(($_GET["wr_sold_out"])) {
        $arr_search[name][] = "wr_sold_out";
        $arr_search[val][] = $_GET["wr_sold_out"];
    }
  if(($_GET["wr_writer"])) {
    $arr_search[name][] = "wr_writer";
    $arr_search[val][] = $_GET["wr_writer"];
  }
  if(($_GET["wr_writer_id"])) {
    $arr_search[name][] = "wr_writer_id";
    $arr_search[val][] = $_GET["wr_writer_id"];
  }
  if(($_POST["wr_writer"])) {
    $arr_search[name][] = "wr_writer";
    $arr_search[val][] = $_POST["wr_writer"];
  }
  if(($_GET["wr_important"])) {
    $arr_search[name][] = "wr_important";
    $arr_search[val][] = $_GET["wr_important"];
  }

  if(($_GET["wr_office_permisson"])) {
    $arr_search[name][] = "wr_office_permisson";
    $arr_search[val][] = $_GET["wr_office_permisson"];
  }
  if(($_GET["wr_bookmark"])) {
    $arr_search[name][] = "wr_bookmark";
    $arr_search[val][] = $_GET["wr_bookmark"];
  }




/* 뷰 시작 */
// 게시판에서 두단어 이상 검색 후 검색된 게시물에 코멘트를 남기면 나오던 오류 수정
$sop = strtolower($sop);
if ($sop != 'and' && $sop != 'or')
    $sop = 'and';

@include_once($board_skin_path.'/view.head.skin.php');

$sql_search = "";
// 검색이면
if ($sca || $stx || count($arr_search) > 0) {

    // where 문을 얻음
		$se_arr = array();
		$se_arr = $arr_search;

		$sql_search = get_sql_search3($sca, $sfl, $stx, $sop, $se_arr);

    $search_href = './board.php?bo_table='.$bo_table.'&amp;page='.$page.$qstr;
    $list_href = './board.php?bo_table='.$bo_table;
} else {
    $search_href = '';
    $list_href = './board.php?bo_table='.$bo_table.'&amp;page='.$page;
}

if (!$board['bo_use_list_view']) {
    if ($sql_search)
        $sql_search = " and " . $sql_search;

    // 윗글을 얻음
    // $sql = " select wr_id, wr_subject from {$write_table} where wr_is_comment = 0 and wr_num = '{$write['wr_num']}' and wr_reply < '{$write['wr_reply']}' {$sql_search} order by wr_num desc, wr_reply desc limit 1 ";
    $prev = sql_fetch($sql);
    // 위의 쿼리문으로 값을 얻지 못했다면
    if (!$prev['wr_id'])     {
        // $sql = " select wr_id, wr_subject from {$write_table} where wr_is_comment = 0 and wr_num < '{$write['wr_num']}' {$sql_search} order by wr_num desc, wr_reply desc limit 1 ";
        // $prev = sql_fetch($sql);
    }

    // 아래글을 얻음
    // $sql = " select wr_id, wr_subject from {$write_table} where wr_is_comment = 0 and wr_num = '{$write['wr_num']}' and wr_reply > '{$write['wr_reply']}' {$sql_search} order by wr_num, wr_reply limit 1 ";
    // $next = sql_fetch($sql);
    // 위의 쿼리문으로 값을 얻지 못했다면
    if (!$next['wr_id']) {
        // $sql = " select wr_id, wr_subject from {$write_table} where wr_is_comment = 0 and wr_num > '{$write['wr_num']}' {$sql_search} order by wr_num, wr_reply limit 1 ";
        // $next = sql_fetch($sql);
    }
}

// 이전글 링크
$prev_href = '';
if (isset($prev['wr_id']) && $prev['wr_id']) {
    $prev_wr_subject = get_text(cut_str($prev['wr_subject'], 255));
    $prev_href = './board.php?bo_table='.$bo_table.'&amp;wr_id='.$prev['wr_id'].$qstr;
}

// 다음글 링크
$next_href = '';
if (isset($next['wr_id']) && $next['wr_id']) {
    $next_wr_subject = get_text(cut_str($next['wr_subject'], 255));
    $next_href = './board.php?bo_table='.$bo_table.'&amp;wr_id='.$next['wr_id'].$qstr;
}

// 쓰기 링크
$write_href = '';
if ($member['mb_level'] >= $board['bo_write_level'])
    $write_href = './write.php?bo_table='.$bo_table;

// 답변 링크
$reply_href = '';
if ($member['mb_level'] >= $board['bo_reply_level'])
    $reply_href = './write.php?w=r&amp;bo_table='.$bo_table.'&amp;wr_id='.$wr_id.$qstr;

// 수정, 삭제 링크
$update_href = $delete_href = '';
// 로그인중이고 자신의 글이라면 또는 관리자라면 비밀번호를 묻지 않고 바로 수정, 삭제 가능
if (($member['mb_id'] && ($member['mb_id'] == $write['mb_id'])) || $is_admin) {
    $update_href = './write.php?w=u&amp;bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;page='.$page.$qstr;
    $delete_href = './delete.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;page='.$page.urldecode($qstr);
    if ($is_admin)
    {
        set_session("ss_delete_token", $token = uniqid(time()));
        $delete_href ='./delete.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;token='.$token.'&amp;page='.$page.urldecode($qstr);
    }
}
else if (!$write['mb_id']) { // 회원이 쓴 글이 아니라면
    $update_href = './password.php?w=u&amp;bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;page='.$page.$qstr;
    $delete_href = './password.php?w=d&amp;bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;page='.$page.$qstr;
}

// 최고, 그룹관리자라면 글 복사, 이동 가능
$copy_href = $move_href = '';
if ($write['wr_reply'] == '' && ($is_admin == 'super' || $is_admin == 'group')) {
    $copy_href = './move.php?sw=copy&amp;bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;page='.$page.$qstr;
    $move_href = './move.php?sw=move&amp;bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;page='.$page.$qstr;
}

$scrap_href = '';
$good_href = '';
$nogood_href = '';
if ($is_member) {
    // 스크랩 링크
    $scrap_href = './scrap_popin.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id;

    // 추천 링크
    if ($board['bo_use_good'])
        $good_href = './good.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;good=good';

    // 비추천 링크
    if ($board['bo_use_nogood'])
        $nogood_href = './good.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;good=nogood';
}

$view = get_view($write, $board, $board_skin_path);

if (strstr($sfl, 'subject'))
    $view['subject'] = search_font($stx, $view['subject']);

$html = 0;
if (strstr($view['wr_option'], 'html1'))
    $html = 1;
else if (strstr($view['wr_option'], 'html2'))
    $html = 2;

$view['content'] = conv_content($view['wr_content'], $html);
if (strstr($sfl, 'content'))
    $view['content'] = search_font($stx, $view['content']);

//$view['rich_content'] = preg_replace("/{이미지\:([0-9]+)[:]?([^}]*)}/ie", "view_image(\$view, '\\1', '\\2')", $view['content']);

$view['rich_content'] = @preg_replace_callback("/{이미지\:([0-9]+)[:]?([^}]*)}/i", "conv_rich_content", $view['content']);

$is_signature = false;
$signature = '';
if ($board['bo_use_signature'] && $view['mb_id']) {
    $is_signature = true;
    $mb = get_member($view['mb_id']);
    $signature = $mb['mb_signature'];

    $signature = conv_content($signature, 1);
}

/* 리스트 시작 */





$sop = strtolower($sop);
if ($sop != 'and' && $sop != 'or')
    $sop = 'and';

// 분류 선택 또는 검색어가 있다면
$stx = trim($stx);
if ($sca || $stx || count($arr_search) > 0) {


		$se_arr = array();
		$se_arr = $arr_search;

		$sql_search = get_sql_search3($sca, $sfl, $stx, $sop, $se_arr);

    // 가장 작은 번호를 얻어서 변수에 저장 (하단의 페이징에서 사용)
    $sql = " select MIN(wr_num) as min_wr_num from {$write_table}  ";
    $row = sql_fetch($sql);
    $min_spt = (int)$row['min_wr_num'];

    if (!$spt) $spt = $min_spt;

    $sql_search .= " and (wr_num between {$spt} and ({$spt} + {$config['cf_search_part']})) ";

	// 원글만 얻는다. (코멘트의 내용도 검색하기 위함)
	  $sql = " select  wr_parent from {$write_table} where {$sql_search} ";
    $result = sql_query($sql);
    $total_count = mysqli_num_rows($result);
} else {
    $sql_search = "";

    $total_count = $board['bo_count_write'];
}


if(G5_IS_MOBILE) {
    $page_rows = $board['bo_mobile_page_rows'];
    $list_page_rows = $board['bo_mobile_page_rows'];
} else {
    $page_rows = $board['bo_page_rows'];
    $list_page_rows = $board['bo_page_rows'];
}

if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)

// 년도 2자리
$today2 = G5_TIME_YMD;

$list = array();
$i = 0;
$notice_count = 0;
$notice_array = array();


$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함


// 관리자라면 CheckBox 보임
$is_checkbox = false;
if ($is_member && ($is_admin == 'super' || $group['gr_admin'] == $member['mb_id'] || $board['bo_admin'] == $member['mb_id']))
    $is_checkbox = true;

// 정렬에 사용하는 QUERY_STRING
$qstr2 = 'bo_table='.$bo_table.'&amp;sop='.$sop;

// 0 으로 나눌시 오류를 방지하기 위하여 값이 없으면 1 로 설정
$bo_gallery_cols = $board['bo_gallery_cols'] ? $board['bo_gallery_cols'] : 1;
$td_width = (int)(100 / $bo_gallery_cols);

// 정렬
// 인덱스 필드가 아니면 정렬에 사용하지 않음
//if (!$sst || ($sst && !(strstr($sst, 'wr_id') || strstr($sst, "wr_datetime")))) {
if (!$sst) {
    if ($board['bo_sort_field']) {
        $sst = $board['bo_sort_field'];
    } else {
        $sst  = "wr_num, wr_reply";
        $sod = "";
    }
} else {
    // 게시물 리스트의 정렬 대상 필드가 아니라면 공백으로 (nasca 님 09.06.16)
    // 리스트에서 다른 필드로 정렬을 하려면 아래의 코드에 해당 필드를 추가하세요.
    // $sst = preg_match("/^(wr_subject|wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
    $sst = preg_match("/^(wr_datetime|wr_hit|wr_good|wr_nogood|coco|wr_9)$/i", $sst) ? $sst : "";
}

if ($sst) {
    $sql_order = " order by {$sst} {$sod} ";
}
if($wr_rent_deposit_min || $wr_rent_deposit_max){
	$sql_order = " order by wr_id desc ";
}


if($_GET[wr_floor_min] ||$_GET[wr_floor_max]){
	$sql_order = " order by wr_id desc ";
}
if($_GET[wr_m_rate_min] ||$_GET[wr_m_rate_max]){
	$sql_order = " order by wr_id desc ";
}
if($_GET[wr_area_p_min] || $_GET[wr_area_p_max]){
	$sql_order = " order by wr_id desc ";
}

if($_GET[wr_premium_o_min] || $_GET[wr_premium_o_max]){
	$sql_order = " order by wr_id desc ";
}

// 기본 리스트 쿼리 !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
if ($sca || $stx || count($arr_search) > 0) {
    if($wr_sold_out == '1'){
        $sql = " select wr_id wr_parent from {$write_table} where {$sql_search} {$sql_order} limit {$from_record}, $page_rows "; 
    }else{
     $sql = " select wr_id wr_parent from {$write_table} where {$sql_search} {$sql_order} limit {$from_record}, $page_rows ";
    }
} else {
    $sql = " select * from {$write_table} where wr_is_comment = 0 ";
    if(!empty($notice_array))
        $sql .= " and wr_id not in (".implode(', ', $notice_array).") ";
    $sql .= " {$sql_order} limit {$from_record}, $page_rows ";
}

// 페이지의 공지개수가 목록수 보다 작을 때만 실행
if($page_rows > 0) {
    $result = sql_query($sql);

    $k = 0;

    while ($row = sql_fetch_array($result))
    {
        // 검색일 경우 wr_id만 얻었으므로 다시 한행을 얻는다
        if ($sca || $stx || count($arr_search) > 0)
            $row = sql_fetch(" select * from {$write_table} a, g5_member b where a.wr_id = '{$row['wr_parent']}' ");

        $list[$i] = get_list($row, $board, $board_skin_url,$member, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
        if (strstr($sfl, 'subject')) {
            $list[$i]['subject'] = search_font($stx, $list[$i]['subject']);
        }
        $list[$i]['is_notice'] = false;
        $list_num = $total_count - ($page - 1) * $list_page_rows - $notice_count;
        $list[$i]['num'] = $list_num - $k;

        $i++;
        $k++;
    }
}

// if ($gr_admin && $wr_important == "1" && $wr_office_permission == "2"){
// $write_pages = get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './board.php?bo_table='.$bo_table.$qstr.'&board_list='.$board_list.'&wr_important='.$wr_important.'&wr_sale_type='.$wr_sale_type.'&wr_office_permission=2&wr_subject='.$wr_subject.'&wr_sale_area='.$wr_sale_area.'&wr_floor='.$wr_floor.'&wr_floor_min='.$wr_floor_min.'&wr_address='.$wr_address.'&wr_writer='.$wr_writer.'&wr_floor_max='.$wr_floor_max.'&wr_area_p_min='.$wr_area_p_min.'&wr_area_p_max='.$wr_area_p_max.'&wr_rent_deposit_min='.$wr_rent_deposit_min.'&wr_rent_deposit_max='.$wr_rent_deposit_max.'&wr_m_rate_min='.$wr_m_rate_min.'&wr_m_rate_max='.$wr_m_rate_max.'&wr_premium_o_min='.$wr_premium_o_min.'&wr_premium_o_max='.$wr_premium_o_max.
// '&wr_rec_sectors='.$wr_rec_sectors.'&amp;page=');
// }
if($gr_admin && $wr_important == '2'){
    $write_pages = get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './board.php?bo_table='.$bo_table.$qstr.'&board_list='.$board_list.'&wr_important='.$wr_important.'&wr_sale_type='.$wr_sale_type.'&wr_subject='.$wr_subject.'&wr_sale_area='.$wr_sale_area.'&wr_floor='.$wr_floor.'&wr_floor_min='.$wr_floor_min.'&wr_office_permission=0&wr_address='.$wr_address.'&wr_writer_id='.$wr_writer_id.'&wr_floor_max='.$wr_floor_max.'&wr_area_p_min='.$wr_area_p_min.'&wr_area_p_max='.$wr_area_p_max.'&wr_rent_deposit_min='.$wr_rent_deposit_min.'&wr_rent_deposit_max='.$wr_rent_deposit_max.'&wr_m_rate_min='.$wr_m_rate_min.'&wr_m_rate_max='.$wr_m_rate_max.'&wr_premium_o_min='.$wr_premium_o_min.'&wr_premium_o_max='.$wr_premium_o_max.'&wr_sum_pay_min='.$wr_sum_pay_min.'&wr_sum_pay_max='.$wr_sum_pay_max.
    '&wr_rec_sectors='.$wr_rec_sectors.'&amp;page=');
}

if($gr_admin && $wr_important == '1'){
    $write_pages = get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './board.php?bo_table='.$bo_table.$qstr.'&board_list='.$board_list.'&wr_important='.$wr_important.'&wr_sale_type='.$wr_sale_type.'&wr_subject='.$wr_subject.'&wr_sale_area='.$wr_sale_area.'&wr_floor='.$wr_floor.'&wr_floor_min='.$wr_floor_min.'&wr_office_permission='.$wr_office_permission.'&wr_address='.$wr_address.'&wr_writer='.$wr_writer.'&wr_writer_id='.$wr_writer_id.'&wr_floor_max='.$wr_floor_max.'&wr_area_p_min='.$wr_area_p_min.'&wr_area_p_max='.$wr_area_p_max.'&wr_rent_deposit_min='.$wr_rent_deposit_min.'&wr_rent_deposit_max='.$wr_rent_deposit_max.'&wr_m_rate_min='.$wr_m_rate_min.'&wr_m_rate_max='.$wr_m_rate_max.'&wr_premium_o_min='.$wr_premium_o_min.'&wr_premium_o_max='.$wr_premium_o_max.'&wr_sum_pay_min='.$wr_sum_pay_min.'&wr_sum_pay_max='.$wr_sum_pay_max.
    '&wr_rec_sectors='.$wr_rec_sectors.'&amp;page=');
}


else if($gr_admin && $wr_sold_out == '1'){
$write_pages = get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './board.php?bo_table='.$bo_table.$qstr.'&board_list='.$board_list.'&wr_important='.$wr_important.'&wr_sale_type='.$wr_sale_type.'&wr_sold_out='.$wr_sold_out.'&wr_subject='.$wr_subject.'&wr_sale_area='.$wr_sale_area.'&wr_floor='.$wr_floor.'&wr_floor_min='.$wr_floor_min.'&wr_office_permission=0&wr_address='.$wr_address.'&wr_writer_id='.$wr_writer_id.'&wr_floor_max='.$wr_floor_max.'&wr_area_p_min='.$wr_area_p_min.'&wr_area_p_max='.$wr_area_p_max.'&wr_rent_deposit_min='.$wr_rent_deposit_min.'&wr_rent_deposit_max='.$wr_rent_deposit_max.'&wr_m_rate_min='.$wr_m_rate_min.'&wr_m_rate_max='.$wr_m_rate_max.'&wr_premium_o_min='.$wr_premium_o_min.'&wr_premium_o_max='.$wr_premium_o_max.'&wr_sum_pay_min='.$wr_sum_pay_min.'&wr_sum_pay_max='.$wr_sum_pay_max.
'&wr_rec_sectors='.$wr_rec_sectors.'&amp;page=');
} 

else if(!$gr_admin && $wr_important == '2'){
$write_pages = get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './board.php?bo_table='.$bo_table.$qstr.'&board_list='.$board_list.'&wr_important='.$wr_important.'&wr_sale_type='.$wr_sale_type.'&wr_sold_out='.$wr_sold_out.'&wr_subject='.$wr_subject.'&wr_sale_area='.$wr_sale_area.'&wr_floor='.$wr_floor.'&wr_floor_min='.$wr_floor_min.'&wr_address='.$wr_address.'&wr_writer_id='.$wr_writer_id.'&wr_floor_max='.$wr_floor_max.'&wr_area_p_min='.$wr_area_p_min.'&wr_area_p_max='.$wr_area_p_max.'&wr_rent_deposit_min='.$wr_rent_deposit_min.'&wr_rent_deposit_max='.$wr_rent_deposit_max.'&wr_m_rate_min='.$wr_m_rate_min.'&wr_m_rate_max='.$wr_m_rate_max.'&wr_premium_o_min='.$wr_premium_o_min.'&wr_premium_o_max='.$wr_premium_o_max.'&wr_sum_pay_min='.$wr_sum_pay_min.'&wr_sum_pay_max='.$wr_sum_pay_max.
'&wr_rec_sectors='.$wr_rec_sectors.'&amp;page=');
 
}else if(!$gr_admin && $wr_important == '1' && $wr_office_permission == '1'){
    $write_pages = get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './board.php?bo_table='.$bo_table.$qstr.'&board_list='.$board_list.'&wr_important='.$wr_important.'&wr_sale_type='.$wr_sale_type.'&wr_subject='.$wr_subject.'&wr_sale_area='.$wr_sale_area.'&wr_floor='.$wr_floor.'&wr_floor_min='.$wr_floor_min.'&wr_office_permission=1&wr_address='.$wr_address.'&wr_writer_id='.$wr_writer_id.'&wr_floor_max='.$wr_floor_max.'&wr_area_p_min='.$wr_area_p_min.'&wr_area_p_max='.$wr_area_p_max.'&wr_rent_deposit_min='.$wr_rent_deposit_min.'&wr_rent_deposit_max='.$wr_rent_deposit_max.'&wr_m_rate_min='.$wr_m_rate_min.'&wr_m_rate_max='.$wr_m_rate_max.'&wr_premium_o_min='.$wr_premium_o_min.'&wr_premium_o_max='.$wr_premium_o_max.'&wr_sum_pay_min='.$wr_sum_pay_min.'&wr_sum_pay_max='.$wr_sum_pay_max.
    '&wr_rec_sectors='.$wr_rec_sectors.'&amp;page=');

}else if(!$gr_admin && $wr_important == '1'){
$write_pages = get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './board.php?bo_table='.$bo_table.$qstr.'&board_list='.$board_list.'&wr_important='.$wr_important.'&wr_sale_type='.$wr_sale_type.'&wr_subject='.$wr_subject.'&wr_sale_area='.$wr_sale_area.'&wr_floor='.$wr_floor.'&wr_floor_min='.$wr_floor_min.'&wr_office_permission=2&wr_address='.$wr_address.'&wr_writer='.$wr_writer.'&wr_writer_id='.$wr_writer_id.'&wr_floor_max='.$wr_floor_max.'&wr_area_p_min='.$wr_area_p_min.'&wr_area_p_max='.$wr_area_p_max.'&wr_rent_deposit_min='.$wr_rent_deposit_min.'&wr_rent_deposit_max='.$wr_rent_deposit_max.'&wr_m_rate_min='.$wr_m_rate_min.'&wr_m_rate_max='.$wr_m_rate_max.'&wr_premium_o_min='.$wr_premium_o_min.'&wr_premium_o_max='.$wr_premium_o_max.'&wr_sum_pay_min='.$wr_sum_pay_min.'&wr_sum_pay_max='.$wr_sum_pay_max.
'&wr_rec_sectors='.$wr_rec_sectors.'&amp;page=');


}else{
    $write_pages = get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './board.php?bo_table='.$bo_table.$qstr.'&board_list='.$board_list.'&wr_important='.$wr_important.'&wr_sale_type='.$wr_sale_type.'&wr_sold_out='.$wr_sold_out.'&wr_subject='.$wr_subject.'&wr_sale_area='.$wr_sale_area.'&wr_floor='.$wr_floor.'&wr_floor_min='.$wr_floor_min.'&wr_address='.$wr_address.'&wr_writer='.$wr_writer.'&wr_writer_id='.$wr_writer_id.'&wr_floor_max='.$wr_floor_max.'&wr_area_p_min='.$wr_area_p_min.'&wr_area_p_max='.$wr_area_p_max.'&wr_rent_deposit_min='.$wr_rent_deposit_min.'&wr_rent_deposit_max='.$wr_rent_deposit_max.'&wr_m_rate_min='.$wr_m_rate_min.'&wr_m_rate_max='.$wr_m_rate_max.'&wr_premium_o_min='.$wr_premium_o_min.'&wr_premium_o_max='.$wr_premium_o_max.'&wr_sum_pay_min='.$wr_sum_pay_min.'&wr_sum_pay_max='.$wr_sum_pay_max.
    '&wr_rec_sectors='.$wr_rec_sectors.'&amp;page=');
}
$list_href = '';
$prev_part_href = '';
$next_part_href = '';
if ($sca || $stx || count($arr_search) > 0) {
    $list_href = './board.php?bo_table='.$bo_table;

    //if ($prev_spt >= $min_spt)
    $prev_spt = $spt - $config['cf_search_part'];
    if (isset($min_spt) && $prev_spt >= $min_spt) {
        $prev_part_href = './board.php?bo_table='.$bo_table.$qstr.'&amp;spt='.$prev_spt.'&amp;page=1';
        $write_pages = page_insertbefore($write_pages, '<a href="'.$prev_part_href.'" class="pg_page pg_prev">이전검색</a>');
    }

    $next_spt = $spt + $config['cf_search_part'];
    if ($next_spt < 0) {
        $next_part_href = './board.php?bo_table='.$bo_table.$qstr.'&amp;spt='.$next_spt.'&amp;page=1';
        $write_pages = page_insertafter($write_pages, '<a href="'.$next_part_href.'" class="pg_page pg_end">다음검색</a>');
    }
}

$list_href = './board.php?bo_table='.$bo_table.'&amp;page='.$page;

$write_href = '';
if ($member['mb_level'] >= $board['bo_write_level']) {
    $write_href = './write.php?bo_table='.$bo_table;
}

$nobr_begin = $nobr_end = "";
if (preg_match("/gecko|firefox/i", $_SERVER['HTTP_USER_AGENT'])) {
    $nobr_begin = '<nobr>';
    $nobr_end   = '</nobr>';
}

// RSS 보기 사용에 체크가 되어 있어야 RSS 보기 가능 061106
$rss_href = '';
if ($board['bo_use_rss_view']) {
    $rss_href = './rss.php?bo_table='.$bo_table;
}

$stx = get_text(stripslashes($stx));

/* 리스트 끝 */
/* 뷰 끝 */
?>

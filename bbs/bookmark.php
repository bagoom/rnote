<?php
include_once('./_common.php');
$mobile_main = 2;

if (G5_IS_MOBILE){
include_once(G5_THEME_MOBILE_PATH.'/head.php');
}
else
include_once(G5_PATH.'/head.sub.php');

if (!$board['bo_table']) {
   alert('회원가입후 이용해주세요.', G5_URL);
}
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
    $sql5 = ("update {$write_table}
                set wr_bookmark = '1' where wr_id =$wr_id_list[$i]");
    sql_query($sql5);
    // echo $wr_id_list[$i] ;
}

if(G5_IS_MOBILE) {
    $page_rows = $board['bo_mobile_page_rows'];
    $list_page_rows = $board['bo_mobile_page_rows'];
} else {
    $page_rows = 25;
    $list_page_rows = $board['bo_page_rows'];
}

if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)

// 년도 2자리
$today2 = G5_TIME_YMD;

$list = array();
$i = 0;
$notice_count = 0;
$notice_array = array();
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함
if(!$sst)
    $sst  = "wr_num, wr_reply";

if ($sst) {
    $sql_order = " order by {$sst} {$sod} ";
}
    $sql = " select * from {$write_table} where wr_bookmark = 1 ";
    $sql .= " {$sql_order} limit {$from_record}, $page_rows ";


// 페이지의 공지개수가 목록수 보다 작을 때만 실행

    $result = sql_query($sql);

    while ($row = sql_fetch_array($result))
    {
        // 검색일 경우 wr_id만 얻었으므로 다시 한행을 얻는다
        if ($sca || $stx)
            $row = sql_fetch(" select * from {$write_table} where wr_id = '{$row['wr_parent']}' ");

        $list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);

        $list[$i]['is_notice'] = false;
        $list_num = $total_count - ($page - 1) * $list_page_rows - $notice_count;
        $list[$i]['num'] = $list_num - $k;

        $i++;
    }
include_once($board_skin_path.'/bookmark.skin.php');


if (G5_IS_MOBILE) {
  include_once(G5_THEME_MOBILE_PATH.'/tail.php');
}else{
// include_once(G5_PATH.'/tail.sub.php');
}
?>

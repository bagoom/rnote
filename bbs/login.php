<?php
include_once('./_common.php');

$g5['title'] = '로그인';
if (G5_IS_MOBILE){
include_once(G5_THEME_MOBILE_PATH.'/head_sub.php');
}
else
include_once(G5_PATH.'/head.sub.php');

$url = $_GET['url'];

// url 체크
check_url_host($url);

// 이미 로그인 중이라면
if ($is_member) {
    if ($url)
        goto_url(G5_URL);
    else
        goto_url(G5_URL);
}

// $login_url        = login_url(G5_URL."/bbs/board.php?bo_table=$member[mb_id]");
$login_action_url = G5_HTTPS_BBS_URL."/login_check.php";

// 로그인 스킨이 없는 경우 관리자 페이지 접속이 안되는 것을 막기 위하여 기본 스킨으로 대체
$login_file = $member_skin_path.'/login.skin.php';
if (!file_exists($login_file))
    $member_skin_path   = G5_SKIN_PATH.'/member/basic';
include_once($member_skin_path.'/login.skin.php');


if (G5_IS_MOBILE){
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
}
else
include_once('/tail.sub.php');
?>

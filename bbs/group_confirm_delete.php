<?php
include_once('./_common.php');


// 수정, 삭제 링크
$update_href = $delete_href = "";
// 로그인중이고 자신의 글이라면 또는 관리자라면 패스워드를 묻지 않고 바로 수정, 삭제 가능
if (($member[mb_id] && ($member[mb_id] == $write[mb_id])) || $is_admin == 'group') {
    $delete_href = "javascript:del('./gr_member_delete.php?bo_table=$bo_table&mb_id=$row[mb_id]&page=$page".urldecode($qstr)."');";
    if ($is_admin)
    {
        set_session("ss_delete_token", $token = uniqid(time()));
        $delete_href = "javascript:del('./delete.php?bo_table=$bo_table&wr_id=$wr_id&token=$token&page=$page".urldecode($qstr)."');";
    }
}


$delete_token = get_session('ss_delete_token');
set_session('ss_delete_token', '');

if (!($token && $delete_token == $token))
    alert('토큰 에러로 삭제 불가합니다.');

//$wr = sql_fetch(" select * from $write_table where wr_id = '$wr_id' ");

@include_once($board_skin_path.'/delete.head.skin.php');

if ($is_admin == 'super') // 최고관리자 통과
    ;
else if ($is_admin == 'group') { // 그룹관리자
    $mb = get_member($write['mb_id']);
    if ($member['mb_id'] != $group['gr_admin']) // 자신이 관리하는 그룹인가?
        alert('자신이 관리하는 그룹의 게시판이 아니므로 삭제할 수 없습니다.');
    else if ($member['mb_level'] < $mb['mb_level']) // 자신의 레벨이 크거나 같다면 통과
        alert('자신의 권한보다 높은 권한의 회원이 작성한 글은 삭제할 수 없습니다.');
} else if ($is_admin == 'board') { // 게시판관리자이면
    $mb = get_member($write['mb_id']);
    if ($member['mb_id'] != $board['bo_admin']) // 자신이 관리하는 게시판인가?
        alert('자신이 관리하는 게시판이 아니므로 삭제할 수 없습니다.');
    else if ($member['mb_level'] < $mb['mb_level']) // 자신의 레벨이 크거나 같다면 통과
        alert('자신의 권한보다 높은 권한의 회원이 작성한 글은 삭제할 수 없습니다.');
} else if ($member['mb_id']) {
    if ($member['mb_id'] != $write['mb_id'])
        alert('자신의 글이 아니므로 삭제할 수 없습니다.');
} else {
    if ($write['mb_id'])
        alert('로그인 후 삭제하세요.', './login.php?url='.urlencode('./board.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id));
    else if (!check_password($wr_password, $write['wr_password']))
        alert('비밀번호가 틀리므로 삭제할 수 없습니다.');
}

// 나라오름님 수정 : 원글과 코멘트수가 정상적으로 업데이트 되지 않는 오류를 잡아 주셨습니다.
//$sql = " select wr_id, mb_id, wr_comment from $write_table where wr_parent = '$write[wr_id]' order by wr_id ";


// 게시글 삭제
sql_query(" update g5_member set mb_2 = NULL where mb_id = '$mb_id' ");
alert('직원가입 승인이 거절되었습니다.');
goto_url(G5_HTTP_BBS_URL.'/group_confirm.php?bo_table=ekdna8284');
?>

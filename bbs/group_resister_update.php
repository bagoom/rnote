<?php
include_once('./_common.php');

?>
<!-- 회원가입결과 시작 { -->


<?php
// alert('신청이 완료 되었습니다.');
// $sql = " select count(*) as cnt
//             from {$g5['member_table']}
//             where mb_1 = '{$gr_id}' and mb_2 ='success' ";
// $row = sql_fetch($sql);
// if ($row['cnt']) {
//     alert('이미 가입되어 있습니다.');
// }
// else{
$person = $member['mb_id'];

$sql = "update {$g5['member_table']}
                 set mb_1 = '{$gr_id}',
                 mb_2 = '{$mb_2}',
                 mb_7 = '".G5_TIME_YMDHIS."'
                 where mb_id = '$person' ";
     sql_query($sql);
// }
goto_url(G5_URL);
?>
<!-- <div id="reg_result" class="mbskin">

    <p>
        <strong><?php echo $member['mb_name'] ?></strong>님의 <strong>'<?=$gr_name?>'</strong> 회원가입을 진심으로 축하합니다.<br>
    </p>
    <p>
        회원님의 비밀번호는 아무도 알 수 없는 암호화 코드로 저장되므로 안심하셔도 좋습니다.<br>
        아이디, 비밀번호 분실시에는 회원가입시 입력하신 이메일 주소를 이용하여 찾을 수 있습니다.
    </p>
    <p>
        회원 탈퇴는 언제든지 가능하며 일정기간이 지난 후, 회원님의 정보는 삭제하고 있습니다.<br>
        감사합니다.
    </p>
    <div class="btn_confirm">
        <h3><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=<?php echo $bo_table?>" class="btn02">해당 업체 노트로 가기</a></h3>
    </div>

</div> -->

<!-- } 회원가입결과 끝 -->
<!-- } 회원 전용 게시판 생성 -->

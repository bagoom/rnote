<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_PATH.'/_common.php');
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$outlogin_skin_url.'/style.css">', 0);
?>
<style>
.visual_contents{
  top:230px;
}
#ol_after_private{
  width: 80%;
  margin: 0 auto;
  padding:10px;
  text-align: center;
  font-size: 18px;
  color: #fff;
  /*border : 1px solid #fff;*/
}
#ol_after{
  overflow: hidden;
}
#ol_after_private a{
  color:#fff;
  text-align: center;
}
#ol_after_ft {
  width: 298px;
  margin: 0 auto;
  padding:20px 0;
}
#ol_after_ft a{
  width: 50%;
  float: left;
  margin-bottom: 15px;
  height: 50px;
  line-height: 50px;
  font-size: 16px;
  text-align: center;
  color: #fff !important;
  border: 1px solid #fff;

}
input[type=button]{
  width: 100%;
  height:50px;
  background: transparent;
  color: #fff;

}
</style>
<!-- 로그인 후 아웃로그인 시작 { -->
<section id="ol_after" class="ol">
<?
$gr_mb = sql_fetch(" select * from {$g5['group_member_table']} where mb_id = '$member[mb_id]' ");
$gr_cp = $gr_mb['gr_id'];
?>
    <header id="ol_after_hd">
        <?php if ($is_admin == 'super' || $is_auth) {  ?><a href="<?php echo G5_ADMIN_URL ?>" class="btn_admin">관리자 모드</a><?php }  ?>
    </header>
    <ul id="ol_after_private">
      <h3 style="margin-top:10px;"><strong><?php echo $nick ?>님</strong> 환영합니다!</h3>
    </ul>
    <footer id="ol_after_ft">
      <? if(!$gr_cp && $gr_mb){ ?>
        <a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=register_form.php" id="ol_after_info" style="border-right:0;">정보수정</a>
        <?}else{?>
          <a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=register_form_default.php" id="ol_after_info" style="border-right:0;">정보수정</a>
          <?}?>
        <a href="<?php echo G5_BBS_URL ?>/logout.php" id="ol_after_logout">로그아웃</a>
    </footer>
</section>

<script>
// 탈퇴의 경우 아래 코드를 연동하시면 됩니다.
function member_leave()
{
    if (confirm("정말 회원에서 탈퇴 하시겠습니까?"))
        location.href = "<?php echo G5_BBS_URL ?>/member_confirm.php?url=member_leave.php";
}
</script>
<!-- } 로그인 후 아웃로그인 끝 -->

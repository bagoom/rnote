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
  border: .5px solid #fff;

}
input[type=submit]{
  width: 48%;
  height: 40px;
  margin-top: 20px;
  border:.5px solid #fff;
  background: #1c2975;
  border-radius: 50px;
  box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.19);
  border:none;
  color: rgba(255,255,255,0.75);
  margin-right: 4%;
  float:left;
}
input[type=button]{
    width: 48% !important;
    height: 40px;
  background: transparent;
  margin-top: 20px;
  border-radius: 50px; 
  color: #fff;
  background: #1c2975;
  border-radius: 50px;
  box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.19);
  border:none !important;
  color: rgba(255,255,255,0.75);
  float:left;
}
.visual_contents{
  margin-top: 230px;
}
 h3.repre_title{
  margin-top: 35px;
  margin-bottom: 30px;
  font-size: 35px; 
  font-weight: bolder;
  letter-spacing: 0.05em;
  color: #fff;
  text-align:center;
}
.slider div{
  cursor: pointer;
}
.slider{
  width: 50%;
  margin: 0 auto;
}

</style>
<!-- 로그인 후 아웃로그인 시작 { -->
               <!-- <h3 class="repre_title">대표부동산설정</h3>
                <section class="center slider">
                <div >원룸</div>
                <div>아파트/오피스텔</div>
                <div>상가</div>
                <div>토지</div>
                </section> -->


<section id="ol_after" class="ol">
<?
$gr_mb = sql_fetch(" select * from {$g5['group_member_table']} where mb_id = '$member[mb_id]' ");
$gr_cp = $gr_mb['gr_id'];
?>
    <header id="ol_after_hd">
        <?php if ($is_admin == 'super' || $is_auth) {  ?><a href="<?php echo G5_ADMIN_URL ?>" class="btn_admin">관리자 모드</a><?php }  ?>
    </header>
    <ul id="ol_after_private">
      <h3 style="margin-top:10px; font-size:20px;"><strong><?php echo $nick ?>님</strong> 환영합니다!</h3>
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

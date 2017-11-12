<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<style>
.black-bg{
  background: #222 !important;
  margin-top: 0 !important;
  padding: 0!important;
}
.wrapper{
  background: url(../../img/resister_img/register_bg.jpg);
  background-size: cover;
  overflow: hidden;
}
input[type=text],input[type=password]{
  width: 250px !important;
  height: 50px;
  float:left;
  text-align: center;
  font-size: 22px;
  font-weight: bold;
  color: #fff;
  background: transparent;
  border:1px solid #fff;
  text-align: center;
  font-family: dotum;
  margin: 0 auto;
}
.btn_submit{
  width: 100px;
  height: 50px;
  float:left;
  background: #3b4db7;
  border:1px solid #fff;
  border-left: 0;
}
.btn_confirm{
  margin-top: 20px;
}
.btn_confirm a{
  font-size: 20px;
  padding-top: 10px;
  color:#fff;
}
fieldset{
  width: 350px;
  margin: 0 auto;
}
</style>
<!-- 회원 비밀번호 확인 시작 { -->
<div id="mb_confirm" class="mbskin" style="color:#fff; padding-top: 200px;">
    <h1><?php echo $g5['title'] ?></h1>

    <p>
        <strong style="font-size:15px; ">비밀번호를 한번 더 입력해주세요.</strong><br>
        <?php if ($url == 'member_leave.php') { ?>
        비밀번호를 입력하시면 회원탈퇴가 완료됩니다.
        <?php }else{ ?>
        <p>회원님의 정보를 안전하게 보호하기 위해 비밀번호를 한번 더 확인합니다. </p>
        <?php }  ?>
    </p>

    <form name="fmemberconfirm" action="<?php echo $url ?>" onsubmit="return fmemberconfirm_submit(this);" method="post">
    <input type="hidden" name="mb_id" value="<?php echo $member['mb_id'] ?>">
    <input type="hidden" name="w" value="u">

    <fieldset>

        <input type="password" name="mb_password" id="confirm_mb_password" required class="required frm_input" size="15" maxLength="20" style="font-family:dotum">

        <input type="submit" value="확인" id="btn_submit" class="btn_submit">
    </fieldset>

    </form>

    <div class="btn_confirm">
        <a href="<?php echo G5_URL ?>">메인으로 돌아가기</a>
    </div>

</div>

<script>
$("#mb_confirm").css("height",$(document).height() + 251);
function fmemberconfirm_submit(f)
{
    document.getElementById("btn_submit").disabled = true;

    return true;
}
</script>
<!-- } 회원 비밀번호 확인 끝 -->

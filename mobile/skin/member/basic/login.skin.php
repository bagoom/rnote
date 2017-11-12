<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<style>
#mb_login{
  overflow: hidden;
  background: #3b4db7;
  padding-top: 80px;
}
#login_frm{
  width: 70%;
  margin: 20px auto;
}
.title{
  width: 180px;
  margin: 0 auto;
}
.title img{
  width: 100%;
}
input[type=text],input[type=password]{
  width: 100%;
  height: 60px;
  border:2px solid rgba(255,255,255,1);
  border-radius: 33px;
  text-align: center;
  color: #fff;
  font-size: 25px;
  margin-bottom: 10px;
  background: transparent;
}
.btn_submit{
  width: 100%;
  height: 50px;
  margin: 0 auto;
  text-align: center;
  border:0;
  color: #3b4db7;
  font-size: 18px;
  font-weight: bold;
  margin-top: 10px;

  background: rgba(255,255,255,1);
  box-shadow: 0 0 13px rgba(0,0,0,0.25)!important;

}
a.btn_submit{
  display: block;
  line-height: 50px;
}
p.holder {
width: 100%;
line-height: 60px;
position: absolute;
color: #fff;
padding-left: 20px;
cursor: auto;
font-size: 11pt;
z-index: 1;
}
</style>
<div id="mb_login" class="mbskin">
  <div class="title">  <img src="<? G5_URL?>/img/mobile/mobile_login_logo.png"></div>


    <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
    <input type="hidden" name="url" value="<?php echo $login_url ?>">

    <div id="login_frm">
      <p class="holder">아이디</p>
        <input type="text" name="mb_id" id="login_id" required class="frm_input required" maxLength="20">
        <p class="holder">비밀번호</p>
        <input type="password" name="mb_password" id="login_pw"  required class="frm_input required" maxLength="20">
        <input type="submit" value="로그인" class="btn_submit">
        <a href="./register.php" class="btn_submit" >회원 가입</a>

        <!-- <div>
            <input type="checkbox" name="auto_login" id="login_auto_login">
            <label for="login_auto_login">자동로그인</label>
        </div> -->
    </div>

    <!-- <section>
            <a href="<?php echo G5_BBS_URL ?>/password_lost.php" target="_blank" id="login_password_lost" class="btn02">아이디 비밀번호 찾기</a>
    </section> -->


    </form>

</div>
<script>
$(function(){
    $("#login_auto_login").click(function(){
        if (this.checked) {
            this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
        }
    });
});

$(function() {
    $("p.holder + input").focus(function() {
        if(!$(this).val().length) {
            $(this).prev('p.holder').hide(200);
        } else {
            $(this).prev('p.holder').show(200);
        }
    });
    $("p.holder + input").blur(function() {
        if(!$(this).val().length) {
            $(this).prev('p.holder').show(200);
        } else {
            $(this).prev('p.holder').hide(200);
        }
    });
    $("p.holder").click(function() {
        $(this).next().focus();
    });
    $("p.holder + input").focus( function() {
        $(this).prev('p.holder').addClass('active');
    }).blur(function() {
        $(this).prev('p.holder').removeClass('active');
    });
});


function flogin_submit(f)
{
    return true;
}
$("#mb_login").css("height", $(document).height() );
</script>

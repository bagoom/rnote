<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$outlogin_skin_url.'/style.css">', 0);
?>
<style>

#ol_before{
  width: 300px;
  margin: 0 auto;
  text-align: center;
}
fieldset{
  position: relative;
  border: 1px solid rgba(255,255,255,0.6);
  border-bottom: 0;
}
#ol_before h5{
  color: #fff;
}
input[type=text],input[type=password]{
  width: 80% !important;
  height: 50px;
  text-align: center;
  font-size: 22px;
  font-weight: bold;
  color: #fff;
  background: transparent;
  border:0;
  text-align: center;
  font-family: dotum;
  display: block;
  margin: 0 auto;
}
input[type=submit]{
  width: 100%;
  height: 50px;
  background: rgba(255,255,255,1);
  font-size: 18px;
  font-weight: bold;
  color: #444;
  border: none;
}
input[type=button]{
  width: 100%;
  height:50px;
  background: transparent;
  color: #fff;

}
p.holder {
width: 100%;
line-height: 50px;
position: absolute;
color: #fff;
cursor: auto;
font-size: 11pt;
z-index: 1;
}
</style>
<!-- 로그인 전 아웃로그인 시작 { -->
<section id="ol_before" class="ol">
    <h5>사용자 로그인</h5>
    <form name="foutlogin" action="<?php echo $outlogin_action_url ?>" onsubmit="return fhead_submit(this);" method="post" autocomplete="off">
    <fieldset>
        <input type="hidden" name="url" value="<?php echo $outlogin_url ?>">
        <p class="holder">아이디</p>
        <input type="text" id="ol_id" name="mb_id"  required class="required" maxlength="20">
        <p class="holder">비밀번호</p>
        <input type="password"  id="ol_pw" name="mb_password" required class="required"  style="border-top:1px solid #fff; " >
      </fieldset>
            <fieldset style="margin-bottom:35px; border:0; ">
              <input type="submit" id="ol_submit" value="로그인" >
            </fieldset>
        <!-- <div id="ol_auto">
            <input type="checkbox" name="auto_login" value="1" id="auto_login">
            <label for="auto_login" id="auto_login_label">자동로그인</label>
            <a href="<"><b>회원가입</b></a>
            <a href="<?php echo G5_BBS_URL ?>/password_lost.php" id="ol_password_lost">정보찾기</a>
        </div> -->

    </form>
</section>

<script>
$omi = $('#ol_id');
$omp = $('#ol_pw');
$omi_label = $('#ol_idlabel');
$omi_label.addClass('ol_idlabel');
$omp_label = $('#ol_pwlabel');
$omp_label.addClass('ol_pwlabel');

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


$(function() {
    $omi.focus(function() {
        $omi_label.css('visibility','hidden');
    });
    $omp.focus(function() {
        $omp_label.css('visibility','hidden');
    });
    $omi.blur(function() {
        $this = $(this);
        if($this.attr('id') == "ol_id" && $this.attr('value') == "") $omi_label.css('visibility','visible');
    });
    $omp.blur(function() {
        $this = $(this);
        if($this.attr('id') == "ol_pw" && $this.attr('value') == "") $omp_label.css('visibility','visible');
    });

    $("#auto_login").click(function(){
        if ($(this).is(":checked")) {
            if(!confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?"))
                return false;
        }
    });
});

function fhead_submit(f)
{
    return true;
}
</script>
<!-- } 로그인 전 아웃로그인 끝 -->

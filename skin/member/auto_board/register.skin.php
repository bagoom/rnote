<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<style>
.wrapper{
  background: url(../../img/resister_img/register_bg.jpg);
  background-size: cover;
}
.reg {
  width: 400px;
  height: 80px;
  float: left;
  color: #fff;
  text-align: center;
  line-height: 80px;
  font-size: 20px;
  cursor: pointer;
  border: 0;
}
.reg1,.reg2{
  width:50%;
  float: left;
  border: 1px solid rgba(255,255,255,0.6);
  background: transparent;
}
.reg:hover{
  background: #3b4db7;
}

textarea{
  width: 85%;
  height: 200px;
  margin-top: 15px;
  margin-bottom: 0;
  padding: 15px 25px;
  background: transparent;
  border: 1px solid rgba(255,255,255,0.6);

}

label{
  width: 85%;
  padding:15px;
  cursor: pointer;
}
label:hover{
  background: #111;
}
input[type=checkbox]:checked + label{
  background: #3b4db7;
}
input[type=checkbox]{
  display: none;
}
.step_wrap{
  margin-bottom: 35px;
}

</style>
<!-- 회원가입약관 동의 시작 { -->
<div class="mbskin">
    <form  name="fregister" id="fregister" action="<?php echo $register_action_url ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off">


    <section id="fregister_private" class="step_wrap">
        <h3>개인정보처리방침안내</h3>
        <textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea>
        <fieldset class="fregister_agree">
            <input type="checkbox" name="agree2" value="1" id="agree11">
            <label for="agree11">개인정보처리방침안내의 내용에 동의합니다.</label>

        </fieldset>
    </section>

    <section id="fregister_term" class="step_wrap">
        <h3>회원가입약관</h3>
        <textarea readonly><?php echo get_text($config['cf_privacy']) ?></textarea>
        <fieldset class="fregister_agree">
            <input type="checkbox" name="agree" value="1" id="agree21">
            <label for="agree21">회원가입약관의 내용에 동의합니다.</label>
        </fieldset>
    </section>

<div class="row" style="width:85%; margin:0 auto!important">


      <input type="submit"  class="reg reg1" style="border-right:0;"  value="직원회원가입">
      <input type="submit"  class="reg reg2 " value="중개사회원가입">
</div>

    </form>
  </div>

    <script>
    $(".reg1").click(function(){
      $("#fregister").attr("action", "./register_form_default.php");
    });


    function fregister_submit(f)
    {

        if (!f.agree2.checked) {
            alert("개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree2.focus();
            return false;
        }

        if (!f.agree.checked) {
            alert("회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree.focus();
            return false;
        }

        return true;
    }
    </script>
<!-- } 회원가입 약관 동의 끝 -->

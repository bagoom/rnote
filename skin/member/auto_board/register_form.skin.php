<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<style>

.wrapper{
  background: url(../../img/resister_img/register_bg.jpg);
  background-size: cover;
  overflow: hidden;
}
.caption{
  width: 100%;
  font-size: 20px;
  font-weight: bold;
  text-align: center;
  padding:15px 20px;
  color: #fff;
}
.mail_check, .main_menu_check{
  line-height: 22px;
}
tr{
  margin: 10px 0;
  overflow: hidden;
}
.caption_list{
  width: 120px;
  float: left;
  background: #fff;
  padding:15px;
}
.caption_list:hover{
  background: #000;
}
.caption_list img{
  width: 100%;
}
.mbskin{
  width: 300px;
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
input[type=radio]{
  display: none;
}
.reg_step{
  position: relative;
  margin-bottom:40px;
  border: 2px solid rgba(255,255,255,1);
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
label{
  width: 100%;
  height: 50px;
  line-height: 50px;
  font-size:11pt;
  margin: 0;
  border-bottom: 1px solid rgba(255,255,255,1);
}
label:last-child{
  border:0;
}
label:hover{
  color:#fff !important;
  font-weight: bold;
  background: rgba(255,255,255,0.3);
  cursor: pointer;
}
input[type=radio]:checked + label{
  background: #3b4db7;
}
.btn_confirm{
  width: 400px;
  margin: 80px auto;
  overflow: hidden;
}
.confirm_btn{
  width: 200px;
  height: 60px;
  font-size: 16px;
  color:#fff !important;
  text-align: center;
  line-height:60px;
  float: left;
  background: transparent;
  border: 1px solid #fff;
  display: block;
}
</style>
<!-- 회원정보 입력/수정 시작 { -->
<div class="mbskin" style="padding-bottom:0px;">

    <script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
    <?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?php echo G5_JS_URL ?>/certify.js"></script>
    <?php } ?>

    <form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="url" value="<?php echo $urlencode ?>">
    <input type="hidden" name="agree" value="<?php echo $agree ?>">
    <input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
    <input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
    <input type="hidden" name="cert_no" value="">
    <?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php }  ?>

    <div class="tbl_frm01 tbl_wrap">

      <div class="caption">1. 사이트 이용정보 입력</div>
      <div class="reg_step">


        <?php if (!$w=='u'){ ?>
        <p class="holder">아이디</p>
        <input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" <?php echo $required ?>  class="frm_input <?php echo $required ?>"  minlength="3" maxlength="20">
        <?}else{?>
        <input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" <?php echo $readonly ?>  class="frm_input <?php echo $required ?>"  minlength="3" maxlength="20">
          <?}?>

            <div id="suggesstion-box" style="display:none;">ddd</div>


            <p class="holder">비밀번호</p>
            <input type="password"  name="mb_password"style="border-top:1px solid #fff; "  id="reg_mb_password" <?php echo $required ?> class="frm_input minlength_3 <?php echo $required ?>" maxlength="20">

            <p class="holder">비밀번호확인</p>
          <input type="password"style="border-top:1px solid #fff; " name="mb_password_re" id="reg_mb_password_re" <?php echo $required ?> class="frm_input minlength_3 <?php echo $required ?>" maxlength="20">

    </div> <!-- col-md !-->
        </div>

    <div class="tbl_frm01 tbl_wrap">
      <div class="caption">2. 중개사무소 정보 입력</div>
      <div class="reg_step">
                <?php if (!$w=='u'){ ?>
                <p class="holder">이름</p>
                <?}?>
                <input type="text"  id="reg_mb_name" name="mb_name" value="<?php echo $member['mb_name'] ?>" <?php echo $required ?> >
                <input type="hidden"  name="mb_prev_name" value="<?php echo $member['mb_name'] ?>">

                <?php if (!$w=='u'){ ?>
                <p class="holder">휴대폰번호</p>
                <?}?>
                <input type="text"  style="border-top:1px solid #fff; "  id="reg_mb_hp" name="mb_hp" value="<?php echo $member['mb_hp'] ?>" <?php echo $required ?> >


                <?php if ($config['cf_use_email_certify']) {  ?>
                <span class="frm_info">
                    <?php if ($w=='') { echo "E-mail 로 발송된 내용을 확인한 후 인증하셔야 회원가입이 완료됩니다."; }  ?>
                    <?php if ($w=='u') { echo "E-mail 주소를 변경하시면 다시 인증하셔야 합니다."; }  ?>
                </span>
                <?php }  ?>
                <?php if (!$w=='u'){ ?>
                <p class="holder">사무소명</p>
                <?}?>
                <input type="text"  style="border-top:1px solid #fff; " id="reg_mb_name" name="group_name" value="<?php echo $gr_subject ?>" <?php echo $required ?>>

                <?php if (!$w=='u'){ ?>
                <p class="holder">사무소등록번호</p>
                <?}?>
                <input type="text"   style="border-top:1px solid #fff; " id="reg_mb_name" name="gr_office_num" value="<?php echo  $gr_info['gr_2'] ?>" <?php echo $required ?> >
                <input type="hidden" name="old_email"  value="<?php echo $member['mb_email'] ?>">

                <?php if (!$w=='u'){ ?>
                <p class="holder">이메일</p>
                <?}?>
                <input type="text"  style="border-top:1px solid #fff; " name="mb_email" value="<?php echo isset($member['mb_email'])?$member['mb_email']:''; ?>" id="reg_mb_email" required class="frm_input email required" size="70" maxlength="100">

          </div>
      </div>
      <div  class="mail_check" style="font-size:16px; display:none; background:#3b4db7; padding:10px;">비밀번호 분실시 확인을 위해 이메일주소를 정확하게 입력해 주셔야 합니다.</div>

      <div class="tbl_frm01 tbl_wrap">

        <div class="caption">3. 메인화면 메뉴 선택</div>
        <div class="reg_step" style="padding:0;">

          <input type="radio" name="mb_3" value="1" <?php if( $member["mb_3"] == "1" ) { echo "checked=true";}?> id="menu_select01">
          <label for="menu_select01">아파트/오피스텔</label>

          <input type="radio" name="mb_3" value="2" <?php if( $member["mb_3"] == "2" ) { echo "checked=true";}?>id="menu_select02">
          <label for="menu_select02">원룸</label>

          <input type="radio" name="mb_3" value="3" <?php if( $member["mb_3"] == "3" ) { echo "checked=true";}?> id="menu_select03">
          <label for="menu_select03">상가</label>

          <input type="radio" name="mb_3" value="4" <?php if( $member["mb_3"] == "4" ) { echo "checked=true";}?> id="menu_select04">
          <label for="menu_select04">토지</label>

      </div> <!-- col-md !-->
      <div  class="main_menu_check" style="font-size:16px; display:block; background:#3b4db7; padding:10px;">메인화면에서 바로가기 메뉴를<br> 추가/변경 할 수 있습니다.</div>
          </div>
      </div>
    <div class="btn_confirm">
        <input type="submit" class="confirm_btn" style="border-right:0;" value="<?php echo $w==''?'회원가입':'정보수정'; ?>" id="btn_submit" accesskey="s">
        <a class="confirm_btn" href="<?php echo G5_URL ?>" >취소</a>
    </div>
    </form>

    <script>

    $(document).ready(function(){
      $("#reg_mb_id").keyup(function(){
        $.ajax({
        type: "POST",
        url: "../bbs/resister_search.php",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
          $("#search_box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data){
          $("#suggesstion-box").show();
          $("#suggesstion-box").html(data);
          $("#search_box").css("background","#FFF");
        }
        });
      });
    });



    $("#reg_mb_email").focus(function(){
          $(".mail_check").show(200);
    });
    $("#reg_mb_email").blur(function(){
          $(".mail_check").hide(200);
    });

    // 전화번호 11자리 10자리 입력시 '-' 생성
    var contact = '#reg_mb_hp';
    $(contact).on('blur' ,function(){
    var contact_val = $(this).val();
    if(contact_val.length ==11){
    $(this).val($(this).val().replace(/(\d{3})\-?(\d{4})\-?(\d{4})/,'$1-$2-$3'))
    }
    else if(contact_val.length ==10){
    $(this).val($(this).val().replace(/(\d{3})\-?(\d{3})\-?(\d{4})/,'$1-$2-$3'))
    }
    });

    $(function() {
        $("p.holder + input").focus(function() {
            if(!$(this).val().length) {
                $(this).prev('p.holder').hide(200);
            } else {
                $(this).prev('p.holder').hide(200);
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
        $("#reg_zip_find").css("display", "inline-block");
        $("#reg_mb_zip1, #reg_mb_zip2, #reg_mb_addr1").attr("readonly", true);

        <?php if($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
        // 아이핀인증
        $("#win_ipin_cert").click(function() {
            if(!cert_confirm())
                return false;

            var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php";
            certify_win_open('kcb-ipin', url);
            return;
        });

        <?php } ?>
        <?php if($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
        // 휴대폰인증
        $("#win_hp_cert").click(function() {
            if(!cert_confirm())
                return false;

            <?php
            switch($config['cf_cert_hp']) {
                case 'kcb':
                    $cert_url = G5_OKNAME_URL.'/hpcert1.php';
                    $cert_type = 'kcb-hp';
                    break;
                case 'kcp':
                    $cert_url = G5_KCPCERT_URL.'/kcpcert_form.php';
                    $cert_type = 'kcp-hp';
                    break;
                case 'lg':
                    $cert_url = G5_LGXPAY_URL.'/AuthOnlyReq.php';
                    $cert_type = 'lg-hp';
                    break;
                default:
                    echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
                    echo 'return false;';
                    break;
            }
            ?>

            certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>");
            return;
        });
        <?php } ?>
    });

    // submit 최종 폼체크
    function fregisterform_submit(f)
    {
        // 회원아이디 검사
        if (f.w.value == "") {
            var msg = reg_mb_id_check();
            if (msg) {
                alert(msg);
                f.mb_id.select();
                return false;
            }
        }

        if (f.w.value == "") {
            if (f.mb_password.value.length < 3) {
                alert("비밀번호를 3글자 이상 입력하십시오.");
                f.mb_password.focus();
                return false;
            }
        }

        if (f.mb_password.value != f.mb_password_re.value) {
            alert("비밀번호가 같지 않습니다.");
            f.mb_password_re.focus();
            return false;
        }

        if (f.mb_password.value.length > 0) {
            if (f.mb_password_re.value.length < 3) {
                alert("비밀번호를 3글자 이상 입력하십시오.");
                f.mb_password_re.focus();
                return false;
            }
        }

        // 이름 검사
        if (f.w.value=="") {
            if (f.mb_name.value.length < 1) {
                alert("이름을 입력하십시오.");
                f.mb_name.focus();
                return false;
            }

            /*
            var pattern = /([^가-힣\x20])/i;
            if (pattern.test(f.mb_name.value)) {
                alert("이름은 한글로 입력하십시오.");
                f.mb_name.select();
                return false;
            }
            */
        }

        <?php if($w == '' && $config['cf_cert_use'] && $config['cf_cert_req']) { ?>
        // 본인확인 체크
        if(f.cert_no.value=="") {
            alert("회원가입을 위해서는 본인확인을 해주셔야 합니다.");
            return false;
        }
        <?php } ?>



        // E-mail 검사
        if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
            var msg = reg_mb_email_check();
            if (msg) {
                alert(msg);
                f.reg_mb_email.select();
                return false;
            }
        }

        <?php if (($config['cf_use_hp'] || $config['cf_cert_hp']) && $config['cf_req_hp']) {  ?>
        // 휴대폰번호 체크
        var msg = reg_mb_hp_check();
        if (msg) {
            alert(msg);
            f.reg_mb_hp.select();
            return false;
        }
        <?php } ?>

        if (typeof f.mb_icon != "undefined") {
            if (f.mb_icon.value) {
                if (!f.mb_icon.value.toLowerCase().match(/.(gif)$/i)) {
                    alert("회원아이콘이 gif 파일이 아닙니다.");
                    f.mb_icon.focus();
                    return false;
                }
            }
        }

        if (typeof(f.mb_recommend) != "undefined" && f.mb_recommend.value) {
            if (f.mb_id.value == f.mb_recommend.value) {
                alert("본인을 추천할 수 없습니다.");
                f.mb_recommend.focus();
                return false;
            }

            var msg = reg_mb_recommend_check();
            if (msg) {
                alert(msg);
                f.mb_recommend.select();
                return false;
            }
        }

        <?php echo chk_captcha_js();  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>

</div>
<!-- } 회원정보 입력/수정 끝 -->

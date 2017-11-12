<?php
include_once('./_common.php');
include_once(G5_THEME_PATH.'/head.sub.php');
$mb = get_member($mb_id);

// if (!$mb['mb_id'])
//     alert('존재하지 않는 회원입니다.');

// $g5['title'] = '접근가능그룹';
// include_once('./admin.head.php');

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
  width: 400px;
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
.tbl_frm01{
  margin-top: 50px;
}
.reg_step{
  position: relative;
  margin-bottom:40px;
  border: 2px solid rgba(255,255,255,1);
  overflow: hidden;
}
.reg_step li{
  width: 25%;
  float: left;
}
.reg_step li label{
  width: 100%;
  background: #3b4db7;
}
.reg_step input[type='radio']{
  display: none;
}
.reg_step input[type='radio']:checked + label{
  background: #263693;
  transition: 0.3s all;
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
  /*border-bottom: 1px solid rgba(255,255,255,1);*/
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
.reg_step p{
  font-size: 16px;
  padding: 20px 0 ;
}
.btn_confirm{
  width: 400px;
  margin: 40px auto;
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



    <form id="fregisterform" name="fregisterform" action="./group_write_auth_update.php" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="url" value="<?php echo $urlencode ?>">
    <input type="hidden" name="agree" value="<?php echo $agree ?>">
    <input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
    <input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
    <input type="hidden" name="cert_no" value="">

    <div class="tbl_frm01 tbl_wrap">

      <div class="caption"> 사무실 권한 설정</div>
      <div class="reg_step">
      <p style="line-height:22px; margin-bottom:0;">사무실 매물등록을 위한<br> 보유매물갯수</p>
      <ul>
        <li><input type="radio" id="gwp_01" name="gr_write_auth" value="50" <?if($gr_write_permission == "50"){ echo "checked";}?>>
        <label for="gwp_01">50개</label>
        </li>
        <li><input type="radio"  id="gwp_02" name="gr_write_auth" value="100" <? if($gr_write_permission == "100") { echo 'checked'; } ?>>
        <label for="gwp_02">100개</label>
        </li>
        <li><input type="radio"  id="gwp_03" name="gr_write_auth" value="150"<? if($gr_write_permission == "150") { echo 'checked'; } ?>>
        <label for="gwp_03">150개</label>
        </li>
        <li><input type="radio" id="gwp_04" name="gr_write_auth" <? if($gr_write_permission !== "50" && $gr_write_permission !== "100" && $gr_write_permission !== "150") { echo 'checked'; } ?>>
        <label for="gwp_04" >직접입력</label>
        </li>
      </ul>
      <input type="text" id="gwp_05"  name="gr_write_auth2" value="<?=$gr_write_permission?>" placeholder="입력해주세요."style="display:none; width:100%">

    </div> <!-- col-md !-->
        </div>





      </div>
    <div class="btn_confirm">
        <input type="submit" class="confirm_btn" style="border-right:0;" value="수정하기" id="btn_submit" accesskey="s">
        <a class="confirm_btn" href="<?php echo G5_URL ?>" >취소</a>
    </div>
    </form>

<script>


$("input[type=radio]").click(function(){
   if($("#gwp_04").is(':checked')){
    $("#gwp_05").toggle(300);
      $("#gwp_05").focus();
    }else if(!$("#gwp_04").is(':checked')){
      $("#gwp_05").hide(300);
    }
})
$("#fregisterform").submit(function(){
if($("#gwp_04").is(':checked')){
  $("#gwp_04").val($("#gwp_05").val())

}
});


// function boardgroupmember_form_check(f)
// {
//     if (f.gr_id.value == '') {
//         alert('접근가능 그룹을 선택하세요.');
//         return false;
//     }
//
//     return true;
// }
</script>

<?include_once(G5_THEME_PATH.'/tail.sub.php');?>

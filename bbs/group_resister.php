<?php
include_once('./_common.php');


include_once(G5_PATH.'/head.sub.php');
// if (!$board['bo_table']) {
//    alert('회원가입후 이용해주세요.', G5_URL);
// }
$sql = " select count(*) as cnt from {$g5['memo_table']} where me_{$kind}_mb_id = '{$member['mb_id']}' ";
$row = sql_fetch($sql);
$total_count = number_format($row['cnt']);
?>
<style>
.wrapper{
  background: url(../../img/resister_img/register_bg.jpg);
  background-size: cover;
  overflow: hidden;
}
.gr_wrap {
width: 400px;
height: 290px;
margin: 0 auto;
position: relative;
margin-top: 200px;
border-radius: 6px 6px 0 0;
border-bottom: 0;
background: #3b4db7; /* Old browsers */
color: #fff;
text-align: center;
padding: 30px;
}
.gr_wrap_title{
font-size: 18px;
}
.gr_wrap_footer{
  width: 400px;
  margin: 0 auto;
}
.gr_wrap_footer .btn{
  border-radius: 0px 0px 6px 6px;
}
.submit{
  width: 100%;
  padding:15px;
}
.gr_wrap input[type=text]{
  height: 40px;
}
.btn-primary{
  background: #2a3ba1;
  border-bottom: 0;
  color: #fff;
}
.btn-primary:hover{
  background: #1d2d8c;
}
</style>

<?php echo $register_text ; ?>
<div class="gr_wrap">
  <div class="row"><p class="gr_wrap_title"> 업체 가입하기 </p></div>
  <div class="frmSearch">
    <form name="group_member_reister" id="group_member_reister" action="./group_resister_update.php" method="post">
    <input type="hidden" name="mb_2" value="waiting">
    <input type="text" id="search_box" name="gr_name" value="<?php echo $gr_name?>" class="form-control " placeholder="업체명" >
        <div id="suggesstion-box"></div>
  </div>
</div>

  <div class="gr_wrap_footer"><input type="submit" value="가입신청하기" class="btn btn-primary btn-md submit"/> </div>
</form>

  <script>

  $('.wrapper').css("height", $(document).height() );


  $(document).ready(function(){
  	$("#search_box").keyup(function(){
  		$.ajax({
  		type: "POST",
  		url: "group_resister_search.php",
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
  //To select country name
  function selectCountry(val) {
  $("#search_box").val(val);
  }




  function group_member_reister_check(f)
  {
      if (f.search_box.value == '') {
          alert('접근가능 그룹을 선택하세요.');
          return false;
      }

      return true;
  }
  </script>


<?include_once(G5_PATH.'/tail.sub.php');?>

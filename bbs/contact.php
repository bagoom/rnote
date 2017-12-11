<?
include_once('./_common.php');
if($is_guest)
alert("회원가입 후 이용하세요.")

// if(!empty($_POST["keyword"])) {
//     $sql = " select * from rnote_contact_test10 where rc_name like '" . $_POST["keyword"] . "%' ORDER BY rc_name LIMIT 0,3";
//   $result = sql_query($sql);
?>
<style>
.modal-body{
  padding-left:  40px;
  padding-right:  40px;
}
.modal-body input{
  width:100%;
  height:50px;
  margin-bottom:5px;
  text-align:center;
  font-size:18px;
  border:0;
  border-bottom: 1px solid #ddd;
}
.modal-body p{
  margin-top:25px;
  margin-bottom:0;
  color:#888;
  font-size:13px;
  font-weight:bold;
}

</style>
<?php
// $sql = " select * from `rnote_contact_$member[mb_id]` ";
$sql = " select * from `rnote_contact_test10` order by rc_bookmark desc ";
$result = sql_query($sql);
?>
<div class="contact_head">
    <span class="contact_hide"><i class="fa fa-times" aria-hidden="true"></i></span>
    <div class="contact_title">
      고객연락처 관리 
    </div>
    <div class="contact_add">
      <input type="submit" class="contact_add_btn" data-backdrop="static" data-target="#layerpop" data-toggle="modal"  value="+">
    </div>
    </div> <!-- contact_head- -->

    <div class="contact_form" >
    <input type="text" class="contact_search_input" id="contact_search" placeholder="고객명을 입력 해 주세요.">
    </div>
    

    <div class="contact_content">
    <div id="suggesstion-box">
    
    </div>

    <ul class="contact_list">
    <? for ($i=0; $row=sql_fetch_array($result); $i++) {?>
    <div class="contact_book_mark">
    <?if ($row['rc_bookmark'] == '0'){ ?>
      <span class="contact_bookmark_on" data-item="<?=$row['rc_id']?>" data-value="1"><i class="fa fa-star-o" aria-hidden="true"></i></span>
    <?}else{ ?>
      <span class="contact_bookmark_off" data-item="<?=$row['rc_id']?>" data-value="0"><i class="fa fa-star" aria-hidden="true"></i></span>
    <?}?>
  </div>
  
  <li><?=$row['rc_name']?> <span style="float:right;"><?=$row['rc_hp']?></span>
    <p><?=$row['rc_content']?>

  
  </p> </li>
    <? }?>
    </ul> 
    </div> <!-- contact_content-->





    <form action="<?echo G5_BBS_URL?>/contact_update.php" method="post" id="contact_form">
    <div class="modal fade" id="layerpop" >
                <div class="modal-dialog">
                  <div class="modal-content" style="min-width:350px !important; width:350px; margin:0 auto;">
                    <!-- header -->
                    <div class="modal-header">
                      <!-- 닫기(x) 버튼 -->
                      <button type="button" class="close" data-dismiss="modal">×</button>
                      <!-- header title -->
                      <h4 class="modal-title">새로운 연락처 등록</h4>
                    </div>
                    <!-- body -->
                    <div class="modal-body" style="padding-top:35px;">
                   
                    <p>고객명 </p>
                          <input type="text" name="rc_name" placeholder="고객명을 입력 해 주세요.">
                    <p> 전화번호</p>
                          <input type="text" name="rc_hp" id="rc_hp"placeholder="연락처를 입력 해 주세요.">
                    <p>내용</p>
                          <input type="text" name="rc_content" placeholder="내용을 입력 해 주세요.">
                        
                          
                    </div>
                    <!-- Footer --> 
                    <div class="modal-footer" style="padding:15px;">
                      <span type="submit" class="btn btn-default add" data-dismiss="modal"> 추가</span>
                      <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                    </div>
                  </div>
                </div>
              </div>
                      </form>





<script>

// 사이드바 닫기 버튼
$(".contact_hide").click(function(){
$('.contact_wrap').fadeOut(100);
})

//  고객연락처 검색 ajax 요청
$("#contact_search").keyup(function(){
$.ajax({
type: "POST",
url: "<?echo G5_BBS_URL?>/contact_search.php",
data:'keyword='+$(this).val(),
beforeSend: function(){
},
success: function(data){
$(".contact_list").fadeOut(300);
$("#suggesstion-box").fadeIn(300);
$("#suggesstion-box").html(data);
if($("#contact_search").val() == ''){
  console.log("ddd");
  $("#suggesstion-box").hide();
  $(".contact_list").fadeIn(300);
}
}

});

});

  
//  고객연락처 추가 ajax요청
$(".add").on('click',function () {
var formData = jQuery('#contact_form').serializeArray();
$.ajax({
url: "<?echo G5_BBS_URL?>/contact_update.php",
type: "POST",
data: formData,
dataType: 'text',
success: function (Data, textStatus, jqXHR) {
console.log(formData[0]);
console.log(formData[1]);
console.log(formData[2]);
$(".modal-backdrop").remove();
// 고객연락처 추가후 리스트 새로고침 ajax요청
$.ajax({
type : "POST",
url : contact_url,
dataType : "text",
error : function() {
    alert('통신실패!!');
},
success : function(data) {
    $('.contact_wrap').html(data);
}
});

},
error: function (jqXHR, textStatus, errorThrown) {
alert(errorThrown);
}
})
});


// 북마크기능 

$(".contact_bookmark_on").click(function(){

var bookmark_update = "<?echo G5_BBS_URL?>/contact_bookmark_update.php";
var formData = $(this).attr("data-item");
$.ajax({
type : "POST",
url : bookmark_update,
data: {
rc_id : $(this).attr("data-item"),
rc_bookmark : $(this).attr("data-value")
},
error : function() {
alert('통신실패!!');
},
success : function(data) {
$.ajax({
type : "POST",
url : contact_url,
dataType : "text",
error : function() {
    alert('통신실패!!');
},
success : function(data) {
    $('.contact_wrap').html(data);
}
});
}
});
})

$(".contact_bookmark_off").click(function(){
var bookmark_update = "<?echo G5_BBS_URL?>/contact_bookmark_update.php";
var formData = $(this).attr("data-item");
$.ajax({
type : "POST",
url : bookmark_update,
data: {
rc_id : $(this).attr("data-item"),
rc_bookmark : $(this).attr("data-value")
},
error : function() {
alert('통신실패!!');
},
success : function(data) {
$.ajax({
type : "POST",
url : contact_url,
dataType : "text",
error : function() {
alert('통신실패!!');
},
success : function(data) {
$('.contact_wrap').html(data);
}
});
}
});
})



// 전화번호 11자리 10자리 입력시 '-' 생성
var contact = '#rc_hp';
$(contact).on('blur' ,function(){
var contact_val = $(this).val();
if(contact_val.length ==11){
$(this).val($(this).val().replace(/(\d{3})\-?(\d{4})\-?(\d{4})/,'$1-$2-$3'))
}
else if(contact_val.length ==10){
$(this).val($(this).val().replace(/(\d{3})\-?(\d{3})\-?(\d{4})/,'$1-$2-$3'))
}
});






</script>
<?
include_once('./_common.php');
if($is_guest)
alert("회원가입 후 이용하세요.");


$sql = " select * from `rnote_contact_$member[mb_id]` order by rc_bookmark desc ";
$result = sql_query($sql);
?>




<div class="contact_wrap">
<? for ($k=0;$row=sql_fetch_array($result); $k++) {?>
  
<? 
  $num = $list_num-($k+$s_point);
  $new_date = substr($row['rc_date'], 0, 10);
?>

  <div class="contact_list"  >
      <div class="contact_list_body"> 




            <div class="rc_star">
            <?if ($row['rc_bookmark'] == '0'){ ?>
              <span class="contact_bookmark_on" data-item="<?=$row['rc_id']?>" data-value="1"><i class="fa fa-star" aria-hidden="true" style="color:#ccc;"></i></span>
             <?}else{ ?>
              <span class="contact_bookmark_off" data-item="<?=$row['rc_id']?>" data-value="0"><i class="fa fa-star" aria-hidden="true" style="color:#ffbe00"></i></span>
            <?}?>
            </div>

            <div class="rc_date"><? echo $new_date;?></div>

           <div class="list_name"><?=$row['rc_name']?>
           <p class="list_price"><span class="rc_hp"><?=$row['rc_hp']?></span></p>
           </div>

           <div class="rc_content rc_modify"  data-backdrop="static" data-target="#modify_modal" data-toggle="modal"  data-id="<?=$row['rc_id']?>" data-name="<?=$row['rc_name']?>" data-hp="<?=$row['rc_hp']?>" data-con="<?=$row['rc_content']?>">
           <p><?=$row['rc_content']?></p>
           </div>

           <div class="rc_confirm">
           <span class="rc_del" data-item="<?=$row['rc_id']?>">삭제</span> 
           </div>


      
      </div>

  </div><!-- contact_wrap -->



<?}?><!-- 반복문끝 -->
</div>


              <!-- 연락처 추가 모달 -->
             <div class="modal fade" id="insert_modal" >
                <form action="<?echo G5_BBS_URL?>/contact_update.php" method="post" id="contact_form">
                <div class="modal-dialog">
                  <div class="modal-content" style="min-width:500px !important; width:500px; margin:0 auto;">
                    <!-- header -->
                    <div class="modal-header">
                      <!-- 닫기(x) 버튼 -->
                      <button type="button" class="close" data-dismiss="modal">×</button>
                      <!-- header title -->
                      <h4 class="modal-title">고객정보 등록</h4>
                    </div>
                    <!-- body -->
                    <div class="modal-body" style="padding-top:35px;">
                    
                    <p>고객명 </p>
                          <input type="text" name="rc_name" placeholder="고객명을 입력 해 주세요.">
                    <p> 전화번호</p>
                          <input type="text" name="rc_hp" id="rc_hp"placeholder="연락처를 입력 해 주세요.">
                    <p>내용</p>
                          <textarea name="rc_content" id="rc_content" cols="30" rows="10"></textarea>
                          
                    </div>
                    <!-- Footer --> 
                    <div class="modal-footer" style="padding:15px;">
                      <span type="submit" class="btn btn-default add" data-dismiss="modal">추가</span>
                    </div>
                  </div>
                </div>
                </form>
              </div>


              <!-- 연락처 수정 모달 -->
             <div class="modal fade" id="modify_modal" >
                <form action="<?echo G5_BBS_URL?>/contact_update.php" method="post" id="contact_form2">
                <div class="modal-dialog">
                  <div class="modal-content" style="min-width:500px !important; width:500px; margin:0 auto;">
                    <!-- header -->
                    <div class="modal-header">
                      <!-- 닫기(x) 버튼 -->
                      <button type="button" class="close" data-dismiss="modal">×</button>
                      <!-- header title -->
                      <h4 class="modal-title">고객정보 수정</h4>
                    </div>
                    <!-- body -->
                    <div class="modal-body" style="padding-top:35px;">
                    <input class="modify_id" name="rc_id" type="hidden" value="">
                    <p>고객명 </p>
                          <input type="text" name="rc_name" value="<?=$row['rc_name']?>">
                    <p> 전화번호</p>
                          <input type="text" name="rc_hp" id="rc_hp" value="<?=$row['rc_hp']?>">
                    <p>내용</p>
                          <textarea name="rc_content" id="rc_content" cols="30" rows="10"><?=$row['rc_content']?></textarea>
                          
                    </div>
                    <!-- Footer --> 
                    <div class="modal-footer" style="padding:15px;">
                      <span type="submit" class="btn btn-default modify" data-dismiss="modal" data-item="<?=$row['rc_id']?>" >수정</span>
                    </div>
                  </div>
                </div>
                </form>
              </div>




<script>

// 고객연락처 수정, 모달 값 전달
$(".rc_modify").click(function(){
  var rc_id = $(this).attr("data-id");
  var rc_name = $(this).attr("data-name");
  var rc_hp = $(this).attr("data-hp");
  var rc_con = $(this).attr("data-con");
  $("#modify_modal .modify_id").val(rc_id);
  $("#modify_modal input[name='rc_name']").val(rc_name);
  $("#modify_modal input[name='rc_hp']").val(rc_hp);
  $("#modify_modal textarea").val(rc_con);
});

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
  $(".modal-backdrop").remove();
  console.log(Data);
// 고객연락처 추가후 리스트 새로고침 ajax요청
$.ajax({
type : "POST",
url : '<?echo G5_BBS_URL?>/contact.php',
dataType : "text",
error : function() {
    alert('통신실패!!');
},
success : function(data) {
    $('.main-list-wrap').html(data);
}
});
}
})
});

//  고객연락처 수정 ajax요청
$(".modify").on('click',function () {

var formData2 = jQuery('#contact_form2').serializeArray();
  formData2.push({name: "w" , value :"u" });
$.ajax({
url: "<?echo G5_BBS_URL?>/contact_update.php",
type: "POST",
data: formData2,
dataType: 'text',
success: function (Data, textStatus, jqXHR) {
  $(".modal-backdrop").remove();
  console.log(Data);
// 고객연락처 추가후 리스트 새로고침 ajax요청
$.ajax({
type : "POST",
url : '<?echo G5_BBS_URL?>/contact.php',
dataType : "text",
error : function() {
    alert('통신실패!!');
},
success : function(data) {
    $('.main-list-wrap').html(data);
}
});
}
})
});

//  고객연락처 삭제 ajax요청
$(".rc_del").on('click',function () {
var del = confirm("연락처를 삭제 하시겠습니까?");
if (del == true) {
var formData = { rc_id : $(this).attr("data-item") , w : "d"};
$.ajax({
url: "<?echo G5_BBS_URL?>/contact_update.php",
type: "POST",
data: formData,
dataType: 'text',
success: function (Data, textStatus, jqXHR) {
  $(".modal-backdrop").remove();
  console.log(Data);
// 고객연락처 추가후 리스트 새로고침 ajax요청
$.ajax({
type : "POST",
url : '<?echo G5_BBS_URL?>/contact.php',
dataType : "text",
error : function() {
    alert('통신실패!!');
},
success : function(data) {
    $('.main-list-wrap').html(data);
}
});
}
})
} else {
    
}
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
    $('.main-list-wrap').html(data);
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
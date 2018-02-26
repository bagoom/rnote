<?
include_once('./_common.php');
if($is_guest)
alert("회원가입 후 이용하세요.");


$sql2 = " select * from `g5_write_$member[mb_id]` where wr_sale_type = 1 and board_list = 3  order by wr_id desc";
$result2 = sql_query($sql2);
$list_num = sql_num_rows($result2);
$page = ($_GET['page'])?$_GET['page']:1;

$list = 20;
$block = 5;

$pageNum = ceil($list_num/$list); // 총 페이지
$blockNum = ceil($pageNum/$block); // 총 블록
$nowBlock = ceil($page/$block);

$s_page = ($nowBlock * $block) - 4;
if ($s_page <= 1) {
    $s_page = 1;
}
$e_page = $nowBlock*$block;
if ($pageNum <= $e_page) {
    $e_page = $pageNum;
}

?>


<?php
$s_point = ($page-1) * $list;
$sql = " select * from `g5_write_$member[mb_id]` where wr_sale_type = 1 and board_list = 3  order by wr_id desc LIMIT $s_point,$list";
$result = sql_query($sql);
$list_no = sql_num_rows($result);

?>





<div class="contact_wrap">
<? for ($k=0;$row=sql_fetch_array($result); $k++) {?>
  
<? 
  $num = $list_num-($k+$s_point);
?>

  <div class="contact_list">
      <div class="contact_list_body"> 
            <div class="list_number"><? echo $num;?></div>

            <div class="list_subject">
            <?=$row['wr_subject']?>
            <p><?=$row['wr_sale_area']?></p>
            </div>

           <div class="list_floor"><?=$row['wr_floor']?>층 / <?=$row['wr_area_p']?>평
           <p class="list_price">
            <span class="commaN"><?=$row['wr_rent_deposit']?></span>  / 
            <span class="commaN"><?=$row['wr_m_rate']?></span> / 
            <span class="commaN"><?=$row['wr_premium_o']?></span>
            </p>
           </div>
           <div class="sum_pay">
           <p>총<span class="commaN"><?=$row['wr_premium_o']+$row['wr_rent_deposit']?></span></p>
           </div>

           <div class="list_address">
           <?php 
           $jibeon = $row['wr_address'];
           $pattern = " ";
           $jibeongu = split($pattern,$jibeon);
           ?>
           <?php for($i=0;$i< 3;$i++){echo $jibeongu[$i]."\n";}  ?>
           </div>

           <div class="list_date">
           <?php 
           $date = $row['wr_datetime'];
           $pattern2 = ":";
           $dateday = split($pattern2,$date);
           $dateday2 = split(' ',$dateday[0]);
           ?>
           <?=$dateday2['0']?>
          <!-- <?=$row['wr_datetime']?> -->
           </div>

      
      </div>

  </div><!-- contact_wrap -->



<?}?><!-- 반복문끝 -->
</div>


<div class="paging_wrap">

    <div class="prev_page">
    <a href="<?=$PHP_SELP?>?page=<?=$s_page-1?>&bo_table=<?=$member['mb_id']?>&board_list=3&contact=1">
    <i class="fa fa-caret-left" aria-hidden="true"></i>
    </a>
    </div>

<?php for ($p=$s_page; $p<=$e_page; $p++) {  ?>

<?php if ($p == $page) {?>
  <div class="page_list active">
<a href="<?=$PHP_SELP?>?page=<?=$p?>&bo_table=<?=$member['mb_id']?>&board_list=3&contact=1"><?=$p?></a>
</div>
<?}else{?>
<div class="page_list">
<a href="<?=$PHP_SELP?>?page=<?=$p?>&bo_table=<?=$member['mb_id']?>&board_list=3&contact=1"><?=$p?></a>
</div>
<?}}?>

    <div class="next_page">
    <a href="<?=$PHP_SELP?>?page=<?=$e_page+1?>&bo_table=<?=$member['mb_id']?>&board_list=3&contact=1">
    <i class="fa fa-caret-right" aria-hidden="true"></i>
    </a>
    </div>

</div>




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
                          <input type="text" name="rc_content" placeholder="내용을 입력 해 주세요." style="border-bottom:0;">
                        
                          
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
url : '<?echo G5_BBS_URL?>/contact.php',
dataType : "text",
error : function() {
    alert('통신실패!!');
},
success : function(data) {
    $('.main-list-wrap').html(data);
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
    $('.main-list-wrap').html(data);
}
});
}
});
})


//  숫자 천단위에 콤마를 찍기위한 함수
for (var i =0 ; i <= $(".commaN").length;  i ++){
    $(".commaN").eq(i).text(numberWithCommas(parseInt($(".commaN").eq(i).html())));
  }
  function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

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
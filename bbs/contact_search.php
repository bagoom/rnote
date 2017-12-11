<?php
include_once('./_common.php');

if ($is_guest)
    alert_close('회원만 이용하실 수 있습니다.');
  $sql = " select * from rnote_contact_test10 where rc_name like '" . $_POST["keyword"] . "%' ORDER BY rc_name LIMIT 0,3";
  $result = sql_query($sql);

  ?>


    <ul id="country-list">
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
    ?>

<div class="contact_book_mark">
    <?if ($row['rc_bookmark'] == '0'){ ?>
      <span class="contact_bookmark_on" data-item="<?=$row['rc_id']?>" data-value="1"><i class="fa fa-star-o" aria-hidden="true"></i></span>
    <?}else{ ?>
      <span class="contact_bookmark_off" data-item="<?=$row['rc_id']?>" data-value="0"><i class="fa fa-star" aria-hidden="true"></i></span>
    <?}?>
  </div>
    <li><?=$row['rc_name']?> <span style="float:right;"><?=$row['rc_hp']?></p> </li>
    <!-- <div style="width:100%; text-align:center;">해당 고객이 없습니다.</div> -->

  <?php } ?>
  </ul>




<script>


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
</script>
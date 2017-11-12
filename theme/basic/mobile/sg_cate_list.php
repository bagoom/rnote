<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_MOBILE_PATH.'/head.php');
?>
<style>
.sg_cate_wrap{
  width: 80%;
  margin: 0 auto;
  overflow: hidden;
}
.modal-body{
  background-color: #f3f3f3;
}
.sg_cate_wrap p{
  width: 48%;
  height: 150px;
  line-height: 150px;
  padding : 0;
  margin : 1%;
  border-radius: 0;
  float: left;
  text-align: center;
  font-size: 20px;
  cursor: pointer;
}
.alert-success {
    color: #fff;
    background-color: #222;
    border: 0;
}
</style>


<div class="sg_cate_wrap ">
  <p class="sg_cate_01 alert alert-success" >원룸임대</p>
  <p class="sg_cate_02 alert alert-success">아파트/오피스텔</p>
  <p class="sg_cate_03 alert alert-success">상가임대</p>
  <p class="sg_cate_04 alert alert-success">토지임대</p>
</div>








<script>
var bourl1 = "write.php?bo_table="+$("#bo_table").val()+"&board_list=1";
var bourl2 = "write.php?bo_table="+$("#bo_table").val()+"&board_list=2";
var bourl3 = "write.php?bo_table="+$("#bo_table").val()+"&board_list=3";
var bourl4 = "write.php?bo_table="+$("#bo_table").val()+"&board_list=4";
$(".sg_cate_01").click(function(){
  $.ajax({
  type : "POST",
  url : bourl1,
  dataType : "text",
  error : function() {
      alert('통신실패!!');
  },
  success : function(data) {
      $('#Context').html(data);
  }
});
 })

 $(".sg_cate_02").click(function(){
   $.ajax({
   type : "POST",
   url : bourl2,
   dataType : "text",
   error : function() {
       alert('통신실패!!');
   },
   success : function(data) {
       $('#Context').html(data);
   }
});
  })

  $(".sg_cate_03").click(function(){
    $.ajax({
    type : "POST",
    url : bourl3,
    dataType : "text",
    error : function() {
        alert('통신실패!!');
    },
    success : function(data) {
        $('#Context').html(data);
    }
});
   })

   $(".sg_cate_04").click(function(){
     $.ajax({
     type : "POST",
     url : bourl4,
     dataType : "text",
     error : function() {
         alert('통신실패!!');
     },
     success : function(data) {
         $('#Context').html(data);
     }
 });
    })
</script>

<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>

<?php
include_once('./_common.php');
if (G5_IS_MOBILE){
include_once(G5_THEME_MOBILE_PATH.'/head.php');
}
else
include_once(G5_PATH.'/head.sub.php');
?>
<link rel="stylesheet" href="<?php G5_PATH?>/assets/css/style2.css">
<script src="<?php G5_PATH?>/assets/js/modernizr.custom.js"></script>
<script src="<?php G5_PATH?>/assets/js/jquery-labelauty.js"></script>
<link rel="stylesheet" type="text/css" href="<?php G5_PATH?>/assets/css/jquery-labelauty.css">
<link rel="stylesheet" href="<?php G5_PATH?>/assets/css/bootstrap-range.min.css">





<style>
.black-bg{
  background: #222 !important;
  margin-top: 0 !important;
  padding: 0!important;
}
.wrapper{
  padding: 0;
  margin-bottom:25px;
}
.board_search ul{
  overflow: hidden;
  margin: 0 auto;
}
/

.input_range input[type=text]{
  width: 47%;
  float: left;
  padding-right:0;
}
.input_box2 input[type=submit]{
  background: transparent;
  border:0;
}
.range_min,.range_max{
  width: 50%;
  float: left;
  margin-bottom: 0;
  text-align: center;
}
#my_popup{
  position: absolute;
  width:300px;
  top:53px;
  left:0 !important;
  text-align: left;
  padding : 15px;
  background: #fff;
  box-shadow: 0 3px 5px rgba(0,0,0,0.2);
  z-index:10;
}
#my_popup input[type=submit]{
  width: 100%;
  background: #3b4db7;
  color: #fff;
  border:0;
  padding: 10px;
}

.write_result_form{
  height: 650px;
  margin-top:50px;
  padding: 150px;
  text-align: center;
}
.write_result_form p{
  font-size: 30px;
}
.write_result_form span{
  width: 190px;
  display: block;
  float: left;
  padding: 20px;
  margin-left: 5px;
  background:#3b4db7;
  font-size: 16px;
  color: #fff;
}
.btn_wrap{
  width: 650px;
  margin: 30px auto;
}
.check_list_wrap{
  top:15px ;
}
</style>


<div class="search_wrap " style="text-align:center;">




</div>




<div class="write_result_form">
<p>매물등록이 완료 되었습니다.</p>
<div class="btn_wrap">

<? if($wr_sale_type=='1') { ?>
<a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$bo_table?>&wr_sale_type=1&board_list=<?=$board_list?>&wr_important=<?=$write['wr_important']?>&wr_id=<?=$write['wr_id']?>">
<span class="">등록한매물확인하기</span>
</a>
<?} else if($wr_sale_type=='2'){?>
  <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$bo_table?>&wr_sale_type=2&board_list=<?=$board_list?>&wr_important=<?=$write['wr_important']?>&wr_id=<?=$write['wr_id']?>">
<span class="">등록한매물확인하기</span>
</a>
<?}?>




<? if($gr_admin){ 
if ($wr_sale_type=='1') {?>

  <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?=$member[mb_id] ?>&board_list=<?=$member[mb_3]?>&wr_sale_type=1&wr_writer_id=<?=$member[mb_id] ?>">
  <span class="">매물리스트로가기</span>
  </a>
  <?}else if($wr_sale_type=='2'){?>
    <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?=$member[mb_id] ?>&board_list=<?=$member[mb_3]?>&wr_sale_type=2&wr_writer_id=<?=$member[mb_id] ?>">
  <span class="">매물리스트로가기</span>
  </a>

<?}}else{?>

<? if ($wr_sale_type=='1') {?>
<a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<? echo $member['mb_id']?>&board_list=<?=$member[mb_3]?>&wr_sale_type=1&wr_writer_id=<?=$member[mb_id] ?>">
<span class="">매물리스트로가기</span>
</a>
<? }else if ($wr_sale_type=='2') {?>
  <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<? echo $member['mb_id']?>&board_list=<?=$member[mb_3]?>&wr_sale_type=2&wr_writer_id=<?=$member[mb_id] ?>">
<span class="">매물리스트로가기</span>
</a>
<?}}?>


<a href="<?echo G5_BBS_URL?>/write.php?bo_table=<?=$bo_table?>&board_list=<?=$member[mb_3]?>">
<span class="sg_cate_03">계속등록하기</span>
</a> 


</div> <!-- btn_wrap -->
</div> <!-- write_result_form -->


  <input type="hidden" id="bo_table" value="<?php echo $bo_table?>" ?>






  <script type="application/javascript">
    // var bourl1 = "<?echo G5_BBS_URL?>/write_modal.php?bo_table="+$("#bo_table").val()+"&board_list=<?=$member[mb_3]?>";
    // $(".sg_cate_03").click(function(){
    //   $.ajax({
    //   type : "POST",
    //   url : bourl1,
    //   dataType : "text",
    //   error : function() {
    //       alert('통신실패!!');
    //   },
    //   success : function(data) {
    //       $('#Context').html(data);
    //   }});
    //    })



  </script>





<?php
if (G5_IS_MOBILE){
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
}
else
include_once(G5_PATH.'/tail.sub.php');
?>

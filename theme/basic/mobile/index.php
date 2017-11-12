<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
if ($is_member) {
    
}else{
  goto_url('http://woodonggoon.dothome.co.kr/bbs/login.php');

}
$mobile_main = 1;
include_once(G5_THEME_MOBILE_PATH.'/head.php');
?>


<div class="col-xs-12 col-md-12 mobile_content_wrap" style="padding:0;">
<ul>

<a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<? echo $member['mb_id']?>&sfl=board_list&stx=1">
  <li class="col-xs-6">
    <i class=" icon-home-outlined"></i>
    <p class="icon_02">원룸/오피스텔</p>
  </li>
</a>

<a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<? echo $member['mb_id']?>&sfl=board_list&stx=2">
  <li class="col-xs-6" >
    <i class="icon-residential-area-outlined"></i>
      <p class="icon_03"> 아파트</p>
 </li>
</a>


<a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<? echo $member['mb_id']?>&sfl=board_list&stx=3">
  <li class="col-xs-6">
    <i class="icon-money-outlined"></i>
      <p class="icon_04"> 상가</p>
    </li>
  </a>

<a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<? echo $member['mb_id']?>&sfl=board_list&stx=4">
  <li class="col-xs-6">
    <i class="icon-layout-outlined"></i>
      <p class="icon_05"> 토지</p>
  </li>
</a>

<a href="<?php echo G5_BBS_URL?>/bookmark.php?bo_table=<? echo $member['mb_id']?>">
  <li class="col-xs-6">
  <i class="fa fa-star-o"></i>
    <p class="icon_05"> 즐겨찾기</p>
</li>
</a>

<a href="<?php echo G5_BBS_URL?>/bookmark.php?bo_table=<? echo $member['mb_id']?>">
  <li class="col-xs-6">
  <i class="fa fa-star-o"></i>
    <p class="icon_05"> 즐겨찾기</p>
</li>
</a>

</ul>
</div>


<div class="fix_btn_wrap">
  <button class="fix_btn left_01" onclick = "location.href = '<?echo G5_BBS_URL?>/write.php?bo_table=<? echo $member['mb_id']?>&board_list=1' "> 원룸 </button>
  <button class="fix_btn left_02" onclick = "location.href = '<?echo G5_BBS_URL?>/write.php?bo_table=<? echo $member['mb_id']?>&board_list=2' "> 아파트 </button>
  <button class="fix_btn top_01"  onclick = "location.href = '<?echo G5_BBS_URL?>/write.php?bo_table=<? echo $member['mb_id']?>&board_list=3' "> 상가 </button>
  <button class="fix_btn top_02" onclick = "location.href = '<?echo G5_BBS_URL?>/write.php?bo_table=<? echo $member['mb_id']?>&board_list=4' "> 토지 </button>
  <button class="fix_btn">+</button>
</div>


<script>
$( "button:last" ).click(function() {
  $(this).toggleClass("fix_active");
  $( ".left_01,.left_02,.top_01,.top_02" ).fadeToggle( "fast", function() {
  });
});
</script>
<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>

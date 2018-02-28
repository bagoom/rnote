<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/main_head.php');
?>
<link href="<?php echo G5_URL?>/assets/css/slick-theme.css?ver=1" rel="stylesheet">
<link href="<?php echo G5_URL?>/assets/css/slick.css?ver=1" rel="stylesheet">
<style>
#main_contents li i{
  width:40px;
  font-size: 35px;
  color: rgba(255,255,255,0.6);
  padding-top:6px;
}
.black-bg{
  background: transparent;
}
.wrapper{
  margin-top:0;
}
.Office_register_check{
  width: 298px;
  height: 50px;
  margin: 0 auto;
  font-size:16px;
  text-align: center;
  line-height: 50px;
  border : 1px solid #fff;
}
.header{
  position: relative;
  width: 200px;
  margin: 0 auto;
  margin-top: 220px;
}
#menubar-menus{
  width:200px;
}
#menubar-menus > li{
  width: 200px !important;
  display: block;
}
#menubar-menus > li > a{
  width: 200px ;
  font-size: 30px;
  letter-spacing: -0.08em; 
  color: #999;
  font-weight: lighter;
  transition: 0.3s all;
}
#menubar-menus > li > a:hover{
  color: #3b4db7;
  padding-left: 10px;
}
.user_info{
  font-size: 20px;
  color: #eee;
}
#tnb ul li{
  font-size: 20px;
  color: #eee;
}

.site-footer{
  position : absolute;
  bottom:0;
  padding: 10px 40px;
  background:none;
  width:100%;
}
.site-footer .text-center{
  width:100%;
  color: #ddd;
}
</style>

<div class="loading" style="display:none">
    O
</div>
<div class="row" id="main_all_wrap">


<? 
switch ($member['mb_3']) {
  case 1  : $repre = "원룸";
               break;
  case 2  : $repre = "아파트/오피스텔";
               break;
  case 3  : $repre = "상가";
               break;
  case 4  : $repre = "토지";
               break;
  default    : $repre = "대표 부동산을 설정 해 주세요.";
               break;
}
?>

      <!-- user_info_wrap -->
      <div class="user_info_bg"></div>
      <ul class="user_info_wrap">
            <div class="user_info_close">
              <i class="fa fa-times"></i>
            </div>

            
            <li id="arm_title">환경설정</li>
            
            <div class="user_info_member">
              <div class="user_info_pic">
              <img src="http://real-note.co.kr/img/contact_img/profile.jpg" alt="프로필 이미지" width="120">
              </div>
              <li><b><?=$member['mb_nick']?></b><br>나의매물 <b><?php echo number_format($write_count) ?></b>건 <br> 대표부동산 <b><?=$repre?></b></li>
            </div> 

            <div class="user_info_list">
            <? if($gr_cp){ ?>
              <a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=register_form_default.php"><li>정보수정</li></a>
            <?}else{?>
              <a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=register_form.php"><li>정보수정</li></a>
              <?}?>
              <? if ($is_member){ ?>
                <a href="<?php echo G5_BBS_URL ?>/logout.php"><li>로그아웃</li></a>
              <?}else{?>
                <a href="<?php echo G5_URL ?>"><li>로그인</li></a>
              <?}?>

          <? if ($gr_admin){?>
            <form method = "get" action="<?echo G5_BBS_URL?>/board.php">
              <input type="hidden" name="office_write" value="1">
              <input type="hidden" name="wr_sale_type" value="1">
              <input type="hidden" name="wr_important" value="1">
              <input type="hidden" name="wr_office_permission" value="1">
              <input type="hidden" name="office_write" value="1">
              <input type="hidden" name="bo_table" value="<?=$member['mb_id']?>">
              <!-- <input type="submit" value="사무실매물승인" style="background:#fff; color:#323e51; font-size:16px; border:0; padding:15px 0;"> -->
            </form>
            <a href="<?php echo G5_BBS_URL?>/group_confirm.php?bo_table=<?=$member['mb_id']?>"><li>직원신청현황</li></a>
            <a href="<?php echo G5_BBS_URL?>/group_member_list.php?bo_table=<?=$member['mb_id']?>"><li>직원목록</li></a>
            <a href="<?php echo G5_BBS_URL?>/group_write_auth.php"><li>등록권한설정</li></a>
        <?}?>
        </div>


          </ul>
      <!-- exit user_info_wrap -->
      


<section id="main_left_wrap">
          <!--header start-->
  <header class="header black-bg">
        <div id="menubar">
          <ul id="menubar-menus">
            

          <li><a href="#" class="test">테스트</a> </li>


          <li>
          <?if (!$wr_important && $wr_writer_id == $member[mb_id] && $is_member){ ?>
              <? if ($gr_admin){ ?>
                <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?=$member[mb_id] ?>&board_list=<?=$member[mb_3]?>&wr_sale_type=1&wr_writer_id=<?=$member[mb_id] ?>" style="letter-spacing:.5px;color:#e8b82e!important;">마이노트</a>
              <?}else{ ?>
                <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<? echo $member['mb_id']?>&board_list=<?=$member[mb_3]?>&wr_sale_type=1&wr_writer_id=<?=$member[mb_id] ?>" style="letter-spacing:.5px;color:#e8b82e!important;">마이노트</a>
              <?}?>

          <?}else{?>

            <? if ($gr_admin){ ?>
                <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?=$member[mb_id] ?>&board_list=<?=$member[mb_3]?>&wr_sale_type=1&wr_writer_id=<?=$member[mb_id] ?>" style="letter-spacing:.5px; ">마이노트</a>
              <?}else{ ?>
                <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?=$member[mb_id] ?>&board_list=<?=$member[mb_3]?>&wr_sale_type=1&wr_writer_id=<?=$member[mb_id] ?>" style="letter-spacing:.5px; ">마이노트</a>
              <?}?>


              
            <?}?>


          </li>

          <li>

            <?if ($wr_important == '1' ){ ?>

                <? if ($gr_admin){ ?>
                  <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<? echo $member['mb_1']?>&board_list=<?=$member[mb_3]?>&wr_important=1&wr_sale_type=1&wr_office_permission=" style="letter-spacing:.5px; color:#e8b82e!important;">오피스노트</a>
                <?}else{ ?>
                  <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<? echo $member['mb_1']?>&board_list=<?=$member[mb_3]?>&wr_important=1&wr_sale_type=1&wr_office_permission=2" style="letter-spacing:.5px; color:#e8b82e!important;">오피스노트</a>
                <?}?>

            <?}else{?>
                <? if ($gr_admin){ ?>
                  <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<? echo $member['mb_1']?>&board_list=<?=$member[mb_3]?>&wr_important=1&wr_sale_type=1&wr_office_permission=" style="letter-spacing:.5px;">오피스노트</a>
                <?}else{ ?>
                  <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<? echo $member['mb_1']?>&board_list=<?=$member[mb_3]?>&wr_important=1&wr_sale_type=1&wr_office_permission=2" style="letter-spacing:.5px;">오피스노트</a>
                <?}}?>
          </li>

          <li>
            <?if ($wr_sold_out == '3'){ ?>
                  <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<?=$member['mb_id']?>&board_list=<?=$member[mb_3]?>&wr_important=&wr_sold_out=1&wr_sale_type=1" style="letter-spacing:.5px; color:#e8b82e!important;">거래종료</a>
            <?}else{?>
                  <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<?=$member['mb_id']?>&board_list=<?=$member[mb_3]?>&contact=1" style="letter-spacing:.5px;" class="contact">고객관리</a>
            <?}?>
          </li>

          <li>
            <?if ($wr_important == '2' && $wr_important == '1'){ ?>
                  <a href="<?php echo G5_BBS_URL?>/bookmark.php?bo_table=<? echo $member['mb_id']?>&board_list=<?=$member[mb_3]?>&wr_bookmark=1" style="letter-spacing:.5px; color:#e8b82e!important;">즐겨찾기</a>
            <?}else{?>
                  <a href="<?php echo G5_BBS_URL?>/bookmark.php?bo_table=<? echo $member['mb_id']?>&board_list=<?=$member[mb_3]?>&wr_bookmark=1" style="letter-spacing:.5px;">즐겨찾기</a>
            <?}?> 
          </li>
          </ul>
          </div>
        </header>

          <div class="user_info">
          <i class="fa fa-cog"></i>
          </div>

        <div class="memo">

          <?php include_once(G5_PATH.'/plugin/srd-pushmsg/pushmsg_view.php'); ?>
        </div>

      <!--header end-->
              
</section>



<section id="main_right_wrap">
             <div class="visual_contents">
             <img src="<?echo G5_URL?>/img/main_img/visual_text.png" width="100%" >
                
              </div>

              <div class="register">
                <?php echo outlogin('basic'); ?>
              
                <!-- <? if($is_member){
                }else{?>
                <div class="register_wrap">
                  <h5>RNote가 처음이세요?<h5>
                    <input type="button" id="ol_submit" value="회원가입" style="border:1px solid rgba(255,255,255,0.6); width:298px" onclick="window.location.href='<?php echo G5_BBS_URL ?>/register.php' ">
                </div>
                <?}?> -->

             
                <? if($is_member && $member[mb_2] == null || $member[mb_2] == 'waiting'){?>
                  <div class="register_wrap">
                    <h5>소속된 공인중개사에 가입신청을 해보세요<h5>
                      <? if ($member[mb_2] == 'waiting'){ ?>
                        <p class="Office_register_check">가입수락 대기 중입니다.</p>
                      <?}else{?>
                      <input type="button" id="ol_submit" value="가입신청" style="border:1px solid rgba(255,255,255,0.6); width:298px; float:none; " onclick="window.location.href='<?php echo G5_BBS_URL ?>/group_resister.php' ">
                      <?}?>
                  </div> 
                <?}?>
              </div>



              <footer class="site-footer">
        <div class="text-center">
        <ul>
        <li>RNote</li>
        <li>(주)리차드막스</li>
        <li>사업자등록번호 104-658-98336 l 통신판매업신고 2017-부산남구-00658</li>
        <li>Rnote ⓒ 2017 RichardMarks. All rights reserved</li>
        <li>이용약관 l <span style="color:#e65f5f;">개인정보취급방침</span></li>
        </ul>
        <a href="index.html#" class="go-top"><i class="fa fa-bars"></i></a>

        </div>
        </footer>
  
</section>



             
</div>





 


<script>
 var Cheight = $(window).height();
$('#main_left_wrap,#main_right_wrap').css({'height':Cheight+'px'});
$('.user_info_bg').css({'height':Cheight+'px'});

 $(".user_info").click(function(){
    $(".user_info_wrap").fadeToggle(300);
    $(".user_info_bg").fadeToggle(300);
});

 $(".user_info_close").click(function(){
    $(".user_info_wrap").fadeToggle(300);
    $(".user_info_bg").fadeToggle(300);
});

var bourl2= "http://real-note.co.kr/bbs/board.php?bo_table=ekdna8284&board_list=3&contact=1";
$(".test").click(function(){
  $("#main_right_wrap").fadeToggle(200, function(){
    $(".header").fadeOut(200);
    $("#main_left_wrap").animate({
        width: '100%'
    },500 , function(){
      $(location).attr('href','http://real-note.co.kr/bbs/board.php?bo_table=<?=$member[mb_id]?>&board_list=3&contact=1');
    });
  });

});

// $(".center").slick({
//   variableWidth: true,
//   dots: true,
//   infinite: true,
//   arrows: false,
//   centerMode: true,
//   slidesToShow: 1,
//   slidesToScroll: 1,
//   focusOnSelect: true
// });
</script>
<?php include_once(G5_THEME_PATH.'/tail.php');?>

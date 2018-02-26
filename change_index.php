<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/main_head.php');
?>
<link href="<?php echo G5_URL?>/assets/css/slick-theme.css" rel="stylesheet">
<link href="<?php echo G5_URL?>/assets/css/slick.css" rel="stylesheet">
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
  font-size: 15px;
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
<div class="row" id="main_all_wrap">

<section id="main_left_wrap">
          <!--header start-->
  <header class="header black-bg">
        <div id="menubar">

          <ul id="menubar-menus">

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
            환경설정 <i class="fa fa-caret-down" aria-hidden="true"></i>
          <ul>
            <p class="tri2"></p>
            <li id="arm_title">사용자설정</li>
            <li style="font-size:16px; padding:10px; 0; line-height:22px; border-bottom:1px solid #eee;background:#f5f9fc"><b><?=$member['mb_nick']?></b><br>나의매물 <b><?php echo number_format($write_count) ?></b>건</li>
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
          </ul>
        </div>
        <? if ($gr_admin){?>
        <div class="more">
          <i class="fa fa-bars" aria-hidden="true"></i>
          <ul>
            <p class="tri2"></p>

            <li id="arm_title">사무실설정</li>
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
          </ul>
        </div>
        <?}?>
        <div class="memo">

          <?php include_once(G5_PATH.'/plugin/srd-pushmsg/pushmsg_view.php'); ?>
        </div>

      <!--header end-->
              
</section>



<section id="main_right_wrap">
             <div class="visual_contents">
             <img src="<?echo G5_URL?>/img/main_img/visual_text.png" width="100%" >
                <!-- <h3>대표부동산설정</h3>
                <section class="center slider">
                <div >원룸</div>
                <div>아파트/오피스텔</div>
                <div>상가</div>
                <div>토지</div>
                </section> -->
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
                      <input type="button" id="ol_submit" value="가입신청" style="border:1px solid rgba(255,255,255,0.6); width:298px" onclick="window.location.href='<?php echo G5_BBS_URL ?>/group_resister.php' ">
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
        <a href="index.html#" class="go-top"><i class="fa fa-angle-up"></i></a>

        </div>
        </footer>
  
</section>



             
</div>





 


<script src="<?php echo G5_URL?>/assets/js/slick.js" type="text/javascript" charset="utf-8"></script>
<script>
 var Cheight = $(window).height();
$('#main_left_wrap,#main_right_wrap').css({'height':Cheight+'px'});

$(".center").slick({
  variableWidth: true,
  dots: true,
  infinite: true,
  centerMode: true,
  slidesToShow: 2,
  slidesToScroll: 2,
  focusOnSelect: true
});
</script>
<?php include_once(G5_THEME_PATH.'/tail.php');?>

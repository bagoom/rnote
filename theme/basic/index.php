<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>
<link href="<?php echo G5_URL?>/assets/icon_font/css/fontello.css" rel="stylesheet">
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

</style>
<div class="row">
              <section id="visual_wrap">
              <div class="visual_contents">
              <img src="<?echo G5_URL?>/img/main_img/visual_text.png" width="90%" style="margin: 0 0 10px 20px">

              <div class="register">
                <?php echo outlogin('basic'); ?>

                <? if($is_member){
                }else{?>
                <div class="register_wrap">
                  <h5>RNote가 처음이세요?<h5>
                    <input type="button" id="ol_submit" value="회원가입" style="border:1px solid rgba(255,255,255,0.6); width:298px" onclick="window.location.href='<?php echo G5_BBS_URL ?>/register.php' ">
                </div>
                <?}?>

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
              </div>
            </section>


              <section id="main_contents">
                  <div class="main_con_wrap table" style="box-shadow:none;">
                    <ul>
                      <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<? echo $member['mb_id']?>&sfl=board_list&stx=1">
                        <li>
                          <i class=" icon-home-outlined"></i>
                          <p class="icon_02">원룸/오피스텔</p>
                        </li>
                      </a>
                      <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<? echo $member['mb_id']?>&sfl=board_list&stx=2">
                        <li>
                          <i class="icon-residential-area-outlined"></i>
                            <p class="icon_02"> 아파트</p>
                        </li>
                      </a>
                      <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<? echo $member['mb_id']?>&sfl=board_list&stx=3&wr_sale_type=1&wr_writer=<?=$member[mb_id]?>">
                        <li>
                          <i class="icon-money-outlined"></i>
                            <p class="icon_02"> 상가</p>
                        </li>
                      </a>
                      <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<? echo $member['mb_id']?>&sfl=board_list&stx=1">
                        <li>
                          <i class="icon-layout-outlined"></i>
                            <p class="icon_02"> 토지</p>
                        </li>
                      </a>
                
                    </ul>
                  </div>
              </section>
</div>









<?php include_once(G5_THEME_PATH.'/tail.php');?>

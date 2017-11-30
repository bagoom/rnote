<?php
// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
// include G5_BBS_PATH.'/newwin.inc.php';

if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if($member[mb_id])
{
    $checktime = mktime(date("H"),date("i")-10,date("s"),date("m"),date("d"),date("Y")); // 시간지정
    if($_SESSION['ss_login_time'] && ($_SESSION['ss_login_time'] < $checktime)) {
        // 페이지를 연 시점이 되어있고, 저장된 시간이 특정시간 이전일때
        goto_url(G5_BBS_URL."/logout.php",$urlencode); // 강제 로그아웃
    } else {
        // 로그인 타임(페이지를 연 시간)이 없거나, 특정시간을 넘기지 않은 경우는 시간재저장
        $login_time = mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")); // 현재시간 저장
        set_session("ss_login_time", $login_time);
    }
}


// // 테마 head.sub.php 파일
// if(!defined('G5_IS_ADMIN') && defined('G5_THEME_PATH') && is_file(G5_THEME_PATH.'/head.sub.php')) {
//     require_once(G5_THEME_PATH.'/head.sub.php');
//     return;
// }

$begin_time = get_microtime();

// if (!isset($g5['title'])) {
//     $g5['title'] = $config['cf_title'];
//     $g5_head_title = $g5['title'];
// }
// else {
//     $g5_head_title = $g5['title']; // 상태바에 표시될 제목
//     $g5_head_title .= " | ".$config['cf_title'];
// }

// 현재 접속자
// 게시판 제목에 ' 포함되면 오류 발생
$g5['lo_location'] = addslashes($g5['title']);
if (!$g5['lo_location'])
    $g5['lo_location'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
$g5['lo_url'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
if (strstr($g5['lo_url'], '/'.G5_ADMIN_DIR.'/') || $is_admin == 'super') $g5['lo_url'] = '';

/*
// 만료된 페이지로 사용하시는 경우
header("Cache-Control: no-cache"); // HTTP/1.1
header("Expires: 0"); // rfc2616 - Section 14.21
header("Pragma: no-cache"); // HTTP/1.0
*/
?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<?php
if (G5_IS_MOBILE) {
    echo '<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes">'.PHP_EOL;
    echo '<meta name="HandheldFriendly" content="true">'.PHP_EOL;
    echo '<meta name="format-detection" content="telephone=no">'.PHP_EOL;
} else {
    echo '<meta http-equiv="imagetoolbar" content="no">'.PHP_EOL;
    echo '<meta http-equiv="X-UA-Compatible" content="IE=Edge">'.PHP_EOL;
}

if($config['cf_add_meta'])
    echo $config['cf_add_meta'].PHP_EOL;
?>
<title><?php echo $g5_head_title; ?></title>
<!-- <link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/<?php echo G5_IS_MOBILE ? 'mobile' : 'default'; ?>.css?ver=<?php echo G5_CSS_VER; ?>"> -->
<!-- Bootstrap core CSS -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/moonspam/NanumSquare/master/nanumsquare.css"> -->
<link href="<?php echo G5_URL ?>/assets/css/bootstrap.css" rel="stylesheet">
<!--external css-->
<link href="<?php echo G5_URL ?>/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo G5_URL ?>/assets/css/zabuto_calendar.css">
<link rel="stylesheet" type="text/css" href="<?php echo G5_URL ?>/assets/js/gritter/css/jquery.gritter.css" />
<link rel="stylesheet" href="<?php G5_PATH?>/assets/css/style2.css">
<link rel="stylesheet" type="text/css" href="<?php echo G5_URL ?>/assets/lineicons/style.css">
<link rel="stylesheet" href="https://cdn.rawgit.com/studio392/NanumSquareRound/master/NanumSquareRound.css" />
<!-- Custom styles for this template -->
<link href="<?php echo G5_URL ?>/assets/css/style.css" rel="stylesheet">
<link href="<?php echo G5_URL ?>/assets/css/style-responsive.css" rel="stylesheet">


<!--[if lte IE 8]>
<script src="<?php echo G5_JS_URL ?>/html5.js"></script>
<![endif]-->
<script>
// 자바스크립트에서 사용하는 전역변수 선언
var g5_url       = "<?php echo G5_URL ?>";
var g5_bbs_url   = "<?php echo G5_BBS_URL ?>";
var g5_is_member = "<?php echo isset($is_member)?$is_member:''; ?>";
var g5_is_admin  = "<?php echo isset($is_admin)?$is_admin:''; ?>";
var g5_is_mobile = "<?php echo G5_IS_MOBILE ?>";
var g5_bo_table  = "<?php echo isset($bo_table)?$bo_table:''; ?>";
var g5_sca       = "<?php echo isset($sca)?$sca:''; ?>";
var g5_editor    = "<?php echo ($config['cf_editor'] && $board['bo_use_dhtml_editor'])?$config['cf_editor']:''; ?>";
var g5_cookie_domain = "<?php echo G5_COOKIE_DOMAIN ?>";
var wr_office_permission = "<?php echo $wr_office_permission ?>";
var gr_admin = "<?php echo $gr_admin ?>";




// 08-17수정 어드민 경로 설정(올바른경로로이용해주세요 해결방법)
<?php if(defined('G5_IS_ADMIN')) { ?>
var g5_admin_url = "<?php echo G5_ADMIN_URL; ?>";
<?php } ?>

</script>


<!-- <script src="<?php echo G5_URL ?>/assets/js/jquery.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- <script src="<?php echo G5_JS_URL ?>/jquery.menu.js?ver=<?php echo G5_JS_VER; ?>"></script> -->
<script src="<?php echo G5_JS_URL ?>/common.js?ver=<?php echo G5_JS_VER; ?>"></script>
<script src="<?php echo G5_JS_URL ?>/wrest.js?ver=<?php echo G5_JS_VER; ?>"></script>
<script src="<?php echo G5_URL ?>/assets/js/bootstrap.min.js"></script>

<?php

if(G5_IS_MOBILE) {
    echo '<script src="'.G5_JS_URL.'/modernizr.custom.70111.js"></script>'.PHP_EOL; // overflow scroll 감지
}
if(!defined('G5_IS_ADMIN'))
    echo $config['cf_add_script'];
?>
</head>
<body>

  <section id="container" >

      <!--header start-->
      <header class="header black-bg">
        <div id="menubar">

          <ul id="menubar-menus">
            <a href="<? echo G5_URL?>">
              <div class="logo">
                <img src="<?G5_URL?>/img/main_img/logo.png" width="100px">
              </div>
              </a>

          <li>
          <?if (!$wr_important && $wr_writer == $member[mb_name] && $is_member){ ?>
              <? if ($gr_admin){ ?>
                <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?=$member[mb_id] ?>&board_list=<?=$member[mb_3]?>&wr_sale_type=1&wr_writer=<?=$member[mb_name] ?>" style="letter-spacing:.5px; background:#222!important;">My Note</a>
              <?}else{ ?>
                <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<? echo $member['mb_id']?>&board_list=<?=$member[mb_3]?>&wr_sale_type=1&wr_writer=<?=$member[mb_name] ?>" style="letter-spacing:.5px; background:#222!important;">My Note</a>
              <?}?>

          <?}else{?>

            <? if ($gr_admin){ ?>
                <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?=$member[mb_id] ?>&board_list=<?=$member[mb_3]?>&wr_sale_type=1&wr_writer=<?=$member[mb_name] ?>" style="letter-spacing:.5px; ">My Note</a>
              <?}else{ ?>
                <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?=$member[mb_id] ?>&board_list=<?=$member[mb_3]?>&wr_sale_type=1&wr_writer=<?=$member[mb_name] ?>" style="letter-spacing:.5px; ">My Note</a>
              <?}?>


              
            <?}?>


          </li>

          <li>

            <?if ($wr_important == '1' ){ ?>

                <? if ($gr_admin){ ?>
                  <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<? echo $member['mb_1']?>&board_list=<?=$member[mb_3]?>&wr_important=1&wr_sale_type=1&wr_office_permission=" style="letter-spacing:.5px; background:#222!important;">Office Note</a>
                <?}else{ ?>
                  <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<? echo $member['mb_1']?>&board_list=<?=$member[mb_3]?>&wr_important=1&wr_sale_type=1&wr_office_permission=2" style="letter-spacing:.5px; background:#222!important;">Office Note</a>
                <?}?>

            <?}else{?>
                <? if ($gr_admin){ ?>
                  <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<? echo $member['mb_1']?>&board_list=<?=$member[mb_3]?>&wr_important=1&wr_sale_type=1&wr_office_permission=" style="letter-spacing:.5px;">Office Note</a>
                <?}else{ ?>
                  <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<? echo $member['mb_1']?>&board_list=<?=$member[mb_3]?>&wr_important=1&wr_sale_type=1&wr_office_permission=2" style="letter-spacing:.5px;">Office Note</a>
                <?}}?>
          </li>

          <li>
            <?if ($wr_sold_out == '3'){ ?>
                  <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<?=$member['mb_id']?>&board_list=<?=$member[mb_3]?>&wr_important=&wr_sold_out=1&wr_sale_type=1" style="letter-spacing:.5px; background:#222!important;">거래종료</a>
            <?}else{?>
                  <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<?=$member['mb_id']?>&board_list=<?=$member[mb_3]?>&wr_important=&wr_sold_out=1&wr_sale_type=1" style="letter-spacing:.5px;">거래종료</a>
            <?}?>
          </li>

          <li>
            <?if ($wr_important == '2' && $wr_important == '1'){ ?>
                  <a href="<?php echo G5_BBS_URL?>/bookmark.php?bo_table=<? echo $member['mb_id']?>&board_list=<?=$member[mb_3]?>&wr_bookmark=1" style="letter-spacing:.5px; background:#222!important;">즐겨찾기</a>
            <?}else{?>
                  <a href="<?php echo G5_BBS_URL?>/bookmark.php?bo_table=<? echo $member['mb_id']?>&board_list=<?=$member[mb_3]?>&wr_bookmark=1" style="letter-spacing:.5px;">즐겨찾기</a>
            <?}?> 
          </li>
          </ul>
          </div>
        </header>

        <!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">
                 <i class="fa fa-plus-circle" style="padding:0 3px;" aria-hidden="true"></i>
                  <? if ($wr_id){echo 매물수정하기; }else{ echo 매물등록하기;} ?>
                </h4>
              </div>
              <div id="tab" class="btn-group" data-toggle="buttons" style="width:100%;">
                <a href="#rent" class="btn btn-primary active rent" data-toggle="tab" style="width:50%; padding:20px; border-radius:0; margin-left:0.5px; ">
                            <input type="radio" />임대</a>
                <a href="#sale" class="btn btn-primary sale" data-toggle="tab" style="width:50%; padding:20px; border-radius:0; border-left:1px solid #eee; ">
                            <input type="radio" />매매</a>
              </div>
              <div class="modal-body"  id="Context">
                <!-- 모달창 내용 -->
              <!-- </div>

            </div>
          </div>
        </div> -->

<div class="user_info">
  <i class="fa fa-user" aria-hidden="true"></i>
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
      <script type="text/javascript">

        $(window).on("scroll", function() {
      if($(window).scrollTop() > 100) {
          $("header").addClass("active");
      } else {
          //remove the background property so it comes transparent again (defined in your css)
         $(".header").removeClass("active");
            }
        });

        if(g5_bo_table) {
          // $("#menubar-menus > li > a").css({'color':'#eee',});
          $(".header").css({'min-height':'75px'});
          $(".black-bg").css({'background':'transparent'});
        }
        $(".user_info").click(function(){
           $(".user_info ul").fadeToggle(300);
           $(".more ul").fadeOut(300);
           $("#dd_arm").fadeOut(300);
        });
        $(".more").click(function(){
           $(".more ul").fadeToggle(300);
           $(".user_info ul").fadeOut(300);
           $("#dd_arm").fadeOut(300);
        });



      </script>

      <!--sidebar end-->
      <section id="main-content">
          <section class="wrapper">

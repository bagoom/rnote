<?php
// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
// include G5_BBS_PATH.'/newwin.inc.php';

if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if($member[mb_id])
{
    $checktime = mktime(date("H"),date("i")-25,date("s"),date("m"),date("d"),date("Y")); // 시간지정
    if($_SESSION['ss_login_time'] && ($_SESSION['ss_login_time'] < $checktime)) {
        // 페이지를 연 시점이 되어있고, 저장된 시간이 특정시간 이전일때
        goto_url(G5_BBS_URL."/logout.php",$urlencode); // 강제 로그아웃
    } else {
        // 로그인 타임(페이지를 연 시간)이 없거나, 특정시간을 넘기지 않은 경우는 시간재저장
        $login_time = mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")); // 현재시간 저장
        set_session("ss_login_time", $login_time);
    }
}  

$begin_time = get_microtime();

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
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/moonspam/NanumSquare/master/nanumsquare.css"> -->
<link href="<?php echo G5_URL ?>/assets/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo G5_URL ?>/assets/css/zabuto_calendar.css">
<link rel="stylesheet" type="text/css" href="<?php echo G5_URL ?>/assets/js/gritter/css/jquery.gritter.css" />
<link rel="stylesheet" href="<?php G5_PATH?>/assets/css/style2.css">
<link rel="stylesheet" type="text/css" href="<?php echo G5_URL ?>/assets/lineicons/style.css">
<!-- Custom styles for this template -->
<link href="<?php echo G5_URL ?>/assets/css/style.css?ver=2" rel="stylesheet">
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
var wr_id = "<?php echo $wr_id ?>";
var wr_important = "<?php echo $wr_important ?>";
var wr_office_permission = "<?php echo $wr_office_permission ?>";
var wr_sold_out = "<?php echo $wr_sold_out ?>";
var wr_sale_type = "<?php echo $wr_sale_type ?>";
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

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

      
      <script type="text/javascript">
        
      //   $(window).on("scroll", function() {
      // if($(window).scrollTop() > 100) {
      //     $("header").addClass("active");
      // } else {
      //     //remove the background property so it comes transparent again (defined in your css)
      //    $(".header").removeClass("active");
      //       }
      //   });

        if(g5_bo_table) {
          // $("#menubar-menus > li > a").css({'color':'#eee',});
          $(".header").css({'min-height':'75px'});
          $(".black-bg").css({'background':'rgba(17, 17, 17, 0.6)'});
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

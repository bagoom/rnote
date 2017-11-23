<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=322cba0807c729368c6cc0ec6e84585c"></script>
<!-- <script type="text/javascript" src="//apis.daum.net/maps/maps3.js?apikey=306678a15ccad514fa75a3b1ae02b091"></script> -->
<?$pagetype = 'view';?>
<?global $pagetype;?>
<style>
.black-bg{
  background: #222 !important;
  margin-top: 0 !important;
  padding: 0!important;
}
#bo_v_atc{
  overflow: hidden;
  padding : 30px;
}
.wrapper{
  margin-top:75px !important;
}
.view_list li{
  width: 33.333%;
  padding: 15px;
  background: #dadada;
  color: #222;
  font-size: 18px;
  margin-top: 1px;
  float: left;
}
#bo_v_img{
  width: 100%;
  height: 150px;
}
#bo_v_img img{
  width: 100%;
  height: 150px;
}
.wr_memo{
  text-align: right;
  line-height: 27px;
}
</style>
<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

                  <!-- 게시물 읽기 시작 { -->



                  <?php
                  if ($view['file']['count']) {
                      $cnt = 0;
                      for ($i=0; $i<count($view['file']); $i++) {
                          if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
                              $cnt++;
                      }
                  }
                   ?>

                  <?php if($cnt) { ?>
                  <!-- 첨부파일 시작 { -->
                  <section id="bo_v_file">
                      <h2>첨부파일</h2>
                      <ul>
                      <?php
                      // 가변 파일
                      for ($i=0; $i<count($view['file']); $i++) {
                          if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
                       ?>
                          <li>
                              <a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
                                  <img src="<?php echo $board_skin_url ?>/img/icon_file.gif" alt="첨부">
                                  <strong><?php echo $view['file'][$i]['source'] ?></strong>
                                  <?php echo $view['file'][$i]['content'] ?> (<?php echo $view['file'][$i]['size'] ?>)
                              </a>
                              <span class="bo_v_file_cnt"><?php echo $view['file'][$i]['download'] ?>회 다운로드</span>
                              <span>DATE : <?php echo $view['file'][$i]['datetime'] ?></span>
                          </li>
                      <?php
                          }
                      }
                       ?>
                      </ul>
                  </section>
                  <!-- } 첨부파일 끝 -->
                  <?php } ?>

                      <!-- 게시물 상단 버튼 시작 { -->
                      <!-- <div id="bo_v_top">
                          <?php
                          ob_start();
                           ?>
                          <?php if ($prev_href || $next_href) { ?>
                          <ul class="bo_v_nb">
                              <?php if ($prev_href) { ?><li><a href="<?php echo $prev_href ?>" class="btn_b01">이전글</a></li><?php } ?>
                              <?php if ($next_href) { ?><li><a href="<?php echo $next_href ?>" class="btn_b01">다음글</a></li><?php } ?>
                          </ul>
                          <?php } ?> -->

                          <!-- <ul class="bo_v_com"> -->
                              <!-- <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01">수정</a></li><?php } ?>
                              <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del(this.href); return false;">삭제</a></li><?php } ?>
                              <?php if ($copy_href) { ?><li><a href="<?php echo $copy_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">복사</a></li><?php } ?>
                              <?php if ($move_href) { ?><li><a href="<?php echo $move_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">이동</a></li><?php } ?> -->
<!-- <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01">수정</a></li><?php } ?> -->
                              <!-- <li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li> -->

                          <!-- </ul>
                          <?php
                          $link_buttons = ob_get_contents();
                          ob_end_flush();
                           ?>
                      </div> -->
                      <!-- } 게시물 상단 버튼 끝 -->

                      <section id="bo_v_atc">
                          <div class="col-lg-12" style="margin-bottom:25px; overflow:hidden;">
                          <!--수정/삭제버튼 11-17일 변경-->
                          <?=$GET_['office_write']?>
                          <? if($gr_admin){ ?>
                            <button class="btn btn-theme03 right  config" type="button"  style="margin-right:10px;">
                              <i class="fa fa-cog" aria-hidden="true" value="중요매물등록"  style="font-size:18px; "></i>
                              매물관리설정
                            </button>
                          <?}else if($gr_cp && $wr_important == 2){ ?>
                            <button class="btn btn-theme03 right  config" type="button"  style="margin-right:10px;">
                              <i class="fa fa-cog" aria-hidden="true" value="중요매물등록"  style="font-size:18px; "></i>
                              매물관리설정
                            </button>
                          <?}?>
                          </div>
      <form name="fboardlist" id="fboardlist" action="./copy_update.php"  method="post">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="board_list" value="<?php echo $board_list ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="spt" value="<?php echo $spt ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="sw" value="">
        <input type="hidden" name="wr_id" value="<?=$wr_id?>">
                        <div class="col-lg-1"></div>
                       <div class="col-lg-4" >
                        <div class="info_body">
                          <div class="info_head">
                            <h2 style="margin-top:5px;"><?=$view['wr_subject'];?></h2>
                            <h4><?=$view['wr_address'];?> / <?=$view['wr_sale_area'];?></h4>
                          </div>


                            <div class="info_top">
                              <ul>
                                <? $m2 = $view['wr_area_p'] *3.3;?>
                                <li>층/평<span><?  if ($view['wr_floor'] < 0) {
                                  $under_floor = str_replace('-', "", $view['wr_floor']);
                                  echo "지하".$under_floor;
                                }else echo $view['wr_floor']?>층/<?=$view['wr_area_p'];?>평(<?=$m2?>㎡)</span></li>
                                <li>보증금<span><?=$view['wr_rent_deposit'];?><span class="info_sm_span"> 만원</span></span></li>
                                <li>임대료<span><?=$view['wr_m_rate'];?><span class="info_sm_span"> 만원</span></span></li>
                                <li>권리금<span><?=$view['wr_premium_o'];?><span class="info_sm_span"> 만원</span></span></li>
                                <? $sum_pay =  $view['wr_rent_deposit']+$view['wr_premium_o'];?>
                                <li>합예산<span style="color:#FC284F;"><?=$sum_pay?><span class="info_sm_span"> 만원</span></span></li>
                              </ul>
                            </div>

                            <div class="info_mid">
                              <?  $str = $view['wr_rec_sectors'];
                                    $str2 = explode(' ', $str);
                                    $str3 = sizeof($str2)-1 ; ?>


                              <li>추천업종  <ul class="rec_list_wrap"><?for ($i = 0 ; $i < $str3 ; $i++){
                                echo '<li class="rec_list">'.$str2[$i].'</li>';
                              }?></div></li>
                            </div>

                            <div class="info_bot">
                              <li>관리번호<span><?=$view['wr_code'];?></li>
                          <? if($_GET['wr_important'] == 1){ ?>

                          <!-- 임차인연락처가 있을경우 -->
                          <?if ($gr_admin&& $view['wr_renter_contact']){?>
                                <li>임차인연락처<span><?=$view['wr_renter_contact'];?></li>
                                <li class="wr_writer">담당자
                                <span><?=$view['wr_writer']?>
                                <i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
                                </span></li>
                                <li class="wr_writer_contact">담당자연락처 <span>  <?=$view['wr_hp']?></span> </li>

                            <!-- 임대인연락처가 있을경우 -->
                            <?}else if($gr_admin&& $view['wr_lessor_contact']){?>
                                <li>임대인연락처<span><?=$view['wr_lessor_contact'];?></li>
                                  <li class="wr_writer">담당자
                                  <span><?=$view['wr_writer']?>
                                  <i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
                                  </span></li>
                                <li class="wr_writer_contact">담당자연락처 <span>  <?=$view['wr_hp']?></span> </li>

                            <!-- 직원일경우 -->
                            <?}else if(!$gr_admin){?>
                              <li class="wr_writer">담당자
                              <span><?=$view['wr_writer']?>
                              <i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
                              </span></li>
                                <li class="wr_writer_contact">담당자연락처 <span>  <?=$view['wr_hp']?></span> </li>
                              <?}?>

                              <?}else{ ?>
                                <? if($view['wr_renter_contact']){  ?>
                              <li>임차인연락처<span><?=$view['wr_renter_contact'];?></li>
                                <?}?>
                                <? if($view['wr_lessor_contact']){  ?>
                              <li>임대인연락처<span><?=$view['wr_lessor_contact'];?></li>
                                <?}}?>
                              <li>관리비<span>
                                <? if (!$view['wr_mt_cost']){
                                  echo "-";
                                }else{?>
                                  <? $slice = $view['wr_mt_cost'];
                                  if (strlen($slice) == 7){
                                      $mt_cost = substr($slice, 0, 3);
                                      echo $mt_cost.'만원';

                                    }
                                  else if(strlen($slice) == 6){
                                      $mt_cost = substr($slice, 0, 2);
                                      $mt_cost2 = substr($slice, 2, 1);
                                      if ($mt_cost2 == '0'){
                                      echo $mt_cost.'만원';
                                    }else{
                                      echo $mt_cost.'만'.$mt_cost2.'천원';
                                    }
                                    }
                                  else if(strlen($slice) == 5){
                                      $mt_cost = substr($slice, 0, 1);
                                      $mt_cost2 = substr($slice, 1, 1);
                                      if ($mt_cost2 == '0'){
                                      echo $mt_cost.'만원';
                                    }else{
                                      echo $mt_cost.'만'.$mt_cost2.'천원';
                                    }
                                    }
                                  ?>
                              <? }?></span></li>
                              <li>기타지출<span><?=$view['wr_extra_exp'];?></span></li>
                              <li style="margin-top:15px; padding-top:15px; border-top:2px solid #444">메모<span class="wr_memo"><?=nl2br($view['wr_memo']);?></span></li>
                              <li>
                                <?php
                                // 파일 출력
                                $v_img_count = count($view['file']);
                                if($v_img_count) {
                                    echo "<div id=\"bo_v_img\">\n";

                                    for ($i=0; $i<=count($view['file']); $i++) {
                                        if ($view['file'][$i]['view']) {
                                            //echo $view['file'][$i]['view'];
                                            echo get_view_thumbnail($view['file'][$i]['view']);
                                        }
                                    }

                                    echo "</div>\n";
                                }
                                 ?>
                            </li>
                            </div>
                       </div>
                     </form>
                      </div>
                            <div class="col-lg-6" >
                              <div class="col-lg-1"></div>
                              <div class="col-lg-11">
                              <div class="" id="map_area" style="width:100%; height:360px;">
                              </div>
                              <div class="" id="roadview" style="width:100%; height:360px;">
                              </div>
                            </div>
                            </div>

                          <!-- 본문 내용 시작 { -->


                          <?php//echo $view['rich_content']; // {이미지:0} 과 같은 코드를 사용할 경우 ?>
                          <!-- } 본문 내용 끝 -->

                      </section>

                      <div class="chk_confirm_wrap" >
                        <?if ($gr_admin && $wr_important == 1){}else{ ?>
                        <span class="s1">사무실매물등록</span>
                        <?}?>
                        <span class="s2">즐겨찾기등록</span>
                        <span class="s3">거래종료</span>
                        <span class="s4"  data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">수정</span>
                        <span class="s5"><a href="<?php echo $delete_href ?>"  onclick="del(this.href); return false;" style="color:#fff;">삭제</a></span>
                      </div>

<script>


  $(".config").click(function(){
  $(".chk_confirm_wrap").fadeToggle(300,"swing");
  });

  $(".s1").click(function(){
      $("#fboardlist").submit();
  });
  $(".s2").click(function(){
      $("#fboardlist").attr("action", "./bookmark.php");
      $("#fboardlist").submit();
  });
  $(".s3").click(function(){
    $("#fboardlist").attr("action", "./sale_success.php");
    $("#fboardlist").submit();
  });


$(".wr_writer").click(function(){
  $(".wr_writer_contact").slideToggle(200);
})

if (<?=$write["wr_sale_type"]?> == "1"){
$(".rent").addClass("active");
$(".sale").removeClass("active");
$('#rent').show();
$('#sale').hide();
}else if(<?=$write["wr_sale_type"]?> == "2"){
$(".rent").removeClass("active");
$(".sale").addClass("active");
$('#sale').show();
$('#rent').hide();
}




var bourl = "../bbs/write_modal.php?w=u&bo_table=<?echo $bo_table?>&board_list= <?echo $view[board_list] ?>&wr_id=<?echo $view[wr_id]?>";
$(".s4").click(function(){
  $.ajax({
  type : "POST",
  url : bourl,
  dataType : "text",
  error : function() {
      alert('통신실패!!');
  },
  success : function(data) {
      $('#Context').html(data);
  }
});
 })



$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
        var $tx;
        if(this.id == "good_button")
            $tx = $("#bo_v_act_good");
        else
            $tx = $("#bo_v_act_nogood");

        excute_good(this.href, $(this), $tx);
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});

function excute_good(href, $el, $tx)
{
    $.post(
        href,
        { js: "on" },
        function(data) {
            if(data.error) {
                alert(data.error);
                return false;
            }

            if(data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if($tx.attr("id").search("nogood") > -1) {
                    $tx.text("이 글을 비추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("이 글을 추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}
</script>


<script>
var posx = <?=$view[wr_posx]?>;
var posy = <?=$view[wr_posy]?>;

var container = document.getElementById('map_area'); //지도를 담을 영역의 DOM 레퍼런스
var options = { //지도를 생성할 때 필요한 기본 옵션
	center: new daum.maps.LatLng(posy, posx), //지도의 중심좌표.
	level: 3 //지도의 레벨(확대, 축소 정도)
};

var map = new daum.maps.Map(container, options); //지도 생성 및 객체 리턴

// 지도에 마커를 생성하고 표시한다
	var marker = new daum.maps.Marker({
	    position: new daum.maps.LatLng(posy, posx), // 마커의 좌표
	    map: map // 마커를 표시할 지도 객체
	});

  //로드뷰를 표시할 div
		var roadviewContainer = document.getElementById('roadview');
    // 로드뷰 위치
		var rvPosition = new daum.maps.LatLng(posy, posx);

    //로드뷰 객체를 생성한다
		var roadview = new daum.maps.Roadview(roadviewContainer, {
			pan: 90, // 로드뷰 처음 실행시에 바라봐야 할 수평 각
			tilt: 1, // 로드뷰 처음 실행시에 바라봐야 할 수직 각
			zoom: -1 // 로드뷰 줌 초기값
		});
    //좌표로부터 로드뷰 파노ID를 가져올 로드뷰 helper객체를 생성한다
		var roadviewClient = new daum.maps.RoadviewClient();
		// 특정 위치의 좌표와 가까운 로드뷰의 panoId를 추출하여 로드뷰를 띄운다
		roadviewClient.getNearestPanoId(rvPosition, 70, function(panoId) {
			// panoId와 중심좌표를 통해 로드뷰를 실행한다
		    roadview.setPanoId(panoId, rvPosition);
		});
		// 로드뷰 초기화가 완료되었을 때 로드뷰에 마커나 커스텀오버레이를 표시한다
		daum.maps.event.addListener(roadview, 'init', function() {
		});

</script>
<!-- } 게시글 읽기 끝 -->

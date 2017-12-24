<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<link rel="stylesheet" type="text/css" href="<?php G5_PATH?>/assets/css/map_style.css">
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
  /* height: 150px; */
}
#bo_v_img img{
  width: 100%;
  height: 150px;
}
.wr_memo{
  color:#444 !important;
  text-align: left;
  font-size:15px !important;
  font-weight:lighter!important;
  line-height: 27px;
}

.view_state_form{
  position: absolute;
  top:107px;
  left: 120px;
  z-index:10;
}
.view_state_form input[type="radio"]{
  display:none;
}
.view_permission_btn{
  padding:10px;
  font-size:14px;
  color:#fff;
  background: #aaa;
  cursor:pointer;
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

                      <!-- } 게시물 상단 버튼 끝 -->

                      <section id="bo_v_atc">
                      
                      <!-- 퍼미션 버튼 ajax   12-19일 수정 ----------------------------->
<!--
                         <div class="view_state_form">
                          <form action="./view_permission_update.php" method="post"  id="view_state" > 

                          <input type="hidden" name="wr_id" value="<?=$wr_id?>">
                          <input type="radio" value="1" id="office_permission1" name="wr_office_permission"/>
                          <input type="radio" value="2" id="office_permission2" name="wr_office_permission"/>
                          <input type="radio" value="3" id="office_permission3" name="wr_office_permission"/>
                          <input type="radio" value="" id="office_permission4" name="wr_office_permission"/>
                          
                          <label for="office_permission2" class="view_permission_btn" style="<?if ($view['wr_office_permission'] === '2') {echo "background:#3b4db7";}?>">
                          <i class="fa fa-check-circle" aria-hidden="true"></i>
                          </label>
                          <label for="office_permission1" class="view_permission_btn" style="<?if ($view['wr_office_permission'] === '1') {echo "background:#ffc107";}?>">
                          <i class="fa fa-clock-o" aria-hidden="true"></i>
                          </label>
                          <label for="office_permission3" class="view_permission_btn" style="<?if ($view['wr_office_permission'] === '3') {echo "background:#FC284F";}?>">
                          <i class="fa fa-times" aria-hidden="true"></i>
                          </label>
                          <label for="office_permission4" class="view_permission_btn" >
                          없음
                          </label>
                          
                          
                          </form> 
                          </div>     
-->    
 
 


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
                    <input type="hidden" name="wr_sale_type" value="<?=$wr_sale_type?>">
                        <div class="col-lg-1"></div>
                        
                       <div class="col-lg-4" style="padding:90px 0;" >


                          

                          <!--수정/삭제버튼 11-17일 변경-->
                          <div style="position:absolute; top :28px; right: -10px;">
                          <?=$GET_['office_write']?>
                          <? if($gr_admin){ ?>
                            <button class="btn btn-theme03 right  config" type="button"  style="margin-right:10px;">
                              <i class="fa fa-cog" aria-hidden="true" value="중요매물등록"  style="font-size:18px; "></i>
                              매물관리설정
                            </button>
                          <?}else if($gr_cp && $bo_table == "$member[mb_id]"){ ?>
                            <button class="btn btn-theme03 right  config" type="button"  style="margin-right:10px;">
                              <i class="fa fa-cog" aria-hidden="true" value="중요매물등록"  style="font-size:18px; "></i>
                              매물관리설정
                            </button>
                          <?}?>
                          </div>
                        <div class="info_body">
                          <div class="info_head">
                            <h3 style="margin-top:5px;"><?=$view['wr_subject'];?></h3>
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
                            

                            <p class="sale_view_drop">추천업종 및 기타정보
                            <i class="fa fa-chevron-circle-down" aria-hidden="true" style=""></i>
                            </p>

                            <!-- 접기시작 -->
                            <div class="sale_drop_form" >
                            <div class="info_top">
                              <?  $str = $view['wr_rec_sectors'];
                                    $str2 = explode(' ', $str);
                                    $str3 = sizeof($str2)-1 ; ?>


                              <li><p>추천업종</p>  
                              <ul class="rec_list_wrap" style-"overflow:hidden;">
                                
                                <?for ($i = 0 ; $i < $str3 ; $i++){
                                echo '<li class="rec_list">'.$str2[$i].'</li>';
                              }?>
                           </li>
                            </div>

                            <div class="info_top">
                              <li>매물번호<span class="info_sm_span"><?=$view['wr_code'];?></span></li>
                              <? if($view['wr_writer'] !== $member['mb_name']){ ?>

                          <!-- 임차인연락처가 있을경우 -->
                          <?if ($gr_admin&& $view['wr_renter_contact']){?>
                               
                                <li>임차인연락처
                                  <span>
                                  <?=$view['wr_renter_contact'];?>
                                  </span>
                                </li>

                                <li class="wr_writer">담당자
                                <span class="info_sm_span">
                                <?=$view['wr_writer']?>
                                <i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
                                </span>
                              </li>
                              
                                <li class="wr_writer_contact">담당자연락처<span class="info_sm_span"><?=$view['wr_hp']?></span> </li>

                            <!-- 임대인연락처가 있을경우 -->
                            <?}else if($gr_admin&& $view['wr_lessor_contact']){?>
                                <li>임대인연락처
                                  <?=$view['wr_lessor_contact'];?></li>
                                  <li class="wr_writer">담당자
                                  <span class="info_sm_span">
                                    <?=$view['wr_writer']?>
                                  <i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
                                  </span></li>
                                <li class="wr_writer_contact">담당자연락처<span class="info_sm_span"><?=$view['wr_hp']?></span> </li>

                            <!-- 직원일경우 -->
                            <?}else if(!$gr_admin){?>
                              <li class="wr_writer">담당자
                              <span class="info_sm_span">
                                <?=$view['wr_writer']?>
                              <i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
                              </span></li>
                                <li class="wr_writer_contact">담당자연락처<span class="info_sm_span"><?=$view['wr_hp']?></span> </li>
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
                            </div>
                            </div><!-- 접기끝 -->
                             
                            <div class="info_top ">
                            <li style=""><p>메모</p>
                              <p style="margin-bottom:0;">
                                <span class="wr_memo"><?=nl2br($view['wr_memo']);?></span></p>
                            </li>
                          </div>
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
                       </div>
                     </form>
                      </div>
                   
                            <div class="col-lg-7" style="padding:0;" >
                              <div class="col-lg-1"></div>
                              <div class="col-lg-11" style="padding:50px; padding-left:0; padding-top:92px; border-radius:10px;">
                              <div class="" id="map_area" style="width:100%; height:500px; postion:relative; border:1px solid #afafaf;">
                              <a href="http://map.daum.net/?q=<?=$view['wr_address']?>"
                               style="position:absolute; z-index:10; top: 50%; left: 50%; background:#3b4db7; padding: 15px; width:200px; height:45px; margin-top:-100px; margin-left:-100px; border-radius:5px; box-shadow:0 3px 5px rgba(0,0,0,0.25);text-align: center; color: #fff; " onClick="window.open(this.href, '', 'width=1200, height=800'); return false;"
                               >다음지도로보기</a>
                              </div>
                              <!-- <div class="" id="roadview" style="width:100%; height:360px;">
                              </div> -->
                            </div>
                            </div>




                            

                          <!-- 본문 내용 시작 { -->


                          <?php//echo $view['rich_content']; // {이미지:0} 과 같은 코드를 사용할 경우 ?>
                          <!-- } 본문 내용 끝 -->

                      </section>
                      

                      <div class="modal fade" id="layerpop" >
                        <div class="modal-dialog">
                          <div class="modal-content" style="min-width:500px !important; width:500px; margin:0 auto;">
                            <!-- header -->
                            <div class="modal-header">
                              <!-- 닫기(x) 버튼 -->
                              <button type="button" class="close" data-dismiss="modal">×</button>
                              <!-- header title -->
                              <h4 class="modal-title">사무실 매물 승인 거절</h4>
                            </div>
                            <!-- body -->
                            <div class="modal-body" style="padding-top:35px;">
                                  <select  name="confirm_unaccept" class="select" style="width:100%; height:50px;" >
                                    <option value="타인이 등록한 물건">타인이 등록한 매물</option>
                                    <option value="주소및 정보불량">주소및 정보불량</option>
                                    <option value="이미 수락한 매물">이미 수락한 매물</option>
                                    <option value="기타사유입력" >기타사유입력</option>
                                  </select>
                                  <input type="text" name="confirm_unaccept2" class="etc" style="display:none; width:100%; height:50px; margin-top:5px; text-align:center;"/>
                            </div>
                            <!-- Footer -->
                            <div class="modal-footer" style="padding:15px;">
                              <button type="button" class="btn btn-default s2" data-dismiss="modal">승인거절</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                            </div>
                          </div>
                        </div>
                      </div>

                      
                      <div class="chk_confirm_wrap" >
                        <?if ($gr_admin && $wr_important == 1){}else{ ?>
                        <span class="s1">사무실매물등록</span>
                        <?}?>
                        <?if ($gr_admin && $view[wr_office_permission]=='1') {?>
                        <span class="s6" >사무실매물로수락</span>
                        <span data-target="#layerpop" data-toggle="modal" class="s5">거절하기</span>
                        <?}else{}?>
                        <span class="s2">즐겨찾기등록</span>
                        <span class="s3">거래종료등록</span>
                        <span class="s4"><a href=" <?echo G5_HTTP_BBS_URL?>/write.php?bo_table=<?echo $bo_table?>&board_list= <?echo $view[board_list] ?>&wr_id=<?echo $view[wr_id]?>&w=u" style="color:#fff;">수정</a></span>
                        <span class="s5"><a href="<?php echo $delete_href ?>"  onclick="del(this.href); return false;" style="color:#fff;">삭제</a></span>
                      </div>
                     
<script>
$(".sale_view_drop").click(function(){
  $(".sale_drop_form").slideToggle(400);
})




// 퍼미션 상태 업데이트 ajax
$("input[name=wr_office_permission]").on('click',function () {
var formData = $('#view_state').serializeArray();
$.ajax({
url: "<?echo G5_BBS_URL?>/view_permission_update.php",
type: "POST",
data: formData,
dataType: 'text',
success: function (response) {
  location.reload();
},
error: function (jqXHR, textStatus, errorThrown) {
alert(errorThrown);
}
})
});






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
  $(".s6").click(function(){
    $("#fboardlist").attr("action", "./office_update.php");
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




var bourl = "../bbs/write.php?w=u&bo_table=<?echo $bo_table?>&board_list= <?echo $view[board_list] ?>&wr_id=<?echo $view[wr_id]?>";
$(".ddds4").click(function(){
  $.ajax({
  type : "POST",
  url : bourl,
  dataType : "text",
  error : function() {
      alert('통신실패!!');
  },
  success : function(data) {
      $('#bo_v_atc').html(data);
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
map.setZoomable(false);   
// 마커 이미지의 주소
var markerImageUrl = "<?echo G5_URL?>/img/marker.png";
markerImageSize = new daum.maps.Size(40, 42), // 마커 이미지의 크기
markerImageOptions = { 
    offset : new daum.maps.Point(20, 42)// 마커 좌표에 일치시킬 이미지 안의 좌표
};

// 마커 이미지를 생성한다
var markerImage = new daum.maps.MarkerImage(markerImageUrl, markerImageSize, markerImageOptions);

// 지도에 마커를 생성하고 표시한다
var marker = new daum.maps.Marker({
position: new daum.maps.LatLng(posy, posx), // 마커의 좌표
image : markerImage, // 마커의 이미지
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

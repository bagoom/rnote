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
                          <?}else if($gr_cp && $bo_table == "$member[mb_id]"){ ?>
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
                          <? if($view['wr_writer'] !== $member['mb_name']){ ?>

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


                            <div class="map_wrap">
    <div id="mapWrapper" style="width:50%;height:300px;float:left">
        <div id="map" style="width:100%;height:100%"></div> <!-- 지도를 표시할 div 입니다 -->
    </div>
    <div id="rvWrapper" style="width:50%;height:300px;float:left">
        <div id="roadview" style="width:100%;height:100%"></div> <!-- 로드뷰를 표시할 div 입니다 -->
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



/*
   * 아래부터 실제 지도와 로드뷰 map walker를 생성 및 제어하는 로직
   */
  var mapContainer = document.getElementById('map_area'), // 지도를 표시할 div 
      mapCenter = new daum.maps.LatLng(posy, posx), // 지도의 가운데 좌표
      mapOption = {
          center: mapCenter, // 지도의 중심좌표
          level: 3 // 지도의 확대 레벨
      };
  
  // 지도를 표시할 div와  지도 옵션으로  지도를 생성합니다
  var map = new daum.maps.Map(mapContainer, mapOption);
  
  // 로드뷰 도로를 지도위에 올린다.
  map.addOverlayMapTypeId(daum.maps.MapTypeId.ROADVIEW);
  
  var roadviewContainer = document.getElementById('roadview'); // 로드뷰를 표시할 div
  var roadview = new daum.maps.Roadview(roadviewContainer); // 로드뷰 객체
  var roadviewClient = new daum.maps.RoadviewClient(); // 좌표로부터 로드뷰 파노ID를 가져올 로드뷰 helper객체
  
  // 지도의 중심좌표와 가까운 로드뷰의 panoId를 추출하여 로드뷰를 띄운다.
  roadviewClient.getNearestPanoId(mapCenter, 50, function(panoId) {
      roadview.setPanoId(panoId, mapCenter); // panoId와 중심좌표를 통해 로드뷰 실행
  });
  
  var mapWalker = null;
  
  // 로드뷰의 초기화 되었을때 map walker를 생성한다.
  daum.maps.event.addListener(roadview, 'init', function() {
  
      // map walker를 생성한다. 생성시 지도의 중심좌표를 넘긴다.
      mapWalker = new MapWalker(mapCenter);
      mapWalker.setMap(map); // map walker를 지도에 설정한다.
  
      // 로드뷰가 초기화 된 후, 추가 이벤트를 등록한다.
      // 로드뷰를 상,하,좌,우,줌인,줌아웃을 할 경우 발생한다.
      // 로드뷰를 조작할때 발생하는 값을 받아 map walker의 상태를 변경해 준다.
      daum.maps.event.addListener(roadview, 'viewpoint_changed', function(){
  
          // 이벤트가 발생할 때마다 로드뷰의 viewpoint값을 읽어, map walker에 반영
          var viewpoint = roadview.getViewpoint();
          mapWalker.setAngle(viewpoint.pan);
  
      });
  
      // 로드뷰내의 화살표나 점프를 하였을 경우 발생한다.
      // position값이 바뀔 때마다 map walker의 상태를 변경해 준다.
      daum.maps.event.addListener(roadview, 'position_changed', function(){
  
          // 이벤트가 발생할 때마다 로드뷰의 position값을 읽어, map walker에 반영 
          var position = roadview.getPosition();
          mapWalker.setPosition(position);
          map.setCenter(position);
  
      });
  });




//지도위에 현재 로드뷰의 위치와, 각도를 표시하기 위한 map walker 아이콘 생성 클래스
function MapWalker(position){
  
      //커스텀 오버레이에 사용할 map walker 엘리먼트
      var content = document.createElement('div');
      var figure = document.createElement('div');
      var angleBack = document.createElement('div');
  
      //map walker를 구성하는 각 노드들의 class명을 지정 - style셋팅을 위해 필요
      content.className = 'MapWalker';
      figure.className = 'figure';
      angleBack.className = 'angleBack';
  
      content.appendChild(angleBack);
      content.appendChild(figure);
  
      // 커스텀 오버레이 객체를 사용하여, map walker 아이콘을 생성
      var walker = new daum.maps.CustomOverlay({
          position: new daum.maps.LatLng(posy, posx), // 마커의 좌표
          content: content,
          draggable: true,
          yAnchor: 1
      });


      this.walker = walker;
      this.content = content;
  
  

  //마커에 dragend 이벤트를 할당합니다
daum.maps.event.addListener(walker, 'dragend', function(mouseEvent) {
    var position = walker.getPosition(); //현재 마커가 놓인 자리의 좌표
    toggleRoadview(position); //로드뷰를 토글합니다
});

//지도에 클릭 이벤트를 할당합니다
daum.maps.event.addListener(map, 'click', function(mouseEvent){
    // 현재 클릭한 부분의 좌표를 리턴 
    var position = mouseEvent.latLng; 
    walker.setPosition(position);
    toggleRoadview(position); //로드뷰를 토글합니다
});

//로드뷰 toggle함수
function toggleRoadview(position){

    //전달받은 좌표(position)에 가까운 로드뷰의 panoId를 추출하여 로드뷰를 띄웁니다
    roadviewClient.getNearestPanoId(position, 50, function(panoId) {
        if (panoId === null) {
            roadviewContainer.style.display = 'none'; //로드뷰를 넣은 컨테이너를 숨깁니다
            mapWrapper.style.width = '100%';
            map.relayout();
        } else {
            map.relayout(); //지도를 감싸고 있는 영역이 변경됨에 따라, 지도를 재배열합니다
            roadviewContainer.style.display = 'block'; //로드뷰를 넣은 컨테이너를 보이게합니다
            roadview.setPanoId(panoId, position); //panoId를 통한 로드뷰 실행
            roadview.relayout(); //로드뷰를 감싸고 있는 영역이 변경됨에 따라, 로드뷰를 재배열합니다
        }
    });
}

}
  //로드뷰의 pan(좌우 각도)값에 따라 map walker의 백그라운드 이미지를 변경 시키는 함수
  //background로 사용할 sprite 이미지에 따라 계산 식은 달라 질 수 있음
  MapWalker.prototype.setAngle = function(angle){
  
      var threshold = 22.5; //이미지가 변화되어야 되는(각도가 변해야되는) 임계 값
      for(var i=0; i<16; i++){ //각도에 따라 변화되는 앵글 이미지의 수가 16개
          if(angle > (threshold * i) && angle < (threshold * (i + 1))){
              //각도(pan)에 따라 아이콘의 class명을 변경
              var className = 'm' + i;
              this.content.className = this.content.className.split(' ')[0];
              this.content.className += (' ' + className);
              break;
          }
      }
  };
  
  //map walker의 위치를 변경시키는 함수
  MapWalker.prototype.setPosition = function(position){
      this.walker.setPosition(position);
  };
  
  //map walker를 지도위에 올리는 함수
  MapWalker.prototype.setMap = function(map){
      this.walker.setMap(map);
  };
  
  
</script>
<!-- } 게시글 읽기 끝 -->

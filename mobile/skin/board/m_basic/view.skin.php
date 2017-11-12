<!-- <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script> -->
<!-- <script src="<?php G5_PATH?>/assets/js/hammer.min.js"></script> -->
<script  defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAw7dLtEfU1gcCviN1smzrbNzh3FzKjl0E&callback=initMap&language=ko">
</script>

<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<style>
.view_list li{
  width: 30%;
  padding: 15px;
  background: #dadada;
  color: #222;
  font-size: 18px;
  margin-top: 1px;
  margin-left: 1px;
  float: left;
}
</style>
<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

                  <!-- 게시물 읽기 시작 { -->
                  <section id="bo_v_atc">



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
                          <?php } ?>

                          <ul class="bo_v_com">
                              <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01">수정</a></li><?php } ?>
                              <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del(this.href); return false;">삭제</a></li><?php } ?>
                              <?php if ($copy_href) { ?><li><a href="<?php echo $copy_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">복사</a></li><?php } ?>
                              <?php if ($move_href) { ?><li><a href="<?php echo $move_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">이동</a></li><?php } ?>
                              <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01">수정</a></li><?php } ?>
                              <li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li>

                          </ul>
                          <?php
                          $link_buttons = ob_get_contents();
                          ob_end_flush();
                           ?>
                      </div> -->
                      <!-- } 게시물 상단 버튼 끝 -->


                      <div >
                        <div class="tab-pane active" id="map_area">
                        </div>

                      </div>

                      <div class="btn-group" style="width:100%;">
                        <input type="button" class="btn btn-primary" id="show_map"value="로드뷰보기"  style="width:100%; padding:10px;"  onclick="toggleStreetView();"></input>
                        </div>
                      <?php $board_list = $view['board_list']; ?>



                      <div class="view_title">
                        <h3><?=$view['wr_subject'];?></h3>
                        <p><?=$view['wr_address'];?>/ <?=$view['wr_sale_area'];?></p>
                        <p class="view_price">
                          <?  if ($view['wr_floor'] < 0) {
                              $under_floor = str_replace('-', "", $view['wr_floor']);
                            echo "지하".$under_floor;
                          }else echo $view['wr_floor']?>층/<?=$view['wr_area_p'];?>평 <?=$view['wr_rent_deposit'];?>/<?=$view['wr_m_rate'];?>/<?=$view['wr_premium_o'];?></p>
                      </div>

                      <div class="view_contents">
                        <h4>매물기타정보</h4>
                        <li> <div class="col-xs-4">추천업종</div> <div class="col-xs-8"><?=$view['wr_rec_sectors']?></div></li>
                        <li> <div class="col-xs-4">임차인연락처</div> <div class="col-xs-8">
                          <?if (is_admin){
                            echo $view['wr_renter_contact'];
                          }else {} ?>
                        </div></li>
                        <li> <div class="col-xs-4">임대인연락처</div> <div class="col-xs-8"></div></li>
                        <li> <div class="col-xs-4">메모</div> <div class="col-xs-8"><?=$view['wr_memo'];?></div></li>
                        <li style="border-top:1px solid #ddd;"> <div class="col-xs-4" >관리비</div> <div class="col-xs-8">
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

                        <? }?>
                        </div></li>
                        <li> <div class="col-xs-4">기타지출</div> <div class="col-xs-8">
                          <? if (!$view['wr_extra_exp']){
                            echo "-";
                          }else{?>
                          <?=$view['wr_extra_exp'];?>만원
                        <? }?>
                        </div></li>

                      </div>







                      <div class="view_button_wrap">
                      <a class='btn btn-primary btn-lg' href="#" style="width:50%;float:left; border-right:1px solid #fff;" ><i class='fa fa-pencil' ></i> 공유하기</a>

                      <a class='btn btn-primary btn-lg' href="../bbs/write.php?w=u&bo_table=<?echo $bo_table?>&board_list= <?echo $view[board_list] ?>&wr_id=<?echo $view[wr_id]?>" style="width:50%;"><i class='fa fa-pencil'></i> 수정하기</a>
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
                        
                          <?php//echo $view['rich_content']; // {이미지:0} 과 같은 코드를 사용할 경우 ?>
                          <!-- } 본문 내용 끝 -->

                      </section>

                      <?php
                      include_once(G5_SNS_PATH."/view.sns.skin.php");
                      ?>


<script>
<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
});
<?php } ?>

function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>

<script>
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
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>

<script>
var panorama;
var posx = <?=$view[wr_posx]?>;
var posy = <?=$view[wr_posy]?>;

function initMap() {
  var astorPlace = {lat: posy, lng: posx};

  // Set up the map
  var map = new google.maps.Map(document.getElementById('map_area'), {
    center: astorPlace,
    zoom: 18,
    mapTypeControl: false,
    streetViewControl: false
  });
  var marker = new google.maps.Marker({
          position: astorPlace,
          map: map
        });
  panorama = map.getStreetView();
  panorama.setPosition(astorPlace);
  panorama.setPov(/** @type {google.maps.StreetViewPov} */({
    heading: 265,
    pitch: 0
  }));
}

function toggleStreetView() {
  var toggle = panorama.getVisible();
  if (toggle == false) {
    panorama.setVisible(true);
    document.getElementById("show_map").value = "지도보기";
  } else {
    panorama.setVisible(false);
    document.getElementById("show_map").value = "로드뷰보기";
  }
}

</script>
<!-- } 게시글 읽기 끝 -->

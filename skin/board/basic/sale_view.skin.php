<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<link rel="stylesheet" href="<?php G5_PATH?>/assets/css/toastr.min.css">
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
  height: 150px;
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
#bookmark .modal-body h4{
  font-size:15px;
  margin:0;
  padding: 20px;
  color:#444;
}
.bookmark_check_list_wrap{
  width:40%;
  height:400px;
  float:left;
  border-right: .5px solid #d1d1d1;
}
.check_list ul li:first-child{
  border-top:0.5px solid #d1d1d1;
}
.check_list ul li{
  padding: 10px;
  border-bottom: 0.5px solid #d1d1d1;
  font-size:12px;
  color:#888;
}
.folder_list{
  width:60%;
  height:400px;
  float:left;
  overflow-y:auto;
}
.map_board_list {
  position: relative;
  width: 100%;
  padding: 15px;
  line-height:22px;
  font-size: 14px;
  color:#666;
  background:#f7f7f7;
  border-top: 0.5px solid #d1d1d1;
  cursor: pointer;
  overflow:hidden;
}
.map_board_list:last-child{
  border-bottom:.5px solid #d1d1d1;
}
.map_board_list:hover{
  font-weight: 700;
}
.list_check_label{
  position:absolute;
  top:0;
  left:0;
  width:100%;
  height:70px;
  line-height:70px;
  display:none;
  text-align:center;
  font-size:25px;
  color:#fff;
  background: rgba(0,0,0,0.5);
  cursor:pointer;
}
.folder_add_btn{
  width: 20%;
  height:56px;
  float:right;
  line-height:40px;
  padding : 10px;
  font-size:20px;
  color:#3b4db7;
  text-align: center;
  border-left: .5px solid #d1d1d1;
  cursor:pointer;
}
.folder_add_wrap{
  position: absolute;
  top:55.5px;
  left:498.5px;
  width: 400px;
  height: 400px;
  border-left: .5px solid #d1d1d1;
  background: #fff;
  display:none;
}
.folder_add_wrap h4{
  font-size:15px;
  margin:0;
  padding: 20px;
  text-align: center;
  color:#444;
  border-bottom: .5px solid #d1d1d1;
}
.find_txt{
  padding-top:4px;
}
.modal_sec{
  padding: 20px;
  border-bottom: 0.5px solid #ccc; 
  overflow:hidden;
}
.modal_sec:last-child{
  border:0;
}
.folder_add_wrap input[type=text]{
  width:80%;
  height: 50px;  
  padding-left: 10px ;
  font-size: 14px;
  float:left;
}
.folder_add_wrap label:first-child{
  width: 20%;
  float:left;
  padding-top:18px;
  font-size: 14px;
}
.circle-nicelabel + label{
  background-color: #3b4db7;
}
.margin_zero{
  margin:0 !important;
}
.modal_footer{
  position: absolute;
  left:0;
  bottom:0;
  width: 100%;
  padding: 10px;
  text-align: center;
  font-size:16px;
  color:#fff;
  background: #3b4db7;
  cursor: pointer;
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
                      <section id="bo_v_atc">
                      
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
                          <?$wr_area_p_sale=explode(",",$view['wr_area_p']);
                              $wr_area_m_sale=explode(",",$view['wr_area_m']);
                              $wr_address_sale=explode(",",$view['wr_address_sale']);
                              // $wr_area_p_sale = count($wr_area_p_sale);
                          ?>
                 
                            <h3 style="margin-top:5px;"><?=$view['wr_subject'];?></h3>
                            <h4><?=$view['wr_address'];?>
                            <?if (count($wr_address_sale) > 1) {?>                           
                             외 (<?=count($wr_address_sale);?>)필지 </h4>
                             <?}?>
                            <h4>지목 <?=$view[wr_rand_type]?> / 지역지구 <?=$view[wr_zoning_district]?></h4>
                            <h4>건물층수 <?=$view[wr_floor]?>층 / 연면적 <?=$view[wr_gross_area]?>평</h4>
                          </div> 

                            <!-- 지번정보 -->
                            <div class="info_top">
                              <ul>

                                <? $m2 = $view['wr_area_p'] *3.3;?>
                                <li class="wr_land">대지면적
                                <span>
                                <?=$view[wr_area_p_all]?>평 
                                <span class="info_sm_span">
                                [<?=$view[wr_area_m_all] ?>㎡]
                                </span>
                                <i class="fa fa-angle-down" aria-hidden="true" style="padding:0 3px 0 2px; border-radius:2px; background:#3b4db7; color:#fff;"></i>
                                </span>
                                </li> 
                                <div class="wr_sale_area" style="display:none;">
                                <? for ($i=0; $i<count($wr_address_sale); $i++) { ?>
                                <li style="font-size:14px; background:#fff; margin:5px 0; border:1px solid #eee; padding:10px;"> 
                                  <?=$wr_address_sale[$i]?>  <?=$wr_area_p_sale[$i]?>평 <?=$wr_area_m_sale[$i]?>㎡ </li>
                                <?}?>
                                </div>
                                  
                                <li>총매도가
                                  <span class="info_sm_span">만]</span>
                                  <span><?=$view[wr_p_sale_price]?></span>
                                  <span class="info_sm_span"> [평당</span>
                                  <span class="sale_price" style="margin-right:5px;"></span>
                              </li>

                              <!-- <li>매도절충가
                                  <?=$view['wr_sale_price_b']?>
                              </li> -->

                                <li>실인수가
                                  <span class="wr_silinsu"> </span>
                                </li>

                            
                              </ul>
                            </div>

                            <!-- 가격정보 -->
                            <p class="sale_view_drop">대출 및 임차관계
                            <i class="fa fa-chevron-circle-down" aria-hidden="true" style=""></i>
                            </p>

                            <!-- 접기시작 -->
                            <div class="sale_drop_form" >
                            <div class="info_top">
                              <ul>
                                <li>
                                대출금<span><?=$view['wr_loan'];?><span class="info_sm_span"> 만원 (금리</span><? $int_rate = ($view[wr_int_rate] == '0') ?  "4" : $view[wr_int_rate] ?><?=$int_rate?><span class="info_sm_span">%)</span></span></li>
                                <li>이자<span><span class="info_sm_span">월</span><?=$view['wr_mon_int'];?><span class="info_sm_span">만원 (연</span><?=$view['wr_year_int'];?><span class="info_sm_span">만원)</span></span></li>
                              </ul>
                            </div>
                            <!-- 임대현황 -->
                            <div class="info_top">
                              <ul>
                                <li>보증금/임대료<span><?=$view['wr_sale_deposit'];?><span class="info_sm_span">만원</span><span class="info_sm_span"> </span><?=$view['wr_total_rfee'];?><span class="info_sm_span">만원</span></span></li>
                                <li>연임대수익<span><?=$view['wr_year_rate'];?><span class="info_sm_span">만원</span></li>
                              </ul>
                            </div> 
                            <!-- 수익성 -->
                            <div class="info_top profit_rate">
                              <ul>
                                
                                <li>연간순수익<span><?=$view['wr_year_income'];?><span class="info_sm_span">만원(월순수익</span><?=$view[wr_mon_income]?><span class="info_sm_span">만원)</span>
                                
                                </li>
                                <li>수익률<span><?=$view['wr_profit_rate'];?><span class="info_sm_span">%</span></span></li>
                              </ul>
                            </div> 
                            </div> <!-- 접기끝 -->

               
                            <div class="info_top ">
                              <li>매물번호
                                  <span class="info_sm_span">
                                  <?=$view['wr_code'];?>
                                  </span>
                                </li>
                              <li class="wr_writer">담당자
                                <span class="info_sm_span">
                                <?=$view['wr_writer']?>
                                <i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
                                </span>
                              </li>
                              
                                <li class="wr_writer_contact" style="display:none;">담당자연락처<span class="info_sm_span"><?=$view['wr_hp']?></span> </li>
                              <li>매도인연락처
                                   <span class="info_sm_span">
                                  <?=$view['wr_seller_contact'];?>
                                  </span>
                                </li>
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
                        

                      <div class="modal fade" id="bookmark" >
                <div class="modal-dialog">
                  <div class="modal-content" id="bookmark_con" style="min-width:500px !important; width:500px; margin-top:150px; margin:0 auto">
                    <!-- header -->
                    <div class="modal-header">
                      <!-- 닫기(x) 버튼 -->
                      <button type="button" class="close" data-dismiss="modal">×</button>
                      <!-- header title -->
                      <h4 class="modal-title">즐겨찾기 폴더 선택</h4>
                    </div>
                    <!-- body -->
                    <div class="modal-body" style="padding:0; height: 400px;">
                            <div class="bookmark_folder">
                                <div class="bookmark_check_list_wrap">
                                    <h4>선택한 매물</h4>
                                    <div class="check_list">
                                      <ul>
                                      <!-- 체크한 리스트 매물 목록 -->
                                    </ul>
                                    </div> 
                                  </div> 
                                <div class="folder_list">
                                    
                                              
                                </div>
                            </div>
                          
                    </div>
                      </form>

                    <div class="folder_add_wrap" >
                    <h4>폴더추가</h4>

                    <form id="folder_add_form" action="<?echo G5_BBS_URL?>/folder_update.php" method="post">
                      <div class="modal_sec">
                        <label >폴더이름</label>  
                      <input type="text" placeholder="추가하실 폴더의 이름을 적어 주세요." name="folder_name">
                        </div>
                        <div class="modal_sec">
                        <label >상단고정</label>  
                        <input class="circle-nicelabel" name="folder_top" data-nicelabel="{&quot;position_class&quot;: &quot;circle-checkbox&quot;}" type="checkbox" id="nicelabel" value="0">
                        <label class="circle-checkbox" for="nicelabel" style="margin-top:8px;"><div class="circle-btn"></div></label>
                        </div>

                      </form>
                        <div class="modal_footer">
                            추가 <i class="fa fa-plus"></i>
                        </div>   

                    </div>
                  </div>
                </div>
              </div>


                      <div class="chk_confirm_wrap" >
                        <?if ($gr_admin && $wr_important == 1){}else{ ?>
                        <span class="s1">사무실매물등록</span>
                        <?}?>
                        <span class="s8" data-target="#bookmark" data-toggle="modal">즐겨찾기등록하기</span>
                        <span class="s3">거래종료</span>
                        <span class="s4"><a href=" ../bbs/write.php?w=u&bo_table=<?echo $bo_table?>&board_list= <?echo $view[board_list] ?>&wr_id=<?echo $view[wr_id]?>&wr_sale_type=<?=$wr_sale_type?>" style="color:#fff;">수정</a></span>
                        <span class="s5"><a href="<?php echo $delete_href ?>"  onclick="del(this.href); return false;" style="color:#fff;">삭제</a></span>
                      </div>

                      <script src="<?php G5_PATH?>/assets/js/toastr.min.js"></script>

<script>


// 즐겨찾기 클릭시 폴더 리스트 요청ajax
$(function() { $("input[name=folder_name]").keydown(function(evt) { if (evt.keyCode == 13) return false; }); });
$(".s8").click(function(){
var folder_list = "<?=G5_BBS_URL?>/list_folder_list.php";
$.ajax({
type : "POST",
url : folder_list,
dataType : "text",
error : function() {
alert('통신실패!!');
},
success : function(data) {
$('.folder_list').html(data);
}
});
});

// 즐겨찾기 폴더추가 ajax요청
$(".modal_footer").click(function(){
  var folder_list = "<?=G5_BBS_URL?>/list_folder_list.php";
  if( $('#nicelabel').is(":checked")){
      $('#nicelabel').val("1");
    }
  var formData =$('#folder_add_form').serializeArray();
  // console.log(formData);
  $.ajax({
  url: "<?echo G5_BBS_URL?>/folder_update.php",
  type: "POST", 
  data: formData,
  dataType: 'text',
  success: function (Data, textStatus, jqXHR) {
// 폴더추가시 폴더리스트 새로고침 ajax
$.ajax({
type : "POST",
url : folder_list,
dataType : "text",
error : function() {
alert('통신실패!!');
},
success : function(data) {
$('.folder_list').html(data);
}
});
  },
  error: function (jqXHR, textStatus, errorThrown) {
  alert(errorThrown);
  }
  })
  }); 

  // 북마크 추가시 체크된 매물 리스트만 가져오기 
    var check_text = "<?=$view[wr_subject]?>";
  $(".check_list ul").append("<li id='add_list'>"+check_text+"</li>");


$(".sale_view_drop").click(function(){
  $(".sale_drop_form").slideToggle(400);
})

function number2Kor(num, type, delimChar) {
  (function() {
    var fnEach = String.prototype.each ;
    String.prototype.each = fnEach || function(callback) {
      var str = this;
      for( var i = 0 ; i < str.length ; i++) {
        callback(i, str.charAt(i));
      }
    };
  })();
  var baseNames =  ["천", "백" , "0", ""];  
  var levelNames = ["만", "억"]; 
  type = type || "HALF";
  delimChar = delimChar || " ";

  var decimal = ["", "일", "이", "삼", "사", "오", "육", "칠", "팔", "구"];

  var level = parseInt(num.length / baseNames.length);
  var start = 0;
  var end = num.length % baseNames.length; // 0, 1, 2, 3
  /* start validation */
  if ( isNaN(num) ) {
    throw "not a number form : " + num ;
  }
  if ( ! isFinite(num) ) {
    throw "not finite : " + num ;
  }
  /* end validation */

  if ( end == 0) { // in case the length of num is => 0, 4, 8, 12, ...
    end = Math.min(num.length, baseNames.length) ;
    level --;
  } else {
    for( var k = 0 ; k < baseNames.length-end; k++) {
      num = "0" + num;
    }
    end = baseNames.length;
  }

  var toKorString = "";
  var fns = {
      "LOW" : function (i, ch) {
        if ( ch !== "0"){
          unitStr += ch;
        } else if ( ch === "0" && unitStr.length > 0 ) {
          unitStr += ch;
        }
      },
      "HALF" : function(i, ch) {
        if ( ch != "0" ) {
          unitStr += ch + baseNames[i];
        }
      },
      "HIGH" : function (i, ch) {
        if ( ch != "0") {
          unitStr += decimal [ parseInt(ch)] + baseNames[i];
        }
      }
    };

  while ( start < num.length ) {
    var partial = num.substring(start, end);
    var unitStr = "";

    partial.each ( fns[type] );

    if ( unitStr.length > 0 ) {
      toKorString += unitStr + levelNames[level] + delimChar ;
    }
    level --;
    start = end;
    end += baseNames.length;
  }
  return toKorString;
}


$(".sale_price").text(number2Kor('<?=$view[wr_sale_price]?>', "LOW"))
$(".wr_silinsu").text(number2Kor('<?=$view[wr_silinsu]?>', "LOW"))


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
$(".wr_land").click(function(){
  $(".wr_sale_area").slideToggle(200);
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
$(".dddds4").click(function(){
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

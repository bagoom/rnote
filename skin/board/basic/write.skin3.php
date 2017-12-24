<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script src="<?php G5_PATH?>/assets/js/modernizr.custom.js"></script>
<script src="<?php G5_PATH?>/assets/js/jquery-labelauty.js"></script>
<link rel="stylesheet" type="text/css" href="<?php G5_PATH?>/assets/css/jquery-labelauty.css">
<?php
// if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
// add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
$board_list=3;
?>


<style>

.black-bg{
  background: #222!important;
}
.option_toggle{
  background: #000;
  color: #fff;
  text-align: center;
  padding:13px;
  margin-top: 20px;
  cursor: pointer;
}
.option_contents label{
  padding:10px;
}
input[type="submit"]{
  border: 1px solid #3b4db7;
  color: #3b4db7;
  transition: all 0.2s;
}
input[type="submit"]:hover{
  background: #3b4db7;
  color: #fff;
}
.form-group{
  border:1px solid #dbdbdb;
  background: #fff;
  padding:10px 3px;
  margin-bottom: 18px;
} 
.drop{
  margin-bottom:20px !important;
  background:#3b4db7!important;
  border:0 !important;
  color:#fff;
}
input[type="text"],input[type="number"],input[type="tel"]{

}
.filebox label { display: inline-block; padding: .5em .75em;  width: 150px;  text-align: center; color: #999; font-size: inherit; line-height: normal; vertical-align: middle; background-color: #efefef; cursor: pointer; border: 1px solid #d1d1d1; border-bottom-color: #e2e2e2; border-radius: .25em; }
.filebox input[type="file"] { /* 파일 필드 숨기기 */ position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip:rect(0,0,0,0); border: 0; }
  
</style> 


<div class="write_header">
<h2 style="font-size:37px;  width:250px; margin:0 auto; padding-bottom: 10px; " ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 매물<?if($w=='u') echo "수정"; else echo"등록";?></h2>
<p style="font-size:18px;">RNote 매물 <?if($w=='u') echo "수정"; else echo"등록";?> 페이지 입니다.</p>
 
</div>
<section id="bo_w" style="width: 1100px ;margin:0 auto; background:#fff;  border:1px solid #e1e1e1; margin-top:70px; margin-bottom:100px;">

<!-- <h2 style="text-align:center;"><span style="border-bottom:3px solid #222; padding:10px;">매물등록</span></h2> -->
    <div class="tbl_frm01 tbl_wrap">
                <div id="autosave_wrapper">
<!----------------- 탭버튼 ---------------->
                <div id="tab" class="btn-group" data-toggle="buttons" style="width:100%; margin-bottom:50px ;">
                <a href="#rent" class="btn btn-primary active rent" data-toggle="tab" style="width:50%; padding:20px; border-radius:0; margin-left:0.5px; ">
                            <input type="radio" />임대</a>
                <a href="#sale" class="btn btn-primary sale" data-toggle="tab" style="width:50%; padding:20px; border-radius:0; border-left:1px solid #eee; ">
                            <input type="radio" />매매</a>
              </div>





<!----------------- 임대 내용 ---------------->
                        <div class="tab-content">
                          <div class="tab-pane " id="rent" >
                            <!-- 게시물 작성/수정 시작 { -->
                            <form name="fwrite" id="fwrite" name="rent_write" action="<?php echo $action_url ?>" method="post" enctype="multipart/form-data" autocomplete="off" style="width:100%" data-use-autosave="true">
                            <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
                            <input type="hidden" name="w" value="<?php echo $w ?>">
                            <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                            <input type="hidden" name="wr_writer" value="<?php echo $member['mb_name'] ?>">
                            <input type="hidden" name="wr_hp" value="<?php echo $member['mb_hp'] ?>">
                            <input type="hidden" name="wr_sale_type" value="<?if($write['wr_sale_type']=='1') {echo "1";}elseif($write['wr_sale_type']=='1'){echo "2";}elseif($write['wr_sale_type']=='3'){echo "3";}else{ echo "1";}?>">
                            <input type="hidden" name="wr_type" value="rent">
                            <input type="hidden" name="board_list" value="<?php echo $board_list ?>">
                            <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
                            <input type="hidden" name="sca" value="<?php echo $sca ?>">
                            <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
                            <input type="hidden" name="stx" value="<?php echo $stx ?>">
                            <input type="hidden" name="spt" value="<?php echo $spt ?>">
                            <input type="hidden" name="sst" value="<?php echo $sst ?>">
                            <input type="hidden" name="sod" value="<?php echo $sod ?>">
                            <input type="hidden" name="page" value="<?php echo $page ?>">
                            <input type="hidden" name="wr_posx" id="wr_posx" value="<?=$write[wr_posx]?>">
                            <input type="hidden" name="wr_posy" id="wr_posy" value="<?=$write[wr_posy]?>">


                            <div class="right" style="color:#999; padding-left:5px; background:#f1f1f1;">관리번호 : <input type="text" id="wr_code" name="wr_code" placeholder="No."value="<?=$write[wr_code] ?>" readonly style="border:0; padding:5px; color:#999; width:120px; background:#f1f1f1;"/></div>

                              <div class="form-title" style="margin-top:0;">
                                위치정보
                              </div>

                              <table class="write_table">
                                <tbody>
                                  <tr>
                                    <th>매물명</th>
                                    <td><input type="text" name="wr_subject" maxlength="10" value="<?php echo $subject ?>" tabindex="1"   required autofocus/></td>
                                  </tr>
                                  <tr>
                                    <th>주소</th>
                                    <td><div class="col-xs-12" style="position: relative; padding:0;">
                                      <input id="wr_address" name="wr_address" required type="text" tabindex="2"  value="<?=$write[wr_address] ?>" date-role="none" placeholder="도로명 또는 주소를 입력하세요."style="float: left; margin-right: 6px; margin-bottom:5px;"  onkeyup="javascript:searchPosition('wr_address');" onfocus="if(this.value =='도로명 또는 주소를 입력하세요.') this.value='';" onblur="if(this.value =='') this.value='도로명 또는 주소를 입력하세요.';" value="도로명 또는 주소를 입력하세요.">

                                    <input id="house_reg_road_addr" style="border:1px solid #EEE; border-width:1px 0 0 0" name="house_reg_road_addr"  value="<?php echo $nh[nh_road_addr]?>" type="hidden" date-role="none"  >
                                    </div>
                                    <div id="searchResultBody" class="col-xs-12" onmouseover="MM_showHideLayers('searchResultBody','','show')" style="display: none;position:relative; top:0px; padding:0; background-color: #f1f1f1; ">
                                    </div>
                                  </td>
                                  </tr>
                                  <tr>
                                    <th>상권명</th>
                                    <td><input type="text" tabindex="3" name="wr_sale_area"  value="<?=$write[wr_sale_area]?>"></td>
                                  </tr>
                                  <tr>
                                    <th>추천업종</th>
                                    <td>
                                      <div class="job" id="trigger-overlay" tabindex="0" style="background:#3b4db7!important"> 추천업종
                                    </div>
                                    <ul id="wr_rec_job">
                                    </ul>
                                    <input type="hidden" id="search_box" name="wr_rec_sectors" value="<?=$write[wr_rec_sectors]?>"/>

                                    <div class="overlay overlay-hugeinc" id="overlay" style="position:relative;" >

                                <div class="check_list_wrap">
                                  <button type="button" id="" class="rec_close">창닫기</button>
                                <input  type="checkbox" name="d" value="0" data-labelauty="음식점 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="고깃집 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="횟집 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="퓨전주점 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="소주방 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="휴게음식점 "/>

                                <input  type="checkbox" name="d" value="0" data-labelauty="카페 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="테이크아웃 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="분식 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="미용 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="네일 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="뷰티 "/>

                                <input  type="checkbox" name="d" value="0" data-labelauty="판매 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="휴대폰 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="화장품 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="의류 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="잡화 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="편의점 "/>

                                <input  type="checkbox" name="d" value="0" data-labelauty="마트 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="오락스포츠 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="헬스 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="골프 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="당구장 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="노래연습장 "/>

                                <input  type="checkbox" name="d" value="0" data-labelauty="단란유흥 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="BAR "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="스포츠마사지 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="자동차 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="학원 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="병원 "/>

                                <input  type="checkbox" name="d" value="0" data-labelauty="사무실 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="다용도 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="숙박 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="고수익양도양수 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="프랜차이즈신규 "/>
                                <input  type="checkbox" name="d" value="0" data-labelauty="대형매장 "/>
                                </div>
                                <button type="button" id="overlay-close" class="overlay-close">등록하기</button>
                                		</div>

                                    <script>
                                      $(document).ready(function(){
                                        $(":checkbox").labelauty();
                                        $(":radio").labelauty();
                                        $('#tab label').remove();
                                      });

                                    </script>

                                  </td>
                                  </tr>
                                </tbody>
                              </table>

                              <div class="form-title">
                                매물정보
                              </div>
                            <table class="write_table">
                                <tbody>
                                  <tr>
                                    <th>층수</th>
                                    <td>
                                      <input type="text" name="wr_floor" value="<?=$write[wr_floor]?>" id="wr_floor"   tabindex="4" placeholder="지하층 입력시 숫자앞에 -입력" required></td>
                                    <th>평수</th>
                                    <td><input type="text" name="wr_area_p" value="<?=$write[wr_area_p]?>" id="wr_area_p"  tabindex="5"  placeholder="평" required></td>
                                  </tr>
                                  <tr>
                                    <th>보증금</th>
                                    <td><input type="text" name="wr_rent_deposit"  tabindex="6" value="<?php echo $write[wr_rent_deposit]  ?>"  id="wr_rent_deposit" placeholder="만원" required></td>
                                    <th>임대료</th>
                                    <td><input type="text" name="wr_m_rate" value="<?php echo $write[wr_m_rate] ?>" id="wr_m_rate" tabindex="7"  placeholder="만원"></td>
                                  </tr>
                                  <tr>
                                    <th>권리금</th>
                                    <td><input type="text" name="wr_premium_o" value="<?=$write[wr_premium_o] ?>" id="wr_premium_o"  tabindex="8" placeholder="만원" required></td>
                                    <th>권리금<br>절충가</th>
                                    <td><input type="text"  name="wr_premium_b" tabindex="9" value="<?php echo $write[wr_premium_b] ?>" id="wr_premium_b"  placeholder="만원"></td>
                                  </tr>
                                  <tr>
                                    <th>임차인<br>연락처</th>
                                    <td ><input type="text" name="wr_renter_contact" required tabindex="10" value="<?=$write[wr_renter_contact] ?>" id="wr_renter_contact"  placeholder="숫자만입력"></td>
                                    <th>건물주<br>연락처</th>
                                    <td ><input type="text"  name="wr_lessor_contact" tabindex="11" value="<?=$write[wr_lessor_contact] ?>" id="wr_lessor_contact"  placeholder="숫자만입력"></td>
                                  </tr>

                                </tbody>
                              </table>

                              <div class="form-title">
                                기타정보
                              </div>

                              <table class="write_table">
                                <tbody>
                                  <tr>
                                    <th>관리비</th>
                                    <td style="border-right:1px solid #ddd;"><input type="text" name="wr_mt_cost" value="<?=$write[wr_mt_cost] ?>" id="wr_mt_cost" tabindex="12" placeholder="원"></td>
                                  </tr>
                                  <tr>
                                    <th>분양평수</th>
                                    <td><input type="text"  name="wr_rent_p" tabindex="13" value="<?=$write[wr_rent_p] ?>" id="wr_rent_p" placeholder="평" onkeyup="valchange()"></td>
                                    <th>평당<br>관리비</th>
                                    <td><input type="text"  name="wr_mt_cost_p" tabindex="14" value="<?=$write[wr_mt_cost_p] ?>" id="wr_mt_cost_p"  placeholder="원" onkeyup="valchange()"></td>
                                  </tr>
                                  <tr>
                                    <th>메모</th>
                                    <td colspan="3"><textarea name="wr_memo"  id="wr_memo"  tabindex="15"  placeholder="기타 사항 메모" onKeyup="var a=100; var b=this.scrollHeight;if(b>=a)this.style.pixelHeight=b+6"rows="1" cols="130"><?=$write[wr_memo] ?></textarea></td>
                                  </tr>

                                </tbody>
                              </table>

                              <div class="form-title">
                                광고정보
                              </div>

                              <table class="write_table">
                                <tbody>
                                  <tr>
                                    <th>광고제목</th>
                                    <td><input type="text"  name="wr_adver_subject" tabindex="16" value="<?=$write[wr_adver_subject] ?>" id="wr_adver_subject" placeholder="광고시 제목"></td>
                                  </tr>
                                  <tr>
                                    <th>광고내용</th>
                                    <td><?php if($write_min || $write_max) { ?>
                                    <!-- 최소/최대 글자 수 사용 시 -->
                                    <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                                    <?php } ?>
                                    <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                                    <?php if($write_min || $write_max) { ?>
                                    <!-- 최소/최대 글자 수 사용 시 -->
                                    <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                                    <?php } ?></td>
                                  </tr>
                                  <tr>
                                    <th>사진업로드</th>
                                    <td><?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>

                                          <div class="filebox"> <label for="ex_file">업로드</label> <input type="file" id="ex_file"  name="bf_file[]"  title="파일첨부  <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능"> </div>
                                            <?php if ($is_file_content) { ?>
                                            <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" size="50">
                                            <?php } ?>
                                            <?php if($w == 'u' && $file[$i]['file']) { ?>
                                            <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                                            <?php } ?>
                                    <?php } ?></td>
                                  </tr>
                                </tbody>
                              </table>

                        <div class="modal-footer">
                          <!-- <input type="submit" value="매물등록" id="btn_submit" accesskey="s" class="btn btn-primary sg_cate_list" style="width:30%; padding:13px; text-align:center;"> -->

                          <? if($w == "u"){ ?>
                            <input type="submit" value="매물수정" id="btn_submit" accesskey="s" class="btn btn-primary" style="width:100%; padding:13px; text-align:center; margin-top:10px; margin-left:0;">
                          <?}else {?>
                          <input type="submit" value="매물등록" id="btn_submit" accesskey="s" class="btn btn-primary" style="width:100%; padding:13px; text-align:center; margin-top:10px; margin-left:0;">
                          <?}?>

                        </div>
                      </form>
                      </div>




<!----------------- 매매 내용 ---------------->
                          <div class="tab-pane" id="sale">
                            <form name="fwrite" id="fwrite2" action="<?php echo $action_url ?>"  method="post" enctype="multipart/form-data" autocomplete="off" style="width:100%">
                              <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
                              <input type="hidden" name="w" value="<?php echo $w ?>">
                              <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                              <input type="hidden" name="wr_writer" value="<?php echo $member['mb_name'] ?>">
                              <input type="hidden" name="wr_hp" value="<?php echo $member['mb_hp'] ?>">
                              <input type="hidden" name="wr_sale_type" value="2">
                              <input type="hidden" name="wr_type" value="sale">
                              <input type="hidden" name="board_list" value="<?php echo $board_list ?>">
                              <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
                              <input type="hidden" name="sca" value="<?php echo $sca ?>">
                              <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
                              <input type="hidden" name="stx" value="<?php echo $stx ?>">
                              <input type="hidden" name="spt" value="<?php echo $spt ?>">
                              <input type="hidden" name="sst" value="<?php echo $sst ?>">
                              <input type="hidden" name="sod" value="<?php echo $sod ?>">
                              <input type="hidden" name="page" value="<?php echo $page ?>">
                              <input type="hidden" name="wr_posx" id="wr_posx2" value="<?=$write[wr_posx]?>">
                              <input type="hidden" name="wr_posy" id="wr_posy2" value="<?=$write[wr_posy]?>">


                              <div class="form-title" style="margin-top:0;">
                                기본정보
                              </div>

                              <table class="write_table">
                                <tbody>
                                  <tr>
                                    <th>매물명</th>
                                    <td colspan="3" ><input type="text" name="wr_subject" maxlength="10" value="<?php echo $subject ?>" tabindex="1"   required /></td>

                                    
                                  </tr>
                                  <tr>
                                    <th>주소</th>
                                    <td colspan="3" >
                                      <input id="wr_address2" name="wr_address" type="text" tabindex="2"  value="<?=$write[wr_address] ?>" date-role="none" placeholder="도로명 또는 주소를 입력하세요."style="float: left; margin-right: 6px; margin-bottom:5px;" onkeyup="javascript:searchPosition2('wr_address2');" onfocus="if(this.value =='도로명 또는 주소를 입력하세요.') this.value='';" onblur="if(this.value =='') this.value='도로명 또는 주소를 입력하세요.';" value="도로명 또는 주소를 입력하세요.">
                                      <input id="house_reg_road_addr"  name="house_reg_road_addr"  value="<?php echo $nh[nh_road_addr]?>" type="hidden" date-role="none"  >
                                      <div id="searchResultBody2" class="col-xs-12" onmouseover="MM_showHideLayers2('searchResultBody2','','show')" style="display: none;position:relative; top:0px; padding:0; background-color: #f1f1f1; ">
                                    </td>
                                  </tr>
                                  <tr>
                                    <th >매도인연락처</th>
                                    <td colspan="3"><input type="text" name="wr_seller_contact" value="<?php echo $write[wr_seller_contact] ?>" id="wr_seller_contact" tabindex="3" placeholder="">
                                    </td>
                                  </tr>
                                </tbody>
                              </table>

                              <div class="form-title">
                                <!-- 지번 및  -->
                                면적
                              </div>
<!-- 
                              <table class="write_table">
                                <tbody class="sale_rand_wrap rand_wrap_basic" style="display:table-header-group;" >
                                  <tr>
                                    <th>지번</th>
                                    <td colspan="3">
                                      <input type="text" name="wr_address_sale99" value="<?=$write[wr_address_sale]?>" tabindex="4">
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <th>면적</th>
                                    <td><input type="text" name="wr_area_p99" id="wr_area_p2"  value="<?php echo $write[wr_area_p] ?>"    tabindex="5" placeholder="평"/></td>
                                    <th style="text-align:center;"><i class="fa fa-arrows-h" aria-hidden="true"></i></th>
                                    <td><input type="text" name="wr_area_m99" id="wr_area_m2" value="<?php echo $write[wr_area_m] ?>"   tabindex="6" placeholder="㎡"/></td>
                                  </tr>
                                </tbody>

                                <tbody class="rand_wrap " style="display:none;" id="doo">
                                  <tr>
                                    <th style="position:relative;">지번 <div class="box_del">x</div></th>
                                    <td colspan="3"><input type="text" name="wr_address_sale" id="wr_address_sale3" value=""  tabindex="999" /></td>
                                  </tr>
                                  <tr class="sale_rand">
                                    <th>면적</th>
                                    <td>
                                    <input type="text" name="wr_area_p" id="wr_area_p3"  value=""  tabindex="999" placeholder="평"/>
                                    </td>
                                    <th style="text-align:center;"><i class="fa fa-arrows-h" aria-hidden="true"></i></th>
                                    <td><input type="text" name="wr_area_m" id="wr_area_m3" value=""  tabindex="999" placeholder="㎡" /></td>
                                    
                                  </tr>
                                </tbody>

                              </table> -->

                                  <!-- 기존 지번밎면적 총면적부분 -->
                              <!-- <div style="position:relative; padding-bottom:45px;"> -->
                              <div style="position:relative; ">
                                  <!-- <table class="write_table">
                                    <tbody >
                                      <tr>
                                        <th style="background:#ddd;">총면적(평)</th>
                                        <td><input type="text"  name="wr_area_p_all" value="<?php echo $write[wr_area_p_all]  ?>" id="wr_area_p_all"  tabindex="999" placeholder="평" readonly ></td>
                                        <th style="background:#ddd;">총면적(㎡)</th>
                                        <td><input type="text"  name="wr_area_m_all" value="<?php echo $write[wr_area_m_all]  ?>" id="wr_area_m_all"  tabindex="999" placeholder="㎡" readonly></td>
                                      </tr>
                                    </tbody>
                                  </table> -->
                                  <table class="write_table">
                                    <tbody >
                                      <tr>
                                        <th >면적(평)</th>
                                        <td><input type="text"  name="wr_area_p_all" value="<?php echo $write[wr_area_p_all]  ?>" id="wr_area_p_all"  tabindex="4" placeholder="평"  ></td>
                                        <th>면적(㎡)</th>
                                        <td><input type="text"  name="wr_area_m_all" value="<?php echo $write[wr_area_m_all]  ?>" id="wr_area_m_all"  tabindex="5" placeholder="㎡" ></td>
                                      </tr>

                        <script>
                          $("#wr_area_p_all").keyup(function(){
                            $("#wr_area_m_all").val( ($(this).val() * 3.3).toFixed(2))
                          });
                          $("#wr_area_m_all").keyup(function(){
                            $("#wr_area_p_all").val( ($(this).val() / 3.3).toFixed(2))
                          });
                        </script>
                                    </tbody>
                                  </table>
                                  <!-- <div class="sale_rand_add">
                                    항목추가하기 +
                                  </div> -->
                                  </div>

                                  <div class="form-title">
                                    가격정보
                                  </div>

                                  <table class="write_table">
                                    <tbody>
                                      <tr>
                                        <th>총매도가</th>
                                        <td><input type="text" name="wr_sale_price"  tabindex="6" value="<?php echo $write[wr_sale_price]  ?>" id="wr_sale_price2"  placeholder="" ></td>
                                        <th>평당가격</th>
                                        <td ><input type="text" name="wr_p_sale_price" value="<?php echo $write[wr_p_sale_price] ?>" id="wr_p_sale_price"  tabindex="7" placeholder=""></td>
                                      </tr>
                                    </tbody>
                                  </table>


                                  <!--  접기 시작  -->
                                  <h4 style="background:#fff; padding: 20px;margin: 40px 0; border: 1px solid #bbb; cursor:pointer" class="drop_sale_btn">임대현황 / 대출관계 / 추정수익
                                  <i class="fa fa-chevron-circle-down" aria-hidden="true" style="float:right; "></i>
                                  </h4>
                                  <div class="drop_sale_form" style="display:none;"> 
                                  <div class="form-title">
                                    임대현황
                                  </div>

                                  <table class="write_table">
                                    <tbody>
                                      <tr>
                                        <th>총보증금</th>
                                        <td ><input type="text" name="wr_sale_deposit" value="<?php echo $write[wr_sale_deposit] ?>" id="wr_sale_deposit" tabindex="8" placeholder=""></td>
                                        <th>총임대료</th>
                                        <td><input type="text" name="wr_total_rfee" value="<?php echo $write[wr_total_rfee] ?>" id="wr_total_rfee2" tabindex="9" placeholder=""></td>
                                      </tr>
                                      <tr>
                                        <th>연임대수익</th>
                                        <td><input type="text" name="wr_year_rate" value="<?php echo $write[wr_year_rate] ?>" id="wr_year_rate"  tabindex="10" placeholder=""></td>
                                        <th>임대료추정<br>가치시세</th>
                                        <td ><input type="text"  name="wr_m_rate_guess" tabindex="11" value="<?=$write[wr_m_rate_guess] ?>" id="wr_m_rate_guess" readonly  placeholder="만원" ></td>
                                      </tr>
                                    </tbody>
                                  </table>

                                  <div class="form-title">
                                    대출관계
                                  </div>

                                  <table class="write_table">
                                    <tbody>
                                      <tr>
                                        <th>대출금</th>
                                        <td ><input type="text" name="wr_loan" value="<?php echo $write[wr_loan] ?>" id="wr_loan2" tabindex="12" placeholder=""></td>
                                        <th>금리</th>
                                        <td><input type="text" name="wr_int_rate" value="<?php echo $write[wr_int_rate] ?>" id="wr_int_rate2"  tabindex="13" placeholder="미입력시 기본 4%"></td>
                                      </tr>
                                      <tr>
                                        <th>월이자</th>
                                        <td ><input type="text" readonly  name="wr_mon_int" value="<?php echo $write[wr_mon_int] ?>" id="wr_mon_int"  tabindex="14" placeholder=""></td>
                                        <th>연이자</th>
                                        <td  ><input type="text"  readonly name="wr_year_int" value="<?php echo $write[wr_year_int] ?>" id="wr_year_int"  tabindex="15" placeholder=""></td>
                                      </tr>
                                    </tbody>
                                  </table>

                                  <div class="form-title">
                                    추정수익
                                  </div>

                                  <table class="write_table">
                                    <tbody>
                                      <tr>
                                        <th>연간순수익</th>
                                        <td ><input type="text" name="wr_year_income" value="<?php echo $write[wr_year_income] ?>" id="wr_year_income"  tabindex="16" readonly  placeholder=""></td>
                                        <th>월순수익</th>
                                        <td><input type="text"  name="wr_mon_income" tabindex="17" value="<?=$write[wr_mon_income] ?>" id="wr_mon_income" placeholder="만원" readonly  ></td>
                                      </tr>

                                    </tbody>
                                  </table>
                                  </div> <!-- 접기 끝 -->

                                  <div class="form-title">
                                    종합
                                  </div>

                                  <table class="write_table">
                                    <tbody>
                                      <tr>
                                        <th>실인수가</th>
                                        <td ><input type="text" name="wr_silinsu"  id="wr_silinsu" value="<?php echo $write[wr_silinsu] ?>"  tabindex="18" readonly /></td>
                                        <th>수익률</th>
                                        <td><input type="text" name="wr_profit_rate" value="<?php echo $write[wr_profit_rate] ?>" id="wr_profit_rate"  tabindex="19" placeholder="%" readonly></td>
                                      </tr>

                                    </tbody>
                                  </table>

                                  <div class="form-title">
                                    기타사항
                                  </div>

                                  <table class="write_table">
                                    <tbody>
                                      <tr>
                                        <th>지목</th>
                                        <td > <input type="text" name="wr_rand_type" value="<?php echo $write[wr_rand_type] ?>" id="wr_rand_type"  tabindex="20" placeholder=""></td>
                                        <th>지역지구</th>
                                        <td>  <input type="text" name="wr_zoning_district" value="<?php echo $write[wr_zoning_district] ?>" id="wr_zoning_district"  tabindex="21" placeholder=""></td>
                                      </tr>
                                      <tr>
                                        <th>건물층수</th>
                                        <td > <input type="text" name="wr_floor" value="<?php echo $write[wr_floor] ?>" id="wr_floor"  tabindex="22" placeholder=""></td>
                                        <th>연면적</th>
                                        <td><input type="text" name="wr_gross_area" value="<?php echo $write[wr_gross_area] ?>" id="wr_gross_area"  tabindex="23" placeholder=""></td>
                                      </tr>
                                      <tr>
                                        <th >메모</th> 
                                      <td colspan="3"><textarea name="wr_memo"  id="wr_memo"  placeholder="기타 사항 메모" onKeyup="var a=100; var b=this.scrollHeight;if(b>=a)this.style.pixelHeight=b+6"rows="1" cols="80" tabindex="24"><?=$write[wr_memo] ?></textarea></td>
                                      </tr>

                                    </tbody> 
                                  </table>

                                  <!-- 접기시작  -->
                                  <h4 style="background:#ㄹㄹㄹ; padding: 20px;margin: 40px 0; border: 1px solid #bbb; cursor:pointer" class="drop_sale_btn2">광고정보
                                  <i class="fa fa-chevron-circle-down" aria-hidden="true" style="float:right; "></i>
                                  </h4>
                                  <div class="drop_sale_form2" style="display:none;"> 
                                  <div class="form-title">
                                    광고정보
                                  </div>

                                  <table class="write_table">
                                    <tbody>
                                      <tr>
                                        <th>광고제목</th>
                                        <td><input type="text"  name="wr_adver_subject" tabindex="25" value="<?=$write[wr_adver_subject] ?>" id="wr_adver_subject" placeholder="광고시 제목"></td>
                                      </tr>
                                      <tr>
                                        <th>광고내용</th>
                                        <td><?php if($write_min || $write_max) { ?>
                                        <!-- 최소/최대 글자 수 사용 시 -->
                                        <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                                        <?php } ?>
                                        <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                                        <?php if($write_min || $write_max) { ?>
                                        <!-- 최소/최대 글자 수 사용 시 -->
                                        <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                                        <?php } ?></td>
                                      </tr>
                                      <tr>
                                        <th>사진업로드</th>
                                        <td><?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>

                                              <div class="filebox"> <label for="ex_file">업로드</label> <input type="file" id="ex_file"  name="bf_file[]"  title="파일첨부  <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능"> </div>
                                                <?php if ($is_file_content) { ?>
                                                <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" size="50">
                                                <?php } ?>
                                                <?php if($w == 'u' && $file[$i]['file']) { ?>
                                                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                                                <?php } ?>
                                        <?php } ?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  </div> <!-- 접기끝 -->




                                  <div class="modal-footer">
                                  <!-- <input type="submit" value="매물등록" id="btn_submit" accesskey="s" class="btn btn-primary sg_cate_list" style="width:30%; padding:13px; text-align:center;"> -->
        
                                  <? if($w == "u"){ ?>
                                    <input type="submit" value="매물수정" id="btn_submit" accesskey="s" class="btn btn-primary" style="width:100%; padding:13px; text-align:center; margin-top:10px; margin-left:0;">
                                  <?}else {?>
                                  <input type="submit" value="매물등록 " id="btn_submit" accesskey="s" class="btn btn-primary" style="width:100%; padding:13px; text-align:center; margin-top:10px; margin-left:0;">
                                  <?}?>
        
                                </div>
</form>
</div>
  </div>
</div>







<script src="<?php G5_PATH?>/assets/js/pc_script2.js"></script>
<script>

$(".drop_sale_btn").click(function(){
    $(this).toggleClass("drop");
    $(".drop_sale_form").slideToggle(300);
})

$(".drop_sale_btn2").click(function(){
    $(this).toggleClass("drop");
    $(".drop_sale_form2").slideToggle(300);
})

$("#fwrite2").submit(function(){
  if($("#wr_int_rate2").val() =='' || $("#wr_int_rate2").val()== '0'){
    $("#wr_int_rate2").val('4');
  }

})

console.log($("#wr_int_rate2"))
  if( "<?=$wr_sale_type?>" == "1"){
  $(".rent").addClass("active");
  $(".sale").removeClass("active");
  $("#rent").show();
  }else if("<?=$wr_sale_type?>" == "2"){
    $(".sale").addClass("active");
    $(".rent").removeClass("active");
    $("#sale").show();
  }else{
    $("#rent").addClass("active");
  $("#rent").show();
  }


$(function() { $("input:text").keydown(function(evt) { if (evt.keyCode == 13) return false; }); });

$("textarea#wr_memo").on('keydown keyup', function () {
  $(this).height(1).height( $(this).prop('scrollHeight')+8 );
});


function include(arr, obj) {
for(var i=0; i<=arr.length-1; i++) {
    if (arr[i] == obj) return true;
    }
}

var contact = '#wr_renter_contact,#wr_lessor_contact,#wr_seller_contact';
$(contact).on('blur' ,function(){
var contact_val = $(this).val();
if(contact_val.length ==11){
$(this).val($(this).val().replace(/(\d{3})\-?(\d{4})\-?(\d{4})/,'$1-$2-$3'))
}
else if(contact_val.length ==10){
$(this).val($(this).val().replace(/(\d{3})\-?(\d{3})\-?(\d{4})/,'$1-$2-$3'))
}
});

// 매물등록시 메모 br태그 입력
$("#fwrite").submit(function(){
  $('#wr_memo').val().replace(/\n/g, "<br>")
})


var b;
$( document ).ready(function() {
 var target = $(".check_list_wrap label .labelauty-checked");
 var target2 =  $(".check_list_wrap label");
var a =  "<?=$write[wr_rec_sectors]?>"
b = a.split(' ');
b.pop();
for (var i = 0; i < target.length; i++) {
  // console.log(target[i].innerHTML)
  if(include(b, target[i].innerHTML.replace(' ',''))){
// console.log(target[i])
// console.log(target2[i])
    $(target[i]).attr('aria-checked', true)
    $(target2[i]).prev().attr('checked', true ) ;
    $(target2[i]).attr('aria-checked', true ) ;
    $('#wr_rec_job').append('<li>'+ target[i].innerHTML + '</li>')
   }
}
});
// $(".job").click(function(){
// $('#overlay').css("visibility","visible","opacity","1");
// });
$(".rec_close").click(function(){
  $(".overlay-hugeinc").removeClass("open");
  // history.go(-1)
})
$("#overlay-close").click(function(){
$('#wr_rec_job li').remove();
var test = $("[aria-checked=true]").children('.labelauty-checked');
var test_html = test.html();

var list = []

for(var i = 0; i< test.length; i++){
list.push(test[i].innerHTML)
$('#wr_rec_job').append('<li>'+ list[i] + '</li>')
$("#search_box").val(test.text());
}
// history.go(-1)
});

function valchange() {
    var a = $("#wr_rent_p").val();
    var b = $("#wr_mt_cost_p").val();
    var c = $("#wr_mt_cost").val(a*b);
    return c;

};



// $("form[data-use-autosave=true] input, textarea").on("keyup",function() {
  
//   // data-use-autosave=true 로 지정된 폼 안의 input과 textarea요소에서 키보드 입력 이벤트가 발생한다면
//   var form = $(this).parents("form"); // 해당 입력폼이 포함된 폼
//   window.localStorage[form.name] = form.serializeArray(); // 폼 이름을 키값으로 폼 전체 데이터 저장 
//   });

// $(document).ready(function() {
  
//   $("form[data-use-autosave=true]").each(function() { ; // 저장기능을 사용중인 폼을 찾습니다.​
  
   
  
//   if (window.localStorage[$(this).attr("name","rent_write").name]) { // 해당 폼 이름을 가진 임시저장글이 있는지 검사
//   var ddd =   JSON.stringify(window.localStorage[$(this).attr("name","rent_write").name])
//   var data = JSON.parse(ddd); // 해당 데이터를 해석
//   console.log(name);
//   for (name in data) {
//     console.log(data)
//   $(this).find("input[name="+"wr_subject"+"], textarea[name="+name+"]").val(data[name]);
  
//   // 입력폼에 데이터를 다시 복원
  
   
  
//   }
  
//   }
  
//   })
  
//   });
      









$("#wr_premium_b").keyup(function(){

  $("#wr_code").val( generateSerial($("#wr_premium_b").val()))

})
// 코드  랜덤생성
         var option = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
         var option2 = "BCDFGHJKMPQRSTUVWZ123456789"

         function generateSerial(input){

             return stringGen(3, option) + numGen(input) +'-'+ stringGen(4, option2)

         }



         function stringGen(length, opt )
         {
             var text = "";


             var charset = opt

             for( var i=0; i <length; i++ )
                 text += charset.charAt(Math.floor(Math.random() * charset.length));

             return text;
         }

         function numGen(money){


             if (money.toString().length == 6){
                return money.toString().substring(0, 4)
             }
             if(money.toString().length == 5){
               return '0' +  money.toString().substring(0, 3)
             }
             if(money.toString().length == 4){
               return '00' +  money.toString().substring(0, 2)
             }
             if(money.toString().length == 3){
               return '000' +  money.toString().substring(0, 1)
             }

             else {
                return '0000'
             }

         }


    <?php if($write_min || $write_max) { ?>
    // 글자수 제한
    var char_min = parseInt(<?php echo $write_min; ?>); // 최소
    var char_max = parseInt(<?php echo $write_max; ?>); // 최대
    check_byte("wr_content", "char_count");

    $(function() {
        $("#wr_content").on("keyup", function() {
            check_byte("wr_content", "char_count");
        });
    });

    <?php } ?>
    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
    {
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.wr_subject.value,
                "content": f.wr_content.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });



        if (subject) {
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            f.wr_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                f.wr_content.focus();
            return false;
        }

        if (document.getElementById("char_count")) {
            if (char_min > 0 || char_max > 0) {
                var cnt = parseInt(check_byte("wr_content", "char_count"));
                if (char_min > 0 && char_min > cnt) {
                    alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                    return false;
                }
                else if (char_max > 0 && char_max < cnt) {
                    alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                    return false;
                }
            }
        }

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }

    </script>





    <script type="text/javascript">

    function MM_showHideLayers() { //v9.0

      var i,p,v,obj,args=MM_showHideLayers.arguments;

      for (i=0; i<(args.length-2); i+=3)

        with (document) if (getElementById && ((obj=getElementById(args[i]))!=null)) { v=args[i+2];

          if (obj.style) { obj=obj.style; v=(v=='show')?'block':(v=='hide')?'none':v; }

          obj.display=v; }

        }

        function MM_showHideLayers2() { //v9.0

          var i,p,v,obj,args=MM_showHideLayers2.arguments;

          for (i=0; i<(args.length-2); i+=3)

            with (document) if (getElementById && ((obj=getElementById(args[i]))!=null)) { v=args[i+2];

              if (obj.style) { obj=obj.style; v=(v=='show')?'block':(v=='hide')?'none':v; }

              obj.display=v; }

            }

    function MM_findObj(n, d) { //v4.01

      var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {

        d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}

        if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];

        for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);

          if(!x && d.getElementById) x=d.getElementById(n); return x;

      }

    /*

     * 주소 검색을 위한 function

     * */

     var addrToCoordApiAddr = "http://apis.daum.net/local/geo/addr2coord?apikey=";

     var coordToAddrApiAddr = "http://apis.daum.net/local/geo/coord2addr?apikey=";

     var addrSearchCallback = "pongSearch";
     var addrSearchCallback2 = "pongSearch2";

     var searchResultBody = "searchResultBody";
     var searchResultBody2 = "searchResultBody2";

     var searchResultHeader = "searchResultH";

     var roadViewAddrHeader = "rvAddr";

     var API_KEY = "306678a15ccad514fa75a3b1ae02b091";

     var lAPI_KEY = "306678a15ccad514fa75a3b1ae02b091";

    var marker;   //주소 선택시 생기는 마커

    var mark;   //click 시 생기는 마커

    function searchPosition(id){

      var query = $("#" + id).val();

      MM_showHideLayers('searchResultBody','','show');

      pingSearch(query);

    }
    function searchPosition2(id){

      var query = $("#" + id).val();

      MM_showHideLayers2('searchResultBody2','','show');

      pingSearch2(query);

    }
    /*

     * 주소 검색을 위한 api 요청

     * */

     function pingSearch(query){

      var oScript = document.createElement("script");

      oScript.type = "text/javascript";

      oScript.charset = "utf-8";

      oScript.src = addrToCoordApiAddr + lAPI_KEY + "&output=json&callback=" + addrSearchCallback + "&q=" + encodeURI(query);

      document.getElementsByTagName("head")[0].appendChild(oScript);

    }

    function pingSearch2(query){

     var oScript = document.createElement("script");

     oScript.type = "text/javascript";

     oScript.charset = "utf-8";

     oScript.src = addrToCoordApiAddr + lAPI_KEY + "&output=json&callback=" + addrSearchCallback2 + "&q=" + encodeURI(query);

     document.getElementsByTagName("head")[0].appendChild(oScript);

   }

    /*

     * 주소 검색 callback method

     * */

     function pongSearch(data){

      var resultForm = document.getElementById(searchResultBody);

      resultForm.innerHTML = "";

      if(!data.channel || data.channel.item.length <= 0){

        resultForm.innerHTML = "";

        return ;

      }else{

        var i;

        for (i = 0; i < data.channel.item.length; i++){

          var house_box = "housebox"+i;

          var titles = data.channel.item[i].title;

          var newtitles =data.channel.item[i].localName_1+" "+data.channel.item[i].localName_2+" "+data.channel.item[i].newAddress;

          var title_re =  titles.split("&lt;b&gt;").join("<b>");

          title_re =  title_re.split("&lt;/b&gt;").join("</b>");

          resultForm.innerHTML += "<div class='addrRbox'><div class='pcaddrResult'>"+ title_re + "<br>"+newtitles+"</div><div id='"+house_box +"' class='houseResult' ></div></div>";

          if((data.channel.item[i].mainAddress>0)&&data.channel.item[i].localName_3){

            search_is_house(i,data.channel.item[i].point_y,data.channel.item[i].point_x,titles,newtitles,data.channel.item[i].isNewAddress);

          }

        }

        // resultForm.innerHTML +="<div class='addrRbox'><div class='pcaddrResult' style='line-height:52px; '> 검색 결과가 없습니다.</div><div id='addr_find2_go' class='houseResult'style='line-height:52px;text-align:right; ' onclick='open_addrmap()' ><i class='nice01 nice-map-check size17'></i> </div></div>";

        /*document.getElementById(searchResultHeader).innerHTML = "<span class='addrResultH'>" +

        "주소검색 -" + "<span class='redNum'> " + i + "</span>건"  + "</span>";*/

      }

    }

    function pongSearch2(data){

     var resultForm = document.getElementById('searchResultBody2');

     resultForm.innerHTML = "";

     if(!data.channel || data.channel.item.length <= 0){

       resultForm.innerHTML = "";

       return ;

     }else{

       var i;

       for (i = 0; i < data.channel.item.length; i++){

         var house_box = "housebox"+i;

         var titles = data.channel.item[i].title;

         var newtitles =data.channel.item[i].localName_1+" "+data.channel.item[i].localName_2+" "+data.channel.item[i].newAddress;

         var title_re =  titles.split("&lt;b&gt;").join("<b>");

         title_re =  title_re.split("&lt;/b&gt;").join("</b>");

         resultForm.innerHTML += "<div class='addrRbox'><div class='pcaddrResult'>"+ title_re + "<br>"+newtitles+"</div><div id='"+house_box +"' class='houseResult' ></div></div>";

         if((data.channel.item[i].mainAddress>0)&&data.channel.item[i].localName_3){

           search_is_house2(i,data.channel.item[i].point_y,data.channel.item[i].point_x,titles,newtitles,data.channel.item[i].isNewAddress);

         }

       }

      //  resultForm.innerHTML +="<div class='addrRbox'><div class='pcaddrResult' style='line-height:52px; '> 검색 결과가 없습니다.</div><div id='addr_find2_go' class='houseResult'style='line-height:52px;text-align:right; ' onclick='open_addrmap()' ><i class='nice01 nice-map-check size17'></i> </div></div>";

       /*document.getElementById(searchResultHeader).innerHTML = "<span class='addrResultH'>" +

       "주소검색 -" + "<span class='redNum'> " + i + "</span>건"  + "</span>";*/

     }

   }

    function search_is_house(nums,lat,lng,addr1,addr2,isNewAddres){

      //alert(isNewAddres);

      var house_is_target = "#housebox"+nums;

      var url = '<?php echo G5_URL?>/house_reg_is_list.php';

      $.post(url,

        {   isnewaddr:isNewAddres,

          addr1:addr1,

          addr2:addr2,

          lat:lat,

          lng:lng

        },

        function(data){

          $(house_is_target).html(data);

        }, "html");

    }

    function search_is_house2(nums,lat,lng,addr1,addr2,isNewAddres){

      //alert(isNewAddres);

      var house_is_target = "#housebox"+nums;

      var url = '<?php echo G5_URL?>/house_reg_is_list2.php';

      $.post(url,

        {   isnewaddr:isNewAddres,

          addr1:addr1,

          addr2:addr2,

          lat:lat,

          lng:lng

        },

        function(data){

          $(house_is_target).html(data);

        }, "html");

    }

    /*

     * 검색된 주소 클릭시 오른쪽 맵에 마커 표시

     * */

     function house_reg_searchMark(lat,lng,jibeon,doro,on,nh_no,reg_ok){

      if(nh_no == 1){ //등록된 건물이 있을 경우

        if(reg_ok == "1"){

          var url = "<?php echo G5_URL?>/house_member_join.json.php";

          var params ={nh_no : nh_no}

          $.ajax({

            type :"POST",

            url : url,

            dataType : "json",

            data:params,

            success:function(data){

              if(data.isok == "1")

                location.href="./room_reg_form.php?nh_no=" + nh_no;

            }

          });

        }

      }else{

        $("#wr_posy").val(lat);

        $("#wr_posx").val(lng);

        if(on =="N"){

          $("#wr_address").val(jibeon);

          $("#house_reg_road_addr").val(doro);

        }else{

          $("#house_reg_jibeon_addr").val(doro);

          $("#house_reg_road_addr").val(jibeon);

        }

        MM_showHideLayers('searchResultBody','','hide');

      }
    }

    function house_reg_searchMark2(lat,lng,jibeon,doro,on,nh_no,reg_ok){

     if(nh_no == 1){ //등록된 건물이 있을 경우

       if(reg_ok == "1"){

         var url = "<?php echo G5_URL?>/house_member_join.json.php";

         var params ={nh_no : nh_no}

         $.ajax({

           type :"POST",

           url : url,

           dataType : "json",

           data:params,

           success:function(data){

             if(data.isok == "1")

               location.href="./room_reg_form.php?nh_no=" + nh_no;

           }

         });

       }

     }else{

       $("#wr_posy2").val(lat);

       $("#wr_posx2").val(lng);

       if(on =="N"){

         $("#wr_address2").val(jibeon);

         $("#house_reg_road_addr").val(doro);

       }else{

         $("#house_reg_jibeon_addr").val(doro);

         $("#house_reg_road_addr").val(jibeon);

       }

       MM_showHideLayers2('searchResultBody2','','hide');

     }
   }

    /*

     * 검색창 클릭시 style sheet class 변경

     */

     function setInputLayout(target){

      var q = document.getElementById(target);

      q.value = '';

      q.setAttribute('class','focusInput');

    }


    </script>
    <script src="<?php G5_PATH?>/assets/js/classie.js"></script>
    <script src="<?php G5_PATH?>/assets/js/demo2.js"></script>

</section>

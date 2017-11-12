<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script src="<?php G5_PATH?>/assets/js/modernizr.custom.js"></script>
<script src="<?php G5_PATH?>/assets/js/jquery-labelauty.js"></script>
<link rel="stylesheet" type="text/css" href="<?php G5_PATH?>/assets/css/jquery-labelauty.css">

<link rel="stylesheet" href="<?php G5_PATH?>/assets/css/style1.css">
</head>

<?php
// if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
// add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
$board_list=3;
?>


<style>
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
.btn-group{
  margin-bottom: 20px;
}
.filebox label { display: inline-block; padding: .5em .75em;  width: 150px;  text-align: center; color: #999; font-size: inherit; line-height: normal; vertical-align: middle; background-color: #efefef; cursor: pointer; border: 1px solid #d1d1d1; border-bottom-color: #e2e2e2; border-radius: .25em; }
.filebox input[type="file"] { /* 파일 필드 숨기기 */ position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip:rect(0,0,0,0); border: 0; }
.form-group{
  border:1px solid #dbdbdb;
  background: #fff;
  padding:3px;
  margin-bottom: 8px;
}
input[type="text"],input[type="number"],input[type="tel"]{
  border:0;
}

</style>

<section id="bo_w">


    <div class="tbl_frm01 tbl_wrap">
                <div id="autosave_wrapper">
<!----------------- 탭버튼 ---------------->
                        <div id="tab" class="btn-group" data-toggle="buttons" style="width:100%;">
                          <a href="#rent" id="rent_btn"class="btn btn-primary active" data-toggle="tab" style="width:50%; padding:10px;">
                                      <input type="radio" />임대</a>
                          <a href="#sale" id="sale_btn" class="btn btn-primary" data-toggle="tab" style="width:50%; padding:10px;">
                                      <input type="radio" />매매</a>
                        </div>



<!----------------- 임대 내용 ---------------->
                        <div class="tab-content">
                          <div class="tab-pane active" id="rent">
                            <!-- 게시물 작성/수정 시작 { -->
                            <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:100%">
                              <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
                              <input type="hidden" name="w" value="<?php echo $w ?>">
                              <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                              <input type="hidden" name="wr_writer" value="<?php echo $member['mb_name'] ?>">
                              <input type="hidden" name="wr_sale_type" value="1">
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
                            <!-- 평수m2 -->
                              <input type="hidden"  name="wr_area_m" value="<?=$write[wr_area_m] ?>" id="wr_area_m">

                            <?php
                            $option = '';
                            $option_hidden = '';
                            if ($is_notice || $is_html || $is_secret || $is_mail) {
                                $option = '';
                                if ($is_notice) {
                                    $option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
                                }

                                if ($is_html) {
                                    if ($is_dhtml_editor) {
                                        $option_hidden .= '<input type="hidden" value="html1" name="html">';
                                    } else {
                                        $option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">html</label>';
                                    }
                                }

                                if ($is_secret) {
                                    if ($is_admin || $is_secret==1) {
                                        $option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label for="secret">비밀글</label>';
                                    } else {
                                        $option_hidden .= '<input type="hidden" name="secret" value="secret">';
                                    }
                                }

                                if ($is_mail) {
                                    $option .= "\n".'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label for="mail">답변메일받기</label>';
                                }
                            }

                            echo $option_hidden;
                            ?>
                            <div class="form-group">
                                <!-- 매물명 -->
                                <label class="col-xs-2 col-sm-2 control-label2">매물명</label>
                                <div class="col-xs-10">
                                    <input type="text" name="wr_subject"  value="<?php echo $subject ?>" class="form-control"  tabindex="1" placeholder="매물명을 입력 하세요."  />
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 상권명 -->
                                <label class="col-xs-2 col-sm-2 control-label2">상권명</label>
                                <div class="col-xs-10">
                                  <input type="text" name="wr_sale_area"  value="<?php echo $write[wr_sale_area] ?>" class="form-control"  tabindex="2" placeholder="상권명을 입력 하세요." />
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 층수 -->
                                <label class="col-xs-2 col-sm-4 control-label2">층수</label>
                                <div class="col-xs-4">
                                  <input  type="checkbox" class="under_rand" name="under_rand" id="under_rand" data-labelauty="지하 ">
                                  <label class="under_rand_label" for="under_rand">지하</label>
                                </div>
                                <div class="col-xs-4">
                                    <input type="number" name="wr_floor" value="<?php echo $write[wr_floor]  ?>" id="wr_floor" class="form-control" tabindex="3"  placeholder="" >
                                </div>
                                <div class="col-xs-2 last-label">
                                    층
                                </div>


                            </div>

                            <div class="form-group">
                                <!-- 실평수 -->
                                <label class="col-xs-4 col-sm-4 control-label2">평수</label>
                                <div class="col-xs-6">
                                    <input type="number"  name="wr_area_p" value="<?php echo $write[wr_area_p]  ?>" id="wr_area_p" class="form-control" tabindex="4" placeholder="" onkeyup="document.getElementById('wr_area_m').value=this.value*3.3">
                                </div>
                                <div class="col-xs-2 last-label">
                                    평
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 보증금 -->
                                <label class="col-xs-4 col-sm-4 control-label2">보증금</label>
                                <div class="col-xs-6">
                                      <input type="number" name="wr_rent_deposit"  tabindex="5" value="<?php echo $write[wr_rent_deposit]  ?>" id="wr_rent_deposit" class="form-control"  placeholder="" >
                                </div>
                                <div class="col-xs-2 last-label">
                                    만원
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 임대료 -->
                                <label class="col-xs-4 col-sm-4 control-label2">임대료</label>
                                <div class="col-xs-6">
                                      <input type="number" name="wr_m_rate" value="<?php echo $write[wr_m_rate] ?>" id="wr_m_rate" class="form-control" tabindex="6" placeholder="">
                                </div>
                                <div class="col-xs-2 last-label">
                                    만원
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 권리금 -->
                                <label class="col-xs-4 col-sm-4 control-label2">권리금</label>
                                <div class="col-xs-6">
                                    <input type="number" name="wr_premium_o" value="<?=$write[wr_premium_o] ?>" id="wr_premium_o" class="form-control" tabindex="7" placeholder="">
                                </div>
                                <div class="col-xs-2 last-label">
                                    만원
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 권리금(절충예상가) -->
                                <label class="col-xs-5 col-sm-5 control-label2">권리금 (절충가)</label>
                                <div class="col-xs-5">
                                      <input type="number"  name="wr_premium_b" tabindex="8" value="<?php echo $write[wr_premium_b] ?>" id="wr_premium_b" class="form-control"   placeholder="" onkeyup="document.getElementById('wr_code').value=randomString()">
                                </div>
                                <div class="col-xs-2 last-label">
                                    만원
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 코드 -->
                                <label class="col-xs-4 col-sm-4 control-label2">매물관리번호</label>
                                <div class="col-xs-8" style="padding-right:0px; padding-left:0;">
                                      <input type="text" id="wr_code" name="wr_code" placeholder="No."value="<?=$write[wr_code] ?>" readonly class="form-control"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 관리비-->
                                <label class="col-xs-4 col-sm-4 control-label2">관리비</label>
                                <div class="col-xs-6">
                                      <input type="number" name="wr_mt_cost" value="<?=$write[wr_mt_cost] ?>" id="wr_mt_cost" tabindex="9" class="form-control"  placeholder="">
                                </div>
                                <div class="col-xs-2 last-label">
                                    만원
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 임대평수-->
                                <label class="col-xs-4 col-sm-4 control-label2">임대평수</label>
                                <div class="col-xs-6">
                                      <input type="number"  name="wr_rent_p" tabindex="10" value="<?=$write[wr_rent_p] ?>" id="wr_rent_p" class="form-control"   placeholder="" >
                                </div>
                                <div class="col-xs-2 last-label">
                                    평
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 평당관리비-->
                                <label class="col-xs-4 col-sm-4 control-label2">평당관리비</label>
                                <div class="col-xs-6">
                                      <input type="number"  name="wr_mt_cost_p" tabindex="11" value="<?=$write[wr_mt_cost_p] ?>" id="wr_mt_cost_p" class="form-control"   placeholder="" onkeyup="valchange()">
                                </div>
                                <div class="col-xs-2 last-label">
                                    원
                                </div>
                            </div>


                            <div class="form-group">
                                <!-- 기타지출-->
                                <label class="col-xs-4 col-sm-4 control-label2">기타지출</label>
                                <div class="col-xs-8">
                                        <input type="text"  name="wr_extra_exp" value="<?=$write[wr_extra_exp] ?>" id="wr_extra_exp" class="form-control" tabindex="12"  placeholder="기타지출">
                                </div>
                            </div>

                            <div class="form-group rent_addr" style="padding:3px 0;">
                                <label class="col-xs-4 col-sm-4 control-label2">매물위치</label>
                                <div class="col-xs-8" style="position: relative; padding-right:0; padding-left:0">
                                <input id="wr_address"class="form-control" name="wr_address" style="border:0px solid #EEE;"type="text" tabindex="13"  value="<?=$write[wr_address] ?>" date-role="none" placeholder="도로명 또는 주소를 입력하세요."style="float: left; margin-right: 6px; margin-bottom:5px;" onkeydown="javascript:if(event.keyCode == 13) wr_id_submit();" onkeyup="javascript:searchPosition('wr_address');" onfocus="if(this.value =='도로명 또는 주소를 입력하세요.') this.value='';" onblur="if(this.value =='') this.value='도로명 또는 주소를 입력하세요.';" value="도로명 또는 주소를 입력하세요.">
                                </div>
                                <div id="searchResultBody" class="col-xs-12" onmouseover="MM_showHideLayers('searchResultBody','','show')" style="display: none;position:relative; top:0px; background-color: #222; ">
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 임차인연락처-->
                                <label class="col-xs-4 col-sm-4 control-label2">임차인연락처</label>
                                <div class="col-xs-8">
                                        <input type="tel" name="wr_renter_contact" tabindex="14" value="<?=$write[wr_renter_contact] ?>" id="wr_renter_contact" class="form-control"  placeholder="숫자만입력">
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 건물주연락처-->
                                <label class="col-xs-4 col-sm-4 control-label2">건물주연락처</label>
                                <div class="col-xs-8">
                                        <input type="tel"  name="wr_lessor_contact" tabindex="15" value="<?=$write[wr_lessor_contact] ?>" id="wr_lessor_contact" class="form-control"  placeholder="숫자만입력">
                                </div>
                            </div>

                            <div class="form-group">
                              <!-- 분양팀연락처 -->
                                <div class="col-xs-12">
                                  <div class="job" id="trigger-overlay"> 추천업종
                                  </div>
                                  <ul id="wr_rec_job">
                                  </ul>
                                  <input type="hidden" id="search_box" name="wr_rec_sectors" value="<?=$write[wr_rec_sectors]?>"/>
                                </div>
                            </div>

                            <div class="overlay overlay-hugeinc">
                        			<button type="button" id="overlay-close" class="overlay-close">등록하기</button>
                        <div class="check_list_wrap">
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
                        <input  type="checkbox" name="d" value="0" data-labelauty="양도양수 "/>
                        </div>
                        		</div>

                            <script>
                              $(document).ready(function(){
                                $(":checkbox").labelauty();
                                $(":radio").labelauty();
                                $('#tab label').remove();
                              });

                            </script>


                            <div class="form-group">
                                <!-- 건물주연락처-->
                                <label class="col-xs-4 col-sm-4 control-label2">메모</label>
                                <div class="col-xs-8">
                                        <input type="text"  name="wr_memo" tabindex="16" value="<?=$write[wr_memo] ?>" id="wr_memo" class="form-control"  placeholder="기타 사항 메모">
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 건물주연락처-->
                                <label class="col-xs-3 col-sm-3 control-label2">광고제목</label>
                                <div class="col-xs-9">
                                        <input type="text"  name="wr_adver_subject" tabindex="17" value="<?=$write[wr_adver_subject] ?>" id="wr_adver_subject" class="form-control"  placeholder="광고시 제목">
                                </div>
                            </div>




                            <div class="form-group">
                              <label class="col-sm-12 col-sm-12 control-label2">광고내용</label>
                              <div class="col-sm-12">
                                    <?php if($write_min || $write_max) { ?>
                                    <!-- 최소/최대 글자 수 사용 시 -->
                                    <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                                    <?php } ?>
                                    <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                                    <?php if($write_min || $write_max) { ?>
                                    <!-- 최소/최대 글자 수 사용 시 -->
                                    <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                                    <?php } ?>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <div class="col-sm-12">
                            <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>

                                  <div class="filebox"> <label for="ex_file">업로드</label> <input type="file" id="ex_file"  name="bf_file[]"  title="파일첨부  <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능"> </div>
                                    <?php if ($is_file_content) { ?>
                                    <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" size="50">
                                    <?php } ?>
                                    <?php if($w == 'u' && $file[$i]['file']) { ?>
                                    <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                                    <?php } ?>
                            <?php } ?>
                                </div>
                              </div>
                        <div class="modal-footer">
                          <!-- <input type="submit" value="매물등록" id="btn_submit" accesskey="s" class="btn btn-primary sg_cate_list" style="width:30%; padding:13px; text-align:center;"> -->
                          <? if(!$w){ ?>
                          <input type="submit" value="등록후 목록보기" id="btn_submit" accesskey="s" class="btn btn-primary" style="width:48%; padding:13px; text-align:center; margin-top:10px; margin-right:5px; float:left">
                          <input type="submit" value="계속등록" name="write_again" id="btn_submit" accesskey="s" class="btn btn-primary" style="width:48%; padding:13px; text-align:center; margin-top:10px; margin-left:0;">
                        <? }else if ($w="u") { ?>
                          <input type="submit" value="수정하기" id="btn_submit" accesskey="s" class="btn btn-primary" style="width:100%; padding:13px; text-align:center; margin-top:10px; margin-right:5px; float:left">
                          <?} ?>
                        </div>
                      </form>
                      </div>




<!----------------- 매매 내용 ---------------->
                          <div class="tab-pane" id="sale">
                            <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:100%">
                              <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
                              <input type="hidden" name="w" value="<?php echo $w ?>">
                              <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                              <input type="hidden" name="wr_writer" value="<?php echo $member['mb_name'] ?>">
                              <input type="hidden" name="wr_sale_type" value="2">
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
                            <div class="form-group">
                                <!-- 매물명 -->
                                <label class="col-xs-2 col-sm-2 control-label2">매물명</label>
                                <div class="col-xs-10">
                                    <input type="text" name="wr_subject"  value="<?php echo $subject ?>" class="form-control"  tabindex="19" placeholder="매물명을 입력 하세요."  />
                                </div>
                            </div>

                            <div class="form-group sale_rand_wrap" style="position:relative; padding-bottom:45px;">

                                <div class="col-xs-12 rand_wrap_basic " style="overflow:hidden;">

                                  <div class="sale_addr" style="padding:3px 0; border:none; overflow:hidden;">
                                      <!-- 매물위치-->
                                      <label class="col-xs-4 col-sm-4 control-label2">지번</label>
                                      <div class="col-xs-8" style="position: relative; padding-right:0; padding-left:0">
                                      <input id="wr_address2"class="form-control" name="wr_address" style="border:0px solid #EEE;"type="text" tabindex="13"  value="<?=$write[wr_address] ?>" date-role="none" placeholder="도로명 또는 주소를 입력하세요."style="float: left; margin-right: 6px; margin-bottom:5px;" onkeyup="javascript:searchPosition2('wr_address2');" onfocus="if(this.value =='도로명 또는 주소를 입력하세요.') this.value='';" onblur="if(this.value =='') this.value='도로명 또는 주소를 입력하세요.';" value="도로명 또는 주소를 입력하세요.">
                                      </div>
                                      <div id="searchResultBody2" class="col-xs-12" onmouseover="MM_showHideLayers2('searchResultBody2','','show')" style="display: none;position:relative; top:0px; background-color: #222; ">
                                      </div>
                                  </div>

                                <div class="sale_rand" style="padding:0;">
                                    <label class="col-xs-2 col-sm-2 control-label2">면적</label>
                                    <div class="col-xs-3" >
                                      <input type="number" name="wr_area_p" id="wr_area_p2"  value="<?php echo $write[wr_area_p] ?>" class="form-control"   tabindex="21" placeholder=""
                                      onkeyup="document.getElementById('wr_area_m2').value=parseInt(this.value*3.3)"/>
                                    </div>
                                    <div class="col-xs-2 last-label" style="border-right:1px solid #dbdbdb;">
                                        평
                                    </div>
                                    <div class="col-xs-3">
                                      <input type="number" name="wr_area_m" id="wr_area_m2" value="<?php echo $write[wr_area_m] ?>" class="form-control"  tabindex="22" placeholder="" />
                                    </div>
                                    <div class="col-xs-2 last-label">
                                        m2
                                    </div>
                                </div>
                                </div>


                                <div class="col-xs-12 rand_wrap" style="overflow:hidden; display:none;;">

                                  <div class="form-group sale_addr" style="padding:3px 0; border:none;">
                                      <!-- 매물위치-->
                                      <label class="col-xs-4 col-sm-4 control-label2">지번</label>
                                      <div class="col-xs-8" style="position: relative; padding-right:0; padding-left:0">
                                      <input id="wr_address3"class="form-control" name="wr_address" style="border:0px solid #EEE;"type="text" tabindex="13"  value="<?=$write[wr_address] ?>" date-role="none" placeholder="도로명 또는 주소를 입력하세요."style="float: left; margin-right: 6px; margin-bottom:5px;">
                                      </div>
                                  </div>

                                <div class="sale_rand" style="padding:0;">
                                    <label class="col-xs-2 col-sm-2 control-label2">면적</label>
                                    <div class="col-xs-3">
                                      <input type="number" name="wr_area_p" id="wr_area_p3"  value="<?php echo $write[wr_area_p] ?>" class="form-control ddo" tabindex="21" placeholder=""/>
                                    </div>
                                    <div class="col-xs-2 last-label" style="border-right:1px solid #dbdbdb;">
                                        평
                                    </div>
                                    <div class="col-xs-3">
                                      <input type="number" name="wr_area_m" id="wr_area_m3" value="<?php echo $write[wr_area_m] ?>" class="form-control"  tabindex="22" placeholder="" />
                                    </div>
                                    <div class="col-xs-2 last-label" >
                                        m2
                                    </div>
                                </div>
                                </div>

                                <div class="sale_rand_add">
                                  항목추가하기 +
                                </div>
                                </div>


                            <div class="form-group">
                                <!-- 실평수 -->
                                <label class="col-xs-4 col-sm-4 control-label2">총면적</label>
                                <div class="col-xs-6">
                                    <input type="number"  name="wr_area_p_all" value="<?php echo $write[wr_area_p_all]  ?>" id="wr_area_p_all" class="form-control" tabindex="23" placeholder="" >
                                </div>
                                <div class="col-xs-2 last-label">
                                    평
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 보증금 -->
                                <label class="col-xs-4 col-sm-4 control-label2">총매도가</label>
                                <div class="col-xs-6">
                                      <input type="number" name="wr_sale_price"  tabindex="24" value="<?php echo $write[wr_sale_price]  ?>" id="wr_sale_price2" class="form-control"  placeholder="" >
                                </div>
                                <div class="col-xs-2 last-label">
                                    만원
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 임대료 -->
                                <label class="col-xs-4 col-sm-4 control-label2">평당가격</label>
                                <div class="col-xs-6">
                                      <input type="number" name="wr_p_sale_price" value="<?php echo $write[wr_m_rate] ?>" id="wr_p_sale_price" class="form-control" tabindex="25" placeholder="">
                                </div>
                                <div class="col-xs-2 last-label">
                                    만원
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 임대료 -->
                                <label class="col-xs-4 col-sm-4 control-label2">총보증금</label>
                                <div class="col-xs-6">
                                      <input type="number" name="wr_sale_deposit" value="<?php echo $write[wr_sale_deposit] ?>" id="wr_sale_deposit" class="form-control" tabindex="26" placeholder="">
                                </div>
                                <div class="col-xs-2 last-label">
                                    만원
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 임대료 -->
                                <label class="col-xs-4 col-sm-4 control-label2">총임대료</label>
                                <div class="col-xs-6">
                                      <input type="number" name="wr_total_rfee" value="<?php echo $write[wr_total_rfee] ?>" id="wr_total_rfee2" class="form-control" tabindex="26" placeholder="" onkeyup="document.getElementById('wr_year_rate').value=this.value*12">
                                </div>
                                <div class="col-xs-2 last-label">
                                    만원
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 임대료 -->
                                <label class="col-xs-4 col-sm-4 control-label2">연수익</label>
                                <div class="col-xs-6">
                                      <input type="number" name="wr_year_rate" value="<?php echo $write[wr_year_rate] ?>" id="wr_year_rate" class="form-control" tabindex="27" placeholder="">
                                </div>
                                <div class="col-xs-2 last-label">
                                    만원
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 임대료 -->
                                <label class="col-xs-4 col-sm-4 control-label2">융자금액</label>
                                <div class="col-xs-6">
                                      <input type="number" name="wr_loan" value="<?php echo $write[wr_loan] ?>" id="wr_loan2" class="form-control" tabindex="28" placeholder="">
                                </div>
                                <div class="col-xs-2 last-label">
                                    만원
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 임대료 -->
                                <label class="col-xs-4 col-sm-4 control-label2">금리</label>
                                <div class="col-xs-6">
                                      <input type="number" name="wr_int_rate" value="<?php echo $write[wr_int_rate] ?>" id="wr_int_rate2" class="form-control" tabindex="29" placeholder="미입력시 기본 4%">
                                </div>
                                <div class="col-xs-2 last-label">
                                    %
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 임대료 -->
                                <label class="col-xs-4 col-sm-4 control-label2">연이자</label>
                                <div class="col-xs-6">
                                      <input type="number" name="wr_year_int" value="<?php echo $write[wr_year_int] ?>" id="wr_year_int" class="form-control" tabindex="30" placeholder="">
                                </div>
                                <div class="col-xs-2 last-label">
                                    만원
                                </div>
                            </div>


                            <div class="form-group">
                                <!-- 임대료 -->
                                <label class="col-xs-4 col-sm-4 control-label2">월이자</label>
                                <div class="col-xs-6">
                                      <input type="number" name="wr_mon_int" value="<?php echo $write[wr_mon_int] ?>" id="wr_mon_int" class="form-control" step="0.1"tabindex="31" placeholder="">
                                </div>
                                <div class="col-xs-2 last-label">
                                    만원
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 임대료 -->
                                <label class="col-xs-4 col-sm-4 control-label2">수익률</label>
                                <div class="col-xs-6">
                                      <input type="number" name="wr_profit_rate" value="<?php echo $write[wr_profit_rate] ?>" id="wr_profit_rate" class="form-control" tabindex="32" placeholder="">
                                </div>
                                <div class="col-xs-2 last-label">
                                    %
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 임대료 -->
                                <label class="col-xs-4 col-sm-4 control-label2">연면적</label>
                                <div class="col-xs-6">
                                      <input type="number" name="wr_floor" value="<?php echo $write[wr_floor] ?>" id="wr_floor" class="form-control" tabindex="34" placeholder="">
                                </div>
                                <div class="col-xs-2 last-label">
                                    평
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 임대료 -->
                                <label class="col-xs-4 col-sm-4 control-label2">건물층수</label>
                                <div class="col-xs-8">
                                      <input type="text" name="wr_floor" value="<?php echo $write[wr_floor] ?>" id="wr_floor" class="form-control" tabindex="33" placeholder="">
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 건물주연락처-->
                                <label class="col-xs-4 col-sm-4 control-label2">지목</label>
                                <div class="col-xs-8">
                                        <input type="text"  name="wr_memo" tabindex="35" value="<?=$write[wr_memo] ?>" id="wr_memo" class="form-control"  placeholder="">
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 건물주연락처-->
                                <label class="col-xs-4 col-sm-4 control-label2">지역지구</label>
                                <div class="col-xs-8">
                                        <input type="text"  name="wr_memo" tabindex="35" value="<?=$write[wr_memo] ?>" id="wr_memo" class="form-control"  placeholder="">
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 건물주연락처-->
                                <label class="col-xs-4 col-sm-4 control-label2">메모</label>
                                <div class="col-xs-8">
                                        <input type="text"  name="wr_memo" tabindex="35" value="<?=$write[wr_memo] ?>" id="wr_memo" class="form-control"  placeholder="기타 사항 메모">
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- 건물주연락처-->
                                <label class="col-xs-3 col-sm-3 control-label2">광고제목</label>
                                <div class="col-xs-9">
                                        <input type="text"  name="wr_adver_subject" tabindex="36" value="<?=$write[wr_adver_subject] ?>" id="wr_adver_subject" class="form-control"  placeholder="광고시 제목">
                                </div>
                            </div>




                            <div class="form-group">
                              <label class="col-sm-12 col-sm-12 control-label2">광고내용</label>
                              <div class="col-sm-12">
                                    <?php if($write_min || $write_max) { ?>
                                    <!-- 최소/최대 글자 수 사용 시 -->
                                    <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                                    <?php } ?>
                                    <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                                    <?php if($write_min || $write_max) { ?>
                                    <!-- 최소/최대 글자 수 사용 시 -->
                                    <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                                    <?php } ?>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <div class="col-sm-12">
                            <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>

                                  <div class="filebox"> <label for="ex_file">업로드</label> <input type="file" id="ex_file"  name="bf_file[]"  title="파일첨부  <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능"> </div>
                                    <?php if ($is_file_content) { ?>
                                    <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" size="50">
                                    <?php } ?>
                                    <?php if($w == 'u' && $file[$i]['file']) { ?>
                                    <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                                    <?php } ?>
                            <?php } ?>
                                </div>
                              </div>
                        <div class="modal-footer">
                          <!-- <input type="submit" value="매물등록" id="btn_submit" accesskey="s" class="btn btn-primary sg_cate_list" style="width:30%; padding:13px; text-align:center;"> -->
                          <? if(!$w){ ?>
                          <input type="submit" value="등록후 목록보기" id="btn_submit" accesskey="s" class="btn btn-primary" style="width:48%; padding:13px; text-align:center; margin-top:10px; margin-right:5px; float:left">
                          <input type="submit" value="계속등록" name="write_again" id="btn_submit" accesskey="s" class="btn btn-primary" style="width:48%; padding:13px; text-align:center; margin-top:10px; margin-left:0;">
                        <? }else if ($w="u") { ?>
                          <input type="submit" value="수정하기" id="btn_submit" accesskey="s" class="btn btn-primary" style="width:100%; padding:13px; text-align:center; margin-top:10px; margin-right:5px; float:left">
                          <?} ?>
                        </div>
                      </form>
                      </div>







<script src="<?php G5_PATH?>/assets/js/mobile_script.js"></script>

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

        resultForm.innerHTML +="<div class='addrRbox'><div class='pcaddrResult' style='line-height:52px; '> 검색 결과가 없습니다.</div><div id='addr_find2_go' class='houseResult'style='line-height:52px;text-align:right; ' onclick='open_addrmap()' ><i class='nice01 nice-map-check size17'></i> </div></div>";

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

       resultForm.innerHTML +="<div class='addrRbox'><div class='pcaddrResult' style='line-height:52px; '> 검색 결과가 없습니다.</div><div id='addr_find2_go' class='houseResult'style='line-height:52px;text-align:right; ' onclick='open_addrmap()' ><i class='nice01 nice-map-check size17'></i> </div></div>";

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
    <script src="<?php G5_PATH?>/assets/js/demo1.js"></script>



</section>
<!-- } 게시물 작성/수정 끝 -->

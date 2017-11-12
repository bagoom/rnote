<?php
// if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
// add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
$board_list=4;
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

</style>

<section id="bo_w">


    <div class="tbl_frm01 tbl_wrap">
                <div id="autosave_wrapper">
<!----------------- 탭버튼 ---------------->
                        <div id="tab" class="btn-group" data-toggle="buttons" style="width:100%;">
                          <a href="#rent" class="btn btn-primary active" data-toggle="tab" style="width:50%; padding:10px;">
                                      <input type="radio" />임대</a>
                          <a href="#sale" class="btn btn-primary" data-toggle="tab" style="width:50%; padding:10px;">
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
                            <input type="hidden" name="wr_writer" value="<?php echo $member['mb_id'] ?>">
                            <input type="hidden" name="board_list" value="<?php echo $board_list ?>">
                            <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
                            <input type="hidden" name="sca" value="<?php echo $sca ?>">
                            <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
                            <input type="hidden" name="stx" value="<?php echo $stx ?>">
                            <input type="hidden" name="spt" value="<?php echo $spt ?>">
                            <input type="hidden" name="sst" value="<?php echo $sst ?>">
                            <input type="hidden" name="sod" value="<?php echo $sod ?>">
                            <input type="hidden" name="page" value="<?php echo $page ?>">
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
                                <label class="col-sm-2 col-sm-2 control-label1 continue">매물명</label>
                                <!-- 매물명 -->
                                <div class="col-sm-10">
                                    <input type="text" name="wr_subject"  value="<?php echo $subject ?>" class="form-control"  tabindex="0"  autofocus/>
                                    <span class="help-block">매물명을 입력 해 주세요.</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label1">매물위치</label>
                                <!-- 매물위치 -->
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="wr_address"<?php echo $wr_address?> >
                                    <span class="help-block">매물위치를 입력 해 주세요.</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label1">지역지구</label>
                                <!-- 지역지구 -->
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="wr_district"<?php echo $wr_district?> >
                                </div>
                            </div>

                            <div class="form-group">
                              <label class="col-xs-6 col-sm-6 control-label2">평수(P)</label>
                              <label class="col-xs-6 col-sm-6 control-label2">평수(m2)</label>
                                <!-- 평수p -->
                                <div class="col-xs-6">
                                    <input type="text"  name="wr_area_p" value="<?php echo $wr_area_p ?>" id="wr_area_p" class="form-control"  placeholder="p" onkeyup="document.getElementById('wr_area_m').value=this.value*3.3">
                                </div>
                                <div class="col-xs-6">
                                  <!-- 평수m2 -->
                                    <input type="text"  name="wr_area_m" value="<?php echo $wr_area_m ?>" id="wr_area_m" class="form-control" readonly placeholder="m2">
                                </div>
                            </div>

                            <div class="form-group">
                              <label class="col-xs-6 col-sm-6 control-label2">매매가</label>
                              <label class="col-xs-6 col-sm-6 control-label2">평당매매가</label>
                                <!-- 매매가 -->
                                <div class="col-xs-6">
                                    <input type="text"  name="wr_sale_price" value="<?php echo $wr_sale_price ?>" id="wr_sale_price" class="form-control"  placeholder="만원">
                                </div>
                                <div class="col-xs-6">
                                  <!-- 평당매매가-->
                                    <input type="text"  name="wr_p_sale_price" value="<?php echo $wr_p_sale_price ?>" id="wr_p_sale_price" class="form-control"  placeholder="만원">
                                </div>
                            </div>

                            <div class="form-group">
                              <label class="col-xs-6 col-sm-6 control-label2">융자금액</label>
                              <label class="col-xs-6 col-sm-6 control-label2">&nbsp</label>
                              <!-- 층수 -->
                              <div class="col-xs-6">
                                  <input type="text"  name="wr_loan" value="<?php echo $wr_loan ?>" id="wr_loan" class="form-control"  placeholder="만원">
                              </div>
                            </div>


                            <div class="form-group">
                              <label class="col-sm-12 col-sm-12 control-label2" style="padding-top:0;">메모</label>
                              <!-- 메모 -->
                                <div class="col-sm-12">
                                    <input type="text"  name="wr_memo" value="<?php echo $wr_memo ?>" id="wr_memo" class="form-control"  placeholder="관리자메모">
                                </div>
                            </div>


                            <div class="form-group">
                              <label class="col-sm-12 col-sm-12 control-label2">내용</label>
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
                          <input type="submit" value="매물등록" id="btn_submit" accesskey="s" class="btn btn-primary" style="width:100%; padding:13px; text-align:center; margin-top:10px; margin-left:0;">
                        </div>
                      </form>
                      </div>




<!----------------- 매매 내용 ---------------->
                          <div class="tab-pane" id="sale">
                            <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:100%">
                            <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
                            <input type="hidden" name="w" value="<?php echo $w ?>">
                            <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                            <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
                            <input type="hidden" name="sca" value="<?php echo $sca ?>">
                            <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
                            <input type="hidden" name="stx" value="<?php echo $stx ?>">
                            <input type="hidden" name="spt" value="<?php echo $spt ?>">
                            <input type="hidden" name="sst" value="<?php echo $sst ?>">
                            <input type="hidden" name="sod" value="<?php echo $sod ?>">
                            <input type="hidden" name="page" value="<?php echo $page ?>">
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label1 continue">매물명</label>
                                <!-- 매물명 -->
                                <div class="col-sm-10">
                                    <input type="text" name="wr_subject"  value="<?php echo $wr_subject ?>" class="form-control" tabindex="0"  autofocus/>
                                    <span class="help-block">매물명을 입력 해 주세요.</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label1">매물위치</label>
                                <!-- 매물위치 -->
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="wr_address"<?php echo $wr_address?> >
                                    <span class="help-block">매물위치를 입력 해 주세요.</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-xs-6 col-sm-6 control-label2">매매가</label>
                                <label class="col-xs-6 col-sm-6 control-label2">평당매매가</label>
                                <!-- 매매가 -->
                                <div class="col-xs-6">
                                    <input type="text" name="wr_sale_price" value="<?php echo $wr_sale_price?>" id="wr_sale_price" class="form-control"  placeholder="만원" >
                                </div>
                                <!-- 평당매매가 -->
                                <div class="col-xs-6">
                                    <input type="text" name="wr_p_sale_price" value="<?php echo $wr_p_sale_price?>" id="wr_p_sale_price" class="form-control"  placeholder="만원">
                                </div>
                            </div>

                            <div class="form-group">
                              <label class="col-xs-6 col-sm-6 control-label2">평수(P)</label>
                              <label class="col-xs-6 col-sm-6 control-label2">평수(m2)</label>
                                <!-- 평수p -->
                                <div class="col-xs-6">
                                    <input type="text"  name="wr_area_p" value="<?php echo $wr_area_p ?>" id="wr_area_p" class="form-control"  placeholder="p">
                                </div>
                                <div class="col-xs-6">
                                  <!-- 평수m2 -->
                                    <input type="text"  name="wr_area_m" value="<?php echo $wr_area_m ?>" id="wr_area_m" class="form-control"  placeholder="m2">
                                </div>
                            </div>

                            <div class="form-group">
                              <label class="col-xs-6 col-sm-6 control-label2">연면적(P)</label>
                              <label class="col-xs-6 col-sm-6 control-label2">연면적(m2)</label>
                                <!-- 연면적p -->
                                <div class="col-xs-6">
                                    <input type="text"  name="wr_area_p_all" value="<?php echo $wr_area_p_all ?>" id="wr_area_p_all" class="form-control"  placeholder="p">
                                </div>
                                <div class="col-xs-6">
                                  <!-- 연면적m2 -->
                                    <input type="text"  name="wr_area_m_all" value="<?php echo $wr_area_m_all ?>" id="wr_area_m_all" readonly class="form-control"  placeholder="m2">
                                </div>
                            </div>

                            <div class="form-group">
                              <label class="col-xs-6 col-sm-6 control-label2">총보증금</label>
                              <label class="col-xs-6 col-sm-6 control-label2">총임대료</label>
                              <!-- 총보증금 -->
                              <div class="col-xs-6">
                                  <input type="text"  name="wr_sale_deposit" value="<?php echo $wr_sale_deposit ?>" id="wr_sale_deposit" class="form-control"  placeholder="만원">
                              </div>
                              <div class="col-xs-6">
                                <!-- 총임대료 -->
                                  <input type="text"  name="wr_total_rfee" value="<?php echo $wr_total_rfee ?>" id="wr_total_rfee" class="form-control"  placeholder="만원">
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-xs-6 col-sm-6 control-label2">수익률</label>
                              <label class="col-xs-6 col-sm-6 control-label2">융자금액</label>
                              <!-- 수익률 -->
                              <div class="col-xs-6">
                                  <input type="text"  name="wr_profit_rate" value="<?php echo $wr_profit_rate ?>" id="wr_profit_rate" class="form-control"  placeholder="%">
                              </div>
                              <div class="col-xs-6">
                                <!-- 융자금액 -->
                                  <input type="text"  name="wr_loan" value="<?php echo $wr_loan ?>" id="wr_loan" class="form-control"  placeholder="만원">
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-xs-6 col-sm-6 control-label2">층수</label>
                              <label class="col-xs-6 col-sm-6 control-label2">&nbsp</label>
                              <!-- 층수 -->
                              <div class="col-xs-6">
                                  <input type="text"  name="wr_floor" value="<?php echo $wr_floor ?>" id="wr_floor" class="form-control"  placeholder="층">
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-12 col-sm-12 control-label2">메모</label>
                              <!-- 메모 -->
                                <div class="col-sm-12">
                                    <input type="text"  name="wr_memo" value="<?php echo $wr_memo ?>" id="wr_memo" class="form-control"  placeholder="관리자메모">
                                </div>
                            </div>



        <div class="form-group">
          <label class="col-sm-12 col-sm-12 control-label2">내용</label>
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
                <tr>
                    <th scope="row">파일 #<?php echo $i+1 ?></th>
                    <td>
                        <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
                        <?php if ($is_file_content) { ?>
                        <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" size="50">
                        <?php } ?>
                        <?php if($w == 'u' && $file[$i]['file']) { ?>
                        <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
          </div>
          </div>
    <div class="modal-footer">

      <!-- <input type="submit" value="매물등록" id="btn_submit" accesskey="s" class="btn btn-primary sg_cate_list" style="width:30%; padding:13px; text-align:center;"> -->
      <input type="submit" value="매물등록" id="btn_submit" accesskey="s" class="btn btn-primary" style="width:100%; padding:13px; text-align:center; margin-top:10px; margin-left:0;">
    </div>
    <!-- <div class="btn_confirm">
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit">
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">취소</a>
    </div> -->
</form>
</div>
  </div>
</div>







    <script>

    $(".option_toggle").click(function(){
    $(".option_contents").toggle();
        });

        $(".sg_cate_list").click(function(){

          $.ajax({
          type : "POST",
          url : "../skin/board/basic/modal/sg_cate_list.html",
          dataType : "text",
          error : function() {
              alert('통신실패!!');
          },
          success : function(data) {
              $('#Context').html(data);
          }
        });
         })


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
</section>
<!-- } 게시물 작성/수정 끝 -->

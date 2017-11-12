<?php

// if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// add_stylesheet('<link rel="stylesheet" href="style.css" />', 0); 숫자가 작을 수록 먼저 출력됨
include_once("$board_skin_path/lib/skin.lib.php");
?>
      <!-- Modal -->
                  <h4 class="m_table_header np nm">
                      <button class="search_button">매물검색</button>
                      <div class="search_wrap" style="display:none;">
                       <!-- 검색 -->
                        <div class="board_search">
                            <form name="fsearch" method="get">
                            <input type="hidden" name="bo_table" value="<?=$bo_table?>">
                            <input type="hidden" name="sca" value="<?=$sca?>">
                            <input type="hidden" name="sfl" value="wr_subject||wr_content||wr_rent_deposit||board_list">
                            <input type="hidden" name="board_list" value="<?=$board_list?>">
                            <input type="text" name="wr_premium_o" value="<?=$wr_premium_o?>">
<!--
                            <select name="sfl">
                                <option value="wr_subject">제목</option>
                                <option value="wr_content">내용</option>
                                <option value="wr_subject||wr_content">제목+내용</option>
                                <option value="mb_id,1">회원아이디</option>
                                <option value="wr_name,1">글쓴이</option>
                            </select>
-->
                            <input name="stx" class="stx" maxlength="15" itemname="검색어" value='<?=stripslashes($stx)?>'>
                            <input type="image" src="<?=$board_skin_path?>/img/btn_search.gif" border='0' align="absmiddle">
                            </form>
                        </div>
                      </div>
                  </h4>

                  <div class="col-lg-12 m_main-list">
                        <section id="unseen">
                          <form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="house_del_modal(wr_id)" method="post">
                          <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                          <input type="hidden" name="board_list" value="<?php echo $board_list ?>">
                          <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
                          <input type="hidden" name="stx" value="<?php echo $stx ?>">
                          <input type="hidden" name="spt" value="<?php echo $spt ?>">
                          <input type="hidden" name="sca" value="<?php echo $sca ?>">
                          <input type="hidden" name="sst" value="<?php echo $sst ?>">
                          <input type="hidden" name="sod" value="<?php echo $sod ?>">
                          <input type="hidden" name="page" value="<?php echo $page ?>">
                          <input type="hidden" name="sw" value="">
                          <ul class="mobile_list_item_box">
                              <?php
                              for ($i=0; $i<count($list); $i++) {
                               ?>
                               <a href="<?php echo $list[$i]['href'] ?>" style="display:block; width:100%; height:100%;">
                               <li class="mobile_list_item">


                                  <div class="list_sub_info">
                                 <h4 style="font-size:16.5px; margin:0"> <? echo $list[$i]['subject'];?></h4>

                                 <!-- <div class="list_cate_icon">
                                   <? if ($list[$i]['board_list']==1) echo '원룸';
                                   elseif ($list[$i]['board_list']==2) echo '아파트';
                                   elseif ($list[$i]['board_list']==3) echo '상가';
                                   elseif ($list[$i]['board_list']==4) echo '토지';
                                   ?>
                                 </div> -->

                                  <div class="row"></div>
                                  <h5 style="margin-top:5px; font-size:13px;  margin-bottom:0;"> <? echo $list[$i]['wr_sale_area'];?></h5>
                                  <h5 style="font-size:13px; font-weight:bold; margin-top:5px;"><?  if ($list[$i]['wr_floor'] < 0) {
                                      $under_floor = str_replace('-', "", $list[$i]['wr_floor']);
                                    echo "지하".$under_floor;
                                  }else echo $list[$i]['wr_floor']?>층·<?php echo $list[$i]['wr_area_p'] ?>평</h5>
                                </div>



                                  <div class="list_sale_info">

                                 <p style="color:#3b4db7; font-weight:bold; margin:0; font-size:19px;"> <?php echo $list[$i]['wr_rent_deposit'] ?>/<?php echo $list[$i]['wr_m_rate'] ?>만 </p>

                                 <!-- <span class="b" style="font-size:14px;">매물번호:<? echo $list[$i]['num'];?></span> -->

                                 <p style="color:#2e46cf; margin:0; padding:0;font-size:13px;">권:<?php echo  $list[$i]['wr_premium_o'] ?> <sapn style="color:#666; font-weight:bold; ">합:<?php echo   $list[$i]['wr_rent_deposit']+$list[$i]['wr_premium_o'] ?>만</span> </p>
                                  </div>


                                  <? if($list[$i]['wr_renter_contact']) { ?>
                                    <!-- 임차인만있을경우 -->

                                  <a href="tel:<?php echo $list[$i]['wr_renter_contact']?>"><div class="tel_icon"><i class="fa fa-phone"></i> 임차인</div></a>
                                <? }elseif ($list[$i]['wr_renter_contact']&&$list[$i]['wr_lessor_contact']) {?>
                                    <!-- 임차인, 건물주 둘다 있을경우 -->
                                  <a href="tel:<?php echo $list[$i]['wr_renter_contact']?>"><div class="tel_icon"><i class="fa fa-phone"></i> 임차인</div></a>
                                  <?}elseif ($list[$i]['wr_lessor_contact']){?>
                                    <!-- 건물주만있을경우 -->
                                  <a href="tel:<?php echo $list[$i]['wr_lessor_contact']?>"><div class="tel_icon"><i class="fa fa-phone"></i> 건물주</div></a>
                                  <?} ?>

<!--                                 <span style="font-size:15px; position:absolute; bottom:15px;"> <?php echo $list[$i]['datetime2'] ?> </span>-->

                               </li>
                               </a>

                              <?php } ?>
                              <?php if (count($list) == 0) { echo '<tr><td colspan="10" class="empty_table">등록된 매물이 없습니다.</td></tr>'; } ?>



                      </ul>
                      </form>
  <!--페이징 -->
  <?echo $write_pages ?>
  <input type="hidden" id="bo_table" value="<?php echo $bo_table?>" ?>

<!-- } 게시판 목록 끝 -->


<!-- js placed at the end of the document so the pages load faster -->
<script src="../assets/js/jquery.js"></script>
<!-- <script src="../assets/js/jquery-1.8.3.min.js"></script> -->
<script src="../assets/js/bootstrap.min.js"></script>
<!-- <script class="include" type="text/javascript" src="../assets/js/jquery.dcjqaccordion.2.7.js"></script> -->
<script src="../assets/js/jquery.scrollTo.min.js"></script>
<script src="../assets/js/jquery.nicescroll.js" type="text/javascript"></script>

<script type="application/javascript">



    function myNavFunction(id) {
        $("#date-popover").hide();
        var nav = $("#" + id).data("navigation");
        var to = $("#" + id).data("to");
        console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }

    var bourl = "write.php?bo_table="+$("#bo_table").val();
    console.log(bourl);
    $(".sg_cate_list").click(function(){

      $.ajax({
      type : "POST",
      url : '../skin/board/basic/modal/sg_cate_list.html',
      dataType : "text",
      error : function() {
          alert('통신실패!!');
      },
      success : function(data) {
          $('#Context').html(data);
      }
    });
     })

     function house_del_modal(wr_id){

     var answer = confirm("건물을 삭제 하시겠습니까? 건물 삭제시 호실정보도 같이 삭제되며 삭제후 복구 불가능합니다.");

                 if (answer){

     location.href='../bbs/delete.php?wr_id='+wr_id;
     			}

     }
$(document).ready(function(){
    $(".search_button").click(function(){
        $(".search_wrap").toggle(200);
    });


});

</script>

<?php
// if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
include_once("$board_skin_path/lib/skin.lib.php");
?>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.7.0/fullcalendar.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.7.0/fullcalendar.print.css">


<style>
.wrapper{
  padding: 0;
  margin-bottom:25px;
}
.main-list-wrap{
    margin-top:285px;
}
.board_search{
    height:330px;
    background:#3b4db7;
}
.title_wrap{
    width: 900px;
    margin:0 auto;
    color:#fff;
    font-size:30px;
}
.title_wrap p{
    margin-top:5px;
    font-size: 16px;
    line-height: 22px;
}
</style>


<div class="search_wrap " style="text-align:center;">


<div class="board_search" >

    <div class="title_wrap">
        <i class="fa fa-book" aria-hidden="true" style="font-size:55px; padding: 20px;"></i>
        <br>
        RNote 일정관리
        <p>중개업무의 사무업무 관련 내용을 기록하여<br> 진행상황을 파악할 수 있습니다.</p>
    </div>


  </div>
  </div>


</div>

<div id='calendar'></div>

<div class="col-lg-12 main-list-wrap" >

  <div class="page_href">HOME >
    <? if ($wr_writer_id == $member[mb_id] && !$wr_important == 1&& $wr_sold_out !== '1'){ ?>
    <span><strong>My Note</strong></span>
    <?}else if ($wr_important == '1' && $wr_sold_out !=='1') {?>
    <span><strong>Office Note</strong></span>
    <?}else if($wr_writer_id == $member[mb_id]  && $wr_sold_out == '1') { ?>
    <span><strong>My Note > 거래종료</strong></span>
    <?}else if($wr_important == '1' && $wr_sold_out == '1') { ?>
    <span><strong>Office Note > 거래종료</strong></span>
    <?}?>
  </div>
          <div class="content_header">
            <?if ($wr_writer_id == $member[mb_id] && !$wr_important == 1) { ?>
                <?if ($gr_admin ){ ?>
                <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$member[mb_id]?>&board_list=<?$member[mb_3]?>&wr_sale_type=1&wr_writer_id=<?=$member[mb_id]?>" class="btn btn-theme03 left rent" style="padding-left:12px;">
                임대
                </a> 

                <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$member[mb_id]?>&board_list=<?$member[mb_3]?>&wr_sale_type=2&wr_writer_id=<?=$member[mb_id]?>" class="btn btn-theme03 left sale" style="padding-left:12px;">
                매매
                </a>
                <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$member[mb_id]?>&board_list=<?=$member[mb_3]?>&wr_writer_id=<?=$member[mb_id]?>&wr_sold_out=1" class="btn btn-theme03 left sold_out" style="padding-left:12px;">
                거래종료
               </a>
                <?}else if(!$gr_admin){ ?>
                <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$member[mb_id]?>&board_list=<?$member[mb_3]?>&wr_sale_type=1&wr_writer_id=<?=$member[mb_id]?>" class="btn btn-theme03 left rent" style="padding-left:12px;">
                임대
                </a>

                <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$member[mb_id]?>&board_list=<?$member[mb_3]?>&wr_sale_type=2&wr_writer_id=<?=$member[mb_id]?>" class="btn btn-theme03 left sale" style="padding-left:12px;">
                매매
                </a>
                <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$member[mb_id]?>&board_list=<?=$member[mb_3]?>&wr_writer_id=<?=$member[mb_id]?>&wr_sold_out=1" class="btn btn-theme03 left sold_out" style="padding-left:12px;">
                거래종료
               </a>


                  <?}}else if($wr_important == 1 ){?>
                    <?if ($gr_admin ){ ?>
                    <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$member[mb_id]?>&board_list=<?=$member[mb_3]?>&wr_important=1&wr_sale_type=1&wr_office_permission=<?$wr_office_permission?>" class="btn btn-theme03 left rent" style="padding-left:12px;">

                   
                임대
                </a> 

                <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$member[mb_id]?>&board_list=<?=$member[mb_3]?>&wr_important=1&wr_sale_type=2&wr_office_permission=<?$wr_office_permission?>" class="btn btn-theme03 left sale" style="padding-left:12px;">
                매매
                </a>
                <?}else if(!$gr_admin){ ?>
                <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$gr_cp?>&board_list=<?$member[mb_3]?>&wr_sale_type=1&wr_important=1&wr_office_permission=2" class="btn btn-theme03 left rent" style="padding-left:12px;">
                임대
                </a>
         
                <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$gr_cp?>&board_list=<?$member[mb_3]?>&wr_sale_type=2&wr_important=1&wr_office_permission=2" class="btn btn-theme03 left sale" style="padding-left:12px;">
                매매
                </a>
                <?} }?>
            <?if ($wr_important == 1){ ?>
            <?if ($gr_admin){ ?>
    
            <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$member[mb_id]?>&board_list=<?$member[mb_3]?>&wr_important=1&wr_sale_type=1&wr_office_permission=1" class="btn btn-theme03 left permission_no" style="padding-left:12px;">
             미승인매물
            </a>
            <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$member[mb_id]?>&board_list=<?=$member[mb_3]?>&wr_important=<?=$wr_important?>&wr_sold_out=1&wr_writer_id=<?=$member[mb_id]?>" class="btn btn-theme03 left sold_out" style="padding-left:12px;">
             거래종료
            </a>
            
            <?}else{ ?>
              <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$gr_cp?>&board_list=<?$member[mb_3]?>&wr_important=1&wr_sale_type=1&wr_office_permission=1&wr_writer_id=<?=$member[mb_id]?>" class="btn btn-theme03 left permission_no" style="padding-left:12px;">
             미승인매물
            </a>
            <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$gr_cp?>&board_list=<?=$member[mb_3]?>&wr_important=<?=$wr_important?>&wr_sold_out=1" class="btn btn-theme03 left sold_out" style="padding-left:12px;">
             거래종료
            </a>
         
            <?}}?>
  
            <!-- <span class="btn btn-theme03 left list_style_memo "style="padding-left:12px;"> 메모지형 </span> -->




<!--  검색 끝 -->
            <form name="fboardlist" id="fboardlist" action="./copy_update.php"  method="post">
            <!-- <input type="text" value="검색어를 입력 해 주세요" class="search left" />
            <input type="button" value="검색" class="search left"/> -->
            <! -- MODALS -->
          <!-- Button trigger modal -->

            <?=$GET_['office_write']?>
              
          <? if($gr_admin){ ?>
            <button class="btn btn-theme03 right  config active" type="button"  style="margin-right:10px;">
              <i class="fa fa-cog" aria-hidden="true" value="중요매물등록"  style="font-size:18px; "></i>
              매물관리설정
            </button>
          <?}else if($gr_cp && $wr_writer_id == $member[mb_id] || $wr_sold_out){ ?>
            <button class="btn btn-theme03 right  config active" type="button"  style="margin-right:10px;">
              <i class="fa fa-cog" aria-hidden="true" value="중요매물등록"  style="font-size:18px; "></i>
              매물관리설정
            </button>
          <?}?>

          <? if ( !$_GET[wr_important] == 1 && !$wr_sold_out == 1){?>
            <a href="<?echo G5_BBS_URL?>/write.php?bo_table=<?=$bo_table?>&board_list=<?=$member[mb_3]?>" class="btn btn-theme03 right sg_cate_list active" style="background:#3b4db7; color:#fff;">
          <i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:18px; "></i>
           매물등록하기
          </a> 
          <?}else{} ?>
          </div>

                          <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                          <input type="hidden" name="board_list" value="<?php echo $board_list ?>">
                          <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
                          <input type="hidden" name="stx" value="<?php echo $stx ?>">
                          <input type="hidden" name="spt" value="<?php echo $spt ?>">
                          <input type="hidden" name="sca" value="<?php echo $sca ?>">
                          <input type="hidden" name="sst" value="<?php echo $sst ?>">
                          <input type="hidden" name="sod" value="<?php echo $sod ?>">
                          <input type="hidden" name="page" value="<?php echo $page ?>">
                          <input type="hidden" name="wr_sale_type" value="<?=$wr_sale_type ?>">
                          <input type="hidden" name="wr_sold_out" value="<?=$wr_sold_out ?>">
                          <input type="hidden" name="wr_important" value="<?=$wr_important ?>">
                          <input type="hidden" name="sw" value="">

                <div class="sold_wrap">

                            <?php
                              for ($i=0; $i<count($list); $i++) {
                               ?>
                               <div class="sold_out_list col-md-3">
                               <div class="sold_out_con" onClick=location.href="<?php echo $list[$i]['href'] ?>">
                               <ul>
                                <li>
                                <h4><?=$list[$i]['wr_subject']?>
                                <span style="float:right; font-size:12px;"><?php echo date("Y-m-d", strtotime($list[$i]['wr_sold_out_date'])); ?></span>
                                </h4>
                                </li>
                                <li><?=$list[$i]['wr_address']?>
                                <span style="font-size: 10px; float: right;background:#333; padding:5px; color:#fff; " > 
                                <?=$list[$i]['wr_writer']?>
                                </span>
                                </li>
                      
                               </ul>
                               
                               </div>
                               </div>

                            <?}?> <!-- 반복문 끝 !-->
                </div>

                  <?php if (count($list) == 0) { echo '<tr><td colspan="10" class="empty_table">등록된 매물이 없습니다.</td></tr>'; } ?>

                 

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
                          <input type="text" name="confirm_unaccept2" class="etc" style="display:none; width:100%; height:50px; margin-top:5px; text-align:center; border:1px solid #202b6e;  background:#3b4db7; color:#fff;"/>
                    </div>
                    <!-- Footer -->
                    <div class="modal-footer" style="padding:15px;">
                      <button type="button" class="btn btn-default s2" data-dismiss="modal">승인거절</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                    </div>
                  </div>
                </div>
              </div>

                      </form>

            <div class="chk_confirm_wrap">
              <? if ($wr_sold_out == '1'){ ?>
                <span class="s1">사무실매물등록하기</span>
                <span class="s6">마이노트로등록하기</span>
                <span class="s8">즐겨찾기등록하기</span>
                <span class="s7">삭제</span>

              <?}else{?>
              <?if (!$gr_cp && !$gr_admin) {}else{?>
                <?if ($wr_important == '1'){}else{ ?>
              <span class="s1">사무실매물등록하기</span>
              <span class="s8">즐겨찾기등록하기</span>
              <?}}?>
              <? if ($gr_admin && $wr_important == 1){?>
              <?if (!$gr_cp && !$gr_admin) {}else{?>
              <span class="s4" style="display:none;">사무실매물로수락</span>
              <?}?>
              <?if (!$gr_cp && !$gr_admin) {}else{?>
              <span data-target="#layerpop" data-toggle="modal" style="display:none;" class="s5">거절하기</span>
              <?}}?>

              <span class="s3">거래종료등록하기</span>
              <span class="s7">삭제</span>
              <?}?>
            </div>
</div>
<?echo $write_pages;?>

                      <!-- <div class="td td_date"> -->

                        <!-- 수정버튼 -->
                        <!-- <?php $board_list = $list[$i]['board_list']; ?> -->
                      <!-- <a class='btn btn-primary btn-xs'  href="../bbs/write.php?w=u&bo_table=<?echo $bo_table?>&board_list= <?echo $list[$i][board_list] ?>&wr_id=<?echo $list[$i][wr_id]?>"> -->
                      <!-- <i class='fa fa-pencil'></i></a> -->
                      <!-- 리스트에서 삭제버튼 적용을 위한 url -->
                      <?
                          // $wr_id = $list[$i]['wr_id'];
                          // $delete_href = "javascript:del('./delete.php?bo_table=$bo_table&wr_id=$wr_id&page=$page".urldecode($qstr)."');";
                        ?>
                      <!-- 삭제버튼 -->
                      <!-- <?php if ($delete_href) { ?><a class='btn btn-danger btn-xs'  href="<?php echo $delete_href ?>" class="btn_b01">삭제</a><?php } ?> -->
                      <!-- </div> -->

  <input type="hidden" id="bo_table" value="<?php echo $bo_table?>" ?>

<!-- } 게시판 목록 끝 -->


<!-- js placed at the end of the document so the pages load faster -->
<script src="<?php G5_PATH?>/assets/js/moment.min.js"></script>
<script src="<?php G5_PATH?>/assets/js/fullcalendar.min.js"></script>
<script>
$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'listDay,listWeek,month'
			},

			// customize the button names,
			// otherwise they'd all just say "list"
			views: {
				listDay: { buttonText: 'list day' },
				listWeek: { buttonText: 'list week' }
			},

			defaultView: 'listWeek',
			defaultDate: '2017-11-12',
			navLinks: true, // can click day/week names to navigate views
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
				{
					title: 'All Day Event',
					start: '2017-11-01'
				},
				{
					title: 'Long Event',
					start: '2017-11-07',
					end: '2017-11-10'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2017-11-09T16:00:00'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2017-11-16T16:00:00'
				},
				{
					title: 'Conference',
					start: '2017-11-11',
					end: '2017-11-13'
				},
				{
					title: 'Meeting',
					start: '2017-11-12T10:30:00',
					end: '2017-11-12T12:30:00'
				},
				{
					title: 'Lunch',
					start: '2017-11-12T12:00:00'
				},
				{
					title: 'Meeting',
					start: '2017-11-12T14:30:00'
				},
				{
					title: 'Happy Hour',
					start: '2017-11-12T17:30:00'
				},
				{
					title: 'Dinner',
					start: '2017-11-12T20:00:00'
				},
				{
					title: 'Birthday Party',
					start: '2017-11-13T07:00:00'
				},
				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2017-11-28'
				}
			]
		});
		
	});

</script>
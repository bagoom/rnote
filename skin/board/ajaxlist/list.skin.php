<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once("$board_skin_path/lib/skin.lib.php");
?>

<link rel="stylesheet" href="<?php G5_PATH?>/assets/css/style2.css">
<script src="<?php G5_PATH?>/assets/js/modernizr.custom.js"></script>
<script src="<?php G5_PATH?>/assets/js/jquery-labelauty.js"></script>
<link rel="stylesheet" type="text/css" href="<?php G5_PATH?>/assets/css/jquery-labelauty.css">
<link rel="stylesheet" href="<?php G5_PATH?>/assets/css/bootstrap-range.min.css">
<script>

$(document).ready( function(){

            listAjax(1);

});

function listAjax(no){

		if(no){


		$.ajax({
			type: "POST",
			url: "<?=$board_skin_url?>/list.ajax.php",
			data: "bo_table=<?=$bo_table?>&wr_sale_type=<?=$wr_sale_type?>&page="+ no + "&sop=<?=$sop?>&stx=<?=$stx?>&sca=<?=$sca?>&sfl=<?=$sfl?>",
			cache: false,
			success: function(html){

				var listHtml = html.split('▤');

				if(html.indexOf("td_num") == -1){

			    	$('.tbody').html(listHtml[0]);
			    	$('#listPaging').html(listHtml[1]);

			    }else{

					$('.tbody').html(listHtml[0]);
					$('#listPaging').html(listHtml[1]);

				}

		    }
		});

		}
		else{

				alert('end');

		}





}

</script>
<style>
.wrapper{
  padding: 0;
  margin-bottom:25px;
}
.board_search ul{
  overflow: hidden;
  margin: 0 auto;
}
/*.board_search li{
  width: 33.333%;
  float: left;
  text-align: center;
}*/
.board_search li:last-child{
  border: 0;
}
.minimum,.maximum{
  border-bottom: 1px solid #3b4db7 !important;
  border-right: 0!important;
  color: #222 !important;
}

.board_search .input_range, .input_box,.input_box2{
  position: relative;
  float: left;
  padding:15px;
  max-height: 45px;
  background: rgba(247, 247, 247,1);
  cursor: pointer;
  /*border-top: 3px solid #3b4db7;*/
}
.input_box:first-child{
  margin-left: 15px;
}

.board_search li:first-child div{
  display: inline-block;
}

.board_search input[type=text]{
  width: 100%;
  height: 35px;
  margin: 10px 0;
  text-align: center;
  font-size: 16px;
  font-weight: bold;
  background: transparent;
  color: #222;
  border:1px solid #ddd;
  /*border-right:1px solid #e0e0e0;*/
}
.board_search .range input[type=text]{
  width: 50%;
  float: left;
  margin-top: 5px;

}

.input_range input[type=text]{
  width: 47%;
  float: left;
  padding-right:0;
}
.input_box2 input[type=submit]{
  background: transparent;
  border:0;
}
.range_min,.range_max{
  width: 50%;
  float: left;
  margin-bottom: 0;
  text-align: center;
}
#my_popup{
  position: absolute;
  width:300px;
  top:53px;
  left:0 !important;
  text-align: left;
  padding : 15px;
  background: #fff;
  box-shadow: 0 3px 5px rgba(0,0,0,0.2);
  z-index:10;
}
#my_popup input[type=submit]{
  width: 100%;
  background: #3b4db7;
  color: #fff;
  border:0;
  padding: 10px;
}
.search_list i{
  font-size: 12px;
  padding-left: 5px;
  padding-right: 25px;
  border-right: 1px solid #d1d1d1;
}
.check_list_wrap{
  top:15px ;
}
</style>


<div class="search_wrap " style="text-align:center;">

  <div class="board_search" >
  <form name="fsearch" method="post">
  <input type="hidden" name="bo_table" value="<?=$bo_table?>"/>
  <input type="hidden" name="wr_sale_type" value="<?=$wr_sale_type?>"/>

      <div class="input_box ">
       <span class="search_list">매물명  <i class="fa fa-caret-down" aria-hidden="true"></i></span>
        <div id="my_popup" style="display:none;">
          <p>매물명</p>
          <input type="text" name="wr_subject"   value='<?=$_POST['wr_subject']?>' placeholder="매물명">


          <!-- <button class="my_popup_close">Close</button> -->
        </div>
      </div>


      <div style="width:125px; float:left; ">
        <div class="job" id="trigger-overlay" style="margin:0; padding:15px; font-size:13px; background:#f7f7f7; color:#323e51; "> 추천업종
      <i class="fa fa-caret-down" aria-hidden="true" style="font-size: 12px; padding-left: 5px; padding-right:25px; border-right: 1px solid #d1d1d1;"></i></div>
      <ul id="wr_rec_job">
      </ul>
      <input type="hidden" id="search_box" name="wr_rec_sectors" value="<?=$write[wr_rec_sectors]?>"/>

      <div class="overlay overlay-hugeinc" id="overlay" style="position:relative;" >

  <div class="check_list_wrap" style="top:15px !important; width:500px;" >
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
  <button type="button" id="overlay-close" class="overlay-close" style="bottom:-590px !important; width:500px !important;">확인</button>
      </div>
</div>
      <script>
        $(document).ready(function(){
          $(":checkbox").labelauty();
          $(":radio").labelauty();
          $('#tab label').remove();
        });

      </script>

          <!-- <button class="my_popup_close">Close</button> -->

      <div class="input_box ">
       <span class="search_list">상권명 <i class="fa fa-caret-down" aria-hidden="true"></i></span>
        <div id="my_popup" style="display:none;">
          <p>상권명</p>
          <input type="text" name="wr_sale_area" value='<?=$_POST['wr_sale_area']?>' placeholder="상권명">
          <!-- <button class="my_popup_close">Close</button> -->
        </div>
      </div>

      <div class="input_box ">
       <span class="search_list">주소 <i class="fa fa-caret-down" aria-hidden="true"></i></span>
        <div id="my_popup" style="display:none;">
          <p>주소</p>
          <input type="text" name="wr_address" value='<?=$_POST['wr_address']?>' placeholder="주소">
          <!-- <button class="my_popup_close">Close</button> -->
        </div>
      </div>

      <div class="input_box ">
       <span class="search_list">담당자명 <i class="fa fa-caret-down" aria-hidden="true"></i></span>
        <div id="my_popup" style="display:none;">
          <p>담당자명</p>
          <input type="text" name="wr_writer" value='<?=$_POST['wr_writer']?>' placeholder="담당자명">
          <!-- <button class="my_popup_close">Close</button> -->
        </div>
      </div>

      <div class="input_box range">
       <span class="search_list">층수 <i class="fa fa-caret-down" aria-hidden="true"></i></span>
        <div id="my_popup" style="display:none;">
          <p>층수</p>
          <p class="range_min">최소</p><p class="range_max">최대</p>
          <input type="text" name="wr_floor_min" value="<?=$_POST['wr_floor_min']?>" style="border-right:0;" >
          <input type="text"  name="wr_floor_max" value='<?=$_POST['wr_floor_max']?>'>
          <!-- <button class="my_popup_close">Close</button> -->
        </div>
      </div>

      <div class="input_box range">
       <span class="search_list">면적 <i class="fa fa-caret-down" aria-hidden="true"></i></span>
        <div id="my_popup" style="display:none;">
          <p>면적</p>
          <p class="range_min">최소</p><p class="range_max">최대</p>
          <input type="text" name="wr_area_p_min" value='<?=$_POST['wr_area_p_min']?>' style="border-right:0;" >
          <input type="text" name="wr_area_p_max" value='<?=$_POST['wr_area_p_max']?>'>
          <!-- <button class="my_popup_close">Close</button> -->
        </div>
      </div>

      <div class="input_box range">
       <span class="search_list">매물금액 <i class="fa fa-caret-down" aria-hidden="true"></i></span>
        <div id="my_popup" style="display:none;">
          <p>매물금액</p>
          <p class="range_min">보증금최소</p><p class="range_max">보증금최대</p>
          <input type="text" name="wr_rent_deposit_min" value='<?=$_POST['wr_rent_deposit_min']?>' style="border-right:0;" >
          <input type="text" name="wr_rent_deposit_max" value='<?=$_POST['wr_rent_deposit_max']?>'>
          <p class="range_min">임대료최소</p><p class="range_max">임대료최대</p>
          <input type="text" name="wr_m_rate_min" value='<?=$_POST['wr_m_rate_min']?>' style="border-right:0;" >
          <input type="text" name="wr_m_rate_max" value='<?=$_POST['wr_m_rate_max']?>'>
          <p class="range_min">권리금최소</p><p class="range_max">권리금최대</p>
          <input type="text" name="wr_premium_o_min" value='<?=$_POST['wr_premium_o_min']?>' style="border-right:0;" >
          <input type="text" name="wr_premium_o_max" value='<?=$_POST['wr_premium_o_max']?>'>
          <p class="range_min">합예산최소</p><p class="range_max">합예산최대</p>
          <input type="text" name="wr_rent_p34232osit_min" value='<?=$_POST['wr_rent_de323po32321sit_min']?>' style="border-right:0;" >
          <input type="text" name="wr_rnt_eposit_max" value='<?=$_POST['wr_rent_deposit_m123123a2x']?>'>
          <!-- <button class="my_popup_close">Close</button> -->
        </div>
      </div>

      <div class="input_box2"  style="background:#e2215e !important">
       <span class="search_list"  >검색초기화</span>
      </div>
      <div class="input_box2" >
        <input type="submit" value="검색"  class="btn-default" >
      </div>



<!-- <div class="submit_box" style="width:300px; margin:0 auto; padding-top:25px; overflow:hidden;">
  <input type="reset" value="초기화" style="background:transparent; border:1px solid #aaa; color:#fff; padding:15px; width:150px; font-size:16px; text-align:center; float:left; border-right:0;">
</div> -->
<input type="submit" value="검색" style="background:transparent; border:1px solid #aaa; color:#fff; padding:15px; width:150px; font-size:16px; text-align:center; float:left; display:none;">
  </form>
  </div>


</div>


    <form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

		<div class="col-lg-12 main-list-wrap" >

		  <div class="page_href">HOME >
		    <? if ($wr_important == '2' && $wr_sale_type == '1'){ ?>
		    <span><strong>My Note</strong></span>
		    <?}else if ($wr_important == '1') {?>
		    <span><strong>Office Note</strong></span>
		    <?}else if($wr_sale_type == '3') { ?>
		    <span><strong>거래종료</strong></span>
		    <?}else if($wr_office_permission == '1') { ?>
		    <span><strong>거래종료</strong></span>
		    <?}?>
		  </div>
		          <div class="content_header">
		            <form method = "get">
		            <input type="hidden" name="bo_table" value="<?=$bo_table?>" />
		            <input type="hidden" name="board_list" value="<?=$board_list?>" />
		            <input type="hidden" name="wr_important" value="<?=$wr_important?>" />
		            <!-- <input type="submit" name="wr_sale_type" value="1" /> -->
		            <button class="btn btn-theme03 left rent" name="wr_sale_type" type="submit" value="1"style="padding-left:12px;">
		             임대
		            </button>
		            <button class="btn btn-theme03 left sale" name="wr_sale_type" type="submit" value="2"style="padding-left:12px;">
		             매매
		            </button>
		            <span class="btn btn-theme03 left list_style_list active" style="padding-left:12px;"> 리스트형</span>
		            <span class="btn btn-theme03 left list_style_memo"style="padding-left:12px;"> 메모지형 </span>
		          </form>






		<!--  검색 끝 -->
		            <form name="fboardlist" id="fboardlist" action="./copy_update.php"  method="post">
		            <!-- <input type="text" value="검색어를 입력 해 주세요" class="search left" />
		            <input type="button" value="검색" class="search left"/> -->
		            <! -- MODALS -->
		          <!-- Button trigger modal -->

		<?=$GET_['office_write']?>
		          <button class="btn btn-theme03 right  config" type="button"  style="margin-right:10px;">
		            <i class="fa fa-cog" aria-hidden="true" value="중요매물등록"  style="font-size:18px; "></i>
		            매물관리설정
		          </button>
		          <? if ( $_GET[wr_important] == 1 ){
		          }else{ ?>
		          <!-- <button class="btn btn-theme03 right sg_cate_list"  type="button" data-toggle="modal" data-target="#myModal"data-backdrop="static" data-keyboard="false">
		            <i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:18px; "></i>
		           매물등록하기
		          </button> -->
		          <?}?>
		          </div>






		<!--
		                      <? if ($sfl == "wr_important"&&$stx=="1"){
		                      echo "중요 매물리스트";
		                    }elseif($wr_sale_type=="1"){
		                      echo "임대 매물리스트";
		                    }elseif($wr_sale_type=="2"){
		                        echo "매매 매물리스트";
		                      }else{
		                        echo "매물리스트";
		                      }

		                      ?>
		                      <?
		                      $sql = "select count(*) as cnt from {$write_table}";
		                      $result3 = sql_fetch($sql);
		                      ?>
		                        <span class="tb_header_cnt right">  <span>Total <?php echo number_format($result3['cnt']) ?>건</span></span> -->

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
		                  <div class="board_list_box col-xs-12 col-md-12" id="list_style_list">
		                    <div class="table">
		                      <div class="thead">
                            <?php $sale = $_GET['wr_sale_type'] ; ?>
		                        <div class="td">번호</div>
		                        <div class="td">매물명</div>
		                        <div class="td"><? if($sale == '1' || $sale == '3') echo '상권명'; else echo '지목'?></div>
		                        <div class="td"><? if($sale == '1' || $sale == '3') echo '층수'; else echo '지역지구'?></div>
		                        <div class="td"><? if($sale == '1' || $sale == '3') echo '평수'; else echo '총면적'?></div>
		                        <div class="td"><? if($sale == '1' || $sale == '3') echo '보증금'; else echo '총매도가'?></div>
		                        <div class="td"><? if($sale == '1' || $sale == '3') echo '월세'; else echo '평당가격'?></div>
		                        <div class="td"><? if($sale == '1' || $sale == '3') echo '권리금'; else echo '주소'?></div>
		                        <? if ($sale == '2'){ ?>
		                        <? if($_GET[wr_important] == 1){ ?>
		                          <div class="td">담당자</div>
		                        <?} }?>
		                        <div class="td"><? if($sale == '1') echo '합계'; else echo '등록일'?></div>
		                        <? if($sale == '1'  || $sale == '3'){?><div class="td">주소</div><?}?>
		                        <? if ($sale == '1' || $sale == '3'){ ?>
		                        <? if( $_GET[wr_important] == 1 ){ ?>
		                          <div class="td">담당자</div>
		                        <?} }?>
		                        <? if($sale == '1' || $sale == '3'){?><div class="td">등록일</div><?}?>
		                      </div>
		                      <div class="tbody">
		                              <?php
		                              for ($i=0; $i<count($list); $i++) {
		                               ?>

		                       <div class="td_chk " style="display:none; ">
		                         <input type="checkbox" name="chk_wr_id[]" class="import_chk" style="display:none;" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" >
		                         <label for="chk_wr_id_<?php echo $i ?>"> <p><i class="fa fa-check"></i></p></label>
		                       </div>
		                      <div class="tr" id="list_link"onClick=location.href="<?php echo $list[$i]['href'] ?>" style="position:relative">

		                        <div class="td">
		                          <?= $list[$i]['num']?>
		                        </div>
		                        <div class="td" style="font-weight:600; background:#edf1f4; ">
		                          <?php echo $list[$i]['subject'] ?>
		                        </div>
		                        <div class="td">
		                          <?php  if($sale == '1' || $sale == '3') echo $list[$i]['wr_sale_area']; else echo $list[$i]['wr_rand_type']; ?>
		                        </div>
		                          <?php  if($sale == '1' || $sale == '3') {?>
		                        <div class="td">
		                          <?  if ($list[$i]['wr_floor'] < 0) {$under_floor = str_replace('-', "", $list[$i]['wr_floor']); echo "지하".$under_floor.'층'; }else echo $list[$i]['wr_floor'].'층'?>
		                        </div>
		                        <?} else{?>
		                          <div class="td">
		                            <?php echo $list[$i]['wr_zoning_district'] ?>
		                          </div>
		                          <?}?>
		                        <div class="td">
		                          <?php  if($sale == '1' || $sale == '3') echo $list[$i]['wr_area_p'].'평'; else echo $list[$i]['wr_area_p_all']; ?>
		                        </div>
		                        <div class="td">
		                          <span class="commaN">
		                          <?php  if($sale == '1' || $sale == '3') echo $list[$i]['wr_rent_deposit']; else echo $list[$i]['wr_sale_price']; ?>
		                          </span>
		                        </div>
		                        <div class="td">
		                          <span class="commaN">
		                          <?php  if($sale == '1' || $sale == '3') echo $list[$i]['wr_m_rate']; else echo $list[$i]['wr_p_sale_price']; ?>
		                        </div>
		                          </span>
		                        <div class="td">
		                          <span class="commaN">
		                          <?php  if($sale == '1' || $sale == '3') echo $list[$i]['wr_premium_o']; else{?>
		                        </span>
		                          <? echo $list[$i]['wr_address']; }?>
		                        </div>
		                        <? if ($sale == '2'){ ?>
		                        <? if( $_GET[wr_important] == 1 ){ ?>
		                          <div class="td">
		                            <?php echo $list[$i]['wr_writer'] ?>
		                          </div>
		                        <?} }?>
		                        <div class="td sum" style="background:#edf1f4">
		                          <span class="commaN" style="font-weight:600; ">
		                          <?php  if($sale == '1' || $sale == '3') echo $list[$i]['wr_premium_o'] + $list[$i]['wr_rent_deposit']; else{?>
		                            <? echo $list[$i]['datetime2']; }?>
		                          </span>
		                        </div>


		                        <? if($sale == '1' || $sale == '3'){?>
		                        <div class="td">
		                          <?php echo $list[$i]['wr_address'] ?>
		                        </div> <?} ?>

		                        <? if ($sale == '1' || $sale == '3'){ ?>
		                        <? if( $_GET[wr_important] == 1 ){ ?>
		                          <div class="td">
		                            <?php echo $list[$i]['wr_writer'] ?>
		                          </div>
		                        <?} }?>
		                        <? if($sale == '1' || $sale == '3'){?>
		                        <div class="td">
		                          <?php echo $list[$i]['datetime'] ?>
		                        </div><?}?>
		                      </div>
		                  <?php } ?>
		                      </div>
		                    </div>
		                  </div>
		                  <?php if (count($list) == 0) { echo '<tr><td colspan="10" class="empty_table">등록된 매물이 없습니다.</td></tr>'; } ?>

		                  <div class="board_list_box col-xs-12 col-md-12" id="list_style_memo" style="display:none;">
		                      <?php
		                      for ($i=0; $i<count($list); $i++) {
		                       ?>
		                       <div class="memo_list col-md-3" id="ddd"  style="position:relative; overflow:hidden;">
		                      <div class="right td_chk2" style="display:none; ">
		                        <input type="checkbox" name="chk_wr_id[]" class="import_chk" style="display:none;" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id2_<?php echo $i ?>" >
		                        <label for="chk_wr_id2_<?php echo $i ?>"><p>선택하기</p> <p><i class="fa fa-check"></i></p></label>
		                      </div>
		                      <a href="<?php echo $list[$i]['href'] ?>">
		                      <div class="list_item " style="width:100%;">
		                        <div class="list_num"><?= $list[$i]['num']?></div>

		                      <ul>
		                      <li class="list_subject">
		                        <?php echo $list[$i]['subject'] ?>
		                      </li>
		                      <li class="list_address">
		                        <span><?php echo $list[$i]['wr_address'] ?></span>
		                      </li>
		                      <li class="list_address" style="border-bottom: 3px solid #323e51; padding-bottom:20px;">
		                        <span><?php echo $list[$i]['wr_sale_area'] ?></span>
		                      </li>

		                      <li class="list_sub_info" style="border-left: 1px solid #ddd;"><p>보증금</p> <?=$list[$i]['wr_rent_deposit'] ?></li>
		                      <li class="list_sub_info"><p>월세</p> <?=$list[$i]['wr_m_rate'] ?></li>
		                      <li class="list_sub_info"><p>권리금</p><?php echo $list[$i]['wr_premium_o'] ?></li>
		                      <li class="list_sub_info" style="border-left: 1px solid #ddd;"><p>층/평</p>
		                        <?  if ($list[$i]['wr_floor'] < 0) {
		                       $under_floor = str_replace('-', "", $list[$i]['wr_floor']); echo "지하".$under_floor; }
		                        else echo $list[$i]['wr_floor']?>
		                      <?php echo $list[$i]['wr_area_p'] ?> </li>

		                      <li class="list_sub_info"><p>합예산</p> <?php echo $list[$i]['wr_rent_deposit']+$list[$i]['wr_premium_o'] ?></li>

		                      <li class="list_sub_info"><p>등록일</p> <?php echo $list[$i]['datetime2'] ?></li>

		                    </ul>
		                    </div>
		                  </a>
		                  </div>
		                <?php } ?>
		              </div>


		                      </form>

		            <div class="chk_confirm_wrap">
		              <?if (!$gr_cp && !$gr_admin) {}else{?>
		                <?if ($wr_important == '1'){}else{ ?>
		              <span class="s1">사무실매물등록하기</span>
		              <span class="s2">즐겨찾기등록하기</span>
		              <?}}?>
		              <span class="s3">매매완료등록하기</span>

		            </div>
		</div>

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($is_checkbox) { ?>
        <ul class="btn_bo_adm">
            <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"></li>
        </ul>
        <?php } ?>

        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <?php } ?>
    </form>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo '<span id="listPaging">'.$write_pages.'</span>';  ?>

<!-- 게시판 검색 시작 { -->
<fieldset id="bo_sch">
    <legend>게시물 검색</legend>

    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
        <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
        <option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
        <option value="mb_id,1"<?php echo get_selected($sfl, 'mb_id,1'); ?>>회원아이디</option>
        <option value="mb_id,0"<?php echo get_selected($sfl, 'mb_id,0'); ?>>회원아이디(코)</option>
        <option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>글쓴이</option>
        <option value="wr_name,0"<?php echo get_selected($sfl, 'wr_name,0'); ?>>글쓴이(코)</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="frm_input required" size="15" maxlength="20">
    <input type="submit" value="검색" class="btn_submit">
    </form>
</fieldset>
<!-- } 게시판 검색 끝 -->

  <script src="<?php G5_PATH?>/assets/js/classie.js"></script>
  <script src="<?php G5_PATH?>/assets/js/demo3.js"></script>
  <script type="application/javascript">
  $(".tr:even").css("background", "white");



  // 검색창 클릭 팝업
  $(".input_box").on('click',function(e){
    $('.drop-down-open').hide();
  	myDropDown = $(this).find('#my_popup');
  	if( myDropDown.is(':visible') ) {
  		$(myDropDown).removeClass('drop-down-open');
  		myDropDown.hide();
  	} else {
  		myDropDown.fadeIn();
      $(this).find('input[type=text]').first().focus();
      $(myDropDown).addClass('drop-down-open');
  	}
  	return false;
  });

  $('body').click(function(event) {
  	$('.drop-down-open').hide();
  });
    $('.input_box #my_popup').click(function(event){
  	event.stopPropagation();
  });

  // 검색 초기화 버튼
  $(".input_box2 span").click(function(){
      $(".board_search input[type=text]").val("");
  });

  // 추천업종 선택 스크립트
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

  $('.wrapper').css("height", $(document).height() );
  $('.td_chk').css("width", $(".tr").innerWidth() );
  $('.td_chk label').css("height", $(".tr").innerHeight() );

  $(function() {
      $("p.holder + input").focus(function() {
        console.log($(this).val())
          if($(this).val()) {
              $(this).prev('p.holder').hide(350);
          }
          $(this).select();
      });
      // $("p.holder + input").blur(function() {
      //     if(!$(this).val().length) {
      //         $(this).prev('p.holder').show(350);
      //     }else{
      //       $(this).prev('p.holder').show(350);
      //     }
      // });
      $("p.holder").click(function() {
          $(this).next().focus();
      });
      $("p.holder + input").focus( function() {
          $(this).prev('p.holder').addClass('active');
      }).blur(function() {
          $(this).prev('p.holder').removeClass('active');
      });
  });



  //  숫자 천단위에 콤마를 찍기위한 함수
    for (var i =0 ; i <= $(".commaN").length;  i ++){
      $(".commaN").eq(i).text(numberWithCommas(parseInt($(".commaN").eq(i).html())));
    }
  function numberWithCommas(x) {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

  // 추천업종 팝업창 수정 스크립트
  $("#overlay-close").click(function(){
  $('#wr_rec_job li').remove();
  console.log("dddd")
  var test = $("[aria-checked=true]").children('.labelauty-checked');
  var test_html = test.html();

  var list = []

  for(var i = 0; i< test.length; i++){
  list.push(test[i].innerHTML)
  $("#search_box").val(test.text());
  }
  });


  // 추천업종 추가
  function include(arr, obj) {
  for(var i=0; i<=arr.length-1; i++) {
      if (arr[i] == obj) return true;
      }
  }
  var b;
  $( document ).ready(function() {
   var target = $(".check_list_wrap label .labelauty-checked");
   var target2 =  $(".check_list_wrap label");
   var a =  "<?=$write[wr_rec_sectors]?>"
   b = a.split(' ');
   b.pop();
  for (var i = 0; i < target.length; i++) {
    if(include(b, target[i].innerHTML.replace(' ',''))){
      $(target[i]).attr('aria-checked', true)
      $(target2[i]).prev().attr('checked', true ) ;
      $(target2[i]).attr('aria-checked', true ) ;
      $('#wr_rec_job').append('<li>'+ target[i].innerHTML + '</li>')
     }
  }
      });


  // 리스트 체크했을때 , 중요매물 / 즐겨찾기 등록버튼

    $(".s1").click(function(){
    if("<?=$gr_admin?>"){
      $("#fboardlist").submit();
      // if(<?=$write_count?> >= "<?=$gr_write_permission?>"){
      // $("#fboardlist").submit();
      // }else{
      //   alert("사무실 매물 등록 권한이 없습니다.");
      // }

    }
    else if ("<?=$gr_cp?>"){

      // if(<?=$write_count?> >= "<?=$join_gr_info['gr_write_permission']?>"){
      $("#fboardlist").submit();
      // }else{
        // alert("사무실 매물 등록 권한이 없습니다.");
      // }

    }


    });

    $(".s2").click(function(){
        $("#fboardlist").attr("action", "./bookmark.php");
        $("#fboardlist").submit();

    });

    $(".s3").click(function(){
      $("#fboardlist").attr("action", "./sale_success.php");
      $("#fboardlist").submit();
    });

  //  리스트 형태 메모지형 , 리스트형으로 변경
     $(".list_style_memo").click(function(){
       $(this).addClass("active");
       $('.list_style_list').removeClass('active');
       $('#list_style_memo').show();
       $('#list_style_list').hide();
       $('.td_chk2').css("width", $(".list_item").outerWidth() );
       $('.td_chk2').css("height", $(".list_item").outerHeight() );
     });
     $(".list_style_list").click(function(){
       $(this).addClass("active");
       $('.list_style_memo').removeClass('active');
       $('#list_style_list').show();
       $('#list_style_memo').hide();

     });

      $( document ).ready(function() {
      if (<?=$_GET["wr_sale_type"]?> == "1"){
      $(".rent").addClass("active");
      }else if(<?=$_GET["wr_sale_type"]?> == "2"){
      $(".sale").addClass("active");
      }
      });

      var config = $(".config");
      $(config).click(function(){
      $(".td_chk,.td_chk2,.chk_confirm_wrap").fadeToggle(300,"swing");
      if( $(".chk_confirm_wrap").css("display") == "block"){
        $(".chk_confirm_wrap").css('display', 'none');
      }
      if($(".import_chk").is(":checked")){
        $(".chk_confirm_wrap").css('display', 'block');
      }
      });

  // 중요매물 클릭후 체크하면 클래스 추가 스크립트
      $(".import_chk").change(function(){
         if($(".import_chk").is(":checked")){
           $(".chk_confirm_wrap").slideDown('fast', 'swing');
           $(".important").attr("type","submit");
           $(".bookmark").attr("type","submit");
          //  $(".important").attr("type","submit");
        }else{
          $(".chk_confirm_wrap").slideUp('fast', 'swing');
          $(".important").attr("type","button");
          $(".bookmark").attr("type","button");
        }
        });

      function myNavFunction(id) {
          $("#date-popover").hide();
          var nav = $("#" + id).data("navigation");
          var to = $("#" + id).data("to");
          // console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
      }




       function house_del_modal(wr_id){

       var answer = confirm("건물을 삭제 하시겠습니까? 건물 삭제시 호실정보도 같이 삭제되며 삭제후 복구 불가능합니다.");

                   if (answer){

       location.href='../bbs/delete.php?wr_id='+wr_id;
       			}

       }






  </script>

<?php
// if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
include_once("$board_skin_path/lib/skin.lib.php");
?>

<script src="<?php G5_PATH?>/assets/js/modernizr.custom.js"></script>
<script src="<?php G5_PATH?>/assets/js/jquery-labelauty.js"></script>
<link rel="stylesheet" type="text/css" href="<?php G5_PATH?>/assets/css/jquery-labelauty.css">
<link rel="stylesheet" href="<?php G5_PATH?>/assets/css/bootstrap-range.min.css">
<link rel="stylesheet" href="<?php G5_PATH?>/assets/css/toastr.min.css">
<link href="<?=G5_URL?>/assets/css/jquery-nicelabel.css" rel="stylesheet" type="text/css" />

<style>
.wrapper{
  padding: 0;
  margin-bottom:25px;
}
.board_search ul{
  overflow: hidden;
  margin: 0 auto;
}
.list_search_wrap li{
  /*border-bottom:1px solid #d1d1d1;*/
  overflow: hidden;
}
.board_search li:last-child{
  border: 0;
}
.minimum,.maximum{
  border-bottom: 1px solid #3b4db7 !important;
  border-right: 0!important;
  color: #222 !important;
}
.board_search .input_range, .input_box{
  position: relative;
  float: left;
  width:33.333%;
  /*max-height: 45px;*/
  /*border-top: 3px solid #3b4db7;*/
}
.board_search input[type=text]{
  width: 100%;
  height: 50px;
  margin: 5px 0;
  text-align: center;
  font-size: 16px;
  font-weight: bold;
  background: transparent;
  color: #fff;
  border:0;
  border-bottom:1px solid rgba(255,255,255,0.5);
  /*border-right:1px solid #e0e0e0;*/
}
#my_popup{
  /*position: absolute;*/
  text-align: left;
  padding : 0px 25px;
  overflow: hidden;
}
.input_box p{
  width: 20%;
  height: 50px;
  line-height: 50px;
  margin: 5px 0;
  text-align: center;
  float: left;
  color: #fff;
  border-bottom:1px solid rgba(255,255,255,0.5);
}
.range_p{
  border-radius:0 !important;
}
.input_box input[type=text]{
  width: 80%;
  float: left;
}
.range input[type=text]{
  width: 30% !important;
  float: left;
}
.range input[type=text]:first-child{
  border-radius: 0!important;
}
.search_list i{
  font-size: 16px;
  padding-left: 5px;
  padding-right: 15px;
  color: rgba(255,255,255,0.7);
}
.search_btn_wrap{
  width: 400px;
  margin: 0 auto;
}
.input_box2{
  width: 47%;
  height:45px;
  line-height: 45px;
  margin-top: 30px;
  float: left;
  color: #000;
  font-size: 16px;
  margin-left: 5px;
  margin-right:5px;
  border-radius : 3px;
  background: #e8b82e;
  
  /* border: 0.5px solid rgba(255,255,255,0.8); */
  cursor: pointer;
}
.search_list{
  width:100%;
  height:45px;
  display: block;
}
.input_box2 input[type=submit]{
  /* width: 100%; */
  height: 45px;
  background: transparent;
  border:0;
  color: #000;
}
.input_box2 i{
  padding-right:5px;
  color : #000;
}
.job{
  background: transparent;
  color: #fff;
  border:  0.5px solid rgba(255,255,255,0.5);
  height:45px;
  margin:10px  0!important;
  line-height: 45px !important;
  padding:0;
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


<div class="search_wrap " style="text-align:center;">

  <div class="board_search" >
  <div class="list_search_wrap">
  <form name="fsearch" method="get">
  <input type="hidden" name="bo_table" value="<?=$bo_table?>"/>
  <input type="hidden" name="wr_sale_type" value="<?=$wr_sale_type?>"/>
  <input type="hidden" name="wr_important" value="<?=$wr_important?>"/>
  <input type="hidden" name="board_list" value="<?=$board_list?>"/>
  <?if ($wr_important == 1 && $gr_admin){ ?>
  <input type="hidden" name="wr_office_permission" value=""/>
  <?}elseif($wr_important == 1 && $wr_office_permission == "1"){?>
    <input type="hidden" name="wr_office_permission" value="1"/>
  <?}elseif( $wr_important == 1){?>
  <input type="hidden" name="wr_office_permission" value="2"/>
    <?}elseif( $wr_important == 2){?>
  <input type="hidden" name="wr_office_permission" value="0"/>
    <?}?>
  <? if ( $wr_sold_out == '1'){?>
    <input type="hidden" name="wr_sold_out" value="1"/>
  <?}?>
      <ul>
        <li>
          <div class="input_box ">
           <!-- <span class="search_list">매물명  <i class="fa fa-caret-down" aria-hidden="true"></i></span> -->
            <div id="my_popup" >
              <p>매물명</p>
              <input type="text" name="wr_subject"   value='<?=$_GET['wr_subject']?>' >
            </div>
          </div>

          <div class="input_box ">
           <!-- <span class="search_list">상권명 <i class="fa fa-caret-down" aria-hidden="true"></i></span> -->
            <div id="my_popup" >
              <p>상권명</p>
              <input type="text" name="wr_sale_area" value='<?=$_GET['wr_sale_area']?>' >
              <!-- <button class="my_popup_close">Close</button> -->
            </div>
          </div>

          <div class="input_box ">
           <!-- <span class="search_list">주소 <i class="fa fa-caret-down" aria-hidden="true"></i></span> -->
            <div id="my_popup" >
              <p>주소</p>
              <input type="text" name="wr_address" value='<?=$_GET['wr_address']?>' >
              <!-- <button class="my_popup_close">Close</button> -->
            </div>
          </div>


        </li>
        <li>
          <div class="input_box range">
           <!-- <span class="search_list">층수 <i class="fa fa-caret-down" aria-hidden="true"></i></span> -->
            <div id="my_popup" >
              <p>층수</p>
              <input type="text" name="wr_floor_min" value="<?=$_GET['wr_floor_min']?>" style="border-radius:0; border-right:0;" >
              <p class="range_p">~</p>
              <input type="text"  name="wr_floor_max" value='<?=$_GET['wr_floor_max']?>'>
              <!-- <button class="my_popup_close">Close</button> -->
            </div>
          </div>

          <div class="input_box range">
            <div id="my_popup" >
              <p>면적</p>
              <input type="text" name="wr_area_p_min" value='<?=$_GET['wr_area_p_min']?>' style="border-radius:0; border-right:0;" >
              <p class="range_p">~</p>
              <input type="text" name="wr_area_p_max" value='<?=$_GET['wr_area_p_max']?>'>
              <!-- <button class="my_popup_close">Close</button> -->
            </div>
          </div>

          <div class="input_box range">
            <div id="my_popup" >
              <p>보증금</p>
              <input type="text" name="wr_rent_deposit_min" value='<?=$_GET['wr_rent_deposit_min']?>' style="border-radius:0; border-right:0;" >
              <p class="range_p">~</p>
              <input type="text" name="wr_rent_deposit_max" value='<?=$_GET['wr_rent_deposit_max']?>'>
              <!-- <button class="my_popup_close">Close</button> -->
            </div>
          </div>
        </li>
        <li>
          <div class="input_box range">
            <div id="my_popup" >
              <p>임대료</p>
              <input type="text" name="wr_m_rate_min" value='<?=$_GET['wr_m_rate_min']?>' style="border-radius:0; border-right:0;" >
              <p class="range_p">~</p>
              <input type="text" name="wr_m_rate_max" value='<?=$_GET['wr_m_rate_max']?>'>
            </div>
          </div>


          <div class="input_box range">
            <div id="my_popup" >
              <p>권리금</p>
              <input type="text" name="wr_premium_o_min" value='<?=$_GET['wr_premium_o_min']?>' style="border-radius:0; border-right:0;" >
              <p class="range_p">~</p>
              <input type="text" name="wr_premium_o_max" value='<?=$_GET['wr_premium_o_max']?>'>
            </div>
          </div>

          <div class="input_box range">
            <div id="my_popup" >
              <p>합예산</p>
              <input type="text" name="wr_sum_pay_min" value='<?=$_GET['wr_sum_pay_min']?>' style="border-right:0;" >
              <p class="range_p">~</p>
              <input type="text" name="wr_sum_pay_max" value='<?=$_GET['wr_sum_pay_max']?>'>
              <!-- <button class="my_popup_close">Close</button> -->
            </div>
          </div>
          </li>
          <li>
          <div class="input_box ">
           <!-- <span class="search_list">담당자명 <i class="fa fa-caret-down" aria-hidden="true"></i></span> -->
            <div id="my_popup" >
              <p>담당자명</p>
              <input type="text" name="wr_writer" value='<?=$_GET['wr_writer']?>' >
              <input type="hidden" name="wr_writer_id" value='<?=$_GET['wr_writer_id']?>' >
              <!-- <button class="my_popup_close">Close</button> -->
            </div>
          </div>

          <div class="input_box">
            <div id="my_popup">
            <div class="job" id="trigger-overlay"> 추천업종
          <i class="fa fa-caret-down" aria-hidden="true" style="font-size: 12px; padding-left: 5px; "></i></div>
          <ul id="wr_rec_job">
          </ul>
          <input type="hidden" id="search_box" name="wr_rec_sectors" value="<?=$write[wr_rec_sectors]?>"/>
          </div>
          </div>
          <div class="overlay overlay-hugeinc" id="overlay" style="position:relative;width:97%;margin:0 auto; margin-top:70px;" >

      <div class="check_list_wrap" style="top:0px !important; width:100%;" >
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
      <button type="button" id="overlay-close" class="overlay-close" style="bottom:0px !important; width:100% !important;">확인</button>
      </div>
          <script>
            $(document).ready(function(){
              $(":checkbox").labelauty();
              $(":radio").labelauty();
              $('#tab label').remove();
            });
          </script>
        </li>
      </ul>

    <div class="search_btn_wrap">
      <div class="input_box2" style="border-right:0;">
       <span class="search_list"  ><i class="fa fa-refresh" aria-hidden="true" style="padding-right:10px;"></i>검색초기화</span>
      </div>
      <div class="input_box2" >
      <i class="fa fa-search" aria-hidden="true"></i><input type="submit" value="검색"  class="btn-default" >
      </div>
    </div>



<!-- <div class="submit_box" style="width:300px; margin:0 auto; padding-top:25px; overflow:hidden;">
  <input type="reset" value="초기화" style="background:transparent; border:1px solid #aaa; color:#fff; padding:15px; width:150px; font-size:16px; text-align:center; float:left; border-right:0;">
</div> -->
<input type="submit" value="검색" style="background:transparent; border:1px solid #aaa; color:#fff; padding:15px; width:150px; font-size:16px; text-align:center; float:left; display:none;">
  </form>
  </div>
  </div>


</div>


<div class="col-lg-12 main-list-wrap" >

  <div class="page_href">HOME >
    <? if ($wr_writer_id == $member[mb_id] && !$wr_important == 1){ ?>
    <span><strong>My Note</strong></span>
    <?}else if ($wr_important == '1') {?>
    <span><strong>Office Note</strong></span>
    <?} ?>

  </div>

          <div class="content_header">
            <?if ($wr_writer_id == $member[mb_id] && !$wr_important == 1) { ?>
                <?if ($gr_admin ){ ?>
                <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$member[mb_id]?>&board_list=<?=$member[mb_3]?>&wr_sale_type=1&wr_writer_id=<?=$member[mb_id]?>" class="btn btn-theme03 left rent" style="padding-left:12px;">
                임대
                </a> 

                <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$member[mb_id]?>&board_list=<?=$member[mb_3]?>&wr_sale_type=2&wr_writer_id=<?=$member[mb_id]?>" class="btn btn-theme03 left sale" style="padding-left:12px;">
                매매
                </a>
                <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$member[mb_id]?>&board_list=<?=$member[mb_3]?>&wr_important=<?=$wr_important?>&wr_sold_out=1&wr_writer_id=<?=$member[mb_id]?>" class="btn btn-theme03 left permission_no" style="padding-left:12px;">
                거래종료
               </a>
                

                <?}else if(!$gr_admin){ ?>
                <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$member[mb_id]?>&board_list=<?=$member[mb_3]?>&wr_sale_type=1&wr_writer_id=<?=$member[mb_id]?>" class="btn btn-theme03 left rent" style="padding-left:12px;">
                임대
                </a>

                <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$member[mb_id]?>&board_list=<?=$member[mb_3]?>&wr_sale_type=2&wr_writer_id=<?=$member[mb_id]?>" class="btn btn-theme03 left sale" style="padding-left:12px;">
                매매
                </a>
                <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$member[mb_id]?>&board_list=<?=$member[mb_3]?>&wr_writer_id=<?=$member[mb_id]?>&wr_sold_out=1" class="btn btn-theme03 left permission_no" style="padding-left:12px;">
                거래종료
               </a>

                  <!-- 오피스노트 일 경우 -->
                <?}}else if($wr_important == 1 ){?>
                <?if ($gr_admin ){ ?>
                <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$member[mb_id]?>&board_list=<?=$member[mb_3]?>&wr_important=1&wr_sale_type=1&wr_office_permission=<?$wr_office_permission?>" class="btn btn-theme03 left rent" style="padding-left:12px;">
                임대
                </a> 

                <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$member[mb_id]?>&board_list=<?=$member[mb_3]?>&wr_important=1&wr_sale_type=2&wr_office_permission=<?$wr_office_permission?>" class="btn btn-theme03 left sale" style="padding-left:12px;">
                매매
                </a>
                <?}else if(!$gr_admin){ ?>
                <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$gr_cp?>&board_list=<?=$member[mb_3]?>&wr_sale_type=1&wr_important=1&wr_office_permission=2" class="btn btn-theme03 left rent" style="padding-left:12px;">
                임대
                </a>
         
                <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$gr_cp?>&board_list=<?=$member[mb_3]?>&wr_sale_type=2&wr_important=1&wr_office_permission=2" class="btn btn-theme03 left sale" style="padding-left:12px;">
                매매
                </a>
                <?} }?>

                <!-- 오피스노트 일 때 -->
            <?if ($wr_important == 1){ ?>
            <?if ($gr_admin){ ?>
    
            <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$member[mb_id]?>&board_list=<?$member[mb_3]?>&wr_important=1&wr_office_permission=1" class="btn btn-theme03 left permission_no" style="padding-left:12px;">
             미승인매물
            </a>
            <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$member[mb_id]?>&board_list=<?=$member[mb_3]?>&wr_important=<?=$wr_important?>&wr_sold_out=1" class="btn btn-theme03 left permission_no" style="padding-left:12px;">
             거래종료
            </a>
            
            
            <?}else{ ?>
      
              <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$gr_cp?>&board_list=<?$member[mb_3]?>&wr_important=1&wr_office_permission=1&wr_writer_id=<?=$member[mb_id]?>" class="btn btn-theme03 left permission_no" style="padding-left:12px;">
             미승인매물
              <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$gr_cp?>&board_list=<?=$member[mb_3]?>&wr_important=<?=$wr_important?>&wr_sold_out=1" class="btn btn-theme03 left permission_no" style="padding-left:12px;">
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
            <?}else if(!$gr_admin && $bo_table == $gr_cp) {?>
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
            <a href="<?echo G5_BBS_URL?>/write.php?bo_table=<?=$bo_table?>&board_list=<?=$board_list?>" class="btn btn-theme03 right sg_cate_list active" style="background:#3b4db7; color:#fff;">
          <i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:18px; "></i>
           매물등록하기
          </a> 
          <?}else{} ?>
          
          
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
                          <input type="hidden" name="wr_sale_type" value="<?=$wr_sale_type ?>">
                          <input type="hidden" name="wr_writer_id" value="<?=$wr_writer_id ?>">
                          <input type="hidden" name="wr_sold_out" value="<?=$wr_sold_out ?>">
                          <input type="hidden" name="wr_important" value="<?=$wr_important ?>">
                          <input type="hidden" name="sw" value="">
                  <div class="board_list_box col-xs-12 col-md-12" id="list_style_list" style="padding:0;">
                    <div class="table">
                      <div class="thead">
                        <? $sale = $_GET['wr_sale_type'] ;?>
                        <div class="td">번호</div>
                        <div class="td">매물명</div>
                        <div class="td"><? if($sale == '1' || $sale == '3') echo '상권명'; else echo '지목'?></div>
                        <div class="td"><? if($sale == '1' || $sale == '3') echo '층수'; else echo '지역지구'?></div>
                        <div class="td"><? if($sale == '1' || $sale == '3') echo '평수'; else echo '총면적'?></div>
                        <div class="td"><? if($sale == '1' || $sale == '3') echo '보증금'; else echo '총매도가'?></div>
                        <div class="td"><? if($sale == '1' || $sale == '3') echo '월세'; else echo '평당가격'?></div>
                        <div class="td"><? if($sale == '1' || $sale == '3') echo '권리금'; else echo '대출'?></div>
                        <? if ($sale == '2'){ ?>

                        <? if($_GET[wr_important] == 1){ ?>
                          <div class="td">담당자</div>
                        <?} ?>

                      <div class="td">실인수가</div> 
                      <div class="td">수익률</div> 
                      <div class="td">주소</div> 
                      <?}?>

                        <div class="td"><? if($sale == '1') echo '합계';  else echo '등록일'?></div>

                        <? if($sale == '1'  || $sale == '3'){?><div class="td">주소</div><?}?>

                        <? if ($sale == '1' || $sale == '3'){ ?>
                        <? if( $_GET[wr_important] == 1 ){ ?>
                          <div class="td">담당자</div>
                        <?} }?>

                        
                        <? if($sale == '1' && !$wr_sold_out=='1'){?>
                        <div class="td">등록일</div>
                        <?}elseif($wr_sold_out=='1'){?>
                          <div class="td">거래종료일</div>
                        <?}?>
                      </div>
                      <div class="tbody">
                              <?php
                              for ($i=0; $i<count($list); $i++) {
                               ?>

                       <div class="td_chk " style="display:none; ">
                         <input type="checkbox" name="chk_wr_id[]" class="import_chk" style="display:none;" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" >
                         <label for="chk_wr_id_<?php echo $i ?>"> 
                         <p>
                         <i class="fa fa-check"></i>
                         <i class="fa fa-times" aria-hidden="true" style="display:none; "> <span style="font-size:16px;"> 해당매물은 승인된 매물이므로 거래종료 등록만 가능합니다.</span></i>
                         </p>
                         </label>
                       </div>


                        <div class="tr" id="list_link"onClick=location.href="<?php echo $list[$i]['href'] ?>" style="position:relative">
                          <? if ($list[$i]['wr_office_permission'] == '1'){ ?>
                            <div class="td" style=" position:relative;">
                              <?= $list[$i]['num']?>
                              <p class="permission_disable"style="font-size:14px; background:#ffc107">
                              <i class="fa fa-clock-o" aria-hidden="true"></i>
                              </p>
                            </div>
                          <? }else if($list[$i]['wr_office_permission']=='2' && !$wr_important ){ ?> 
                            <div class="td" style=" position:relative;">
                            <?= $list[$i]['num']?>
                            <p class="permission_disable"style="font-size:13px; ">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                            </p>
                          </div>
                            <?}else{?>
                              <div class="td">
                              <?= $list[$i]['num']?>
                            </div>

                            <?}?>

                        <div class="td subject" style="font-weight:600; background:#edf1f4; ">
                          <?php echo $list[$i]['subject']; ?>
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
                          <?php  if($sale == '1' || $sale == '3') {?>
                          <span class="commaN">
                           <?=$list[$i]['wr_premium_o']?>
                          </span>
                        <? }else{ ?> 
                        <span class="commaN">
                           <?=$list[$i]['wr_loan']?>
                          </span>
                        <?}?>
                        </div>


                        <? if ($sale == '2'){ ?>
                        <? if( $_GET[wr_important] == 1 ){ ?>
                          <div class="td">
                            <?php echo $list[$i]['wr_writer'] ?>
                          </div>
                        <?}?>

                          <div class="td">
                          <span class="commaN">
                            <?php echo $list[$i]['wr_silinsu'] ?>
                          </span>
                          </div>

                          <div class="td">
                          <span class="commaN">
                            <?php echo $list[$i]['wr_profit_rate'] ?>
                          </span>
                          </div>

                          <div class="td">
                            <?php echo $list[$i]['wr_address'] ?>
                          </div>
                          <?}?><!-- 매매일경우 -->
                          
                        <div class="td sum" style="background:#edf1f4">
                          <?php  if($sale == '1' || $sale == '3') {?>
                          <span class="commaN" style="font-weight:600; ">
                           <? echo $list[$i]['wr_premium_o'] + $list[$i]['wr_rent_deposit']; ?>
                           </span>
                          <?}else{?>
                          <?=$list[$i]['datetime']?>
                             <?}?>
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
                        <? if($sale == '1' && !$wr_sold_out=='1') {?>
                        <div class="td">
                          <?php echo $list[$i]['datetime'] ?>
                        </div>
                        <?}elseif($wr_sold_out=='1'){?>
                        <div class="td">
                        <?php echo date("Y-m-d", strtotime($list[$i]['wr_sold_out_date'])); ?>

                         </div>
                        <?}?>
                      </div>

                  <?php } ?><!-- 리스트 출력 끝 -->
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

                          <textarea name="confirm_unaccept2" class="etc"   tabindex="15"  style="display:none; width:100%; height:50px; margin-top:5px; text-align:left; border:1px solid #202b6e;  background:#3b4db7; color:#fff; padding:15px;" onKeyup="var a=100; var b=this.scrollHeight;if(b>=a)this.style.pixelHeight=b+6"rows="1" cols="130"></textarea>
                    </div>
                    <!-- Footer -->
                    <div class="modal-footer" style="padding:15px;">
                      <button type="button" class="btn btn-default s2" data-dismiss="modal">승인거절</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                    </div>
                  </div>
                </div>
              </div>



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
                    <!-- Footer -->
                    <!-- <div class="modal-footer" style="padding:15px;">
                      <button type="button" class="btn btn-default s2" data-dismiss="modal">승인거절</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                    </div> -->
                  </div>
                </div>
              </div>






            <div class="chk_confirm_wrap">
              <? if ($wr_sold_out == '1'){ ?>
                <span class="s1">사무실매물등록하기</span>
                <span class="s6">마이노트로등록하기</span>
                <span class="s8" data-target="#bookmark" data-toggle="modal">즐겨찾기등록하기</span>
                <span class="s7">삭제</span>
              <?} else if (!$gr_admin && $bo_table == $gr_cp) { ?>
                <span class="s8" data-target="#bookmark" data-toggle="modal">즐겨찾기등록하기</span>
              <?}else{?>
              <?if (!$gr_cp && !$gr_admin) {}else{?>
                <?if ($wr_important == '1'){}else{ ?>
              <span class="s1">사무실매물등록하기</span>
              <span class="s8" data-target="#bookmark" data-toggle="modal">즐겨찾기등록하기</span>
              <?}}?>
              <? if ($gr_admin && $wr_important == 1){?>
              <?if (!$gr_cp && !$gr_admin) {}else{?>
              <span class="s4" style="display:none;">사무실매물로수락</span>
              <?}?>
              <?if (!$gr_cp && !$gr_admin) {}else{?>
              <span data-target="#layerpop" data-toggle="modal" style="display:none;" class="s5">거절하기</span>
              <span class="s8" data-target="#bookmark" data-toggle="modal">즐겨찾기등록하기</span>
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
<script src="<?=G5_URL?>/assets/js/jquery.nicelabel.js"></script>            
<script src="<?php G5_PATH?>/assets/js/classie.js"></script>
<script src="<?php G5_PATH?>/assets/js/demo3.js"></script>
<script src="<?php G5_PATH?>/assets/js/toastr.min.js"></script>
<script type="application/javascript">
$(".tr:even").css("background", "white");
// $(function() { $("input:text").keydown(function(evt) { if (evt.keyCode == 13) return false; }); });
  

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


$(".select").change(function(){
  var select_option = $(".select option:selected").text();
  if(select_option == "기타사유입력" ){
    $(".etc").slideDown(250);
  }else{
    $(".etc").slideUp(250);
  }
})

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
$('.td_chk label').css("height", $(this).parents(".td_chk").siblings(".tr"))



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
    $("#fboardlist").submit();
});
  $(".s2").click(function(){
      $("#fboardlist").attr("action", "./office_delete.php");
      $("#fboardlist").submit();
  });
  $(".s3").click(function(){
    $("#fboardlist").attr("action", "./sale_success.php");
    $("#fboardlist").submit();
  });
  $(".s4").click(function(){
    $("#fboardlist").attr("action", "./office_update.php");
    $("#fboardlist").submit();
  });
  $(".s6").click(function(){
    $("#fboardlist").attr("action", "./sale_recovery.php");
    $("#fboardlist").submit();
  });
  // $(".s8").click(function(){
  //   $("#fboardlist").attr("action", "./insertBookmark.php");
  //   $("#fboardlist").submit();
  // });
  $(".s7").click(function(){
    $.confirm({
      theme: 'supervan',
      icon : 'fa fa-exclamation-triangle',
      title: '삭제확인여부!',
      content: '정말로 삭제 하시겠습니까?<br>삭제된 자료는 복구가 불가능 합니다.',
      buttons: {
          삭제: function (helloButton) {
            $("#fboardlist").attr("action", "./delete_all.php");
            $("#fboardlist").submit();
          },
          취소: function () {
            
          }
      }
  });
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

    //버튼 active 활성화 클래스 추가
    if (<?=$wr_sale_type?> == "1"){
    $(".rent").addClass("active");
    }else if(<?=$wr_sale_type?> == "2"){
    $(".sale").addClass("active");
    }
    
    if(wr_office_permission == "1" ){
    $(".permission_no").addClass("active");
    }else if(wr_office_permission == "2"){
    $(".permission_yes").addClass("active");
    }
    var config = $(".config");
    $(config).click(function(){
    $(".td_chk,.td_chk2").fadeToggle(300,"swing");
    $(".chk_confirm_wrap").fadeToggle(300,"swing");
    if( $(".chk_confirm_wrap").css("display") == "block"){
      $(".chk_confirm_wrap").css('display', 'none');
    }
    if($(".import_chk").is(":checked")){
      $(".chk_confirm_wrap").css('display', 'block');
    }
    });


    // tr체크시 미승인 매물일 경우에만 수락하기, 거절하기 버튼 띄우기
    $(".td_chk input[type=checkbox]").change(function(){
      var ddd = $(".td_chk input[type=checkbox]:checked + label").parents(".td_chk ").next(".tr").find("p");
      var check_target = $(this).next().parents(".td_chk ").next(".tr").find("p");
      var check_wrong = $(this).next().find(".fa-times") ;
      var check_text = $.trim($(this).parent('.td_chk').next('.tr').find('.subject').html());
      var chech_count = $(".td_chk input[type=checkbox]:checked").length;
      
      // 북마크 추가시 체크된 매물 리스트만 가져오기 
      if ($(this).is(":checked")){
      $(".check_list ul").append("<li id='add_list'>"+check_text+"</li>");
      }else{
        var  overlap_checklist = $("#add_list").text(check_text) ;
        $("#add_list").val(overlap_checklist).remove();
      }


     


      if(check_target.length == 1){
        console.log(ddd.length)
      if($(ddd).length >0){
          $(".s4").show();
          $(".s5").show();
          
      }else if ($(ddd).length==0){
        $(".s4").hide();
        $(".s5").hide();
      }
      }else if(check_target.length == 0 && gr_admin){
        console.log(check_target.length)
        $(".s4").hide();
        $(".s5").hide();
        $(check_wrong).show();
        $($(this).next().find(".fa-check")).hide();
        if($(ddd).length >0){
          $(".s4").show();
          $(".s5").show();
        }else if ($(ddd).length==0){
          $(".s4").hide();
         $(".s5").hide();
      }
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

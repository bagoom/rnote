<?php
// if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
include_once("$board_skin_path/lib/skin.lib.php");
?>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.7.0/fullcalendar.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.7.0/fullcalendar.print.css">


<style>
.black-bg{
  background: transparent !important;
}
  .modal-content{
    margin-top: 120px !important;
  }
.modal-body{
  padding-left:  40px;
  padding-right:  40px;
}
.modal-body input{
  width:100%;
  height:50px;
  margin-bottom:5px;
  text-align:center;
  font-size:18px;
  border:0;
  border-bottom: 1px solid #ddd;
}

.modal-body textarea{
  width:100%;
  min-height:50px;
  max-height: 150px;
  margin-bottom:0px;
  text-align:left;
  padding: 10px;
  font-size:18px;
  border:0;
  border-bottom: 1px solid #ddd;
  line-height: 30px;
}
.modal-body textarea::-webkit-scrollbar { width: 0 !important }
.modal-body textarea { -ms-overflow-style: none; }
.modal-body textarea { overflow: -moz-scrollbars-none; }
.modal-body p{
  margin-top:25px;
  margin-bottom:0;
  color:#888;
  font-size:13px;
  font-weight:bold;
}
.wrapper{
  padding: 0;
  margin-bottom:25px;
  transition: 1s all;
}
.main-list-wrap{
  width: 88%;
  min-width: 1180px;
  margin: 0 auto;
  padding:0;
  margin-top:280px;
  z-index: 15;
  box-shadow: 0 0 50px rgba(0,0,0,0.2);
  /* border-radius: 3px; */
  background:#f9f9f9;
  float: none;
}
.board_search{
    height:500px;
    background:#273eb6;
}
.title_wrap{
    width: 900px;
    margin:0 auto;
    margin-top:50px;
    color:#fff;
    font-size:30px;
    font-weight: bold;
}
.title_wrap p{
    margin-top:5px;
    font-size: 16px;
    font-weight: lighter;
    line-height: 22px;
}
.contact_wrap{
  width:100%;
  overflow: hidden;
}
.contact_list{
  width: 100%;
  margin: 0;
  background:#fff;
  border: 0.5px solid #e1e1e1;
  border-width: 0.5px 0;
  border-bottom :0;
  transition: 0.2s all;
  cursor: pointer;
  /* margin-bottom: 15px;  */
}
.contact_list:last-child{
  margin-bottom: 0;
}
.contact_list:hover{
  background : rgba(0,0,0,0.02);
  box-sizing : content-box;
}
.contact_list_head{
  position: relative;
  padding: 10px;
  padding-bottom: 0;
  background:#d0d7e8;
  border-bottom: 1px solid #b5bed4;
}
.contact_list_head p{
  padding-top: 5px;
  color: #7f8dab;
  font-size: 15px;
  font-weight: bold; 
  letter-spacing:.5px;
}
.contact_list_head .rc_bookmark{
  position: absolute;
  top:12px;
  right: 11px;
  color:#fff;
  font-size: 18px;
}
.contact_list_profile{
  width: 100px;
  margin:0 auto;
  padding-top: 15px;
}
.contact_list_profile img{
  width: 100%;
}
.contact_list_body{
  text-align: center;
  height: 110px;
  letter-spacing: -0.03em;
}
.contact_list .rc_star{
  width: 10%;
  line-height:110px;
  font-size: 25px;
  float: left;
  color: #aaa;
}
.contact_list .rc_date{
  width: 11%;
  line-height:110px;
  font-size: 14px;
  float: left;
  color: #aaa;
  text-align: left;
}
.contact_list .list_subject{
  width: 25%;
  padding-top: 35px;
  padding-left: 20px;
  font-size: 20px;
  text-align: left;
  float: left;
  color: #222;
  font-weight: bolder;
}
.contact_list .list_subject p{
  color: #666;
  font-size: 15px;
  font-weight: normal;
  margin-top: 5px;
}
.contact_list .list_name{
  width: 17%; 
  height: 110px;
  padding-top: 33px;
  float: left;
  font-size: 16px;
  color: #222;
  text-align: left;
  line-height: 23px;
  letter-spacing: 0.02em;
}
.contact_list .list_name .rc_hp{
  font-weight: bold;
  margin-top:5px;
}
.contact_list .rc_content{
  width: 50%;
  height: 110px;
  padding-top: 48px;
  padding-left: 20px;
  float:left;
  font-size: 16px;
  color: #666;
  text-align: left;  
}
.contact_list .rc_content p {
  text-overflow: ellipsis;
  overflow: hidden;
  white-space:nowrap;
  padding-right: 30px;
}
.contact_list .rc_confirm{
  width: 10%;
  margin:0;
  padding-top: 50px;
  font-size: 16px;
  font-weight: normal;
  white-space: nowrap;
  overflow:hidden;
  color: #666;
  float:left;
  text-align: center;  
  letter-spacing: -0.06em;
}
.contact_list .rc_confirm:hover{
  color: #000;
}
.contact_list .list_date{
  width: 14%;
  padding-top:50px;
  font-size: 16px;
  color:#666;
  float:left;
  text-align: center;
}
.contact_list_body h5{
  font-size: 16px;
  font-weight: bold;
}
.contact_list_footer{
  padding: 20px 0 ;
  overflow:hidden;
  border-top: .5px solid #e9e9e9;
  background: #fcfcfc;
  border-radius: 0 0 5px 5px;
}
.contact_list_footer span{
  width:50%; 
  float:left;
  text-align:center;
  color: #777;
  font-size: 12px;
  cursor: pointer;
}
.contact_list_footer .con_btn01{
  border-right: .5px solid #e2e2e2;
}
.contact_list_footer .con_btn02{
}
.contact_left_header{
  float: left;
  width: 100%;
  height: 250px;
  background:#fff;
}
.list_head_tab_wrap{
  width: 100%;
  overflow: hidden;
  
}
.list_head_tab{
  width: 25%;
  padding: 20px;
  float: left;
  font-size: 14px;
  color: #818181;
  font-weight: 300;
  text-align: center;
  background:#f9f9f9;
  cursor: pointer;
  border-bottom: 0.5px solid #d1d1d1;
}
.list_head_tab.active{
background:#ffbe00;
  color: #111;
  border-bottom: 0.5px solid #e6ac05;
}
.paging_wrap{
  position: relative;
  width: 100%;
  overflow: hidden;
  background: #fff;
  border-top: 0.5px solid #ddd;
}
.paging_wrap .page_list{
  width: 275px;
  margin : 0 auto;
}
.paging_wrap .page_list.active a{
  width: 55px;
  height: 55px; 
  line-height: 55px;
  text-align: center;
  background : #273eb6;
  border-color: #273eb6;
  color: #fff;
}
.paging_wrap .page_list a{
  width: 55px;
  height: 55px;
  line-height: 55px; 
  text-align: center;
  font-size: 10px;
  font-weight: bold;
  float: left;
  background : #fff;
  color: #222;
  border: 0.5px solid #ddd;
  border-width: 0 0.5px 0 0;
}
 .page_list:nth-child(2) a{
  border-left: 0.5px solid #ddd;
}
.paging_wrap .prev_page{
  position: absolute;
  top:0;
  left:0;
  width: 55px;
  height: 55px;
  line-height: 55px;
  font-size: 13px;
  text-align: center;
  border-right: 0.5px solid #ddd;
}
.paging_wrap .next_page{
  position: absolute;
  top:0;
  right: 0;
  width: 55px;
  height: 55px;
  line-height: 55px;
  font-size: 13px;
  text-align: center;
  border-left: 0.5px solid #ddd;
}
.next_page a,.prev_page a{
  display: block;
}
.modal-backdrop{
  display:none;
}
</style>


<div class="search_wrap " style="text-align:center;">


<div class="board_search" >

    <div class="title_wrap">
        고객관리
        <p>고객내용을 기록하여 고객의 현상태와<br>  업무진행 상황을 한눈에 파악할 수 있습니다.</p>
    </div>
    <div class="contact_add_btn" data-backdrop="static" data-target="#insert_modal" data-toggle="modal">
    <h3  >연락처추가</h3>
    </div>   
  </div>
  </div>


<?php
$sql = " select * from `rnote_contact_test10` order by rc_bookmark desc ";
$result = sql_query($sql);
?>




<div class="col-lg-12 main-list-wrap" >
     

  <div class="contact_wrap">
  
  </div>

</div>




<script>
$('.main-list-wrap').css("min-height", $(window).height()-85);
        // 고객관리 ajax요청
        var contact_url = "<?echo G5_BBS_URL?>/list_test.php?page=<?=$page?>";
        $(document).ready(function(){
          // $('.contact_wrap').fadeToggle(100);
        $.ajax({
        type : "POST",
        url : contact_url,
        dataType : "text",
        error : function() {
            alert('통신실패!!');
        },
        success : function(data) {
            $('.contact_wrap').html(data);
        }
        });
        })

        $('.main-list-wrap').css("min-height", $(window).height()-85);


// 고객관리 ajax요청
var contact_url = "<?echo G5_BBS_URL?>/contact.php";
$(document).ready(function(){
  // $('.contact_wrap').fadeToggle(100);
$.ajax({
type : "POST",
url : contact_url,
dataType : "text",
error : function() {
    alert('통신실패!!');
},
success : function(data) {
    $('.main-list-wrap').html(data);
}
});
})

</script>
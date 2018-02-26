<?php
// if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
include_once("$board_skin_path/lib/skin.lib.php");
?>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.7.0/fullcalendar.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.7.0/fullcalendar.print.css">


<style>
  .modal-content{
    margin-top: 150px !important;
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
}
.main-list-wrap{
  margin-top:300px;
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
.contact_wrap{
  width:1200px;
  margin: 30px auto;
  overflow: hidden;
}
.contact_list{
  width: 23%;
  margin: 15px 10px;
  background:#fff;
  float:left;
  box-shadow: 0 0 15px  rgba(110, 117, 123,0.1);
  border-radius: 5px;
}
.contact_list_head{
  position: relative;
  padding: 10px;
  padding-bottom: 0;
  background:#d0d7e8;
  border-bottom: 1px solid #b5bed4;
  border-radius:5px 5px 0 0;
  
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
  padding: 10px;
  text-align: center;
}
.contact_list_body h5{
  font-size: 16px;
  font-weight: bold;
}
.contact_list_body p{
  font-size: 15px;
}
.contact_list_body .rc_content{
  font-size: 12px;
  color: #888;
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
</style>


<div class="search_wrap " style="text-align:center;">


<div class="board_search" >

    <div class="title_wrap">
        <i class="fa fa-address-book" aria-hidden="true" style="font-size:55px; padding: 20px;"></i>
        <br>
        RNote 고객관리
        <p>고객내용을 기록하여 고객의 현상태와<br>  업무진행 상황을 한눈에 파악할 수 있습니다.</p>
    </div>


    <div class="contact_add_btn" data-backdrop="static" data-target="#layerpop" data-toggle="modal">
    <h3  >연락처추가</h3>
    </div>        

  </div>
  </div>


<?php
$sql = " select * from `rnote_contact_test10` order by rc_bookmark desc ";
$result = sql_query($sql);
?>




<div class="col-lg-12 main-list-wrap" >



</div>




<script src="<?php G5_PATH?>/assets/js/moment.min.js"></script>
<script src="<?php G5_PATH?>/assets/js/fullcalendar.min.js"></script>
<script>

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
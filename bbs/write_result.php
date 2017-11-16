<?php
include_once('./_common.php');
if (G5_IS_MOBILE){
include_once(G5_THEME_MOBILE_PATH.'/head.php');
}
else
include_once(G5_PATH.'/head.sub.php');
?>
<link rel="stylesheet" href="<?php G5_PATH?>/assets/css/style2.css">
<script src="<?php G5_PATH?>/assets/js/modernizr.custom.js"></script>
<script src="<?php G5_PATH?>/assets/js/jquery-labelauty.js"></script>
<link rel="stylesheet" type="text/css" href="<?php G5_PATH?>/assets/css/jquery-labelauty.css">
<link rel="stylesheet" href="<?php G5_PATH?>/assets/css/bootstrap-range.min.css">





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
.write_result_form{
  margin-top:50px;
  padding: 150px;
  text-align: center;
}
.write_result_form p{
  font-size: 30px;
}
.write_result_form span{
  width: 190px;
  display: block;
  float: left;
  padding: 20px;
  margin-left: 5px;
  background:#3b4db7;
  font-size: 16px;
  color: #fff;
}
.btn_wrap{
  width: 650px;
  margin: 30px auto;
}
.check_list_wrap{
  top:15px ;
}
</style>


<div class="search_wrap " style="text-align:center;">




</div>




<div class="write_result_form">


<p>매물등록이 완료 되었습니다.</p>
<div class="btn_wrap">

<a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$bo_table?>&wr_sale_type=1&board_list=<?=$board_list?>&wr_important=<?=$write['wr_important']?>&wr_id=<?=$write['wr_id']?>">
<span class="">등록한매물확인하기</span>
</a>
<? if($gr_admin){ ?>
  <a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$bo_table?>&wr_sale_type=1&board_list=<?=$board_list?>&wr_important=<?=$write['wr_important']?>&wr_office_permission=<?$write['wr_office_permission']?>&wr_writer=<?=$member[mb_name]?>">
  <span class="">매물리스트로가기</span>
  </a>
  <?}else{?>
<a href="<?echo G5_BBS_URL?>/board.php?bo_table=<?=$bo_table?>&wr_sale_type=1&board_list=<?=$board_list?>&wr_important=<?=$write['wr_important']?>&wr_office_permission=<?$write['wr_office_permission']?>">
<span class="">매물리스트로가기</span>
</a>
<?}?>
<a href="#" class="sg_cate_list"  data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">
<span class="sg_cate_03">계속등록하기</span>
</a>
</div> <!-- btn_wrap -->
</div> <!-- write_result_form -->


  <input type="hidden" id="bo_table" value="<?php echo $bo_table?>" ?>






  <!-- js placed at the end of the document so the pages load faster -->
  <script src="<?php G5_PATH?>/assets/js/classie.js"></script>
  <script src="<?php G5_PATH?>/assets/js/demo3.js"></script>
  <script type="application/javascript">
  var bourl1 = "<?echo G5_BBS_URL?>/write_modal.php?bo_table="+$("#bo_table").val()+"&board_list=1";
  var bourl2 = "<?echo G5_BBS_URL?>/write_modal.php?bo_table="+$("#bo_table").val()+"&board_list=2";
  var bourl3 = "<?echo G5_BBS_URL?>/write_modal.php?bo_table="+$("#bo_table").val()+"&board_list=3";
  var bourl4 = "<?echo G5_BBS_URL?>/write_modal.php?bo_table="+$("#bo_table").val()+"&board_list=4";

  $(".sg_cate_01").click(function(){
    $.ajax({
    type : "POST",
    url : bourl1,
    dataType : "text",
    error : function() {
        alert('통신실패!!');
    },
    success : function(data) {
        $('#Context').html(data);
    }
    $(".sg_cate_02").click(function(){
      $.ajax({
      type : "POST",
      url : bourl2,
      dataType : "text",
      error : function() {
          alert('통신실패!!');
      },
      success : function(data) {
          $('#Context').html(data);
      }
   });
     })

     $(".sg_cate_03").click(function(){
       $.ajax({
       type : "POST",
       url : bourl3,
       dataType : "text",
       error : function() {
           alert('통신실패!!');
       },
       success : function(data) {
           $('#Context').html(data);
       }
   });
      })

      $(".sg_cate_04").click(function(){
        $.ajax({
        type : "POST",
        url : bourl4,
        dataType : "text",
        error : function() {
            alert('통신실패!!');
        },
        success : function(data) {
            $('#Context').html(data);
        }
    });
       })


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
  $(document).ready(function(){
    console.log($(".commaN"));
    for (var i =0 ; i <= $(".commaN").length;  i ++){
      $(".commaN").eq(i).text(numberWithCommas(parseInt($(".commaN").eq(i).html())));
    }
  });

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

      if(<?=$write_count?> >= "<?=$gr_write_permission?>"){
      $("#fboardlist").submit();
      }else{
        alert("사무실 매물 등록 권한이 없습니다.");
      }

    }
    else if ("<?=$gr_cp?>"){

      if(<?=$write_count?> >= "<?=$join_gr_info['gr_write_permission']?>"){
      $("#fboardlist").submit();
      }else{
        alert("사무실 매물 등록 권한이 없습니다.");
      }

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

  //  리스트 형태가 테이블형일때 2번째 tr의 배경 색상변경
      $( document ).ready(function() {
      $(".tr:even").css("background", "white");
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
       $('input.wr_subject').bootstrapRange({
              minimumCallback: function (min) {
              $($('input[aria-describedby]').siblings('input[type=hidden]')[0]).val(min);
              },
              maximumCallback: function (max) {
                $($('input[aria-describedby]').siblings('input[type=hidden]')[1]).val(max);

              }
          });
       $('input.age').bootstrapRange({
              minValues: [1,2],
              maxValues: [3,4,5,25,30,40],
              minimumCallback: function (min) {
              $($('input[aria-describedby]').siblings('input[type=hidden]')[0]).val(min);
              },
              maximumCallback: function (max) {
                $($('input[aria-describedby]').siblings('input[type=hidden]')[1]).val(max);

              }
          });
          $('.deposit').bootstrapRange({
                 minValues: [50,100,150,200,1000],
                 maxValues: [250,300,500,1000,1300,1500],
                 addtext: '만원',
                 minimumCallback: function (min) {
                 $($('input[aria-describedby]').siblings('input[type=hidden]')[0]).val(min);
                 },
                 maximumCallback: function (max) {
                   $($('input[aria-describedby]').siblings('input[type=hidden]')[1]).val(max);
                 }
             });

          $('.area').bootstrapRange({
                 minValues: [5,6,7,20],
                 maxValues: [10,15,35,40,30,40],
                 addtext: '평',

                 minimumCallback: function (min) {
                 $($('input[aria-describedby]').siblings('input[type=hidden]')[0]).val(min);
                 },
                 maximumCallback: function (max) {
                   $($('input[aria-describedby]').siblings('input[type=hidden]')[1]).val(max);
                 }
             });
  </script>





<?php
if (G5_IS_MOBILE){
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
}
else
include_once(G5_PATH.'/tail.sub.php');
?>

<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<?php if ($is_admin == 'super') {  ?><!-- <div style='float:left; text-align:center;'>RUN TIME : <?php echo get_microtime()-$begin_time; ?><br></div> --><?php }  ?>

<!-- ie6,7에서 사이드뷰가 게시판 목록에서 아래 사이드뷰에 가려지는 현상 수정 -->
<!--[if lte IE 7]>
<script>
$(function() {
    var $sv_use = $(".sv_use");
    var count = $sv_use.length;

    $sv_use.each(function() {
        $(this).css("z-index", count);
        $(this).css("position", "relative");
        count = count - 1;
    });
});
</script>
<![endif]-->

</section>
</section>



        <footer class="site-footer">
        <div class="text-center">
        <ul>
        <li>RNote</li>
        <li>(주)리차드막스</li>
        <li>사업자등록번호 104-658-98336 l 통신판매업신고 2017-부산남구-00658</li>
        <li>Rnote ⓒ 2017 RichardMarks. All rights reserved</li>
        <li>이용약관 l <span style="color:#e65f5f;">개인정보취급방침</span></li>
        </ul>
        <a href="index.html#" class="go-top"><i class="fa fa-angle-up"></i></a>

        <div class="site-footer-right">
          <ul>
            <li>Contact Us</li>
            <li style="margin-top:0;">제휴 문의 : rnote@rms.co.kr</li>
          </ul>
        </div>
        </div>
        </footer>

<input type="hidden" id="bo_table" value="<?php echo $member[mb_id]?>" ?>
<!--footer end-->
</section>

<script >



// $('.wrapper').css("height", $(document).height() );



// $("#menubar-menus li").click(function(){
//     $("#menubar-menus li").removeClass("active");
//     $(this).addClass("active");
//     if($("#menubar-menus li").hasClass("active")){
//       $(".sub-menu",this).show(300);
//       $(this).addClass("active_open");
//     }
//     if($("#menubar-menus li").hasClass("active_open")){
//       $(".sub-menu").hide(300);
//     }
//
// });

    //
    $("#menubar-menus li:first").trigger('click');
    $("#menubar-menus li").on('click',function(e){
          // $(".sub-menu",this).toggle(200);
          if ( $(".sub-menu",this).css("display") == "none"){
            $(".sub-menu",this).slideDown(200);
            $(this).addClass("active");
          }else{
            $(".sub-menu",this).slideUp(200);
            $(this).removeClass("active");
          }



    });

    // $('#menubar-menus li').click(function(event){
    // event.stopPropagation();
    // });

    //
    // $("#menubar-menus li").on('click',function(e){
    //   $('.drop-down-open').hide();
    // 	myDropDown = $(this).find('.sub-menu');
    //
    // 	if( myDropDown.is(":visible")) {
    // 		$(myDropDown).removeClass('drop-down-open');
    //       myDropDown.hide();
    //       $("#menubar-menus li").removeClass("active");
    // 	} else {
    // 		myDropDown.fadeIn();
    //     $("#menubar-menus li").removeClass("active");
    //     $(this).addClass("active");
    //     $(myDropDown).addClass('drop-down-open');
    // 	}
    // 	return false;
    // });
    //
    // $('body').click(function(event) {
    // 	$('.drop-down-open').hide();
    //   $("#menubar-menus li").removeClass("active");
    //
    // });
    //   $('#menubar-menus li .sub-menu').click(function(event){
    // 	event.stopPropagation();
    // });



  $("#visual_wrap").css("height",$(document).height())
</script>

<script>
var bourl1 = "<?echo G5_BBS_URL?>/write_modal.php?bo_table="+$("#bo_table").val()+"&board_list=<?=$member[mb_3]?>";



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
  // , beforeSend: function () {
  //             var width = 0;
  //             var height = 0;
  //             var left = 0;
  //             var top = 0;
  //             width = 50;
  //             height = 50;
  //             top = ( $(window).height() - height ) / 2 + $(window).scrollTop();
  //             left = ( $(window).width() - width ) / 2 + $(window).scrollLeft();
  //             if($("#div_ajax_load_image").length != 0) {
  //                    $("#div_ajax_load_image").css({
  //                           "top": top+"px",
  //                           "left": left+"px"
  //                    });
  //                    $("#div_ajax_load_image").show();
  //             }
  //             else {
  //                    $('body').append('<div id="div_ajax_load_image" style="position:absolute; top:' + top + 'px; left:' + left + 'px; width:' + width + 'px; height:' + height + 'px; z-index:9999; background:#f0f0f0; filter:alpha(opacity=50); opacity:alpha*0.5; margin:auto; padding:0; "><img src="<? echo G5_URL?>/img/ajax_loader3.gif" style="width:50px; height:50px;"></div>');
  //             }
  //      }, complete: function () {
  //                    $("#div_ajax_load_image").hide();
  //      }
});
 })

//  $(".sg_cate_02").click(function(){
//    $.ajax({
//    type : "POST",
//    url : bourl2,
//    dataType : "text",
//    error : function() {
//        alert('통신실패!!');
//    },
//    success : function(data) {
//        $('#Context').html(data);
//    }
// });
//   })
//
//   $(".sg_cate_03").click(function(){
//     $.ajax({
//     type : "POST",
//     url : bourl3,
//     dataType : "text",
//     error : function() {
//         alert('통신실패!!');
//     },
//     success : function(data) {
//         $('#Context').html(data);
//     }
// });
//    })
//
//    $(".sg_cate_04").click(function(){
//      $.ajax({
//      type : "POST",
//      url : bourl4,
//      dataType : "text",
//      error : function() {
//          alert('통신실패!!');
//      },
//      success : function(data) {
//          $('#Context').html(data);
//      }
//  });
//     })
</script>
</body>

</html>
<?php echo html_end(); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다. ?>

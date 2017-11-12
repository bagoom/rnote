<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>


<?php
if(G5_DEVICE_BUTTON_DISPLAY && G5_IS_MOBILE) { ?>
<!-- <a href="<?php echo get_device_change_url(); ?>" id="device_change">PC 버전으로 보기</a> -->
<?php
}

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>





</div><! --/col-12 -->
</div><! --/row -->
</section>
</section>


        <?if ($board_list&& !$wr_id){ ?>
          <!--footer start-->
        <footer class="site-footer  text-center" data-role="footer" data-position="fixed" style="padding:0;">
         <div style="width100%; height:55px; background:#444; padding:0; line-height:59px; color:#fff; font-size:16px;"><div id="context"> </div><span class="tail_minus">-</span> <div class="next" >다음</div>
       </div>
       <div class="tr_btn">
       <i class="fa fa-trash-o trash_button" aria-hidden="true"></i>
       </div>
        </footer>
      <? }else if($w){ ?>
        <footer class="site-footer  text-center" data-role="footer" data-position="fixed" style="padding:0;">
         <div class="next" style="width100%; height:55px; background:#444; padding:0; line-height:59px; color:#fff; font-size:16px;"><div id="context"></div> 다음
       </div>
       <div class="tr_btn">
       <i class="fa fa-trash-o trash_button" aria-hidden="true"></i>
       </div>
        </footer>


      <?}else{ ?>
        <footer class="site-footer">
        <div class="text-center">
        ALL RIGHT SANGGANOTE RESERVER.
        <a href="index.html#" class="go-top"><i class="fa fa-angle-up"></i></a>
        </div>
        </footer>
        <?}?>



<script>
    var $curr;
    $('input').on('focus',function(){
      $curr = $(this);
      });

    var ntabindex;
    $('.next').on('click', function( e ){
    ntabindex  = parseInt($curr.attr('tabindex'));
    ntabindex++;

    var target = $('input[tabindex='+ntabindex+'],textarea[tabindex='+ntabindex+']').focus();
    if(ntabindex){
        var position = $(target).offset();
    $('html, body').animate({scrollTop : position.top-110}, 300);
    }
});

//  인풋필드에 포커싱 되면 부모태그의 텍스트를 하단 다음버튼 왼쪽에 뿌려주기
// 포커싱되면 form-group 보더 색상변경
$('#rent input,textarea' ).focus(function(){
        var text_taget = $(this).parent().siblings($('.col-xs-4,.col-xs-2'));
        var border_target = $(this).parents('div.form-group');
        $('#context').text($(text_taget[0]).text());
        border_target.addClass("border");
              $('input,textarea').blur(function(){
              border_target.removeClass("border");
              });
});
$('#sale input,textarea' ).focus(function(){
        var text_taget = $(this).parent().siblings($('.col-xs-4,.col-xs-2'));
        var border_target = $(this).parents('div.form-group');
        $('#context').text($(text_taget[0]).text());
        border_target.addClass("border");
              $('input,textarea').blur(function(){
              border_target.removeClass("border");
              });
});

$('.tr_btn').on('click', function( c ){
  ntabindex  = parseInt($curr.attr('tabindex'));
  var text_taget2 = $('input[tabindex='+ntabindex+']').focus();
        $(text_taget2).val('');
});

</script>



<!--footer end-->
</section>
</body>
</html>
<?php echo html_end(); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다. ?>

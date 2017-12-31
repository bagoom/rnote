<div class="bookmark_head">

<i class="fa fa-bookmark" aria-hidden="true" style="font-size:22px; margin-right: 10px;"></i> 
즐겨찾기 
<div class="add_folder_btn" data-target="#layerpop" data-toggle="modal">
<i class="fa fa-plus-circle" aria-hidden="true" style="margin-left:2px;"></i>
</div>
<div class="bookmark_config_btn">
<i class="fa fa-cog" aria-hidden="true"></i>
</div>
<div class="bookmark_delete_btn">
<i class="fa fa-trash-o" aria-hidden="true"></i>
</div>
</div>

<form action="" id="bookmark_form" method="post">


<? 
$con = mysqli_connect("localhost","realnote","!dnwls1127","realnote"); 
$sql = "select * from `bookmark_test10_folder` order by bmf_top desc , bmf_date desc";
$result = mysqli_query($con , $sql);
while ($folder = mysqli_fetch_array($result)) {?>

    <div class="map_board_list" >
      <!-- 체크버튼 -->
      <input type="checkbox" name="chk_wr_id[]" class="import_chk" style="display:none;" value="<?php echo $folder['bmf_id'] ?>" id="chk_wr_id_<?php echo $folder['bmf_id']?>" >
      <label for="chk_wr_id_<?php echo $folder['bmf_id'] ?>" class="list_check_label">
       <i class="fa fa-check" aria-hidden="true"></i>
      </label>

      <!-- 리스트아이템 -->
      <div class="registerated">
        <?if ($folder['bmf_top'] == '1'){?>
          <i class="fa fa-folder folder_icon" aria-hidden="true" style="float:left; font-size: 23px; color:#ffc107; padding-top:5px; margin-right:10px;"></i>
        <?}else{?>
          <i class="fa fa-folder folder_icon" aria-hidden="true" style="float:left; font-size: 23px; color:#3b4db7; padding-top:5px; margin-right:10px;"></i>
        <?}?>
        <span style="height:20px; line-height:32px;"><?=$folder['bmf_name']?></span>
      </div>

      <p class="dropdown_btn" >
        <!-- <p onclick="showMarkers()">마커 보이기</p> -->
           <i class="fa fa-pencil modify_folder" aria-hidden="false" style="margin-right:5px;"data-target="#modify_folder" data-toggle="modal" folder-name="<?=$folder['bmf_name']?>" folder-top="<?=$folder['bmf_top']?>" folder-id="<?=$folder['bmf_id']?>"></i>  
          <i class="fa fa-map-o map_toggle" aria-hidden="true" style="margin-right:10px;"></i>
          <!-- <i class="fa fa-chevron-down" aria-hidden="true"></i> -->
        </p> 
      </div>
    


    <?php
    $sql2 = "select * from `g5_write_test10` a, `bookmark_test10` b where a.wr_id = b.bm_match_id and b.bm_from = 1 UNION ALL select * from `g5_write_ekdna8284` a, `bookmark_test10` b where a.wr_id = b.bm_match_id and b.bm_from = 2 ";
    $result2 = mysqli_query($con , $sql2);
    ?>

    <div class="child_list_wrap">
   <? while ($child = mysqli_fetch_array($result2)) {?>
    <?if( $folder['bmf_id'] == $child['bm_bmf_id']){ ?>
    <div class="child_list">
          <p>
          <span class="find_txt"><?=$child['wr_subject']?></span>
          <span class="child_list_info">
            <?=$child['wr_premium_o']?>만 /
            <?=$child['wr_rent_deposit']?>만 /
            <?=$child['wr_m_rate']?>만 
            <?=$child['wr_floor']?>층  
            <?=$child['wr_area_p']?>평
          </span>
        </p>

 
    </div>
    <?}} ?>
    <? $sql3 = " select count(*) as cnt  from bookmark_test10 where bm_bmf_id = '$folder[bmf_id]' ";
        $result3 = mysqli_query($con , $sql3);
        $row3 = mysqli_fetch_array($result3);  
        $child_cnt = $row3['cnt'];
        if (0 == $child_cnt ){ ?>
        <div class="child_list">
         <p style="text-align:center; font-size: 13px; ">해당 폴더에 즐겨찾기 매물이 없습니다.</p>   
         </div>
        <?}?> 
</div>

<?}?>
  </form>


        
        <? $sql = " select count(*) as cnt  from bookmark_test10_folder ";
        $result4 = mysqli_query($con , $sql);
        $row4 = mysqli_fetch_array($result4);
        $folder_cnt = $row4['cnt'];

        if (0 == $folder_cnt ){ ?>
         <p style="text-align:center; font-size: 13px; margin-top:15px;">폴더 내역이 없습니다 폴더를 생성해 주세요.</p>   
        <?}?> 





<script>


$(".modify_folder").click(function(){
  $("#folder_name").val($(this).attr("folder-name"));
  $("#folder_top").val($(this).attr("folder-top"));
  $("#bmf_id").val($(this).attr("folder-id"));
  
  
  if ($("#folder_top").val() == "1"){
    $("#folder_top").prop('checked', true);
  }else{
    $("#folder_top").prop('checked', false);
  }
})



// 폴더 클릭시 자식 매물 보여주기 : if(폴더 설정중이 아닐떄만)
$(".map_board_list  .registerated").click(function(){

if($('.list_check_label').css("display") == "none"){
  $(this).parent('.map_board_list').next(".child_list_wrap").slideToggle(200);
  $(".folder_icon", this).toggleClass("fa-folder fa-folder-open");
}else{
   // display : none일 경우

}
})

// 맵로딩시 마커 초기값 숨김처리
$(document).ready(function(){
  initMarkers()
})
//  마커 토글 버튼 클릭시 폴더 아이디값 넘겨주기 
$(".map_toggle").click(function(){
  var toggle_id = $(this).parents('.map_board_list').find('.import_chk').val();
  $(this).toggleClass("fa-map-o fa-map");
  if($(this).hasClass("fa-map-o")){
    hideMarkers(toggle_id)
  }else{
    showMarkers(toggle_id)
  }
})




$(".child_list").each(function(index) {
$(this).on('click', function(){
var map_toggle_on = $(this).parent(".child_list_wrap").prev(".map_board_list").find(".dropdown_btn i").hasClass("fa-map");
if(map_toggle_on){
panTo($(this))
}
})
});






$(".bookmark_config_btn").click(function(){
    $(".list_check_label").fadeToggle(300,'swing');
    $(".bookmark_delete_btn").hide();
})

$(".import_chk").click(function(){
    var check_count = $(".import_chk:checked").length;
  if(check_count>0){
    $(".bookmark_delete_btn").show();
  }else{
    $(".bookmark_delete_btn").hide();
  }
})

$(".bookmark_delete_btn").click(function(){
    var con = confirm("정말로 삭제 하시겠습니까?");
    if (con == true){
    $("#bookmark_form").attr("action", "./bookmark_update.php");
    $("#bookmark_form").submit();
    }
  });
  //  폴더 삭제 ajax요청

// $(".bookmark_delete_btn").on('click',function () {
//   var con = confirm("정말로 삭제 하시겠습니까?");

//   if (con == true){
//   var formData = $('#bookmark_form').serializeArray();
//   $.ajax({
//   url: "../../../bbs/bookmark_update.php",
//   type: "POST", 
//   data: formData,
//   dataType: 'text',
//   success: function (Data, textStatus, jqXHR) {
// // 폴더 삭제후 리스트 리로드 요청 
// $.ajax({
// type : "POST",
// url : "../skin/board/basic/bookmark/bookmark_board_list.php",
// dataType : "text",
// error : function() {
// alert('통신실패!!');
// },
// success : function(data) {
// $('#map_board').html(data);
// }
// });

//   },
//   error: function (jqXHR, textStatus, errorThrown) {
//   alert(errorThrown);
//   }
//   })
// }
//   });

</script>

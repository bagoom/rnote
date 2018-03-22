<? include_once('../../../../common.php');?>
<div id="bm_wrap">
<div class="add_folder_btn" data-target="#layerpop" data-toggle="modal">
<i class="fa fa-plus-circle" aria-hidden="true" style="margin-left:2px;"></i>
</div>
<div class="bookmark_config_btn">
<i class="fa fa-cog" aria-hidden="true"></i>
</div>
<div class="bookmark_delete_btn">
<i class="fa fa-trash-o" aria-hidden="true"></i>
</div>

<div class="bookmark_head">
<i class="fa fa-bookmark" aria-hidden="true" style="font-size:22px; margin-right: 10px;"></i> 
즐겨찾기 
</div>

<div class="bookmark_state"> 
    <p>
      <span class="slect_child_count"></span>개의 매물이 선택 되었습니다.
    <span>
    <!-- <i class="fa fa-trash-o" aria-hidden="true" id="child_list_del"/></i> -->
    </span>
    </p>
</div>
<div class="bookmark_list_wrap">
<form action="" id="bookmark_form" method="post">
<div id="board_list_wrap">
<? 
$con = mysqli_connect("localhost","realnote","!dnwls1127","realnote"); 
$sql = "select * from `bookmark_$member[mb_id]_folder` where bmf_2 = '$member[mb_3]' order by bmf_top desc , bmf_order asc ,bmf_date desc";
$result = mysqli_query($con , $sql);
while ($folder = mysqli_fetch_array($result)) {?>

    <div class="map_board_list" id="<?=$folder['bmf_id']?>">

      <!-- 체크버튼 -->
      <input type="checkbox" name="chk_wr_id[]" class="import_chk" style="display:none;" value="<?php echo $folder['bmf_id'] ?>" id="chk_wr_id_<?php echo $folder['bmf_id']?>" >
      <label for="chk_wr_id_<?php echo $folder['bmf_id'] ?>" class="folder_list_check_label">
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
          <i class="fa fa-map-o map_toggle" aria-hidden="true" style="margin-right:5px;"></i>
          <!-- <i class="fa fa-chevron-down" aria-hidden="true"></i> -->
        </p> 
      </div>
    

    <?php
    if( $gr_admin)
    $group_table = $member[mb_id];
    else
    $group_table = $gr_cp;
    $sql2 = "select * from `g5_write_$member[mb_id]` a, `bookmark_$member[mb_id]` b where a.wr_id = b.bm_match_id and b.bm_from = 1 UNION ALL select * from `g5_write_$group_table` a, `bookmark_$member[mb_id]` b where a.wr_id = b.bm_match_id and b.bm_from = 2 ";
    $result2 = mysqli_query($con , $sql2);
    ?>

    <div class="child_list_wrap">
   <? while ($child = mysqli_fetch_array($result2)) {?>
    <?if( $folder['bmf_id'] == $child['bm_bmf_id']){ ?>
    <div class="child_list">
          <i class="fa fa-trash-o child_list_del" aria-hidden="true" id="" style="display:none;"></i>
          <input type="hidden" id="chk_child_id" value="<?=$child['bm_id']?>" >
          <p> 
          <!-- <?  ($child['wr_sale_type'] == '2') ? $wr_sale_type  = "<i class='icon-money-outlined '> </i>" : $wr_sale_type = "<i class='icon-home-outlined'> </i>" ?> -->
          <?  ($child['wr_sale_type'] == '2') ? $wr_sale_type  = "[매매] " : $wr_sale_type = "" ?>
          <?=$wr_sale_type;?>

          <!-- <span class="list_del_btn" data-value = "<?=$child['bm_id']?>">
          <input type="checkbox" name="chk_child_id[]" class="child_check" style="display:none;" value="<?=$child['bm_id']?>" id="chk_child_id_<?=$child['bm_id']?>" >
          <label for="chk_child_id_<?=$child['bm_id']?>" class="list_check_label">
          </label>
          </span> -->

          <span class="find_txt"><?=$child['wr_subject']?></span>
          <span class="child_list_info">
            <?=$child['wr_floor']?>층  
            <?=$child['wr_area_p']?>평 / 
            <?=$child['wr_rent_deposit']?>만 /
            <?=$child['wr_m_rate']?>만 /  
            <?=$child['wr_premium_o']?>만 
          </span>
        </p>

 
    </div>
    <?}} ?>
    <? $sql3 = " select count(*) as cnt  from bookmark_$member[mb_id] where bm_bmf_id = '$folder[bmf_id]' ";
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
  </div>
  </div>
  </div>
        
        <? $sql = " select count(*) as cnt  from bookmark_$member[mb_id]_folder ";
        $result4 = mysqli_query($con , $sql);
        $row4 = mysqli_fetch_array($result4);
        $folder_cnt = $row4['cnt'];

        if (0 == $folder_cnt ){ ?>
         <p style="text-align:center; font-size: 13px; margin-top:15px;">폴더 내역이 없습니다 폴더를 생성해 주세요.</p>   
        <?}?> 






<script>

$(document).ready(function(){
  var contact_url = "<?=$bookmark_skin_url?>/bookmark_board_list.php";
  $("#board_list_wrap").sortable({
    placeholder: 'highlight',
    update : function(event, ui)
    {
        var page_id_array = new Array();
        $('.map_board_list').each(function(){
          page_id_array.push($(this).attr("id"));
        });

        $.ajax({
            url: g5_bbs_url+"/folder_update.php",
            method:"POST",
            data : {page_id_array:page_id_array},
            success: function(data)
            {
              $.ajax({
              type : "POST",
              url : contact_url,
              dataType : "text",
              error : function() {
              alert('통신실패!!');
              },
              success : function(data) {
              $('#map_board').html(data);
              }
              });
            }
        })
    }
       
  })
  
})

//  폴더 순서 ajax요청
$(".folder_down").click(function(){
  var contact_url = "<?=$bookmark_skin_url?>/bookmark_board_list.php";
  var formData = {bmf_order :$(this).prev("#bmf_order").val()};
  $.ajax({
  url: g5_bbs_url+"/folder_update.php",
  type: "POST", 
  data: formData,
  dataType: 'text',
  success: function (data, textStatus, jqXHR) {

    console.log(data);
// 폴더 순서 수정 리스트 리로드 요청 
  $.ajax({
  type : "POST",
  url : contact_url,
  dataType : "text",
  error : function() {
  alert('통신실패!!');
  },
  success : function(data) {
  $('#map_board').html(data);
  }
  });

  },
  error: function (jqXHR, textStatus, errorThrown) {
  alert(errorThrown);
  }
  })
  });


  $(".bookmark_delete_btn").click(function(){
    var con = confirm("정말로 삭제 하시겠습니까?");
    if (con == true){
    $("#bookmark_form").attr("action", "./bookmark_update.php");
    $("#bookmark_form").submit();
    }
  });

// 북마크 리스트 삭제 버튼 ajax요청
$(".child_list_del").click(function(){
  console.log("ddd");
    var con = confirm("정말로 삭제 하시겠습니까?");

  if (con == true){
  var contact_url = "<?=$bookmark_skin_url?>/bookmark_board_list.php";
  var formData = {chk_child_id :$(this).next("#chk_child_id").val()};
  $.ajax({
  url: g5_bbs_url+"/bookmark_update.php",
  type: "POST",  
  data: formData,
  dataType: 'text',
  success: function (data, textStatus, jqXHR) {
    console.log(data);
// 북마크 리스트 리로드 요청  
  $.ajax({
  type : "POST",
  url : contact_url,
  dataType : "text",
  error : function() {
  alert('통신실패!!');
  },
  success : function(data) {
  $('#map_board').html(data);
  alert("해당 매물의 북마크가 해제 되었습니다.")
  }
  });
  },
  error: function (jqXHR, textStatus, errorThrown) {
  alert(errorThrown);
  }
  })
}
  });



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

// 매물 마우스 오버시 휴지통 
$(".child_list").hover(function(){
  $(this).find(".fa-trash-o").toggle();
})

// 폴더 클릭시 자식 매물 보여주기 : if(폴더 설정중이 아닐떄만)
$(".map_board_list  .registerated").click(function(){

if($('.folder_list_check_label').css("display") == "none"){
  $(this).parent('.map_board_list').next(".child_list_wrap").slideToggle(200);
  $(".folder_icon", this).toggleClass("fa-folder fa-folder-open");
}else{
   // display : none일 경우

}
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


// 매물 삭제 버튼

// $(".child_check").click(function(){
//   console.log("ddd");
//   var n = $( ".child_check:checked" ).length;
//   $( ".slect_child_count" ).text(n);

//   if ( $(this).is(":checked")){
//     $(this).parents(".child_list").addClass("child_select");
//   }else{ 
//     $(this).parents(".child_list").removeClass("child_select");
//   }

//   if ( n>0){
//       $(".bookmark_state").fadeIn();
//   }else{
//       $(".bookmark_state").hide();
//   }
// });





$(".child_list").each(function(index) {
$(this).on('click', function(){
var map_toggle_on = $(this).parent(".child_list_wrap").prev(".map_board_list").find(".dropdown_btn i").hasClass("fa-map");
if(map_toggle_on){
panTo($(this))
}
})
});






$(".bookmark_config_btn").click(function(){
    $(".folder_list_check_label").fadeToggle(300,'swing');
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

<?php
include_once('./_common.php');
?>

<style>
    ::-webkit-scrollbar {
        display:none;   
    }
</style>
         <div style="overflow:hidden;">
        <h4 style="float:left; width: 80%;">폴더리스트 </h4>
        <div class="folder_add_btn"><i class="fa fa-plus-circle"></i></div>
        </div>
<? 
        $con = mysqli_connect("localhost","realnote","!dnwls1127","realnote"); 
        $sql = "select * from `bookmark_$member[mb_id]_folder` order by bmf_top desc , bmf_date desc";
        $result = mysqli_query($con , $sql);
        while ($folder = mysqli_fetch_array($result)) {
        ?>
        <div class="map_board_list" id="book_list" >
        <input type="hidden" name="bmf_id_num" id="bmf_id"  value="<?=$folder['bmf_id']?>" >
        <!-- 리스트아이템 -->
        <div class="registerated">
        <?if ($folder['bmf_top'] == '1'){?>
          <i class="fa fa-folder" aria-hidden="true" style="float:left; font-size: 23px; color:#ffc107; padding-top:5px; margin-right:10px;"></i>
        <?}else{?>
          <i class="fa fa-folder" aria-hidden="true" style="float:left; font-size: 23px; color:#3b4db7; padding-top:5px; margin-right:10px;"></i>
        <?}?>
            <div class="find_txt" data-key="<?=$folder['wr_id']?>"><?=$folder['bmf_name']?></div>
        </div>
        </div>
        <?}?>
        <? 
        $sql = " select count(*) as cnt  from bookmark_$member[mb_id]_folder ";
        $row = sql_fetch($sql);
        $folder_cnt = $row['cnt'];


        if (0 == $folder_cnt ){ ?>
         <p style="text-align:center; font-size: 13px; margin-top:15px;">폴더 내역이 없습니다 폴더를 생성해 주세요.</p>   
        <?}?> 


<script>
    // 북마크 폴더선택 ajax요청
    $(".map_board_list").click(function(){
    var formData =$('#fboardlist').serializeArray();
    formData.push({name : "bmf_id" , value : $(this).find("#bmf_id").val()});
    $.ajax({
    url: "<?echo G5_BBS_URL?>/insertBookmark.php",
    type: "POST", 
    data: formData,
    dataType: 'text',
    success: function (Data, textStatus, jqXHR) {
        // alert(Data);
 
        var temp = [];
        var overlap = [];
        overlap = Data.split(',');
        temp = overlap.pop(); 

 
        var list_val = $('.check_list li').map(function() { return $(this).text() }).get().join(',');
        var list_text = [];
        list_text = list_val.split(',');

        for (i=0; i<overlap.length; i++) {

           var d= $.inArray(overlap[i],list_text)
           var c = $(".check_list li")[d];
           $(".check_list ul").prepend($(c))
           $(c).css("color","red");
        }    


        if(overlap.length>0){
            toastr.error( "해당매물은 선택한 폴더에 이미 등록되어<br> 있는 매물입니다.");
        } 
        else{
            $("#bookmark").modal('hide');
            $(".td_chk ").hide();
            $(".chk_confirm_wrap ").hide();
            toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            position: 'bottom',
            };
            toastr.success( Data,"해당 폴더에 즐겨찾기가 추가 되었습니다.");
        }

    },
    error: function (jqXHR, textStatus, errorThrown) {
    alert(errorThrown);
    }
    })
     
    })


    
    $(".folder_add_btn").click(function(){
    $("#bookmark_con").toggleClass("margin_zero")
    $(".folder_add_wrap").toggle();
    });

</script>
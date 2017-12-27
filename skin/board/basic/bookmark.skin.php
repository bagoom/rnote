<?php
?>
<script type="text/javascript" src="http://code.jquerygeo.com/jquery.geo-1.0.0-b1.5.min.js"></script>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=322cba0807c729368c6cc0ec6e84585c"></script>
<script src="https://d3js.org/d3.v4.min.js"></script>
<link href="<?=G5_URL?>/assets/css/jquery-nicelabel.css" rel="stylesheet" type="text/css" />
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<style>
.customoverlay {position:relative;bottom:45px;border-radius:6px;border: 1px solid #ccc;border-bottom:2px solid #ddd;float:left;}
.customoverlay:nth-of-type(n) {border:0; box-shadow:0px 1px 2px #888;}
.customoverlay a {display:block;text-decoration:none;color:#555;text-align:center;border-radius:6px;font-size:14px;font-weight:bold;overflow:hidden;background: #3b4db7;background: #3b4db7 url(http://t1.daumcdn.net/localimg/localimages/07/mapapidoc/arrow_white.png) no-repeat right 14px center;}
.customoverlay .title {display:block;text-align:center;background:#fff;
  /* margin-right:35px; */
  padding:10px 15px;font-size:14px;font-weight:bold;}
.customoverlay:after {content:'';position:absolute;margin-left:-12px;left:50%;bottom:-12px;width:22px;height:12px;background:url('http://t1.daumcdn.net/localimg/localimages/07/mapapidoc/vertex_white.png')}
::-webkit-scrollbar {
display:none;
}

.black-bg{
  margin-top: 0;
  background: #222 !important;
}
#map_area_all{
  position: absolute;
  top:85px;
  left:0;
  width: 75%;
}
#map_area{
  width: 100%;
  height: 100%;
}
#map_board{
  width: 25%;
  position: absolute;
  top:85px;
  right:0;
  background: #fff;
  z-index:1;
  overflow-y: scroll;
  box-shadow: -3px 0 15px rgba(0,0,0,.15);
  -ms-overflow-style: none; 
}
.info_window{
  border-radius: 3px;
}
.bookmark_head{
  position:relative;
  padding: 20px;
  font-size : 18px;
  color:#fff;
  background: #3b4db7; 
}
.bookmark_config_btn{
  position:absolute;
  top:0;
  right:0;
  width:64px;
  height:64px;
  line-height:64px;
  text-align:center;
  font-size:20px;
  color:#fff;
  background:#000;
  z-index:90;
  cursor:pointer;
}
.bookmark_delete_btn{
  position:absolute;
  top:0;
  right:64px;
  width:64px;
  height:64px;
  line-height:64px;
  display:none;
  text-align:center;
  font-size:20px;
  color:#fff;
  background:red;
  z-index:90;
  cursor:pointer;
}
.add_folder_btn{
  position:absolute;
  top:20px;
  right:15px;
  padding:7px 7px 4px 7px;
  text-align:center;
  font-size:12px;
  color:#222;
  border-radius:2px;
  background:#fff;
  
}
.map_board_list {
  position: relative;
  width: 100%;
  font-size: 14px;
  color:#666;
  cursor: pointer;
  -webkit-transition: all .5s ease;
	-moz-transition: all .5s ease;
	-o-transition: all .5s ease;
	transition: all .5s ease;
}
.map_board_list:hover{
  font-weight: 700;
  padding-top:5px;
}

.registerated{
  display: table;
  min-height: 33px;
  padding:15px 15px;
}
.child_list_wrap{
  display:none;
}
.child_list{
  padding:15px;
  background:#f5f5f5;
  border-top: 1px solid #e7e7e7;
}
.map_board_info{
  width: 100%;
  background: #f6f6f6;
  display: none;
  padding:15px;
  box-shadow: inset 0px 0px 7px rgba(0,0,0,.09);
  color:#888;
}
.map_board_info li{
  width:100%;
  padding: 3px;
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
.find_txt{
  float:left;
  line-height:35px;
}
.map_info_big{
  font-size: 18px;
  font-weight: bold;
  color: #3b4db7;
}
.url_btn{
  width: 90px;
  padding:5px;
  text-align: center;
  background: #3b4db7;
  color: #fff;
  border-radius: 5px;
}
.dropdown_btn{
  position: absolute;
  right: 0;
  top: 10px;
  width: 50px;
  height: 50px;
  line-height: 50px;
  text-align: center;
  color: #3b4db7;
  font-size: 20px;
}
.ddong_border{
  /*z-index: 9999999;*/
  border:3px solid #3b4db7;
  transition: 0.3s all;
}
.modal-dialog{
  margin-top:150px;
}
.modal-body{
  padding:0;
}
.modal_sec{
  padding: 30px;
  border-bottom: 0.5px solid #ccc; 
  overflow:hidden;
}
.modal_sec:last-child{
  border:0;
}
.modal-body input[type=text]{
  width:80%;
  height: 50px;  
  padding-left: 10px ;
  font-size: 18px;
  float:left;
}
.modal-body label:first-child{
  width: 20%;
  float:left;
  padding-top:15px;
  font-size: 18px;
}
.circle-nicelabel + label{
  background-color: #3b4db7;
}

</style>

<div id="bookmark_wrap">
<div id="map_area_all">

<div id="map_area"></div>
<div class="bookmark_config_btn">
<i class="fa fa-cog" aria-hidden="true"></i>
</div>
<div class="bookmark_delete_btn">
<i class="fa fa-trash-o" aria-hidden="true"></i>
</div>

</div>
<div id="map_board">

<div class="bookmark_head">


<i class="fa fa-bookmark" aria-hidden="true" style="font-size:22px; margin-right: 10px;"></i> 
<?=$member['mb_name']?>님의 
즐겨찾기
<div class="add_folder_btn" data-target="#layerpop" data-toggle="modal">
폴더추가하기
</div>
</div>


<form action="" id="bookmark_form" method="post">


<? 
$con = mysqli_connect("localhost","realnote","!dnwls1127","realnote"); 

$sql = "select * from `g5_write_test10` a, `bookmark_test10` b where a.wr_id = b.bm_match_id and b.bm_from = 1 UNION ALL select * from `g5_write_ekdna8284` a, `bookmark_test10` b where a.wr_id = b.bm_match_id and b.bm_from = 2 ";

$sql = "select * from `bookmark_test10_folder`";
$result = mysqli_query($con , $sql);
?>




  <? while ($folder = mysqli_fetch_array($result)) {?>
    <div class="map_board_list" >
      <!-- 체크버튼 -->
      <label for="chk_wr_id_<?php echo $folder['wr_id'] ?>" class="list_check_label">
      <i class="fa fa-check" aria-hidden="true"></i>
      </label>
      <input type="checkbox" name="chk_wr_id[]" class="import_chk" style="display:none;" value="<?php echo $folder['wr_id'] ?>" id="chk_wr_id_<?php echo $folder['wr_id']?>" >

      <!-- 리스트아이템 -->
      <div class="registerated">
       <i class="fa fa-folder" aria-hidden="true" style="float:left; font-size: 23px; color:#3b4db7; padding-top:5px; margin-right:10px;"></i>
        <div class="find_txt" data-key="<?=$folder['wr_id']?>"><?=$folder['bmf_name']?></div>
        <p class="dropdown_btn" ><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></p>
      </div>
      </div>
    


    <?php
    $sql2 = "select * from `g5_write_test10` a, `bookmark_test10` b where a.wr_id = b.bm_match_id and b.bm_from = 1 UNION ALL select * from `g5_write_ekdna8284` a, `bookmark_test10` b where a.wr_id = b.bm_match_id and b.bm_from = 2 ";
    $result2 = mysqli_query($con , $sql2);
    ?>

    <div class="child_list_wrap">
   <? while ($child = mysqli_fetch_array($result2)) {?>
    <?if( $folder[bmf_id] == $child[bm_bmf_id]){ ?>
    <div class="child_list">
          <p><?=$child['wr_subject']?></p>
    </div>
    <?}}?> 
    </div>

    <!-- <div class="map_board_info">
        <ul>
          <li><span class="map_info_big"><?=$folder[wr_rent_deposit]?></span>만/<span class="map_info_big"><?=$folder[wr_m_rate]?></span>만</li>
          <li><?=$folder[wr_address]?></li>
          <li><?=$folder[wr_sale_area]?></li>
          <li style="margin-top:10px;"><a href="<?=$folder['href']?>" class="url_btn">매물바로가기</a></li>
        </ul>
    </div> -->

<?}?>
<!-- <? if(count($folder)==0){ ?>
  <div style="padding:25px 15px; font-size:20px; text-align:center;">
    즐겨찾기된 매물이 없습니다.
  </div>
  <?}?> -->
  </form>

</div>
</div>




<div class="modal fade" id="layerpop" >
                <div class="modal-dialog">
                  <div class="modal-content" style="min-width:500px !important; width:500px; margin:0 auto;">
                    <!-- header -->
                    <div class="modal-header">
                      <!-- 닫기(x) 버튼 -->
                      <button type="button" class="close" data-dismiss="modal">×</button>
                      <!-- header title -->
                      <h4 class="modal-title">즐겨찾기 폴더 추가</h4>
                    </div>
                    <!-- body -->
                    <div class="modal-body" >
                      
                      <form id="folder_add_form" action="<?echo G5_BBS_URL?>/folder_update.php" method="post">
                      <div class="modal_sec">
                        <label >폴더명</label>  
                      <input type="text" placeholder="추가하실 폴더의 이름을 적어 주세요." name="folder_name">
                        </div>
                        <div class="modal_sec">
                        <label >상단고정</label>  
                        <input class="circle-nicelabel" name="folder_top" data-nicelabel="{&quot;position_class&quot;: &quot;circle-checkbox&quot;}" type="checkbox" id="nicelabel" value="0">
                        <label class="circle-checkbox" for="nicelabel" style="margin-top:8px;"><div class="circle-btn"></div></label>
                        </div>
                      </form>
                      </div>
                      <!-- Footer -->
                      <div class="modal-footer" style="padding:15px;">
                        <button type="button" class="btn btn-default add" data-dismiss="modal">폴더추가</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                      </div>
                  </div>
                </div>
              </div>

<script src="<?=G5_URL?>/assets/js/jquery.nicelabel.js"></script>            

<script>

//  폴더 추가 ajax요청
$(".add").on('click',function () {
  if( $('#nicelabel').is(":checked")){
      $('#nicelabel').val("1");
    }
  var formData = $('#folder_add_form').serializeArray();
  $.ajax({
  url: "<?echo G5_BBS_URL?>/folder_update.php",
  type: "POST", 
  data: formData,
  dataType: 'text',
  success: function (Data, textStatus, jqXHR) {

  console.log(formData[0]);
  console.log(formData[1]);
  console.log(formData[2]);
  // 폴더 추가후 리스트 새로고침 ajax요청
  // $.ajax({
  // type : "POST",
  // url : '<?echo G5_BBS_URL?>/contact.php',
  // dataType : "text",
  // error : function() {
  //     alert('통신실패!!');
  // },
  // success : function(data) {
  //     $('.main-list-wrap').html(data);
  // }
  // });
  
  },
  error: function (jqXHR, textStatus, errorThrown) {
  alert(errorThrown);
  }
  })
  });



$(".map_board_list").click(function(){
  $(this).next(".child_list_wrap").slideToggle(200);
  $("i", this).toggleClass("fa-folder fa-folder-open");
})

$(".map_board_list").each(function(index) {
$(this).find(".dropdown_btn").on("click", function(){
    $(this).parents(".map_board_list").next(".map_board_info").slideToggle(200);
});
$(this).on('click', function(){
    panTo($(this))
})
});

$(".bookmark_config_btn").click(function(){
    $(".list_check_label").fadeToggle(300,'swing');
})

$(".import_chk").click(function(){
  
  if( $(this).is(":checked") ){
    $(".bookmark_delete_btn").show();
  }else{
    $(".bookmark_delete_btn").hide();
  }
})

$(".bookmark_delete_btn").click(function(){
    $("#bookmark_form").attr("action", "./bookmark_update.php");
    $("#bookmark_form").submit();
  });


var positions = [];
var center_position = [];
$('#map_area_all,#map_board,#bookmark_wrap').css("height", $(window).height()-85);
// $('#map_area_all,#map_board,#bookmark_wrap').css('height',$(window).height());
// $('#map_area_all,#map_board').css("max-height","780px");
<? 
$sql = "select * from `g5_write_test10` a, `bookmark_test10` b where a.wr_id = b.bm_match_id and b.bm_from = 1 UNION ALL select * from `g5_write_ekdna8284` a, `bookmark_test10` b where a.wr_id = b.bm_match_id and b.bm_from = 2 ";
$result = mysqli_query($con, $sql);
while ($folder = mysqli_fetch_array($result)) {?>
  var title = "<?=$folder[wr_subject]?>";
  var posx = <?=$folder[wr_posx]?>;
  var posy = <?=$folder[wr_posy]?>;
  var wr_floor = <?=$folder[wr_floor]?>;
  var wr_area_p = <?=$folder[wr_area_p]?>;
  var wr_rent_deposit = <?=$folder[wr_rent_deposit]?>;
  var wr_m_rate = <?=$folder[wr_m_rate]?>;
  var wr_premium_o = <?=$folder[wr_premium_o]?>;
  var url = "<?=$folder['href']?>";
  positions.push( [title,posy,posx,url,wr_floor,wr_area_p,wr_rent_deposit,wr_m_rate,wr_premium_o] )
  center_position.push( [posy,posx] )

<?}?>

var newPositions = positions.map(function(d)
{
  return { title: d[0],
  latlng: new daum.maps.LatLng(d[1], d[2]),
  url: d[3],
  wr_floor: d[4],
  wr_area_p: d[5],
  wr_rent_deposit: d[6],
  wr_m_rate: d[7],
  wr_premium_o: d[8]
  }
});



var newCenter_Position = center_position.map(function(d)
{
   var temp = new daum.maps.LatLng(d[0],d[1])
  //  return Object.values(temp)
   return Object.keys(temp).map(function(e){ return temp[e] })

   }
)

var centroid = $.geo.centroid( {
  type: "Polygon",
    coordinates: [newCenter_Position]
} )




var mapContainer = document.getElementById('map_area'), // 지도를 표시할 div
    mapOption = {
        center: new daum.maps.LatLng(centroid.coordinates[1],centroid.coordinates[0]), // 지도의 중심좌표
        level: 7 // 지도의 확대 레벨
    };
var map = new daum.maps.Map(mapContainer, mapOption); // 지도를 생성합니다
// 마커 이미지의 이미지 주소입니다

// 지도 확대 레벨 변화 이벤트를 등록한다
		// daum.maps.event.addListener(map, 'zoom_changed', function () {
    //   console.log(centroid.coordinates[0],centroid.coordinates[1])
    //
		// });
    var imageSrc = "<?echo G5_URL?>/img/marker.png";

for (var i = 0; i < positions.length; i ++) {


  // 마커 이미지의 이미지 크기 입니다
      var imageSize = new daum.maps.Size(35, 35);

      // 마커 이미지를 생성합니다
      var markerImage = new daum.maps.MarkerImage(imageSrc, imageSize);

      // 마커를 생성합니다
      var marker = new daum.maps.Marker({
          map: map, // 마커를 표시할 지도
          position: newPositions[i].latlng, // 마커를 표시할 위치
          title : positions[i].title, // 마커의 타이틀, 마커에 마우스를 올리면 타이틀이 표시됩니다
          image : markerImage // 마커 이미지
      });



// 마커가 지도 위에 표시되도록 설정합니다
marker.setMap(map);

// 커스텀 오버레이에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다
var content = '<div class="customoverlay">' +
  '  <a href="#" >' +
  // '  <a href="'+newPositions[i].url+'" target="_blank">' +
  '    <span class="title">'+'<span class="subj">'+newPositions[i].title+' </span>'+newPositions[i].wr_floor+'/'+newPositions[i].wr_area_p+'<br>'+newPositions[i].wr_rent_deposit+'/'+newPositions[i].wr_m_rate+'/'+newPositions[i].wr_premium_o+'</span>' +
  '  </a>' +
  '</div>';

// 커스텀 오버레이가 표시될 위치입니다
var position = new daum.maps.LatLng(37.54699, 127.09598);

// 커스텀 오버레이를 생성합니다
var customOverlay = new daum.maps.CustomOverlay({
  map: map,
  position: newPositions[i].latlng,
  content: content,
  yAnchor: 1
});
}

$(".map_board_list").hover(function(){
  hoverList($(this))
});
$(".map_board_list").mouseleave(function(){
  leaveList($(this))
});


// 맵 오버레이 마우스오버시 보더 / z-index 증가
$(".customoverlay").hover(function() {
  $(this).children('a').addClass("ddong_border");
  $(this).parent().css("z-index","10");
});

$(".customoverlay").mouseleave(function() {
  $(this).children('a').removeClass("ddong_border");
  $(this).parent().css("z-index","0");
});
// 맵 오버레이 마우스클릭시 보더 / z-index 증가
$(".customoverlay").click(function() {
  $(this).children('a').addClass("ddong_border");
  $(this).parent().css("z-index","10");
});



function hoverList(d){
  var text = d.find('.find_txt').text();
  var ddong =$('span.title').parent();
  var ddong = d3.selectAll('.customoverlay').select('a').select('span.subj')._groups[0]
  var ddd =  ddong.filter(function(a){
  return a.innerHTML.replace(' ','') == text})
$(ddd).parents('a').addClass("ddong_border");
$(ddd).parents('.customoverlay').parent().css("z-index","10");
  };

function leaveList(d){
  var text = d.find('.find_txt').text();
  var ddong =$('span.title').parent();
  var ddong = d3.selectAll('.customoverlay').select('a').select('span.subj')._groups[0]
  var ddd =  ddong.filter(function(a){
  return a.innerHTML.replace(' ','') == text})
$(ddd).parents('a').removeClass("ddong_border");
$(ddd).parents('.customoverlay').parent().css("z-index","0");
  };






//
// var filtered = ddong.filter(function(a){return ddong.text() == text});
// console.log(ddong[1].innerHTML)
// $(filtered).find(".customoverlay").css("background","red")
// }




function panTo(d) {
  // console.log('works')
var text = d.find('.find_txt').text();
console.log(text)
var filtered = newPositions.filter(function(a){return a.title == text})

var moveLatLon = filtered[0].latlng;
map.panTo(moveLatLon);
}




















</script>
<script>
	$(function(){
		$('#rect-checkbox > input').nicelabel();
		$('#rect-radio > input').nicelabel();
		$('#circle-checkbox > input').nicelabel();
		$('#circle-radio > input').nicelabel();
		$('#text-checkbox > input').nicelabel();
		$('#text-radio > input').nicelabel();
		$('#text-checkbox-ico > input:eq(0)').nicelabel({
			checked_ico: './ico/checked.png',
			unchecked_ico: './ico/unchecked.png'
		});
		$('#text-checkbox-ico > input:eq(1)').nicelabel({
			checked_ico: './ico/checked.png',
			unchecked_ico: './ico/unchecked.png'
		});
		$('#text-checkbox-ico > input:eq(2)').nicelabel({
			checked_ico: './ico/checked.png',
			unchecked_ico: './ico/unchecked.png'
		});
		$('#text-checkbox-ico > input:eq(3)').nicelabel({
			uselabel: false
		});
		
	});
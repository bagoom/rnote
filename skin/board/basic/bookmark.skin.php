<?php
?>
<script type="text/javascript" src="http://code.jquerygeo.com/jquery.geo-1.0.0-b1.5.min.js"></script>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=322cba0807c729368c6cc0ec6e84585c"></script>
<script src="https://d3js.org/d3.v4.min.js"></script>
<style>
.customoverlay {position:relative;bottom:45px;border-radius:6px;border: 1px solid #ccc;border-bottom:2px solid #ddd;float:left;}
.customoverlay:nth-of-type(n) {border:0; box-shadow:0px 1px 2px #888;}
.customoverlay a {display:block;text-decoration:none;color:#555;text-align:center;border-radius:6px;font-size:14px;font-weight:bold;overflow:hidden;background: #3b4db7;background: #3b4db7 url(http://t1.daumcdn.net/localimg/localimages/07/mapapidoc/arrow_white.png) no-repeat right 14px center;}
.customoverlay .title {display:block;text-align:center;background:#fff;
  /* margin-right:35px; */
  padding:10px 15px;font-size:14px;font-weight:bold;}
.customoverlay:after {content:'';position:absolute;margin-left:-12px;left:50%;bottom:-12px;width:22px;height:12px;background:url('http://t1.daumcdn.net/localimg/localimages/07/mapapidoc/vertex_white.png')}

.black-bg{
  margin-top: 0;
  background: #222 !important;
}
#map_area_all{
  position: absolute;
  top:75px;
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
  top:75px;
  right:0;
  background: #fff;
  z-index:1;
  overflow-y: scroll;
  box-shadow: -3px 0 15px rgba(0,0,0,.15);
}
.info_window{
  border-radius: 3px;
}
.map_board_list {
  position: relative;
  width: 100%;
  height: 70px;
  border-top : 1px solid #f0f0f6;
  padding:15px 15px;
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
  padding-top:20px;
}

.registerated{
  display: table;
  min-height: 33px;
  padding:5px;
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
  top: 50%;
  width: 50px;
  height: 50px;
  line-height: 50px;
  text-align: center;
  margin-top: -20px;
  color: #3b4db7;
  font-size: 20px;
}
.ddong_border{
  /*z-index: 9999999;*/
  border:3px solid #3b4db7;
  transition: 0.3s all;
}
</style>

<div id="bookmark_wrap">
<div id="map_area_all">

<div id="map_area"></div>
</div>
<div id="map_board">
  <? for ($i=0; $i<count($list); $i++) {?>
    <div class="map_board_list" >
      <div class="registerated">

        <img  style="margin-right:10px; width:35px;"src="<?echo G5_URL?>/img/marker.png">
        <span class="find_txt"><?=$list[$i][wr_subject]?></span>
        <p class="dropdown_btn" ><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></p>
      </div>
    </div>

    <div class="map_board_info">
        <ul>
          <li><span class="map_info_big"><?=$list[$i][wr_rent_deposit]?></span>만/<span class="map_info_big"><?=$list[$i][wr_m_rate]?></span>만</li>
          <li><?=$list[$i][wr_address]?></li>
          <li><?=$list[$i][wr_sale_area]?></li>
          <li style="margin-top:10px;"><a href="<?=$list[$i]['href']?>" class="url_btn">매물바로가기</a></li>
        </ul>
    </div>


<?}?>
<? if(count($list)==0){ ?>
  <div style="padding:25px 15px; font-size:20px; text-align:center;">
    즐겨찾기된 매물이 없습니다.
  </div>
  <?}?>


</div>
</div>


<script>
$(".map_board_list").each(function(index) {
$(this).find(".dropdown_btn").on("click", function(){
    $(this).parents(".map_board_list").next(".map_board_info").slideToggle(200);
});
$(this).on('click', function(){
    panTo($(this))
})
});




var positions = [];
var center_position = [];
// $('#map_area_all,#map_board,#bookmark_wrap').css("height", $(document).height()-60);
$('#map_area_all,#map_board,#bookmark_wrap').css('height',$(window).height());
// $('#map_area_all,#map_board').css("max-height","780px");
<? for ($i=0; $i<count($list); $i++) {?>
  var title = "<?=$list[$i][wr_subject]?>";
  var posx = <?=$list[$i][wr_posx]?>;
  var posy = <?=$list[$i][wr_posy]?>;
  var wr_floor = <?=$list[$i][wr_floor]?>;
  var wr_area_p = <?=$list[$i][wr_area_p]?>;
  var wr_rent_deposit = <?=$list[$i][wr_rent_deposit]?>;
  var wr_m_rate = <?=$list[$i][wr_m_rate]?>;
  var wr_premium_o = <?=$list[$i][wr_premium_o]?>;
  var url = "<?=$list[$i]['href']?>";
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
        level: 8 // 지도의 확대 레벨
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

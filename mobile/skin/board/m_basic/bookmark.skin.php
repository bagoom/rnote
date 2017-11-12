<?php
?>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=322cba0807c729368c6cc0ec6e84585c"></script>
<script type="text/javascript" src="http://hammerjs.github.io/dist/hammer.min.js"></script>


<style>
.customoverlay {position:relative;bottom:85px;border-radius:6px;border: 1px solid #ccc;border-bottom:2px solid #ddd;float:left;}
.customoverlay:nth-of-type(n) {border:0; box-shadow:0px 1px 2px #888;}
.customoverlay a {display:block;text-decoration:none;color:#555;text-align:center;border-radius:6px;font-size:14px;font-weight:bold;overflow:hidden;background: #f1b90b;background: #f1b90b url(http://t1.daumcdn.net/localimg/localimages/07/mapapidoc/arrow_white.png) no-repeat right 14px center;}
.customoverlay .title {display:block;text-align:center;background:#fff;margin-right:35px;padding:10px 15px;font-size:14px;font-weight:bold;}
.customoverlay:after {content:'';position:absolute;margin-left:-12px;left:50%;bottom:-12px;width:22px;height:12px;background:url('http://t1.daumcdn.net/localimg/localimages/07/mapapidoc/vertex_white.png')}
#map_area_all{
  position: absolute;
  top:58px;
  left:0;
  width: 100%;
  height: 350px;
}
#map_area{
  width: 100%;
  height: 100%;
}
#map_board{
  width: 100%;
  position: absolute;
  top:350px;
  right:0;
  background: #fff;
  border-top:3px solid #f1b90b;
  z-index:4;
  padding-bottom:41px;
  box-shadow: -3px 0 15px rgba(0,0,0,.15);
  min-height: 350px;
}
.map_overlay{
  position: absolute;
  width: 100%;
  height: 295px;
  line-height: 270px;
  left:0;
  top:0;
  background: #000;
  color: #fff;
  font-size: 20px;
  text-align: center;
  display: none;
  z-index: 3;
}
.info_window{
  border-radius: 3px;
}
.map_board_list {
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
  color: #ffc200;
}
.url_btn{
  width: 90px;
  padding:5px;
  text-align: center;
  background: #f1b90b;
  color: #fff;
  border-radius: 5px;
}
</style>


<div id="map_area_all">
<div id="map_area">
<div class="map_overlay">
  두손으로 확대/이동이 가능합니다.
</div>

</div>
</div>
<div id="map_board">
  <? for ($i=0; $i<count($list); $i++) {?>
    <div class="map_board_list" onclick="panTo($(this))">
      <div class="registerated">

        <img  style="margin-right:10px;"src="http://t1.daumcdn.net/localimg/localimages/07/mapapidoc/markerStar.png">
        <?=$list[$i][wr_subject]?>
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



<script>
$(".map_board_list").each(function(index) {
$(this).on("click", function(){
    $(this).next(".map_board_info").slideToggle(200);
});
});


var positions = [];
// $('#map_area_all').css("height", $(document).height());
<? for ($i=0; $i<count($list); $i++) {?>
  var title = "<?=$list[$i][wr_subject]?>";
  var posx = <?=$list[$i][wr_posx]?>;
  var posy = <?=$list[$i][wr_posy]?>;
  var url = "<?=$list[$i]['href']?>";
  positions.push( [title,posy,posx,url] )

<?}?>

var newPositions = positions.map(function(d)
{
  return { title: d[0],
  latlng: new daum.maps.LatLng(d[1], d[2]),
  url: d[3]
  }
});

var mapContainer = document.getElementById('map_area'), // 지도를 표시할 div
    mapOption = {
        center: new daum.maps.LatLng(35.17944, 129.07556), // 지도의 중심좌표
        level: 8 // 지도의 확대 레벨
    };

var map = new daum.maps.Map(mapContainer, mapOption); // 지도를 생성합니다
// 마커 이미지의 이미지 주소입니다


var myElement = document.getElementById('map_area');
var mc = new Hammer.Manager(myElement);
// let the pan gesture support all directions.
// this will block the vertical scrolling on a touch-device while on the element
var singlepan = new Hammer.Pan({
  event: 'pan',
  direction: Hammer.DIRECTION_ALL,
  threshold: 5,
  pointers: 1
});
var multipan = new Hammer.Pan({
  event: 'multipan',
  direction: Hammer.DIRECTION_ALL,
  threshold: 5,
  pointers: 2
});
mc.add(singlepan);
mc.add(multipan);
singlepan.recognizeWith(multipan);
multipan.requireFailure(singlepan);

// listen to events...
mc.on("panleft panright panup pandown tap press", function(ev) {
  $('.map_overlay').css("display","block");
  $('.map_overlay').fadeOut(2000);
    map.setDraggable(false);
});
mc.on("multipanleft multipanright multipanup multipandown tap press", function(ev) {
    map.setDraggable(true);
    $('.map_overlay').css("display","none");
});



for (var i = 0; i < positions.length; i ++) {

  var imageSrc = "http://t1.daumcdn.net/localimg/localimages/07/mapapidoc/markerStar.png";
  imageSize = new daum.maps.Size(24, 35), // 마커이미지의 크기입니다
  imageOprion = {offset: new daum.maps.Point(13, 69)}; // 마커이미지의 옵션입니다. 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정합니다.

// 마커의 이미지정보를 가지고 있는 마커이미지를 생성합니다
var markerImage = new daum.maps.MarkerImage(imageSrc, imageSize, imageOprion);

// 마커를 생성합니다
var marker = new daum.maps.Marker({
position: newPositions[i].latlng,
image: markerImage // 마커이미지 설정
});


console.log(newPositions[i].latlng);



// 마커가 지도 위에 표시되도록 설정합니다
marker.setMap(map);

// 커스텀 오버레이에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다
var content = '<div class="customoverlay">' +
  '  <a href="'+newPositions[i].url+'" target="_blank">' +
  '    <span class="title">'+newPositions[i].title+'&nbsp;'+'</span>' +
  '  </a>' +
  '</div>';


// 커스텀 오버레이를 생성합니다
var customOverlay = new daum.maps.CustomOverlay({
  map: map,
  position: newPositions[i].latlng,
  content: content,
  yAnchor: 1
});
}

function panTo(d) {
var text = d.find('div').text().replace(/\s/g,'')
var filtered = newPositions.filter(function(a){return a.title == text})
var moveLatLon = filtered[0].latlng;
map.panTo(moveLatLon);
}









</script>

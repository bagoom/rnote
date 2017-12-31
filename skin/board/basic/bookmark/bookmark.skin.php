<script type="text/javascript" src="http://code.jquerygeo.com/jquery.geo-1.0.0-b1.5.min.js"></script>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=322cba0807c729368c6cc0ec6e84585c"></script>
<script src="https://d3js.org/d3.v4.min.js"></script>
<link href="<?=G5_URL?>/assets/css/jquery-nicelabel.css" rel="stylesheet" type="text/css" />
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link href="<?=$bookmark_skin_url?>/bookmark_style.css" rel="stylesheet" type="text/css">



<? $con = mysqli_connect("localhost","realnote","!dnwls1127","realnote"); ?>
<div id="bookmark_wrap">
<div id="map_area_all">

<div id="map_area"></div>
</div>
<div id="map_board">
  </div>
</div>



            <!-- 폴더추가 -->
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

              <!-- 폴더 수정 -->
              <div class="modal fade" id="modify_folder" >
              <div class="modal-dialog">
              <div class="modal-content" style="min-width:500px !important; width:500px; margin:0 auto;">
                <!-- header -->
                <div class="modal-header">
                  <!-- 닫기(x) 버튼 -->
                  <button type="button" class="close" data-dismiss="modal">×</button>
                  <!-- header title -->
                  <h4 class="modal-title">즐겨찾기 폴더 수정</h4>
                </div>
                <!-- body -->
                <div class="modal-body" >
                  
                  <form id="folder_add_form2" action="<?echo G5_BBS_URL?>/folder_update.php" method="post">
                  <input type="hidden" id="bmf_id" name="bmf_id" value="">
                  <input type="hidden" name="w" value="u">
                  <div class="modal_sec">
                    <label >폴더명</label>  
                  <input type="text" placeholder="추가하실 폴더의 이름을 적어 주세요." name="folder_name" id="folder_name">
                    </div>
                    <div class="modal_sec">
                    <label >상단고정</label>  
                    <input class="circle-nicelabel" name="folder_top" id="folder_top" data-nicelabel="{&quot;position_class&quot;: &quot;circle-checkbox&quot;}" type="checkbox" id="nicelabel" value="0" >
                    <label class="circle-checkbox" for="folder_top" style="margin-top:8px;"><div class="circle-btn"></div></label>
                    </div>
                  </form>
                  </div>
                  <!-- Footer -->
                  <div class="modal-footer" style="padding:15px;">
                    <button type="button" class="btn btn-default modify" data-dismiss="modal">폴더수정</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                  </div>
              </div>
            </div>
              </div>
<script src="<?=G5_URL?>/assets/js/jquery.nicelabel.js"></script>            

<script>
$(function() { $("input:text").keydown(function(evt) { if (evt.keyCode == 13) return false; }); });







// 북마크리스트 ajax요청
var contact_url = "<?=$bookmark_skin_url?>/bookmark_board_list.php";
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
    $('#map_board').html(data);
}
});
})


//  폴더 추가 ajax요청
$(".add").on('click',function () {
  var contact_url = "<?=$bookmark_skin_url?>/bookmark_board_list.php";
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
// 폴더 추가후 리스트 리로드 요청 
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

  //  폴더 수정 ajax요청
$(".modify").on('click',function () {
  var contact_url = "<?=$bookmark_skin_url?>/bookmark_board_list.php";
  if( $('#folder_top').is(":checked")){
      $('#folder_top').val("1");
    }
  var formData = $('#folder_add_form2').serializeArray();
  $.ajax({
  url: "<?echo G5_BBS_URL?>/folder_update.php",
  type: "POST", 
  data: formData,
  dataType: 'text',
  success: function (Data, textStatus, jqXHR) {
// 폴더 수정후 리스트 리로드 요청 
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








var positions = [];
var center_position = [];
$('#map_area_all,#map_board,#bookmark_wrap').css("height", $(window).height()-85);



<? $sql = "select * from `g5_write_test10` a, `bookmark_test10` b where a.wr_id = b.bm_match_id and b.bm_from = 1 UNION ALL select * from `g5_write_ekdna8284` a, `bookmark_test10` b where a.wr_id = b.bm_match_id and b.bm_from = 2 ";
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
  var bm_bmf_id = <?=$folder['bm_bmf_id']?>;
  var url = "<?=$folder['href']?>";
  positions.push( [title,posy,posx,url,wr_floor,wr_area_p,wr_rent_deposit,wr_m_rate,wr_premium_o,bm_bmf_id] )
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
  wr_premium_o: d[8],
  bm_bmf_id: d[9]
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
    var markers = [];
    var overlays = [];
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
// 커스텀 오버레이에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다
var content = '<div class="customoverlay">' +
  '  <a href="#" >' +
  // '  <a href="'+newPositions[i].url+'" target="_blank">' +
  '    <span class="title">'+'<span class="subj">'+newPositions[i].title+' </span>'+newPositions[i].wr_floor+'/'+newPositions[i].wr_area_p+'<br>'+newPositions[i].wr_rent_deposit+'/'+newPositions[i].wr_m_rate+'/'+newPositions[i].wr_premium_o+'</span>' +
  '  </a>' +
  '</div>';


// 커스텀 오버레이를 생성합니다
var customOverlay = new daum.maps.CustomOverlay({
  map: map,
  position: newPositions[i].latlng,
  content: content,
  yAnchor: 1
});


markers.push(marker);
overlays.push(customOverlay);

function setMarkers(map,a) {
  for (var i = 0; i < markers.length; i++) {

      if(newPositions[i].bm_bmf_id == a){

          markers[i].setMap(map);
          overlays[i].setMap(map);

      }
  }            
}


} // for exit


function _initsetMarkers(map) {
  for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(map);
      overlays[i].setMap(map);
  }            
}
function initMarkers(map) {
  _initsetMarkers(null);  
}


function hideMarkers(toggle_id) {
    setMarkers(null,toggle_id);  
}
function showMarkers(toggle_id) {
    setMarkers(map,toggle_id)    
}



$(".child_list").hover(function(){
  console.log("ddd")
  hoverList($(this))
});
$(".child_list").mouseleave(function(){
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
console.log(ddong);
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




// var filtered = ddong.filter(function(a){return ddong.text() == text});
// console.log(ddong[1].innerHTML)
// $(filtered).find(".customoverlay").css("background","red")
// }
function panTo(d) {
  // console.log('works')
var text = d.find('.find_txt').text();
var filtered = newPositions.filter(function(a){return a.title == text})
console.log(text)

var moveLatLon = filtered[0].latlng;
map.panTo(moveLatLon);
}




  </script>
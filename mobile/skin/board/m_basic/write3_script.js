


    <script>

    $(".option_toggle").click(function(){
    $(".option_contents").toggle();
        });

        $(".sg_cate_list").click(function(){

          $.ajax({
          type : "POST",
          url : "../skin/board/basic/modal/sg_cate_list.html",
          dataType : "text",
          error : function() {
              alert('통신실패!!');
          },
          success : function(data) {
              $('#Context').html(data);
          }
        });
         })

         function randomString() {
     var premium_o = document.getElementById('wr_premium_o').value;
     var premium_b = document.getElementById('wr_premium_b').value;
     var premium_result = (premium_o-premium_b)+"";
     var chars = "ABCDEFGHIJKLMNOPQRSTUVWXTZ";
     var string_length = 6;
     var randomstring = '';
       if(premium_result.length == 3){
         var premium_result ="0"+premium_result.replace(/0/g, "");
       }else if (premium_result.length == 4) {
         var premium_result = premium_result.replace(/0/g, "");
           if(premium_result.length == 1){
             var premium_result = premium_result+"0";
           }
       }
     for (var i=0; i<string_length; i++) {
     var rnum = Math.floor(Math.random() * chars.length);
     randomstring += chars.substring(rnum,rnum+1);
     }
     var printstring = randomstring +premium_result;

     //document.randform.randomfield.value = randomstring;
     return printstring;
     }

    <?php if($write_min || $write_max) { ?>
    // 글자수 제한
    var char_min = parseInt(<?php echo $write_min; ?>); // 최소
    var char_max = parseInt(<?php echo $write_max; ?>); // 최대
    check_byte("wr_content", "char_count");

    $(function() {
        $("#wr_content").on("keyup", function() {
            check_byte("wr_content", "char_count");
        });
    });

    <?php } ?>
    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
    {
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.wr_subject.value,
                "content": f.wr_content.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });



        if (subject) {
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            f.wr_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                f.wr_content.focus();
            return false;
        }

        if (document.getElementById("char_count")) {
            if (char_min > 0 || char_max > 0) {
                var cnt = parseInt(check_byte("wr_content", "char_count"));
                if (char_min > 0 && char_min > cnt) {
                    alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                    return false;
                }
                else if (char_max > 0 && char_max < cnt) {
                    alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                    return false;
                }
            }
        }

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }

    </script>












    <script type="text/javascript">

      function autotext(sel){

        var fm  = document.fwrite1;

        var txt = gugun2.options[gugun2.selectedIndex].text;

        if(txt=='직접입력') fm.auto_text.value = '';

        else fm.auto_text.value = txt;

      }

    </script>

    <!-- 셀렉트박스 선택시 - 텍스트박스 자동 입력  -->

    <script type="text/javascript">

    function MM_showHideLayers() { //v9.0

      var i,p,v,obj,args=MM_showHideLayers.arguments;

      for (i=0; i<(args.length-2); i+=3)

        with (document) if (getElementById && ((obj=getElementById(args[i]))!=null)) { v=args[i+2];

          if (obj.style) { obj=obj.style; v=(v=='show')?'block':(v=='hide')?'none':v; }

          obj.display=v; }

        }

    function MM_findObj(n, d) { //v4.01

      var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {

        d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}

        if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];

        for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);

          if(!x && d.getElementById) x=d.getElementById(n); return x;

      }

    /*

     * 주소 검색을 위한 function

     * */

     var addrToCoordApiAddr = "http://apis.daum.net/local/geo/addr2coord?apikey=";

     var coordToAddrApiAddr = "http://apis.daum.net/local/geo/coord2addr?apikey=";

     var addrSearchCallback = "pongSearch";

     var searchResultBody = "searchResultBody";

     var searchResultHeader = "searchResultH";

     var roadViewAddrHeader = "rvAddr";

     var API_KEY = "306678a15ccad514fa75a3b1ae02b091";

     var lAPI_KEY = "306678a15ccad514fa75a3b1ae02b091";

    var marker;   //주소 선택시 생기는 마커

    var mark;   //click 시 생기는 마커

    function searchPosition(id){

      var query = $("#" + id).val();

      /*

      if(query == null || query == "" || query == "주소검색"){

        alert("검색어를 입력해 주세요");

        return;

      }*/

      MM_showHideLayers('searchResultBody','','show');

      pingSearch(query);

    }
    /*

     * 주소 검색을 위한 api 요청

     * */

     function pingSearch(query){

      var oScript = document.createElement("script");

      oScript.type = "text/javascript";

      oScript.charset = "utf-8";

      oScript.src = addrToCoordApiAddr + lAPI_KEY + "&output=json&callback=" + addrSearchCallback + "&q=" + encodeURI(query);

      document.getElementsByTagName("head")[0].appendChild(oScript);

    }

    /*

     * 주소 검색 callback method

     * */

     function pongSearch(data){

      var resultForm = document.getElementById(searchResultBody);

      resultForm.innerHTML = "";

      if(!data.channel || data.channel.item.length <= 0){

        resultForm.innerHTML = "검색 결과가 없습니다.";

        return ;

      }else{

        var i;

        for (i = 0; i < data.channel.item.length; i++){

          var house_box = "housebox"+i;

          var titles = data.channel.item[i].title;

          var newtitles =data.channel.item[i].localName_1+" "+data.channel.item[i].localName_2+" "+data.channel.item[i].newAddress;

          var title_re =  titles.split("&lt;b&gt;").join("<b>");

          title_re =  title_re.split("&lt;/b&gt;").join("</b>");

          resultForm.innerHTML += "<div class='addrRbox'><div class='pcaddrResult'>"+ title_re + "<br>"+newtitles+"</div><div id='"+house_box +"' class='houseResult' ></div></div>";

          if((data.channel.item[i].mainAddress>0)&&data.channel.item[i].localName_3){

            search_is_house(i,data.channel.item[i].point_y,data.channel.item[i].point_x,titles,newtitles,data.channel.item[i].isNewAddress);

          }

        }

        resultForm.innerHTML +="<div class='addrRbox'><div class='pcaddrResult' style='line-height:52px; '> 검색 결과가 없습니다.</div><div id='addr_find2_go' class='houseResult'style='line-height:52px;text-align:right; ' onclick='open_addrmap()' ><i class='nice01 nice-map-check size17'></i> </div></div>";

        /*document.getElementById(searchResultHeader).innerHTML = "<span class='addrResultH'>" +

        "주소검색 -" + "<span class='redNum'> " + i + "</span>건"  + "</span>";*/

      }

    }

    function search_is_house(nums,lat,lng,addr1,addr2,isNewAddres){

      //alert(isNewAddres);

      var house_is_target = "#housebox"+nums;

      var url = '<?php echo G5_URL?>/house_reg_is_list.php';

      $.post(url,

        {   isnewaddr:isNewAddres,

          addr1:addr1,

          addr2:addr2,

          lat:lat,

          lng:lng

        },

        function(data){

          $(house_is_target).html(data);

        }, "html");

    }

    /*

     * 검색된 주소 클릭시 오른쪽 맵에 마커 표시

     * */

     function house_reg_searchMark(lat,lng,jibeon,doro,on,nh_no,reg_ok){

      if(nh_no == 1){ //등록된 건물이 있을 경우

        if(reg_ok == "1"){

          var url = "<?php echo G5_URL?>/house_member_join.json.php";

          var params ={nh_no : nh_no}

          $.ajax({

            type :"POST",

            url : url,

            dataType : "json",

            data:params,

            success:function(data){

              if(data.isok == "1")

                location.href="./room_reg_form.php?nh_no=" + nh_no;

            }

          });

        }

      }else{

        $("#house_reg_posy").val(lat);

        $("#house_reg_posx").val(lng);

        if(on =="N"){

          $("#house_reg_jibeon_addr").val(jibeon);

          $("#house_reg_road_addr").val(doro);

        }else{

          $("#house_reg_jibeon_addr").val(doro);

          $("#house_reg_road_addr").val(jibeon);

        }

        MM_showHideLayers('searchResultBody','','hide');

      }

      /*if(mark != null)

        mark.setVisible(false);

      var po = new daum.maps.LatLng(lat, lng);

      map.setCenter(po);

      if(marker != null)

        marker.setVisible(false);

      marker = new daum.maps.Marker({

        position: po

      });

      marker.setMap(map);

      $("#latitude").val(lat);

      $("#longitude").val(lng);*/

     //

     //  var nt_level = document.mapsearchhidden.nt_level.value;

     //  init(lat,lng,nt_level,'op');

     // document.location="./map_index.php?nt_id=nt_ccd&nt_posx="+lng+"&nt_posy="+lat+"&nt_level="+level;

    }

    /*

     * 검색창 클릭시 style sheet class 변경

     */

     function setInputLayout(target){

      var q = document.getElementById(target);

      q.value = '';

      q.setAttribute('class','focusInput');

    }



    </script>

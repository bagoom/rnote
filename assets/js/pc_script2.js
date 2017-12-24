
$(function() { $("input:text").keydown(function(evt) { if (evt.keyCode == 13) return false; }); });



    // 매매탭에서 항목추가 스크립트
 
    var rand = $('.rand_wrap');
    var cloneNumber = 100;
    var cloneList = [];

    setTimeout(function(){
    var cloneLength = $('tbody[class*="clone"]').length
    cloneNumber = 100 + cloneLength
  }, 1500)

    $(".sale_rand_add").click(function(){
      if ($(".rand_wrap").hasClass("clone"+(cloneNumber-1))){
        var clone =  rand.clone().insertAfter('.rand_wrap'+'.clone'+(cloneNumber-1));
      }else{
        var clone =  rand.clone().insertAfter('.rand_wrap');
      }
      clone.addClass('clone'+cloneNumber);
      var area_p = $(clone).find("#wr_area_p3").attr("name","wr_area_p" + cloneNumber);
      var area_m = $(clone).find("#wr_area_m3").attr("name","wr_area_m" + cloneNumber);
      var wr_address_sale = $(clone).find("#wr_address_sale3").attr("name","wr_address_sale" + cloneNumber);
      
     


     $('.clone'+cloneNumber +  ' input').val('');
      $('.rand_wrap').css("border-top","2px solid #555");
      $('.clone'+cloneNumber).css({"display":"table-header-group", "margin": "5px"});
      $('.sale_rand_wrap .rand_wrap:last-child').css("border-bottom","none");

          $(".box_del").click(function(){
            console.log(clone);
              clone.remove();
          });


            $(".rand_wrap").find("#wr_area_p3").each(function(){
                $(this).keyup(function(){
                    //alert("here")
                    calculateSum();
                });
            });


            $(".rand_wrap").find("#wr_area_m3").each(function(){
                $(this).keyup(function(){
                    calculateSumReverse();
                });
            });
    cloneNumber ++;
  });

  $('#wr_area_p2 ').on('keyup', function(){
    calculateSum();
      $('#wr_area_m2').val(parseFloat($(this).val()*3.3).toFixed(1))
  });
  $('#wr_area_m2 ').on('keyup', function(){
    calculateSumReverse();
      $('#wr_area_p2').val(parseFloat($(this).val()/3.3).toFixed(1))
  });

  function calculateSum()
  {
      var sum=0;
      var sum2=0;

      $(".rand_wrap, .rand_wrap_basic").each(function(){
        $(this).find('#wr_area_p2,#wr_area_m2,#wr_area_p3,#wr_area_m3').each(function()  {
          if(!isNaN(this.value)&&this.value.length!=0)
          {
            val_change = parseFloat($("#wr_area_p2").val()*3.3).toFixed(1)
            sum=parseInt($("#wr_area_p2").val());
            sum2=parseFloat(val_change);
          }
        });

      });
     $("#wr_area_p_all").val(sum)
      $("#wr_area_m_all").val(sum2)
      $('#wr_p_sale_price').val(($("#wr_sale_price2").val()/$("#wr_area_p_all").val()).toFixed(1))
      $('.clone'+(cloneNumber-1) +  ' .sale_rand #wr_area_m3').val(val_change);

  }

  function calculateSumReverse()
  {
      var sum=0;
      var sum2=0;

      $(".rand_wrap, .rand_wrap_basic").each(function(){
        $(this).find('input[id="wr_area_m2"]').each(function()  {
          if(!isNaN(this.value)&&this.value.length!=0)
          {
            val_change = parseFloat(this.value/3.3).toFixed(1)
          
          }
        });

      });
      $("#wr_area_p_all").val(sum2)
      $("#wr_area_m_all").val(sum)
      $('#wr_p_sale_price').val(($("#wr_sale_price2").val()/$("#wr_area_p_all").val()).toFixed(1))
      $('.clone'+(cloneNumber-1) +  ' .sale_rand #wr_area_p3').val(val_change);
      sum+=parseFloat(this.value)
      sum2+= parseFloat(val_change)

  }

$('.sale_rand_wrap ').find('input[name="wr_area_p"]').on('keyup', function(){
    $('#wr_area_p_all').val(parseFloat($(this).val()).toFixed(1))
});
$('.sale_rand_wrap ').find('input[name="wr_area_m"]').on('keyup', function(){
    $('#wr_area_m_all').val(parseFloat($(this).val()).toFixed(1))
});
//  연순수익=연임대수익-연이자


 // 매도가 입력시 매도가 나누기 총면적으로 평당가격 입력
 
$('#wr_area_p_all,#wr_area_m_all').on('keyup', function(){
    $('#wr_p_sale_price').val(($('#wr_sale_price2').val()/$("#wr_area_p_all").val()).toFixed(1))
    Profit_Rate();
});



$('#wr_sale_price2').on('keyup', function(){
    $('#wr_p_sale_price').val(($(this).val()/$("#wr_area_p_all").val()).toFixed(1))
    Profit_Rate();
});

//  평당가격 입력시 평당가격 곱하기 총면적으로 매도가 입력
$('#wr_p_sale_price').on('keyup', function(){
    $('#wr_sale_price2').val(parseInt($(this).val())*parseInt($("#wr_area_p_all").val()))
    Profit_Rate();
});


//  융자금액 입력시 금리값이 없다면 융자금액 곱하기 금리(0.04%) 곱하기
var cal_target = "#wr_loan2,#wr_sale_price2,#wr_total_rfee2,#wr_int_rate2,#wr_sale_deposit,#wr_year_rate,#wr_year_int,#wr_p_sale_price";

$(cal_target).on('keyup', function(){
  if($('#wr_int_rate2').val() == ''){
    $('#wr_year_int').val(parseInt($('#wr_loan2').val())*0.04);
    $('#wr_mon_int').val(parseInt($('#wr_year_int').val())/12);
    $('#wr_year_income').val(parseInt($("#wr_year_rate").val())-parseInt($("#wr_year_int").val()))

  }else{
    $('#wr_year_int').val(parseInt($('#wr_loan2').val())*($("#wr_int_rate2").val()*0.01));
    $('#wr_mon_int').val(parseInt($('#wr_year_int').val())/12);
  }
  $('#wr_year_rate').val(parseInt($("#wr_total_rfee2").val())*12)
  Profit_Rate();
  $('#wr_year_income').val(parseInt($("#wr_year_rate").val())-parseInt($("#wr_year_int").val()))
  $('#wr_mon_income').val(parseInt($("#wr_total_rfee2").val())-parseInt($("#wr_mon_int").val()))
  $('#wr_m_rate_guess').val((parseInt($("#wr_total_rfee2").val())*200)+parseInt($("#wr_sale_deposit").val()))
  $('#wr_silinsu').val($("#wr_sale_price2").val()-$("#wr_sale_deposit").val()-$("#wr_loan2").val())
  });


function Profit_Rate() {
  // 수익률계산
     var aaa =
     (parseInt($('#wr_year_rate').val()) -
     parseInt($('#wr_year_int').val()))*100 ;
     var bbb =
     (parseInt($('#wr_sale_price2').val()) -
     parseInt($('#wr_loan2').val()) -
     parseInt($('#wr_sale_deposit').val()) );
    //  var bbb = d;
    $('#wr_profit_rate').val((aaa / bbb).toFixed(2));
}

  //   $('#wr_int_rate2').on('keyup', function(){
  //   $('#wr_year_int').val(parseInt($('#wr_loan2').val())*(parseInt($('#wr_int_rate2').val())/100));
  //   $('#wr_mon_int').val(parseInt($('#wr_year_int').val())/12);
  // });

// wr_profit_rate :
// (wr_year_rate - wr_year_int)x100 / (wr_sale_price - wr_loan2 - wr_sale_deposit)
//
// 수익률:
// (연수익-연이자)x100 / (매매가-융자금-보증금) , 단위는 %




    // 전화번호 11자리 10자리 입력시 '-' 생성
    var contact = '#wr_renter_contact,#wr_lessor_contact';
    $(contact).on('blur' ,function(){
    var contact_val = $(this).val();
    if(contact_val.length ==11){
    $(this).val($(this).val().replace(/(\d{3})\-?(\d{4})\-?(\d{4})/,'$1-$2-$3'))
    }
    else if(contact_val.length ==10){
    $(this).val($(this).val().replace(/(\d{3})\-?(\d{3})\-?(\d{4})/,'$1-$2-$3'))
    }
    });

  // 층수 -1 입력시 지하1층으로 변경
    $("#fwrite").submit(function(){
      if ($(".under_rand").is(':checked')){
        var minus = -$('#wr_floor').val();
          $("#wr_floor").val(minus);
      }
    });

    // 추천업종 추가
    function include(arr, obj) {
    for(var i=0; i<=arr.length-1; i++) {
        if (arr[i] == obj) return true;
        }
    }
    var b;
    $( document ).ready(function() {
     var target = $(".check_list_wrap label .labelauty-checked");
     var target2 =  $(".check_list_wrap label");
     var a =  "<?=$write[wr_rec_sectors]?>"
     b = a.split(' ');
     b.pop();
    for (var i = 0; i < target.length; i++) {
      if(include(b, target[i].innerHTML.replace(' ',''))){
        $(target[i]).attr('aria-checked', true)
        $(target2[i]).prev().attr('checked', true ) ;
        $(target2[i]).attr('aria-checked', true ) ;
        $('#wr_rec_job').append('<li>'+ target[i].innerHTML + '</li>')
       }
    }

    if($('#wr_floor').val()<0){
      $('.under_rand').attr('checked', true ) ;
    }

    });
    // 추천업종 팝업창 수정 스크립트
    $("#overlay-close,.rec_close").click(function(){
    $('#wr_rec_job li').remove();
    var test = $("[aria-checked=true]").children('.labelauty-checked');
    var test_html = test.html();

    var list = []

    for(var i = 0; i< test.length; i++){
    list.push(test[i].innerHTML)
    $('#wr_rec_job').append('<li>'+ list[i] + '</li>')
    $("#search_box").val(test.text());
    }
    });



    //매매 항목추가 수정 스크립트
    $("body").ready(function(){
      var cloneNumber = 100;
      var wr_address_sale_val = $("input[name='wr_address_sale99']").val().split(',');
      var wr_area_p_val = $("input[name='wr_area_p99']").val().split(',');
      var wr_area_m_val = $("input[name='wr_area_m99']").val().split(',');

      for(var i = 0; i< wr_address_sale_val.length; i++){
       var clone = $('#doo').clone()
       if (i ==0 ){
        clone.insertAfter('.rand_wrap_basic');
        $(".rand_wrap_basic input[name='wr_address_sale99']").val(wr_address_sale_val[i])
        $(".rand_wrap_basic input[name='wr_area_p99']").val(wr_area_p_val[i])
        $(".rand_wrap_basic input[name='wr_area_m99']").val(wr_area_m_val[i])
       }
       else{
        clone.insertAfter($('.rand_wrap.clone'+(cloneNumber-1)));
      }


      clone.removeClass("clone100");
      clone.addClass("clone"+cloneNumber);
      // 매매주소 오브젝트
      $(".clone"+cloneNumber+" input[name='wr_address_sale100']").attr("name","wr_address_sale");
      $(".clone"+cloneNumber+" input[name='wr_address_sale']").attr("name","wr_address_sale"+cloneNumber);
      // 매매평수 오브젝트
      $(".clone"+cloneNumber+" input[name='wr_area_p100']").attr("name","wr_area_p");
      $(".clone"+cloneNumber+" input[name='wr_area_p']").attr("name","wr_area_p"+cloneNumber);
      //  매매m2 오브젝트
      $(".clone"+cloneNumber+" input[name='wr_area_m100']").attr("name","wr_area_m");
      $(".clone"+cloneNumber+" input[name='wr_area_m']").attr("name","wr_area_m"+cloneNumber);
      
      var clone_child = $(".clone"+cloneNumber+ " #wr_address_sale3")
      var clone_child2 = $(".clone"+cloneNumber+ " #wr_area_p3")
      var clone_child3 = $(".clone"+cloneNumber+ " #wr_area_m3")


      clone_child.val(wr_address_sale_val[i+1])
      clone_child2.val(wr_area_p_val[i+1])
      clone_child3.val(wr_area_m_val[i+1])

      $('.rand_wrap').css("border-top","2px solid #555");
      $('.clone'+(cloneNumber-1)).show(); 
      cloneNumber ++;
    }

      clone.remove();
     
     
    })
    


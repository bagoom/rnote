
$(function() { $("input:text, input:tel").keydown(function(evt) { if (evt.keyCode == 13) return false; }); });

// $("input:text").on('keyup', function(){
//놔뚜지일단 17일
//   if(isNaN($("#wr_year_int").val())){
//     $("#wr_year_int").val(" ");
//     console.log("true");``
//   }else{
//       console.log("false");
//   }
// });

    // 매매탭에서 항목추가 스크립트
    var rand = $('.rand_wrap');
    var cloneNumber = 100;
    var cloneList = [];

    $(".sale_rand_add").click(function(){
      if ($(".rand_wrap").hasClass("clone"+(cloneNumber-1))){
        var clone =  rand.clone().insertAfter('.rand_wrap'+'.clone'+(cloneNumber-1));
      }else{
        var clone =  rand.clone().insertAfter('.rand_wrap');
      }
      clone.addClass('clone'+cloneNumber);
     $('.clone'+cloneNumber +  ' input').val('');
      $('.rand_wrap').css("border-top","2px solid #555");
      $('.clone'+cloneNumber).css({"display":"table-header-group", "margin": "5px"});
      $('.sale_rand_wrap .rand_wrap:last-child').css("border-bottom","none");

          $(".box_del").click(function(){
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
        $(this).find('input[name="wr_area_p"]').each(function()  {
          if(!isNaN(this.value)&&this.value.length!=0)
          {
            val_change = parseFloat(this.value*3.3).toFixed(1)
            sum+=parseFloat(this.value);
            sum2+=parseFloat(val_change);
          }
        });

      });
      $("#wr_area_p_all").val(sum.toFixed(1));
      $("#wr_area_m_all").val(sum2.toFixed(1));
      $('#wr_p_sale_price').val(($("#wr_sale_price2").val()/$("#wr_area_p_all").val()).toFixed(1))
      $('.clone'+(cloneNumber-1) +  ' .sale_rand #wr_area_m3').val(val_change);

  }

  function calculateSumReverse()
  {
      var sum=0;
      var sum2=0;

      $(".rand_wrap, .rand_wrap_basic").each(function(){
        $(this).find('input[name="wr_area_m"]').each(function()  {
          if(!isNaN(this.value)&&this.value.length!=0)
          {
            val_change = parseFloat(this.value/3.3).toFixed(1)
            sum+=parseFloat(this.value)
            sum2+= parseFloat(val_change)
          }
        });

      });
      $("#wr_area_p_all").val(sum2)
      $("#wr_area_m_all").val(sum)
      $('#wr_p_sale_price').val(($("#wr_sale_price2").val()/$("#wr_area_p_all").val()).toFixed(1))
      $('.clone'+(cloneNumber-1) +  ' .sale_rand #wr_area_p3').val(val_change);

  }


$('.sale_rand_wrap ').find('input[name="wr_area_p"]').on('keyup', function(){
    $('#wr_area_p_all').val(parseFloat($(this).val()).toFixed(1))
});
$('.sale_rand_wrap ').find('input[name="wr_area_m"]').on('keyup', function(){
    $('#wr_area_m_all').val(parseFloat($(this).val()).toFixed(1))
});
//  연순수익=연임대수익-연이자

$('#wr_year_rate,#wr_year_int').on('keyup', function(){
    $('#wr_year_income').val(parseInt($("#wr_year_rate").val())-parseInt($("#wr_year_int").val()))
});
$('#wr_loan2').on('blur', function(){
    $('#wr_year_income').val(parseInt($("#wr_year_rate").val())-parseInt($("#wr_year_int").val()))
});

 // 매도가 입력시 매도가 나누기 총면적으로 평당가격 입력
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
    $('#wr_year_income').val(parseInt($("#wr_year_rate").val())-parseInt($("#wr_year_int").val()))
  }
  $('#wr_mon_income').val(parseInt($("#wr_total_rfee2").val())-parseInt($("#wr_mon_int").val()))

  $('#wr_m_rate_guess').val((parseInt($("#wr_total_rfee2").val())*200)+parseInt($("#wr_sale_deposit").val()))
  $('#wr_year_rate').val(parseInt($("#wr_total_rfee2").val())*12)
  $('#wr_silinsu').val($("#wr_sale_price2").val()-$("#wr_sale_deposit").val()-$("#wr_loan2").val())
  Profit_Rate();
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
    $('#wr_profit_rate').val(aaa / bbb);
    // console.log($('#wr_profit_rate').val());
}

    $('#wr_int_rate2').on('keyup', function(){
    $('#wr_year_int').val(parseInt($('#wr_loan2').val())*(parseInt($('#wr_int_rate2').val())/100));
    $('#wr_mon_int').val(parseInt($('#wr_year_int').val())/12);
  });

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



  // $('#wr_rent_p').on('keydown', function(){
  //     $('#wr_mt_cost').val(parseInt($(this).val())*parseInt($("#wr_mt_cost_p").val()))
  // });



    $(".option_toggle").click(function(){
    $(".option_contents").toggle();
        });

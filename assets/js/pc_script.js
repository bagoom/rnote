

    // // 폼그룹을 클릭해도 해당 inpt 포커스 됨.
    // $('.form-group').click(function(){
    //   var child =  $(this).children("div").children("input");
    // child.focus();
    // });

    // 층수 -1 입력시 지하1층으로 변경

    $(".under_floor").click(function(){
      console.log("ddd");
      var minus = -$('#wr_floor').val();
        $("#wr_floor").val(minus);
    })

      $("#fwrite").submit(function(){
        if ($(".under_floor").click(':click')){
          console.log("ddd");
          var minus = -$('#wr_floor').val();
            $("#wr_floor").val(minus);
        }
      });

    // 매매탭에서 항목추가 스크립트
    var rand = $('.rand_wrap');
    var cloneNumber = 100;
    var cloneList = [];

    $(".sale_rand_add").click(function(){
      var clone =  rand.clone().appendTo('.sale_rand_wrap');
    clone.addClass('clone'+cloneNumber);
     $('.clone'+cloneNumber +  ' input').val('');
      $('.rand_wrap').css("border-top","2px solid #555");
      $('.clone'+cloneNumber).css("display","block");
      $('.sale_rand_wrap .rand_wrap:last-child').css("border-bottom","none");

      $(document).ready(function()
        {
          $(".box_del").click(function(){
              clone.remove();
              calculateSum();

          });
            $(".rand_wrap, .rand_wrap_basic").find("#wr_area_p2, #wr_area_p3").each(function(){
                $(this).keyup(function(){
                    //alert("here")
                    calculateSum();
                    console.log("dddd");

                });
            });

            $(".rand_wrap, .rand_wrap_basic").find("#wr_area_m2, #wr_area_m3").each(function(){
                $(this).keyup(function(){
                    calculateSumReverse();
                });
            });
        });


    cloneNumber ++;
  });

  function calculateSum()
  {
      var sum=0;

      $(".rand_wrap, .rand_wrap_basic").each(function(){
        $(this).find('input[name="wr_area_p"]').each(function()  {
          if(!isNaN(this.value)&&this.value.length!=0)
          {
            val_change = parseInt(this.value*3.3)
            sum+=parseInt(this.value);
          }
        });

      });
      $("#wr_area_p_all").val(sum);
      $('.clone'+(cloneNumber-1) +  ' .sale_rand #wr_area_m3').val(val_change);

  }
  function calculateSumReverse()
  {
      // var sum=0;

      $(".rand_wrap, .rand_wrap_basic").each(function(){
        $(this).find('input[name="wr_area_m"]').each(function()  {
          if(!isNaN(this.value)&&this.value.length!=0)
          {
            val_change = parseInt(this.value/3.3)
            // sum+=parseInt(this.value);
          }
        });

      });
      // $("#wr_area_p_all").val(sum);
      $('.clone'+(cloneNumber-1) +  ' .sale_rand #wr_area_p3').val(val_change);

  }

$('.sale_rand_wrap ').find('input[name="wr_area_p"]').on('keyup', function(){
    $('#wr_area_p_all').val(parseInt($(this).val()))
});
//  연순수익=연임대수익-연이자
$('#wr_year_rate,#wr_year_int').on('keyup', function(){
    $('#wr_year_income').val(parseInt($("#wr_year_rate").val())-parseInt($("#wr_year_int").val()))
});
$('#wr_loan2').on('blur', function(){
    $('#wr_year_income').val(parseInt($("#wr_year_rate").val())-parseInt($("#wr_year_int").val()))
});

//  매도가 입력시 매도가 나누기 총면적으로 평당가격 입력
$('#wr_sale_price2').on('keyup', function(){
    $('#wr_p_sale_price').val(parseInt($(this).val())/parseInt($("#wr_area_p_all").val()))
});
//  평당가격 입력시 평당가격 곱하기 총면적으로 매도가 입력
$('#wr_p_sale_price').on('keyup', function(){
    $('#wr_sale_price2').val(parseInt($(this).val())*parseInt($("#wr_area_p_all").val()))
});
//  융자금액 입력시 금리값이 없다면 융자금액 곱하기 금리(0.04%) 곱하기
$('#wr_loan2,#wr_sale_price2,#wr_total_rfee2,#wr_int_rate2').on('keyup', function(){
  if($('#wr_int_rate2').val() == ''){
    $('#wr_year_int').val(parseInt($('#wr_loan2').val())*0.04);
    $('#wr_mon_int').val(parseInt($('#wr_year_int').val())/12);

     var aaa =
     (parseInt($('#wr_year_rate').val()) -
     parseInt($('#wr_year_int').val()))*100 ;
     var bbb =
     (parseInt($('#wr_sale_price2').val()) -
     parseInt($('#wr_loan2').val()) -
     parseInt($('#wr_sale_deposit').val()) );


    //  var bbb = d;
    $('#wr_profit_rate').val(aaa / bbb);
    console.log($('#wr_profit_rate').val());


    }
    $('#wr_int_rate2').on('keyup', function(){
    $('#wr_year_int').val(parseInt($('#wr_loan2').val())*(parseInt($('#wr_int_rate2').val())/100));
    $('#wr_mon_int').val(parseInt($('#wr_year_int').val())/12);
  });
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
    $("#overlay-close").click(function(){
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


  function valchange() {
      var a = $("#wr_rent_p").val();
      var b = $("#wr_mt_cost_p").val();
      var c = $("#wr_mt_cost").val(a*b);
      return c;

  };


    $(".option_toggle").click(function(){
    $(".option_contents").toggle();
        });


    var wr_premium_b = $("#wr_premium_b");
    $("#fwrite").submit(function(){
      if (wr_premium_b.val() == ''){
      var text = "No.";
      var possible = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXTZ";
      for (var i = 0; i < 6; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));
      $('#wr_code').val(text);
    }
  });

    //  권리금 절충가 입력시 코드생성
     function randomString() {
     var premium_o = document.getElementById('wr_premium_o').value;
     var premium_b = document.getElementById('wr_premium_b').value;
     var premium_result = (premium_o-premium_b)+"";
     var chars = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXTZ";
     var string_length = 6;
     var randomstring = 'No.';

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
     if(premium_b){
     return printstring;
     }else{
       return "";
     }
     }

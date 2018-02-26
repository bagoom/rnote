function address() {
  var list_val = 0;
  $(".address_sale").each(function() {
      list_val = $('.address_sale').map(function() { return $(this).val() }).get().join(',');
  });
  $("#wr_address_sale").val(list_val);
}

function p_sum() {
    var total = 0;
    var list_val = 0;
    $(".area_p").each(function() {
      var val = this.value;
        total += val == "" || isNaN(val) ? 0 : parseInt(val);
        list_val = $('.area_p').map(function() { return $(this).val() }).get().join(',');
    });

    $("#wr_area_p").val(list_val);
    $("#wr_area_p_all").val(total);
    
  }

function m_sum() {
    var total = 0;
    var p_change = 0;
    $(".area_m").each(function() {
      var val = this.value;
      total += val == "" || isNaN(val) ? 0 : parseInt(val);
      list_val = $('.area_m').map(function() { return $(this).val() }).get().join(',');
    });
    $("#wr_area_m").val(list_val);
    $("#wr_area_m_all").val(total);
  };


  $(function() {
    var $to_clone = $('.clone_wrap').first().clone();
    $(".sale_rand_add").on('click',  function() {
        var $tr = $(this).siblings('.clone_wrap').last();
        var $clone = $to_clone.clone();
      $clone.find(':text').val('');
      $tr.after($clone);
    });


    $(document).on('click', '.box_del', function() {
      var $table = $('.clone_wrap');
      console.log($table.length);
      if ($table.length > 1) $table.last().remove(); // leave the first
      p_sum()
      m_sum()
    });
  
    $(document).on("keyup", ".area_p, .area_m", function() {
      var $find_m = $(this).closest("td").siblings("td").find(".area_m");
      var $find_p = $(this).closest("td").siblings("td").find(".area_p");
      var  val = $(this).val();
      $find_m.val((val*3.3).toFixed(2))
      $find_p.val((val/3.3).toFixed(2))
      p_sum()
      m_sum()
    });
  });
  $(document).on("keyup", ".address_sale", function() {
  address();

  
})

  if( wr_id != '0'){
    var wr_area_p_array = [];
    var wr_area_m_array = [];
    var wr_address_array = [];
    wr_area_p_array =  $("#wr_area_p").val().split(',');
    wr_area_m_array =  $("#wr_area_m").val().split(',');
    wr_address_array =  $("#wr_address_sale").val().split(',');
  
  for (i=0; i<=wr_area_p_array.length-1; i++) {
    var $to_clone = $('.clone_wrap').first().clone();
    var $tr = $('.clone_wrap').last();
    var $clone = $to_clone.clone();
    $clone.find(':text').val('');
    $clone.find(".area_p").val(wr_area_p_array[i]);
    $clone.find(".area_m").val(wr_area_m_array[i]);
    $clone.find(".address_sale").val(wr_address_array[i]);
    $tr.after($clone);
    } // exit for
    $('.clone_wrap').first().remove()
    
  } // exit if
  
$("#room_confirm_btn").click(function(){
    var floor_input = $("#wr_input_row").val();
    var room_input = $("#wr_input_col").val();
    $(".auto_room_add ul").remove();

    

    $(".auto_room_input").animate({top: "-0px" , opacity:  '0'},300 ,  function(){
        for (i = 1; i <= floor_input; i++){
            var floor_default = ''+i;
            var clone_floor = "<ul class="+floor_default+"></ul>";
            $(clone_floor).clone().prependTo('.auto_room_add');
            
    
            for(k=1; k <= room_input; k++){
                var room_default = floor_default+'0'+k+"호";
                var clone_room = "<li data=''>"+room_default+"</li>";
                
                $(clone_room).clone().appendTo($("."+floor_default));
            } 
        }
        
        $(".auto_room_add li").each(function(){
            var li_this = $(this);
            $(this).click(function(){
                $(".room_info_right").show();
                $(".room_info_right h3").text($(this).text()+ "상세정보");
                $(".auto_room_add li").removeClass("active");
                $(this).addClass("active");

                $(".room_info_submit").click(function(){
                   var data5 = $(li_this).data( "key",  {
                       wr_rent_type: $("input[name='wr_rent_type']:checked").val(), 
                       wr_room_type: $("input[name='wr_room_type']:checked").val(), 
                       wr_rent_deposit: $("input[name='wr_rent_deposit']").val(), 
                       wr_m_rate: $("input[name='wr_m_rate']").val(), 
                       wr_area_p: $("input[name='wr_area_p']").val(), 
                       wr_area_m: $("input[name='wr_area_m']").val(), 
                       wr_mt_separate: $("input[name='wr_mt_separate']").val(), 
                       wr_mt_elec: $("input[name='wr_mt_elec']:checked").val(), 
                       wr_mt_water: $("input[name='wr_mt_water']:checked").val(), 
                       wr_mt_gas: $("input[name='wr_mt_gas']:checked").val(), 
                       wr_mt_tv: $("input[name='wr_mt_tv']:checked").val(), 
                       wr_mt_internet: $("input[name='wr_mt_internet']:checked").val()
                    });
                   $(li_this).attr("data",JSON.stringify( $(li_this).data("key")));
                   
                   console.log( $(li_this).attr("data"))
                });
            })

        })
        $(this).css("display","none") ;
    })
    
});


$(".ddong").click(function(){
    var tags = Array.from($('.auto_room_add li'));
    var foo = [];

    for ( var i = 0; i < tags.length; i++){
        if($(tags[i]).attr('data').length==0){
            foo.push({})
        }
        else{
            foo.push(JSON.parse($(tags[i]).attr('data')))
        }
    }
  console.log(foo)
    $.ajax({
        type : "POST",
        url : g5_bbs_url+"/ddong.php",
        data: JSON.stringify({"myData": foo}),
        dataType : "text",
        // traditional: true,
        error : function(error) {
        alert(JSON.stringify(error));
        },
        success : function(data) {
            $('.auto_room_output').html(data);
            console.log(data);
        }
        });
});

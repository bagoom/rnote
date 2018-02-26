$("#room_confirm_btn").click(function(){
    var floor_input = $("#wr_input_row").val();
    var room_input = $("#wr_input_col").val();
    $(".auto_room_output ul").remove();

    

    for (i = 1; i <=floor_input; i++){
        var floor_default = ''+i;
        var clone_floor = "<ul class="+floor_default+"></ul>";
        $(clone_floor).clone().appendTo('.auto_room_output');
        

        for(k=1; k <= room_input; k++){
            var room_default = floor_default+'0'+k;
            var clone_room = "<li>"+room_default+"</li>";
            
            $(clone_room).clone().appendTo($("."+floor_default));
        }
    }

});

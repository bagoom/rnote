
$(document).ready( function(){

            alert(1);
            listAjax(1);

});

function listAjax(no){

		if(no){ alert(1);

		$('#ajaxlist_tbody').html('<img src="<?=$board_skin_url?>/img/pageloading01.gif" width=60px />');

		$.ajax({
			type: "POST",
			url: "<?=$board_skin_url?>/list.ajax.php",
			data: "bo_table=<?=$bo_table?>&pg="+ no + "&sop=<?=$sop?>&stx=<?=$stx?>&sca=<?=$sca?>&sfl=<?=$sfl?>",
			cache: false,
			success: function(html){  //alert( html );

				if(html.indexOf("td_num") == -1){

			    }else{
					$("#updates").append(html);

				}

		    }
		});

		}
		else{

				alert('end');

		}





}

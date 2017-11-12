<?php
include_once('./_common.php');

/*
	프로그램 : srd_pushmsg
	그누보드5의 알림서비스 플러그인
	ver . beta 0.1
	개발자 : salrido@korea.com
	그누보드 : rido
	개발일 : 2015 05 29
	- 세상만사 다 귀찮다 -_- 킁 먹고살기 힘들다.
	- 소스 수정 / 사용은 알아서들 하시고 재배포 및 소스포함시 저작권만 유지해주세요
	- 수정시 수정사항을 메일로 피드백 해주시면 감사하겠습니다.
*/
?>
<style>
.header .logo{
  padding-top:20px;
}
.black-bg{
  background: #222 !important;
  margin-top: 0 !important;
  padding: 0!important;
}
.wrapper{
  background: url(../../img/resister_img/register_bg.jpg);
  background-size: cover;
  overflow: hidden;
	margin-top: 75px !important;
}
.pushmsg_list {
	width: 650px;
	margin: 0 auto;
}
.list_first_wrap{
	width: 200px;
}
.pushmsg_list li{
  position: relative;
	padding: 15px 10px;
	background: rgba(19, 19, 19,0.8);
	border-radius: 5px;
	margin-bottom: 7px;
}
.pushmsg_list  li a{
	color: rgba(255,255,255,0.8) ;
	font-size: 18px;
}
.memo_list{
  position: relative;
}
.sir_sr{
  position: absolute;
  top:0;
  left: 0;
 width: 100%;
 display: none;
 background: rgba(59, 77, 184, 0.36) ;
}
.list_del{
  position: absolute;
  right: 25px;
  top: 50%;
  margin-top : -5.5px;
}
.sir_bw02{
 width: 620px;
 margin: 0 auto;
 margin-top:40px;
 padding: 30px 0;
}
.sir_bw02 button, .sir_bw02 input{
  width: 120px;
  padding: 15px;
  background: #222;
  border : 0;
  font-size: 16px;
  color:#fff;
}
.sir_b01_adm{
  background: #3b4db7 !important;
}
</style>
<?php
$g5['title']  = '전체 알림';

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
// 스타일은 그누보드 알림에서 뽀려옴 -_-;;; 만들기 귀찮음
add_stylesheet('<link rel="stylesheet" href="'.G5_URL.'/plugin/srd-pushmsg/style.css">', 0);

include_once(G5_PATH.'/_head.php');

if ($read) {
	$where  = " and msg_check = '{$read}'";
}

$sql_count = " select count(*) as cnt from {$g5['g5_srd_pushmsg']} where mb_id = '{$member['mb_id']}' {$where} and  msg_check != 'd'  ";
$row = sql_fetch($sql_count);
$total_count = $row['cnt'];

$rows = 10;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = "select * from {$g5['g5_srd_pushmsg']} where mb_id = '{$member['mb_id']}' and msg_check != 'd' {$where}  order by msg_id desc limit {$from_record}, {$rows}";
$result = sql_query($sql);
?>

<div id="">

<!-- <div class="sir_lc sir_lc02">
    <p>총 <?php echo $total_count?> 건, 알림 보관 기간은 <?php echo $del_day?>일입니다.</p><br>
</div> -->

<form name="fnewlist" method="post" id="sir_armv" action="#" onsubmit="return fnew_submit(this);" autocomplete="off">
<input type="hidden" name="read" value="">
<input type="hidden" name="page" value="<?php echo $page?>">
<input type="hidden" name="pressed" value="">
<input type="hidden" name="p_type" value="">

<div class="sir_bw02 sir_bw">
    <!-- <label for="all_chk" class="sir_sr">목록 전체</label>
    <input type="checkbox" id="all_chk"> -->
    <button type="button" class="all_chk sir_b01_adm">전체선택</button>
    <input type="submit" value="전체삭제" class="sir_b01_adm" data-type="del" >
    <button type="button" id="armv_all" class="sir_b01">전체보기</button>
    <button type="button" id="armv_read" class="sir_b01">읽은알림</button>
    <button type="button" id="armv_yet" class="sir_b01">안읽은알림</button>
</div>


<ul class="pushmsg_list armv_list">
	<?php
	while ($row = sql_fetch_array($result)) {
	?>
	<li data-from_case="<?php echo $row['msg_type']?>"  class="memo_list">
		<span class="list_chk">
			<label for="chk_bn_id_<?php echo $row['msg_id']?>" class="sir_sr"></label>
			<input type="checkbox" name="chk_bn_id[]" class="memo_check" value="<?php echo $row['msg_id']?>" id="chk_bn_id_<? echo $row['msg_id']?>" style="display:none;">
		</span>
		<input type="hidden" name="chk_g_ids[0]" class="hidden_ids" value="<? echo $row['msg_id']?>">
		<input type="hidden" name="chk_read_yn[0]" value="<?php echo $row['msg_check'] ?>">
		<?php
		if ($row['msg_check'] == 'y') {
			$check_class = 'list_read';
			$check_msg = '읽음';
		} else {
			$check_class = '';
			$check_msg = '읽기전';
		}
		?>
		<a href="<? echo $row['msg_link']?>" class="<?php echo $check_class?> list_link">
			<p class="list_first_wrap">
			<span class="list_time"><?php echo srd_date_return($row['msg_wdate'])?><?php// echo substr($row['msg_wdate'],0,10)?></span>
			<span class="list_stat"><?php echo $check_msg?></span>
			</p>
			<span class="list_tit"><?php echo $row['msg_subject']?><!--<em>9</em>--></span>
		</a>
		<a href="javascript:void(0);" class="list_del"><img src="<?php echo G5_URL?>/plugin/srd-pushmsg/images/ico_del.gif" alt="알림삭제"></a>
	</li>
	<?php  } // row end?>
	<? if($total_count == 0) {?>
	<li  class="pushmsg_list armv_list" style="color:#fff; text-align:center;">
		알림이 존재하지 않습니다.
	</li>
	<? } ?>
</ul>


<!-- <div class="sir_bw02 sir_bw">
    <button type="button" class="all_chk sir_b01_adm">전체선택</button>
    <input type="submit" value="선택삭제" class="sir_b01_adm" data-type="del">
    <input type="submit" value="읽음표시" class="sir_b01_adm" data-type="read">
</div> -->

</form>
<div style="margin:30px; 0"><?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['PHP_SELF'].'?'.$qstr.'&amp;page='); ?>
</div>

<script>
$(".sir_sr").css("height", $(".memo_list").innerHeight());
$(".all_chk").click(function(){
  $(".sir_sr").toggle();
});
/* sir에서 스크립트도 그냥 긁어다가 쓰고있음 차후 에러 발생시 수정 */
(function($){
    function push_redirect(e){
        var href = $(this).attr("href"),
            g_ids = $(this).siblings(".hidden_ids").val(),
            ph_type = $(this).parent().attr("data-from_case"),
            params = { format: 'json', w: 'redirect', g_ids : g_ids },
            $el = $(this),
            $blank = "";
        if (e.shiftKey) {
            $blank = "blank";
        }
        if( $blank == "blank"){
            window.open(href);
        }

		//메모는 더 이상 새창으로 뜨우지 않는다.
		//sir은 새창으로 띄우지 않으나 배포버전은 새창처리 함으로 기능을 살려준다.
        if( ph_type == "memo" && !$blank ){
			$.post(
				g5_url+"/plugin/srd-pushmsg/ajax.read_pushmsg.php",
				{
				'g_ids':g_ids
				},
				function(data) {
					if (data == 'update_success') {
						$el.addClass("list_read")
					   .find(".list_stat").text("읽음");
								win_memo( href );
					}
				}
			);
			return false;
        }

        if( $el.hasClass('list_read') ){ //읽음표시 클래스를 가지고 있다면
            if( !$blank ){
               document.location.href = href;
            }
        } else { //읽음표시 클래스를 가지고 있지 않다면 읽음표시로 업데이트 해준후 리다이렉트 한다.
		$.post(
			g5_url+"/plugin/srd-pushmsg/ajax.read_pushmsg.php",
			{
			'g_ids':g_ids
			},
			function(data) {
				if (data == 'update_success') {
					$el.addClass("list_read")
				   .find(".list_stat").text("읽음");
						if( !$blank ){
							document.location.href = href;
						}
				}
			}
		);
     }
        return false;
    }
    $('.all_chk').bind("click", function(){
        if (!$(this).data('toggle_enable')) {
            $(this).data('toggle_enable', true);
        } else {
            $(this).data('toggle_enable', false);
        }
        $('[name="chk_bn_id[]"]').attr('checked', $(this).data('toggle_enable') );
    });
    $('.pushmsg_list > li a.list_link').on("click", push_redirect); //리다이렉트 구문
    $('.pushmsg_list > li a.list_del').on("click", function(e){ //개별삭제시
        document.pressed = "삭제";
        $parent = $(this).parent("li");
        $('[name="chk_bn_id[]"]').attr('checked', false);
        $parent.find('[name="chk_bn_id[]"]').attr('checked', true);
        $("form[name='fnewlist']")
        .find("input[name='p_type']").val("del")
        .end()
        .trigger("submit");
    });
    $('#armv_all').bind('click', function(e){ //전체보기 클릭
        var url = "<?php echo G5_URL?>/plugin/srd-pushmsg/index.php?page=1";
        document.location.href = url;
    });
    $('#armv_read').bind('click', function(e){ //읽은 알림 클릭
        var url = "<?php echo G5_URL?>/plugin/srd-pushmsg/index.php?page=1&read=y";
        document.location.href = url;
    });
    $('#armv_yet').bind('click', function(e){ //안 읽은 알림 클릭
        var url = "<?php echo G5_URL?>/plugin/srd-pushmsg/index.php?page=1&read=n";
        document.location.href = url;
    });

    $("form[name='fnewlist'] input[type='submit']").bind("click", function(e){
        e.preventDefault();
        var p_type = $(this).attr("data-type")
            $form = $("form[name='fnewlist']");
        if( !p_type ){
            alert('어트리뷰티 data-type 빼먹었음 ㅠㅠ');
            return false;
        }
        document.pressed = $(this).val();
        $form.find("input[name='p_type']").val( p_type );
        if( p_type ){
            $form.submit();
        }
    });
})(jQuery);

function fnew_submit(f)
{
    f.pressed.value = document.pressed;

    var cnt = 0;
    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_bn_id[]" && f.elements[i].checked)
            cnt++;
    }

    if (!cnt) {
        alert(document.pressed+"할 알림을 하나 이상 선택하세요.");
        return false;
    }
    if( f.p_type.value == "del" ){
        if (!confirm("선택한 알림을 정말 "+document.pressed+" 하시겠습니까?")) {
            return false;
        }
    }

    f.action = "<?php echo G5_URL?>/plugin/srd-pushmsg/pushmsg_delete.php";

    return true;
}
</script>

</div>
<?php
include_once(G5_PATH.'/_tail.php');
?>

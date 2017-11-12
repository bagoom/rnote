<?php
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

//plugin에 필요한 변수설정
$del_day = 60 ; 		// 0 일경우 알림을 자동삭제 하지 않음 ex)60 으로 설정시 60일 이상된 알림은 자동삭제

function srd_id2nick ($member_id) {
	global $g5;
	$sql = "select mb_nick from {$g5['member_table']} where mb_id = '{$member_id}' ";
	$result = sql_fetch($sql);
	if ($result['mb_nick'] == '') $result['mb_nick']='게스트';
	return $result['mb_nick'];
}


//해당일이 글쓴날에서 얼마나 지났는지를 리턴
function srd_date_return ($datetime) {
	//그누보드 익명닉네임 이 알려주신 팁
	$_timestamp = array(86400*365, 86400*31, 86400, 3600, 60, 1);
	$_timetitle = array("년 전", "개월 전", "일 전", "시간 전", "분 전", "초 전");

	$d = strtotime($datetime);

	foreach($_timestamp as $key => $value)
	if($d <= time() - $value) return (int)((time() - $d)/$_timestamp[$key]).$_timetitle[$key];
} // emd srd_date_return

//해당 플러그인에 필요한 디비가 있는지를 체크후 없다면 디비생성 (디비 생성 없이 어떻게 해보려고 했는데 힘들듯)
// function exist_table($table_name) {
//   $result = sql_query("SHOW TABLES LIKE '{$table_name}'");
//   //$row = sql_fetch_array($result, MYSQL_NUM);
//   //return ($row === false)? false : true;
//   return ($row === true)? true : false;
// }

//var 2.0 디비이름을 그누보드 접두사를 가지고 와서 생성한다.
$g5['g5_srd_pushmsg'] = G5_TABLE_PREFIX.'srd_pushmsg';
// $is_pushmsg_db = exist_table ($g5['g5_srd_pushmsg']);

//해당 회원이 마지막으로 알림을 체크한 게시물을 반환
function srd_pushmsg_ckdate ($member_id) {
	global $g5;
	$sql = "
		select msg_wdate from {$g5['g5_srd_pushmsg']} where mb_id = '{$member_id}' and msg_check = 'd' order by msg_id desc limit 0,1
	";
	$result = sql_fetch($sql) ;
	if ($result) {
		return $result['msg_wdate'];
	} else {
		return '0000-00-00 00:00:00';
	}
}

if($gr_cp) {$group_member_table = 'g5_write_'.$gr_cp;}
else{$group_member_table = 'g5_write_'.$member['mb_id'];}
//중요매물에서 해당 회원의 알림이 있는지를 반환
function srd_pushmsg_important ($member_id,$last_check)  {
	global $g5;
	global $group_member_table;
	global $bo_table;
	global $gr_cp;
	if ($last_check == '0000-00-00 00:00:00') {		//마지막 체크일이 없는경우 체크하는 날을 기준으로 한다. (pushmsg가 삭제됬을경우 쪽지를 몽땅 불러오는것을 방지)
		$last_check = G5_TIME_YMD.' 00:00:00';
	}

	$sql = "select a.wr_id,a.wr_writer,a.wr_datetime,b.gr_id,b.gr_1 from  $group_member_table a, g5_group b where  a.wr_datetime >= '{$last_check}'
	";
	$result = sql_query($sql);
	while ($row = sql_fetch_array($result)) {
		//pushmsg에 추가한다.

		if($row['gr_1'] == 'gr_admin' && $row['gr_id'] == $gr_cp  ){
		$msg_wdate = G5_TIME_YMDHIS;
		$msg_check  = 'n';
		$push_nick = srd_id2nick($row['wr_writer']);
		$msg_subject = "<b>{$member_id}</b>님이 새로운 중요매물을 등록 했습니다.";
		$msg_link = G5_BBS_URL."/board.php?office_write=1&bo_table={$bo_table}&wr_sale_type=1&wr_office_permission=1";
		$sql_insert = "
			insert into {$g5['g5_srd_pushmsg']} ( msg_check, mb_id, mbto_id, msg_subject, msg_link, msg_type, msg_wdate)
			value (
				'{$msg_check}' ,
				'{$gr_cp}' ,
				'{$row['me_send_mb_id']}' ,
				'{$msg_subject}' ,
				'{$msg_link}' ,
				'memo' ,
				'{$msg_wdate}'
			)
		";
		@sql_query($sql_insert);
		}
	}
} // srd_pushmsg_important
$group_id = $group[gr_id];




//업체가입 페이지에서 해당 회원의 알림이 있는지를 반환
function srd_pushmsg_company ($member_id,$last_check)  {
	global $g5;
	global $gr_id;
	global $member;
	global $bo_table;
	global $group_id;

	if ($last_check == '0000-00-00 00:00:00') {		//마지막 체크일이 없는경우 체크하는 날을 기준으로 한다. (pushmsg가 삭제됬을경우 쪽지를 몽땅 불러오는것을 방지)
		$last_check = G5_TIME_YMD.' 00:00:00';
	}
	$sql = "select b.gr_id,a.mb_id,a.mb_nick,a.mb_1,b.gr_1 from  g5_member a, g5_group b where  b.gr_1 = 'gr_admin' and a.mb_1 = b.gr_id and a.mb_2 = 'waiting' and a.mb_7 >= '{$last_check}' ";
	$result = sql_query($sql);
	while ($row = sql_fetch_array($result)) {
		//pushmsg에 추가한다.
	// print_r ($row);
		if($member['mb_id'] == $row['gr_id'] ){
		$msg_wdate = G5_TIME_YMDHIS;
		$msg_check  = 'n';
		$push_nick = srd_id2nick($row['mb_nick']);
		$msg_subject = "<b>{$row['mb_nick']}</b>님이 가입승인을 요청 했습니다.";
		$msg_link = G5_BBS_URL."/group_confirm.php?bo_table={$member['mb_1']}";
		$sql_insert = "
			insert into {$g5['g5_srd_pushmsg']} ( msg_check, mb_id, mbto_id, msg_subject, msg_link, msg_type, msg_wdate)
			value (
				'{$msg_check}' ,
				'{$member_id}' ,
				'{$row['me_send_mb_id']}' ,
				'{$msg_subject}' ,
				'{$msg_link}' ,
				'memo' ,
				'{$msg_wdate}'
			)
		";
		@sql_query($sql_insert);
		}
	}
} // srd_pushmsg_company



//회원가입을 하면 축하메세지 전송
function srd_pushmsg_register($member_id,$last_check)  {
	global $g5;
	global $gr_id;
	global $member;
	global $bo_table;
	global $group_id;

	if ($last_check == '0000-00-00 00:00:00') {		//마지막 체크일이 없는경우 체크하는 날을 기준으로 한다. (pushmsg가 삭제됬을경우 쪽지를 몽땅 불러오는것을 방지)
		$last_check = G5_TIME_YMD.' 00:00:00';
	}
	$sql = "select mb_id,mb_nick from {$g5['member_table']} where mb_id = '$member[mb_id]' and 	mb_datetime = '{$last_check}'";
	$result = sql_query($sql);
	while ($row = sql_fetch_array($result)) {
		//pushmsg에 추가한다.
	// print_r ($row);
		if($member['mb_id'] == $row['mb_id'] ){
		$msg_wdate = G5_TIME_YMDHIS;
		$msg_check  = 'n';
		$push_nick = srd_id2nick($row['mb_nick']);
		$msg_subject = "<b>{$row['mb_nick']}</b>님, 회원가입을 환영합니다!";
		$msg_link = G5_URL;
		$sql_insert = "
			insert into {$g5['g5_srd_pushmsg']} ( msg_check, mb_id, mbto_id, msg_subject, msg_link, msg_type, msg_wdate)
			value (
				'{$msg_check}' ,
				'{$member_id}' ,
				'{$row['me_send_mb_id']}' ,
				'{$msg_subject}' ,
				'{$msg_link}' ,
				'memo' ,
				'{$msg_wdate}'
			)
		";
		@sql_query($sql_insert);
		}
	}
} // srd_pushmsg_register



//해당일수 이상의 알림은 자동삭제
function srd_pushmsg_del ($del_day) {
	global $g5;
	if ($del_day != 0) { // 해당일이 0이면 자동삭제 기능을 사용하지 않음
		$del_time =  date("Y-m-d", strtotime("-{$del_day}day")).' 00:00:00';
		$sql = "
			delete from {$g5['g5_srd_pushmsg']} where msg_wdate < '{$del_time}' and msg_check != 'd'
		";
		@sql_query($sql);
	}
} // srd_pushmsg_del

//마지막 체크된 날을 지정 (속도 및 중복체크를 막기윔함)
function srd_pushmsg_check($member_id) {
	//체크될 날이 있으면 update //없으면 insert
	global $g5;
	$date = G5_TIME_YMD;
	$datetime = G5_TIME_YMDHIS;
	$sql = "
		select count(*) as cnt from {$g5['g5_srd_pushmsg']} where mb_id = '{$member_id}' and msg_check = 'd'
	";
	$result = sql_fetch($sql);
	$count = $result['cnt'];
	if ($count > 0) {
		//update
		$sql = "update {$g5['g5_srd_pushmsg']}  set  msg_wdate = '{$datetime}' where mb_id='{$member_id}' and msg_check = 'd'";
	} else {
		//insert
		$sql = "
			insert into  {$g5['g5_srd_pushmsg']} ( msg_check, mb_id, msg_subject, msg_link, msg_type, msg_wdate)
			value (
				'd' ,
				'{$member_id}' ,
				'메세지 체크용' ,
				'' ,
				'type',
				'{$datetime}'
			)
		";
	} //end else
	@sql_query($sql);
} // srd_pushmsg_check


//페이지가 로딩될 때마나 알림이 있는지를 체크한다.
if ($is_member) { // 회원인 경우에만 체크
	//print_r($g5);
	$last_check = srd_pushmsg_ckdate($member['mb_id']); 							//마지막 알림체크 일시분초
	srd_pushmsg_company ($member['mb_id'], $last_check); 								//업체가입에서 알림체크
	srd_pushmsg_del ($del_day); 																		//자동 삭제 일수가 있다면 pushmsg의 내용을 삭제해준다. (관리자가 직접 삭제해주는게 귀찮다.)
	srd_pushmsg_check($member['mb_id']);
	$last_check = srd_pushmsg_ckdate($member['mb_id']);
	srd_pushmsg_important ($member['mb_id'], $last_check);
	srd_pushmsg_register ($member['mb_id'], $last_check);
	// srd_pushmsg_check($member['mb_id']);														//마지막 체크된 날을 지정 (속도 및 중복체크를 막기윔함)
}
?>

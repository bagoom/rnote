<?
$write_table2 = $g4['awrites_tablesr'];//원글이 있는게시판명
$sql2 = " select * from $write_table2 where wr_id = '$wrids' ";//복사할 해당글번호
$result2 = sql_query($sql2);
$row2 = sql_fetch_array($result2);


$move_write_table = $g4['writes_tablesr'];//복사할 게시판명
$move_bo_table = $g4['writes_tablesb'];//복사할 게시판의 전체 테이블명
$next_wr_num = get_next_num($move_write_table); //복사할 게시판의 마지막 글번호를 가져와서 -1 시킴



$sql = " insert into $move_write_table
      set wr_num            = '$next_wr_num',
        wr_reply          = '$row2[wr_reply]',
        wr_is_comment    = '$row2[wr_is_comment]',
        wr_comment        = '$row2[wr_comment]',
        wr_comment_reply  = '$row2[wr_comment_reply]',
        ca_name          = '".addslashes($row2[ca_name])."',
        wr_option        = '$row2[wr_option]',
        wr_subject        = '".addslashes($row2[wr_subject])."',
        wr_content        = '".addslashes($row2[wr_content])."',
        wr_link1          = '".addslashes($row2[wr_link1])."',
        wr_link2          = '".addslashes($row2[wr_link2])."',
        wr_link1_hit      = '$row2[wr_link1_hit]',
        wr_link2_hit      = '$row2[wr_link2_hit]',
        wr_trackback      = '".addslashes($row2[wr_trackback])."',
        wr_hit            = '$row2[wr_hit]',
        wr_good          = '$row2[wr_good]',
        wr_nogood        = '$row2[wr_nogood]',
        mb_id = '$member[mb_id]',
        wr_password = '$wr_password',
        wr_name = '$wr_name',
        wr_email = '$wr_email',
        wr_homepage = '$wr_homepage',
        wr_datetime = '$g4[time_ymdhis]',
        wr_last = '$g4[time_ymdhis]',
        wr_ip = '$_SERVER[REMOTE_ADDR]',
        wr_1              = '".addslashes($row2[wr_1])."',
        wr_2              = '".addslashes("{$row2[wr_2]}")."',
        wr_3              = '".addslashes($row2[wr_3])."',
        wr_4              = '".addslashes($row2[wr_4])."',
        wr_5              = '".addslashes($row2[wr_5])."',
        wr_6              = '".addslashes($row2[wr_6])."',
        wr_7              = '".addslashes($row2[wr_7])."',
        wr_8              = '".addslashes($row2[wr_8])."',
        wr_9              = '".addslashes($row2[wr_9])."',
        wr_10            = '".addslashes($row2[wr_10])."' ";
        sql_query($sql);

        $insert_id = mysql_insert_id();

        sql_query(" insert into $g4[board_new_table] ( bo_table, wr_id, wr_parent, bn_datetime, mb_id ) values ( '$move_bo_table', '$insert_id', '$insert_id', '$g4[time_ymdhis]', '$member[mb_id]' ) ");

        sql_query(" update $move_write_table set wr_parent = ' $insert_id' where wr_id = '$insert_id' ");

        sql_query(" update $g4[board_table] set bo_count_write  = bo_count_write  + '1'  where bo_table = '$move_bo_table' ");

//퍼간 사이트 로그찍기(url ,사이트명,회원아이디,게시판명,글번호를 기록하여 리스트를 만듬)
echo <<<HEREDOC
<iframe src="{$g4['data_url']}/dic_view.php?bo_table={$g4['awrites_tablesb']}&wr_id={$wrids}&domain_url={$g4['sites_ids']}&domain_name={$g4['sites_names']}" name="ifrm" width="0" height="0" marginwidth="0" marginheight="0" frameborder="no" scrolling="no"></iframe>
HEREDOC;
$msg = " 해당 자료를  복사 하였습니다.";
$opener_href = "./cash_list2.php?sca=$sca&sfl=$sfl&stx=$stx&page=$page";

echo <<<HEREDOC
<meta http-equiv='content-type' content='text/html; charset={$g4['charset']}'>
<script language="javascript">
alert("{$msg}");
parent.document.location.href = "{$opener_href}";
window.close();
</script>
HEREDOC;
?>

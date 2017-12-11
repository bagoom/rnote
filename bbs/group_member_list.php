<?php
include_once('./_common.php');
include_once(G5_THEME_PATH.'/head.sub.php');
$mb = get_member($mb_id);


$sql_common = " from {$g5['group_member_table']} a
                         left outer join {$g5['member_table']} b on (a.mb_id = b.mb_id) ";

$sql_search = " where gr_id = '{$gr_id}' ";
$sql_order = " order by {$sst} {$sod} ";


// if (!$mb['mb_id'])
//     alert('존재하지 않는 회원입니다.');

// $g5['title'] = '접근가능그룹';
// include_once('./admin.head.php');

?>
<style>
.main-list-wrap{
  margin-top: 150px ;
}
</style>

<div class="search_wrap">

  <div class="board_search">

  </div>

</div>


                  <div class="col-lg-12 main-list-wrap">
                    <form name="fboardgroupmember_form" id="fboardgroupmember_form" action="./boardgroupmember_update.php" method="post">
                    <input type="hidden" name="token" value="" id="token">
                    <input type="hidden" name="bo_table" value="">
                    <input type="hidden" name="w" value="" id="w">
                    
                    <div class="board_list_box col-xs-12 col-md-12">
                    <div class="table">
                      <div class="thead">
                        <div class="td">직함</div>
                        <div class="td">매물등록갯수</div>
                        <div class="td">가입일</div>
                        <div class="td">퇴사일</div>
                        <div class="td"></div>
                      </div>
                      <div class="tbody">
                        <?php

                        $gr_id = $group['gr_id'];
                        $sql = " select * from {$g5['group_member_table']} a
                                    left outer join {$g5['member_table']} b on (a.mb_id = b.mb_id)
                                    where gr_id = '$gr_id'
                                     ";
                        $result = sql_query($sql);

                        for ($i=0; $row=sql_fetch_array($result); $i++) {
                          ?>

                       <!-- <div class="td_chk " style="display:none; ">
                         <input type="checkbox" name="chk_wr_id[]" class="import_chk" style="display:none;" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" >
                         <label for="chk_wr_id_<?php echo $i ?>"> <p><i class="fa fa-check"></i></p></label>
                       </div> -->
                      <div class="tr" id="list_link" style="position:relative">
                          
                        <div class="td">
                          <a class="" href="<?php echo G5_BBS_URL?>/board.php?bo_table=<?=$bo_table?>&wr_writer=<?=$row['mb_id']?>&wr_important=1&wr_sale_type=1" >
                          <?=$row['mb_nick'] ?>
                          </a>
                        </div>
                        <?
                        $sql = "select count(*) as cnt from {$write_table} where wr_writer = '$row[mb_nick]'";
                        $result3 = sql_fetch($sql);
                        ?>
                        <div class="td">
                          <?= $result3['cnt']?>
                        </div>
                        <div class="td">
                          <?= $row['gm_datetime']?>
                        </div>
                        <div class="td">
                          <?= $row['gm_exit_date']?>
                        </div>
                        <div class="td">
                          <?
                              $delete_href = "javascript:del('./gr_member_delete.php?bo_table=$bo_table&mb_id=$row[mb_id]&page=$page".urldecode($qstr)."');";
                              $block_href = "./gr_member_block.php?bo_table=$bo_table&mb_id=$row[mb_id]";                            
                              $reblock_href = "./gr_member_block.php?bo_table=$bo_table&mb_id=$row[mb_id]&mb_8=2";                            
                              ?>
                            <? if ($row['gm_exit_date'] == '0000-00-00 00:00:00'){?>
                            <?php if ($delete_href) { ?><a class='btn btn-danger btn-md' href="<?php echo $delete_href ?>" class="btn_b01">직원탈퇴</a><?php } ?>
                          <? } else{ echo "퇴사한직원" ;} ?>
                          <input type="hidden" name="mb_id" value="<?=$row[mb_id]?>">
                          
                            <? if ($row['mb_8'] =='2'){ ?>
                            <a class='btn btn-danger btn-md block' href="<?php echo $reblock_href ?>"style="background:#3b4db7">해제하기</a>
                            <?}else{?>
                          <a class='btn btn-danger btn-md block' href="<?php echo $block_href ?>"style="background:#3b4db7">차단하기</a>
                          <?}?>
                        </div>
                      </div>
                  <?php } ?>
                      </div>
                    </div>
                  </div>
                  </form>
                  </div>

<script>

//  리스트 형태가 테이블형일때 2번째 tr의 배경 색상변경

    $(".tr:even").css("background", "white");
    // $(".block").click(function(){
    //   $("#fboardgroupmember_form").attr("action", "./gr_member_block.php");
    //   $("#fboardgroupmember_form").submit();

    // });

    
// function boardgroupmember_form_check(f)
// {
//     if (f.gr_id.value == '') {
//         alert('접근가능 그룹을 선택하세요.');
//         return false;
//     }
//
//     return true;
// }
</script>

<?php
include_once(G5_THEME_PATH.'/tail.sub.php');
?>

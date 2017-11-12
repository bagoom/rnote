<?php
include_once('./_common.php');
include_once(G5_THEME_PATH.'/head.sub.php');
$mb = get_member($mb_id);

// if (!$mb['mb_id'])
//     alert('존재하지 않는 회원입니다.');

// $g5['title'] = '접근가능그룹';
// include_once('./admin.head.php');

?>

<div class="search_wrap">

  <div class="board_search">

  </div>

</div>


                  <div class="col-lg-12 main-list-wrap">
                    <form name="fboardgroupmember_form" id="fboardgroupmember_form" action="./boardgroupmember_update.php" onsubmit="return boardgroupmember_form_check(this)" method="post">
                    <input type="hidden" name="token" value="" id="token">
                    <input type="hidden" name="bo_table" value="">
                    <input type="hidden" name="w" value="" id="w">
                    <div class="board_list_box col-xs-12 col-md-12">
                    <div class="table">
                      <div class="thead">
                        <div class="td">아이디</div>
                        <div class="td">이름</div>
                        <div class="td">가입대상</div>
                        <div class="td">등록일</div>
                        <div class="td"></div>
                        <div class="td"></div>
                      </div>
                      <div class="tbody">
                        <?php

                        $gr_id = $board['gr_id'];
                        $sql2 = " select * from g5_member
                                    where mb_1 = '$gr_id'
                                    and mb_2 = 'waiting' ";
                        $result2 = sql_query($sql2);
                        for ($i=0; $row=sql_fetch_array($result2); $i++) {
                          ?>

                       <!-- <div class="td_chk " style="display:none; ">
                         <input type="checkbox" name="chk_wr_id[]" class="import_chk" style="display:none;" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" >
                         <label for="chk_wr_id_<?php echo $i ?>"> <p><i class="fa fa-check"></i></p></label>
                       </div> -->
                      <div class="tr" id="list_link" style="position:relative">
                        <input type="hidden" name="mb_id" value="<?= $row['mb_id']?>">
                        <input type="hidden" name="gr_id" value="<?= $row['mb_1']?>">
                        <input type="hidden" name="del" value="del">
                        <div class="td">
                          <?= $row['mb_id']?>
                        </div>
                        <div class="td">
                          <?= $row['mb_name']?>
                        </div>
                        <div class="td">
                          <?= $row['mb_nick']?>
                        </div>
                        <div class="td">
                          <?= $row['mb_7']?>
                        </div>
                        <div class="td">
                          <input type="submit" value="가입승인" class="btn btn-danger btn-md" accesskey="s">
                        </div>
                        <div class="td">
                          <?
                              $delete_href = "javascript:del('./group_confirm_delete.php?bo_table=$bo_table&mb_id=$row[mb_id]&page=$page".urldecode($qstr)."');";
                            ?>
                          <?php if ($delete_href) { ?><a class='btn btn-danger btn-md' href="<?php echo $delete_href ?>" class="btn_b01">승인거절</a><?php } ?>
                        </div>
                      </div>
                  <?php } ?>
                  <?php if (count($result2) == 0) { echo '<tr><td colspan="10" class="empty_table">등록된 매물이 없습니다.</td></tr>'; } ?>
                      </div>
                    </div>
                  </div>
                  </form>
                  </div>


  <input type="hidden" id="bo_table" value="<?php echo $bo_table?>" ?>


<script>

$(".tr:even").css("background", "white");
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

<?include_once(G5_THEME_PATH.'/tail.sub.php');?>

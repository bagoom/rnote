<?php
include_once('../common.php');
include_once(G5_THEME_PATH.'/head.sub.php');
$mb = get_member($mb_id);
// if (!$mb['mb_id'])
//     alert('존재하지 않는 회원입니다.');

// $g5['title'] = '접근가능그룹';
// include_once('./admin.head.php');

?>





                  <div class="col-lg-12 np nm">
                    <h4 class="table_header np nm">직원가입목록
                        <span class="tb_header_cnt right">총 매물개수:11건</span>
                    </h4>
                  </div>

                  <div class="col-lg-12 main-list">
                        <section id="unseen">
                          <form name="fboardgroupmember_form" id="fboardgroupmember_form" action="./boardgroupmember_update.php" onsubmit="return boardgroupmember_form_check(this)" method="post">

                          <input type="hidden" name="token" value="" id="token">

                          <input type="hidden" name="w" value="" id="w">
                          <table class="table table-striped table-condensed">
                            <thead class="">
                            <tr>
                                <th>아이디</th>
                                <th>이름</th>
                                <th class="numeric">가입대상</th>
                                <th class="numeric">등록일</th>
                                <th class="numeric"></th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php

                              $gr_id = $board['gr_id'];
                              $sql2 = " select * from g5_member
                                          where mb_1 = '$gr_id'
                                          and mb_2 = 'waiting' ";
                              $result2 = sql_query($sql2);
                              for ($i=0; $row=sql_fetch_array($result2); $i++) {
                                ?>
                                <input type="hidden" name="mb_id" value="<?php echo $row['mb_id'] ?>" id="mb_id">

                                <input type="hidden" name="gr_id" value="<?php echo $gr_id ?>" >
                                  <td class="td_date"><?php echo $row['mb_id'] ?></td>
                                  <td class="td_date"><?php echo $row['mb_name'] ?></td>
                                  <td class="td_date"><?php echo $row['mb_nick'] ?></td>
                                  <td class="td_date"><?php echo $row2['gm_datetime'] ?></td>
                                  <!-- <td class="td_date"><?php echo $row['mb_1'] ?></td> -->
                                  <td class="td_date">


                                  </td>
                                  <td class="td_date"><?php echo $list[$i]['wr_geon'] ?></td>
                                  <td class="td_date"><?php echo $list[$i]['wr_space'] ?></td>
                                  <td class="td_date"><?php echo $list[$i]['wr_floor'] ?></td>
                                  <td class="td_date"><?php echo $list[$i]['datetime2'] ?></td>
                                  <td class="td_date">
                                  <input type="submit" value="가입승인" class="btn btn-danger btn-md" accesskey="s">
                                  </td>
                              </tr>

                              <?php if (count($row) == 0) { echo '<tr><td colspan="10" class="empty_table">등록된 매물이 없습니다.</td></tr>'; } ?>
        <?php } ?>

                            </tbody>
                        </table>
                      </form>
                    </section>
                  </div>

  <input type="hidden" id="bo_table" value="<?php echo $bo_table?>" ?>


<script>


function boardgroupmember_form_check(f)
{
    if (f.gr_id.value == '') {
        alert('접근가능 그룹을 선택하세요.');
        return false;
    }

    return true;
}
</script>

<!-- <?php
include_once('./admin.tail.php');
?> -->

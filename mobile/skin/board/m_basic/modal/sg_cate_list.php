<style>
.sg_cate_wrap{
  width: 90%;
  margin: 0 auto;
  margin-top: 30px;
  overflow: hidden;
}
.modal-body{
  background-color: #f3f3f3;
}
.sg_cate_wrap p{
  width: 155px;
  height: 150px;
  line-height: 150px;
  padding : 0;
  margin : 1%;
  border-radius: 0;
  float: left;
  text-align: center;
  font-size: 20px;
  cursor: pointer;
}
.alert-success {
    color: #fff;
    background-color: #222;
    border: 0;
}
</style>


<div class="sg_cate_wrap" id="Context" >
  <a href="<?echo G5_BBS_URL?>/write.php?bo_table=<? echo $member['mb_id']?>&board_list=1">
    <p class="sg_cate_01 alert alert-success" >원룸임대</p></a>
  <a href="<?echo G5_BBS_URL?>/write.php?bo_table=<? echo $member['mb_id']?>&board_list=2">
  <p class="sg_cate_02 alert alert-success">아파트/오피스텔</p></a>
  <a href="<?echo G5_BBS_URL?>/write.php?bo_table=<? echo $member['mb_id']?>&board_list=3">
  <p class="sg_cate_03 alert alert-success" style="background:url(<?echo G5_URL?>/img/m_write_icon_03.jpg); background-size:150px;" ></p></a>
  <a href="<?echo G5_BBS_URL?>/write.php?bo_table=<? echo $member['mb_id']?>&board_list=4">
  <p class="sg_cate_04 alert alert-success">토지임대</p></a>
</div>

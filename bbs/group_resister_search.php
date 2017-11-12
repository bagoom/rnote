<?php
include_once('./_common.php');

if ($is_guest)
    alert_close('회원만 이용하실 수 있습니다.');
  if(!empty($_POST["keyword"])) {
  $sql = " select * from g5_group where gr_subject like '" . $_POST["keyword"] . "%' ORDER BY gr_subject LIMIT 0,3";
$result = sql_query($sql);
  ?>
<style>
#country-list{
  padding-left:0;
}
.search_list {
  width: 100%;
  padding:10px;
  margin-top: 10px;
  color: #e1e1e1;
  font-size: 16px;
  text-align: left;
  background: #111;
  transition: 0.2s;
  cursor: pointer;
}
.selected{
  border: 4px solid #fff;
  box-shadow: 0 0 10px 1px rgba(0, 0, 0, 0.10);

}
</style>
    <ul id="country-list">
    <?php
    if(!empty($result)) {
    for ($i=0; $row=sql_fetch_array($result); $i++) {
    ?>
    <li class="search_list"><?php echo $row[gr_subject]; ?></li>
    <input type="hidden" name="gr_id" value="<?=$row[gr_id]?>">

  <?php }?>
    </ul>

<?php } }?>


<script>
$('.search_list').click(function() {
    //  다른 li를 클릭하면 'selected' 적용되었던 클래스가 지워짐
    $('.search_list').removeClass('selected');
    //  click한 li의 클래스값에 'selected' 를 추가함
    $(this).addClass('selected');
    // click한 li의 text값이 input 의 value로 넘어감
    $("#search_box").val($(this).text());
});
</script>

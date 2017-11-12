<?php
include_once('./_common.php');

  if(!empty($_POST["keyword"])) {
  $sql = " select * from g5_member where mb_id =   '$_POST[keyword]'  ORDER BY mb_id LIMIT 0,3";
$result = sql_query($sql);
  ?>
<style>
#country-list{
  padding-left:0;
}
.id_check{
  padding : 10px 0;
  color: #fff;
  background: #3b4db7;
  font-size: 14px;
  margin-bottom: 0;
}

</style>
    <ul id="country-list">
    <?php
    if(!empty($result)) {
    for ($i=0; $row=sql_fetch_array($result); $i++) {
    ?>
   <p class="id_check"> 이미 사용중인 아이디 입니다.</p>

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

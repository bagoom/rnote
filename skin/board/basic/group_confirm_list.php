<?php
// if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
?>


<section id="container" >
    <!-- **********************************************************************************************************************************************************
    TOP BAR CONTENT & NOTIFICATIONS
    *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
            </div>
          <!--logo start-->
          <a href="<?php echo G5_URL;?>" class="logo"><b><?php echo $bo_table ?> NOTE</b></a>
          <!--logo end-->
          <div class="top-menu">
            <ul class="nav pull-right top-menu">

              <?php
              if ($is_member) { // 회원이라면 로그인 중이라는 메세지를 출력해준다.
                  echo '<li><a class="logout" href="'.G5_BBS_URL.'/logout.php">로그아웃</a></li>';
              }
              ?>
            </ul>
          </div>
      </header>
    <!--header end-->

    <!-- **********************************************************************************************************************************************************
    MAIN SIDEBAR MENU
    *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
        <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">

                <!-- <p class="centered"><a href="profile.html"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
                <h5 class="centered">Marcel Newman</h5> -->

                <li class="mt">
                    <a  href="index.html">
                        <span>공지사항</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a class="active" href="<?php echo G5_BBS_URL?>/board.php?bo_table=<?=$bo_table?>" >
                        <span>나의매물</span>
                    </a>
                    <!-- <ul class="sub">
                        <li><a  href="general.html">General</a></li>
                        <li><a  href="buttons.html">Buttons</a></li>
                        <li><a  href="panels.html">Panels</a></li>
                    </ul> -->
                </li>

                <li class="sub-menu">
                    <a href="#" >
                        <span>전체매물</span>
                    </a>
                    <!-- <ul class="sub">
                        <li><a  href="calendar.html">Calendar</a></li>
                        <li><a  href="gallery.html">Gallery</a></li>
                        <li><a  href="todo_list.html">Todo List</a></li>
                    </ul> -->
                </li>
                <li class="sub-menu">
                    <a href="#" >
                        <span>중요매물</span>
                    </a>
                    <!-- <ul class="sub">
                        <li><a  href="blank.html">Blank Page</a></li>
                        <li><a  href="login.html">Login</a></li>
                        <li><a  href="lock_screen.html">Lock Screen</a></li>
                    </ul> -->
                </li>
                <li class="sub-menu">
                    <a href="#" >
                        <span>매매완료매물</span>
                    </a>
                    <!-- <ul class="sub">
                        <li><a  href="form_component.html">Form Components</a></li>
                    </ul> -->
                </li>
                <!-- <li class="sub-menu">
                    <a href="#" >
                        <span>Data Tables</span>
                    </a>
                    <ul class="sub">
                        <li><a  href="basic_table.html">Basic Table</a></li>
                        <li><a  href="responsive_table.html">Responsive Table</a></li>
                    </ul>
                </li> -->
                <li class="sub-menu">
                    <a href="#" >
                        <span>나의일정관리</span>
                    </a>
                    <!-- <ul class="sub">
                        <li><a  href="morris.html">Morris</a></li>
                        <li><a  href="chartjs.html">Chartjs</a></li>
                    </ul> -->
                </li>
                <li class="sub-menu">
                    <a href="#" >
                        <span>직원관리</span>
                    </a>

                </li>

            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->

    <!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <div class="row">

                <div class="col-lg-12 main-list-wrap">
                  <div class="content_header">
                    <input type="text" value="검색어를 입력 해 주세요" class="search left" />
                    <input type="button" value="검색" class="search left"/>
                    <! -- MODALS -->
                  <!-- Button trigger modal -->
                  <button class="btn btn-theme03 right sg_cate_list" data-toggle="modal" data-target="#myModal">
                   매물등록하기
                  </button>


                  <!-- Modal -->
                  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="myModalLabel">
                           <i class="fa fa-plus-circle" style="padding:0 3px;" aria-hidden="true"></i>
                            매물등록하기
                          </h4>
                        </div>
                        <div class="modal-body"  id="Context">
                          <!-- 모달창 내용 -->
                        </div>

                      </div>
                    </div>
                  </div>
                  </div>
                  <div class="col-lg-12 np nm">
                    <h4 class="table_header np nm">매물리스트
                        <span class="tb_header_cnt right">총 매물개수:11건</span>
                    </h4>
                  </div>

                  <div class="col-lg-12 main-list">
                        <section id="unseen">
                          <form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
                          <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                          <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
                          <input type="hidden" name="stx" value="<?php echo $stx ?>">
                          <input type="hidden" name="spt" value="<?php echo $spt ?>">
                          <input type="hidden" name="sca" value="<?php echo $sca ?>">
                          <input type="hidden" name="sst" value="<?php echo $sst ?>">
                          <input type="hidden" name="sod" value="<?php echo $sod ?>">
                          <input type="hidden" name="page" value="<?php echo $page ?>">
                          <input type="hidden" name="sw" value="">
                          <table class="table table-striped table-condensed">
                            <thead class="">
                            <tr>
                                <th></th>
                                <th>매물번호</th>
                                <th>매물명</th>
                                <th class="numeric">주소</th>
                                <th class="numeric">보증금</th>
                                <th class="numeric">월세</th>
                                <th class="numeric">권리금</th>
                                <th class="numeric">평수</th>
                                <th class="numeric">층수</th>
                                <th class="numeric">등록일</th>
                                <th class="numeric"></th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php
                              for ($i=0; $i<count($list); $i++) {
                               ?>
                              <tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?>">
                                <?php if ($is_checkbox) { ?>
                                <td class="td_chk">
                                  <input type="checkbox" class="" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
                              </td>
                              <?php } ?>

                                  <td class="td_num">
                                  <?php
                                  if ($list[$i]['is_notice']) // 공지사항
                                      echo '<strong>공지</strong>';
                                  else if ($wr_id == $list[$i]['wr_id'])
                                      echo "<span class=\"bo_current\">열람중</span>";
                                  else
                                      echo $list[$i]['num'];
                                   ?>
                                  </td>



                                  <td class="td_subject">
                                      <?php
                                      echo $list[$i]['icon_reply'];
                                      if ($is_category && $list[$i]['ca_name']) {
                                       ?>
                                      <a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link"><?php echo $list[$i]['ca_name'] ?></a>
                                      <?php } ?>

                                      <a href="<?php echo $list[$i]['href'] ?>">
                                          <?php echo $list[$i]['subject'] ?>
                                          <?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><?php echo $list[$i]['comment_cnt']; ?><span class="sound_only">개</span><?php } ?>
                                      </a>


                                  </td>
                                  <td class="td_name sv_use"><?php echo $list[$i]['name'] ?></td>
                                  <td class="td_date"><?php echo $list[$i]['wr_bo'] ?></td>
                                  <td class="td_date"><?php echo $list[$i]['wr_m_rate'] ?></td>
                                  <td class="td_date"><?php echo $list[$i]['wr_geon'] ?></td>
                                  <td class="td_date"><?php echo $list[$i]['wr_space'] ?></td>
                                  <td class="td_date"><?php echo $list[$i]['wr_floor'] ?></td>
                                  <td class="td_date"><?php echo $list[$i]['datetime2'] ?></td>
                                  <td class="td_date">

                                  <?echo"<a class='btn btn-primary btn-xs' href=\"../bbs/write.php?w=u&bo_table=$bo_table&wr_id={$list[$i][wr_id]}\"><i class='fa fa-pencil'></i></a>";?>

                                 <input type="submit" name="btn_submit" onclick="document.pressed=this.value" value="선택삭제" class="btn btn-danger btn-xs"/>


                                  </td>
                                  <!-- <td class="td_num"><?php echo $list[$i]['wr_hit'] ?></td> -->
                                  <?php if ($is_good) { ?><td class="td_num"><?php echo $list[$i]['wr_good'] ?></td><?php } ?>
                                  <?php if ($is_nogood) { ?><td class="td_num"><?php echo $list[$i]['wr_nogood'] ?></td><?php } ?>
                              </tr>
                              <?php } ?>
                              <?php if (count($list) == 0) { echo '<tr><td colspan="10" class="empty_table">등록된 매물이 없습니다.</td></tr>'; } ?>


                            </tbody>
                        </table>
                      </form>

  <input type="hidden" id="bo_table" value="<?php echo $bo_table?>" ?>

                        </section>
                  </div><!-- /col-lg-12 main-list -->
                </div><!-- /col-lg-9 END SECTION MIDDLE -->

    <!-- **********************************************************************************************************************************************************
    RIGHT SIDEBAR CONTENT
    *********************************************************************************************************************************************************** -->


            </div><! --/row -->
        </section>
    </section>

    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
        <div class="text-center">
            ALL RIGHT SANGGANOTE RESERVER.
            <a href="index.html#" class="go-top">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
    </footer>
    <!--footer end-->
</section>
<!-- } 게시판 목록 끝 -->


<!-- js placed at the end of the document so the pages load faster -->
<script src="../assets/js/jquery.js"></script>
<!-- <script src="../assets/js/jquery-1.8.3.min.js"></script> -->
<script src="../assets/js/bootstrap.min.js"></script>
<!-- <script class="include" type="text/javascript" src="../assets/js/jquery.dcjqaccordion.2.7.js"></script> -->
<script src="../assets/js/jquery.scrollTo.min.js"></script>
<script src="../assets/js/jquery.nicescroll.js" type="text/javascript"></script>

<script type="application/javascript">



    function myNavFunction(id) {
        $("#date-popover").hide();
        var nav = $("#" + id).data("navigation");
        var to = $("#" + id).data("to");
        console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }

    var bourl = "write.php?bo_table="+$("#bo_table").val();
    console.log(bourl);
    $(".sg_cate_list").click(function(){

      $.ajax({
      type : "POST",
      url : bourl,
      dataType : "text",
      error : function() {
          alert('통신실패!!');
      },
      success : function(data) {
          $('#Context').html(data);
      }
    });
     })

     function house_del_modal(wr_id){

     var answer = confirm("건물을 삭제 하시겠습니까? 건물 삭제시 호실정보도 같이 삭제되며 삭제후 복구 불가능합니다.");

                 if (answer){

     location.href='../bbs/delete.php?w=d&wr_id='+wr_id;
     			}

     }


</script>

<div class="content_header">


  <form method = "get">
  <input type="hidden" name="bo_table" value="<?=$bo_table?>" />
  <input type="hidden" name="board_list" value="<?=$board_list?>" />
  <input type="hidden" name="wr_important" value="<?=$wr_important?>" />
  <!-- <input type="submit" name="wr_sale_type" value="1" /> -->
  <button class="btn btn-theme03 left rent" name="wr_sale_type" type="submit" value="1"style="padding-left:12px;">
   임대
  </button>
  <button class="btn btn-theme03 left sale" name="wr_sale_type" type="submit" value="2"style="padding-left:12px;">
   매매
  </button>
  <span class="btn btn-theme03 left list_style_list active" style="padding-left:12px;"> 리스트형</span>
  <span class="btn btn-theme03 left list_style_memo"style="padding-left:12px;"> 메모지형 </span>
</form>

  <form name="fboardlist" id="fboardlist" action="./copy_update.php"  method="post">
  <!-- <input type="text" value="검색어를 입력 해 주세요" class="search left" />
  <input type="button" value="검색" class="search left"/> -->
  <! -- MODALS -->
<!-- Button trigger modal -->

<?=$GET_['office_write']?>
<? if ( $_GET[wr_important] == 1 ){
}else{ ?>
<button class="btn btn-theme03 right  config" type="button"  style="margin-right:10px;">
  <i class="fa fa-cog" aria-hidden="true" value="중요매물등록"  style="font-size:18px; "></i>
  매물관리설정
</button>
<?}?>
<? if ( $_GET[wr_important] == 1 ){
}else{ ?>
<!-- <button class="btn btn-theme03 right sg_cate_list"  type="button" data-toggle="modal" data-target="#myModal"data-backdrop="static" data-keyboard="false">
  <i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:18px; "></i>
 매물등록하기
</button> -->
<?}?>
</div>






<!--
            <? if ($sfl == "wr_important"&&$stx=="1"){
            echo "중요 매물리스트";
          }elseif($wr_sale_type=="1"){
            echo "임대 매물리스트";
          }elseif($wr_sale_type=="2"){
              echo "매매 매물리스트";
            }else{
              echo "매물리스트";
            }

            ?>
            <?
            $sql = "select count(*) as cnt from {$write_table}";
            $result3 = sql_fetch($sql);
            ?>
              <span class="tb_header_cnt right">  <span>Total <?php echo number_format($result3['cnt']) ?>건</span></span> -->

                <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                <input type="hidden" name="board_list" value="<?php echo $board_list ?>">
                <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
                <input type="hidden" name="stx" value="<?php echo $stx ?>">
                <input type="hidden" name="spt" value="<?php echo $spt ?>">
                <input type="hidden" name="sca" value="<?php echo $sca ?>">
                <input type="hidden" name="sst" value="<?php echo $sst ?>">
                <input type="hidden" name="sod" value="<?php echo $sod ?>">
                <input type="hidden" name="page" value="<?php echo $page ?>">
                <input type="hidden" name="sw" value="">
        <div class="board_list_box col-xs-12 col-md-12" id="list_style_list">
          <div class="table">
            <div class="thead">
              <? $sale = $_GET['wr_sale_type'] ;?>
              <div class="td">번호</div>
              <div class="td">매물명</div>
              <div class="td"><? if($sale == '1' || $sale == '3') echo '상권명'; else echo '지목'?></div>
              <div class="td"><? if($sale == '1' || $sale == '3') echo '층수'; else echo '지역지구'?></div>
              <div class="td"><? if($sale == '1' || $sale == '3') echo '평수'; else echo '총면적'?></div>
              <div class="td"><? if($sale == '1' || $sale == '3') echo '보증금'; else echo '총매도가'?></div>
              <div class="td"><? if($sale == '1' || $sale == '3') echo '월세'; else echo '평당가격'?></div>
              <div class="td"><? if($sale == '1' || $sale == '3') echo '권리금'; else echo '주소'?></div>
              <? if ($sale == '2'){ ?>
              <? if($_GET[wr_important] == 1){ ?>
                <div class="td">담당자</div>
              <?} }?>
              <div class="td"><? if($sale == '1') echo '합계'; else echo '등록일'?></div>
              <? if($sale == '1'  || $sale == '3'){?><div class="td">주소</div><?}?>
              <? if ($sale == '1' || $sale == '3'){ ?>
              <? if( $_GET[wr_important] == 1 ){ ?>
                <div class="td">담당자</div>
              <?} }?>
              <? if($sale == '1' || $sale == '3'){?><div class="td">등록일</div><?}?>
            </div>
            <div class="tbody">
                    <?php
                    for ($i=0; $i<count($list); $i++) {
                     ?>

             <div class="td_chk " style="display:none; ">
               <input type="checkbox" name="chk_wr_id[]" class="import_chk" style="display:none;" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" >
               <label for="chk_wr_id_<?php echo $i ?>"> <p><i class="fa fa-check"></i></p></label>
             </div>
            <div class="tr" id="list_link"onClick=location.href="<?php echo $list[$i]['href'] ?>" style="position:relative">

              <div class="td">
                <?= $list[$i]['num']?>
              </div>
              <div class="td">
                <?php echo $list[$i]['subject'] ?>
              </div>
              <div class="td">
                <?php  if($sale == '1' || $sale == '3') echo $list[$i]['wr_sale_area']; else echo $list[$i]['wr_rand_type']; ?>
              </div>
                <?php  if($sale == '1' || $sale == '3') {?>
              <div class="td">
                <?  if ($list[$i]['wr_floor'] < 0) {$under_floor = str_replace('-', "", $list[$i]['wr_floor']); echo "지하".$under_floor.'층'; }else echo $list[$i]['wr_floor'].'층'?>
              </div>
              <?} else{?>
                <div class="td">
                  <?php echo $list[$i]['wr_zoning_district'] ?>
                </div>
                <?}?>
              <div class="td">
                <?php  if($sale == '1' || $sale == '3') echo $list[$i]['wr_area_p']; else echo $list[$i]['wr_area_p_all']; ?>
              </div>
              <div class="td">
                <span class="commaN">
                <?php  if($sale == '1' || $sale == '3') echo $list[$i]['wr_rent_deposit']; else echo $list[$i]['wr_sale_price']; ?>
                </span>
              </div>
              <div class="td">
                <span class="commaN">
                <?php  if($sale == '1' || $sale == '3') echo $list[$i]['wr_m_rate']; else echo $list[$i]['wr_p_sale_price']; ?>
              </div>
                </span>
              <div class="td">
                <span class="commaN">
                <?php  if($sale == '1' || $sale == '3') echo $list[$i]['wr_premium_o']; else{?>
              </span>
                <? echo $list[$i]['wr_address']; }?>
              </div>
              <? if ($sale == '2'){ ?>
              <? if( $_GET[wr_important] == 1 ){ ?>
                <div class="td">
                  <?php echo $list[$i]['wr_writer'] ?>
                </div>
              <?} }?>
              <div class="td">
                <span class="commaN">
                <?php  if($sale == '1' || $sale == '3') echo $list[$i]['wr_premium_o'] + $list[$i]['wr_rent_deposit']; else{?>
                  <? echo $list[$i]['datetime2']; }?>
              </div>


              <? if($sale == '1' || $sale == '3'){?>
              <div class="td">
                <?php echo $list[$i]['wr_address'] ?>
              </div> <?} ?>

              <? if ($sale == '1' || $sale == '3'){ ?>
              <? if( $_GET[wr_important] == 1 ){ ?>
                <div class="td">
                  <?php echo $list[$i]['wr_writer'] ?>
                </div>
              <?} }?>
              <? if($sale == '1' || $sale == '3'){?>
              <div class="td">
                <?php echo $list[$i]['datetime'] ?>
              </div><?}?>
            </div>
        <?php } ?>
            </div>
          </div>
        </div>
        <?php if (count($list) == 0) { echo '<tr><td colspan="10" class="empty_table">등록된 매물이 없습니다.</td></tr>'; } ?>

        <div class="board_list_box col-xs-12 col-md-12" id="list_style_memo" style="display:none;">
            <?php
            for ($i=0; $i<count($list); $i++) {
             ?>
             <div class="memo_list col-md-3" id="ddd"  style="position:relative; overflow:hidden;">
            <div class="right td_chk2" style="display:none; ">
              <input type="checkbox" name="chk_wr_id[]" class="import_chk" style="display:none;" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id2_<?php echo $i ?>" >
              <label for="chk_wr_id2_<?php echo $i ?>"><p>선택하기</p> <p><i class="fa fa-check"></i></p></label>
            </div>
            <a href="<?php echo $list[$i]['href'] ?>">
            <div class="list_item " style="width:100%;">
              <div class="list_num"><?= $list[$i]['num']?></div>

            <ul>
            <li class="list_subject">
              <?php echo $list[$i]['subject'] ?>
            </li>
            <li class="list_address">
              <span><?php echo $list[$i]['wr_address'] ?></span>
            </li>
            <li class="list_address" style="border-bottom: 3px solid #323e51; padding-bottom:20px;">
              <span><?php echo $list[$i]['wr_sale_area'] ?></span>
            </li>

            <li class="list_sub_info" style="border-left: 1px solid #ddd;"><p>보증금</p> <?=$list[$i]['wr_rent_deposit'] ?></li>
            <li class="list_sub_info"><p>월세</p> <?=$list[$i]['wr_m_rate'] ?></li>
            <li class="list_sub_info"><p>권리금</p><?php echo $list[$i]['wr_premium_o'] ?></li>
            <li class="list_sub_info" style="border-left: 1px solid #ddd;"><p>층/평</p>
              <?  if ($list[$i]['wr_floor'] < 0) {
             $under_floor = str_replace('-', "", $list[$i]['wr_floor']); echo "지하".$under_floor; }
              else echo $list[$i]['wr_floor']?>
            <?php echo $list[$i]['wr_area_p'] ?> </li>

            <li class="list_sub_info"><p>합예산</p> <?php echo $list[$i]['wr_rent_deposit']+$list[$i]['wr_premium_o'] ?></li>

            <li class="list_sub_info"><p>등록일</p> <?php echo $list[$i]['datetime2'] ?></li>

          </ul>
          </div>
        </a>
        </div>
      <?php } ?>
    </div>


            </form>

  <div class="chk_confirm_wrap">
    <?if (!$gr_cp && !$gr_admin) {}else{?>
    <span class="s1">사무실매물등록하기</span>
    <?}?>
    <span class="s2">즐겨찾기등록하기</span>
    <span class="s3">매매완료등록하기</span>

  </div>

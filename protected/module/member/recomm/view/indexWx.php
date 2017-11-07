
    <!--搜索栏-s-->
<div class="page   " style="height: 100%;background: #f3f7f8;">
    <div class="page__bd"  style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

                     <div class="weui-cell weui-cell_access" href="javascript:;">
                         <a href="<?php use module\member\index\server\UserLevelServer;
                         use module\member\index\UserServer;

                         echo $this->genurl('member/index/index'); ?>">
                             <div class="weui-cell__ft">
                             </div>
                         </a>
                        <div class="weui-cell__bd">
                            <p class="title">我的推荐好友</p>
                        </div>
                    </div>

                </div>
        <div class="  weui-panel_access  "  >
      <div class="weui-navbar navbar-sm">
          <a href="<?php echo $this->genurl('',['level'=> UserLevelServer::LEVEL_NORMAL]); ?>" class="weui-navbar__item <?php echo $level==UserLevelServer::LEVEL_NORMAL?'weui-bar__item_on':'' ?>">
              普通会员
          </a>
          <a href="<?php echo $this->genurl('',['level'=>UserLevelServer::LEVEL_GOLDED_CARD]); ?>" class="weui-navbar__item <?php echo $level==UserLevelServer::LEVEL_GOLDED_CARD?'weui-bar__item_on':'' ?>  ">
              金卡会员
          </a>
          <a href="<?php echo $this->genurl('',['level'=>UserLevelServer::LEVEL_BLACK_CARD]); ?>" class="weui-navbar__item <?php echo $level==UserLevelServer::LEVEL_BLACK_CARD?'weui-bar__item_on':'' ?>  ">
              黑卡会员
          </a>
       </div>
        <div class="mem_recomm">
             <div class="weui-cell info">
                <div class="weui-cell__bd">
                    <p><?php echo date('Y-m-d',$user['reg_time']) ?>至<?php echo date('Y-m-d') ?></p>
                </div>
                <div class="weui-cell__ft">共推荐<?php echo $page->pageCount ?>位好友</div>
            </div>
             <div class="weui-cells list4_w">
                 <?php foreach($list as $item):?>
                <div class="weui-cell">
                                <div class="weui-cell__hd"><img src="<?php echo UserServer::getAvatar($item) ?>" alt="" class="simg"></div>
                                <div class="weui-cell__bd">
                                   <div class="t1"><?php echo $item['nickname'] ?></div>
                                   <div class="t2"><?php echo date('Y-m-d H:i:s',$item['reg_time']) ?></div>
                                </div>
                            </div>
                 <?php endforeach?>
 
            </div>
        </div>

                    </div>

     </div>

</div>
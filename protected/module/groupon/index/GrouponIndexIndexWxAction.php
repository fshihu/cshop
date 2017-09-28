<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/18
 * Time: 17:53
 */

namespace module\groupon\index;


use app\admin\biz\AdPosition;
use CC\db\base\select\ListModel;
use CRequest;
use module\ad\index\AdServer;

class GrouponIndexIndexWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        $cate_list =  ListModel::make('goods_category')->addStrCondition('parent_id>0')->execute();
        $group_buys =  ListModel::make('group_buy')->order('id desc')->limit(5)->execute();

        return new \CRenderData(array(
            'cate_list' => $cate_list,
            'group_buys' => $group_buys,
            'ad_list' => AdServer::getList(AdPosition::GROUP),
        ));
    }
}
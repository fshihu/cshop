<?php
namespace module\home\index;
use app\admin\biz\AdPosition;
use CC\db\base\select\ListModel;
use CRequest;
use module\ad\index\AdServer;

/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/18
 * Time: 17:20
 */
class HomeIndexIndexWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        $cate_list =  ListModel::make('goods_category')->addColumnsCondition(array('parent_id' => 0))->execute();
        $group_buys =  ListModel::make('group_buy')->addColumnsCondition(array(
            'end_time' => ['>',time()]
        ))->order('id desc')->limit(5)->execute();

        return new \CRenderData(array(
            'ad_list' => AdServer::getList(AdPosition::HOME),
            'cate_list' => $cate_list,
            'group_buys' => $group_buys,
        ));
    }
}
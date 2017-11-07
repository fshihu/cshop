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
use CC\util\arr\ArrayUtil;
use CRequest;
use module\ad\index\AdServer;

class GrouponIndexIndexWxAction extends \CAction
{
    public $cate_id = 0;
    public function execute(CRequest $request)
    {
        $condition = array(
            'end_time' => ['>', time()]
        );
        if($this->cate_id){
            $condition['g.cat_id'] = $this->cate_id;
        }
        $group_buys =  ListModel::make('group_buy')->addColumnsCondition($condition)->select('t.*,g.cat_id')->leftJoin('goods','g','t.goods_id = g.goods_id')->order('id desc')->execute();

        unset($condition['g.cat_id']);
        $group_buys1 =  ListModel::make('group_buy')->addColumnsCondition($condition)->select('t.*,g.cat_id')->leftJoin('goods','g','t.goods_id = g.goods_id')->order('id desc')->execute();

        $cate_list =  ListModel::make('goods_category')->addInCondition('id',ArrayUtil::arrayColumn($group_buys1,'cat_id'))->execute();

        return new \CRenderData(array(
            'cate_list' => $cate_list,
            'group_buys' => $group_buys,
            'cate_id' => $this->cate_id,
            'ad_list' => AdServer::getList(AdPosition::GROUP),
        ));
    }
}
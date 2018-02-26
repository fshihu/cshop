<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/19
 * Time: 15:40
 */

namespace module\goods\cate;


use app\admin\biz\AdPosition;
use biz\action\ListAction;
use CC\db\base\select\ItemModel;
use CC\db\base\select\ListModel;
use CC\util\arr\ArrayUtil;
use CRequest;
use module\ad\index\AdServer;

class GoodsCateListWxAction extends ListAction
{
    public $id;
    public $cate_item;
    public $cate_list;
    public $cate_id;
    public $cate_i = 0;
    protected function onExecute()
    {
        $condition = array(
            'end_time' => ['>', time()]
        );
        if($this->cate_id){
            $condition['g.cat_id'] = $this->cate_id;
        }
        $group_buys =  ListModel::make('group_buy')->addColumnsCondition($condition)->select('t.*,g.cat_id')->leftJoin('goods','g','t.goods_id = g.goods_id')->order('id desc')->limit(5)->execute();
        return  (array(
            'cate_item' => $this->cate_item,
            'cate_list' => $this->cate_list,
            'id' => $this->id,
            'cate_id' => $this->cate_id,
            'cate_i' => $this->cate_i,
            'ad_list' => AdServer::getList(AdPosition::CATE_LIST),
            'group_buys' => $group_buys,

        ));
    }
    protected function getSearchCondition()
    {
        $list = ListModel::make('goods_category')->addColumnsCondition(array(
            'parent_id' => 0,
        ))->execute();
        foreach ($list as $i => $item) {
            if($item['id'] == $this->id){
                $this->cate_i = $i;
            }
        }
        $this->cate_item =  ItemModel::make('goods_category')->addId($this->id)->execute();
        $this->cate_list =  ListModel::make('goods_category')->addColumnsCondition(array(
            'parent_id' => $this->cate_item['id'],
        ))->execute();
        $this->dbCondition->addColumnsCondition(array(
            'cat_id' => array('in', ArrayUtil::arrayColumn(array_merge($this->cate_list, [$this->cate_item]), 'id')),
            'is_on_sale' => 1,
        ))->order('t.goods_id desc');
        if($this->cate_id){
            $this->dbCondition->addColumnsCondition(array(
                'cat_id' => $this->cate_id,
            ));
        }
    }

    protected function getTable()
    {
        return 'goods';
    }
}
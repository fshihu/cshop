<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/18
 * Time: 17:50
 */

namespace module\goods\cate;


use biz\action\ListAction;
use CC\db\base\select\ItemModel;

class GoodsCateGoodsWxAction extends ListAction
{
    public $cate_id;
    protected function getTable()
    {
        return 'goods';
    }

    public function getPageTitle()
    {
        $item  =  ItemModel::make('goods_category','tp_')->addId($this->cate_id)->execute();
        $pitem  =  ItemModel::make('goods_category','tp_')->addId($item['parent_id'])->execute();

        return $pitem['name'].'-'.$item['name'];
    }
}
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
    public $list_type;
    protected function getTable()
    {
        return 'goods';
    }

    protected function getSearchCondition()
    {
        if($this->cate_id){
            $this->dbCondition->addColumnsCondition(array(
                'cat_id' => $this->cate_id,
            ));
        }
        if($this->list_type == 'hot'){

        }
        if($this->list_type == 'new'){

        }
    }

    public function getPageTitle()
    {
        if($this->list_type == 'new'){
            $name = '最新产品';
        }else if($this->list_type == 'hot'){
            $name = '热销产品';
        }else{
            $item  =  ItemModel::make('goods_category')->addId($this->cate_id)->execute();
            $pitem  =  ItemModel::make('goods_category')->addId($item['parent_id'])->execute();

            $name = $pitem['name'] . '-' . $item['name'];
        }

        return $name;
    }
}
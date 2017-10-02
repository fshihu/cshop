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
    protected function onExecute()
    {

        return  (array(
            'cate_item' => $this->cate_item,
            'cate_list' => $this->cate_list,
            'id' => $this->id,
            'cate_id' => $this->cate_id,
            'ad_list' => AdServer::getList(AdPosition::CATE_LIST),

        ));
    }
    protected function getSearchCondition()
    {
        $this->cate_item =  ItemModel::make('goods_category')->addId($this->id)->execute();
        $this->cate_list =  ListModel::make('goods_category')->addColumnsCondition(array(
            'parent_id' => $this->cate_item['id'],
        ))->execute();
        $this->dbCondition->addColumnsCondition(array(
            'cat_id' => array('in', ArrayUtil::arrayColumn(array_merge($this->cate_list, [$this->cate_item]), 'id'))
        ));
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
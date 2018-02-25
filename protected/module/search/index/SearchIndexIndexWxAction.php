<?php
/**
 * User: fu
 * Date: 2018/2/25
 * Time: 21:15
 */

namespace module\search\index;

use biz\action\ListAction;
use CC\db\base\select\ItemModel;

class SearchIndexIndexWxAction extends ListAction
{
    public $cate_id;
    public $list_type;
    protected function getTable()
    {
        return 'goods';
    }

    protected function getSearchCondition()
    {
        $this->dbCondition->addColumnsCondition(array(
            'is_on_sale' => 1,
        ))->order('t.goods_id desc');
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
        return '搜索结果';
    }
}
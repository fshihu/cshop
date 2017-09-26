<?php
namespace biz\action;
use CC\db\base\select\ListModel;

/**
 * User: fu
 * Date: 2017/9/26
 * Time: 22:26
 */
class ListAction extends \CC\action\ListAction
{
    protected function getListModel()
    {
        $this->getSearchCondition();
        $this->dbCondition->from($this->getTable());
        if (!$this->isExport()) {
            if($this->getPageSize() !== 0){
                $this->dbCondition->limit($this->getPageSize());
            }
            $this->dbCondition->offset($this->getOffset());
        }
        if ($this->getIsSingle()) {
            $this->dbCondition->limit(1);
        }
        return ListModel::make($this->getTable(),'tp_')->setDbCondition($this->dbCondition);
    }

    protected function getDataType()
    {
        return 'render';
    }


}
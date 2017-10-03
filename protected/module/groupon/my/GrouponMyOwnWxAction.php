<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/26
 * Time: 11:56
 */

namespace module\groupon\my;


use biz\action\ListAction;
use biz\Session;
use CC\util\db\YesNoEnum;
use module\cart\index\server\OrderHanderServer;
use module\cart\index\server\OrderPayStatusEnum;
use module\cart\index\server\PromTypeEnum;
use module\groupon\server\enum\GroupOneStatusEnum;

class GrouponMyOwnWxAction extends ListAction
{
    public $is_end;
    protected function getSearchCondition()
    {
        $conditon = [];
        if($this->is_end == 0){
            $conditon['go.is_finish'] = 0;
            $conditon['gb.end_time'] = ['>',time()];
        }
        if($this->is_end == 1){
            $conditon['go.is_finish'] = 1;
            $conditon['go.is_clearing'] = 0;
        }
        if($this->is_end == 2){
            $conditon['go.is_finish'] = 1;
            $conditon['go.is_clearing'] = 1;
        }
        if($this->is_end == 3){
            $conditon['go.is_finish'] = 0;
            $conditon['gb.end_time'] = ['<',time()];
        }
        $this->dbCondition->addColumnsCondition(array(
            'user_id' => Session::getUserID(),
            't.pay_status' => OrderPayStatusEnum::PAYED,
            'deleted' => YesNoEnum::NO,
            'order_prom_type' => PromTypeEnum::GROUP_OPNE,
        ))->addColumnsCondition($conditon)->leftJoin('group_one','go','t.order_prom_id = go.id')
            ->leftJoin('group_buy','gb','go.group_buy_id = gb.id')
            ->select('t.*,go.remain_num,gb.end_time ')
            ->order('order_id desc');
    }
    protected function getTable()
    {
        return 'order';
    }

    protected function onExecute()
    {
        $end_desc = GroupOneStatusEnum::getValueByIndex($this->is_end);
        return [
            'end_desc' => $end_desc,
            'is_end' => $this->is_end,
        ];
    }
}
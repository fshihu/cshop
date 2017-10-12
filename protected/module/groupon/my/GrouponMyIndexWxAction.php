<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/26
 * Time: 11:48
 */

namespace module\groupon\my;


use biz\action\ListAction;
use biz\Session;
use CC\util\db\YesNoEnum;
use module\cart\index\server\OrderHanderServer;
use module\cart\index\server\OrderPayStatusEnum;
use module\cart\index\server\PromTypeEnum;

class GrouponMyIndexWxAction extends ListAction
{
    public $is_end;
    protected function getSearchCondition()
    {
        $this->dbCondition->addColumnsCondition(array(
            't.user_id' => Session::getUserID(),
            't.pay_status' => OrderPayStatusEnum::PAYED,
            'deleted' => YesNoEnum::NO,
            'order_prom_type' => PromTypeEnum::GROUP_JOIN,
            'gb.end_time' => [$this->is_end?'<':'>',time()],
        ))->leftJoin('group_one','go','t.order_prom_id = go.id')
            ->leftJoin('group_buy','gb','go.group_buy_id = gb.id')
            ->leftJoin('users','u','go.win_uid = u.user_id')
            ->select('t.*,go.remain_num,gb.end_time,u.nickname ')
            ->order('order_id desc');
    }
    protected function getTable()
    {
        return 'order';
    }

    protected function onExecute()
    {
        return [
            'end_desc' => $this->is_end?'成团失败':'已过期',
            'is_end' => $this->is_end,
        ];
    }
}
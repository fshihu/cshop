<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/19
 * Time: 17:25
 */

namespace module\member\index;


use biz\Session;
use CC\db\base\select\ItemModel;
use CC\db\base\select\ListModel;
use CC\util\arr\ArrayUtil;
use CC\util\db\YesNoEnum;
use CRequest;
use module\cart\index\server\OrderPayStatusEnum;
use module\cart\index\server\PromTypeEnum;
use module\service\index\enum\ServiceStatusEnum;

class MemberIndexIndexWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        $user = ItemModel::make('users')->addColumnsCondition(array(
            'user_id' => Session::getUserID(),
        ))->execute();
        $total = ItemModel::make('users')->addColumnsCondition(array(
            'first_leader' => Session::getUserID(),
        ))->select('count(*) count_num')->execute();
        $user['recomm_count'] = (int)$total['count_num'];
        $total = ItemModel::make('sys_msg')->addColumnsCondition(array(
            'id' => ['>',$user['max_msg_id']],
        ))->select('count(*) count_num')->execute();
        $user['msg_count'] = (int)$total['count_num'];

        $order = ListModel::make('order')->addColumnsCondition(array(
            'user_id' => Session::getUserID(),
            'deleted' => YesNoEnum::NO,
            'is_show' => 1,
        ))->select('count(*) count_num,wait_status')->group('wait_status')->execute();
        $user['order_status'] = ArrayUtil::arrayColumn($order,'count_num','wait_status');

        $group_my =  ItemModel::make('order')->addColumnsCondition(array(
                    't.user_id' => Session::getUserID(),
                    't.pay_status' => OrderPayStatusEnum::PAYED,
                    'deleted' => YesNoEnum::NO,
                    'order_prom_type' => ['in',[PromTypeEnum::GROUP_JOIN,PromTypeEnum::GROUP_OPNE]],
                    'go.is_finish' => 0,
                    'gb.end_time' => ['>',time()],
                ))->leftJoin('group_one','go','t.order_prom_id = go.id')
                    ->leftJoin('group_buy','gb','go.group_buy_id = gb.id')
                    ->leftJoin('users','u','go.win_uid = u.user_id')
                    ->select('t.*,go.remain_num,gb.end_time,u.nickname,go.group_buy_id ')
                    ->order('order_id desc')->select('count(*) count_num')->execute();
        $user['group_my_num'] = (int)$group_my['count_num'];

        $group_own = ItemModel::make('order')->addColumnsCondition(array(
            't.user_id' => Session::getUserID(),
            't.pay_status' => OrderPayStatusEnum::PAYED,
            'deleted' => YesNoEnum::NO,
            'order_prom_type' => ['in',[PromTypeEnum::GROUP_OWN_OPEN,PromTypeEnum::GROUP_OWN_JOIN]],
        ))->addColumnsCondition(array(
            'go.is_finish' => ['in',[0,1]],
            'go.is_clearing' => 0,
        ))->leftJoin('group_one','go','t.order_prom_id = go.id')
            ->leftJoin('users','u','go.win_uid = u.user_id')
            ->select('t.*,go.remain_num,u.nickname,go.win_uid,go.group_buy_id ')
            ->order('order_id desc')->select('count(*) count_num')->execute();
        $user['group_own_num'] = (int)$group_own['count_num'];

        $service_reserve = ItemModel::make('service_reserve')->addColumnsCondition(array(
            'user_id' => Session::getUserID(),
            'status' => ['!=',ServiceStatusEnum::STATUS_FINISH],
        ))->select('count(*) count_num')->execute();
        $user['service_reserve_num'] = $service_reserve['count_num'];
		//添加区分财富和佣金-柯岳
		$mdata=ListModel::make('user_money_record')->addColumnsCondition(array(
            'uid' => Session::getUserID(),
        ))->execute();
		$butie=0;
		$caifu=0;
		foreach($mdata as $item){
			if($item['content']=='退货退款'||$item['content']=='提现成功'||$item['content']=='订单返现'||$item['content']=='拼团失败，退回支付款'){
				$caifu=$caifu+$item['money'];
			}else{
				$butie=$butie+$item['money'];
			}
		}
		$user['butie']=sprintf('%.2f',$butie);
		$user['caifu']=sprintf('%.2f',$caifu);
        return new \CRenderData(array(
            'user' => $user,
        ));
    }
}
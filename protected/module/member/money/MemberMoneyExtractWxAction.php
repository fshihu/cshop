<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 18:23
 */

namespace module\member\money;


use CC\db\base\insert\InsertModel;
use CC\db\base\select\ItemModel;
use CC\db\base\select\ListModel;
use CErrorException;
use CRequest;
use module\basic\phone\server\PhoneServer;
use module\member\index\UserServer;

class MemberMoneyExtractWxAction  extends \CAction
{
    public function execute(CRequest $request)
    {
//        PhoneServer::sendMsg2();
        $user = UserServer::getUser();

		//添加区分财富和佣金-柯岳
		$mdata=ListModel::make('user_money_record')->addColumnsCondition(array(
            'uid' => $user['user_id']
        ))->execute();
		$butie=0;
		$caifu=0;
		foreach($mdata as $item){
			if($item['content']=='退货退款'||$item['content']=='我的财富提现成功'||$item['content']=='订单返现'||$item['content']=='拼团失败，退回支付款'||$item['content']=='订单金卡返现'||$item['content']=='订单黑卡返现'){
				$caifu=$caifu+$item['money'];
			}else{
				$butie=$butie+$item['money'];
			}
		}
		if($_GET['butie']=='1'){
			$user['caifu']=sprintf('%.2f',$butie);
		}else{
			$user['caifu']=sprintf('%.2f',$caifu);
		}

        if($request->hasPost()){
            $bank_id = $request->getParams('bank_id');
            $money = $request->getParams('money');
            $item = ItemModel::make('users_bank')->addColumnsCondition(array(
                'user_id' => $user['user_id'],
                'id' => $bank_id,
            ))->execute();
            if(!$item){
                throw new CErrorException('银行卡未选择正确');
            }
            if($money <= 0){
                throw new CErrorException('金额格式错误');
            }
            /*if($money > $user['user_money']){
                throw new CErrorException('金额太大');
            }*/
			if($_GET['butie']=='1'){
				if($money>$butie){
					throw new CErrorException('金额太大');
				}
			}else{
				if($money>$caifu){
					throw new CErrorException('金额太大');
				}
			}
			if($_GET['butie']=='1'){
				InsertModel::make('extract_apply')->addData(array(
                'uid' => $user['user_id'],
                'money' => $money,
                'status' => 0,
				'type'=>1,
                'bank_id' => $bank_id,
                'c_time' => time(),
				))->execute();
			}else{
				InsertModel::make('extract_apply')->addData(array(
                'uid' => $user['user_id'],
                'money' => $money,
                'status' => 0,
				'type'=>0,
                'bank_id' => $bank_id,
                'c_time' => time(),
				))->execute();
			}
            return new \CJsonData();
        }
        $bank_list = ListModel::make('users_bank')->addColumnsCondition(array(
            'user_id' => $user['user_id']
        ))->order('id desc')->execute();

		
		//print_r($caifu);print_r($butie);

        return new \CRenderData(array(
            'bank_list' => $bank_list,
            'user' => $user,
        ));
    }
}
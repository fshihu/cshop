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
            if($money > $user['user_money']){
                throw new CErrorException('金额太大');
            }
            InsertModel::make('extract_apply')->addData(array(
                'uid' => $user['user_id'],
                'money' => $money,
                'status' => 0,
                'bank_id' => $bank_id,
                'c_time' => time(),
            ))->execute();
            return new \CJsonData();
        }
        $bank_list = ListModel::make('users_bank')->addColumnsCondition(array(
            'user_id' => $user['user_id']
        ))->order('id desc')->execute();
        return new \CRenderData(array(
            'bank_list' => $bank_list,
            'user' => $user,
        ));
    }
}
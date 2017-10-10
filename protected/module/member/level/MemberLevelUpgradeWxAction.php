<?php
/**
 * User: fu
 * Date: 2017/10/7
 * Time: 23:25
 */

namespace module\member\level;


use biz\Session;
use CC\db\base\select\ItemModel;
use CC\db\base\update\UpdateModel;
use CErrorException;
use CRequest;
use module\cart\index\server\OrderServer;
use module\cart\index\server\PromTypeEnum;
use module\member\index\server\UserLevelServer;

class MemberLevelUpgradeWxAction extends \CAction
{
    public $level;
    public $give_id;
    public $update_type;
    public $money;
    public function execute(CRequest $request)
    {
        ///wx/member/level/upgrade?level=2&update_type=2
        if($this->update_type == UserLevelServer::LEVEL_UPGRADE_TRUN_MONEY){
            $id = OrderServer::addOrderBaseInfo(Session::getUserID(),$this->money,PromTypeEnum::USER_LEVEL_UPGRADE_TRUN_MONEY,Session::getUserID());
            return new \CRedirectData('pay/index/index',['order_id' => $id]);
        }
        if($this->update_type == UserLevelServer::LEVEL_UPGRADE_FRIEND_GIVE){
            $item = ItemModel::make('black_card_give')->addId($this->give_id)->addColumnsCondition(array(
                'give_uid' => Session::getUserID(),
            ))->execute();
            if(!$item){
                throw new CErrorException('没有卡');
            }
            UpdateModel::make('black_card_give')->addData(array(
                'status' => UserLevelServer::BLACK_STATSU_GIVEED
            ))->addId($this->give_id)->execute();

            UserLevelServer::updateLevel(Session::getUserID(),$this->level);
        }
        return new \CJsonData();
    }
}
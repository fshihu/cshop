<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/26
 * Time: 11:33
 */

namespace module\member\gold;


use biz\input\CaptchaInput;
use CC\db\base\insert\InsertModel;
use CC\db\base\select\ItemModel;
use CC\util\common\widget\form\IFormViewBuilder;
use CC\util\common\widget\form\IInput;
use CC\util\common\widget\form\TextInput;
use CErrorException;
use CRequest;
use module\basic\phone\server\PhoneServer;
use module\member\gold\server\UserGoldRecordServer;
use module\member\index\UserServer;

class MemberGoldGiveWxAction extends \CAction implements IFormViewBuilder
{
    public function execute(CRequest $request)
    {
        $user = UserServer::getUser();
        if($request->hasPost()){
            $account = $request->getParams('account');
            $gold = $request->getParams('gold');
            $item = ItemModel::make('users')->addColumnsCondition(array(
                'mobile' => $account,
            ))->execute();
            PhoneServer::checkCode(UserServer::getPhone(), $request->getParams('code'));
            if($item['user_id'] == $user['user_id']){
                throw new CErrorException('不能转给自己');
            }
            if(!$item){
                throw new CErrorException('转增账号不存在');
            }
            if($gold <= 0){
                throw new CErrorException('积分格式错误');
            }
            if($gold > $user['gold']){
                throw new CErrorException('积分太大');
            }

            UserGoldRecordServer::addGold($user['user_id'],UserGoldRecordServer::TYPE_GIVE,-$gold,'转增积分',$item['user_id']);;
            UserGoldRecordServer::addGold($item['user_id'],UserGoldRecordServer::TYPE_REVICE_GIVE,$gold,'收到转增积分',$user['user_id']);;
            //give
            PhoneServer::sendMsg($account,'您的好友'.$user['nickname'].'转赠成功您'.$gold.'积分，转赠时间'.date('Y-m-d H:i:s').'。');
            PhoneServer::sendMsg($user['mobile'],'您成功转赠好友'.$item['nickname'].'积分'.$gold.'，转赠时间'.date('Y-m-d H:i:s').'。');
            return new \CJsonData();
        }
        return new \CRenderData(array(
            'user' => $user,
        ));
    }
    protected function getIsOpenTransaction()
    {
        return true;
    }

    /**
     * @return  IInput[]
     */
    public function createFormInputs()
    {
        return array(
            (new TextInput('account','转赠好友账号'))->setPlaceHolder('请输入转赠好友手机号'),
            (new TextInput('gold','转赠积分数'))->setPlaceHolder('请输入转赠积分数'),
            (new CaptchaInput('code','验证码'))->setPhoneId('own_phone'),
        );
    }
}
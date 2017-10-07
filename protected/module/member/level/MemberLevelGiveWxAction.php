<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 16:24
 */

namespace module\member\level;


use biz\input\CaptchaInput;
use biz\Session;
use CC\db\base\select\ItemModel;
use CC\db\base\update\UpdateModel;
use CC\util\common\widget\form\IFormViewBuilder;
use CC\util\common\widget\form\IInput;
use CC\util\common\widget\form\TextInput;
use CErrorException;
use CRequest;
use module\member\index\server\UserLevelServer;
use module\member\index\UserServer;

class MemberLevelGiveWxAction extends \CAction implements IFormViewBuilder
{
    public function execute(CRequest $request)
    {
        $id = $request->getParams('id');
        $black_card_give = ItemModel::make('black_card_give')->addId($id)->addColumnsCondition(array(
            'uid' => Session::getUserID(),
        ))->execute();
        if(!$black_card_give){
            throw new CErrorException('卡错误');
        }
        $user = UserServer::getUser();
        if($request->hasPost()){
            $account = $request->getParams('account');
            $item = ItemModel::make('users')->addColumnsCondition(array(
                'user_id' => $account,
            ))->execute();
            if($item['user_id'] == $user['user_id']){
                throw new CErrorException('不能转增给自己');
            }
            if(!$item){
                throw new CErrorException('转增账号不存在');
            }
            UpdateModel::make('black_card_give')->addId($id)->addData(array(
                'status' => UserLevelServer::BLACK_STATSU_WAIT_GIVE,
                'give_uid' => $item['user_id'],
            ))->execute();
            return new \CJsonData();
        }
        return new \CRenderData(array(
            'black_card_give' => $black_card_give,
            'user' => $user,
        ));
    }

    /**
     * @return  IInput[]
     */
    public function createFormInputs()
    {
        return array(
            (new TextInput('account','转赠好友账号'))->setPlaceHolder('请输入转赠好友账号'),
            new CaptchaInput('code','验证码'),
        );
    }
}
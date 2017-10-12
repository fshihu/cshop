<?php
/**
 * User: fu
 * Date: 2017/10/11
 * Time: 2:33
 */

namespace module\member\merchant;


use biz\action\SaveAction;
use biz\Session;
use CC\db\base\insert\InsertModel;
use CC\db\base\select\ItemModel;
use CErrorException;
use CRequest;

class MemberMerchantEnterWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        if($request->hasPost()){
            $account = $request->getParams('account');
            if(ItemModel::make('merchant')->addColumnsCondition(array('account'=>$account))->execute()){
                throw new CErrorException('用户名已存在，请重新输入');
            }
            unset($_POST['repet_pwd']);
            $_POST['uid'] = Session::getUserID();
            $_POST['c_time'] = time();
            InsertModel::make('merchant')->addData($_POST)->execute();
            return new \CJsonData();
        }
        $merchant = ItemModel::make('merchant')->addColumnsCondition(array('uid'=>Session::getUserID()))
            ->order('id desc')->execute();
        return new \CRenderData(array(
            'merchant' => $merchant,
        ));
    }
}
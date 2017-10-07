<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/26
 * Time: 11:58
 */

namespace module\member\msg;


use biz\action\ListAction;
use biz\Session;
use CC\db\base\select\ItemModel;
use CC\db\base\update\UpdateModel;
use CRequest;

class MemberMsgIndexWxAction extends ListAction
{
    protected function onExecute()
    {
        $item = ItemModel::make('sys_msg')->order('id desc')->execute();
        UpdateModel::make('user')->addData(array(
            'max_msg_id' => $item['id']
        ))->addColumnsCondition(array(
            'user_id' => Session::getUserID(),
        ))->execute();
        return parent::onExecute();
    }

    protected function getTable()
    {
        return 'sys_msg';
    }
}
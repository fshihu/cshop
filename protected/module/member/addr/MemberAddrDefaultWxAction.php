<?php
/**
 * User: fu
 * Date: 2017/10/8
 * Time: 17:29
 */

namespace module\member\addr;


use biz\Session;
use CC\db\base\update\UpdateModel;
use CRequest;

class MemberAddrDefaultWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        UpdateModel::make('user_address')->addColumnsCondition(array(
            'user_id' => Session::getUserID(),
        ))->addData(array(
            'is_default' => 0,
        ))->execute();
        UpdateModel::make('user_address')->addColumnsCondition(array(
            'user_id' => Session::getUserID(),
            'address_id' => $request->getParams('id'),
        ))->addData(array(
            'is_default' => 1,
        ))->execute();
        return new \CJsonData();
    }
}
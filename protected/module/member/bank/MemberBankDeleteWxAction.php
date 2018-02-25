<?php
/**
 * User: fu
 * Date: 2017/10/2
 * Time: 18:18
 */

namespace module\member\bank;


use biz\Session;
use CC\db\base\delete\DeleteModel;
use CRequest;

class MemberBankDeleteWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        DeleteModel::make('users_bank')->addColumnsCondition(array(
            'user_id' => Session::getUserID(),
            'id' => $request->getParams('id'),
        ))->execute();
        return new \CJsonData();
    }
}
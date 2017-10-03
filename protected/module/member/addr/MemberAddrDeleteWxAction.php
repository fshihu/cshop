<?php
/**
 * User: fu
 * Date: 2017/10/3
 * Time: 22:40
 */

namespace module\member\addr;

use biz\Session;
use CC\db\base\delete\DeleteModel;
use CRequest;

class MemberAddrDeleteWxAction extends \CAction
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
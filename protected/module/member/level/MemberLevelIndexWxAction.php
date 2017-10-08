<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 15:55
 */

namespace module\member\level;


use CC\db\base\select\ItemModel;
use CRequest;
use module\member\index\server\UserLevelServer;
use module\member\index\UserServer;

class MemberLevelIndexWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        $user = UserServer::getUser();
        $black_card_give = ItemModel::make('black_card_give')->addColumnsCondition(array(
            'give_uid' => $user['user_id'],
            'status' => UserLevelServer::BLACK_STATSU_WAIT_GIVE,
        ))->execute();
        return new \CRenderData(array(
            'user' => $user,
            'black_card_give' => $black_card_give,
        ));
    }
}
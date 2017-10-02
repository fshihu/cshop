<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/19
 * Time: 17:25
 */

namespace module\member\index;


use biz\Session;
use CC\db\base\select\ItemModel;
use CRequest;

class MemberIndexIndexWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        $user = ItemModel::make('users')->addColumnsCondition(array(
            'user_id' => Session::getUserID(),
        ))->execute();
        $total = ItemModel::make('users')->addColumnsCondition(array(
            'first_leader' => Session::getUserID(),
        ))->select('count(*) count_num')->execute();
        $user['recomm_count'] = (int)$total['count_num'];
        return new \CRenderData(array(
            'user' => $user,
        ));
    }
}
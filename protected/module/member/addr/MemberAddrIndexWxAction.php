<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/19
 * Time: 18:16
 */

namespace module\member\addr;



use biz\Session;
use CC\db\base\select\ListModel;
use CRequest;

class MemberAddrIndexWxAction extends \CAction
{
    public $is_sel;
    public function execute(CRequest $request)
    {
        $list = ListModel::make('user_address')
            ->select('t.*,p.name p_name,c.name c_name,d.name d_name')
            ->leftJoin('region','p','t.province = p.id')
            ->leftJoin('region','c','t.city = c.id')
            ->leftJoin('region','d','t.district = d.id')
            ->addColumnsCondition(array(
            'user_id' => Session::getUserID(),
        ))->execute();
        return new \CRenderData(array(
            'list' => $list,
            'is_sel' => $this->is_sel,
        ));
    }


}
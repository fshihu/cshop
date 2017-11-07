<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/19
 * Time: 15:11
 */

namespace module\groupon\pay;


use biz\Session;
use CC\db\base\select\ItemModel;
use CRequest;

class GrouponPayIndexWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        $addr_condition = array(
            'user_id' => Session::getUserID(),
        );
        if($request->getParams('sel_addr_id')){
            $addr_condition['address_id'] = $request->getParams('sel_addr_id');
        }else{
            $addr_condition['is_default'] = 1;
        }
        $addr = ItemModel::make('user_address')
            ->select('t.*,p.name p_name,c.name c_name,d.name d_name')
            ->leftJoin('region','p','t.province = p.id')
            ->leftJoin('region','c','t.city = c.id')
            ->leftJoin('region','d','t.district = d.id')
            ->addColumnsCondition($addr_condition)->execute();

        return new \CRenderData(array(
            'addr' => $addr,
        ));
    }
}
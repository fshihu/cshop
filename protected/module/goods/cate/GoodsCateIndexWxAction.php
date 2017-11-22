<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/18
 * Time: 17:47
 */

namespace module\goods\cate;


use CC\db\base\select\ListModel;
use CRequest;

class GoodsCateIndexWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        $list =  ListModel::make('goods_category')->addColumnsCondition(array(
            'is_show' => 1,
        ))->execute();
        return new \CRenderData(array(
            'list' => $list,
        ));
    }
}
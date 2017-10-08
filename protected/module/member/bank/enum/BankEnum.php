<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/26
 * Time: 12:27
 */

namespace module\member\bank\enum;


use CC\db\base\select\ListModel;
use CC\util\db\Enum;

class BankEnum extends Enum
{

    protected function initAddDatas()
    {
        $list = ListModel::make('bank')->execute();
        $this->addForList($list,'id','name');
    }

    public static function getIconByIndex($bank_name)
    {
        $list = ListModel::make('bank')->execute();
        $list = array_column($list,'image','id');
        return $list[$bank_name] ;
    }
}
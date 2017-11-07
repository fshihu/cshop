<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/18
 * Time: 17:53
 */

namespace module\service\index;


use biz\action\ListAction;
use CRequest;

class ServiceIndexIndexWxAction extends ListAction
{
    protected function getTable()
    {
        return 'service';
    }
}
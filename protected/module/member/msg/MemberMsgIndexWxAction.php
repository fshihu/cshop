<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/26
 * Time: 11:58
 */

namespace module\member\msg;


use biz\action\ListAction;
use CRequest;

class MemberMsgIndexWxAction extends ListAction
{
    protected function getTable()
    {
        return 'sys_msg';
    }
}
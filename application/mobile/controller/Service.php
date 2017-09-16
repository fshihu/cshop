<?php
/**
 * User: fu
 * Date: 2017/9/16
 * Time: 18:05
 */

namespace app\mobile\controller;


class Service extends MobileBase
{
    public function serviceList()
    {
        return $this->fetch();
    }

}
<?php
/**
 * User: fu
 * Date: 2017/9/27
 * Time: 0:58
 */

namespace biz;


use CC\util\common\server\SessionAbs;

class Session extends SessionAbs
{
    public static function getUserID()
    {
        return 2;
    }

    public static function getName()
    {
        return '张三';
    }
}
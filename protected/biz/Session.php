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

    public static function setCartPromType($prom_type)
    {
        self::set('cart_prom_type',$prom_type);
    }
    public static function getCartPromType()
    {
        return self::get('cart_prom_type');
    }

    public static function getUserID()
    {
        return 2593;
//        return parent::getUserID();
    }

    public static function setWxUser($user_info)
    {
        self::set('wx_user',$user_info);
    }

    public static function getWxUser()
    {
        return self::get('wx_user');
    }
}
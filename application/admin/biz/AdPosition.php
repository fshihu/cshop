<?php
namespace app\admin\biz;

/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/26
 * Time: 16:00
 */
class AdPosition
{
    const HOME = 1;
    public static function getAll()
    {

        return array(
            array(
                'position_id' => self::HOME,
                'position_name' => '首页',
                'is_open' => 1,
            ),

        );
    }
}
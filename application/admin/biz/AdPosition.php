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
    const NEWS = 2;
    const GROUP = 3;
    const CATE_LIST = 4;
    public static function getAll()
    {

        return array(
            array(
                'position_id' => self::HOME,
                'position_name' => '首页',
                'is_open' => 1,
            ),
            array(
                'position_id' => self::NEWS,
                'position_name' => '资讯',
                'is_open' => 1,
            ),
            array(
                'position_id' => self::GROUP,
                'position_name' => '团购',
                'is_open' => 1,
            ),
            array(
                'position_id' => self::CATE_LIST,
                'position_name' => '分类列表页',
                'is_open' => 1,
            ),

        );
    }
}
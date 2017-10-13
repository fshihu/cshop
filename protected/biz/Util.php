<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/18
 * Time: 17:31
 */

namespace biz;


use CC;

class Util
{
    public static function getFooterNav()
    {
        return CC::app()->basePath.'/module/layouts/footer_nav.php';
    }

    public static function subString($str,$len)
    {
        if(mb_strlen($str,'utf-8') > $len){
            return mb_substr($str,0,$len,'utf-8').'...';
        }
        return $str;
    }
}
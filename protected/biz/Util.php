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

    public static function isPageMy()
    {
        $actionStr = CC::app()->url->getActionStr();
        $b = in_array($actionStr,['/member/index/index']);
        return $b ? '1' :'';
    }
    public static function isPageHome()
    {
        $actionStr = CC::app()->url->getActionStr();
        $b = in_array($actionStr,['/home/index/index','/goods/det/index']);
        return $b ? '1' :'';
    }
    public static function isPageCate()
    {
        $b = CC::app()->url->getActionStr() == '/goods/cate/index';
        return $b ? '1' :'';
    }

    public static function isPageServer()
    {
        $b = CC::app()->url->getActionStr() == '/service/index/index';
        return $b?'1':'';
    }
    public static function isPageNews()
    {
        $b = CC::app()->url->getActionStr() == '/news/index/index';
        return $b?'1':'';
    }
    public static function subString($str,$len)
    {
        if(mb_strlen($str,'utf-8') > $len){
            return mb_substr($str,0,$len,'utf-8').'...';
        }
        return $str;
    }
}
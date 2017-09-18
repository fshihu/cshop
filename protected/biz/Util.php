<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/18
 * Time: 17:31
 */

namespace biz;


class Util
{
    public static function getFooterNav()
    {
        return CC::app()->basePath.'/module/layouts/footer_nav.php';
    }
}
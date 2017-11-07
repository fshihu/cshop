<?php
namespace biz\action;
use CC\db\base\select\ListModel;

/**
 * User: fu
 * Date: 2017/9/26
 * Time: 22:26
 */
class ListAction extends \CC\action\ListAction
{

    protected function getDataType()
    {
        return 'render';
    }


}
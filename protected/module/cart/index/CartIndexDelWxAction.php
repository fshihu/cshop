<?php
/**
 * User: fu
 * Date: 2017/9/27
 * Time: 1:35
 */

namespace module\cart\index;


use CC\action\DeleteAction;
use CRequest;

class CartIndexDelWxAction extends DeleteAction
{
    protected function getTable()
    {
        return 'cart';
    }
}
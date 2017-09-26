<?php
/**
 * User: fu
 * Date: 2017/9/27
 * Time: 1:35
 */

namespace module\cart\index;


use CRequest;

class CartIndexDelWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        $id = $request->getParams('id');

        return new \CJsonData();
    }

}
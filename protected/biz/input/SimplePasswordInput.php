<?php
/**
 * User: fu
 * Date: 2017/10/2
 * Time: 18:23
 */

namespace biz\input;


use CC\util\common\widget\form\TextInput;

class SimplePasswordInput extends TextInput
{
    /**
     * @return string
     */
    protected function getType()
    {
        return 'password';
    }
}
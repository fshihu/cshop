<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 15:32
 */

namespace module\member\addr;

use biz\input\AddrInput;
use CC\action\SaveAction;
use CC\util\common\widget\form\creator\PostNamesCreator;
use CC\util\common\widget\form\IFormViewBuilder;
use CC\util\common\widget\form\IInput;
use CC\util\common\widget\form\SubmitInput;
use CC\util\common\widget\form\TextInput;
use CRequest;

class MemberAddrAddWxAction extends SaveAction implements IFormViewBuilder
{
    public function execute(CRequest $request)
    {
        return new \CRenderData();
    }

    /**
     * @return  IInput[]
     */
    public function createFormInputs()
    {
        return array(
            (new TextInput('name','姓名'))->setPlaceHolder('请输入姓名'),
            (new TextInput('name','手机号'))->setPlaceHolder('请输入手机号'),
            (new AddrInput('name','地址')),
            (new TextInput('name','详细地址'))->setPlaceHolder('请输入详细地址'),
        );
    }

    /**
     * @return string "name,pass"
     */
    protected function getPostNames()
    {
        return PostNamesCreator::create($this);
    }
}
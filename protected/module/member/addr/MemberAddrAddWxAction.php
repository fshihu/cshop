<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 15:32
 */

namespace module\member\addr;

use biz\action\SaveAction;
use biz\input\AddrInput;
use biz\Session;
use CC\db\base\select\ItemModel;
use CC\util\common\widget\form\creator\PostNamesCreator;
use CC\util\common\widget\form\IFormViewBuilder;
use CC\util\common\widget\form\IInput;
use CC\util\common\widget\form\SubmitInput;
use CC\util\common\widget\form\TextInput;
use CRequest;

class MemberAddrAddWxAction extends SaveAction implements IFormViewBuilder
{

    /**
     * @return  IInput[]
     */
    public function createFormInputs()
    {
        return array(
            (new TextInput('consignee','姓名'))->setPlaceHolder('请输入姓名'),
            (new TextInput('mobile','手机号'))->setPlaceHolder('请输入手机号'),
            (new AddrInput('name','地址')),
            (new TextInput('address','详细地址'))->setPlaceHolder('请输入详细地址'),
        );
    }
    protected function onBeforeSave(&$data)
    {
        $data['user_id'] = Session::getUserID();

        $old = ItemModel::make($this->getTable())->addColumnsCondition(array('user_id' => Session::getUserID()))->execute();
        $data['is_default'] = $old?0:1;
    }

    protected function getIdField()
    {
        return 'address_id';
    }

    protected function getTable()
    {
        return 'user_address';
    }

    /**
     * @return string "name,pass"
     */
    protected function getPostNames()
    {
        return PostNamesCreator::create($this);
    }
}
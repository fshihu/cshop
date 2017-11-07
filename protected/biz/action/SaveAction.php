<?php
/**
 * User: fu
 * Date: 2017/9/27
 * Time: 2:02
 */

namespace biz\action;
use CC\action\listHandler\IListBeforeHandler;
use CC\event\EventManager;
use CC\action\listHandler\IListBeforeHandlerCreator;
use CC\action\saveHandler\ISaveAfterHandler;
use CC\action\saveHandler\ISaveBeforeHandler;
use CC\db\base\insert\InsertModel;
use CC\db\base\select\ItemModel;
use CC\db\base\update\UpdateModel;
use CC\util\common\widget\listColumn\builder\JsonBuilder;
use CC\util\common\widget\listColumn\IListColumnsCreator;


abstract class SaveAction extends \CC\action\SaveAction
{
    protected function getIdField()
    {
        return 'id';
    }

    protected function getDetData()
    {
        $id = $this->getId();
        if ($id) {
            return ItemModel::make($this->getTable())->addId($id,$this->getIdField())->execute();
        }
        return null;
    }

    protected function saveData()
    {
        $post_data = $this->getPostData();
        $data = $post_data;
        $handlers = $this->onBeforeSave($data);
        $isAdd = $this->isAdd();
        if (is_array($handlers)) {
            foreach ($handlers as $handler) {
                /**
                 * @var ISaveBeforeHandler $handler
                 */
                $handler->onSaveBefore($data, $this->request, $isAdd, $this);
            }
        }
        $old_data = $this->getDetData();

        $det_data = false;
        $id = null;
        if($this->getIsExecSave()){

            if ($isAdd) {
                $id = InsertModel::make($this->getTable())->addData($data)->execute();
                $this->id = $id;
            } else {
                $id = $this->getId();
                UpdateModel::make($this->getTable())->addConditions(array_merge($this->getUpdateConditions()))->addData($data)->addColumnsCondition(array($this->getIdField() => $id))->execute();
            }

            $det_data = ItemModel::make($this->getTable())->addColumnsCondition(array($this->getIdField() => $id))->execute();
        }
        $data = array_merge((array)$_GET, (array)$_POST, $data,$det_data?$det_data:[]);
        $data['id'] = $id ? $id : $this->getId();

        $handlers = $this->onAfterSave($data);
        if (!is_array($handlers)) {
            $handlers = [];
        }
        EventManager::trigger('actionSaveAfterHandler'.\CC::app()->url->getActionStr(),$handlers);
        foreach ($handlers as $handler) {
            /**
             * @var ISaveAfterHandler $handler
             */
            $handler->onSaveAfter($data, $this->request, $isAdd, $old_data, $this);
        }
        $list = [$this->onSaveExecute($data)];
        $creators = $this->getCreators();
        foreach ($creators as $creator) {
            if ($creator instanceof IListBeforeHandlerCreator) {
                $handlers = $creator->getListBeforeHandler();
                foreach ($handlers as $handler) {
                    /**
                     * @var IListBeforeHandler $handler
                     */
                    $handler->onListBefore($list, $this->request, $this);
                }
            }
        }
        foreach ($creators as $creator) {
            if($creator instanceof IListColumnsCreator){
                $list = JsonBuilder::build($creator, $list);
            }
        }
        return new \CJsonData(array_merge(array(
            'last_url' => $this->getSaveRedirectUrl($data),
        ), isset($list[0]) ? $list[0] : []));
    }

}
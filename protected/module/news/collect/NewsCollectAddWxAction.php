<?php
/**
 * User: fu
 * Date: 2017/9/27
 * Time: 23:44
 */

namespace module\news\collect;


use biz\Session;
use CC\db\base\delete\DeleteModel;
use CC\db\base\insert\InsertModel;
use CC\db\base\select\ItemModel;
use CRequest;

class NewsCollectAddWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        $id = $request->getParams('id');
        if($request->getParams('cancel')){
            DeleteModel::make('article_collect')->addColumnsCondition(array(
                        'uid' => Session::getUserID(),
                        'article_id' => $id,
                    ))->execute();
            return new \CJsonData();
        }
        $old = ItemModel::make('article_collect')->addColumnsCondition(array(
            'uid' => Session::getUserID(),
            'article_id' => $id,
        ))->execute();
        if(!$old){
            InsertModel::make('article_collect')->addData(array(
                'uid' => Session::getUserID(),
                'article_id' => $id,
            ))->execute();
        }
        return new \CJsonData();
    }
}
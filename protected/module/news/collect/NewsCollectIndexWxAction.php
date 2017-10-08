<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 16:49
 */

namespace module\news\collect;


use biz\action\ListAction;
use biz\Session;
use CRequest;

class NewsCollectIndexWxAction extends ListAction
{
    public $type = 0;
    protected function getTable()
    {
        return 'article_collect';
    }
    protected function onExecute()
    {
        return [
            'type' => $this->type,
        ];
    }

    protected function getSearchCondition()
    {
        $this->dbCondition->addColumnsCondition(array(
            't.uid' => Session::getUserID(),
        ))->leftJoin('article','a','t.article_id = a.article_id')
            ->select('a.*');
    }
}
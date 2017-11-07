<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/18
 * Time: 17:53
 */

namespace module\news\index;


use app\admin\biz\AdPosition;
use biz\action\ListAction;
use CC\db\base\core\condition\EqualCondition;
use CC\db\base\select\ListModel;
use CRequest;
use module\ad\index\AdServer;

class NewsIndexIndexWxAction extends ListAction
{
    public $cate_id;
    protected function getSearchCondition()
    {
        $this->dbCondition->addConditions(array(
            new EqualCondition('cate_id','cat_id'),
        ));
    }
    protected function getTable()
    {
        return 'article';
    }

    public function onExecute()
    {
        $cate_list = ListModel::make('article_cat')->execute();
        return (array(
            'cate_list' => $cate_list,
            'cate_id' => $this->cate_id,
            'ad_list' => AdServer::getList(AdPosition::NEWS),
        ));
    }
}
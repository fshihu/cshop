<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 16:35
 */

namespace module\news\index;


use CC\db\base\select\ItemModel;
use CRequest;

class NewsIndexDetWxAction extends \CAction
{
    public $id;
    public function execute(CRequest $request)
    {
        return new \CRenderData(array(
            'data' => ItemModel::make('article')->addColumnsCondition(array(
                'article_id' => $this->id,
            ))->execute(),
        ));
    }
}
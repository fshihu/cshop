<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/18
 * Time: 18:14
 */

namespace module\goods\det;


use biz\Session;
use CC\db\base\select\ItemModel;
use CC\db\base\select\ListModel;
use CC\util\arr\ArrayUtil;
use CRequest;
use module\groupon\index\enum\GroupTypeEnum;
use module\member\index\UserServer;

class GoodsDetIndexWxAction  extends \CAction
{
    public function execute(CRequest $request)
    {

        $id = $request->getParams('id');
        $data = ItemModel::make('goods')->addColumnsCondition(array(
            'goods_id' => $id,
        ))->execute();
        if(!$data['is_on_sale']){
            throw new \CErrorException('商品未上架');
        }
        $goods_images = ListModel::make('goods_images')->addColumnsCondition(array(
            'goods_id' => $id,
        ))->execute();
        $spec_goods_prices = ListModel::make('spec_goods_price')->addColumnsCondition(array(
            'goods_id' => $id,
        ))->execute();
        $specs = ListModel::make('spec')->addColumnsCondition(array(
            'type_id' => $data['goods_type'],
        ))->execute();
        $spec_items = ListModel::make('spec_item')->addColumnsCondition(array(
            'spec_id' => ['in',ArrayUtil::arrayColumn($specs)],
        ))->execute();
        $comment_list = ListModel::make('comment')->addColumnsCondition(array(
            'goods_id' => $id,
        ))->leftJoin('users','u','t.user_id = u.user_id')->order('t.comment_id desc')
            ->select('t.comment_reply,t.content comment_content,t.rating,t.add_time comment_time,u.nickname uname,u.head_pic ')->execute();

        $other_group_buys = ListModel::make('group_one')->addColumnsCondition(array(
            'is_finish' => 0,
            'pay_status' => 1,
            'group_buy_id' => 0,
            'goods_id' => $id,
            'group_type' => GroupTypeEnum::TYPE_OWN,
        ))->select('t.*,u.nickname,u.head_pic')->leftJoin('users','u','t.uid = u.user_id')->execute();
        $user = ItemModel::make('users')->addColumnsCondition(array('admin_uid' =>$data['admin_uid']))->execute();
        $merchant = ItemModel::make('merchant')->addColumnsCondition(array('uid' => $user['user_id']))->execute();
        $recomm_list = ListModel::make('goods')->addColumnsCondition(array(
            'cat_id' => $data['cat_id'],
            'goods_id' =>[ '!=' , $data['goods_id']],
        ))->limit(4)->order('rand()')->execute();
        $list = ListModel::make('sys_conf')->execute();
        $sys_conf = [];
        foreach ($list as $item) {
            $sys_conf[$item['name']] = $item['val'];
        }
        return new \CRenderData(array(
            'data' => $data,
            'goods_images' => $goods_images,
            'comment_list' => $comment_list,
            'spec_goods_prices' => ArrayUtil::arrayFillKey($spec_goods_prices,'key'),
            'specs' => $specs,
            'spec_items' => $spec_items,
            'other_group_buys' => $other_group_buys,
            'merchant' => $merchant,
            'recomm_list' =>$recomm_list,
            'sys_conf' =>$sys_conf,
        ));
    }
}
<?php
/**
 * User: fu
 * Date: 2017/9/27
 * Time: 1:41
 */

namespace module\basic\region;


use CC\db\base\select\ListModel;
use CRequest;

class BasicRegionIndexAction extends \CAction
{
    public function execute(CRequest $request)
    {
        $parent_id = $request->getParams('parent_id');
        $selected = $request->getParams('selected');
        $data = ListModel::make('region')->addColumnsCondition(array(
            'parent_id' => $parent_id,
        ))->execute();
        $html = '';
        if($data){
            foreach($data as $h){
            	if($h['id'] == $selected){
            		$html .= "<option value='{$h['id']}' selected>{$h['name']}</option>";
            	}
                $html .= "<option value='{$h['id']}'>{$h['name']}</option>";
            }
        }
        return new \CStringData($html);
    }
}
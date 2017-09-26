<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/6/27
 * Time: 14:28
 */

namespace biz\encrpty;


class RecommCode
{
    public static function encode($id)
    {
        if($id <= 0){
            return '';
        }
        $id_str = (string)$id;
        $id= ($id+10000).str_pad(substr($id_str,strlen($id_str)-1)*99,3,'0',STR_PAD_LEFT);
        $code =  base_convert($id,10,16);
        return $code;
    }

    public static function decode($code)
    {
        $idstr = base_convert($code,16,10);
        $id = substr($idstr,0,-3)-10000;
        return $id;
    }

}
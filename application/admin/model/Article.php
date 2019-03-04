<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/1
 * Time: 16:27
 */

namespace app\admin\model;


use think\Model;

class Article extends Model
{
    public function cate(){
        return $this->belongsTo('cate','cateid');
    }
}
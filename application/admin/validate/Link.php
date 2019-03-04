<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/1
 * Time: 17:26
 */

namespace app\admin\validate;


use think\Validate;

class Link extends Validate
{
    protected $rule = [
        'title'  =>  'require|max:25',
        'url' =>  'require',
    ];

    protected $message  =   [
        'title.require' => '链接标题必须填写',
        'title.max' => '链接标题长度不得大于25位',
        'url.require' => '链接地址必须填写',

    ];

    protected $scene = [
        'add'  =>  ['title','url'],
        'edit'  =>  ['title','url'],
    ];
}
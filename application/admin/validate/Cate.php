<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/1
 * Time: 17:26
 */

namespace app\admin\validate;


use think\Validate;

class Cate extends Validate
{
    protected $rule = [
        'catename'  =>  'require|max:5|unique:cate',
    ];

    protected $message  =   [
        'catename.require' => '栏目必须填写',
        'catename.unique' => '栏目名称不能重复',
        'catename.max' => '栏目标题长度不得大于5位',

    ];

    protected $scene = [
        'add'  =>  ['catename' =>'require|unique'],
        'edit'  =>  ['catename' =>'require|unique'],
    ];
}
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/1
 * Time: 17:26
 */

namespace app\admin\validate;


use think\Validate;

class Admin extends Validate
{
    protected $rule =   [
        'title'  => 'require|unique:article',
        'author'   => 'require',
        'desc'  => 'require',
        'keywords'   => 'require',
        'content'   => 'require',
        'cateid'  => 'require',
        'pic'=>'require'
    ];

    protected $message  =   [
        'title.require' => '文章名称必须',
        'title.unique'     => '文章名称已存在',
        'author.require'   => '作者必须填写',
        'desc.require'   => '描述必须填写',
        'keywords.require'   => '关键字必须填写',
        'content.require'   => '内容必须填写',
        'cateid.require'   => '分类id必须填写',
        'pic.require'   => '缩略图必须上传',
    ];

    protected $scene= [
        'add' => ['title'=>'require|unique','author','desc','keywords','content','cateid','pic'],
        'add' => ['title'=>'require','author','desc','keywords','content','cateid','pic']
    ];
}
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/5
 * Time: 9:50
 */

namespace app\admin\controller;


use think\Controller;

class Base extends Controller
{
    protected $id;
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->id =session('uid');
        if (!$this->id){
            $this->error('请先登录','login/login');
        }
    }
}
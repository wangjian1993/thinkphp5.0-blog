<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Cate extends Common
{
    public function index($cateID)
    {
        $article =Db::name('article')->where('cateid',$cateID)->paginate();
        $cate =Db::name('cate')->where('id',$cateID)->find();
        return $this->fetch('',[
            'article' =>$article,
            'cate' =>$cate
        ]);
    }
}

<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Index extends Common
{
    public function index()
    {
        $article =Db::name('article')->order(['id'=>'desc','status'=>1])->paginate(5);
        return $this->fetch('',[
            'article' =>$article
        ]);
    }
}

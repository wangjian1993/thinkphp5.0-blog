<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Article extends Common
{
    public function index()
    {
        $arid=input('arid');
        $articles=Db::name('article')->find($arid);
        $ralateres=$this->ralat($articles['keywords'],$articles['id']);
        dump($ralateres);die();
        Db::name('article')->where('id','=',$arid)->setInc('click');
        $cates=Db::name('cate')->find($articles['cateid']);
        $recres=Db::name('article')->where(array('cateid'=>$cates['id'],'status'=>1))->limit(8)->select();
        return $this->fetch('',[
            'articles'=>$articles,
            'cates'=>$cates,
            'recres'=>$recres,
            'ralateres'=>$ralateres
        ]);
    }


    public function ralat($keywords,$id){
        $arr=explode(',', $keywords);
        static $ralateres=array();
        foreach ($arr as $k=>$v) {
            $map['keywords']=['like','%'.$v.'%'];
            $map['id']=['neq',$id];
            $artres=Db::name('article')->where($map)->order('id desc')->limit(8)->select();
            $ralateres=array_merge($ralateres,$artres);
        }
        if($ralateres){
            $ralateres=arr_unique($ralateres);
            return $ralateres;
        }
    }
}

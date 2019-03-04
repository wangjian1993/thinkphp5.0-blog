<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/1
 * Time: 16:27
 */

namespace app\admin\model;


use think\Db;
use think\Model;

class Admin extends Model
{
    public function login($data)
    {
//        dump($data);die;
        $captcha = new \think\captcha\Captcha();
        if( !$captcha->check($data['code']))
        {
            return 4;
        }
        $user=Db::name('admin')->where('username','=',$data['username'])->find();
        if ($user){
            if ($user['password'] == md5($data['password'])){
                session('username',$user['username']);
                session('uid',$user['id']);
                return 3;  //登录成功
            }else{
                return 2; //密码错误
            }
        }else{
            return 1;  //用户名错误
        }
    }
}
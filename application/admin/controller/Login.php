<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/2
 * Time: 16:24
 */

namespace app\admin\controller;


use think\captcha\Captcha;
use think\Controller;
use think\Request;
use app\admin\model\Admin;

class Login extends Controller
{
    public function login(Request $request)
    {
        if ($request->isPost()) {
            $admin = new Admin();
            $data = input('post.');
            $num =$admin->login($data);
            if ($num == 3) {
                $this->success('登录成功', 'index/index');
            }elseif ($num ==4){
                $this->error('验证码错误');
            }else{
                $this->error('用户名或者密码错误');
            }
        }
        return $this->fetch();
    }

    /**
     * @return mixed验证码
     */
    public function verify()
    {
        $config = [
            // 验证码字体大小
            'fontSize' => 28,
            // 验证码位数
            'length' => 4,
            // 关闭验证码杂点
            'useNoise' => true,
            // 验证码图片高度
            'imageH'   => 60,
            // 验证码图片宽度
            'imageW'   => 200,
            // 验证码过期时间（s）
            'expire'   => 1800,
        ];
        $captcha =new Captcha($config);
        return $captcha->entry();
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/1
 * Time: 14:49
 */

namespace app\admin\controller;


use think\Controller;
use think\Db;
use think\Request;
use think\Validate;

class Admin extends Base
{
    protected $model;

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->model = Db::name('admin');
    }

    public function index()
    {
        $result = $this->model->where('status', 1)->order('id', 'desc')->paginate();
        return $this->fetch('', [
            'result' => $result,
        ]);
    }

    /**
     * @param Request $request
     * @return mixed|void
     * 添加管理员
     */
    public function add(Request $request)
    {
        if ($request->isPost()) {
            $data = [
                'username' => input('username'),
                'password' => md5(input('password')),
                'status' => '1'
            ];
            $validate = new \app\admin\validate\Admin;
            if (!$validate->scene('add')->check($data)) {
                $this->error($validate->getError());
                die();
            }
            if ($this->model->insert($data)) {
                return $this->success('添加管理员成功', 'index');
            } else {
                return $this->error('管理员添加失败');
            }
        };
        return $this->fetch();
    }

    public function edit($id, Request $request)
    {
        $result = $this->model->where('id', $id)->find();
        if ($request->isPost()) {
            $data = [
                'id' => input('id'),
                'username' => input('username'),
            ];
            if (input('password')) {
                $data['password'] = md5(input('password'));
            }else{
                $data['password'] = $result['password'];
            }
            $validate = new \app\admin\validate\Admin;
            if (!$validate->scene('add')->check($data)) {
                $this->error($validate->getError());
                die();
            }
            if ($this->model->update($data)) {
                return $this->success('修改管理员成功', 'index');
            } else {
                return $this->error('管理员修改失败');
            }
        };
        return $this->fetch('', [
            'result' => $result
        ]);
    }

    /**
     * 删除管理员
     * @param $id  删除的id
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function delete($id)
    {
        if ($id != 2) {
            if ($this->model->where('id', $id)->update(['status' => '0'])) {
                return $this->success('删除管理员成功', 'index');
            } else {
                return $this->error('删除员添加失败');
            }
        } else {
            $this->error('初始管理员不能删除');
        }

    }

    /**
     * 退出登录
     */
    public function logout(){
        session(null);
        $this->success('退出成功','login/login');
    }
}
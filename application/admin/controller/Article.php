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
use app\admin\model\Article as ArticleModel;

class Article extends Base
{
    protected $model;

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->model = Db::name('Article');
    }

    public function index()
    {
//        $result = $this->model->order('id', 'desc')->paginate();
        $result =ArticleModel::order('id', 'desc')->paginate();
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
                'title' => input('title'),
                'author' => input('author'),
                'desc' => input('desc'),
                'keywords'=>str_replace('，', ',', input('keywords')),
                'content' => input('content'),
                'status' => '1',
                'cateid' => input('cateid'),
                'time' => time(),
            ];
//
            if($_FILES['pic']['tmp_name']){
                $file = request()->file('pic');
                $info = $file->move( 'uploads');;
                $data['pic']=$info->getSaveName();
            }
            $validate = new \app\admin\validate\Article;
            if (!$validate->scene('add')->check($data)) {
                $this->error($validate->getError());
                die();
            }
            if ($this->model->insert($data)) {
                return $this->success('添加文章成功', 'index');
            } else {
                return $this->error('添加文章失败');
            }
        };
        $cateres = Db::name('cate')->select();
        return $this->fetch('', [
            'cateres' => $cateres
        ]);
    }

    public function edit($id, Request $request)
    {
        $result = $this->model->where('id', $id)->find();
        if ($request->isPost()) {
            $data = [
                'id' =>input('id'),
                'title' => input('title'),
                'author' => input('author'),
                'desc' => input('desc'),
                'keywords'=>str_replace('，', ',', input('keywords')),
                'content' => input('content'),
                'status' => '1',
                'cateid' => input('cateid'),
                'time' => time(),
            ];
//
            if($_FILES['pic']['tmp_name']){
                $file = request()->file('pic');
                $info = $file->move( 'uploads');;
                $data['pic']=$info->getSaveName();
            }
            $validate = new \app\admin\validate\Cate;
            if (!$validate->scene('edit')->check($data)) {
                $this->error($validate->getError());
                die();
            }
            if ($this->model->update($data)) {
                return $this->success('修改栏目成功', 'index');
            } else {
                return $this->error('链接栏目失败');
            }
        };
        $cateres = Db::name('cate')->select();
        return $this->fetch('', [
            'result' => $result,
            'cateres' => $cateres
        ]);
    }

    /**
     * 删除管理员
     * @param $id  删除的id
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function status($id, $status)
    {
        if ($this->model->where('id', $id)->update(['status' => $status])) {
            return $this->success('修改状态成功', 'index');
        } else {
            return $this->error('修改状态失败');
        }

    }

    /**
     * 图片上传
     */
    public function upload(){
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('pic');
        // 移动到框架应用根目录/uploads/ 目录下
        $info = $file->move( 'public/uploads');
        if($info){
            // 成功上传后 获取上传信息
            return $info->getSaveName();
        }else{
            // 上传失败获取错误信息
            return $file->getError();
        }
    }
}
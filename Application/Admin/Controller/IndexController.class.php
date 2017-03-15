<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Controller;
use User\Api\UserApi as UserApi;

/**
 * 后台首页控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class IndexController extends AdminController {

    /**
     * 后台首页
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function index(){
        if(UID){
            $this->meta_title = '管理首页';
            $this->display();
        } else {
            $this->redirect('Public/login');
        }
    }

    /**
     * 显示二级区域管理账号
     */
    public function qy_hygl(){

        $db_ucenter_member = M('ucenter_member');
        $where_ucenter_memeber['dj'] = 1;
        $list_hygl =$db_ucenter_member ->where($where_ucenter_memeber) -> select();
        $this->assign('list_hygl',$list_hygl);
       // p($list_hygl);die;
        $this->display();
    }

    /**
     * 添加二级区域管理
     */
    public function addqy(){
        $this->display();
    }

    /**
     * 添加二级区域管理动作
     */
    public function addqying(){
        $data_ucenter_member['username'] = I('username');
        $data_ucenter_member['email'] = I('email');
        $data_ucenter_member['password'] = md5(sha1(I['password']) . 'S}->&A]GTOa^Q:dgUqCHn;+38PMz,`ursk)L(~6f');
        $data_ucenter_member['reg_time'] = time();
        $data_ucenter_member['status'] = 1;
        $data_ucenter_member['dj'] = 1;
        //$data_ucenter_member['reg_ip'] = get_client_ip();
        $db_ucenter_member = M('ucenter_member');
        $where_ucenter_member['username'] = I('username');
        $res = $db_ucenter_member->where($where_ucenter_member)->select();
        if ($res == null) {
            $db_ucenter_member->data($data_ucenter_member)->add();
            $this->success('二级会员添加成功', 'Admin/Index/addqy');
        } else {
            $this->error('用户名已存在，请重新输入。');
        }
    }

    /**
     * 添加三级营业部管理
     */
    public function addyyb(){
        $db_ucenter_member = M('ucenter_member');
        $where_ucenter_member['dj']=1 ;
        $list_qy=$db_ucenter_member -> where($where_ucenter_member) -> select();
        $this->assign('list_qy',$list_qy);
        $this->display();
    }

    /**
     * 添加三级营业部管理动作
     */
    public function addyybing(){
        $data_ucenter_member['username'] = I('username');
        $data_ucenter_member['password'] = md5(sha1(I['password']).'S}->&A]GTOa^Q:dgUqCHn;+38PMz,`ursk)L(~6f');
        $data_ucenter_member['email'] = I('email');
        $data_ucenter_member['status'] = 1;
        $data_ucenter_member['qy'] = I('qy');
        $data_ucenter_member['reg_time'] = time();
        $data_ucenter_member['dj'] = 2;
        $db_ucenter_member = M('ucenter_member');
        $where_ucenter_member['username']=I('username');
        $res=$db_ucenter_member->where($where_ucenter_member)->select();
        if($res !== null){
            $this->error('用户名已存在，请重新输入。');
        }else{
            $db_ucenter_member->data($data_ucenter_member)->add();
            $this->success('三级营业部添加成功', 'Admin/Index/addyyb');
        }
    }


    /**
     * 添加四级员工管理
     */
    public function addyg(){
        $db_ucenter_member = M('ucenter_member');
        $where_ucenter_member['dj']=2 ;
        $list_yyb=$db_ucenter_member -> where($where_ucenter_member) -> select();
        $this->assign('list_yyb',$list_yyb);
        $this->display();
    }

    /**
     * 添加四级员工管理动作
     */
    public function addyging(){
        $data_ucenter_member['username'] = I('username');
        $data_ucenter_member['password'] = md5(sha1(I['password']).'S}->&A]GTOa^Q:dgUqCHn;+38PMz,`ursk)L(~6f');
        $data_ucenter_member['status'] = 1;
        $data_ucenter_member['email'] = I('email');
        $data_ucenter_member['reg_time'] = time();
        $data_ucenter_member['dj'] = 3;
        $data_ucenter_member['qy'] = I('yyb');
        $db_ucenter_member = M('ucenter_member');
        $where_ucenter_member['username']=I('username');
        $res=$db_ucenter_member->where($where_ucenter_member)->select();
        if($res !== null){
            $this->error('用户名已存在，请重新输入。');
        }else{
            $db_ucenter_member->data($data_ucenter_member)->add();
            $this->success('四级员工添加成功', 'Admin/Index/addyg');
        }
    }









}

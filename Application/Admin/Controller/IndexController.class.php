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
        $count      = $db_ucenter_member->where($where_ucenter_memeber)->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $list_hygl = $db_ucenter_member->where($where_ucenter_memeber)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list_hygl',$list_hygl);
        $this->assign('_page',$show);// 赋值分页输出
        $this->display();
    }

    /**
     * 显示三级营业部管理账号
     */
    public function yyb_hygl(){
        $db_ucenter_member = M('ucenter_member');
        $where_ucenter_memeber['dj'] = 2;
        $count      = $db_ucenter_member->where($where_ucenter_memeber)->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $list_hygl = $db_ucenter_member->where($where_ucenter_memeber)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list_hygl',$list_hygl);
        $this->assign('_page',$show);// 赋值分页输出
        $this->display();
    }

    /**
     * 显示四级员工管理账号
     */
    public function yg_hygl(){
        $db_ucenter_member = M('ucenter_member');
        $where_ucenter_memeber['dj'] = 3;
        $count      = $db_ucenter_member->where($where_ucenter_memeber)->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $list_hygl = $db_ucenter_member->where($where_ucenter_memeber)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list_hygl',$list_hygl);
        $this->assign('_page',$show);// 赋值分页输出
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
        $data_ucenter_member['password'] = md5(sha1(I('password')) . 'c+o<-,M#~HWuK$^2*yE{iL)NB[9zlhw|Jqr/6ejf');
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
        $data_ucenter_member['password'] = md5(sha1(I('password')).'c+o<-,M#~HWuK$^2*yE{iL)NB[9zlhw|Jqr/6ejf');
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
        $data_ucenter_member['password'] = md5(sha1(I('password')).'c+o<-,M#~HWuK$^2*yE{iL)NB[9zlhw|Jqr/6ejf');
        $data_ucenter_member['status'] = 1;
        $data_ucenter_member['email'] = I('email');
        $data_ucenter_member['reg_time'] = time();
        $data_ucenter_member['dj'] = 3;
        $data_ucenter_member['yyb'] = I('yyb');
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

    /**
     * 二级区域编辑的展示页面
     */
    public function qy_edit(){
        $db_ucenter_member = M('ucenter_member');
        $where_ucenter_member['id']=I('id');
        $qy_edit=$db_ucenter_member->where($where_ucenter_member)->find();
        $this->assign('qy_edit',$qy_edit);
        $this->display('Edit/qy_edit');
    }

    /**
     * 二级区域会员编辑的动作页面
     */
    public function qy_editing(){
        $db_ucenter_member = M('ucenter_member');
        $data_ucenter_member['password'] = md5(sha1(I('password')) . 'c+o<-,M#~HWuK$^2*yE{iL)NB[9zlhw|Jqr/6ejf');
        $where_ucenter_member['id'] = I('id');
        $db_ucenter_member->where($where_ucenter_member)->data($data_ucenter_member)->save();
        $this->success('二级区域修改成功', 'Admin/Index/qy_hygl');

    }

    /**
     * 管理员编辑的删除页面
     */
    public function hy_del(){
        $db_ucenter_member = M('ucenter_member');
        $where_ucenter_member['id'] = I('id');
        $a =$db_ucenter_member->where($where_ucenter_member)->limit('1')->delete();
        $this->success('会员删除成功。', 'Admin/Index/qy_hygl');

    }

    /**
     * 三级营业部编辑的展示页面
     */
    public function yyb_edit(){
        $db_ucenter_member = M('ucenter_member');
        $where_ucenter_member['id']=I('id');  //当前用户的ID
        $yyb_edit = $db_ucenter_member->where($where_ucenter_member)->find();
        $where_ucenter_member1['dj']=1 ;   // 所属上级
        $yyb_edit_2 = $db_ucenter_member->where($where_ucenter_member1)->select();
        $this->assign('yyb_edit',$yyb_edit);
        $this->assign('yyb_edit_2',$yyb_edit_2);
        $this->display('Edit/yyb_edit');
    }

    /**
     * 三级营业部编辑的动作页面
     */
    public function yyb_editing(){
        $db_ucenter_member = M('ucenter_member');
        $data_ucenter_member['password'] = md5(sha1(I('password')) . 'c+o<-,M#~HWuK$^2*yE{iL)NB[9zlhw|Jqr/6ejf');
        $data_ucenter_member['qy'] =I('yyb_edit_2');
        $where_ucenter_member['id'] = I('id');
        $db_ucenter_member->where($where_ucenter_member)->data($data_ucenter_member)->save(); //修改当前会员信息
        $this->success('三级营业部修改成功', 'Admin/Index/yyb_hygl');
    }


    /**
     * 四级员工编辑的展示页面
     */
    public function yg_edit(){
        $db_ucenter_member = M('ucenter_member');
        $where_ucenter_member['id']=I('id');  //当前用户的ID
        $yg_edit = $db_ucenter_member->where($where_ucenter_member)->find();
        $where_ucenter_member1['dj']=2 ;   // 所属上级
        $a = $yg_edit_2 = $db_ucenter_member->where($where_ucenter_member1)->select();
        $this->assign('yg_edit',$yg_edit);
        $this->assign('yg_edit_2',$yg_edit_2);
        $this->display('Edit/yg_edit');
    }

    /**
     * 四级员工编辑的动作页面
     */
    public function yg_editing(){
        $db_ucenter_member = M('ucenter_member');
        $data_ucenter_member['password'] = md5(sha1(I('password')) . 'c+o<-,M#~HWuK$^2*yE{iL)NB[9zlhw|Jqr/6ejf');
        $where_ucenter_member['id'] = I('id');
        $data_ucenter_member['yyb'] = I('yg_edit_2');
        $db_ucenter_member->where($where_ucenter_member)->data($data_ucenter_member)->save(); //修改当前会员信息
        $this->success('四级员工修改成功', 'Admin/Index/yg_hygl');

    }













}
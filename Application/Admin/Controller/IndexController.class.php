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
        $db_ucenter_member = M('ucenter_member');
        $where_ucenter_member['username'] = I('username');
        $res = $db_ucenter_member->where($where_ucenter_member)->select();
        if ($res == null) {
            $ress=$db_ucenter_member->data($data_ucenter_member)->add();
            $db_member=M('member');
            $data['nickname']=$data_ucenter_member['username'];
            $data['status']=1;
            $data['uid']=$ress;
            $db_member->data($data)->add();
            $this->success('二级管理员添加成功', 'Admin/Index/addqy');
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
            $ress=$db_ucenter_member->data($data_ucenter_member)->add();
            $db_member=M('member');
            $data['nickname']=$data_ucenter_member['username'];
            $data['status']=1;
            $data['uid']=$ress;
            $db_member->data($data)->add();
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
            $ress=$db_ucenter_member->data($data_ucenter_member)->add();
            $db_member=M('member');
            $data['nickname']=$data_ucenter_member['username'];
            $data['status']=1;
            $data['uid']=$ress;
            $db_member->data($data)->add();
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
     * 二级区域管理员编辑的动作页面
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
        $this->success('管理员删除成功。', 'Admin/Index/qy_hygl');

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
        $db_ucenter_member->where($where_ucenter_member)->data($data_ucenter_member)->save(); //修改当前管理员信息
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
        $yg_edit_2 = $db_ucenter_member->where($where_ucenter_member1)->select();
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
        $data_ucenter_member['yyb'] = I('yg_edit_2');
        $data_ucenter_member1['username'] = I('yg_edit_2');
        $res = $db_ucenter_member->where($data_ucenter_member1)->find();
        $data_ucenter_member['qy'] = $res['qy'];
        $where_ucenter_member['id'] = I('id');
        $db_ucenter_member->where($where_ucenter_member)->data($data_ucenter_member)->save(); //修改当前管理员信息
        $this->success('四级员工修改成功', 'Admin/Index/yg_hygl');
    }

    /**
     * 客户信息展示表
     */
    public function users(){
        $db_user = M('user');
        if(UID==1){
            $where = null;
        }else{
            $db_ucenter_member = M('ucenter_member');
            $where_id['id']=UID;
            $res=$db_ucenter_member->where($where_id)->find();
            if($res['dj'] == 3 ){
                $where['staff']=$res['username'];
            }elseif($res['dj']== 2){
                $where_yyb['yyb']=$res['username'];
                $array=$db_ucenter_member->field('username')->where($where_yyb)->select();
                for($i=0;$i<count($array);$i++){
                    $array_nul[]=$array[$i]['username'];
                }
                $where['staff']=array('in',$array_nul);
            }elseif ($res['dj']== 1){
                $where_qy['qy']=$res['username'];
                $array_qy=$db_ucenter_member->field('username')->where($where_qy)->select();
                for($i=0;$i<count($array_qy);$i++){
                    $array_qy_num[]=$array_qy[$i]['username'];
                }
                $where_yyb['yyb']=array('in',$array_qy_num);
                $array=$db_ucenter_member->field('username')->where($where_yyb)->select();
                for($i=0;$i<count($array);$i++){
                    $array_nul[]=$array[$i]['username'];
                }
                $where['staff']=array('in',$array_nul);
            }
        }
        if($where == null){
            $count      = $db_user->count();
        }else{
            $count      = $db_user->where($where)->count();
        }
        $Page       = new \Think\Page($count,10);
        $show       = $Page->show();
        if($where == null){
            $user = $db_user-> order('user_id') -> limit($Page->firstRow.','.$Page->listRows) -> select();
        }else{
            $user = $db_user-> order('user_id') ->where($where)-> limit($Page->firstRow.','.$Page->listRows) -> select();
        }
        $this->assign('user',$user);
        $this->assign('_page',$show);
        $this->display('Users/users');
    }

    /**
     * 客户投资记录表
     */
    public function users_invest(){
        $db_invest = M('invest');
        $db_ucenter_member = M('ucenter_member');
        if(UID==1){
            $where = null;
        }else{
            $where_id['id'] = UID;
            $res = $db_ucenter_member -> where($where_id)->find();
            $where_res['dj'] = $res['dj'];
            if($where_res['dj'] == 3){
                $where['staff']=$res['username'];
            }elseif ($where_res['dj'] == 2){
                $where_yyb['yyb']=$res['username'];
                $array=$db_ucenter_member->field('username')->where($where_yyb)->select();
                for($i=0;$i<count($array);$i++){
                    $array_nul[]=$array[$i]['username'];
                }
                $where['staff']=array('in',$array_nul);
            }elseif ($res['dj']== 1){
                $where_qy['qy']=$res['username'];
                $array_qy=$db_ucenter_member->field('username')->where($where_qy)->select();
                for($i=0;$i<count($array_qy);$i++){
                    $array_qy_num[]=$array_qy[$i]['username'];
                }
                $where_yyb['yyb']=array('in',$array_qy_num);
                $array=$db_ucenter_member->field('username')->where($where_yyb)->select();
                for($i=0;$i<count($array);$i++){
                    $array_nul[]=$array[$i]['username'];
                }
                $where['staff']=array('in',$array_nul);
            }
        }
        $where_user['user_id'] = I('user_id');
        if($where == null){
            $count      = $db_invest->where($where_user)->count();
        }else{
            $count      = $db_invest->where($where)->where($where_user)->count();
        }
        $Page       = new \Think\Page($count,10);
        $show       = $Page->show();
        if($where == null){
            $users_invest = $db_invest-> order('id') -> where($where_user) ->limit($Page->firstRow.','.$Page->listRows) -> select();
        }else{
            $users_invest = $db_invest-> order('id') -> where($where_user) -> where($where) -> limit($Page->firstRow.','.$Page->listRows) -> select();
        }
        $this->assign('users_invest',$users_invest);
        $this->assign('_page',$show);
        $this->display('Users/users_invest');
    }

    /**
     *编辑客户邀请人
     */
    public function users_invest_edit(){
        $db_user = M('user');
        $where_user['user_id'] = I('user_id');
        $user =$db_user->where($where_user)->find();
        $this->assign('user',$user);
        $this->display('Users/users_invest_edit');
    }

    /**
     *编辑客户邀请人动作
     */
    public function users_invest_editing(){
        $db_user = M('user');
        $where_user['user_id']= I('user_id');
        $data_user['staff'] = I('staff');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://testwww.ronghedai.com/?user&q=channel_set&channel=aaa&action=sendInfoAll&function=editstaff&user_id=146&staff=333");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);
        $json=json_decode($output,true);
        curl_close($ch);
        if ($json['code'] == 0){
            $db_user->where($where_user)->data($data_user)->save();
            $this->success('客户的邀请人修改成功', 'Admin/Index/users');
        }else{
            $this->error($json['msg']);
        }
    }

    /**
     * 某一时段内，投资汇总
     */
    public function users_invest_total(){
        $db_invest = M('invest');
        $db_ucenter_member = M('ucenter_member');
        if(UID==1){
            $where = null;
        }else{
            $where_id['id'] = UID;
            $res = $db_ucenter_member -> where($where_id)->find();
            $where_res['dj'] = $res['dj'];
            if($where_res['dj'] == 3){
                $where['staff']=$res['username'];
            }elseif ($where_res['dj'] == 2){
                $where_yyb['yyb']=$res['username'];
                $array=$db_ucenter_member->field('username')->where($where_yyb)->select();
                for($i=0;$i<count($array);$i++){
                    $array_nul[]=$array[$i]['username'];
                }
                $where['staff']=array('in',$array_nul);
            }elseif ($res['dj']== 1){
                $where_qy['qy']=$res['username'];
                $array_qy=$db_ucenter_member->field('username')->where($where_qy)->select();
                for($i=0;$i<count($array_qy);$i++){
                    $array_qy_num[]=$array_qy[$i]['username'];
                }
                $where_yyb['yyb']=array('in',$array_qy_num);
                $array=$db_ucenter_member->field('username')->where($where_yyb)->select();
                for($i=0;$i<count($array);$i++){
                    $array_nul[]=$array[$i]['username'];
                }
                $where['staff']=array('in',$array_nul);
            }
        }
        $time1 = I('dt1');
        $time2 = I('dt2');
        $start = strtotime(I('dt1'));
        $end = strtotime(I('dt2'));
        if($start == null || $end == null){
            $start = '';
            $end = '';
        }else{
            $start = strtotime(I('dt1'));
            $end = strtotime(I('dt2'));
        }
        $this->assign('start',$start);
        $this->assign('end',$end);
        if($time1 != null || $time2 != null){
           $where_invest['addtime'] = array(array('gt', $start), array('lt', $end));
           if($start < $end){
                if($where == null) {
                   $count = $db_invest->where($where_invest)->count();
                }else{
                   $count = $db_invest->where($where_invest)->where($where)->count();
                }
                $Page       = new \Think\Page($count,10);
                foreach($_POST as $key=>$val) {
                    $Page->parameter[$key]   =   urlencode($val);
                }
                $show       = $Page->show();
                if($where == null){
                    $invest = $db_invest->order('id')->where($where_invest)->limit($Page->firstRow.','.$Page->listRows)->select();
                }else{
                    $invest = $db_invest->order('id')->where($where_invest)->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
                }
                if($where == null) {
                   $invest_total = $db_invest->where($where_invest)->sum('account');
                }else{
                   $invest_total = $db_invest->where($where_invest)->where($where)->sum('account');
                }
                $this->assign('_page',$show);
                $this->assign('invest',$invest);
                $this->assign('invest_total',$invest_total);

            }else{
                $this->error('起始日期要不大于终止日期哦。');
            }
        }else{}
        $this->display('Users/users_invest_total');
    }

    /**
     *某一时段内，到期汇总
     */
    public function users_invest_total_2(){
        $db_invest = M('invest');
        $db_ucenter_member = M('ucenter_member');
        if(UID==1){
            $where = null;
        }else{
            $where_id['id'] = UID;
            $res = $db_ucenter_member -> where($where_id)->find();
            $where_res['dj'] = $res['dj'];
            if($where_res['dj'] == 3){
                $where['staff']=$res['username'];
            }elseif ($where_res['dj'] == 2){
                $where_yyb['yyb']=$res['username'];
                $array=$db_ucenter_member->field('username')->where($where_yyb)->select();
                for($i=0;$i<count($array);$i++){
                    $array_nul[]=$array[$i]['username'];
                }
                $where['staff']=array('in',$array_nul);
            }elseif ($res['dj']== 1){
                $where_qy['qy']=$res['username'];
                $array_qy=$db_ucenter_member->field('username')->where($where_qy)->select();
                for($i=0;$i<count($array_qy);$i++){
                    $array_qy_num[]=$array_qy[$i]['username'];
                }
                $where_yyb['yyb']=array('in',$array_qy_num);
                $array=$db_ucenter_member->field('username')->where($where_yyb)->select();
                for($i=0;$i<count($array);$i++){
                    $array_nul[]=$array[$i]['username'];
                }
                $where['staff']=array('in',$array_nul);
            }
        }
        $time1 = I('dt1');
        $time2 = I('dt2');
        $start = strtotime(I('dt1'));
        $end = strtotime(I('dt2'));
        if($start == null || $end == null){
            $start = '';
            $end = '';
        }else{
            $start = strtotime(I('dt1'));
            $end = strtotime(I('dt2'));
        }
        $this->assign('start',$start);
        $this->assign('end',$end);
        if($time1 != null || $time2 != null) {
            $where_invest['repay_last_time'] = array(array('gt', $start), array('lt', $end));
            if($start < $end){
                if($where == null){
                    $count      = $db_invest->where($where_invest)->count();
                }else{
                    $count      = $db_invest-> where($where)->where($where_invest)->count();
                }
                $Page       = new \Think\Page($count,10);
                foreach($_POST as $key=>$val) {
                    $Page->parameter[$key]   =   urlencode($val);
                }
                $show       = $Page->show();
                if($where == null) {
                    $invest_total = $db_invest->order('id')->where($where_invest)->limit($Page->firstRow . ',' . $Page->listRows)->select();
                }else{
                    $invest_total = $db_invest->order('id')->where($where)->where($where_invest)->limit($Page->firstRow . ',' . $Page->listRows)->select();
                }
                if($where == null) {
                    $invest_total1 = $db_invest->where($where_invest)->sum('account');
                }else{
                    $invest_total1 = $db_invest->where($where_invest)->where($where)->sum('account');
                }
                $this->assign('invest_total',$invest_total);
                $this->assign('_page',$show);
                $this->assign('invest_total1',$invest_total1);
            }else{
                $this->error('起始日期要不大于终止日期哦。');
            }
        }else{}
        $this->display('Users/users_invest_total_2');
    }
    
}
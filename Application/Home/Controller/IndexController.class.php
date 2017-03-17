<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends HomeController {

	//系统首页
    public function index(){

        $category = D('Category')->getTree();
        $lists    = D('Document')->lists(null);

        $this->assign('category',$category);//栏目
        $this->assign('lists',$lists);//列表
        $this->assign('page',D('Document')->page);//分页

                 
        $this->display();
    }


    //获取投资表
    public function addinvest(){
        $db_invest=M('invest');
        //获取数据
        $redis = new \Redis();
        $redis->connect('60.173.251.191',6379);
        vendor('DES3.DES3');
        $DES3 = new \DES3();
        $zs=$redis->LLEN('channelAaaTender');
        for($i=0;$i< $zs;$i++){
            $list_jm=$redis->rpop("channelAaaTender");
            $one=$DES3->decrypt($list_jm);
            $one=json_decode($one,true);
            $data_invest['user_id']=$one['user_id'];
            $data_invest['account']=$one['account'];
            $data_invest['sources']='';
            $data_invest['tender_id']=$one['tender_id'];
            $data_invest['borrow_period']=$one['borrow_period'];
            $data_invest['name']=$one['borrow_name'];
            $data_invest['staff']=$one['staff'];
            $data_invest['addtime']=$one['addtime'];
            $data_invest['repay_last_time']='';
            $res=$db_invest->add( $data_invest);
        }
        echo 'success';
    }

    //获取投资表
    public function adduser(){
        $db_user=M('user');
        //获取数据
        $redis = new \Redis();
        $redis->connect('60.173.251.191',6379);
        vendor('DES3.DES3');
        $DES3 = new \DES3();
        $zs=$redis->LLEN('channelAaaReginfo');
        for($i=0;$i< $zs;$i++){
            $list_jm=$redis->rpop("channelAaaReginfo");
            $one=$DES3->decrypt($list_jm);
            $one=json_decode($one,true);
            $data_user['user_id']=$one['user_id'];
            $data_user['username']=$one['username'];
            $data_user['realname']=$one['realname'];
            $data_user['staff']=$one['staff'];
            $data_user['reg_time']=$one['reg_time'];
            $data_user['phone']=$one['phone'];
            $data_user['card_id']=$one['card_id'];
            $data_user['accout']=$one['accout'];
            $res=$db_user->add( $data_user);
        }
        echo 'success';
    }

    //满标复审
    public function saveinvest(){
        $db_invest=M('invest');
        //获取数据
        $redis = new \Redis();
        $redis->connect('60.173.251.191',6379);
        vendor('DES3.DES3');
        $DES3 = new \DES3();
        $zs=$redis->LLEN('channelAaaReverify');
        for($i=0;$i< $zs;$i++){
            $list_jm=$redis->rpop("channelAaaReverify");
            $one=$DES3->decrypt($list_jm);
            $one=json_decode($one,true);
            p($one);die;
            $where_invest['borrow_nid']= $one['borrow_nid'];
            $data_invest['repay_last_time']=$one['repay_last_time'];
            $res=$db_invest->where($where_invest)->data($data_invest)->save( );
        }
        echo 'success';
    }





}
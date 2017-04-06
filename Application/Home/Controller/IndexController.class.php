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
        redirect('/Admin/Index/index');
    }


    //获取投资表
    public function addinvest(){
        $db_invest=M('invest');
        //获取数据
        $redis = new \Redis();
        $R=$redis->connect('r-bp1d5a1a427a0ce4.redis.rds.aliyuncs.com',6379);
        $redis->auth('Pl2lEnsU62fXmNqHYNpb');
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
            $data_invest['borrow_nid']=$one['borrow_nid'];
            $data_invest['name']=$one['borrow_name'];
            $data_invest['staff']=$one['staff'];
            $data_invest['addtime']=$one['addtime'];
            $data_invest['repay_last_time']=$one['repay_last_time'];
            $data_invest['recover_account_all']=$one['recover_account_all'];
            $res=$db_invest->add( $data_invest);
        }
        echo 'success';
    }

    //获取投资表
    public function adduser(){
        $db_user=M('user');
        //获取数据
        $redis = new \Redis();
        $redis->connect('r-bp1d5a1a427a0ce4.redis.rds.aliyuncs.com',6379);
        $redis->auth('Pl2lEnsU62fXmNqHYNpb');
        vendor('DES3.DES3');
        $DES3 = new \DES3();
        $zs=$redis->LLEN('channelAaaReginfo');


        for($i=0;$i< $zs;$i++){
            $list_jm=$redis->rpop("channelAaaReginfo");
            $one=$DES3->decrypt($list_jm);
            $one=json_decode($one,true);
            if(empty($one['staff'])){
                $one['staff']='';
            }
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
        echo 'success'; exit;
        $db_invest=M('invest');
        //获取数据
        $redis = new \Redis();
        $redis->connect('r-bp1d5a1a427a0ce4.redis.rds.aliyuncs.com',6379);
        vendor('DES3.DES3');
        $DES3 = new \DES3();
        $zs=$redis->LLEN('channelAaaReverify');
        for($i=0;$i< $zs;$i++){
            $list_jm=$redis->rpop("channelAaaReverify");
            $one=$DES3->decrypt($list_jm);
            $one=json_decode($one,true);
            $where_invest['borrow_nid']= $one['borrow_nid'];
            $data_invest['repay_last_time']=$one['repay_last_time'];
            $res=$db_invest->where($where_invest)->data($data_invest)->save();
        }
        echo 'success';
    }

    //余额数据对整
    public function saveye(){
        $db_invest=M('user');
        $html = file_get_contents('http://zhaoweijian.ronghedai.com/?user&q=channel_set&channel=clkj&action=sendInfoAll&function=getUserAccout');
        vendor('DES3.DES3');
        $DES3 = new \DES3();
        $one=$DES3->decrypt($html);
        $list=json_decode($one,true);
        $zs=count($list);
        for($i=0;$i< $zs;$i++){
            $where_user['user_id']= $list[$i]['user_id'];
            $data_user['account']=$list[$i]['account'];
            $res=$db_invest->where($where_user)->data($data_user)->save();
        }
        echo 'success';
    }



}
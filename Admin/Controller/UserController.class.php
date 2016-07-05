<?php
/**
 * Created by PhpStorm.
 * User: cpr040
 * Date: 2016/7/4/0004
 * Time: 15:30
 */

namespace Admin\Controller;
use Admin\Common\Random;
use Think\Controller;
class UserController extends Controller {
    public function userList(){
        $this->display();
    }

    public function userAdd(){
        $this->display();
    }

    public function userDoAdd(){

//        创建GUID
        $random = new Random();
        $userid = $random->random('9')."-".$random->random('5')."-".$random->random('4')."-".$random->random('5').'-'.uniqid();
//        $userPic = U('Public/admin/images/user_default_pic.jpg');
        $userPic = '/index.php/Public/admin/images/user_default_pic.jpg';
//        获取post
        $username = I('post.username');
        $password = md5(I('post.password'));
//        $repassword = I('post.repassword');
        $email = I('post.email');
        $sex = I('post.sex');
        $auth = I('post.auth');
//        创建时间
        $create_time = date('Y-m-d H:i:s',time());
        $lost_logining = $create_time;

//        创建模型
        $userModel = D('pi_user');
        $data['user_id'] = $userid;
        $data['user_name'] = $username;
        $data['password'] = $password;
        $data['user_pic'] = $userPic;
        $data['user_email'] = $email;
        $data['user_sex'] = $sex;
        $data['user_auth'] = $auth;
        $data['user_cretae_time'] = $create_time;
        $data['lost_logining'] = $lost_logining;
//        $res = $userModel -> data($data) ->add();
        if($res){
            $this->success('添加成功','userList');
        }else{
            $this->error('添加失败','userAdd');
        }


    }

    public function userEdit(){
//        $this->display();
    }

    public function userDoEdti(){
//        $this->display();
    }

    public function userDel(){
//        $this->display();
    }

}
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
        $userModel = D('pi_user');
        $userdata = $userModel->field('user_id,user_name,user_pic,user_sex,user_email,lost_logining,user_status,user_auth')
            ->order('lost_logining desc')
            ->select();
//        var_dump($userdata);
        $this->assign('user',$userdata);
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

        $userPic = 'admin/images/user_default_pic.jpg';   // 默认头像地址
        $username = I('post.username');             // 获取用户名
        $password = I('post.password');        // 获取密码
        $email = I('post.email');                   // 获取Email
        $sex = I('post.sex');                       // 获取性别
        $auth = I('post.auth');                     // 获取权限
        $create_time = date('Y-m-d H:i:s',time());  // 创建时间
        $lost_logining = $create_time;              // 默认最后登录



//        创建模型
        $userModel = D('pi_user');
        $repeat = $userModel->field('user_name')->where("user_name = '$username'")->find();

        if($repeat){
            $this->ajaxReturn("1");     //用户不存在
        }else{
//            赋值
            $userData['user_id'] = $userid;
            $userData['user_name'] = trim($username);
            $userData['password'] = md5($password);
            $userData['user_pic'] = $userPic;
            $userData['user_email'] = $email;
            $userData['user_sex'] = $sex;
            $userData['user_auth'] = $auth;
            $userData['user_cretae_time'] = $create_time;
            $userData['lost_logining'] = $lost_logining;

            $res = $userModel -> data($userData) ->add();
            if ($res){
                $this->ajaxReturn("3");         // 添加成功
            }else{
                $this->ajaxReturn("2");         // 添加失败
            }
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
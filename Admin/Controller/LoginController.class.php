<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){
        $this -> display();
    }


    public function doLogin(){
        $username = I('post.username');
        $password = md5(I('post.password'));
        $remember = I('post.remember');
        $code = I('post.code');
        $code_ceck = $this->check_verify($code);

//        if($remember == 1){
//            cookie('username',"$username",3600*24*7);
//            cookie('password',"$password",3600*24*7);
//        }else{
//            cookie(null);
//        }

        if(empty($username) || empty($password)){
            $this->ajaxReturn('1');      // 用户名和密码验证
        }else if($code_ceck == false){
            $this->ajaxReturn('2');            // 验证码验证
        }else{
            $userModel = D('pi_user');
            $res_name = $userModel->field('user_name')->where("user_name = '$username'")->find();
            if(!$res_name){
                $this->ajaxReturn('3');         // 用户存有判断
            }else{
                $res_pwd = $userModel->where("user_name = '$username' and password = '$password'")->find();
                if(!$res_pwd){
                    $this->ajaxReturn('4');      // 验证密码
                }else{
                    session('userInfo',$res_pwd);
                    $userInfo = session('userInfo');
                    if($userInfo['user_auth'] == 2){
                        $this->ajaxReturn('5'); // 权限验证
                    }else{
                        $this->ajaxReturn('6');         // 登录成功
                    }
                }
            }
        }
//        $userModel = D('pi_user');
//        $username = 'hanyisf09';
//        $password = '287406b5cec8669b1621e70511b1a6fe';
//        $res_pwd = $userModel->where("user_name = '$username' and password = '$password'")->find();
//        session('userInfo',$res_pwd);
//        $userInfo = session('userInfo');
//        var_dump($userInfo['user_auth']);

    }

    public function loginOut(){
        session(null);
        cookie(null);
        $this->redirect('Login/login');
    }

//    创建验证码
    public function Verify_login(){
        $Verify = new \Think\Verify();
        $Verify->imageW = 290;
        $Verify->imageH = 50;
        $Verify->fontSize = 25;
        $Verify->length   = 1;
        $Verify->useNoise = true;
        $Verify->entry();
    }


//    验证码检测
    function check_verify($code, $id = ''){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }



}
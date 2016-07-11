<?php
/*
 * 仪表盘
 * 用户行为监控
 * 用户信息监控
 * 作品信息监控
 * */
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        if(empty($_SESSION['userInfo'])){
            $this->redirect('Login/login');
        }else{
            $this->display();
        }
    }
}
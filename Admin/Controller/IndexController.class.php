<?php
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
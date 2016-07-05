<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
//        $this->redirect('Login/login');
//        echo "admin/index";
        $this->display();
    }
}
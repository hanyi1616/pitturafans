<?php
namespace Admin\Controller;
use Think\Controller;
class LayoutController extends Controller {
    public function layout(){
        $userInfo = session('userInfo');
        $this->assign('username',$userInfo['user_name']);
        $this->display();
    }
}
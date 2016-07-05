<?php
namespace Admin\Controller;
use Think\Controller;
class LayoutController extends Controller {
    public function layout(){
//        $this->redirect('Login/login');
//        echo "admin/layout";
        $this->display();
    }
}
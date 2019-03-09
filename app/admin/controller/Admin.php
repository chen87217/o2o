<?php
namespace app\admin\controller;

use think\Controller;


class Admin extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function login()
    {
        //$this->view->engine->layout(false);
        //$this->view->engine->layout('Layout/newlayout');
        return $this->fetch();
    }

    public function loginAction(){
    	//p($input->param('userName'));
    	
    	//p($this->request->isPost());

    	//p(input('post.'));
    	
        session('user', input('post.userName'));
    	$res = [
    		'userName' => input('post.userName'),
    		'isLogin' => true,
    		'count' => 1,
    	];

    	return result($res, 1);
    }
}

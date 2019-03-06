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
        return $this->fetch();
    }

    public function loginAction(){
    	$input = $this->request;
    	//p($input->param('userName'));
    	
    	//p($this->request->isPost());

    	//p(input('post.'));
    	
    	$res = [
    		'userName' => input('post.userName'),
    		'isLogin' => true,
    		'count' => 1,
    	];

    	return result($res, 1);
    }
}

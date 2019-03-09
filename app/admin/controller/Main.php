<?php
namespace app\admin\controller;

use think\Controller;
use think\facade\Log;

class Main extends Controller
{
    public function index()
    {
    	//Log::write('testcs');
    	//p(Log::getLog());
   
        return $this->fetch();
    }

    public function main(){
    	return $this->fetch();
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}

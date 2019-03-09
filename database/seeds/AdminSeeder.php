<?php

use think\migration\Seeder;

class AdminSeeder extends Seeder
{
    //填充表数据  模拟表数据
    public function run()
    {
        $data  = [
            'username'        =>  'admin' ,
            'nickname'        =>  'Bob',
            'password'        =>  '9OHkSqf4SZkZNkMuCzTwU58KSKF7qblCLgJKq6GuWjc',
            'salt'            =>  'qfin3eg8e4g0c4okgkkg4cc04gcscwk ',
            'login_status'    =>  '1',
            'login_code'      =>  '123456',
            'last_login_ip'   =>  '127.0.0.1',
            'last_login_time' =>  time(),
        ];

        $this->table('admin')->insert($data)->save();
    }
}
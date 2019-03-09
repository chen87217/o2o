<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Admins extends Migrator
{
    //创建表
    public function up(){
        // create the table
        // $table = $this->table('admin',array('engine'=>'MyISAM'));
        // $table->addColumn('username', 'string',array('limit' => 15,'default'=>'','comment'=>'用户名，登陆使用'))
        //     ->addColumn('password', 'string',array('limit' => 32,'default'=>md5('123456'),'comment'=>'用户密码'))
        //     ->addColumn('status', 'boolean',array('limit' => 1,'default'=>0,'comment'=>'登陆状态'))
        //     ->addColumn('code', 'string',array('limit' => 32,'default'=>0,'comment'=>'排他性登陆标识'))
        //     ->addColumn('last_login_ip', 'integer',array('limit' => 11,'default'=>0,'comment'=>'最后登录IP'))
        //     ->addColumn('last_login_time', 'datetime',array('default'=>0,'comment'=>'最后登录时间'))
        //     ->addColumn('is_delete', 'boolean',array('limit' => 1,'default'=>0,'comment'=>'删除状态，1已删除'))
        //     ->addIndex(array('username'), array('unique' => true))
        //     ->create();

        $table = $this->table('admin');
        $table->addColumn('username', 'string',array('limit' => 32,'default'=>'','comment'=>'用户名'))
            ->addColumn('nickname', 'string',array('limit' => 32,'default'=>'','comment'=>'昵称'))
            ->addColumn('password', 'string',array('limit' => 100,'default'=>'','comment'=>'用户密码'))
            ->addColumn('salt', 'string',array('limit' => 50,'default'=>'','comment'=>'盐'))
            ->addColumn('login_status', 'integer',array('limit' => 11,'default'=>0,'comment'=>'登陆状态'))
            ->addColumn('login_code', 'string',array('limit' => 32,'default'=>0,'comment'=>'排他性登陆标识'))
            ->addColumn('last_login_ip', 'string',array('limit' => 30,'default'=>0,'comment'=>'最后登录IP'))
            ->addColumn('last_login_time', 'integer',array('comment'=>'最后登录时间'))
            ->addTimestamps()   //默认生成create_time和update_time两个字段
            ->addIndex(array('username'), array('unique' => true))
            ->create();
    }

    //删除表
    public function down(){
        $this->dropTable('admin');
    }
}

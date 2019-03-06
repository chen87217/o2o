<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

use think\Db;
use think\facade\Request;
use think\exception\HttpResponseException;


function p($info){
	echo '<pre>';
	echo var_dump($info);
	echo '</pre>';
	die();
}


//监听sql语句 需在sql语句之前调用
function showSql(){
    Db::listen(function($sql, $time, $explain){
        // 记录SQL
        echo $sql. ' ['.$time.'s]';
        // 查看性能分析结果
        dump($explain);
    });
}

/**
 * 返回封装后的API数据到客户端
 * @access protected
 * @param mixed     $data 要返回的数据
 * @param integer   $code 返回的code
 * @param mixed     $msg 提示信息
 * @param string    $type 返回数据格式
 * @param array     $header 发送的Header信息
 * @return void
 */
function result($data, $code = 0, $msg = '', $type = '', array $header = []){
    $count = $data['count'];
    unset($data['count']);
    $result = [
        'code' => $code,
        'msg'  => $msg,
        'time' => $_SERVER['REQUEST_TIME'],
        'data' => $data,
        'count' =>$count ,
    ];

    $isAjax = Request::instance()->isAjax();
    $ResponseType =  $isAjax ? Config::get('default_ajax_return') : Config::get('default_return_type');

    $type     = $type ?: $ResponseType;
    $response = Response::create($result, $type)->header($header);
    throw new HttpResponseException($response);
}

/**
 * 解析post where 条件
 */
function parseWhere($postWhere){
    $where = [];

    foreach($postWhere as $k => $v){

        if(is_array($v)){ //数组的形式 where[open_time][between time][]

            array_walk($v,function($sv ,$sk)use($k,$v,&$where){

                //范围选择 两个值都为true  between
                if(strlen($sv[0]) && strlen($sv[1])){

                    $where[$k] = [$sk,[$sv[0] ,$sv[1]] ];
                }


                //范围选择 第一个值为true  > 大于
                if(strlen($sv[0]) && !strlen($sv[1])){
                    $where[$k] = ['>',$sv[0] ];
                }
                //范围选择 第二个值为true  < 小于
                if(!strlen($sv[0]) && strlen($sv[1])){
                    $where[$k] = ['<',$sv[1] ];
                }
            });


        }else{ //非数组的形式 where[admin_name]
            if(strlen($v)){
                $where[$k] = $v;
            }
        }



    }

    return $where;
}
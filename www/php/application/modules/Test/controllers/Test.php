<?php

class TestController extends Yaf_Controller_Abstract{

    public function init(){
        Yaf_Dispatcher::getInstance()->disableView();
    }

    public function infoAction(){
        echo phpinfo();
    }

    public function testAction(){
        echo TestModel::getInstance()->test('root');
    }

    public function sqlAction(){
        // @$config = \Yaf_Registry::get('env')->database; //使用默认的配置
        // if (!$config) {
        //     throw new MySQLxException('default dsn not found');
        // }
        // var_dump($config);
        echo 1;
        @$db_link = new \mysqli('mysql', 'root', 'root', 'range');
        // @$db_link = new \mysqli($config['host'], $config['username'], $config['password'], $config['dbname'], $config['port']);
        if($db_link->connect_errno) {
            echo("连接失败：" . $db_link->connect_errno);
        }
        echo "连接成功";
        $sql = 'select * from user;';
        $result = $db_link->query($sql)->fetch_array();
        var_dump($result);
    }
}
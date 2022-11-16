<?php

class TestController extends Yaf_Controller_Abstract{

    use Base_M;

    public function init(){
        Yaf_Dispatcher::getInstance()->disableView();
        // header('Content-Type:application/json; charset=UTF-8');
    }

    public function infoAction(){
        echo $this->db_link();
        echo phpinfo();
    }

    public function testAction(){
        echo '123';
        // echo $this->get('a');
        echo '456';
    }

    public function sqlAction(){
        $conn = new mysqli('mysql8','root','cVuP5N3Tl3QheePj');
        if($conn->connect_error){
            die("连接失败，错误:" . $conn->connect_error);
        }
        echo "connect success";
    }
}
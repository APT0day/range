<?php

class TestController extends Base_UC {

    public function infoAction(){
        echo phpinfo();
    }

    public function testAction(){
        $result = TestModel::getInstance()->test('root');
        $this->success($result, [43, 12]);
    }
}
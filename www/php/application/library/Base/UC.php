<?php

class Base_UC extends Yaf_Controller_Abstract {

    use Base_C;

    public function init() {
        Yaf_Dispatcher::getInstance()->disableView();
        header('Content-Type:application/json; charset=UTF-8');
    }
}

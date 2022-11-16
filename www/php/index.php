<?php

/* 定义这个常量是为了在 application.ini 中引用 */
define('APPLICATION_PATH', dirname(__FILE__));

// 实例化一个 Yaf 类
$application = new Yaf_Application( APPLICATION_PATH . "/conf/application.ini");

/* 执行 run() 方法，bootstrap()是可选的，它指示 Yaf_Application 去寻找 bootstrap.php
    这个文件中必须定义一个 Bootstrap 类，这个类也必须继承自 Yaf_Bootstrap_Abstract
    Bootstrap 也叫引导程序，是 Yaf 提供的一个全局配置的入口，可以做许多全局自定义的工作 */
$application->bootstrap()->run();
?>

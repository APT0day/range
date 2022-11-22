<?php

trait Base_M {

    protected static $instance;
    
    /**
     * @var \Db\MySQLi
     */
    protected $db_link;

    protected function __construct() {
        $this->db_link = \Db\MySQLi::getInstance();
        if (Yaf_Registry::get('env')->env->type == 'dev' || isset($_COOKIE['dev_debug_on']) || php_sapi_name()=='cli') {
            $this->db_link->enableDebug();
        }
        return true;
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new static();
        }
        return self::$instance;
    }
}

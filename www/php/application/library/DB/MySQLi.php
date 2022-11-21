<?php

namespace Db;

class MySQLiException extends \Exception {}

class MySQLi {

    /**
     * @var \Db\MySQLi
     */
    private static $instance;

    /**
     * 数据库连接配置数组
     * @var array
     */
    private $config = [];

    /**
     * 数据库连接
     * @var $db_link
     */
    public $db_link;

    /**
     * 要操作的表名
     * @var string
     */
    private $table;

    /**
     * 查询操作要查询的字段，默认是*，即全部
     * @var string
     */
    private $fetchField = '*';

    /**
     * limit 后的第一个参数
     * @var int
     */
    private $start = 0;

    /**
     * limit 后的第二个参数
     * @var int
     */
    private $offset = 20;

    /**
     * 排序方法，暂时只支持1个字段
     * @var string
     */
    private $order = 'DESC';

    /**
     * 排序字段，暂时只支持1个字段
     * @var string
     */
    private $order_field = '';

    /**
     * 单例模式
     * @access public
     * @return \Db\MySQLi
     */
    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 构造函数
     * 没有使用private，同时支持单例模式和新建实例的用法
     */
    public function __construct() {
        //数据库连接信息
        $this->connect();
    }

    public function __destruct() {
        $this->close();
    }

    /**
     * 动态变更配置
     * @param array $config
     */
    public function setConfig($config) {
        $this->config = $config;
    }

    private function connect() {
        if(empty($this->config)) {
            // 使用默认的配置
            @$config = \Yaf_Registry::get('env')->database;
            if(!$config) {
                throw new MySQLiException('default config not found');
            }
            $this->config = $config;
        }
        @$this->db_link = new \mysqli
    }

}

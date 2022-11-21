<?php
/**
 * @name MySQLi
 * @desc 数据库相关封装
 */

namespace Db;

class MySQLiException extends \Exception {}

class MySQLi {

    /**
     * @var \Db\MySQLi
     */
    private static $instance;

    private $debug = false;

    /**
     * 数据库的连接配置数组
     * @var array
     */
    private $config = [];

    /**
     * 数据库连接ID
     * @var $db_link \mysqli
     */
    public $db_link;

    /**
     * 事务处理开启状态
     * @var boolean
     */
    public $Transactions = false;

    /**
     * 最后一句执行的sql语句
     * @var string
     */
    private $lastSql = '';

    /**
     * 要操作的表名称
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
     * @return \DB\MySQLx
     */
    public static function getInstance() {
        if (!self::$instance) {
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

    public function __call($func, $params) {
        return call_user_func_array(array($this->db_link, $func), $params);
    }

    /**
     * 可以动态变更配置
     * @param array $config
     */
    public function setConfig($config){
        $this->config = $config;
    }

    public function enableDebug($enable = true){
        $this->debug = $enable;
    }

    public function getLastSql() {
        if($this->debug)
            return $this->lastSql;
        else
            return '[sql not available because current env is not dev]';
    }

    private function connect(){
        if(empty($this->config)){
            @$config = \Yaf_Registry::get('env')->database; //使用默认的配置
            if (!$config) {
                throw new MySQLxException('default dsn not found');
            }
            $this->config = $config;
        }
        //连接出错会爆出warning，必须要@屏蔽掉
        @$this->db_link = new \mysqli($this->config['host'],$this->config['username'],$this->config['password'],$this->config['dbname'],$this->config['port']);
        if($this->db_link->connect_errno)
            throw new MySQLxException('Connect Error: '.$this->db_link->connect_error);
        if (!empty($this->config['charset'])) {
            $this->db_link->set_charset($this->config['charset']);
            $this->db_link->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE,true);//让数据库里的int和float返回成对应的php数字类型
        }
        return true;
    }

    public function close() {
        return $this->db_link->close();
    }

    /**
     * 检查数据库连接,是否有效，无效则重新建立
     */
    protected function checkConnection() {
        if (!@$this->db_link->ping()) {
            $this->close();
            return $this->connect();
        }
        return true;
    }

    /**
     * 获取连接
     * @return \mysqli
     */
    public function getConnection() {
        return $this->db_link;
    }

    /**
     * SQL错误信息
     * @param $sql
     * @return string
     */
    protected function errorMessage($sql) {
        if($this->debug){
            $msg = $this->db_link->error . "<hr />$sql<hr />\n";
            $msg .= "Server: {$this->config['host']}:{$this->config['port']}. <br/>\n";
        }else{
            $msg = '';
        }
        $msg .= "Message: {$this->db_link->error} <br/>\n";
        $msg .= "Errno: {$this->db_link->errno}\n";
        return $msg;
    }

    /**
     * 获取错误码
     * @return int
     */
    public function errno() {
        return $this->db_link->errno;
    }

    /**
     * 返回错误信息
     * @return string
     */
    public function error(){
        return $this->db_link->error;
    }

    /**
     * 自动重试的代理方法
     * @param $call
     * @param $params
     * @return bool|mixed
     * @throws MySQLxException
     */
    protected function tryReconnect($call, $params) {
        $result = false;
        for ($i = 0; $i < 2; $i++) {
            $result = call_user_func_array($call, $params);
            if ($result === false) {
                if ($this->db_link->errno == 2013 or $this->db_link->errno == 2006 or ($this->db_link->errno == 0 and !$this->db_link->ping())) {
                    $r = $this->checkConnection();
                    $call[0] = $this->db_link;
                    if ($r === true) {
                        continue;
                    }
                } else {
                    throw new MySQLxException(__CLASS__ . " SQL Error".$this->errorMessage($params[0]));
                }
            }
            break;
        }
        return $result;
    }

    /**
     * 返回上一个Insert语句的自增主键ID
     * @return mixed
     */
    public function insertId() {
        return $this->db_link->insert_id;
    }

    /**
     * 获取受影响的行数
     * @return int
     */
    public function getAffectedRows() {
        return $this->db_link->affected_rows;
    }

    /**
     * 过滤特殊字符
     * @param $value
     * @return string
     * @throws MySQLxException
     */
    public function quote($value) {
        return $this->tryReconnect(array($this, 'escape_string'), array($value));
    }

    public function escapeString($value){
        return '\''. $this->quote($value) .'\'';
    }

    /**
     * 执行一个SQL语句
     * @param string $sql 执行的SQL语句
     * @param int $resultmode
     * @return MySQLxRecord | bool
     * @throws MySQLxException
     */
    public function query($sql, $resultmode = null) {
        $this->lastSql = $sql;
        $result = $this->tryReconnect(array($this->db_link, 'query'), array($sql, $resultmode));
        if (!$result) { //false
            throw new MySQLxException(__CLASS__ . " SQL Error:" . $this->errorMessage($sql));
        }
        if (is_bool($result)) {//true
            return $result;
        }
        return new MySQLxRecord($result);
    }

    /**
     * 开启事务处理
     * @access public
     * @return boolean
     */
    public function startTrans() {
        if ($this->Transactions == false) {
            $this->db_link->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
            $this->Transactions = true;
        }
        return true;
    }

    /**
     * 提交事务处理
     * @access public
     * @return boolean
     */
    public function commit() {
        if ($this->Transactions == true) {
            if ($this->db_link->commit()) {
                $this->Transactions = false;
            }
        }
        return true;
    }

    /**
     * 事务回滚
     * @access public
     * @return boolean
     */
    public function rollback() {
        if ($this->Transactions == true) {
            if ($this->db_link->rollback()) {
                $this->Transactions = false;
            }
        }
        return true;
    }

    /**
     * 执行UPDATE，DELETE语句并返回被修改行数
     * @param $sql
     * @return int
     * @throws MySQLxException
     */
    public function exec($sql){
        $result = $this->query($sql);
        if($result===true)
            return $this->getAffectedRows();
        else
            throw new MySQLxException('your sql cannot use exec,use query instead');
    }

    /**
     * 通过一个SQL语句获取一行信息(字段型)
     * @param $sql
     * @return array 返回数组，或者空数组
     * @throws MySQLxException
     */
    public function fetchRow($sql){
        $result = $this->query($sql);
        $ret = $result->fetch();
        if(!$ret)//null
            return [];
        return $ret;
    }

    /**
     * 查询多行结果，返回（空）数组
     * @param $sql
     * @return array 数组或者空数组
     * @throws MySQLxException
     */
    public function getArray($sql){
        $result = $this->query($sql);
        return $result->fetchall();
    }

    /**
     * -----------------------------
     * 上面是PDO兼容区域，下面是高级封装区域
     * -----------------------------
     */

    /**
     * 选定要操作的表
     * @param $table
     * @return \Driver\MySQLx
     */
    public function table($table){
        $this->table = $table;
        return $this;
    }

    public function field($field){
        if(is_array($field)){
            $quoted_filed = array_map(function($item){
                return '`'.$item.'`';
            },$field);
            $this->fetchField = join(',',$quoted_filed);
        }else{
            $this->fetchField = $field;//string
        }
        return $this;
    }

    public function limit($start,$offset){
        $this->start = $start;
        $this->offset = $offset;
        return $this;
    }

    public function page_size($size){
        $this->offset = $size;
        return $this;
    }

    public function page($page,$page_size=0){
        if($page_size>0)
            $this->offset = $page_size;
        $this->start = ($page - 1) * $this->offset;
        return $this;
    }

    public function desc($field_name){
        $this->order = 'DESC';
        $this->order_field = $field_name;
        return $this;
    }

    public function asc($field_name){
        $this->order = 'ASC';
        $this->order_field = $field_name;
        return $this;
    }

    public function c($data){
        return $this->insert($data);
    }

    public function u($where,$params){
        return $this->update($where,$params);
    }

    /**
     * 插入新的数据
     * @param $data
     * @return bool
     * @throws MySQLxException
     */
    public function insert($data){
        //data必须是一层的key value pair，如果结构不对，则自动转化成string
        $this->checkNecessary();
        $keys = [];
        $values = [];
        foreach ($data as $k=>$v){
            if(is_int($k))
                throw new MySQLxException('invalid data');
            $keys[] = '`' . $k . '`';
            if(is_string($v)){
                $values[] = $this->escapeString($v);
            } elseif(is_int($v)){
                $values[] = $v;
            } elseif(is_double($v)){
                $values[] = $v;
            } elseif (is_null($v)){
                $values[] = "''";
            } else {
                $values[] = $this->escapeString(json_encode($v));
            }
        }
        $tpl = sprintf('INSERT INTO `%s` (%s) VALUES(%s)',$this->table,join(',',$keys),join(',',$values));
        return $this->query($tpl);
    }

    /**
     * 更新指定条件的数据
     * @param $where array
     * @param $params array
     * @return bool
     * @throws MySQLxException
     */
    public function update($where,$params){
        $this->checkNecessary();
        $w = $this->packWhereStatement($where);
        $param_tpl = [];
        foreach ($params as $k=>$v){
            if(is_int($k))
                throw new MySQLxException('invalid data');
            $key = '`' . $k . '`';
            if(is_string($v)){
                $value = $this->escapeString($v);
            } elseif(is_int($v)){
                $value = $v;
            } elseif(is_double($v)){
                $value = $v;
            } elseif (is_null($v)){
                $value = "''";
            } else {
                $value = $this->escapeString(json_encode($v));
            }
            $param_tpl[] =  sprintf('%s%s%s',$key,'=',$value);
        }
        $param_tpl_str = join(',',$param_tpl);
        $sql = sprintf('UPDATE `%s` SET %s WHERE %s',$this->table,$param_tpl_str,$w);
        return $this->query($sql);
    }


    /**
     * 根据where条件获取一条数据
     * @param $where
     * @return array
     * @throws MySQLxException
     */
    public function getOne($where){
        $this->checkNecessary();
        $w = $this->packWhereStatement($where);
        $sql = sprintf('SELECT %s FROM `%s` WHERE %s LIMIT 1',$this->fetchField,$this->table,$w);
        return $this->query($sql)->fetch();
    }

    /**
     * 根据where条件获取一组数据数组
     * @param $where
     * @return array
     * @throws MySQLxException
     */
    public function select($where){
        $this->checkNecessary();
        $w = $this->packWhereStatement($where);
        if(!empty($this->order_field)){
            $sql = sprintf('SELECT %s FROM `%s` WHERE %s ORDER BY `%s` %s LIMIT %d,%d',$this->fetchField,$this->table,$w,$this->order_field,$this->order,$this->start,$this->offset);
        }else{
            $sql = sprintf('SELECT %s FROM `%s` WHERE %s LIMIT %d,%d',$this->fetchField,$this->table,$w,$this->start,$this->offset);
        }
        return $this->query($sql)->fetchAll();
    }

    /**
     * 无筛选条件查询一组数据，返回数组
     * @return array
     * @throws MySQLxException
     */
    public function selectAll(){
        $this->checkNecessary();
        if(!empty($this->order_field)){
            $sql = sprintf('SELECT %s FROM `%s` ORDER BY `%s` %s LIMIT %d,%d',$this->fetchField,$this->table,$this->order_field,$this->order,$this->start,$this->offset);
        }else{
            $sql = sprintf('SELECT %s FROM `%s` LIMIT %d,%d',$this->fetchField,$this->table,$this->start,$this->offset);
        }
        return $this->getArray($sql);
    }

    /**
     * 根据条件查询符合的记录数量
     * @param $where
     * @return mixed
     * @throws MySQLxException
     */
    public function count($where=[]){
        $this->checkNecessary();
        if(empty($where)){
            $sql = sprintf('SELECT COUNT(*) AS `total` FROM `%s`',$this->table);
        }else{
            $w = $this->packWhereStatement($where);
            $sql = sprintf('SELECT COUNT(*) AS `total` FROM `%s` WHERE %s',$this->table,$w);
        }
        $result = $this->fetchRow($sql);
        return $result['total'];
    }

    /**
     * 删除符合条件的数据
     * @param $where
     * @return bool
     * @throws MySQLxException
     */
    public function delete($where){
        $this->checkNecessary();
        $w = $this->packWhereStatement($where);
        $sql = sprintf('DELETE FROM `%s` WHERE %s',$this->table,$w);
        return $this->query($sql);
    }

    private function packWhereStatement($where){
        //支持两种格式，一维数组表示and条件连接的等于查询，二维数组表示可以自定义查询操作符
        //实例如下，一看即知道
        //['username'=>'abc','type'=>'url']
        //['username'=>['=','abc'],'time'=>['>',67890333]]
        //还能混合
        //['username'=>'abc','time'=>['>',67890333]]
        //['username'=>'abc','time'=>[
        //      ['>',67890333],
        //      ['<',67891333]
        //]]
        if(empty($where))
            throw new MySQLxException('where statement cannot be empty');
        $tpl = [];
        foreach ($where as $k=>$v){
            if(is_int($k))
                throw new MySQLxException('invalid data');
            if(is_array($v) && is_array($v[0])){
                foreach ($v as $sub_v){
                    $tpl[] = $this->processSingleWhereStatement($k,$sub_v);
                }
            }else{
                $tpl[] = $this->processSingleWhereStatement($k,$v);
            }
        }
        return join(' AND ',$tpl);
    }

    private function processSingleWhereStatement($k,$v){
        $key = '`' . $k . '`';
        $value = is_array($v) ? $v[1] : $v;
        $op = is_array($v) ? $v[0] : '=';
        if(is_string($value)){
            $value = $this->escapeString($value);
        } elseif(is_int($value)){
            //$value = $value;
        } elseif(is_double($value)){
            //$value = $value;
        } elseif (is_null($value)){
            $value = "''";
        } else {
            $value = $this->escapeString(json_encode($value));
        }
        return sprintf('%s %s %s',$key,$op,$value);
    }

    private function checkNecessary(){
        if(!$this->table)
            throw new MySQLxException('table not set');
    }
}


class MySQLxRecord
{
    /**
     * @var \mysqli_result
     */
    public $result;

    public function __construct($result) {
        $this->result = $result;
    }

    public function fetch() {
        return $this->result->fetch_assoc();
    }

    public function fetchAll() {
        $data = array();
        while ($record = $this->result->fetch_assoc()) {
            $data[] = $record;
        }
        return $data;
    }

    public function free() {
        $this->result->free_result();
    }

    public function __get($key) {
        return $this->result->$key;
    }

    public function __call($func, $params) {
        return call_user_func_array(array($this->result, $func), $params);
    }
}


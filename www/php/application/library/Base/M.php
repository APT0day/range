<?php

trait Base_M {

    protected static $instance;
    /**
     * @var \DB\MySQLx
     */
    protected $db_link;

    private $_method;

    private $_args;

    private $_data = false;

    protected function __construct() {
        $this->db_link = \DB\MySQLx::getInstance();
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

    /**
     * 通过此处注入缓存相关操作
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __call($method, $args) {
        $this->_method = $method;
        $this->_args = $args;
        $this->_internalProcess();
        return $this->_getData();
    }

    private function _internalProcess(){
        /**
         * 配置文件写法
         * [required operation],[required prefix],[optional|required expire],[optional format]
         *
         * operation 可以为 + 或者 - ,代表增加和删除缓存
         * prefix    缓存的前缀
         * expire    当operation为+的时候必须填写，其它情况可忽略
         * format    可选值为 int/string/array ,仅对 operation 为+ 时从缓存中读取出的数据生效
         *
         */
        $config_key = sprintf('data.%s.%s',strtolower(str_replace('Model','',__CLASS__)),$this->_method);
        $data_conf = E($config_key);
        if(empty($data_conf)){
            //直接透传
            $this->_getDataFromModelMethod();
            return true;
        }
        //有参数配置，需要解析缓存相关操作
        $conf_array = explode(',',$data_conf);
        if($conf_array[0]=='+'){
            $this->_select($conf_array);
        }else{
            $this->_doActionAndRemovCache($conf_array);
        }
        return true;
    }

    private function _select($conf){
        $cache_result = CacheModel::getInstance()->get($conf[1].$this->_getCacheKey());
        if($cache_result!==false){
            if(isset($conf[3])){
                if($conf[3]=='array'){
                    $this->_data = json_decode($cache_result,true);
                }elseif($conf[3]=='int'){
                    $this->_data = intval($cache_result);
                }else{
                    $this->_data = $cache_result;
                }
            }else{
                $this->_data = $cache_result;
            }
            return true;
        }
        //query from db and set cache and return
        $db_result = $this->_getDataFromModelMethod();
        if($db_result===false || $db_result===null || $db_result===[]){
            return false;
        }
        if(is_array($db_result)){
            $db_result=json_encode($db_result);
        }
        if(!is_null($db_result)){
            CacheModel::getInstance()->set($conf[1] . $this->_getCacheKey(), strval($db_result), intval($conf[2]));
        }
        return true;
    }

    private function _doActionAndRemovCache($conf){
        CacheModel::getInstance()->delete($conf[1].$this->_getCacheKey(true));//第一个参数作为键的缓存 ，兼容多种情况
        CacheModel::getInstance()->delete($conf[1].$this->_getCacheKey());//所有参数的复合缓存，例如 dwz3_cn_suffix
        $this->_getDataFromModelMethod();
    }

    private function _getDataFromModelMethod(){
        $data = call_user_func_array([self::$instance,$this->_method],$this->_args);
        $this->_data = $data;
        return $data;
    }

    private function _getCacheKey($first = false){
        if(count($this->_args)<1)
            return '';
        $temp = [];
        foreach($this->_args as $arg){
            if(is_string($arg) || is_numeric($arg)){
                $temp[] = str_replace(['.',',','|','-'],'_',$arg);
            }
        }
        if($first)
            return $temp[0];
        else
            return join('_',$temp);
    }

    private function _getData(){
        return $this->_data;
    }
}

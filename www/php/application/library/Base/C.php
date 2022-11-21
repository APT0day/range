<?php

/**
 * @name c
 * @desc 获取并分析$_GET和$_POST,并进行转义化处理，提升安全。注：参数支持数组
 */

trait Base_C {

    /**
     * 获取并分析$_GET数组某参数值
     * @access public
     * @param string $string        所要获取$_GET的参数
     * @param string $default_param 默认参数, 注:只有$string不为数组时有效
     * @return string $_GET数组某参数值
     */
    public function get($string, $default_param = null) {
        $param = $this->getRequest()->getQuery($string, $default_param);
        $param = is_null($param) ? '' : (is_string($param) ? trim($param) : $param);
        return $param;
    }

    /**
     * 获取并分析$_POST数组某参数值
     * @access public
     * @param string $string        所要获取$_POST的参数
     * @param string $default_param 默认参数, 注:只有$string不为数组时有效
     * @return string    $_POST数组某参数值
     */
    public function post($string, $default_param = null) {
        if(isset($_POST[$string])){
            $default_param = $_POST[$string];
        }
        $param = $this->getRequest()->getPost($string, $default_param);
        $param = is_null($param) ? '' : (is_string($param) ? trim($param) : $param);
        return $param;
    }

    /**
     * 获取并分析$_COOKIE
     */
    public function cookie($string, $default_param = null) {
        $param = $this->getRequest()->getCookie($string, $default_param);
        $param = is_null($param) ? '' : (is_string($param) ? trim($param) : $param);
        return $param;
    }

    /**
     * 重定向功能的快捷方式
     * @param $url
     */
    public function r($url){
        $this->redirect($url);
        die();
    }

    public function redirect($url, $statusCode = 301) {
        header('Location: ' . $url, $statusCode);
        die();
    }


    /**
     * 视图变量赋值操作
     *
     * @access public
     * @param mixed  $keys  视图变量名
     * @param string $value 视图变量值
     * @return void
     */
    public function assign($keys, $value = null) {
        $this->getView()->assign($keys, $value);
    }

    /**
     * 调用返回
     *
     * 返回json数据,供调用
     * @param array   $data   返回数组,支持数组
     * @param string  $info   返回信息, 默认为空
     * @param boolean $status 执行状态, 1为true, 0为false
     * @return string
     */
    public function response($status = 1, $info = null, $data = array()) {
        $result = array();
        $result['status'] = $status;
        $result['info'] = !is_null($info) ? $info : '';
        $result['data'] = $data;
        exit(json_encode($result,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE));
    }

    public function success($info = 'success',$data=[]){
        $this->response(1,$info,$data);
    }

    public function alert($info,$data=[]){
        $this->response(0,$info,$data);
    }

    public function notice($info,$data=[]){
        $this->response(-1,$info,$data);
    }

    public function message($info,$data=[]){
        $this->response(-2,$info,$data);
    }
}

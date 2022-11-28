<?php
/**
 * @name Bootstrap
 * @author sy
 * @desc 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * @see http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
class Bootstrap extends Yaf_Bootstrap_Abstract {

    public function _initConfig() {
		//把配置保存起来
		$arrConfig = Yaf_Application::app()->getConfig();
		Yaf_Registry::set('config', $arrConfig);
	}

	public function _initPlugin(Yaf_Dispatcher $dispatcher) {
		//注册一个插件
		$JsonRequestPlugin = new JsonRequestPlugin();
		$dispatcher->registerPlugin($JsonRequestPlugin);
	}

	public function _initEnvConfig() {
        if(file_exists(APPLICATION_PATH . '/conf/env.local.ini')){
            $env = new Yaf_Config_Ini(APPLICATION_PATH . '/conf/env.local.ini');
        }else{
            $env = new Yaf_Config_Ini(APPLICATION_PATH . '/conf/env.ini');
        }
        Yaf_Registry::set('env', $env);
    }

	public function _initMannualLoad() {
        //载入函数库
        Yaf_Loader::import('function.php');
    }


	public function _initRoute(Yaf_Dispatcher $dispatcher) {
		//在这里注册自己的路由协议,默认使用简单路由
	}
	
	public function _initView(Yaf_Dispatcher $dispatcher) {
		//在这里注册自己的view控制器，例如smarty,firekylin
	}
}

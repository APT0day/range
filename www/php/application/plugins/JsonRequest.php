<?php

class JsonRequestPlugin extends Yaf_Plugin_Abstract {
    public function preDispatch(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response) {
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '*';
        header('Access-Control-Allow-Origin: '.$origin);
        header('Access-Control-Allow-Methods:POST,GET,OPTIONS');
        header('Access-Control-Allow-Credentials:true');
        header('Access-Control-Max-Age:86400');
        header('Access-Control-Allow-Headers: Origin, Pragma, Content-Type, X-ACCESS-TOKEN, X-CSRF-TOKEN, X-Requested-With, X-U2F-TOKEN, X-CAPTCHA-TOKEN, X-USER-LOGIN, X-WX2, X-FID');
        header('Access-Control-Expose-Headers: X-CAPTCHA-VERIFY');
        if($request->getMethod()=='OPTIONS'){
            header($_SERVER['SERVER_PROTOCOL'].' 204 No Content');
            die();
        }
    }
}
<?php

class Base_UC extends Yaf_Controller_Abstract {

    use Base_C;

    /**
     * 始终指向主账号的用户名
     * @var string
     */
    protected $username;

    /**
     * 当前登录账号的用户名，可能是主账号，也有可能是子账号
     * @var string
     */
    protected $operator;

    protected $profile;

    protected $sub_profile;

    protected $is_paid;

    protected $plan;

    protected $account_type = 'main_account';

    protected $permission = 'read';

    /**
     * @var PreferenceManager
     */
    protected $preference;

    public function init() {
        Yaf_Dispatcher::getInstance()->disableView();
        header('Content-Type:application/json; charset=UTF-8');
        if(!$this->getDeviceID()){
            $this->response(Enum_User::UNKNOWN_DEVICE,'未知设备，清检查浏览器环境');
        }
        if(!isset($_SERVER['HTTP_X_ACCESS_TOKEN']) || substr_count($_SERVER['HTTP_X_ACCESS_TOKEN'],'|')!=5){
            $this->response(Enum_User::FORBIDDEN,'登录凭证无效，请重新登录');
        }
        list($username,$salt,$token_salt,$lastlogin_time,$expire,$sign) = explode('|',$_SERVER['HTTP_X_ACCESS_TOKEN']??'');
        if($expire<=time()){
            $this->response(Enum_User::FORBIDDEN,'登录状态已过期，请重新登录');
        }
        if(!$this->checkAccessToken($username,$salt,$token_salt,$lastlogin_time,$expire,$sign)){
            $this->response(Enum_User::FORBIDDEN,'提交的登录凭证签名无效');
        }
        if(strpos($username,'@')!==false){
            $this->account_type = 'sub_account';
            $sub_profile = SubModel::getInstance()->getSubAccountProfile($username);
            $this->sub_profile = $sub_profile;
            $this->permission = $sub_profile['account_type'];
            list($sub_name,$main_name) = explode('@',$username);
        }else{
            $this->account_type = 'main_account';
            $this->permission = 'write';
            $main_name = $username;
        }
        $this->operator = $username;
        $profile = UserModel::getInstance()->getUserProfile($main_name);//todo 缓存相关还没适配
        if($this->isMainAccount()){
            if(!$profile || $profile['salt']!=$salt || $profile['lastlogintime']!=$lastlogin_time){
                $this->response(Enum_User::FORBIDDEN,'你的账号可能已在别处登录，如非本人操作，请尽快重置密码');
            }
            if($profile['token_salt']!=$token_salt){ //todo token_salt和微信登录状态有关联，微信登录就会更新这个值
                $this->response(Enum_User::FORBIDDEN,'登录状态已失效，你需要重新登录');
            }
        }else{
            if(!$sub_profile || $sub_profile['password_salt']!=$salt || $sub_profile['lastlogin_time']!=$lastlogin_time){
                $this->response(Enum_User::FORBIDDEN,'你的账号可能已在别处登录，如非本人操作，请尽快重置密码');
            }
            if($sub_profile['token_salt']!=$token_salt){
                $this->response(Enum_User::FORBIDDEN,'登录状态已失效，你需要重新登录');
            }
            if($sub_profile['expire_time']<=time()){
                $this->response(Enum_User::FORBIDDEN,'账号已过期，请联系贵司管理员对该子账号续期！');
            }
            if($sub_profile['status']!=Enum_UserStatus::NORMAL){
                $this->response(Enum_User::FORBIDDEN,'该账号已被贵司管理员停用，如有疑问，请联系贵司管理员');
            }
        }
        $this->profile = $profile;
        $this->username = $profile['username'];
        //注入preference manager
        if($profile['vip_type']=='svip' && $profile['vip_expire'] > time()){
            $plan = 'svip';
            $this->is_paid = true;
            $this->plan = $profile['vip_type'];
        }else{
            $plan = 'free';
            $this->is_paid = false;
            $this->plan = 'free';
        }
        $this->preference = new PreferenceManager($this->username,$plan);
    }

    private function checkAccessToken($username, $salt,$token_salt, $lastlogin_time, $expire, $sign) {
        $_sign = md5(E('secret_key.user_key') . $username . $salt . $token_salt . $lastlogin_time . $expire);
        return $_sign == $sign;
    }


    protected function checkCaptchaToken(){
        $token = $_SERVER['HTTP_X_CAPTCHA_TOKEN'] ?? 'a-b';
        list($k, $v) = explode('-', $token);
        $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
        $device_id = $this->getDeviceID();
        $value = md5(E('user.captcha.secret') . $ua . $device_id . $k);
        $cache = CacheModel::getInstance()->get('captk_' . $k);
        if (!$cache) {
            return false;
        }
        CacheModel::getInstance()->delete('captk_' . $k);
        if ($cache != $value) {
            return false;
        }
        if ($value == $v) {
            //发送这个命令，告诉客户端，captcha token，已经使用掉了，本地需要删除
            header('X-CAPTCHA-VERIFY: success');
            return true;
        } else {
            return false;
        }
    }

    /**
     * 预检查手机号是否已经绑定，如果未绑定，则直接拦截该次请求
     */
    protected function preCheckMobileBindRequirement(){
        if(!$this->profile['mobile']){
            $this->response(Enum_User::MOBILE_BIND_REQUIRED,'请先绑定手机号再执行该操作！');
        }
        return true;
    }


    protected function isMainAccount(){
        return $this->account_type === 'main_account';
    }

    protected function isSubAccount(){
        return $this->account_type === 'sub_account';
    }

    protected function requireWritePermission(){
        if($this->isMainAccount())
            return true;
        if($this->permission !== 'write')
            $this->response(401,'没有权限支持本操作');
    }
}

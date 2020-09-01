<?php
namespace mfunc;

class Sms
{
    protected $_config;
    protected $_sms;

    public function __construct ($config = [])
    {
    if (empty($config['host'])) throw new \Exception("请设置短信运营商接口地址");
        if (empty($config['user'])) throw new \Exception("请设置短信接口用户名");
        if (empty($config['pass'])) throw new \Exception("请设置短信接口密码");
        empty($config['type']) && $config['type'] = 'zhutong';

        $name = ucfirst($config['type']);
        $class = "mfunc\\driver\\{$name}";

        if (!class_exists($class)) throw new \Exception("class {$name} do not exisits");
        
        $this->_sms    = new $class($config);
        $this->_config = $config;
    }

    /**
     * 发送短信
     */
    public function send ($phone, $content)
    {
        $data = $this->_sms->getReqData($phone, $content);
        if (!function_exists('is_json')) {
            function is_json($string) {
                json_decode($string);
                return (json_last_error() == JSON_ERROR_NONE);
            }
        }
        $header = is_json($data) ? ['Content-Type: application/json', 'Content-Length: ' . strlen($data)]: [];
        return HttpCurl::post($this->_config['host'], $data, ['headers' => $header]);
    }
}

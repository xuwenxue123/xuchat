<?php
namespace App\Tools;
class Tools {
    public $redis;
    public function __construct()
    {
        $this->redis = new \Redis();
        $this->redis->connect('127.0.0.1','6379');
    }
    /**
     * @param $url
     * @param $data
     */
    public function curl_post($url,$data)
    {   
        // echo 11111;
        $curl = curl_init($url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl,CURLOPT_POST,true);  //发送post
        // print_r($data);
        curl_setopt($curl,CURLOPT_POSTFIELDS,$data); 
        $data = curl_exec($curl);
        // dd($data);
        $errno = curl_errno($curl);  //错误码
        $err_msg = curl_error($curl); //错误信息
        // dump($err_msg);
        curl_close($curl);
        return $data;
    }
    /**
     * 获取access_token
     * @return bool|string
     */
    public function get_wechat_access_token()
    {
        //加入缓存
        $access_token_key = 'wechat_access_token';
        if($this->redis->exists($access_token_key)){
            //存在
            return $this->redis->get($access_token_key);
        }else{
            //不存在
            $result = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.env('WECHAT_APPID').'&secret='.env('WECHAT_APPSECRET'));
            $re = json_decode($result,1);
            $this->redis->set($access_token_key,$re['access_token'],$re['expires_in']);  //加入缓存
            return $re['access_token'];
        }
    }
}
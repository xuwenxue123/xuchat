<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tools\Tools;
use App\Model\Wechat;
use DB;
class LoginController extends Controller
{   

    public $tools;
    public function __construct(Tools $tools)
    {
           $this->tools = $tools;
    }

    //后台登录
    public function adminLogin()
    {
        return view('AdminLogin.adminLogin');
    }
    
    // 发送微信验证码
    public function send(request $request)
    {
        $req=$request->all();
        //接收用户名 密码
        $username=$request->input('username');
        $password=$request->input('password');
        //发送验证码 4位 6位
        $code=rand(1000,9999);
        $url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->tools->get_wechat_access_token();
        //参数
        $data=[
            'touser'=>'oO9fgw104DI4Ps3BhjJsgK0bgv8I',
            'template_id'=>'Ikhg3xjqzUTmBB0wfj0Spt6UEMayDZppAQjKOZpt1MI',
            'data'=>[
                'code'=>[
                    'value'=>$code,
                    'color'=>''
                ],
                'username'=>[
                    'value'=>$username,
                    'color'=>''
                ],
                'time'=>[
                    'value'=>time(),
                    'color'=>''
                ],
                'remark' => [
                    'value' => '备注',
                    'color' => ''
                ]
            ]
        ];
        // dd($data);
        $re=$this->tools->curl_post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        $result=json_decode($re,1);
        dd($result);
    }

    //绑定账号
    public function bind()
    {
        return view('Bind.bind');
    }
    
    public function do_bind()
    {
        //获取openid
        $openid = Wechat::getOpenid();
        var_dump($openid);die;
    }
}


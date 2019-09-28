<?php

namespace App\Http\Controllers\wechat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class LoginController extends Controller
{  

    public function loging()
    {
        return view('login.loging');
    }


    public function logss()
    {
        $redirect_uri="http://www.chat.com/code";
        $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxabb0532144bac1c9&redirect_uri=".urlencode($redirect_uri)."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";//用户同意授权，获取code
        //dd($url);
        header('location:'.$url);
        // echo 111;
    }


    public function code(request $request)
    {
        $req = $request->all();
        $result = file_get_contents('https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('WECHAT_APPID').'&secret='.env('WECHAT_APPSECRET').'&code='.$req['code'].'&grant_type=authorization_code');//通过code换取网页授权access_token
        $re = json_decode($result,1);
        $user_info = file_get_contents('https://api.weixin.qq.com/sns/userinfo?access_token='.$re['access_token'].'&openid='.$re['openid'].'&lang=zh_CN');//拉取用户信息
        $wechat_user_info = json_decode($user_info,1);
        // dd($wechat_user_info);
        $openid=$re['openid'];
        $wechat_info=DB::connection('1902_weixin')->table('user_wechat')->where(['openid'=>$openid])->first();
        // dd($wechat_info);
        if(!empty($wechat_info)){
            //存在,登录
            $request->session()->put('uid',$wechat_info->uid);
            echo "ok";
        }else{
            //不存在,注册,登录
            //插入user表数据一条
            DB::connection('1902_weixin')->beginTransaction();//打开事物
            $uid = DB::connection('1902_weixin')->table('user')->insertGetId([
                'name'=>$wechat_user_info['nickname'],
                'password'=>'',
                'reg_time'=>time()
            ]);
            $insert_result = DB::connection('1902_weixin')->table('user_wechat')->insert([
                'uid'=>$uid,
                'openid'=>$openid
            ]);
            //登录操作
            $request->session()->put('uid',$wechat_info->uid);
            echo "okkkkkkkkkkkkkkkkkk";
            //return redirect('');//主页
        }
    }
}

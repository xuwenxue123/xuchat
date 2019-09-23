<?php

namespace App\Http\Controllers\Kao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tools\Tools;
use DB;
class KaoshiController extends Controller
{   

    public $tools;
    public function __construct(Tools $tools)
    {
           $this->tools = $tools;
    }
    
    //授权登录
    public function kao_login()
    {
        return view('Kao.kao_login');
    }

    public function kao_logss()
    {
        $redirect_uri="http://www.chat.com/kao_code";
        $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".env('WECHAT_APPID')."&redirect_uri=".urlEncode($redirect_uri)."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";//用户同意授权，获取code
        //dd($url);
        header('location:'.$url);
        // echo 111;
    }

    public function kao_code(request $request)
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
             return redirect('/wechat/get_user_list');//主页
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
            return redirect('/wechat/get_user_list');//主页
        }
    }

    //创建标签
    public function kao_tag()
    {
        return view('Kao.kao_tag');
    }

    //创建标签执行
    public function do_kao_tag(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $data = [
            'tag'=>[
                'name' => $data['tag_name']
            ]
        ];
        // dd($data);
        $tools =new Tools;
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/create?access_token='.$tools->get_wechat_access_token();
        // echo $url;die;
        $re = $tools->curl_post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        // dd($re);
        $res = json_decode($re,1);
        return redirect('/wechat/tag_list');
    }
}

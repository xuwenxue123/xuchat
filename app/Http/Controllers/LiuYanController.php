<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Tools\Tools;
class LiuYanController extends Controller
{   

    public $tools;
    public function __construct(Tools $tools)
    {
           $this->tools = $tools;
    }
    public function logsing()
    {
        $redirect_uri="http://www.chat.com/code";
        $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".env('WECHAT_APPID')."&redirect_uri=".urlEncode($redirect_uri)."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";//用户同意授权，获取code
        //dd($url);
        header('location:'.$url);
        // echo 111;
    }


    public function codes(request $request)
    {
        $req = $request->all();
        $result = file_get_contents('https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('WECHAT_APPID').'&secret='.env('WECHAT_APPSECRET').'&code='.$req['code'].'&grant_type=authorization_code');//通过code换取网页授权access_token
        $re = json_decode($result,1);
        $user_info = file_get_contents('https://api.weixin.qq.com/sns/userinfo?access_token='.$re['access_token'].'&openid='.$re['openid'].'&lang=zh_CN');//拉取用户信息
        $wechat_user_info = json_decode($user_info,1);
        // dd($wechat_user_info);
        $openid=$re['openid'];
        $wechat_info=DB::table('user_wechat')->where(['openid'=>$openid])->first();
        // dd($wechat_info);
        if(!empty($wechat_info)){
            //存在,登录
            $request->session()->put('uid',$wechat_info->uid);
            echo "ok";
        }else{
            //不存在,注册,登录
            //插入user表数据一条
            DB::beginTransaction();//打开事物
            $uid = DB::table('user')->insertGetId([
                'name'=>$wechat_user_info['nickname'],
                'password'=>'',
                'reg_time'=>time()
            ]);
            $insert_result = DB::table('user_wechat')->insert([
                'uid'=>$uid,
                'openid'=>$openid
            ]);
            //登录操作
            $request->session()->put('uid',$wechat_info->uid);
            echo "okkkkkkkkkkkkkkkkkk";
            // return redirect('wechat/get_user_list');//主页
        }
    }
    public function send(Request $request)
    {
        $req = $request->all();
        //发送模板消息
        return view('LiuYan/send');
    }
    public function do_send(Request $request)
    {
        $req = $request->all();
        $openid = DB::table('user_wechat')->value('openid');
        // dd($openid);
        $url ='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->tools->get_wechat_access_token();
        $data = [
            'touser'=>$openid,
            'template_id'=>'YBn0oqTBcJpzXNc8x9FUXfW9xCABnuc48SIC80w133g',
            'url'=>env('APP_URL').'/liuyan/index',
            'data'=>[
                'first' => [
                    'value' => '留言消息',
                    'color' => ''
                ],
                'keyword1' => [
                    'value' => $this->tools->get_wechat_access_token($openid)['nickname'],
                    'color' => ''
                ],
                'keyword2' => [
                    'value' => $req['send_info'],
                    'color' => ''
                ]
            ]
        ];
        dd($data);
        $re = $this->wechat->post($url,json_encode($data));
        //我的留言
        return $re;
    }
}

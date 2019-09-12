<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tools\Tools;
class TagController extends Controller
{   

    public $tools;
    public function __construct(Tools $tools)
    {
           $this->tools = $tools;
    }
    //公众号的测试管理页
    public function tag_list()
    {
        $url ='https://api.weixin.qq.com/cgi-bin/tags/get?access_token='.$this->tools->get_wechat_access_token();
        $re =file_get_contents($url);
        $result=json_decode($re,1);
        return view('Tag.tagList',['info'=>$result['tags']]);
    }

    //添加标签
    public function add_tag()
    {
        return view('Tag.addTag');
    }

    //标签添加执行
    public function do_add_tag(Request $request)
    {    
        // dd($_POST);
        // echo 11;
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
        dd($res);
    }
    
    //标签下粉丝列表
    public function tag_openid_list(Request $request)
    {
        $req = $request->all();
        dd($req);
    }


    //群发消息
    public function pushTagMsg(Request $request)
    {
        return view('Tag.pushTagMsg',['tag_id'=>$request->all()['tag_id']]);
        // echo 111;
    }
     
    //群发消息执行
    public function do_pushTagMsg(Request $request)
    {   
        $req =$request->all();
        // dd($req)
        $url='https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token='.$this->tools->get_wechat_access_token();
        $data =[
            'filter'=>[
                'is_to_all'=>false,
                'tag_id'=>$req['tag_id']
            ],
            'text'=>[
                  'content'=>$req['message']
            ],
            'msgtype'=>'text'
        ];
        $re =$this->tools->curl_post($url,json_encode($data));
        $result=json_decode($re,1);
        dd($result);
    }
    
    //标签删除
    public function tag_delete(Request $request)
    {
        $data =$request->all();
        // dd($data);
        $url ='https://api.weixin.qq.com/cgi-bin/tags/delete?access_token='.$this->tools->get_wechat_access_token();
        // dd($url);
        $data=[
            'tag'=>[
                'id'=>$data['id']
            ]
        ];
        $re =$this->tools->curl_post($url,json_encode($data));
        // dd($re);
        $result=json_decode($re,1);
        dd($request);
    }
    
    //标签修改
    
    public function tag_update(Request $request)
    {   
        $id =$request->id;
        // dd($id);
        $tag_id=["tag_id"=>[$id]];
        // dd($tag_id);
        $data = file_get_contents("https://api.weixin.qq.com/cgi-bin/tags/get?access_token=".$this->tools->get_wechat_access_token()."");
        $re = json_decode($data,1);
        $re_arr = $re['tags'];
        // dd($re_arr);
        foreach($re_arr as $v){
            foreach($tag_id['tag_id'] as $vo){
                if($vo == $v['id']){
                    return view('Tag.tag_update',['id'=>$vo,'name'=>$v['name']]);
                }
            }
        }
        
    }

    
        //标签修改执行
        public function do_update_tag(Request $request)
        {
            $name=$request->all(['tag_name']);
            $name=implode('',$name);
            // dd($name);
            $id=$request->all(['id']);
            $id=implode('',$id);
            // dd($id);
            $url="https://api.weixin.qq.com/cgi-bin/tags/update?access_token=".$this->tools->get_wechat_access_token();
            $data=[
                "tag" => [ "id"=>$id ,"name"=>$name]
            ];
            $re=$this->tools->curl_post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
            $re=json_decode($re,1);
            return redirect('wechat/tag_list');
        }
       
        //模板消息
        public function addsend()
        {
            return view('Send.addSend');
        }
        
        //模板消息执行发送
        public function do_addsend()
        {
            $openid ='oO9fgw0GBsONmgGqBbwD2pZJAl8g';
            $url ='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->tools->get_wechat_access_token();
            $data =[
                'touser'=>$openid,
                'template_id'=>'OCCWV7ddvyjTmzRXFGGrm7fm0sCQzkjW96xQTuUWb84',
                'url'=>'http://www.chat.com',
                'data'=>[
                    'first'=>[
                        'value'=>'first',
                        'color'=>'',
                    ],
                    'keyword1'=>[
                        'value'=>'keyword1',
                        'color'=>'',
                    ],
                    'keyword2'=>[
                        'value'=>'keyword2',
                        'color'=>'',
                    ]
                ]
            ];
            $re=$this->tools->curl_post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
            $result =json_decode($re,1);
            dd($result);
        }
}

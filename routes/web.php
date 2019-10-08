<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $yes =strtotime('-1 days');
    echo date('Y-m-d H:i:s',$yes);
    return view('welcome');
});

//微信
//微信获取用户列表 粉丝列表
Route::get('wechat/get_access_token','WechatController@get_access_token'); //获取access_token
Route::get('/wechat/get_user_list','WechatController@get_user_list'); //获取用户列表
Route::get('/wechat/get_user_info','WechatController@get_user_info');//详情

Route::get('/wechat/clear_api','WechatController@clear_api');
Route::get('/wechat/source','WechatController@wechat_source'); //素材管理
Route::get('/wechat/download_source','WechatController@download_source'); //下载资源

Route::get('/wechat/upload','WechatController@upload'); //上传
Route::post('/wechat/do_upload','WechatController@do_upload'); //上传

route::get('/login/loging','wechat\LoginController@loging');//授权登录
route::get('logss','wechat\LoginController@logss');
route::get('code','wechat\LoginController@code');


////////////////////////////////////////////////////////////////
//标签
Route::get('/wechat/tag_list','TagController@tag_list');//获取公众号列表
Route::get('/wechat/add_tag','TagController@add_tag');//标签添加
Route::post('/wechat/do_add_tag','TagController@do_add_tag');//标签添加
Route::get('/wechat/tag_openid_list','TagController@tag_openid_list');//标签添加
Route::post('/wechat/tag_openid','TagController@tag_openid'); //为用户打标签
Route::get('/wechat/user_tag_list','TagController@user_tag_list'); //用户下的标签列表
Route::get('/wechat/tag_delete','TagController@tag_delete');//标签删除
Route::get('/wechat/tag_update','TagController@tag_update');//标签删除
Route::post('/wechat/do_update_tag','TagController@do_update_tag');//标签删除

//推送群发消息
Route::get('/wechat/pushTagMsg','TagController@pushTagMsg');//群发表单
Route::post('/wechat/do_pushTagMsg','TagController@do_pushTagMsg');//群发添加入库

//模板消息
Route::get('/wechat/addsend','TagController@addsend');
Route::get('/wechat/do_addsend','TagController@do_addsend');

///////////////////////////////////////////////////////////////////
//留言
Route::get('logsing','LiuYanController@logsing');//留言登陆
Route::get('codes','LiuYanController@codes');
Route::get('/liuyan/index','LiuYanController@index'); //留言板主页
Route::get('/liuyan/send','LiuYanController@send');//留言添加
Route::post('/liuyan/do_send','LiuYanController@do_send');//留言执行添加

///////////////////////////////////////////////////
Route::prefix('agent')->namespace('wechat')->group(function(){
    Route::get('list','AgentController@agent_list');// 获取关注用户视图
    Route::get('create_qrcode','AgentController@create_qrcode');// 创建二维码
});

Route::post('/wechat/menu','wechat\MenuController@menu');//创建菜单
Route::get('/wechat/menu_list','wechat\MenuController@menu_list');//菜单列表
Route::get('/wechat/load_menu','wechat\MenuController@load_menu');
Route::get('/wechat/del_menu','wechat\MenuController@del_menu');


//周考试题
Route::get('/Kao/kao_login','Kao\KaoshiController@kao_login');//第三方授权登录
Route::get('kao_logss','Kao\KaoshiController@kao_logss');
Route::get('kao_code','Kao\KaoshiController@kao_code');
Route::get('kao_tag','Kao\KaoshiController@kao_tag');//创建标签
Route::post('do_kao_tag','Kao\KaoshiController@do_kao_tag');//创建标签执行



//exam
Route::get('/Exam/exam_login','Exam\ExamController@exam_login');//第三方授权登录
Route::get('exam_logss','Exam\ExamController@exam_logss');
Route::get('exam_code','Exam\ExamController@exam_code');


// //run月考
Route::get('/Run/run_add_menu','Run\RunController@run_add_menu');

//模板消息

Route::get('/wechat/push_template_message','WechatController@push_template_message');//详情




//API
Route::get('/Login/adminLogin','Login\LoginController@adminLogin');//后台登录
Route::post('/Login/adminLogin_do','Login\LoginController@adminLogin_do');//后台登录执行
Route::get('/Index/index','Index\IndexController@index');//前台
Route::get('/Index/send','Login\LoginController@send');//发送验证码
Route::get('/Login/bind','Login\LoginController@bind');//绑定账号
Route::any('/Login/do_bind','Login\LoginController@do_bind');//绑定账号


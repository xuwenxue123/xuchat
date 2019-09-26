<?php

namespace App\Http\Controllers\Run;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class RunController extends Controller
{
    //创建菜单显示
    public function run_menu()
    {
        return view('Run.run_menu');
    }

    public function run_add_menu(Request $request)
    {
        $req = $request->all();
        $button_type =!empty($req['name2'])?2:1;
        $result =DB::table('run')->insert([
            'name1'=>$req['name1'],
            'name2'=>$req['name2'],
            'type'=>$req['type'],
            'button_type'=>$button_type,
            'event_value'=>$req['event_value']
        ]);
        if(!$result){
            dd('插入失败');
        }
        //跟换表数据翻译成菜单结构
        // $this->load_menu();
    }
}

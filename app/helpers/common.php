<?php
       /*文件上传*/
      function uploads($name){
        if (request()->file($name)->isValid()) {
            $photo = request()->file($name);
            $store_result = $photo->store('','public');
         //  $store_result = $photo->storeAs($name, 'test.jpg');
            return $store_result;
            exit('未获取到上传文件或上传过程出错');
        }
    }

    function createTree($data,$pid=0,$level=1)
	{
		//定义一个静态容器
		static $new_arr=[];
		//循环遍历
		foreach ($data as $k => $v) {
			//找到顶级分类
			if($pid==$v->pid){
				//增加级别字段
				$v->level=$level;
				// 放到静态容器里
				$new_arr[]=$v;
				//调用程序自身 递归找子类
				createTree($data,$v->cid,$level+1);
			}


		}
		return $new_arr;
	}
	function send($email,$info,$code){
        \Mail::send('mail' , ['name'=>'小雪','code'=>$code] ,function($message)use($email,$info){
        //设置主题
            $message->subject($info);
        //设置接收方
            $message->to($email);
        });
   }

?>
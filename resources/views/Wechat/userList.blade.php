<html>
    <head>
        <title>用户列表</title>
    </head>
    <body>
    <h1 align="center">粉条列表</h1>
        <center>
            <form action="{{url('/wechat/tag_openid')}}" method="post">
             @csrf
             <input type="submit" value="提交">
             <input type="hidden" name="tagid" value="{{$tagid}}">
            <table border="1">
                <tr>
                    <td></td>
                    <td>用户昵称</td>
                    <td>用户openid</td>  
                    <td>操作</td>
                </tr>
                @foreach($info as $v)
                    <tr>
                        <td><input type="checkbox" name="openid_list[]" value="{{$v['openid']}}"></td>
                        <td>{{$v['nickname']}}</td>
                        <td>{{$v['openid']}}</td>
                        <td>
                            <a href="{{url('wechat/get_user_info')}}?openid={{$v['openid']}}">查看详情</a> |||
                            <a href="{{url('/wechat/user_tag_list')}}?openid={{$v['openid']}}">用户标签</a>
                        </td>
                    </tr>
                @endforeach
            </table>
            </form>
        </center>
    </body>
</html>
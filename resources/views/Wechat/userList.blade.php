<html>
    <head>
        <title>用户列表</title>
    </head>
    <body>
    <h1 align="center">粉条列表</h1>
        <center>
            <table border="1">
                <tr>
                    <td>用户昵称</td>
                    <td>用户openid</td>  
                    <td>操作</td>
                </tr>
                @foreach($info as $v)
                    <tr>
                        <td>{{$v['nickname']}}</td>
                        <td>{{$v['openid']}}</td>
                        <td><a href="{{url('wechat/get_user_info')}}?openid={{$v['openid']}}">查看详情</a></td>
                    </tr>
                @endforeach
            </table>
        </center>
    </body>
</html>
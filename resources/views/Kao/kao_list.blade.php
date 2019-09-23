<html>
<head>
    <title></title>
</head>
<body>
<center>
    <h2>公众号标签管理</h2>
    <a href="{{url('kao_tag')}}">增加标签</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <a href="{{url('/wechat/get_user_list')}}">粉丝列表</a>
    <br>
    <br>
    <br>
    <table border="1">
        <tr>
            <td>tag_id</td>
            <td>tag_name</td>
            <td>标签下粉丝数</td>
        </tr>
        @foreach($info as $v)
        <tr>
            <td>{{$v['id']}}</td>
            <td>{{$v['name']}}</td>
            <td>{{$v['count']}}</td>
        </tr>
        @endforeach
    </table>
</center>
</body>
</html>
<html>
<head>
    <title></title>
</head>
<body>
<center>
    <form action="{{url('/wechat/do_update_tag')}}" method="post">
      <input type="hidden" name="id" value="{{$id}}">
        @csrf
        标签名称：<input type="text" name="tag_name" id="" value="{{$name}}">
        <br>
        <br>
        <input type="submit" value="修改">
    </form>
</center>
</body>
</html>
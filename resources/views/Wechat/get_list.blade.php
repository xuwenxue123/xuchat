<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table border="1" align="center">
       <h1 align="center">详情</h1>
        <tr>
           <td>用户城市</td>
           <td>用户昵称</td>
           <td>头像</td>
        </tr>
        <tr>
          <td>{{$result['city']}}</td>
          <td>{{$result['nickname']}}</td>
          <td><img src="{{$result['headimgurl']}}" alt="" ></td>
        </tr>
    </table>
</body>
</html>
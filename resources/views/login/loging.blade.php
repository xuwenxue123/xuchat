<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table align="center">
       <h1 align="center">登录</h1>
        <tr>
           <td>用户名</td>
           <td><input type="text"></td>
        </tr>
        <tr>
           <td>密码</td>
           <td><input type="password"></td>
        </tr>
        <tr>
           <td></td>
           <td><input type="submit" id="wechat_btn" value="微信授权登录"></td>
        </tr>
    </table>
</body>
</html>
<script src="{{asset('/wechat/js/jq.min.js')}}"></script>
<script>
        $(function(){
            $('#wechat_btn').click(function(){
                window.location.href='{{url('/logss')}}';
            });
        });
</script>

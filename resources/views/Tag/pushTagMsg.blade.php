<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('/wechat/do_pushTagMsg')}}" method="post">
      @csrf
      <input type="hidden" name="tag_id" value="{{$tag_id}}">
       <table>
          <tr>
             <td>消息</td>
             <td></td>
          </tr>
          <tr>
            <td></td>
            <td><textarea name="message" id="" cols="30" rows="10"></textarea></td>
          </tr>
          <tr>
             <td></td>
             <td><input type="submit" value="提交"></td>
          </tr>
       </table>
    </form>
</body>
</html>
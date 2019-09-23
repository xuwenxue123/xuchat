<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <center>
        <table>
            <form action="{{url('/do_kao_tag')}}" method="post">
                 <tr>
                    <td>创建标签</td>
                    <td><input type="text"  name="tag_name"></td>
                 </tr>
                 <tr>
                    <td></td>
                    <td><input type="submit" value="创建标签"></td>
                 </tr>
            </form>
        </table>
    </center>
</body>
</html>
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
        <h2>创建菜单</h2>
        <form action="{{url('/Run/run_add_menu')}}" method="post">
         @csrf
        <table>
            <tr>
               <td>一级菜单名称</td>
               <td><input type="text" name="name1"></td>
            </tr>
            <tr>
               <td>二级菜单名称</td>
               <td><input type="text" name="name2"></td>
            </tr>
            <tr>
               <td>菜单类型[click/view]</td>
               <td>
                <select name="type" id="">
                    <option value="1">click</option>
                    <option value="2">view</option>
                </select>
               </td>
            </tr>
            <tr>
               <td>事件值</td>
               <td><input type="text" name="event_value"></td>
            </tr>
            <tr>
               <td></td>
               <td><input type="submit" value="创建菜单"></td>
            </tr>
        </table>
        </form>
    </center>
</body>
</html>
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
        <h2>绑定管理员账号</h2>
        <form action="{{url('/Login/do_bind')}}" method="post">
                <div class="form-group draggable">   
                <div class="col-sm-9">
                <label class="col-sm-3 control-label">用户名：</label> <input type="text" name="username" class="form-control" placeholder="请输入文本">
                </div>
                </div>
                <div class="form-group draggable">
                <div class="col-sm-9">
                    <label class="col-sm-3 control-label">密码框：</label> <input type="password" class="form-control" name="password" placeholder="请输入密码">
                </div>
                </div>
                <br>
                <div  class="form-group draggable">
                    <input type="submit" value="绑定管理员账号" id="bind">
                </div>
        </form>
    </center>
</body>
</html>
<script src="{{asset('api/js/jquery.min.js?v=2.1.4')}}"></script>
<script>
    $("#bind").on('click',function(){
        var data = $("#form").serialize();
        var targetUrl = $("#form").attr("action");
        $.ajax({
            url:targetUrl,
            type:"post",
            data:data,
            dataType:"json",
            success:function(res){
                alert(res.msg);
            }
        })
    })
</script>
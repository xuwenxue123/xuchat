<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>send</title>
</head>
<body>
<center>
    <form action="{{url('/liuyan/do_send')}}" method="post">
        @csrf
        留言：
        <textarea cols="30" rows="10" name="send_info"></textarea>
        <input type="submit" value="提交">
    </form>
</center>
<script type="text/javascript">
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({});
    });
</script>
</body>
</html>
<!DOCTYPE html>
<html>
<head lang="cn">
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'/>
    <title>后台管理系统</title>
    <link href="/admin/css/a.css" rel="stylesheet"/>
    <link href="/admin/images/login/abc.ico" rel="shotcut icon"/>
    <script type="text/javascript" src="/admin/js/jquery-latest.js"></script>
</head>
<body>
<header>
    <div class="text">
        {{--<a><em>加入收藏</em>|<span>联系我们</span></a>--}}
    </div>
</header>
<div id="content">
    {{--<img src="/admin/images/login/jian.png" />--}}
    <h1>长者俱乐部后台管理系统</h1>
    <form method="post">
        <input id="usename" name="username" type="text" value="" placeholder="{{--用户名--}}用户名"/><br/>
        <input id="password" name="password" type="password" value=""  placeholder="{{--密码--}}密码"/>
        <div class="bt clear">
            {{--<input class="check fl" type="checkbox" value=""/>
            <span class="fl">记住密码</span>
            <em class="fl">忘记密码？</em>--}}
            <input id="submit" type="submit" value="登录"/>
        </div>
    </form>
</div>
<div id="footer">
    <p><span>© 2016 soft 沪ICP备111111111号</span></p>
</div>
</body>
<script>
    $("#submit").click(function () {
        var username = $("#usename").val();
        var password = $("#password").val();
        $.ajax({
            data:{username: username, password: password},
            url:"/index.php/do_login",
            dataType:'json',
            type:'POST',
            success:function (data) {
                //console.log(data);return;

                if (typeof data == "string") {
                    var data = eval('(' + data + ')');
                }
                //console.log(data);return;
                if (data == 1) {

                    window.location.href = "/index.php/ad_index";
                } else if (data == '0') {
                    alert("账号或密码不正确");
                } else {
                    alert("账号或密码不能为空");
                    /*for (var i in data) {
                     $("input[name='num']").val(data[i][0]);
                     $("input[name="+i+"]").parent("td").append('<span style="color:red">'+data[i][0]+'</span>');
                     alert(i);
                     }*/
                }
            }
        });
        return false;

    });
</script>
</html>
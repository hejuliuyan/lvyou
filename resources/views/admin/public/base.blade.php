<!doctype html>
<html>
<head>
    {{--<meta charset="UTF-8">--}}
    <meta http-equiv="Content-Type" content="text/html; charset='utf-8'" />
    <title>管理员中心</title>
    <link rel="stylesheet" type="text/css" href="/admin/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/admin/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="/admin/css/cityPicker.css"/>
    <link rel="stylesheet" type="text/css" href="/admin/js/skin/jedate.css"/>
    <script type="text/javascript" src="/admin/js/libs/modernizr.min.js"></script>
    <script type="text/javascript" charset="utf-8" language="javascript" src="/admin/js/jquery-latest.js"></script>
    <script type="text/javascript" charset="utf-8" language="javascript" src="/admin/js/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" language="javascript" src="/admin/js/jquery.tablesorter.js"></script>
    <script type="text/javascript" charset="utf-8" language="javascript" src="/admin/js/jquery.blockUI.js"></script>
    <script type="text/javascript" charset="utf-8" language="javascript" src="/admin/js/cityData.js"></script>
    <script type="text/javascript" charset="utf-8" language="javascript" src="/admin/js/cityPicker.js"></script>
    <script type="text/javascript" charset="utf-8" language="javascript" src="/admin/js/jedate.js"></script>
    <!-- 配置文件 -->
    <script type="text/javascript" charset="utf-8" language="javascript" src="/admin/js/ue-utf8/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" charset="utf-8" language="javascript" src="/admin/js/ue-utf8/ueditor.all.js"></script>
    <script>
        $(document).on('click', '.openPopover', function () {
            $(this).siblings(".sub-menu").toggleClass("hidd");
        })


    </script>
    <style>
        .hidd {
            display: none;
        }

        #log_out {
            margin-right: 5px;
            float: right;
            margin-right: 100px;
            margin-top: 5px;
        }

        #log_out > a {
            color: #ffffff;
        }

        .topbar-wrap {
            background-color: #E7E6E2;
            overflow: hidden;
        }

        .top_left {
            padding-left: 5%;
            float: left;
        }

        .top_right {
            color: #231816;
            float: right;

        }

        .top_right > p {
            height: 25px;
            line-height: 25px;
            margin-right: 50px;
            text-align: right;
        }

        .top_left > span {
            color: black;
        }
    </style>
    @yield('style')

</head>
<body>
<div class="topbar-wrap white">
    <!--<div class="topbar-inner clearfix">-->
    {{--<div class="topbar-logo-wrap clearfix">
        <h1 class="topbar-logo none">
            <a href="index.html" class="navbar-brand">管理员中心</a>
        </h1>
    </div>--}}
    <div class="top_left"><img src="/admin/images/logo.jpg"><span>长者俱乐部后台管理系统</span></div>
    <div class="top_right"><p>您好! {{Session::get('username')}}</p>
        <p>{{date('Y-m-d H:i:s',time())}}</p></div>
</div>
<div class="container clearfix">
    @include('admin.public.left')
            <!--/sidebar-->
    {{--<a href="#" color="#white">@yield('title1')</a>--}}
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list">
                <i class="icon-font"></i><span>@yield('title1')</span>
                <span class="crumb-step">&gt;</span><span class="crumb-name">@yield('title2')</span>
                {{--<a href="/help/index" style="margin-left: 50px;">帮助手册</a>--}}
                <button id="log_out" class="btn btn-info"><a href="/index.php/log_out">退出登录</a></button>
            </div>
        </div>
        @yield('content')
    </div>

    <!--/main-->
</div>
@yield('js')
</body>
<script>
    $(document).on('click', '#log_out', function () {
        if (confirm("确定退出吗？") == false) {
            return false;
        }
        //$.get("/index.php/log_out");
        $.get("/index.php/log_out", function (data) {
            window.location.href = "/index.php/login";
        });
        return false;
    })
    var url = window.location.href;
    var urls = url.substring(25);
    $("a").each(function () {
        if ($(this).attr("href") == urls) {
            $(this).parent("li").parent(".sub-menu").removeClass("hidd");
        }
    });

</script>
</html>
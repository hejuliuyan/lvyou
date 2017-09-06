@extends('admin.public.base')
@section('style')
    <style>
        .head_title{
            width:95%;
            height: 50px;
            background-color: #fff;

        }

        .search_info{
            width:100%;
            height: 50px;
            float: left;
            text-align: center;


        }

        .butt{
            width:40%;
            height: 50px;
            float: left;
            text-align: center;
            line-height: 50px;
        }

        .s_info{
            border: 0;
            padding: 4px;
            width: 100%;
            display: block;
            float: left;
            margin-left: 6px;
            border-radius: 10px;
        }

        .ss_info{
            width: 20%;
            border-radius: 20px;
            border: 1px solid gray;
            text-align: center;
            margin-left: 2%;
            margin-top: 13px;
            height: 30px;
            float: left;
            /* margin-left: 4%; */
        }

        .ss_type{
            width: 10%;
            /* border-radius: 20px; */
            /* border: 1px solid gray; */
            text-align: center;
            /* margin-left: 30%; */
            margin-top: 15px;
            height: 30px;
            float: left;
            margin-left: 2%;
            /* margin-left: 4%; */
        }

        .main_info{
            background-color: #fff;
            margin-top: 50px;
            width: 95%;
        }

        .pagination {
            margin: 30px auto;
            height: 10px;
            margin-left: 40%;
        }

        .pagination > li {
            float: left;
            font-size: 16px;
            height: 25px;
            width: 35px;
            border: 1px solid #D1D1D1;
            text-align: center;
        }

        .pagination>.active>span{
            background-color: #68B3C8;
            border-color: #68B3C8;
        }

        .file {
            position: relative;
            display: inline-block;
            background: #D0EEFF;
            border: 1px solid #99D3F5;
            border-radius: 4px;
            padding: 4px 12px;
            overflow: hidden;
            color: #1E88C7;
            text-decoration: none;
            text-indent: 0;
            line-height: 20px;
        }
        .file input {
            position: absolute;
            font-size: 100px;
            right: 0;
            top: 0;
            opacity: 0;
        }
        .file:hover {
            background: #AADFFD;
            border-color: #78C3F3;
            color: #004974;
            text-decoration: none;
        }

        .showname{
            position: relative;
            display: inline-block;
            /*  background: #D0EEFF; */
            /* border: 1px solid #99D3F5; */
            border-radius: 4px;
            padding: 4px 12px;
            overflow: hidden;
            /*  color: #1E88C7; */
            text-indent: 0;
            line-height: 20px;
            width: 100%;
            height: 100px;
            line-height: 100px;
            margin-bottom: 22px;
        }

        .ch_top{
            background-color: #f2f2f2;
            width: 100%;
            height: 50px;
            border-radius: 6px;
        }

        .ch_font{
            width:30%;
            height: 50px;
            float: left;
            color: gray;
            font-size: 14px;
            line-height: 50px;
        }

        .ch_close{
            width:20%;
            height: 50px;
            text-align: center;
            line-height: 50px;
            color: gray;
            float: right;
        }

        .ch_close a{
            color:gray;
        }

        .bt{
            margin-left: -24px;
            margin-top: 10px;
            overflow: hidden;
            position: relative;
            display: inline-block;
            border-radius: 28px;
            padding: 9px 12px;
            overflow: hidden;
            text-decoration: none;
            text-indent: 0;
            line-height: 20px;
            width: 50%;

        }

        .ch_btn{
            width: 100%;
            height: 62px;
        }

        .files{
            display: block;
            float: left;
            margin-top: 4px;
            position: absolute;
            font-size: 100px;
            right: 0;
            top: 0;
            opacity: 0;
        }

        .ch_ready{
            float: left;
            width: 50%;
        }

        .ch_cancel{
            float: right;
            width: 50%;
        }

    </style>





    <style>
        .mem_d div {
            float: left;
        }

        .mem_d {
            width: 50%;
            height: 35px;
            text-align: center;
            line-height: 35px;
        }

        .mem_detail {
            margin-left: 2%;
            margin-top: 4px;
            width: 80%;
            min-height: 300px;
            text-align: center;
        }

        .mem_title {
            width: 50%;
            height: 30px;
        }

        .mem_content {
            width: 50%;
            height: 30px;
        }

        .update_btn {
            margin-right: 10px
        }

        .pagination {
            margin: 30px auto;
            height: 10px;
        }

        .pagination > li {
            float: left;
            font-size: 16px;
            height: 25px;
            width: 35px;
            border: 1px solid #D1D1D1;
            text-align: center;
        }
    </style>
@stop
@section('title1')
   会员管理 {{--{{trans('member.title1')}}--}}
@stop
@section('title2')
    会员列表{{--{{trans('member.title2')}}--}}
@stop
@section('content')
    <div class="result-wrap">
        <form name="myform" id="myform" class='myform'>
            <div class="result-title">
                <div class="result-list" style="text-align: left; float: left;">
                    <form method='get' action="/index.php/ad_members">
                        <input type="text" placeholder='请输入手机号码' maxlength="11" name='search_phone' id='search_phone'><a
                                href="javascript:void(0)" style='margin-left:20px'>
                        <input type="text" placeholder='请输入身份证号' maxlength="18" name='search_idcard' id='search_idcard'><a
                                    href="javascript:void(0)" style='margin-left:20px'>
                            <input type="submit" class="btn btn-info btn_search" value='检&nbsp;&nbsp;索'></a>
                    </form>
                    <a href="/index.php/mem_add_view"><input type="button" class="btn btn-info " value='新增会员'></a>
                    <input type="button" class="btn btn-info  export" value='导&nbsp;&nbsp;出'></a>&nbsp;&nbsp;&nbsp;
                    <input type="button" class="btn btn-info import" value='导&nbsp;&nbsp;入'></a>
                    <!--  <button type="submit" class="btn btn-info btn_search">检索</button> -->
                    {{--导入导出--}}
                    <div id='choose' style='display:none'>
                        <form action="/index.php/import" method="post" enctype="multipart/form-data">
                            <div class='ch_top'>
                                <div class='ch_font'>导入</div>
                                <div class='ch_close'><a href="javascript:void(0)">X</a></div>
                            </div>
                            <div style='width:100%;height:50px;'>
                                <a href="javascript:void(0);" class="btn btn-info bt" style='margin-left:-24px;margin-top: 10px;'>选择文件
                                    <input type="file" name="excel" class='files' style='display: block;float:left;margin-top: 4px;'/>
                                </a>
                            </div>
                            <div class='showname'></div>
                            <div class='ch_btn'>
                                <div class='ch_ready'>
                                    <button type='submit' class='btn btn-info' style='width:65%'>确定</button>
                                </div>
                                <div class='ch_cancel'>
                                    <button type='button' class='btn btn-info' style='width:65%'>取消</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id='import_error' style='display:none'>
                        <div class='ch_top'>
                            <div class='ch_font'>信息</div>
                            <div class='ch_close'><a href="javascript:void(0)">X</a></div>
                        </div>
                        <div class='error_info' style='margin-top:10px;'>

                        </div>
                    </div>

                    {{--<div style='float:left;margin-top: 8px;width:15%'>--}}
                        {{--<button type="button" class="btn btn-info  export" style='width:100%;font-size:10px;'>导&nbsp;&nbsp;出</button>--}}
                    {{--</div>--}}
                    {{--<div style='float:left;margin-top: 8px;width:15%;margin-right: 2%;margin-left: 2%;'>--}}
                        {{--<button type="button" class="btn btn-info import" style='width:100%;font-size:10px;'>导&nbsp;&nbsp;入</button>--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="result-content">
                <table class="result-tab tablesorter" id="myTable" width="100%">
                    <thead>
                    <tr>
                        <th>{{--{{trans('member.member_num')}}--}}会员号</th>
                        <th>{{--{{trans('member.name')}}--}}真实姓名</th>
                        <th>{{--{{trans('member.phone')}}--}}手机号码</th>
                        <th>{{--{{trans('member.cr_time')}}--}}更新时间</th>
                        {{--<th>状态</th>--}}
                        <th>{{--{{trans('member.operating')}}--}}操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($list)): ?>
                    <?php foreach($list as $key => $value): ?>
                    <tr id="remove">
                        <td  class="{{ $value->id }}">{{ $value->id }}</td>
                        <td>{{ $value->real_name }}</td>
                        <td>{{ $value->mobile }}</td>
                        <td>{{ $value->update_time }}</td>
                        {{--<td>{{ $value->new_status }}</td>--}}
                        <td>
                            <a href="/index.php/mem_edit_view?id={{$value->id}}"><button type="button" class="btn btn-info">编辑</button></a>
                            {{--<a href="/index.php/mem_order_show?id={{$value->id}}"><button type="button" class="btn btn-info">账务</button></a>--}}
                            <input type="button" id="{{$value->id}}" reg_check="{{$value->reg_check}}"class="btn btn-info reg_check" value="{{$value->new_check}}"></input>
                            <input type="button" id="{{$value->id}}" active="{{$value->active}}"class="btn btn-info user_stop" value="{{$value->new_status}}"></input>
                            {{--<input type="button" id="{{$value->id}}" delete="{{$value->delete}}" real_name="{{$value->real_name}}"class="btn btn-info user_delete" value="删除"></input>--}}
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
                <!--<div class="list-page"> 2 条 1/1 页</div>-->
            </div>
            {!! $list->render() !!}
        </form>

    </div>
@stop
@section('js')
    <script>
        $(document).on('click', '.export', function () {
            var search_phone = $('#search_phone').val();
            var search_idcard = $('#search_idcard').val();
            window.location.href='/index.php/export';
            //?search_phone='+search_phone+'&search_idcard='+search_idcard

        });
        $(document).ready(function () {
            //第一列不进行排序(索引从0开始)
            //$("#myTable").tablesorter( {sortList: [[0,0], [1,0]]} );
            $("#myTable").tablesorter();
        });


        $(document).on('click', '.import', function () {

            $.blockUI({
                message: $('#choose'),
                css:{
                    border: 'none',
                    width:"400px",
                    height:"300px",
                    top:"30%",
                    left:"30%",
                    cursor: null,
                    'border-radius':"6px"
                },
            });

        });

        $('.ch_close,.ch_cancel').on('click',function(){
            $.unblockUI();
        });



        $(".bt").on("change","input[type='file']",function(){
            var filePath=$(this).val();
            if(filePath.indexOf("xlsx")!=-1){
                /*$(".fileerrorTip").html("").hide();*/
                var arr=filePath.split('\\');
                var fileName=arr[arr.length-1];
                $(".showname").html(fileName);
            }else{
                $(".showname").html("您未上传文件，或者您上传文件类型有误！");
                /*$(".fileerrorTip").html("您未上传文件，或者您上传文件类型有误！").show();*/
                return false ;
            }

        });
        //启用禁用
//        $(function(){
//            var active = $('.user_stop').attr('active');console.log(active);
//            if(active == 1){
//                $('.user_stop').css('background-color','red');
//            }
//        });
        $(document).ready(function(){
            $(".user_stop").each(function(){
                var _this = $(this);
                var active = _this.attr('active');
                if(active == 1){
                    $(this).css("background","none");
                    $(this).css("background","red");
                    //$(this).css("color","red");
                }
            });
        });
        $('.user_stop').on('click',function(){
            var _this = $(this);
            var id = _this.attr('id');
            var active = _this.attr('active');
            $.ajax({
                url:'/index.php/user_stop',
                data:{active:active,id:id},
                dataType:'json',
                type:'POST',
                success:function(data){
                    //console.log(data);
                    if(data == 0){
                        _this.val('已启用');
                        _this.attr('active','0');
                        _this.css('background','none');
                        _this.css('background','#49afcd');
//                        _this.css('border-color','none');
//                        _this.css('border-color','#49afcd');
                    }else if(data == 1){
                        _this.val('已禁用');
                        _this.attr('active','1');
                        _this.css('background','none');
                        _this.css('background','red');
//                        _this.css('border-color','none');
//                        _this.css('border-color','red');
                    }

                }
            })
        });

        //注册审核按钮
//        if($('.reg_check').attr('reg_check') ==0){
//
//        }
        $(document).ready(function(){
            $(".reg_check").each(function(){
                var _this = $(this);
                var reg_check = _this.attr('reg_check');
                if(reg_check == 0){
                    $(this).css("background","none");
                    $(this).css("background","#FF8000");
                    //$(this).css("color","red");
                }
            });
        });
        $('.reg_check').on('click',function(){
            var _this = $(this);
            var id = _this.attr('id');
            var reg_check = _this.attr('reg_check');
            if(reg_check==0){
                $.ajax({
                    url:'/index.php/reg_check',
                    data:{reg_check:reg_check,id:id},
                    dataType:'json',
                    type:'POST',
                    success:function(data){
                        //console.log(data);
                        if(data == false){
                            alert('已审核过');return;
                        }else if(data == 1){
                            _this.val('已审核');
                            _this.css('background','none');
                            _this.css('background','#49afcd');
                            _this.attr('active','1');
                        }

                    }
                })
            }

        });

        //删除按钮
        $('.user_delete').on('click',function(){
            var _this = $(this);
            var id = _this.attr('id');
            var user_delete = _this.attr('delete');
            var real_name = _this.attr('real_name');
            var url = window.location.href;
            alert('确定删除【'+real_name+'】?');
            if(user_delete==0){
                $.ajax({
                    url:'/index.php/user_delete',
                    data:{user_delete:user_delete,id:id},
                    dataType:'json',
                    type:'POST',
                    success:function(data){
                        //console.log(data);?page=3
                        if(data == 1){
                            //$("#remove .th"+id).remove();
                            //$("th").remove("#remove ."+id);
                            window.location.href = url;
//                            window.history.back(-1);
                        }else{
                           alert('删除失败');
                        }

                    }
                })
            }

        });
//        $('.btn_search').on('click',function(){
//            var search_phone = $('#search_phone').val();
//            var search_idcard = $('#search_idcard').val();
//            $.ajax({
//                url:'/index.php/mem_search',
//                data:{search_phone:search_phone,search_idcard:search_idcard},
//                dataType:'json',
//                type:'GET',
//                success:function(data){
//
//                }
//            })
//        });
    </script>
@stop
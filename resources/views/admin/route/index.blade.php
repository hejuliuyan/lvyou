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
        .result-list{
            overflow: hidden;
        }
        .route_select{
            float:left;
        }
        .route_select_default{
            margin:8px;
            width:200px;
            height:20px;
            border:1px solid #E4E4E4;
            float:left;
        }
        .route_code,.route_name{
            float:left;
            margin-left:8px;
            width:200px;
            /*height:20px;*/
            /*border:1px solid #E4E4E4;*/
            display: none;
        }
        .route_name_input{
            border:0;
            width:100%;
            height:100%;
        }
        .product_cate{
            width:200px;
            margin-left:8px;
            float:left;
            display: none;
        }
        .product_cate_select{

            float:left;
            border:0;
            width:100%;
            height:100%;
        }
        .route_search{
            float:left;
        }
        .route_add{
            float: left;
        }
    </style>
@stop
@section('title1')
    线路管理 {{--{{trans('member.title1')}}--}}
@stop
@section('title2')
    线路列表{{--{{trans('member.title2')}}--}}
@stop
@section('content')
    <div class="result-wrap">
        <form name="myform" id="myform" class='myform'>
            <div class="result-title">
                <div class="result-list" style="text-align: left; float: left;">
                    <form method='get' action="/index.php/route_list">
                        <div class="route_select">
                            <select name="route_select" id="">
                                <option value="">请选择检索条件 ...</option>
                                <option value="1">线路名称</option>
                                <option value="2">产品类别</option>
                                <option value="3">线路编号</option>
                            </select>
                        </div>
                        <div class="route_select_default"></div>
                        <div class="route_name">
                            <input display="none" class="route_name_input" type="text" placeholder='请输入线路名称' name="route_name">
                        </div>
                        <div class="route_code">
                            <input display="none" class="route_name_input" type="text" placeholder='请输入线路编号' name="route_code">
                        </div>
                        <div class="product_cate">
                            <select class="input" class="product_cate_select" name="product_cate" id="">
                                <option value="">请选择产品类别 ...</option>
                                <option value="1">尾单</option>
                                <option value="2">免费</option>
                                <option value="3">精品</option>
                            </select>
                        </div>
                        <div class="route_search">
                            <a href="javascript:void(0)" style='margin-left:20px'>
                                <input type="submit" class="btn btn-info btn_search" value='检&nbsp;&nbsp;索'></a>
                        </div>
                    </form>
                    <div class="route_add"><a href="/index.php/route_add_view"><input type="button" class="btn btn-info " value='新增线路'></a></div>
                </div>
            </div>
            <div class="result-content">
                <table class="result-tab tablesorter" id="myTable" width="100%">
                    <thead>
                    <tr>
                        <th>线路名称</th>
                        <th>游玩方式</th>
                        <th>交通方式</th>
                        <th>产品类别</th>
                        <th>行程天数</th>
                        <th>出发日期</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $key => $value)
                    <tr>
                        <td>{{ $value->route_name }}</td>
                        <td>@if($value->play_way==1)品质游@elseif($value->play_way==2)跟团游@endif</td>
                        <td>{{ $value->traffic }}</td>
                        <td>@if($value->product_cate==1)尾单@elseif($value->product_cate==2)免费@elseif($value->product_cate==3)精品@endif</td>
                        <td>{{ $value->journey_day }}天</td>
                        <td>{{$value->new_start_date}}</td>
                        <td>
                            <a href="/index.php/route_edit_view?id={{$value->id}}"><button type="button" class="btn btn-info">编辑</button></a>
                            <input type="button" id="{{$value->id}}" class="btn btn-info route_delete" value="删除"></input>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <?php
            echo $list->appends($info)->render();
            ?>
        </form>

    </div>
@stop
@section('js')
    <script>

        $(document).ready(function () {
            //第一列不进行排序(索引从0开始)
            //$("#myTable").tablesorter( {sortList: [[0,0], [1,0]]} );
            $("#myTable").tablesorter();
        });

        $("select[name=route_select]").on('change',function(){
            var route_select = $("select[name=route_select]").val();

            if(route_select == 1){
                $('.route_code').hide();
                $(".route_select_default").hide();
                $('.product_cate').hide();
                $('.route_name').show();


            }else if(route_select == 2){
                $('.route_code').hide();
                $(".route_select_default").hide();
                $('.route_name').hide();
                $('.product_cate').show();
            }else if(route_select == 3){
                $('.product_cate').hide();
                $(".route_select_default").hide();
                $('.route_name').hide();
                $('.route_code').show();
            }else{
                $('.route_code').hide();
                $('.route_name').hide();
                $('.product_cate').hide();
                $(".route_select_default").show();
            }
        });
        //删除
        $('.route_delete').on('click',function(){
            var id = $(this).attr('id');
            $.ajax({
                data:{id:id},
                dataType:'json',
                type:'post',
                url:'/index.php/route_delete',
                success:function(data){
                    //alert(data);
                    if(data == true){
                        alert('删除成功');
                        window.location.href = '/route_list';
                    }else{
                        alert('删除失败');
                        window.location.href = '/route_list';
                    }
                },
                error:function(){

                }
            });
        });
    </script>
@stop
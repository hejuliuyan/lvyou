@extends('admin.public.base')
@section('style')
    <style>

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



        .ch_close a{
            color:gray;
        }


    </style>





    <style>
        .mem_d div {
            float: left;
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
        .route_name{
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
        .product_cate,.class_code{
            float:left;
            margin-left:8px;
            width:200px;
            /*height:20px;*/
            /*border:1px solid #E4E4E4;*/
            display: none;
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
    发团管理 {{--{{trans('member.title1')}}--}}
@stop
@section('title2')
    发团列表{{--{{trans('member.title2')}}--}}
@stop
@section('content')
    <div class="result-wrap">
        <form name="myform" id="myform" class='myform'>
            <div class="result-title">
                <div class="result-list" style="text-align: left; float: left;">
                    <form method='get' action="/index.php/team_list">
                        <div class="route_select">
                            <select name="order_select" id="">
                                <option value="">请选择检索条件 ...</option>
                                <option value="1">发团编号</option>
                                <option value="2">发团日期</option>
                                <option value="3">班次</option>
                            </select>
                        </div>
                        <div class="route_select_default"></div>
                        <div class="route_name">
                            <input display="none" class="route_name_input" type="text" placeholder='请输入发团编号' name="team_code">
                        </div>
                        <div class="product_cate">
                            <input display="none" class="route_name_input datainp" id="dateinfo" type="text"  placeholder='请输入发团日期' name="team_start">
                        </div>
                        <div class="class_code">
                            <input display="none" class="route_name_input" type="text"  placeholder='请输入班次编号' name="class_code">
                        </div>

                        <div class="route_search">
                            <a href="javascript:void(0)" style='margin-left:20px'>
                                <input type="submit" class="btn btn-info btn_search" value='检&nbsp;&nbsp;索'></a>
                            <a href="/index.php/Teamcomplete" style='margin-left:20px'>
                                <input type="button" class="btn btn-info " value='定时任务'></a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="result-content">
                <table class="result-tab tablesorter" id="myTable" width="100%">
                    <thead>
                    <tr>
                        <th>班次</th>
                        <th>发团编号</th>
                        <th>领队姓名</th>
                        <th>领队手机号</th>
                        <th>出发日期</th>
                        <th>成团日期</th>
                        <th>成团人数</th>
                        <th>成团率</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($list)): ?>
                    <?php foreach($list as $key => $value): ?>
                    <tr>
                        <td>{{ $value->class_code }}</td>
                        <td>{{ $value->team_code }}</td>
                        <td>{{ $value->leader_name }}</td>
                        <td>{{ $value->leader_phone }}</td>
                        <td>{{ $value->new_date_departure}}</td>
                        <td>{{ $value->new_team_complete_date }}</td>
                        <td>{{ $value->cluster_num }}</td>
                        <td>{{ $value->order_rate }}</td>
                        <td class="status" order_status="{{$value->status}}">{{ $value->new_status }}</td>
                        <td>
                            {{--@if($value->status_show == 1)--}}
                            <a href="/index.php/team_detail?id={{$value->id}}"  status="{{$value->status}}"><button type="button" class="btn btn-info">编辑</button></a>
                            {{--@else--}}
                            {{--@endif--}}
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            {!! $list->render() !!}
        </form>

    </div>
@stop
@section('js')
    <script>
        //日期控件
        $('.datainp').on('click',function(){
            jeDate({
                dateCell:"#dateinfo",
                format:"YYYY-MM-DD",
              //format:"YYYY-MM-DD hh:mm:ss",
                isinitVal:true,
                isTime:true, //isClear:false,
                minDate:"2016-11-15 00:00:00",
                okfun:function(val){
//                    alert(val)

                }
            });
        });
        $(document).ready(function () {
            //第一列不进行排序(索引从0开始)
            //$("#myTable").tablesorter( {sortList: [[0,0], [1,0]]} );
            $("#myTable").tablesorter();
            //编辑按钮显示
//            $(".edit_show").each(function(){
//                var status_show = this.getAttribute('status_show');
//                console.log(status_show);
//                if(status_show == 0){
//                    this.parentNode.removeChild(this);
//                }
//            });
        });

        $("select[name=order_select]").on('change',function(){
            var order_select = $("select[name=order_select]").val();

            if(order_select == 1){
                $(".route_select_default").hide();
                $('.product_cate').hide();
                $('.class_code').hide();
                $('.route_name').show();
            }else if(order_select == 2){
                $(".route_select_default").hide();
                $('.route_name').hide();
                $('.class_code').hide();
                $('.product_cate').show();
            }else if(order_select == 3){
                $(".route_select_default").hide();
                $('.route_name').hide();
                $('.product_cate').hide();
                $('.class_code').show();
            }else{
                $('.route_name').hide();
                $('.class_code').hide();
                $('.product_cate').hide();
                $(".route_select_default").show();
            }
        });

    </script>
@stop
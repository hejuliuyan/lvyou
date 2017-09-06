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
        .product_cate,.class_code,.group_code{
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
    订单管理 {{--{{trans('member.title1')}}--}}
@stop
@section('title2')
    订单列表{{--{{trans('member.title2')}}--}}
@stop
@section('content')
    <div class="result-wrap">
        <form name="myform" id="myform" class='myform'>
            <div class="result-title">
                <div class="result-list" style="text-align: left; float: left;">
                    <form method='get' action="/index.php/order_list">
                        <div class="route_select">
                            <select name="order_select" id="">
                                <option value="">请选择检索条件 ...</option>
                                <option value="1">订单编号</option>
                                <option value="2">下单手机号</option>
                                <option value="3">班次</option>
                                <option value="4">发团编号</option>
                            </select>
                        </div>
                        <div class="route_select_default"></div>
                        <div class="route_name">
                            <input display="none" class="route_name_input" type="text" placeholder='请输入订单编号' name="order_code">
                        </div>
                        <div class="product_cate">
                            <input display="none" class="route_name_input" type="text" placeholder='请输入下单手机号' name="mobile">
                        </div>
                        <div class="class_code">
                            <input display="none" class="route_name_input" type="text" placeholder='请输入班次' name="class_code">
                        </div>
                        <div class="group_code">
                            <input display="none" class="route_name_input" type="text" placeholder='请输入发团编号' name="group_code">
                        </div>
                        <div class="route_search">
                            <a href="javascript:void(0)" style='margin-left:20px'>
                                <input type="submit" class="btn btn-info btn_search" value='检&nbsp;&nbsp;索'></a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="result-content">
                <table class="result-tab tablesorter" id="myTable" width="100%">
                    <thead>
                    <tr>
                        <th>订单编号</th>
                        <th>班次</th>
                        <th>下单人手机号</th>
                        <th>出发日期</th>
                        <th>下单时间</th>
                        <th>总价</th>
                        <th>状态</th>
                        <th>退单</th>
                        <th>退款</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($list)): ?>
                    <?php foreach($list as $key => $value): ?>
                    <tr>
                        <td>{{ $value->order_code }}</td>
                        <td>{{ $value->class_code }}</td>
                        <td>{{ $value->new_mobile }}</td>
                        <td>{{ $value->new_start_date }}</td>
                        <td>{{$value->new_order_time}}</td>
                        <td>{{ $value->order_price }}</td>
                        <td class="status" order_status="{{$value->status}}">{{ $value->new_status }}</td>
                        <td>
                            @if($value->payback_show == 1)
                                <input type="button" id="{{$value->id}}" class="btn btn-info order_back" value="退单"></input>
                            @else
                            @endif
                        </td>
                        <td>
                            @if($value->backmoney_show == 1)
                                <input type="button" id="{{$value->id}}"  class="btn btn-info order_back_money" value="退款"></input>
                            @else
                            @endif
                        </td>
                        <td><a href="/index.php/order_detail?id={{$value->id}}"><button type="button" class="btn btn-info">查看</button></a></td>
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

        $(document).ready(function () {
            //第一列不进行排序(索引从0开始)
            //$("#myTable").tablesorter( {sortList: [[0,0], [1,0]]} );
            $("#myTable").tablesorter();
            //退单按钮显示
            $(".order_back").each(function(){
                var payback_show = this.getAttribute('order_status_show');
                console.log(payback_show);
                if(payback_show == 0){
                    this.parentNode.removeChild(this);
                }
            });
            //退款按钮显示
            $(".order_back_money").each(function(){
                var order_back_money = this.getAttribute('order_status_show');
                console.log(order_back_money);
                if(order_back_money == 0){
                    this.parentNode.removeChild(this);
                }
            });
        });

        $("select[name=order_select]").on('change',function(){
            var order_select = $("select[name=order_select]").val();

            if(order_select == 1){
                $(".route_select_default").hide();
                $('.product_cate').hide();
                $('.class_code').hide();
                $('.group_code').hide();
                $('.route_name').show();
            }else if(order_select == 2){
                $(".route_select_default").hide();
                $('.route_name').hide();
                $('.class_code').hide();
                $('.group_code').hide();
                $('.product_cate').show();
            }else if(order_select == 3){
                $(".route_select_default").hide();
                $('.route_name').hide();
                $('.product_cate').hide();
                $('.group_code').hide();
                $('.class_code').show();
            }else if(order_select == 4){
                $(".route_select_default").hide();
                $('.route_name').hide();
                $('.product_cate').hide();
                $('.class_code').hide();
                $('.group_code').show();
            }else{
                $('.route_name').hide();
                $('.product_cate').hide();
                $('.class_code').hide();
                $('.group_code').hide();
                $(".route_select_default").show();
            }
        });

        $(document).ready(function(){
            $(".status").each(function(){
                var _this = $(this);
                var status = _this.attr('order_status');
                if(status == 1){

                }else if(status == 2){
                    $(this).css("color","#00FE9A");
                }else if(status == 3){
                    $(this).css("color","#9A0FFD");
                }else if(status == 4){
                    $(this).css("color","#9A0FFD");
                }else if(status == 5){
                    $(this).css("color","#9A0FFD");
                }else if(status == 6){
                    $(this).css("color","#9A0FFD");
                }else if(status == 7){
                    $(this).css("color","#FF6507");
                }else if(status == 8){
                    $(this).css("color","#1A9AFB");
                }else{
                    $(this).css("color","green");
                }
            });


            //退单
            $('.order_back').on('click',function(){
                var order_id = $(this).attr('id');
                var url = window.location.href;
                $.ajax({
                    url:'/index.php/order_back_check',
                    dataType:'json',
                    type:'POST',
                    data: {
                        order_id:order_id,
                    },
                    success: function (data) {
                        if(data == true){
                            window.location.href = url;
                        }else{
                            alert('退单失败');
                        }
                    },
                    error: function () {

                    }
                });
            });
            //退款
            $('.order_back_money').on('click',function(){
                var order_id = $(this).attr('id');
                var url = window.location.href;
                $.ajax({
                    url:'/index.php/order_back_money',
                    dataType:'json',
                    type:'POST',
                    data: {
                        order_id:order_id,
                    },
                    success: function (data) {
                        if(data == true){
                            window.location.href = url;
                        }else{
                            alert('退单失败');
                        }
                    },
                    error: function () {

                    }
                });
            });
        });
    </script>
@stop
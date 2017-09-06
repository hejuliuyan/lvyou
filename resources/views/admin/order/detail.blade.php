@extends('admin.public.base')
@section('style')
    <style>
        .order_border{
            width:80%;
            float: left;

            height:auto;
            overflow: hidden;
            /*border:1px solid #68B3C8;*/
        }
        .order_title{
            width: 10%;
            margin-left: 2%;
            height: 50px;
            font-size: 20px;
            /*border:1px solid #68B3C8;*/
            text-align: left;
            line-height:50px;
            color:#68B3C8;
        }
        .order_table{
            width: 98%;
            margin-left:2%;
            height: 250px;
        }
        .order_th{
            width:15%;
            height:35px;
            background-color: #f2f2f2;
            border:1px solid #ECECEC;
            line-height: 35px;
            text-align: center;
        }
        .order_td{
            width:35%;
            height:35px;
            line-height: 35px;
            text-align: center;
            border:1px solid #ECECEC;
        }
        /*状态明细*/
        .order_status{
            width: 98%;
            margin-left:2%;
            height: 250px;
            border:1px solid #ECECEC;
            overflow: auto;
        }
        .status_th{
            width:25%;
            height:35px;
            /*background-color: #f2f2f2;*/
            /*border:1px solid #ECECEC;*/
            line-height: 35px;
            text-align: center;
        }
        .status_td{
            width:50%;
            height:35px;
            line-height: 35px;
            text-align: center;
        }
        .back_button{
            width:80%;
            float: left;
            padding-left: 2%;
            padding-top: 10px;
            height:50px;
            overflow: hidden;
            /*border:1px solid #68B3C8;*/
        }
    </style>
@stop
@section('title1')
    订单管理
@stop
@section('title2')
    订单详情
@stop
@section('content')
    <div class="order_border">
        <div class="order_title">基本信息</div>
            <table class="order_table">
                <tr class="order_tr">
                    <td class="order_th">订单编号</td>
                    <td class="order_td">{{$list[0]->order_code}}</td>
                    <td class="order_th">下单人</td>
                    <td class="order_td">{{$list[0]->real_name}}</td>
                </tr>
                <tr class="order_tr">
                    <td class="order_th">线路编号</td>
                    <td class="order_td">{{$list[0]->code}}</td>
                    <td class="order_th">线路名称</td>
                    <td class="order_td">{{$list[0]->route_name}}</td>
                </tr>
                <tr class="order_tr">
                    <td class="order_th">单价</td>
                    <td class="order_td">{{$list[0]->order_price}}</td>
                    <td class="order_th">总价</td>
                    <td class="order_td">{{$list[0]->peer_sum_price}}</td>
                </tr>
                <tr class="order_tr">
                    <td class="order_th">保险</td>
                    <td class="order_td">{{$list[0]->insurance}}</td>
                    <td class="order_th"></td>
                    <td class="order_td"></td>
                </tr>
                <tr class="order_tr">
                    <td class="order_th">集合地点</td>
                    <td class="order_td">{{$list[0]->start_city_place}}</td>
                    <td class="order_th">出发时刻</td>
                    <td class="order_td">{{$list[0]->start_city_place_time}}</td>
                </tr>
                <tr class="order_tr">
                    <td class="order_th">下单时刻</td>
                    <td class="order_td">{{$list[0]->new_order_time}}</td>
                    <td class="order_th">出发日期</td>
                    <td class="order_td">{{$list[0]->start_city_place_date}}</td>
                </tr>
                <tr class="order_tr">
                    <td class="order_th">发团编号</td>
                    <td class="order_td">{{$list[0]->group_code}}</td>
                    <td class="order_th">状态</td>
                    <td class="order_td status" order_status="{{$list[0]->status}}">{{$list[0]->new_status}}</td>
                </tr>
            </table>
    </div>

    <div class="order_border">
        <div class="order_title">状态明细</div>
        <div class="order_status">
            <table>
            @foreach ($list[1] as $status)
                <tr>
                    <td class="status_th">{{$status->new_time}}</td>
                    <td class="status_td">{{$status->operation}}</td>
                </tr>
            @endforeach
            </table>
        </div>
    </div>
    <div class="back_button">
        <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button">
    </div>

@stop
@section('js')
    <script>
        $(document).ready(function(){
            var status = $('.status').attr('order_status');
            if(status == 1){
                $('.status').css('color','red');
            }else if(status == 2){
                $('.status').css("color","#00FE9A");
            }else if(status == 3){
                $('.status').css("color","#9A0FFD");
            }else if(status == 4){
                $('.status').css("color","#9A0FFD");
            }else if(status == 5){
                $('.status').css("color","#9A0FFD");
            }else if(status == 6){
                $('.status').css("color","#9A0FFD");
            }else if(status == 7){
                $('.status').css("color","#FF6507");
            }else if(status == 8){
                $('.status').css("color","#158CEF");
            }else{
                $('.status').css("color","green");
            }
        });

    </script>
@stop
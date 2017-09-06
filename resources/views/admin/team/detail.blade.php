@extends('admin.public.base')
@section('style')
    <style>
        .border{
            width: 80%;
            float: left;
            overflow: hidden;
        }
        .order_border{
            width:100%;
            float: left;

            height:auto;
            overflow: hidden;
            /*border:1px solid #68B3C8;*/
        }
        .order_title{
            width: 98%;
            margin-left:2%;
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
        .input{
            height:100%;
            width: 99%;
            border:0;
        }
        .vehicle_load{
            float: left;
            height:100%;
            width: 50%;
            border:0;
        }
        .team_save{
            padding-top: 10px;
            padding-left: 45%;
            width: 98%;
            margin-left:2%;
            height: 50px;
            border:1px solid #ECECEC;
        }
        /*同行人员*/
        .peer{
            width:25%;
            height: 30px;
            float: left;
            padding-left: 2%;
            text-align: left;
        }
        .peer_select{
            float: right;
            margin-right: 2%;
            font-size:18px;
            font-weight: 800;
            cursor:pointer;
            text-decoration:underline;
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
            padding-left: 45%;
            padding-top: 10px;
            height:50px;
            overflow: hidden;
            /*border:1px solid #68B3C8;*/
        }
        /*发送消息弹出框*/
        .event-main{
            display: none;
        }
        .event_top{
            width:100%;
            height: 40px;
            line-height: 40px;
        }
        .event_font{
            width:90%;
            height: 40px;
            float: left;

        }
        .event_close{
            width:10%;
            color: red;
            height: 40px;
            float: left;
            text-align: center;
        }

        .event_inner{
            width:80%;
            height: 200px;
            float: left;
            margin-left: 10%;

        }
        .textarea{
            width:100%;
            height: 200px;
        }
        .event-submit{
            margin-top: 10px;
            height: 30px;
            line-height:30px;

        }

    </style>
@stop
@section('title1')
    发团管理
@stop
@section('title2')
    发团详情
@stop
@section('content')
    <div class="border">
        <div class="order_border">
            <div class="order_title">基本信息</div>
            <table class="order_table">
                <tr class="order_tr">
                    <td class="order_th">发团编号</td>
                    <td class="order_td">{{$list[0]->team_code}}</td>
                    <td class="order_th">出行人数</td>
                    <td class="order_td">{{$list[0]->travel_num}}</td>
                </tr>
                <tr class="order_tr">
                    <td class="order_th">集合地点</td>
                    <td class="order_td">{{$list[0]->address}}</td>
                    <td class="order_th">目的地</td>
                    <td class="order_td">{{$list[0]->destination}}</td>
                </tr>
                <tr class="order_tr">
                    <td class="order_th">领队姓名</td>
                    <td class="order_td"><input type="text" class="input" name="leader_name" value="{{$list[0]->leader_name}}"></td>
                    <td class="order_th">领队手机号</td>
                    <td class="order_td"><input type="text" class="input" name="leader_phone" value="{{$list[0]->leader_phone}}" maxlength="11" onkeyup="value=this.value.replace(/\D+/g,'')" placeholder="请输入领队手机号"></td>
                </tr>
                <tr class="order_tr">
                    <td class="order_th">司机姓名</td>
                    <td class="order_td"><input type="text" class="input" name="driver_name" value="{{$list[0]->driver_name}}"></td>
                    <td class="order_th">司机手机号</td>
                    <td class="order_td"><input type="text" class="input" name="driver_phone" value="{{$list[0]->driver_phone}}" maxlength="11" onkeyup="value=this.value.replace(/\D+/g,'')" placeholder="请输入司机手机号"></td>
                </tr>
                <tr class="order_tr">
                    <td class="order_th">线路编号</td>
                    <td class="order_td">{{$list[0]->route_code}}</td>
                    <td class="order_th">游玩天数</td>
                    <td class="order_td">{{$list[0]->journey_day}}</td>
                </tr>
                <tr class="order_tr">
                    <td class="order_th">车辆信息</td>
                    <td class="order_td"><input type="text" class="vehicle_load" name="vehicle_load" value="{{$list[0]->vehicle_load}}"><span style="float: left;">人座</span></td>
                    <td class="order_th">车辆牌号</td>
                    <td class="order_td"><input type="text" class="input" name="plate_num" value="{{$list[0]->plate_num}}"></td>
                </tr>

                <tr class="order_tr">
                    <td class="order_th">出发日期</td>
                    <td class="order_td">{{$list[0]->start_date}}</td>
                    <td class="order_th">状态</td>
                    <td class="order_td status" team_status="{{$list[0]->status}}">{{$list[0]->new_status}}</td>
                </tr>
                {{--<tr class="order_tr">--}}
                    {{--<td class="order_th">退团期限</td>--}}
                    {{--<td class="order_td"><input display="none" class="input back_team datainp" id="dateinfo" type="text"  placeholder='请输入发团日期' name="back_team" value="{{$list[0]->back_team}}"></td>--}}
                    {{--<td class="order_th">待定</td>--}}
                    {{--<td class="order_td status"></td>--}}
                {{--</tr>--}}
            </table>
            <div class="team_save"><button type="button" id="{{$list[0]->id}}" class="btn btn-info save_button">保&nbsp;&nbsp;存</button></div>
        </div>

        <div class="order_border">
            <div class="order_title"><span>出行人</span><span class="peer_select">全选</span></div>
            <div class="order_status">
                @foreach ($list[1] as $peer)
                    <div class="peer">
                        <input type="checkbox" name="test" value="{{$peer->id}}">{{$peer->peer}}
                    </div>
                @endforeach
            </div>
            <div class="team_save">
                <button type="button" id="{{$list[0]->id}}" class="btn btn-info send_wxmessage">发送微信消息</button>
                @if($list[0]->status == 2)
                    <button type="button" id="{{$list[0]->id}}" class="btn btn-info close_team">关闭该团</button>
                    {{--<a href="/index.php/close_team?team_id={{$list[0]->id}}"><button type="button" class="btn btn-info">关闭该团</button></a>--}}
                @else
                @endif

            </div>
            {{--<div class="team_save"><button type="button" id="{{$list[0]->id}}" class="btn btn-info send_wxmessage">发送微信消息</button></div>--}}
        </div>

        <div class="order_border">
            <div class="order_title">状态明细</div>
            <div class="order_status">
                <table>
                @foreach ($list[2] as $status)
                    <tr>
                        <td class="status_th">{{$status->new_time}}</td>
                        <td class="status_td">{{$status->operation}}</td>
                    </tr>
                @endforeach
                </table>
            </div>
            <div class="back_button"> <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button"></div>
        </div>
    </div>


    {{--微信消息弹出框--}}
    <div class="event-main" id="event-container">
        <div class='event_top'>
            <div class='event_font'>编辑微信消息</div>
            <div class='event_close'><a href="javascript:void(0)">X</a></div>
        </div>
        <form>
            <div class="event_inner">
                <textarea name="message" class="textarea" maxlength="100" placeholder="不超过100个字符"></textarea>
            </div>
            <button type="button" class="event-submit" id="submit-event">发送</button>
        </form>
    </div>
@stop
@section('js')
    <script>
        var url = window.location.href;
        $(document).ready(function(){
            var status = $('.status').attr('team_status');
            if(status == 1){
                $('.status').css('color','red');
            }else if(status == 2){
                $('.status').css("color","#00FE9A");
            }else if(status == 3){
                $('.status').css("color","#9A0FFD");
            }else{
                $('.status').css("color","#9A0FFD");
            }
        });
        //全选和清空
        $('.peer_select').on('click',function(){
            var peer_select = $('.peer_select').html();

            if(peer_select=='全选'){
                $("input[name='test']").each(function(){this.checked=true;});
                $('.peer_select').html("清空");
            }else{
                $("input[name='test']").each(function(){this.checked=false;});
                $('.peer_select').html("全选");
            }
        });
        //保存
        $('.save_button').on('click',function(){

            var team_id = $(this).attr('id');
            var leader_name=$('input[name=leader_name]').val();
            var leader_phone=$('input[name=leader_phone]').val();
            var driver_name=$('input[name=driver_name]').val();
            var driver_phone=$('input[name=driver_phone]').val();
            var vehicle_load=$('input[name=vehicle_load]').val();
            var plate_num=$('input[name=plate_num]').val();
            var back_team = $('input[name=back_team]').val();
            var url = window.location.href;
            $.ajax({
                url:'/index.php/team_edit',
                dataType:'json',
                type:'POST',
                data: {
                    team_id:team_id,
                    leader_name:leader_name,
                    leader_phone:leader_phone,
                    driver_name:driver_name,
                    driver_phone:driver_phone,
                    vehicle_load:vehicle_load,
                    plate_num:plate_num,
                    back_team:back_team,
                },
                success: function (data) {
                    console.log(data);
                    if(data == true){
                        window.location.href = url;
                    }else{
                        alert('保存失败');
                    }
                },
                error: function () {

                }
            });
        });
        //发送微信消息
        var status = $('.status').attr('team_status');
        console.log
        if(status == 3){
            $('.send_wxmessage').on('click',function(){
                var team_id = $(this).attr('id');
                var url = window.location.href;
                var member = $("input:checkbox[name='test']:checked");
                var member_id = [];
                for(var i=0;i<member.length;i++){
                    member_id[i] = member[i].value;
                }

                $.ajax({
                    url:'/index.php/team_examine',
                    dataType:'json',
                    type:'POST',
                    data: {
                        team_id:team_id
                    },
                    success: function (data) {
                        console.log(data);
                        if(data == true){
                            //发送消息
                            $.ajax({
                                url:'/index.php/admin_send_message',
                                dataType:'json',
                                type:'POST',
                                data: {
                                    team_id:team_id,
                                    member_id:member_id,
                                },
                                success: function (data) {
                                    console.log(data);
                                    if(data == true){
                                        alert('发送成功');
                                    }else{
                                        alert('发送失败');
                                    }
                                },
                                error: function () {

                                }
                            });

                        }else{
                            alert('基本信息完善后才可发送');return;
                        }
                    },
                    error: function () {

                    }
                });
            });
        }else{
            //显示新增事件
            $('.send_wxmessage').on('click',function(){
                var member = $("input:checkbox[name='test']:checked");
                if(member[0]=='' || member[0]==null || member[0]==undefined){
                    alert('请选择出行人');return;
                }
                $.blockUI({
                    message: $('#event-container'),
                    css:{
                        border: 'none',
                        width:"400px",
                        height:"300px",
                        top:"25%",
//                        left:"30%",
                        cursor: null,
                        'border-radius':"10px"
                    },
                });
            });
            //隐藏
            $('.event_close').on('click',function(){
                $.unblockUI();
            })
        }


        //推迟状态发送消息
        $('.event-submit').on('click',function(){
            var message = $('.textarea').val();
            if(message=='' || message==null || message==undefined){
                alert('请输入消息内容');return;
            }
            var team_id = $('.send_wxmessage').attr('id');
            var member = $("input:checkbox[name='test']:checked");
            var url = window.location.href;
            var member_id = [];
            for(var i=0;i<member.length;i++){
                member_id[i] = member[i].value;
            }
            $.ajax({
                url:'/index.php/postpone_message',
                dataType:'json',
                type:'POST',
                data: {
                    team_id:team_id,
                    member_id:member_id,
                    message:message,
                },
                success: function (data) {
                    console.log(data);
                    if(data == true){
                        alert('发送成功');
                        window.location.href= url;
                    }else{
                        alert('发送失败');
                        window.location.href= url;
                    }
                },
                error: function () {

                }
            });
        });

        //日期控件
        $('.datainp').on('click',function(){
            jeDate({
                dateCell:"#dateinfo",
                format:"YYYY-MM-DD hh:mm",
                //format:"YYYY-MM-DD hh:mm:ss",
                isinitVal:true,
                isTime:true, //isClear:false,
                minDate:"2016-11-15 00:00:00",
                okfun:function(val){
//                    alert(val)

                }
            });
        });

        //关闭团

        $('.close_team').on('click',function(){
            var team_id = $(this).attr('id');
            var preurl = document.referrer;
            var url = window.location.href;
            $.ajax({
                url:'/index.php/close_team',
                dataType:'json',
                type:'POST',
                data: {
                    team_id:team_id,
                },
                success: function (data) {
                    console.log(data);
                    if(data == true){
                        alert('关闭成功');
                        window.location.href= preurl;
                    }else{
                        alert('关闭失败');
                        window.location.href= url;
                    }
                },
                error: function () {

                }
            });
        });

    </script>
@stop
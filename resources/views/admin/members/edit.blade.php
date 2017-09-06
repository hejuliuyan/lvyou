@extends('admin.public.base')
@section('style')
    <style>
        .result-content {
            width: 80%;
            float: left;
            border:1px solid #E4E4E4;
        }
        .table-content{
            width:95%;
            margin:20px auto;
            border:1px solid #E4E4E4;
        }
        .th-content{
            width:15%;
            height:40px;
            background-color: #F2F2F2;
            border:1px solid #E4E4E4;
        }
        .td-content{
            width:35%;
            height:40px;
            border:1px solid #E4E4E4;
        }
        .btn-password{
            /*background-color: #C7A943;*/
        }
        .btn-tr{
            height:80px;
        }
        .result-wrap, .result-one {
            overflow: hidden;
        }

        .licence_pic {
            width: 40%;
            float: left;
            height: 60px;
            text-align: center;
        }

        .licence_pic > div > img {
            /* margin-left:100px;*/

        }

        .licence_pic > div > p {
            text-align: center;
        }

        /*日历弹出框*/
        .event_top{
            height: 60px;
            line-height: 60px;
            font-size: 22px;
        }
        .event_font{
            text-align: center;
        }
        .event_close{
            font-size: 30px;
            color: gray;
            float: right;
            margin-right: 5%;
        }
        .event-inner{
            margin-bottom: 20%;
        }
        .cluster_span{
            margin-left: 18px;

        }
        .add-new input {
            display:in-line;
            width: 70px;
            height: 22px;
        }

    </style>
@stop
@section('title1')
    会员管理
@stop
@section('title2')
    详情编辑
@stop
@section('content')

    <div class="result-content" >
        <table  class="table-content">
            <tr>
                <th class="th-content">会员号</th>
                <td class="td-content mem_id">{{$data[0]->id}}</td>
                <th class="th-content">角色</th>
                <td class="td-content">{{$data[0]->role}}</td>
            </tr>
            <tr>
                <th class="th-content">账户名</th>
                <td class="td-content">{{$data[0]->account}}</td>
                <th class="th-content">真实姓名</th>
                <td class="td-content">{{$data[0]->real_name}}</td>
            </tr>
            <tr>
                <th class="th-content">会员卡号</th>
                <td class="td-content">{{$data[0]->member_card}}</td>
                <th class="th-content">身份证号</th>
                <td class="td-content">{{$data[0]->id_card}}</td>
            </tr>

            <tr>
                <th class="th-content">性别</th>
                <td class="td-content">{{$data[0]->sex}}</td>
                <th class="th-content">手机号</th>
                <td class="td-content">{{$data[0]->mobile}}</td>
            </tr>



            <tr>
                <th class="th-content">所在地</th>
                <td class="td-content">{{$data[0]->address}}</td>
                <th class="th-content">组长手机号</th>
                <td class="td-content">{{$data[0]->leader_phone}}</td>
            </tr>

            <tr>
                <th class="th-content">创建时间</th>
                <td class="td-content">{{  $data[0]->created_at}}</td>
                <th class="th-content">更新时间</th>
                <td class="td-content">{{  $data[0]->update_at}}</td>
            </tr>

            <tr>
                <th class="th-content">积分</th>
                <td class="td-content">{{$data[0]->integral}}</td>
                <th class="th-content">已玩景点1</th>
                <td class="td-content">{{$data[0]->scenic01}}</td>

            </tr>
            <tr>
                <th class="th-content">充值次数</th>
                <td class="td-content"><span>{{$data[0]->recharge_num}}</span><input type="button"class="btn recharge_btn" style="margin-left:20%;" value="继续充值" ></td>
                <th class="th-content">已玩景点2</th>
                <td class="td-content">{{$data[0]->scenic02}}</td>
            </tr>
            <tr>
                <th  class="th-content">余额次数</th>
                <td class="td-content">{{$data[0]->balance_num}}</td>
                <th class="th-content">已玩景点3</th>
                <td class="td-content">{{$data[0]->scenic03}}</td>
            </tr>
            <tr>
                <th  class="th-content">用户标签</th>
                <td class="td-content">{{$data[0]->member_label}}</td>
                <th class="th-content">报名地址</th>
                <td class="td-content">{{$data[0]->apply_address}}</td>
            </tr>
            <tr>
                <th class="th-content">重置密码</th>
                <td class="td-content"><input type="button"class="btn btn-password"  value="随机生成" >&nbsp;&nbsp;<span id="reset_password"></span></td>
                <th class="th-content">维护人</th>
                <td class="td-content"><input type="text" name="maintainer" value="{{$data[0]->maintainer}}" style="width:98.6%; height:100%;border: 0;"></td>

            </tr>
            <tr>
                <th class="th-content">备注</th>
                <td class="td-content" colspan="3"><input type="text" name="remark" value="{{$data[0]->remark}}" style="width:99.5%; height:100%;border: 0;"></td>
            </tr>

            <tr class="btn-tr">
                <th colspan="2"><input type="submit"class="btn btn-primary btn6 mr10 ws_fb btn-info update_btn" value="提交"  id="submit"></th>
                <td colspan="2"><input class="btn btn6" onclick="history.go(-1)" value="返回" type="button"></td>
            </tr>
        </table>
        </form>
    </div>


    {{--日历弹出框--}}
    <div class="event-main" id="event-container" style="display: none">
        <div class='event_top'>
            <div class='event_font'>充值<a href="javascript:void(0)" class='event_close'>X</a></div>
        </div>
        <div class="event-inner">
            <div class="add-new">
                <span class="cluster_span">请输入充值次数：<input type="text" name="recharge_num" class="recharge_num" placeholder="充值次数" onkeyup="value=this.value.replace(/\D+/g,'')">次</span>
            </div>
        </div>
        <div class="event-button">
            <button type="button" class="btn btn6" id="submit-event">保存</button>
        </div>
    </div>

@stop
@section('js')
    <script>
        //继续充值
        $('.recharge_btn').on('click',function(){
            //显示新增事件
            $.blockUI({
                message: $('#event-container'),
                css:{
                    border: 'none',
                    width:"400px",
                    height:"200px",
                    top:"30%",
                    left:"30%",
                    cursor: null,
                    'border-radius':"6px"
                },
            });
            //隐藏
            $('.event_close').on('click',function(){
                $.unblockUI();
            })

            $('#submit-event').on('click',function(){

                var id = $('.mem_id').text();
                var url = window.location.href;
                var recharge_num = $("input[name=recharge_num]").val();
                console.log(recharge_num);
                $.ajax({
                    url:'/index.php/recharge_num',
                    dataType:'json',
                    type:'POST',
                    data: {
                        id: id,recharge_num:recharge_num
                    },
                    success: function (data) {
                        if (data == true) {
                            window.location.href = url;
                        } else {
                            alert("充值失败");
                        }

                    },
                    error: function () {
                        //请求出错处理
                    }
                });
            })

        });
        //密码重置
        $('.btn-password').on('click',function(){
            var id = $('.mem_id').text();
            //alert(id);return;
            $.ajax({
                url:'/index.php/reset_password',
                dataType:'json',
                type:'POST',
                data: {
                    id: id,
                },
                success: function (data) {
//                    if (typeof data == "string") {//console.log(data);return;
//                        var data = eval('(' + data + ')');
//                    }
                    if (data != false) {
                        $('#reset_password').html(data);
                       // alert("重置成功");
                        //window.location.href = '/index.php/mem_edit_view?id='+id;
                    } else {
                        alert("重置失败");
                    }

                },
                error: function () {
                    //请求出错处理
                }
            })
        });
        //编辑提交
        $(document).on('click', '.update_btn', function () {
            var remark = $("input[name = remark]").val();
            var maintainer = $("input[name = maintainer]").val();
            var id = $('.mem_id').text();
            $.ajax({
                type: "POST",
                url: "/index.php/edit_post",
                data: {
                    id: id,remark: remark, maintainer:maintainer,
                },
                datatype: "json",//"xml", "html", "script", "json", "jsonp", "text".
                success: function (data) {
                    if (typeof data == "string") {
                        var data = eval('(' + data + ')');
                    }
                    //console.log(data);
                    if (data == true) {
                        alert("修改成功");
                        window.location.href = '/index.php/mem_edit_view?id='+id;

                    } else {
                        alert("修改失败");
                    }

                },
                error: function () {
                    //请求出错处理
                }
            });
        })
    </script>

@stop
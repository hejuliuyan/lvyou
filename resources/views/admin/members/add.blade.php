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
            margin:20px 20%;

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

        }

        .btn-tr{
            height:80px;
        }
        }

        .licence_pic > div > p {
            text-align: center;
        }
        .notice{
            color:red;
        }

    </style>
@stop
@section('title1')
    会员管理
@stop
@section('title2')
    新增会员
@stop
@section('content')

    <div class="result-content" >
        <table  class="table-content">
            <tr>
                <th class="th-content">账户名</th>
                <td class="td-content"><input type="text" name="account"  style="width:98.6%; height:100%;"></td>
                <td class="notice"></td>
            </tr>
            <tr>
                <th class="th-content">真实姓名</th>
                <td class="td-content"><input type="text" name="real_name"  style="width:98.6%; height:100%;"></td>
                <td class="notice" id="real_name_notice"></td>
            </tr>

            <tr>
                <th class="th-content">会员卡号</th>
                <td class="td-content"><input type="text" name="member_card"  style="width:98.6%; height:100%;"></td>
                <td ></td>
            </tr>

            <tr>
                <th class="th-content">身份证号</th>
                <td class="td-content"><input type="text" maxlength="18" name="id_card" id="id_card"  style="width:98.6%; height:100%;"></td>
                <td class="notice" id="id_card_notice"></td>
            </tr>
            <tr>
                <th class="th-content">性别</th>
                <td class="td-content">&nbsp;&nbsp;
                    <label><input type="radio" name="sex" value="1" >男</label>&nbsp;&nbsp;
                    <label><input type="radio" name="sex" value="2" >女</label>&nbsp;&nbsp;
                    <label><input type="radio" name="sex"  value="0">保密</label>
                </td>
                <td></td>
            </tr>
            <tr>
                <th class="th-content">角色</th>
                <td class="td-content">
                    &nbsp;&nbsp;
                    <label><input type="radio" name="role"  value="1">组员</label>&nbsp;&nbsp;
                    <label><input type="radio" name="role"  value="0"  >组长</label>
                </td>
                <td></td>
            </tr>
            <tr>
                <th class="th-content">手机号</th>
                <td class="td-content"><input type="text"maxlength="11" name="mobile" onkeyup="value=this.value.replace(/\D+/g,'')" style="width:98.6%; height:100%;"></td>
                <td class="notice" id="mobile_notice"></td>
            </tr>

            <tr>
                <th class="th-content">所在地</th>
                <td class="td-content"><input type="text" name="address"  style="width:98.6%; height:100%;"></td>
                <td class="notice"></td>
            </tr>
            <tr>
                <th class="th-content">组长手机号</th>
                <td class="td-content"><input type="text" name="leader_phone" maxlength="11" onkeyup="value=this.value.replace(/\D+/g,'')" style="width:98.6%; height:100%;"></td>
                <td class="notice" id="leader_notice"></td>
            </tr>

            <tr>
                <th class="th-content">积分</th>
                <td class="td-content"><input type="text" name="integral"  style="width:98.6%; height:100%;"></td>
                <td class="notice"></td>
            </tr>

            <tr>
                <th class="th-content">充值次数</th>
                <td class="td-content"><input type="text" name="recharge_num"  style="width:98.6%; height:100%;"></td>
                <td></td>
            </tr>

            <tr>
                <th  class="th-content">余额次数</th>
                <td class="td-content"><input type="text" name="balance_num"  style="width:98.6%; height:100%;"></td>
                <td></td>
            </tr>
            <tr>
                <th class="th-content">已玩景点1</th>
                <td class="td-content"><input type="text" name="scenic01"  style="width:98.6%; height:100%;"></td>
                <td></td>
            </tr>
            <tr>
                <th class="th-content">已玩景点2</th>
                <td class="td-content"><input type="text" name="scenic02"  style="width:98.6%; height:100%;"></td>
                <td></td>
            </tr>
            <tr>
                <th class="th-content">已玩景点3</th>
                <td class="td-content"><input type="text" name="scenic03"  style="width:98.6%; height:100%;"></td>
                <td></td>
            </tr>
            {{--<tr>--}}
                {{--<th class="th-content">维护人</th>--}}
                {{--<td class="td-content"><select name="maintainer" id="maintainer" style="width:100%; height:100%;">--}}
                        {{--<option value="" >请选择...</option>--}}
                        {{--@foreach ($data as $val)--}}
                            {{--@if($val->id != 1)--}}
                                {{--<option value="{{$val->id}}">{{$val->id}}</option>--}}
                            {{--@endif--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                {{--</td>--}}
                {{--<td></td>--}}
            {{--</tr>--}}
            <tr>
                <th class="th-content">是否禁用</th>
                <td class="td-content">
                    &nbsp;&nbsp;
                    <label><input type="radio" name="active"  value="0">启用</label>&nbsp;&nbsp;
                    <label><input type="radio" name="active"  value="1">禁用</label>
                </td>
            </tr>
            <tr>
                <th class="th-content">备注</th>
                <td class="td-content" ><input type="text" name="remark" style="width:98.6%; height:100%;"></td>
                <td></td>
            </tr>

            <tr class="btn-tr">
                <th ><input type="button"class="add_view_btn btn btn-primary btn6 mr10 ws_fb btn-info " value="提交"  id="submit"></th>
                <td ><input class="btn btn6" onclick="history.go(-1)" value="返回" type="button"></td>
            </tr>
        </table>
        </form>
    </div>

@stop
@section('js')
    <script>

        //身份证验证函数
        function card(obj){
            reg=/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X|x)$/;
            if(!reg.test(obj)){
                $('#id_card_notice').html('*身份证号格式不正确');
                return false;
            }else{
                $('#id_card_notice').html("");
                return true;
            }
        }
        //组长手机号函数
        function leader_mobile_check(obj){
            var phone_vali=/^1[3|4|5|7|8][0-9]{9}$/;
            if(!phone_vali.test(obj)){
                $('#leader_notice').html('*手机号格式不正确');
                return false;
            }else{
                $('#leader_notice').html("");
                return true;
            }
        }
        //手机号函数
        function mobile_check(obj){
            var phone_vali=/^1[3|4|5|7|8][0-9]{9}$/;
            if(!phone_vali.test(obj)){
                $('#mobile_notice').html('*手机号格式不正确');
                return false;
            }else{
                $('#mobile_notice').html("");
                return true;
            }
        }
        //身份证存在验证
        function card_search(id_card){
            //var id_card = $("input[name=id_card]").val();//alert('a');return;
            $.ajax({
                url:'/index.php/id_card',
                dataType:'json',
                type:'POST',
                data:{
                    id_card:id_card,
                },
                success:function (data) {
                    if (data == false) {
                        $('#id_card_notice').html('*身份证号已存在');
                        return false;
                    }else{
                        $('#id_card_notice').html("");
                        return true;
                    }
                }

            });
        }
        //手机号存在验证
        function mobile_search(mobile){
            //var mobile = $("input[name=mobile]").val();//alert('a');return;
            $.ajax({
                url:'/index.php/ajax_mobile',
                dataType:'json',
                type:'POST',
                data:{
                    mobile:mobile,
                },
                success:function (data) {
                    if (data == false) {
                        $('#mobile_notice').html('*手机号已存在');
                        return false;
                    }else{
                        $('#mobile_notice').html("");
                        return true;
                    }
                }

            });
        }
        //姓名不为空
        function name_check(real_name){
            if(real_name == ''){
                $('#real_name_notice').html('*真实姓名不能为空');
                return false;
            }else{
                $('#real_name_notice').html("");
                return true;
            }
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////

        $('.add_view_btn').on('click',function(){//
            var account = $("input[name=account]").val();
            var real_name = $("input[name=real_name]").val();
            var member_card = $("input[name=member_card]").val();
            var id_card = $("input[name=id_card]").val();
            var sex = $("input[name=sex]").val();
            var role = $("input[name=role]").val();
            var mobile = $("input[name=mobile]").val();
            var address = $("input[name=address]").val();
            var leader_phone = $("input[name=leader_phone]").val();
            var integral = $("input[name=integral]").val();
            var recharge_num = $("input[name=recharge_num]").val();
            var balance_num = $("input[name=balance_num]").val();
            var scenic01 = $("input[name=scenic01]").val();
            var scenic02 = $("input[name=scenic02]").val();
            var scenic03 = $("input[name=scenic03]").val();
            var active = $("input[name=active]").val();
            var remark = $("input[name = remark]").val();
            //var maintainer = $("select[name=maintainer]").val();//alert(maintainer);return;

            //提交前 前台验证：
            //姓名不为空
            if(!name_check(real_name)){
                return false;
            }
            //身份证其他检测：
            if(!card(id_card)){
                return false;
            }
            //身份证存在验证
            if(card_search(id_card)){
                return false;
            }
            //手机号存在验证
            if(mobile_search(mobile)){
                return false;
            }
            //手机号格式验证：
            if(!mobile_check(mobile)){
                return false;
            }

        //后台提交
            $.ajax({
                url:'/index.php/mem_add',
                dataType:'json',
                type:'POST',
                data: {
                    account:account,
                    real_name: real_name,
                    member_card: member_card,
                    id_card: id_card,
                    sex: sex,
                    role: role,
                    mobile: mobile,
                    address: address,
                    leader_phone: leader_phone,
                    integral: integral,
                    recharge_num: recharge_num,
                    balance_num: balance_num,
                    scenic01: scenic01,
                    scenic02: scenic02,
                    scenic03: scenic03,
                    active: active,
                    remark: remark,
                    //maintainer:maintainer,
                },
                success: function (data) {
//                    if (typeof data == "string") {
//                        var data = eval('(' + data + ')');
//                    }
                    console.log(data);
                    if (data == true) {
                        alert("添加成功");
                        window.location.href='/index.php/ad_members';
                    }else if(data == 'null'){
                        alert("组长手机号不存在");return;
                    } else {
                        alert("添加失败");
                    }

                },
                error: function () {
                    //请求出错处理
                }
            })
        });
        /*
         //失去焦点信息验证：
         */
        //身份证验证
        $("input[name=id_card]").on('blur',function(){
            var id_card = $("input[name=id_card]").val();

            //身份证其他检测：
            card(id_card);
            //身份证存在验证
            card_search(id_card);

        });

        //手机号验证
        $("input[name=mobile]").on('blur',function(){
            var mobile = $("input[name=mobile]").val();
            //手机号格式验证：
            mobile_check(mobile);
            //手机号存在验证
            mobile_search(mobile);
        });
        //组长手机号验证
        $("input[name=leader_phone]").on('blur',function(){
            var leader_phone = $("input[name=leader_phone]").val();//alert(leader_phone);
            //手机号格式验证：
            if(leader_phone !=''){
                leader_mobile_check(leader_phone);
            }

        });
        //real_name不能为空
        $("input[name=real_name]").on('blur',function(){
            var real_name = $("input[name=real_name]").val();//alert('a');
            name_check(real_name);
        });
    </script>
@stop
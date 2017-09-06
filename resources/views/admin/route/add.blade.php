@extends('admin.public.base')
@section('style')
    <link rel="stylesheet" href="{{URL::asset('admin/jqdate/css/calendar.css')}}" >
    <link rel="stylesheet" href="{{URL::asset('admin/jqdate/css/calendar.custom.css')}}" >
    {{--<link rel="stylesheet" href="{{URL::asset('admin/jqdate/css/tech.edit.css')}}" >--}}
    <style>
        .result-content {
            width: 80%;
            float: left;
            border:1px solid #E4E4E4;
            overflow: hidden;
        }
        .top-content{
            width:95%;
            float: left;
            margin:15px;
            border:1px solid #E4E4E4;
            /*border:1px solid red;*/
            overflow: hidden;
        }

        .pic{
            width:30%;
            height:300px;
            float: left;
            border:1px solid #E4E4E4;
            margin:10px;
            overflow: hidden;
        }
        .pic_img{
            width:100%;
            height:270px;
            float: left;
            /*border:1px solid #E4E4E4;*/
            margin:0;
        }
        .picfile{
            cursor:pointer;
            width:100%;
            height:10px;
            float: left;
            /*border:1px solid #E4E4E4;*/
            margin:0;
        }
        .table-content{
            float:left;
            width:62%;
            height:300px;
            /*margin:20px 5%;*/
            /*border:1px solid #E4E4E4;*/
            /*border:1px solid red;*/
            margin:10px;
        }

        .tr-content{
            width:100%;
            height:13%;
            border:1px solid #E4E4E4;
        }
        .tr-content-last{
            width:100%;
            height:22%;
            border:1px solid #E4E4E4;
        }
        .td-content-title{
            background-color: #F2F2F2;
            width:15%;
            /*height:20%;*/
            line-height:13%;
            text-align:center;
            border:1px solid #E4E4E4;
        }
        .td-content{
            width:35%;
            /*height:20px;*/
            /*height:20%;*/
            border:1px solid #E4E4E4;
        }
        .input{
            height:100%;
            width: 99%;
            border:0;
        }

        .button{
            padding-left: 32%;
        }
        /*出发城市和日期*/
        .mid-content{
            width:95%;
            height:500px;
            float: left;
            margin-left:15px;
            border:1px solid #E4E4E4;
            overflow: hidden;
        }
        .start_city{
            width:45%;
            /*border:1px solid red;*/
            height: 500px;
            float: left;
            overflow: hidden;
        }
        .select_city{
            margin-left:5px;
            margin-top:5px;
            width:95%;
            /*border:1px solid red;*/
            height: 30px;
            float: left;
            overflow: hidden;
            text-align: center;
            line-height:30px;
        }
        .select_city_title{
            background-color: #F2F2F2;
            width:30%;
            /*border:1px solid red;*/
            height: 30px;
            float: left;
            overflow: hidden;
        }
        .select_city_content{
            width:70%;
            /*border:1px solid red;*/
            border:1px solid #E4E4E4;
            height: 30px;
            float: left;
            overflow: hidden;
        }
        .add_address_border{
            margin-left:5px;
            margin-top:5px;
            width:95%;
            /*border:1px solid red;*/
            height: 30px;
            float: left;
            overflow: hidden;
            text-align: center;
            line-height:30px;
        }
        .add_address_input{
            width:68%;
            /*border:1px solid red;*/
            /*border:1px solid #E4E4E4;*/
            height: 30px;
            float: left;
            overflow: hidden;
        }
        .input_address{
            width:100%;
            height: 99%;
        }
        .add_address_button{
            margin-left: 2%;
            width:30%;
            /*border:1px solid red;*/
            height: 30px;
            float: left;
            overflow: hidden;
        }
        .specific_address{
            margin-left:5px;
            margin-top:10px;
            width:100%;
            /*border:1px solid red;*/
            height: 420px;
            float: left;
            overflow: hidden;
            text-align: center;
            line-height:30px;
            overflow-y:auto;
            overflow-x:auto;
        }
        .input_address_p{
            float:left;
            text-align:left;
            line-height:30px;
            width: 100%;
        }
        
        .start_date{
            width:55%;
            border:1px solid #E4E4E4;
            height: 500px;
            float: left;
            overflow: hidden;
        }

        /*富文本高度*/
        .bot-content{
            width:95%;
            height:375px;
            float: left;
            margin-left:15px;
            border:1px solid #E4E4E4;
            overflow: hidden;
        }
        .bot-content-title{
            width:10%;
            height:30px;
            line-height: 30px;
            text-align:center;
            float: left;
            color:#49afcd;
            cursor:pointer;
            border: 1px solid #49afcd;
            background-color: #ffffff;
        }
        .route-journey{
            background-color: #49afcd;
            color:#FFFFFF;
        }

        .bot-content-ue{
            /*width:90%;*/
            /*height:250px;*/
            float:left;
            /*border:1px solid #E4E4E4;*/
        }
        .ue-select{
            display:none;
        }
        .delete{
            color:red;
            cursor: pointer;
        }

        /*日历弹出框*/
        .ch_top,.event_top{
            background-color: #f2f2f2;
            width: 100%;
            height: 50px;
            border-radius: 6px;
        }

        .ch_font,.event_font{
            width:30%;
            height: 50px;
            float: left;
            color: gray;
            font-size: 14px;
            line-height: 50px;
        }

        .ch_close,.event_close{
            width:20%;
            height: 50px;
            text-align: center;
            line-height: 50px;
            color: gray;
            float: right;
        }
        /*日历弹出框*/
        .event-place{
            width:100%;
            height: 30px;
        }
        .event-place-select{
            width:100%;
            height:100%;
        }

        .event-time{
            overflow: hidden;
        }

        .cluster_span{
            margin-left: 15px;

        }
        .cluster_num{

        }
        .add-new input {
            display:in-line;
            width: 70px;
            height: 22px;
        }
    </style>
@stop
@section('title1')
    门票管理
@stop
@section('title2')
    新增门票
@stop
@section('content')
    <form onsubmit="return check_city_date()" action="/index.php/route_add_post" name="pic_submit" method="post" enctype="multipart/form-data">
    <div class="result-content" >
        <div class="top-content">
            <div class="pic" >
                <div class="pic_img" id="localImag"><img id="preview" src=""></div>
                <div class="picfile"><input type="file" name="pic" id="doc" onchange="javascript:setImagePreview();" /></div>
            </div>
            <table  class="table-content">
                <tr class="tr-content">
                    <td class="td-content-title">产品编号</td>
                    <td class="td-content"><input type="text" class="input" name="code" placeholder="(必填)"></td>
                    <td class="td-content"><input type="text" class="input" name="rated_price"></td>
                </tr>
                <tr class="tr-content">
                    <td class="td-content-title">折扣价</td>
                    <td class="td-content"><input type="text" class="input" name="discount_price"></td>
                    <td class="td-content-title">游玩方式</td>
                    <td class="td-content">
                        <select class="input" name="play_way" id="">
                            <option value="1">品质游</option>
                            <option value="2">跟团游</option>
                        </select>
                    </td>

                </tr>
                <tr class="tr-content">
                    <td class="td-content-title">行程天数</td>
                    <td class="td-content"><input type="text" class="input" placeholder="天数" name="journey_day"></td>
                    <td class="td-content-title">交通方式</td>
                    <td class="td-content">
                        <select class="input" name="traffic" id="">
                            @foreach ($list[1] as $traffic)
                                <option value="{{ $traffic->id }}">{{ $traffic->traffic }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                {{--<tr class="tr-content">--}}
                    {{--<td class="td-content-title">出发城市</td>--}}
                    {{--<td class="td-content">--}}
                        {{--<select class="input" name="start_city" id="">--}}
                            {{--@foreach ($list[3] as $start_city)--}}
                                {{--<option value="{{ $start_city->id }}">{{ $start_city->start_city }}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</td>--}}
                    {{--<td class="td-content-title">出发日期</td>--}}
                    {{--<td class="td-content">--}}
                        {{--<input type="text" class="input datainp" id="dateinfo" placeholder="请选择" name="start_date">--}}
                    {{--</td>--}}
                {{--</tr>--}}
                <tr class="tr-content">
                    <td class="td-content-title">产品类别</td>
                    <td class="td-content">
                        <select class="input" name="product_cate" id="">
                            <option value="1">尾单</option>
                            <option value="2">免费</option>
                            <option value="3">精品</option>
                        </select>
                    </td>
                    <td class="td-content-title">目的地</td>
                    <td class="td-content">
                        <select class="input" name="destination" id="">
                            @foreach ($list[2] as $destination)
                                <option value="{{ $destination->id }}">{{ $destination->destination }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr class="tr-content">
                    <td class="td-content-title">线路类别</td>
                    <td class="td-content">
                        <select class="input" name="route_cate" id="">
                            <option value="1">周边游</option>
                            <option value="2">国内游</option>
                            <option value="3">出境游</option>
                        </select>
                    </td>
                    <td class="td-content-title">线路标签</td>
                    <td class="td-content">
                        <select class="input" name="route_label" id="">
                            @foreach ($list[0] as $label)
                                <option value="{{ $label->id }}">{{ $label->route_label }}</option>
                            @endforeach
                        </select>
                    
                    </td>
                </tr>
                <tr class="tr-content">
                    <td class="td-content-title">70岁可选</td>
                    <td class="td-content">
                        <select class="input" name="seventy_allow" id="">
                            <option value="1">可选</option>
                            <option value="2">不可选</option>
                        </select>
                    </td>
                    <td class="td-content-title">扣卡次数</td>
                    <td class="td-content">
                        <input type="text" class="input" name="require_num" placeholder="不填默认1次" onkeyup="value=this.value.replace(/\D+/g,'')">
                    </td>
                </tr>
                {{--<tr class="tr-content">--}}
                    {{--<td class="td-content-title">成团人数</td>--}}
                    {{--<td class="td-content"><input type="text" class="input" name="cluster_num" placeholder="成团人数"></td>--}}
                    {{--<td class="td-content-title"></td>--}}
                    {{--<td class="td-content"></td>--}}
                {{--</tr>--}}
                <tr class="tr-content-last">
                    <td class="td-content-title">线路名称</td>
                    <td class="td-content"><textarea class="input" maxlength="30" placeholder="不超过30个字符(必填)" name="route_name"></textarea></td>
                    <td class="td-content-title">线路提示</td>
                    <td class="td-content"><textarea class="input" maxlength="25" placeholder="不超过25个字符" name="route_prompt"></textarea></td>
                </tr>
            </table>
        </div>
        {{--出发城市和日期--}}
        <div class="mid-content">
            <div class="start_city">
                <div class="select_city">
                    <div class="select_city_title">出发城市：</div>
                    <div class="select_city_content">
                        <select class="input" name="start_city" id="">
                            <option value="">请选择...</option>
                             @foreach ($list[3] as $start_city)
                            <option value="{{ $start_city->id }}">{{ $start_city->start_city }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="add_address_border">
                    <div class="add_address_input"><input type="text" class="input_address"name="input_address" placeholder="请输入班次序号(必填)"></div>
                    <div class="add_address_button"><input class="btn btn6 btn-info add_place_button" type="button" class="" value="确定"></div>
                </div>
                <div class="specific_address">

                </div>
            </div>
            <div class="start_date">
                <div class='rows c_schedule'>
                    <dt style="width: 100%;height: 30px;line-height: 40px;text-align: center;font-size: 20px;font-weight: 600">出发日期</dt>
                    <dt style='width: 100%;height: auto;margin-top: 0'>
                        <div class="custom-calendar-wrap">
                            <div id="custom-inner" class="custom-inner">
                                <div class="custom-header clearfix">
                                    <nav>
                                        <span id="custom-prev" class="custom-prev"></span>
                                        <span id="custom-next" class="custom-next"></span>
                                    </nav>
                                    <h2 id="custom-month" class="custom-month"></h2>
                                    <h3 id="custom-year" class="custom-year"></h3>
                                </div>
                                <div id="calendar" class="fc-calendar-container"></div>
                            </div>
                        </div>
                        <input type="hidden" name="event-data" value="">
                        <input type="hidden" name="datetime" value="">
                    </dt>
                </div>
            </div>
        </div>
        <div class="bot-content">
            <div>
                <div class="bot-content-title route-journey">线路行程</div>
                <div class="bot-content-title cost-explain" >费用说明</div>
                <div class="bot-content-title schedule-guide">预定指南</div>
            </div>
            <div class="bot-content-ue">
                <!-- 加载编辑器的容器 -->
                <div class="container1"><script  id="container1" name="route_journey" type="text/plain" ></script></div>
                <div class="ue-select container2"> <script id="container2" name="cost_explain" type="text/plain"></script></div>
                <div class="ue-select container3"> <script id="container3" name="schedule_guide" type="text/plain"></script></div>

            </div>
        </div>
        <div class="button">

            <input type="submit"class="btn btn6 btn-info route-add"  value="提交">
            <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button">
        </div>
    </div>
    </form>


    {{--日历弹出框--}}
    <div class="event-main" id="event-container">
        <div class='event_top'>
            <div class='event_font'>新增出发时间</div>
            <div class='event_close'><a href="javascript:void(0)">X</a></div>
        </div>
        <div class="event-inner">
            <div class="add-new">
                <div  class="event-place">
                    <select  class="event-place-select" name="event-place"  maxlength="100">
                        <option value="">请选择出发地址</option>
                    </select>
                </div>
                <div  class="event-time">

                        <select class="hour1">
                        </select>
                        <div class="time-splace2 fl">:</div>
                        <select class="min1">
                        </select>

                    <span class="cluster_span">成团人数：<input type="text" name="cluster_num" class="cluster_num" placeholder="(必填)" onkeyup="value=this.value.replace(/\D+/g,'')">人</span>
                    <button type="button" class="event-submit fr" id="submit-event">保存</button>
                </div>
            </div>
            <div class="events">
                <h3><b>0</b>&nbsp;个事件</h3>
                <div class="events-list">
                    <!-- <div class="event-single">
                        <p>CodeCanyon İstanbul Meeting on Starbucks, Kadıköy</p>
                        <div class="details">
                            <span class="clock fl">21:00</span>
                            <button type="button" class="event-del fr">Del</button>
                        </div>
                    </div>-->
                </div>
            </div>
            <input type="hidden" name="date-click" value="">
        </div>
    </div>
@stop
@section('js')
    {{--<link rel="stylesheet" href="/admin/jqdate/documents/css/reset.css"/>--}}
    {{--<link rel="stylesheet" href="/admin/jqdate/css/BeatPicker.min.css"/>--}}
    {{--<link rel="stylesheet" href="/admin/jqdate/documents/css/demos.css"/>--}}
    {{--<link rel="stylesheet" href="/admin/jqdate/documents/css/prism.css"/>--}}
    {{--<script src="/admin/jqdate/js/BeatPicker.min.js"></script>--}}
    {{--<script src="/admin/jqdate/documents/js/prism.js"></script>--}}
    <script src="{{URL::asset('admin/jqdate/js/modernizr.custom.js')}}" type="text/javascript" ></script>
    <script src="{{URL::asset('admin/jqdate/js/jquery.calendario.js')}}" type="text/javascript"></script>
    <script>
        //日历控件2：



        //下面用于图片上传预览功能
        function setImagePreview(avalue) {
            var docObj=document.getElementById("doc");

            var imgObjPreview=document.getElementById("preview");
            if(docObj.files &&docObj.files[0])
            {
                //火狐下，直接设img属性
                imgObjPreview.style.display = 'block';
                imgObjPreview.style.width = '100%';
                imgObjPreview.style.height = '100%';
                //imgObjPreview.src = docObj.files[0].getAsDataURL();

                //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式
                imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
            }
            else
            {
                //IE下，使用滤镜
                docObj.select();
                var imgSrc = document.selection.createRange().text;
                var localImagId = document.getElementById("localImag");
                //必须设置初始大小
                localImagId.style.width = "100%";
                localImagId.style.height = "100%";
                //图片异常的捕捉，防止用户修改后缀来伪造图片
                try{
                    localImagId.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
                    localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
                }
                catch(e)
                {
                    alert("您上传的图片格式不正确，请重新选择!");
                    return false;
                }
                imgObjPreview.style.display = 'none';
                document.selection.empty();
            }
            return true;
        }

        //城市控件
//        $('.start_city').on('focus',function(){
//            var cityPicker = new IIInsomniaCityPicker({
//                data: cityData,
//                target: '.start_city',
//                valType: 'k-v',
////                hideCityInput: '#city',
////                hideProvinceInput: '#province',
//                callback: function(city_id){
//                    //alert(city_id);
//                    // city_id = city_id;
//                }
//            });
//            cityPicker.init();
//        });
        //
        //日期控件
//        $('.datainp').on('click',function(){
//            jeDate({
//                dateCell:"#dateinfo",
//                format:"YYYY-MM-DD hh:mm:ss",
//                isinitVal:true,
//                isTime:true, //isClear:false,
//                minDate:"2016-11-15 00:00:00",
//                okfun:function(val){
////                    alert(val)
//
//                }
//            });
//        });
        //选中免费则折扣价为0
//        $("select[name=product_cate]").on('change',function(){
//            if($("select[name=product_cate]").val() == 2){
//                $("input[name=discount_price]").val('0');
//                $("input[name=discount_price]").attr('disabled',true);
//            }else{
//                $("input[name=discount_price]").attr('disabled',false);
//            }
//        });
        <!-- 实例化编辑器 -->
        //把bot-content的高度相应增大再实例化编辑器高度****
        var ue1 = UE.getEditor('container1',{
//           initialFrameWidth:1200,//设置编辑器宽度
            initialFrameHeight:260,//设置编辑器高度
            scaleEnabled:true,

        });
        var ue2 = UE.getEditor('container2',{
//           initialFrameWidth:1200,//设置编辑器宽度
            initialFrameHeight:260,//设置编辑器高度
            scaleEnabled:true,

        });
        var ue3 = UE.getEditor('container3',{
//           initialFrameWidth:1200,//设置编辑器宽度
            initialFrameHeight:260,//设置编辑器高度
            scaleEnabled:true,

        });
       $(".route-journey").on("click", function(event) {
           $(".container1").show();
           $(".container2").hide();
           $(".container3").hide();
           $('.route-journey').css('background-color','#49afcd');
           $('.route-journey').css('color','#FFFFFF');
           $('.cost-explain').css('background-color','#FFFFFF');
           $('.cost-explain').css('color','#49afcd');
           $('.schedule-guide').css('background-color','#FFFFFF');
           $('.schedule-guide').css('color','#49afcd');
        });

        $(".cost-explain").on("click", function(event) {
            $(".container2").show();
            $(".container1").hide();
            $(".container3").hide();
            $('.cost-explain').css('background-color','#49afcd');
            $('.cost-explain').css('color','#FFFFFF');
            $('.route-journey').css('background-color','#FFFFFF');
            $('.route-journey').css('color','#49afcd');
            $('.schedule-guide').css('background-color','#FFFFFF');
            $('.schedule-guide').css('color','#49afcd');

        });

        $(".schedule-guide").on("click", function(event) {
            $(".container3").show();
            $(".container2").hide();
            $(".container1").hide();
            $('.schedule-guide').css('background-color','#49afcd');
            $('.schedule-guide').css('color','#FFFFFF');
            $('.cost-explain').css('background-color','#FFFFFF');
            $('.cost-explain').css('color','#49afcd');
            $('.route-journey').css('background-color','#FFFFFF');
            $('.route-journey').css('color','#49afcd');
        });

        //出发城市选择添加具体地址
        $(".add_place_button").on('click',function(){
            var start_city= $("select[name=start_city]").val();
            if(start_city == ''){
                alert('请选择城市');return;
            }
            //var start_city_text= $("select[name=start_city]").find("option:selected").text();
            var input_address=$('input[name=input_address]').val();
            if(input_address==''){
                alert('请输入具体地址');return;
            }
            $(".specific_address").append("<div class='input_address_p'><span class='input_address_val' id="+start_city+">"+input_address+"</span><span class='delete'>&nbsp;X</span></div>");
        });
        $("select[name=start_city]").on('change',function(){
            $(".specific_address").empty();
        })
        //出发城市选择删除具体地址
        $('.specific_address').on('click','.delete',function(){
            $(this).parent().remove();
        });

        //提交表单前出发函数
        function check_city_date(){
            //出发时间
            //console.log(dating);
            var datinglenght = dating.length;
            for(var i=0;i<datinglenght;i++){
                var route_place_time = dating[i]['route_place_time'];
                var route_place_address = dating[i]['route_place_address'];
                var route_place_date = dating[i]['route_place_date']+dating[i]['route_place_time']+':00';
                var city_id = dating[i]['city_id'];
                var cluster_num = dating[i]['cluster_num'];
                var timestamp = dating[i]['timestamp'];

                $('.button').append("<input type='hidden' name='route_place_time[]' value="+route_place_time+">");
                $('.button').append("<input type='hidden' name='route_place_address[]' value="+route_place_address+">");
                $('.button').append("<input type='hidden' name='route_place_date[]' value="+route_place_date+">");
                $('.button').append("<input type='hidden' name='route_place_id[]' value="+city_id+">");
                $('.button').append("<input type='hidden' name='cluster_num[]' value="+cluster_num+">");
                $('.button').append("<input type='hidden' name='timestamp[]' value="+timestamp+">");
            }
            return true;

//            $('.button').append("<input type='hidden' name='route_place_time[]' value="+route_place_time[i].innerText+">");
//            $('.button').append("<input type='hidden' name='route_place_address[]' value="+route_place_address[i].innerText+">");
//            $('.button').append("<input type='hidden' name='route_place_id[]' value="+route_place_address[i].getAttribute('val')+">");
//            $('.button').append("<input type='hidden' name='route_place_date[]' value="+route_place_date[i].innerText+">");
//            $('.button').append("<input type='hidden' name='cluster_num[]' value="+route_cluster_num[i].innerText+">");
//            $('.button').append("<input type='hidden' name='timestamp[]' value="+route_cluster_num[i].innerText+">");
//            var route_place = $('.route_place');
//            var route_palce_length = $('.route_place').length;
//            var route_place_time =  $('.route_place_time');
//            var route_place_address =  $('.route_place_address');
//            var route_place_date =  $('.route_place_date');
//            var route_cluster_num =  $('.cluster_num');
//            var route = route_place[1];
            //console.log(route_place_address);

        }

        /*
        *   日历
        */

        function typeSelect(obj){
            if ($(obj).val() == '0') {
                $('.c_schedule').fadeOut(100);
            }else {
                $('.c_schedule').fadeIn(100);
            }
        }

        function timeFormat(time) {
            return time < 10 ? '0'+time : time;
        }

        function loadTimeOption(start, length, index) {
            var strHtml = '';
            for(var i = start; i < length; i += index) {
                var val = timeFormat(i);
                strHtml += '<option value="'+val+'">'+val+'</option>';
            }
            return strHtml;
        }
        //当前时间
        var nowDate = new Date();
        var nowMonth =timeFormat(nowDate.getMonth()+1);
        var nowDay = timeFormat(nowDate.getDate());
        var nowYear = nowDate.getFullYear();

        //是否显示
        typeSelect($('#teach_type'));

        //事件数据转换
        var eventWillAdd = {},eventWillDel = {};
        var codropsEvents = {};
        var eventData = $('[name="event-data"]').val();
        if(eventData) {
            var eventDataArr = JSON.parse(eventData);
            for(var dates in eventDataArr) {
                var date = dates.split(' ');
                if(codropsEvents[date[0]] == undefined || codropsEvents[date[0]] == null) {
                    codropsEvents[date[0]] = '<span><label>'+date[1]+'</label><label>'+eventDataArr[dates]+'</label></span>';
                }else {
                    codropsEvents[date[0]] += '<span><label>'+date[1]+'</label><label>'+eventDataArr[dates]+'</label></span>';
                }
            }
        }

        //日历初始化
        var dating = [];
        var cal = $( '#calendar' ).calendario( {
            onDayClick : function( $el, $contentEl, dateProperties ) {
                //检测点击时间
                var city_place = $('.input_address_val');
                console.log(city_place);
                var palce_length = $('.input_address_val').length;
                $(".event-place-select").empty();
                $(".event-place-select").append("<option value=''>请选择出发地址</option>");
                for(var i=0;i<palce_length;i++){
                    $(".event-place-select").append("<option value="+city_place[i].id+">"+city_place[i].innerText+"</option>");
                }


                var month = timeFormat(dateProperties["month"]);
                var day = timeFormat(dateProperties["day"]);
                var year = dateProperties["year"];
                var date = month +"-"+ day +"-"+ year;
                var datetime = year+"-"+month +"-"+ day;
                $('input[name=datetime]').val(datetime);
                if( year +"-"+ month +"-"+ day < nowYear +"-"+ nowMonth +"-"+ nowDay) {
                    return;
                }

                //获取事件数据
                var html='',i = 0;
                var eventDiv = $contentEl.get(0);
                $('.events h3 b').html(0);
                $('.events-list').html('');
                if(eventDiv) {
                    var length = eventDiv.children.length;
                    for (i = 0; i < length; i++) {
                        var eventChild = eventDiv.children[i].getElementsByTagName("label");
                        var timestamp = eventDiv.children[i].getAttribute('id');
                        var city_id = eventDiv.children[i].getAttribute('city_id');
                        var month_day = eventDiv.children[i].getAttribute('month_day');
                        html += "<div class='event-single' id="+timestamp+" city_id="+city_id+" month_day="+month_day+">"+
                                '<p class="class_nums">'+eventChild[1].innerText+'</p>'+
                                '<div class="details">'+
                                '<span class="clock fl">'+eventChild[0].innerText+'</span>'+
                                '<span class="cluster_span">成团人数： </span>'+
                                '<span class="cluster_number">'+eventChild[3].innerText+'</span>'+
                                '<span>人</span>'+
                                '<button type="button" class="event-del fr">删除</button>'+
                                '</div>'+
                                '</div>';
                    }
                    $('.events h3 b').html(i);
                    $('.events-list').html(html);
                }
                $('[name="date-click"]').val(date);

                //删除事件
                $('.event-del').on('click', function(){
                    var clock = $(this).siblings('span').text();
                    $(this).parents(".event-single").remove();
                    //将临时数据从数组中删除
                    var id = $(this).parent().parent().attr('id');
                    var datelength = dating.length;
                    for(var i=0;i<datelength;i++){
                        if(dating[i].timestamp == id) {
                            dating.splice(i, 1);
                            break;
                        }
                    }
                    //重新填充日历的事件
                    var strHtml = '';
                    var month_day = $('input[name=datetime]').val();
                    var length = $('.events-list').children().length;
                    for(var i = 0; i < length; i++) {
                        var eventSingleD = $('.events-list').children().get(i).getAttribute('id');
                        var city_id = $('.events-list').children().get(i).getAttribute('city_id');
                        var month_day = $('.events-list').children().get(i).getAttribute('month_day');

                        var eventSingleP = $('.events-list').children().get(i).getElementsByTagName("p");
                        var eventSingleC = $('.events-list').children().get(i).getElementsByClassName("clock");
                        var cluster_num = $('.events-list').children().get(i).getElementsByClassName("cluster_number");
                        strHtml += "<span class='route_place' id="+eventSingleD+"  city_id="+city_id+" month_day="+month_day+"><label class='route_place_time'>"+eventSingleC[0].innerText+"</label><label class='route_place_address' val="+city_id+">"+eventSingleP[0].innerText+"</label><label class='route_place_date'>"+month_day+eventSingleC[0].innerText+":00</label><label class='cluster_num'>"+cluster_num[0].innerText+"</label></span>";
                    }
                    $('.fc-event-'+dateProperties["day"]).html(strHtml);

                    $('.events h3 b').html(length);

                    //保存数据
                    if( eventWillAdd[date+" "+clock] == undefined || eventWillAdd[date+" "+clock] == null ) {
                        eventWillDel[date+" "+clock] = '1';
                    }else {
                        delete eventWillAdd[date+" "+clock];
                    }
                });

                //显示新增事件
                $.blockUI({
                    message: $('#event-container'),
                    css:{
                        border: 'none',
                        width:"500px",
                        height:"400px",
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

            },
            caldata : codropsEvents,
            displayWeekAbbr : true
        } ),
        $month = $( '#custom-month' ).html( cal.getMonthName() ),
        $year = $( '#custom-year' ).html( cal.getYear() );

        $( '#custom-next' ).on( 'click', function() {
            cal.gotoNextMonth( updateMonthYear );
            padding_local_data(dating,$year[0].innerHTML,$month[0].innerHTML);
        } );
        $( '#custom-prev' ).on( 'click', function() {
            cal.gotoPreviousMonth( updateMonthYear );
            padding_local_data(dating,$year[0].innerHTML,$month[0].innerHTML);
        } );
        $( '#custom-current' ).on( 'click', function() {
            cal.gotoNow( updateMonthYear );
//            padding_data($year[0].innerHTML,$month[0].innerHTML);
        } );
        function updateMonthYear() {
            $month.html( cal.getMonthName() );
            $year.html( cal.getYear() );
        }




        function padding_local_data(date,year,month){
            var months = [ 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ];
            if(month == months[0]){
                month = '01';
            }else if(month == months[1]){
                month = '02';
            }else if(month == months[2]){
                month = '03';
            }else if(month == months[3]){
                month = '04';
            }else if(month == months[4]){
                month = '05';
            }else if(month == months[5]){
                month = '06';
            }else if(month == months[6]){
                month = '07';
            }else if(month == months[7]){
                month = '08';
            }else if(month == months[8]){
                month = '09';
            }else if(month == months[9]){
                month = '10';
            }else if(month == months[10]){
                month = '11';
            }else if(month == months[11]){
                month = '12';
            }
            console.log(date);
            var eventDataArr = date;
            var year_month = year+'-'+month;
            var eventDataArrlenght = eventDataArr.length;
            for(var i=0;i<eventDataArrlenght;i++){
                var year_month_day = eventDataArr[i]['route_place_date'].substr(0,7);
                console.log(year_month);console.log(year_month_day);
                if(year_month_day == year_month){
                    //年月相等
                    var dayClick = eventDataArr[i]['route_place_date'].substr(8,2);
                    var dayClick = parseInt(dayClick,10);
                    console.log(dayClick);
                    var eventTip ="<span class='route_place' id="+eventDataArr[i]['timestamp']+" city_id="+eventDataArr[i].city_id+" month_day="+eventDataArr[i].route_place_date+"><label class='route_place_time'>"+eventDataArr[i].route_place_time+"</label><label class='route_place_address' val="+eventDataArr[i].city_id+">"+eventDataArr[i].route_place_address+"</label><label class='route_place_date'>"+eventDataArr[i].route_place_date+"</label><label class='cluster_num'>"+eventDataArr[i].cluster_num+"</label></span>";

                    if( $('.fc-event-'+dayClick).length > 0) {
                        $('.fc-event-'+dayClick).prepend(eventTip);
                    }else {
                        cal.getCell(dayClick).prevObject[0].className = 'fc-content';
                        cal.getCell(dayClick).prevObject[0].innerHTML += '<div class="fc-event-'+dayClick+'">'+eventTip+'</div>';
                    }
                }

            }
        }



        //加载时间选项
        $('.hour1').append(loadTimeOption(0, 24, 1));
        $('.min1').append(loadTimeOption(0, 60, 5));

        //创建新事件
        $('#submit-event').on('click', function(e){
            //保存按钮
            var text= $("select[name=event-place]").find("option:selected").text();
            //如果存在相同出发班次序号的则提示错误：
            var strHtml = '';
            var length = $('.events-list').children().length;
            for(var i = 0; i < length; i++) {
                var eventSingleP = $('.events-list').children().get(i).getElementsByTagName("p");
                if(eventSingleP[0].innerText == text){
                    alert('班次序号不能重复');
                    return;
                }
            }

            var val= $("select[name=event-place]").val();
            //console.log(val);
            var cluster_num = $("input[name=cluster_num]").val();
            if(val == "" || val == null || val == undefined) {
                alert('请选择出发地址');
                return;
            }
            if(cluster_num == "" || cluster_num == null || cluster_num == undefined) {
                alert('成团人数不能为空');
                return;
            }
            var enumber = $('.events-list').children().length + 1;
//            if(enumber > 10) {
//                alert('最多10个出发时间');
//                return;
//            }

            var time1 = $('.hour1').val() + ':' +  $('.min1').val();
//            var clock = time1 + '-' + time2;
//            if(time1 >=  time2) {
//                alert('时间段有误');
//                return;
//            }
            //事件简介
            var dateClick = $('[name="date-click"]').val();
            var dayClick = parseInt(dateClick.split("-")[1], 10);
            var month_day = $('input[name=datetime]').val();
            //将数据保存到数组
            var date_place = [];
            var timestamp = new Date().getTime();//console.log(timestamp);

            date_place['route_place_time'] = time1;
            date_place['route_place_address'] = text;
            date_place['route_place_date'] = month_day;
            date_place['cluster_num'] = cluster_num;
            date_place['timestamp'] = timestamp;
            date_place['city_id'] = val;
            dating.push(date_place);
            //date[timestamp] = date_place;
            //console.log(dating);
            //追加元素
            var event = "<div class='event-single' id="+timestamp+" city_id="+val+" month_day="+month_day+">"+
                    '<p class="class_nums">'+text+'</p>'+
                    '<div class="details">'+
                    '<span class="clock fl">'+time1+'</span>'+
                    '<span class="cluster_span">成团人数： </span>'+
                    '<span class="cluster_number">'+cluster_num+'</span>'+
                    '<span>人</span>'+
                    '<button type="button" class="event-del fr">删除</button>'+
                    '</div>'+
                    '</div>';
            $('.events-list').prepend(event);


            var eventTip = "<span class='route_place' id="+timestamp+" city_id="+val+" month_day="+month_day+"><label class='route_place_time'>"+time1+"</label><label class='route_place_address' val="+val+">"+text+"</label><label class='route_place_date'>"+month_day+time1+":00</label><label class='cluster_num'>"+cluster_num+"</label></span>";
            if( $('.fc-event-'+dayClick).length > 0) {
                $('.fc-event-'+dayClick).prepend(eventTip);
            }else {
                cal.getCell(dayClick).prevObject[0].className = 'fc-content';
                cal.getCell(dayClick).prevObject[0].innerHTML += '<div class="fc-event-'+dayClick+'">'+eventTip+'</div>';
            }

            //事件个数
            $('.events h3 b').html(enumber);

            //保存数据
            eventWillAdd[dateClick+" "+time1] = text;

            //删除事件
            $('.event-del').on('click', function(){
                $(this).parent().parent().remove();
                //将临时数据从数组中删除
                var id = $(this).parent().parent().attr('id');
                var datelength = dating.length;
                for(var i=0;i<datelength;i++){
                    if(dating[i].timestamp == id) {
                        dating.splice(i, 1);
                        break;
                    }
                }
                //重新填充日历的事件
                var strHtml = '';
                var length = $('.events-list').children().length;
                for(var i = 0; i < length; i++) {
                    var eventSingleD = $('.events-list').children().get(i).getAttribute('id');
                    var city_id = $('.events-list').children().get(i).getAttribute('city_id');
                    var month_day = $('.events-list').children().get(i).getAttribute('month_day');

                    var eventSingleP = $('.events-list').children().get(i).getElementsByTagName("p");
                    var eventSingleC = $('.events-list').children().get(i).getElementsByClassName("clock");
                    var month_day = $('input[name=datetime]').val();
                    var cluster_num = $('.events-list').children().get(i).getElementsByClassName("cluster_number");
                    strHtml += "<span class='route_place' id="+eventSingleD+"  city_id="+city_id+" month_day="+month_day+"><label class='route_place_time'>"+eventSingleC[0].innerText+"</label><label class='route_place_address' val="+city_id+">"+eventSingleP[0].innerText+"</label><label class='route_place_date'>"+month_day+eventSingleC[0].innerText+":00</label><label class='cluster_num'>"+cluster_num[0].innerText+"</label></span>";
                }
                $('.fc-event-'+dayClick).html(strHtml);

                $('.events h3 b').html(length);

                //保存数据
                delete eventWillAdd[dateClick+" "+time1];

            });

        });












//        $('.bot-content div').click(function(){
//           // $(this).addClass("selected").siblings().removeClass();//removeClass就是删除当前其他类；只有当前对象有addClass("selected")；siblings()意思就是当前对象的同级元素，removeClass就是删除；
//            $(".bot-content-ue div").hide();
//            $(".bot-content-ue div").eq($('.bot-content div').index(this)).show();
//            //alert($('.bot-content div').index(this));
//        });
        //提交
//        $('.route-add').on('click',function(){
//            var code = $("input[name=code]").val();
//            var rated_price = $("input[name=rated_price]").val();
//            var discount_price = $("input[name=discount_price]").val();
//            var start_city = $("input[name=start_city]").val();
//            var journey_day = $("input[name=journey_day]").val();
//            var traffic = $("select[name=traffic]").val();


    </script>
@stop
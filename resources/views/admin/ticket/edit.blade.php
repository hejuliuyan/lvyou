@extends('admin.public.base')
@section('style')
    <link rel="stylesheet" href="{{URL::asset('admin/jqdate/css/calendar.css')}}" >
    <link rel="stylesheet" href="{{URL::asset('admin/jqdate/css/calendar.custom.css')}}" >
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
        #preview{
            width:100%;
            height:270px;
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
            border:1px solid #E4E4E4;
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
            text-align: center;
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
            width:100%;
            /*height:500px;*/
            /*float:left;*/
            overflow: hidden;

            /*border:1px solid red;*/
        }
        .container1{
            width: 100%;
            /*height:250px;*/
            /*float:left;*/
            overflow: hidden;
            /*border:1px solid blue;*/
        }
        .ue-select{
            display:none;
        }
        .delete{
            color:red;
            cursor: pointer;
        }
        /*日历弹出框*/
        .fc-content{
            cursor:pointer;
        }
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
    编辑门票
@stop
@section('content')
    <form action="/ticket_edit_post" name="pic_submit" method="post" enctype="multipart/form-data" onsubmit="return check_city_date();">
        <input type="hidden" name="id" value="{{$list[0]->ticket_id}}">
        <div class="result-content" >
            <div class="top-content">
                <div class="pic" >
                    <div class="pic_img" id="localImag"><img id="preview" src="/Uploads/pic/{{$list[0]->ticket_picture}}"></div>
                    <div class="picfile"><input type="file" name="pic" id="doc" onchange="javascript:setImagePreview();" /></div>
                </div>
                <table  class="table-content">
                    <tr class="tr-content">
                        <td class="td-content-title">产品编号</td>
                        <td class="td-content"><input type="text" class="input" name="num" placeholder="(必填)" value="{{$list[0]->num}}"></td>
                    </tr>
                    <tr class="tr-content">
                        <td class="td-content-title">线路标签</td>
                        <td class="td-content">
                            <select class="input" name="label" id="">
                                    <option    @if('热销'==$list[0]->label) selected="selected" @endif value="热销">热销</option>
                                <option    @if('最新'==$list[0]->label) selected="selected" @endif value="最新">最新</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="tr-content">
                        <td class="td-content-title">主题标签</td>
                        <td class="td-content">
                            <select class="input" name="route_label" id="">
                                @foreach ($info as $val1)
                                    <option   @if($val1->id==$list[0]->route_label) selected="selected" @endif value="{{ $val1->route_label }}">{{ $val1->route_label }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="tr-content-last">
                        <td class="td-content-title">景点名称</td>
                        <td class="td-content"><textarea class="input" maxlength="50" placeholder="不超过50个字符(必填)" name="name">{{$list[0]->name}}</textarea></td>
                    </tr>
                    <tr class="tr-content-last">
                        <td class="td-content-title">景点地址</td>
                        <td class="td-content"><textarea class="input" maxlength="50" placeholder="不超过50个字符(必填)" name="address" >{{$list[0]->address}}</textarea></td>
                    </tr>
                    <tr class="tr-content-last">
                        <td class="td-content-title">产品提示</td>
                        <td class="td-content"><textarea class="input" maxlength="25" placeholder="不超过25个字符" name="warn" >{{$list[0]->warn}}</textarea></td>
                    </tr>

                </table>
            </div>
            <div class="bot-content">
                <div>
                    <div class="bot-content-title route-journey">门票详情</div>
                    <div class="bot-content-title cost-explain" >预订须知</div>
                </div>
                <div class="bot-content-ue">
                    <!-- 加载编辑器的容器 -->
                    <input type="hidden" name="route_journey" value="{{ $list[0]->detail }}">
                    <input type="hidden" name="cost_explain" value="{{ $list[0]->prompt }}">
                    {{--<input type="hidden" name="schedule_guide" value="{{ $list[0]->num }}">--}}
                    <div class="container1"><script  id="container1" name="route_journey" type="text/plain"></script></div>
                    <div class="ue-select container2"> <script id="container2" name="cost_explain" type="text/plain" ></script></div>
                    <div class="ue-select container3"> <script id="container3" name="schedule_guide" type="text/plain" ></script></div>
                </div>
            </div>
            <div class="button">
                <input type="submit"class="btn btn6 btn-info"  value="提交">
                <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button">
            </div>
        </div>
    </form>
@stop
@section('js')
    <script src="{{URL::asset('admin/jqdate/js/modernizr.custom.js')}}" type="text/javascript" ></script>
    <script src="{{URL::asset('admin/jqdate/js/jquery.calendario.js')}}" type="text/javascript"></script>
    <script>
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



        <!-- 实例化编辑器 -->
        var ue1 = UE.getEditor('container1',{
//           initialFrameWidth:1200,//设置编辑器宽度
            initialFrameHeight:260,//设置编辑器高度
//                this.setDisabled('cleardoc');
                scaleEnabled:true,
        });
        ue1.addListener("ready", function () {
            // editor准备好之后才可以使用
            var route_journey = $("input[name=route_journey]").val();
            ue1.setContent(route_journey);
        });

        var ue2 = UE.getEditor('container2',{
            initialFrameHeight:260,//设置编辑器高度
            scaleEnabled:true,
        });
        ue2.addListener("ready", function () {
            // editor准备好之后才可以使用
            var cost_explain = $("input[name=cost_explain]").val();
            ue2.setContent(cost_explain);
        });
        var ue3 = UE.getEditor('container3',{
            initialFrameHeight:260,//设置编辑器高度
            scaleEnabled:true,
        });
        ue3.addListener("ready", function () {
            // editor准备好之后才可以使用
            var schedule_guide = $("input[name=schedule_guide]").val();
            ue3.setContent(schedule_guide);
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
//            var start_city= $("select[name=start_city]").val();
//            if(start_city == ''){
//                alert('请选择城市');return;
//            }
            //var start_city_text= $("select[name=start_city]").find("option:selected").text();
            var start_city = $('.select_city_content').attr('id');
            var input_address=$('input[name=input_address]').val();
            if(input_address==''){
                alert('请输入具体地址');return;
            }
            $(".specific_address").append("<div class='input_address_p'><span class='input_address_val' id="+start_city+">"+input_address+"</span><span class='delete'>&nbsp;X</span></div>");
        });

        //出发城市选择删除具体地址
        $('.specific_address').on('click','.delete',function(){
            $(this).parent().remove();
        });

        //提交表单前出发函数
        function check_city_date(){
            //出发时间
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



        //原始数据填充

        var dating = [];
        //日历初始化
        var cal = $( '#calendar' ).calendario( {
                    onDayClick : function( $el, $contentEl, dateProperties ) {
                        //检测点击时间
                        var city_place = $('.input_address_val');
                        //console.log(city_place);
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
                                var space_id = eventDiv.children[i].getAttribute('space_id');
                                var city_id = eventDiv.children[i].getAttribute('city_id');
                                var month_day = eventDiv.children[i].getAttribute('month_day');
                                html += "<div class='event-single' id="+timestamp+" space_id="+space_id+" city_id="+city_id+" month_day="+month_day+">"+
                                        '<p>'+eventChild[1].innerText+'</p>'+
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
                            var space_id = $(this).parent().parent().attr('space_id');
                            if(space_id == '' || space_id == undefined || space_id == null){
                                var datelength = dating.length;
                                for(var i=0;i<datelength;i++){
                                    if(dating[i].timestamp == id) {
                                        dating.splice(i, 1);
                                        break;
                                    }
                                }
                            }else{
                                console.log(space_id);
                                var id = $("input[name=id]").val();
                                $.ajax({
                                    url: '/index.php/padding_date_delete',
                                    data: {id: id, space_id: space_id},
                                    dataType: 'json',
                                    type: 'POST',
                                    success: function (data) {
                                        console.log(data);
                                        if(data == 'member'){
                                            alert('已有人订购，不可删除');
                                            return false;
                                        }
                                        console.log(data);
                                        //重新填充日历的事件
                                        var strHtml = '';
                                        var month_day = $('input[name=datetime]').val();
                                        var length = $('.events-list').children().length;
                                        for(var i = 0; i < length; i++) {
                                            var eventSingleD = $('.events-list').children().get(i).getAttribute('id');
                                            var city_id = $('.events-list').children().get(i).getAttribute('city_id');
                                            var month_day = $('.events-list').children().get(i).getAttribute('month_day');
                                            var space_id = $('.events-list').children().get(i).getAttribute('space_id');
                                            var eventSingleP = $('.events-list').children().get(i).getElementsByTagName("p");
                                            var eventSingleC = $('.events-list').children().get(i).getElementsByClassName("clock");
                                            var cluster_num = $('.events-list').children().get(i).getElementsByClassName("cluster_number");
                                            strHtml += "<span class='route_place' id="+eventSingleD+" space_id="+space_id+" city_id="+city_id+" month_day="+month_day+"><label class='route_place_time'>"+eventSingleC[0].innerText+"</label><label class='route_place_address' val="+city_id+">"+eventSingleP[0].innerText+"</label><label class='route_place_date'>"+month_day+eventSingleC[0].innerText+":00</label><label class='cluster_num'>"+cluster_num[0].innerText+"</label></span>";
                                        }
                                        $('.fc-event-'+dateProperties["day"]).html(strHtml);

                                        $('.events h3 b').html(length);
                                    }
                                });
                            }

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
            //console.log($month[0].innerHTML);
            //console.log($year[0].innerHTML);
            padding_data($year[0].innerHTML,$month[0].innerHTML);
            padding_local_data(dating,$year[0].innerHTML,$month[0].innerHTML);
        } );
        $( '#custom-prev' ).on( 'click', function() {
            cal.gotoPreviousMonth( updateMonthYear );
            padding_data($year[0].innerHTML,$month[0].innerHTML);
            padding_local_data(dating,$year[0].innerHTML,$month[0].innerHTML);
        } );
        $( '#custom-current' ).on( 'click', function() {
            cal.gotoNow( updateMonthYear );
            //padding_data($year[0].innerHTML,$month[0].innerHTML);
        } );
        function updateMonthYear() {
            $month.html( cal.getMonthName() );
            $year.html( cal.getYear() );

        }

        //页面加载时填充数据
        //事件数据转换
        var eventWillAdd = {},eventWillDel = {};
        var codropsEvents = {};
        $(function(){
            var eventData = $('[name="event-data"]').val();
            if(eventData) {
                var eventDataArr = JSON.parse(eventData);
                console.log(eventDataArr);
                var eventDataArrlenght = eventDataArr.length;
                for(var i=0;i<eventDataArrlenght;i++){
                    var dateClick = eventDataArr[i].new_date_day;//12-07-2016
                    var dayClick = parseInt(dateClick.split("-")[1], 10);
                    var year_month_day = eventDataArr[i]['new_date'].substr(0,10);
                    //console.log(dayClick);
                    var eventTip ="<span class='route_place' space_id="+eventDataArr[i]['id']+" id="+eventDataArr[i]['timestamp']+" city_id="+eventDataArr[i].start_city_id+" month_day="+year_month_day+"><label class='route_place_time'>"+eventDataArr[i].start_city_place_time+"</label><label class='route_place_address' val="+eventDataArr[i].start_city_id+">"+eventDataArr[i].start_city_place+"</label><label class='route_place_date'>"+eventDataArr[i].new_date+"</label><label class='cluster_num'>"+eventDataArr[i].cluster_num+"</label></span>";

                    if( $('.fc-event-'+dayClick).length > 0) {
                        $('.fc-event-'+dayClick).prepend(eventTip);
                    }else {
                        cal.getCell(dayClick).prevObject[0].className = 'fc-content';
                        cal.getCell(dayClick).prevObject[0].innerHTML += '<div class="fc-event-'+dayClick+'">'+eventTip+'</div>';
                    }
//
                }
            }
        });
//        function count(o){
//            var t = typeof o;
//            if(t == 'string'){
//                return o.length;
//            }else if(t == 'object'){
//                var n = 0;
//                for(var i in o){
//                    n++;
//                }
//                return n;
//            }
//            return false;
//        };
        function padding_data(year,month){
            var id = $("input[name=id]").val();
            $.ajax({
                url:'/index.php/padding_date',
                data:{year:year,month:month,id:id},
                dataType:'json',
                type:'POST',
                success:function(data){
                    var eventDataArr = data;
                    console.log(data);
//                    var eventDataArrlenght = count(data);
                    var eventDataArrlenght = eventDataArr.length;
                    console.log(eventDataArrlenght);
                    for(var i=0;i<eventDataArrlenght;i++){
                        var dateClick = eventDataArr[i]['new_date_day'];//12-07-2016
                        console.log(dateClick);
                        var dayClick = parseInt(dateClick.split("-")[1], 10);
                        var year_month_day = eventDataArr[i]['new_date'].substr(0,10);
                        //console.log(dayClick);
                        var eventTip ="<span class='route_place' space_id="+eventDataArr[i]['id']+" id="+eventDataArr[i]['timestamp']+" city_id="+eventDataArr[i].start_city_id+" month_day="+year_month_day+"><label class='route_place_time'>"+eventDataArr[i].start_city_place_time+"</label><label class='route_place_address' val="+eventDataArr[i].start_city_id+">"+eventDataArr[i].start_city_place+"</label><label class='route_place_date'>"+eventDataArr[i].new_date+"</label><label class='cluster_num'>"+eventDataArr[i].cluster_num+"</label></span>";

                        if( $('.fc-event-'+dayClick).length > 0) {
                            $('.fc-event-'+dayClick).prepend(eventTip);
                        }else {
                            cal.getCell(dayClick).prevObject[0].className = 'fc-content';
                            cal.getCell(dayClick).prevObject[0].innerHTML += '<div class="fc-event-'+dayClick+'">'+eventTip+'</div>';
                        }
//
                    }
                }
            })
        }

        function padding_local_data(dating,year,month){
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
            //console.log(dating);
            var eventDataArr = dating;
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
            //保存

            var text= $("select[name=event-place]").find("option:selected").text();
            //如果存在相同出发班次序号的则提示错误：
            var length = $('.events-list').children().length;
            for(var i = 0; i < length; i++) {
                var eventSingleP = $('.events-list').children().get(i).getElementsByTagName("p");
                if(eventSingleP[0].innerText == text){
                    alert('班次序号不能重复');
                    return;
                }
            }

            var val_address= $("select[name=event-place]").val();
            var val = $('.select_city_content').attr('id');

            var cluster_num = $("input[name=cluster_num]").val();
            if(val_address == "" || val_address == null || val_address == undefined) {
                alert('请选择具体地址');
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
            //console.log(dayClick);
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
            console.log(dating);
            //追加元素
            var event = "<div class='event-single' id="+timestamp+" city_id="+val+" month_day="+month_day+">"+
                    '<p>'+text+'</p>'+
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
                var space_id = $(this).parent().parent().attr('space_id');
                if(space_id == '' || space_id == undefined || space_id == null){
                    var datelength = dating.length;
                    for(var i=0;i<datelength;i++){
                        if(dating[i].timestamp == id) {
                            dating.splice(i, 1);
                            break;
                        }
                    }
                }else{
                    console.log(space_id);
                    var id = $("input[name=id]").val();
                    $.ajax({
                        url: '/index.php/padding_date_delete',
                        data: {id: id, space_id: space_id},
                        dataType: 'json',
                        type: 'POST',
                        success: function (data) {
                            console.log(data);
                            if(data == 'member'){
                                alert('已有人订购，不可删除');
                                return false;
                            }

                            //重新填充日历的事件
                            var strHtml = '';
                            var length = $('.events-list').children().length;
                            for(var i = 0; i < length; i++) {
                                var eventSingleD = $('.events-list').children().get(i).getAttribute('id');
                                var city_id = $('.events-list').children().get(i).getAttribute('city_id');
                                var month_day = $('.events-list').children().get(i).getAttribute('month_day');
                                var space_id = $('.events-list').children().get(i).getAttribute('space_id');
                                //var timestamp = eventSingleD.getAttribute('id');
                                //console.log(eventSingleD);
                                var eventSingleP = $('.events-list').children().get(i).getElementsByTagName("p");
                                var eventSingleC = $('.events-list').children().get(i).getElementsByClassName("clock");
                                //var month_day = $('input[name=datetime]').val();
                                var cluster_num = $('.events-list').children().get(i).getElementsByClassName("cluster_number");
                                strHtml += "<span class='route_place' id="+eventSingleD+" space_id="+space_id+" city_id="+city_id+" month_day="+month_day+"><label class='route_place_time'>"+eventSingleC[0].innerText+"</label><label class='route_place_address' val="+city_id+">"+eventSingleP[0].innerText+"</label><label class='route_place_date'>"+month_day+eventSingleC[0].innerText+":00</label><label class='cluster_num'>"+cluster_num[0].innerText+"</label></span>";
                            }
                            $('.fc-event-'+dayClick).html(strHtml);

                            $('.events h3 b').html(length);
                        }
                    });
                }
                //console.log(date);


                //保存数据
                delete eventWillAdd[dateClick+" "+time1];

            });

        });

    </script>
@stop
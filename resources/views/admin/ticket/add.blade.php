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
    {{--onsubmit="return check_city_date()"--}}
    <form  action="/ticket_add_post" name="pic_submit" method="post" enctype="multipart/form-data">
    <div class="result-content" >
        <div class="top-content">
            <div class="pic" >
                <div class="pic_img" id="localImag"><img id="preview" src=""></div>
                <div class="picfile"><input type="file" name="pic" id="doc" onchange="javascript:setImagePreview();" /></div>
            </div>
            <table  class="table-content">
                <tr class="tr-content">
                    <td class="td-content-title">产品编号</td>
                    <td class="td-content"><input type="text" class="input" name="num" placeholder="(必填)"></td>
                </tr>
                <tr class="tr-content">
                    <td class="td-content-title">专题标签</td>
                    <td class="td-content">
                        <select class="input" name="route_label" id="">
                            @foreach ($list as $val)
                                <option value="{{ $val->id }}">{{ $val->route_label }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr class="tr-content">
                    <td class="td-content-title">线路标签</td>
                    <td class="td-content">
                        <select class="input" name="label" id="">
                            <option value="热销">热销</option>
                            <option value="最新">最新</option>
                        </select>
                    </td>
                </tr>
                <tr class="tr-content-last">
                    <td class="td-content-title">景点名称</td>
                    <td class="td-content"><textarea class="input" maxlength="50" placeholder="不超过50个字符(必填)" name="name"></textarea></td>
                </tr>
                <tr class="tr-content-last">
                    <td class="td-content-title">景点地址</td>
                    <td class="td-content"><textarea class="input" maxlength="50" placeholder="不超过50个字符(必填)" name="address"></textarea></td>
                </tr>
                <tr class="tr-content-last">
                    <td class="td-content-title">产品提示</td>
                    <td class="td-content"><textarea class="input" maxlength="25" placeholder="不超过25个字符" name="warn"></textarea></td>
                </tr>

            </table>
        </div>
        <div class="bot-content">
            <div>
                <div class="bot-content-title route-journey">门票详情</div>
                <div class="bot-content-title schedule-guide">预定须知</div>
            </div>
            <div class="bot-content-ue">
                <!-- 加载编辑器的容器 -->
                <div class="container1"><script  id="container1" name="detail" type="text/plain" ></script></div>
                <div class="ue-select container2"> <script id="container2" name="cost_explain" type="text/plain"></script></div>
                <div class="ue-select container3"> <script id="container3" name="prompt" type="text/plain"></script></div>

            </div>
        </div>
        <div class="button">
            <input type="submit"class="btn btn6 btn-info route-add"  value="提交">
            <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button">
        </div>
    </div>
        <div id="bz"></div>
    </form>
    <div class="result-content" style="margin-left: 190px;">
        <div class="top-content">
            <table  class="table-content" style="height: 100px">
                <tr class="tr-content" style="height: 30px">
                    <td class="td-content-title">名称</td>
                    <td class="td-content"><input type="text" class="input" name="type" placeholder="(必填)" id="ty"></td>
                </tr>
                <tr class="tr-content" style="height: 30px">
                    <td class="td-content-title">原价</td>
                    <td class="td-content"><input type="text" class="input" name="price" placeholder="(必填)" id="pri"></td>
                </tr>
                <tr class="tr-content" style="height: 30px">
                    <td class="td-content-title">现价</td>
                    <td class="td-content"><input type="text" class="input" name="current_price" placeholder="(必填)" id="cur"></td>
                </tr>
            </table>
        </div>
        <div class="button">
            <input type="button"class="btn btn6 btn-info route-add"  value="添加门票规格" id="guige">
        </div>
    </div>
@stop
@section('js')
    <script src="{{URL::asset('admin/jqdate/js/modernizr.custom.js')}}" type="text/javascript" ></script>
    <script src="{{URL::asset('admin/jqdate/js/jquery.calendario.js')}}" type="text/javascript"></script>
    <script>
        var i=0;
        $('#guige').click(function(){
            var type=$('#ty').val();
            var price=$('#pri').val();
            var current_price=$('#cur').val();
            $('#bz').append("<input type='hidden' name='type[]"+i+"' value='"+type+"'>");
            $('#bz').append("<input type='hidden' name='price[]"+i+"' value='"+price+"'>");
            $('#bz').append("<input type='hidden' name='current_price[]"+i+"' value='"+current_price+"'>");
            i++;

            alert('添加成功');
            $('#ty').val('');
            $('#pri').val('');
            $('#cur').val('');
        });
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
        //提交表单前出发函数
//        function check_city_date(){
//            //出发时间
//            //console.log(dating);
//            var datinglenght = dating.length;
//            for(var i=0;i<datinglenght;i++){
//                var route_place_time = dating[i]['route_place_time'];
//                var route_place_address = dating[i]['route_place_address'];
//                var route_place_date = dating[i]['route_place_date']+dating[i]['route_place_time']+':00';
//                var city_id = dating[i]['city_id'];
//                var cluster_num = dating[i]['cluster_num'];
//                var timestamp = dating[i]['timestamp'];
//
//                $('.button').append("<input type='hidden' name='route_place_time[]' value="+route_place_time+">");
//                $('.button').append("<input type='hidden' name='route_place_address[]' value="+route_place_address+">");
//                $('.button').append("<input type='hidden' name='route_place_date[]' value="+route_place_date+">");
//                $('.button').append("<input type='hidden' name='route_place_id[]' value="+city_id+">");
//                $('.button').append("<input type='hidden' name='cluster_num[]' value="+cluster_num+">");
//                $('.button').append("<input type='hidden' name='timestamp[]' value="+timestamp+">");
//            }
//            return false;
//        }

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
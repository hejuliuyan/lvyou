@extends('admin.public.base')
@section('style')
    <style>
        <style>
        .body{

        }
        .route_parame_div{
            overflow: hidden;
        }
        .route_parame_ul{
            margin-left:15px;
            margin-top:15px;
            width:500px;
            height:30px;
            /*border:1px solid green;*/
            overflow:hidden;
            float:left;

        }
        .route-parame-title{
            overflow: hidden;
            float: left;
            list-style:none;
            width:20%;
            height:30px;
            line-height: 30px;
            text-aline:center;
            /*border:1px solid red;*/
            padding-left:1%;
            background-color: #F2F2F2;
        }
        .route-input{
            list-style:none;
            width:40%;
            height:30px;
            /*border:1px solid blue;*/
            float:left;
            font-size: large;
        }
        .route-label-parame-input{
            width:100%;
            height: 100%;
            border:0;
        }
        .traffic-parame-input{
            width:100%;
            height: 100%;
            border:0;
        }
        .destination-input{
            width:100%;
            height: 100%;
            border:0;
        }
        .start-city-input{
            width:100%;
            height: 100%;
            border:0;
        }
        .route-parame-button{
            width:25%;
            list-style:none;
            padding-left:5px;
            /*background-color: ;*/
            float:right;
        }
        .route_label_div{
            overflow: hidden;

        }
        .route_label_val{
            overflow: hidden;
            margin:15px;
            width:100%;
            height:auto;
            /*border:1px solid #E4E4E4;*/
            /*float:left;*/
        }
        .traffic_val{
            overflow: hidden;
            margin:15px;
            width:100%;
            height:auto;
            /*border:1px solid #E4E4E4;*/
            /*float:left;*/
        }
        .destination_val{
            overflow: hidden;
            margin:15px;
            width:100%;
            height:auto;
            /*border:1px solid #E4E4E4;*/
            /*float:left;*/
        }
        .start_city_val{
            overflow: hidden;
            margin:15px;
            width:100%;
            height:auto;
            /*border:1px solid #E4E4E4;*/
            /*float:left;*/
        }
        .route_label_li{
            float: left;
            list-style: none;
        }
        .traffic_li{
            float: left;
            list-style: none;
        }
        .destination_li{
            float: left;
            list-style: none;
        }
        .start_city_li{
            float: left;
            list-style: none;
        }
        .route_label_del{
            color:red;
            cursor:pointer;
        }
        .traffic_del{
            color:red;
            cursor:pointer;
        }
        .destination_del{
            color:red;
            cursor:pointer;
        }
        .start_city_del{
            color:red;
            cursor:pointer;
        }
        /*ul{*/
        /*width:500px;*/
        /*height:30px;*/
        /*border:1px solid #E4E4E4;*/
        /*float:left;*/
        /*}*/
        /*ul li{*/
        /*float:left;*/
        /*height:30px;*/
        /*list-style:none;*/
        /*}*/

    </style>
@stop
@section('title1')
    参数管理
@stop
@section('title2')
    线路参数
@stop
@section('content')

    <div class="route_parame_div">
        <ul class="route_parame_ul">
                <li class="route-parame-title">线路标签：</li>
                <li class="route-input"><input type="text" class="route-label-parame-input" name="route_label" value=""></li>
                <li class="route-parame-button"><input class="btn btn6 btn-info route_input_button" type="button" class="" value="确定"></li>
        </ul>
    </div>
    <div class="route_label_div">
        <ul class="route_label_val">
            @foreach($data[0] as $route_label)
                <li class="route_label_li" id="{{$route_label->id}}">{{$route_label->route_label}} <span class="route_label_del">X</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></li>
            @endforeach
        </ul>
    </div>
    {{--交通方式--}}
    <div class="route_parame_div">
        <ul class="route_parame_ul">
            <li class="route-parame-title">交通方式：</li>
            <li class="route-input"><input type="text" class="traffic-parame-input" name="traffic" value=""></li>
            <li class="route-parame-button"><input class="btn btn6 btn-info traffic_input_button" type="button" class="" value="确定"></li>
        </ul>
    </div>
    <div class="route_label_div">
        <ul class="traffic_val">
            @foreach($data[1] as $traffic)
                <li class="traffic_li" id="{{$traffic->id}}">{{$traffic->traffic}} <span class="traffic_del">X</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></li>
            @endforeach
        </ul>
    </div>
    {{--目的地--}}
    <div class="route_parame_div">
        <ul class="route_parame_ul">
            <li class="route-parame-title">目的地：</li>
            <li class="route-input"><input type="text" class="destination-input" name="destination" value=""></li>
            <li class="route-parame-button"><input class="btn btn6 btn-info destination_button" type="button" class="" value="确定"></li>
        </ul>
    </div>
    <div class="route_label_div">
        <ul class="destination_val">
            @foreach($data[2] as $destination)
                <li class="destination_li" id="{{$destination->id}}">{{$destination->destination}} <span class="destination_del">X</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></li>
            @endforeach
        </ul>
    </div>

    {{--出发城市--}}
    <div class="route_parame_div">
        <ul class="route_parame_ul">
            <li class="route-parame-title">出发城市：</li>
            <li class="route-input"><input type="text" class="start-city-input" name="start_city" value=""></li>
            <li class="route-parame-button"><input class="btn btn6 btn-info start_city_button" type="button" class="" value="确定"></li>
        </ul>
    </div>
    <div class="route_label_div">
        <ul class="start_city_val">
            @foreach($data[3] as $start_city)
                <li class="start_city_li" id="{{$start_city->id}}">{{$start_city->start_city}} <span class="start_city_del">X</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></li>
            @endforeach
        </ul>
    </div>

@stop
@section('js')
    <script>
        $('.route_input_button').on('click',function(){
            var route_label_val = $('input[name=route_label]').val();
            $.ajax({
                data:{route_label:route_label_val},
                url:'/index.php/route_label_post',
                dataType:'json',
                type:'POST',
                success:function(data){
                    //追加到ul中
                    if(data =='repeat'){
                        alert('线路标签已存在');return;
                    } else if(typeof(data) == 'number'){
                        $(".route_label_val").append("<li class='route_label_li' id="+data+">"+route_label_val+" <span class='route_label_del'>X</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></li>");
                    } else{
                        alert('添加失败');
                    }
                },
                error:function(){

                }

            });
        });
        $(".route_label_val").on('click','.route_label_del',function(){
//        $('.route_label_del').on('click',function(){ //新生成的标签必须通过父级对其绑定事件
            alert('确定删除？');
            var route_label_id = $(this).parent().attr('id');
            $.ajax({
                data:{route_label_id:route_label_id},
                url:'/index.php/route_label_del',
                dataType:'json',
                type:'POST',
                success:function(data){
                    //移除元素
                    if(data == 1){
                        $(".route_label_li[id="+route_label_id+"]").remove();
                    } else{
                        alert('移除失败');
                    }
                },
                error:function(){

                }

            });

        });
        //交通方式
        $('.traffic_input_button').on('click',function(){
            var traffic_val = $('input[name=traffic]').val();
            $.ajax({
                data:{traffic_val:traffic_val},
                url:'/index.php/traffic_val_post',
                dataType:'json',
                type:'POST',
                success:function(data){
                    //追加到ul中
                    if(data =='repeat'){
                        alert('交通方式已存在');return;
                    } else if(typeof(data) == 'number'){
                        $(".traffic_val").append("<li class='traffic_li' id="+data+">"+traffic_val+" <span class='traffic_del'>X</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></li>");
                    } else{
                        alert('添加失败');
                    }
                },
                error:function(){

                }

            });
        });
        $(".traffic_val").on('click','.traffic_del',function(){
            alert('确定删除？');
            var traffic_id = $(this).parent().attr('id');
            $.ajax({
                data:{traffic_id:traffic_id},
                url:'/index.php/traffic_del',
                dataType:'json',
                type:'POST',
                success:function(data){
                    //移除元素
                    if(data == 1){
                        $(".traffic_li[id="+traffic_id+"]").remove();
                    } else{
                        alert('移除失败');
                    }
                },
                error:function(){

                }

            });

        });

        //目的地
        $('.destination_button').on('click',function(){
            var destination_val = $('input[name=destination]').val();
            $.ajax({
                data:{destination_val:destination_val},
                url:'/index.php/destination_val_post',
                dataType:'json',
                type:'POST',
                success:function(data){
                    //追加到ul中
                    if(data =='repeat'){
                        alert('目的地已存在');return;
                    } else if(typeof(data) == 'number'){
                        $(".destination_val").append("<li class='destination_li' id="+data+">"+destination_val+" <span class='destination_del'>X</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></li>");
                    } else{
                        alert('添加失败');
                    }
                },
                error:function(){

                }

            });
        });
        $(".destination_val").on('click','.destination_del',function(){
            alert('确定删除？');
            var destination_id = $(this).parent().attr('id');
            $.ajax({
                data:{destination_id:destination_id},
                url:'/index.php/destination_del',
                dataType:'json',
                type:'POST',
                success:function(data){
                    //移除元素
                    if(data == 1){
                        $(".destination_li[id="+destination_id+"]").remove();
                    } else{
                        alert('移除失败');
                    }
                },
                error:function(){

                }

            });

        });

        //出发城市
        //城市控件
        $('.start-city-input').on('focus',function(){
            var cityPicker = new IIInsomniaCityPicker({
                data: cityData,
                target: '.start-city-input',
                valType: 'k-v',
//                hideCityInput: '#city',
//                hideProvinceInput: '#province',
                callback: function(city_id){
                    //alert(city_id);
                    // city_id = city_id;
                }
            });
            cityPicker.init();
        });

        $('.start_city_button').on('click',function(){
            var start_city_val = $('input[name=start_city]').val();
            $.ajax({
                data:{start_city_val:start_city_val},
                url:'/index.php/start_city_val_post',
                dataType:'json',
                type:'POST',
                success:function(data){
                    //追加到ul中
                    if(data =='repeat'){
                        alert('出发城市已存在');return;
                    } else if(typeof(data) == 'number'){
                        $(".start_city_val").append("<li class='start_city_li' id="+data+">"+start_city_val+" <span class='start_city_del'>X</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></li>");
                    } else{
                        alert('添加失败');
                    }
                },
                error:function(){

                }

            });
        });
        $(".start_city_val").on('click','.start_city_del',function(){
            alert('确定删除？');
            var start_city_id = $(this).parent().attr('id');
            $.ajax({
                data:{start_city_id:start_city_id},
                url:'/index.php/start_city_del',
                dataType:'json',
                type:'POST',
                success:function(data){
                    //移除元素
                    if(data == 1){
                        $(".start_city_li[id="+start_city_id+"]").remove();
                    } else{
                        alert('移除失败');
                    }
                },
                error:function(){

                }

            });

        });
    </script>
@stop
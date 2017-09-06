@extends('admin.public.base')
@section('style')
    <style>

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
            width:30%;
            height:30px;
            line-height: 30px;
            text-aline:center;
            /*border:1px solid red;*/
            padding-left:1%;
            background-color: #F2F2F2;
        }
        .route-input{
            list-style:none;
            width:30%;
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
        .route_label_del{
            color:red;
            cursor:pointer;
        }
        .route_label_li{
            float: left;
            list-style: none;
        }
    </style>
@stop
@section('title1')
    广告管理
@stop
@section('title2')
    广告详情
@stop
@section('content')

    <div class="route_parame_div">
        <ul class="route_parame_ul">
            <li class="route-parame-title">（广告）线路编号：</li>
            <li class="route-input"><input type="text" class="route-label-parame-input" name="member_label" value=""></li>
            <li class="route-parame-button"><input class="btn btn6 btn-info member_input_button" type="button" class="" value="确定"></li>
        </ul>
    </div>
    <div class="route_label_div">
        <ul class="route_label_val">
            @if(!empty($data[0]))
                @foreach($data as $adver)
                    <li class="route_label_li" id="{{$adver->id}}">{{$adver->route_code}}({{$adver->route_name}}) <span class="route_label_del">X</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></li>
                @endforeach
            @endif
        </ul>
    </div>
@stop
@section('js')
    <script>

        $('.member_input_button').on('click',function(){
            var member_label_val = $('input[name=member_label]').val();
            $.ajax({
                data:{member_label_val:member_label_val},
                url:'/index.php/adver_post',
                dataType:'json',
                type:'POST',
                success:function(data){
                    //追加到ul中

                    if(data =='repeat'){
                        alert('线路编号已存在');return;
                    }else if(data =='null'){
                        alert('线路编号不存在');return;
                    }else if(data =='overflow'){
                        alert('广告位不得超过3个');return;
                    } else if(typeof(data) == 'string'){
                        $(".route_label_val").append("<li class='route_label_li' id="+data+">"+member_label_val+"("+data+")<span class='route_label_del'>X</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></li>");
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
            var member_label_id = $(this).parent().attr('id');
            $.ajax({
                data:{member_label_id:member_label_id},
                url:'/index.php/adver_del',
                dataType:'json',
                type:'POST',
                success:function(data){
                    //移除元素
                    if(data == 1){
                        $(".route_label_li[id="+member_label_id+"]").remove();
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
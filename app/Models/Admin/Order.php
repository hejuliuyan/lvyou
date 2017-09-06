<?php namespace App\Models\Admin;

use App\Models\Admin\Base;
use DB;
use Crypt;
/**
 * 订单管理
 *
 * @author sun
 */
class Order extends Base
{
    /**
     * 线路列表管理页面
     */
    public function order_list($order_select,$order_code, $mobile,$class_code,$group_code)
    {
        if ($order_code or $mobile or $class_code or $group_code) {
            if($order_select == 1){
                $order_code = trim($order_code);
                $data = DB::table('order')->select('id', 'order_code', 'order_time', 'order_price','place_id', 'member_id','status','class_code')->where('order_code',$order_code)->where('delete', '=', 0)->orderBy('order_time', 'desc')->paginate(10);
            }elseif($order_select == 2){
                $mobile = trim($mobile);
                $member_id = DB::table('member')->where('mobile','=',$mobile)->where('delete', '=', 0)->pluck('id');
                $data = DB::table('order')->select('id', 'order_code', 'order_time', 'order_price','place_id', 'member_id','status','class_code')->where('member_id',$member_id[0])->where('delete', '=', 0)->orderBy('order_time', 'desc')->paginate(10);
            }elseif($order_select == 3){
                $class_code = trim($class_code);
                $data = DB::table('order')->select('id', 'order_code', 'order_time', 'order_price','place_id', 'member_id','status','class_code')->where('class_code',$class_code)->where('delete', '=', 0)->orderBy('order_time', 'desc')->paginate(10);
            }elseif($order_select == 4){
                $group_code = trim($group_code);
                $data = DB::table('order')->select('id', 'order_code', 'order_time', 'order_price','place_id', 'member_id','status','class_code')->where('group_code',$group_code)->where('delete', '=', 0)->orderBy('order_time', 'desc')->paginate(10);
            }else{
                $data = DB::table('order')->select('id', 'order_code', 'order_time', 'order_price','place_id', 'member_id','status','class_code')->where('delete', '=', 0)->orderBy('order_time', 'desc')->paginate(10);
            }

        } else {
            $data = DB::table('order')->select('id', 'order_code', 'order_time', 'order_price','place_id', 'member_id','status','class_code')->where('delete', '=', 0)->orderBy('order_time', 'desc')->paginate(10);
        }

            foreach ($data as $k => $v) {
                $start_date = DB::table('start_city_place_time')->where('id','=',$v->place_id)->pluck('start_city_place_date');
                $order_mobile = DB::table('member')->where('id','=',$v->member_id)->pluck('mobile');
                if(empty($start_date[0])){
                    $v->new_start_date = '';
                }else{
                    $v->new_start_date = date('Y-m-d', $start_date[0]);
                }

                $v->new_order_time = date('Y-m-d H:i:s', $v->order_time);
                if($order_mobile){
                    $v->new_mobile = $order_mobile[0];
                }else{
                    $v->new_mobile = '';
                }



                //退单按钮显示
                if(in_array($v->status,array(3))){
                    $v->payback_show = 1;
                }else{
                    $v->payback_show = 0;
                }
                //退款按钮显示
                if(in_array($v->status,array(4))){
                    $v->backmoney_show = 1;
                }else{
                    $v->backmoney_show = 0;
                }
                if($v->status ==1){
                    $v->new_status = "未支付";
                }elseif($v->status ==2){
                    $v->new_status = '已支付';
                }elseif($v->status ==3){
                    $v->new_status = '已申请退单';
                }elseif($v->status ==4){
                    $v->new_status = '已同意退单';
                }elseif($v->status ==5){
                    $v->new_status = '已退款';
                }elseif($v->status ==6){
                    $v->new_status = '已取消';
                }elseif($v->status ==7){
                    $v->new_status = '已推迟';
                }elseif($v->status ==8){
                    $v->new_status = '已成团';
                }elseif($v->status ==9){
                    $v->new_status = '已出行';
                }


            }

        $data = $data->appends(array(
            'class_code'=>$class_code,
            'order_select'=>$order_select,
            'order_code'=>$order_code,
            'group_code'=>$group_code,
            'mobile'=>$mobile,
            //add more element if you have more search terms
        ));
        return $data;
    }

    //订单详情
    public function order_detail($order_id){
        $data = DB::table('order')->where('id',$order_id)->get();
        foreach($data as $k=>$v){
            $member = DB::table('member')->where('id','=',$v->member_id)->select('real_name','mobile')->get();
            $route = DB::table('route')->where('id','=',$v->route_id)->select('code','route_name')->get();
            $place = DB::table('start_city_place_time')->where('id','=',$v->place_id)->select('start_city_place','start_city_place_time','start_city_place_date')->get();
            $v->real_name = $member[0]->real_name;
            $v->mobile = $member[0]->mobile;
            $v->code = $route[0]->code;
            $v->route_name = $route[0]->route_name;
            $v->start_city_place = $place[0]->start_city_place;
            $v->start_city_place_time = $place[0]->start_city_place_time;
            $v->start_city_place_date = date('Y-m-d', $place[0]->start_city_place_date);
            $v->new_order_time = date('Y-m-d H:i:s', $v->order_time);
            if($v->status ==1){
                $v->new_status = "未支付";
            }elseif($v->status ==2){
                $v->new_status = '已支付';
            }elseif($v->status ==3){
                $v->new_status = '已申请退单';
            }elseif($v->status ==4){
                $v->new_status = '已同意退单';
            }elseif($v->status ==5){
                $v->new_status = '已退款';
            }elseif($v->status ==6){
                $v->new_status = '已取消';
            }elseif($v->status ==7){
                $v->new_status = '已推迟';
            }elseif($v->status ==8){
                $v->new_status = '已成团';
            }elseif($v->status ==9){
                $v->new_status = '已出行';
            }
        }
        $status =DB::table('order_log')->where('order_id',$order_id)->orderBy('time','desc')->get();
        foreach($status as $k=>$v){
            $v->new_time = date('Y-m-d H:i:s', $v->time);
        }
        $data[] = $status;
        return $data;
    }

    //退单审核
    public function order_back_check($order_id){
        $res = DB::table('order')->where('id',$order_id)->whereIn('status', [3,7,8])->update([
            'status' => 4,
        ]);
        //将操作过程导入log表
        $data= DB::table('order')->where('id',$order_id)->select('member_id','route_id','place_id')->get();
        $res = DB::table('order_log')->insert([
            'order_id'=>$order_id,
            'time'=>time(),
            'operation' =>'后台同意退单操作',
            'order_status'  =>4,
            'member_id'  =>$data[0]->member_id,
            'route_id'  =>$data[0]->route_id,
        ]);
        //同一时间，同一地点  一个团代号
        //支付订单时团的数据改变
        if($data) {
            $team_order = DB::table('team_order')->where('place_id',$data[0]->place_id)->get();
            $travel_num = $team_order[0]->travel_num - 1;
//            $order_rate = round($travel_num / $team_order[0]->cluster_num, 2);
//            if ($order_rate < 0.95) {
//                $status = 1;
//                $team_complete_date = '';
//                //将操作过程导入team_log表
//                $data = DB::table('team_log')->insert([
//                    'team_id'=>$team_order[0]->id,
//                    'time'=>time(),
//                    'operation' =>'状态变为成团中',
//                    'team_status'  =>1,
//                ]);
//            } else {
//                $status = $team_order[0]->status;
//                $team_complete_date = $team_order[0]->team_complete_date;
//            }
            $res = DB::table('team_order')->where('place_id', $data[0]->place_id)->UPDATE([
                //'status' => $status,// 1:成团中，2：已推迟 3：已成团 4：已出行
                //'order_rate' => $order_rate,//成团率
                'travel_num' => $travel_num,//出行人数
                //'team_complete_date' => $team_complete_date,//成团日期
            ]);
        }

        if($res){
            return true;
        }else{
            return false;
        }


    }

    //退款审核
    public function order_back_money($order_id){
        $res = DB::table('order')->where('id',$order_id)->whereIn('status', [4])->update([
            'status' => 5,
        ]);
        //将操作过程导入log表
        $data= DB::table('order')->where('id',$order_id)->select('member_id','route_id')->get();
        $res = DB::table('order_log')->insert([
            'order_id'=>$order_id,
            'time'=>time(),
            'operation' =>'后台同意退款操作',
            'order_status'  =>5,
            'member_id'  =>$data[0]->member_id,
            'route_id'  =>$data[0]->route_id,
        ]);
        if($res){
            return true;
        }else{
            return false;
        }
    }















}
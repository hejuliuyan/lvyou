<?php namespace App\Models\Admin;

use App\Models\Admin\Base;
use DB;
use Crypt;
/**
 * 发团管理
 *
 * @author sun
 */
class Team extends Base
{
    /**
     * 线路列表管理页面
     */
    public function team_list($team_select,$team_code, $team_start,$class_code)
    {
        if ($team_code or $team_start or $class_code) {
            if($team_select == 1){
                $data = DB::table('team_order')->where('team_order', '=',$team_code)->where('travel_num','<>',0)->where('delete', '=', 0)->orderBy('date_departure', 'desc')->paginate(10);
            }elseif($team_select == 2){
                $time1 = strtotime($team_start);
                $time2 = $time1+24*3600;
                $data = DB::table('team_order')->whereBetween('team_start_date', [$time1, $time2])->where('travel_num','<>',0)->where('delete', '=', 0)->orderBy('date_departure', 'desc')->paginate(10);
            }elseif($team_select == 3){
                $data = DB::table('team_order')->where('class_code', '=',$class_code)->where('travel_num','<>',0)->where('delete', '=', 0)->orderBy('date_departure', 'desc')->paginate(10);
            }else{
                $data = DB::table('team_order')->where('travel_num','<>',0)->where('delete', '=', 0)->orderBy('date_departure', 'desc')->paginate(10);
            }

        } else {
            $data = DB::table('team_order')->where('travel_num','<>',0)->where('delete', '=', 0)->orderBy('date_departure', 'desc')->paginate(10);
        }


        foreach ($data as $k => $v) {
            if(empty($v->date_departure)){
                $v->new_date_departure = '';
            }else{
                $v->new_date_departure = date('Y-m-d', $v->date_departure);
            }
            if(empty($v->team_complete_date)){
                $v->new_team_complete_date = '';
            }else{
                $v->new_team_complete_date = date('Y-m-d', $v->team_complete_date);
            }

            //是否可编辑
//            if($v->status == 3 or $v->status == 2){
//                $v->status_show = 1;
//            }else{
//                $v->status_show = 0;
//            }

            $v->order_rate = (round($v->travel_num/$v->cluster_num,3)*100).'%';
//            if(!empty($v->order_rate)){
//                $v->order_rate = ($v->order_rate*100).'%';
//            }
            if($v->status ==1){
                $v->new_status = "成团中";//
            }elseif($v->status ==2){
                $v->new_status = '已推迟';//
            }elseif($v->status ==3){
                $v->new_status = '已成团';
            }elseif($v->status ==4){
                $v->new_status = '已封团';
            }elseif($v->status ==6){
                $v->new_status = '已关闭';
            }elseif($v->status ==9){
                $v->new_status = '已出行';
            }
        }

        $data = $data->appends(array(
            'order_select'=>$team_select,
            'team_code'=>$team_code,
            'team_start'=>$team_start,
            'class_code'=>$class_code,
            //add more element if you have more search terms
        ));

        return $data;
    }

    //订单详情
    public function team_detail($team_id){
        $data =  DB::table('team_order')->where('id',$team_id)->get();
        foreach($data as $k=>$v){

            $route = DB::table('route')->where('id','=',$v->route_id)->get();
            $place = DB::table('start_city_place_time')->where('id','=',$v->place_id)->select('start_city_id','start_city_place','start_city_place_time','start_city_place_date')->get();
            //$member = DB::table('team_order')->where('id','=',$v->member_id)->select('real_name','mobile')->get();
            $city = DB::table('start_city')->where('id','=',$place[0]->start_city_id)->select('start_city')->get();
            $destination = DB::table('destination')->where('id','=',$route[0]->destination)->select('destination')->get();
            $v->address = $city[0]->start_city.' '.$place[0]->start_city_place;
            $v->destination = $destination[0]->destination;
            $v->route_code = $route[0]->code.' '.$route[0]->route_name;
            $v->journey_day = $route[0]->journey_day;
            $v->start_date = date('Y-m-d', $v->date_departure);
            if(empty( $v->backteam_date)){
                $v->back_team = '';
            }else{
                $v->back_team = date('Y-m-d H:i', $v->backteam_date);
            }


            if($v->status ==1){
                $v->new_status = "成团中";
            }elseif($v->status ==2){
                $v->new_status = '已推迟';
            }elseif($v->status ==3){
                $v->new_status = '已成团';
            }elseif($v->status ==4){
                $v->new_status = '已封团';
            }elseif($v->status ==6){
                $v->new_status = '已关闭';
            }elseif($v->status ==9){
                $v->new_status = '已出行';
            }
        }
        //同行人
        $peer =DB::table('order')->where('place_id',$data[0]->place_id)->whereIn('status',[2,7,8])->get();
        foreach($peer as $k=>$v){
            $member =DB::table('member')->where('id',$v->member_id)->select('id','real_name','mobile','role')->get();
            if($member[0]->role == 0){
                $v->peer = $member[0]->mobile.' '.$member[0]->real_name.' (组长)';
                $v->id = $member[0]->id;
            }else{
                $v->peer = $member[0]->mobile.' '.$member[0]->real_name;
                $v->id = $member[0]->id;
            }

        }
        $data[] = $peer;


        //状态明细
        $status =DB::table('team_log')->where('team_id',$team_id)->orderBy('time','desc')->get();
        foreach($status as $k=>$v){
            $v->new_time = date('Y-m-d H:i:s', $v->time);
        }
        $data[] = $status;
        return $data;
    }

}
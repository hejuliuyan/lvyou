<?php namespace App\Models\Admin;

use App\Models\Admin\Base;
use DB;
use Crypt;
/**
 * 会员管理
 *
 * @author sun
 */
class Route extends Base
{
    //新增线路需求数据
    public function route_add_view(){
        //线路标签
        $data=array();
        $data[] = DB::table('route_label')->select('id', 'route_label')->where('delete', '=', 0)->orderBy('id', 'asc')->get();
        //交通方式
        $data[] = DB::table('traffic')->select('id', 'traffic')->where('delete', '=', 0)->orderBy('id', 'asc')->get();
        //目的地
        $data[] = DB::table('destination')->select('id', 'destination')->where('delete', '=', 0)->orderBy('id', 'asc')->get();
        //出发地
        $data[] = DB::table('start_city')->select('id', 'start_city')->where('delete', '=', 0)->orderBy('id', 'asc')->get();

        return $data;
    }

    //编辑线路需求数据
    public function route_edit_view($id){
        $data = DB::table('route')->where('id','=',$id)->get();
//        $new_start_city = DB::table('start_city')->where('id',$data[0]->start_city)->pluck('start_city');
        $new_destination = DB::table('destination')->where('id',$data[0]->destination)->pluck('destination');
        $new_traffic = DB::table('traffic')->where('id',$data[0]->traffic)->pluck('traffic');
        $new_route_label = DB::table('route_label')->where('id',$data[0]->route_label)->pluck('route_label');
//        $new_start_date = date("Y-m-d H:i:s", $data[0]->start_date);
        foreach($data as $k=>$v){
//            $v->new_start_city = $new_start_city[0];
            $v->new_destination = $new_destination[0];
            $v->new_traffic = $new_traffic[0];
            $v->new_route_label = $new_route_label[0];
//            $v->new_start_date = $new_start_date;
        }
        //下拉列表选项
        //线路标签
        $data[] = DB::table('route_label')->select('id', 'route_label')->where('delete', '=', 0)->orderBy('id', 'asc')->get();
        //交通方式
        $data[] = DB::table('traffic')->select('id', 'traffic')->where('delete', '=', 0)->orderBy('id', 'asc')->get();
        //目的地
        $data[] = DB::table('destination')->select('id', 'destination')->where('delete', '=', 0)->orderBy('id', 'asc')->get();
        //出发地
        //$data[] = DB::table('start_city')->select('id', 'start_city')->where('delete', '=', 0)->orderBy('id', 'asc')->get();
        $data[] = DB::table('start_city')->select('id', 'start_city')->where('id', '=',$data[0]->start_city)->get();
        //dd($data);
        //出发地具体地址
        $start_city_place = DB::table('start_city_place_time')->select('start_city_place')->where('route_id', '=',$id)->get();
//        dd($start_city_place);
        $city_place = array();
//        foreach ($start_city_place as $k => $v) {
//            $city_place[$v->start_city_place][] = $v;
//        }
//        dd($city_place);
        foreach($start_city_place as $k=>$v){
            $city_place[] = $v->start_city_place;
        }
        $city_place = array_unique($city_place);

        foreach($city_place as $k=>$v){
            $start_city_address[] = DB::table('start_city_place_time')->select('id','start_city_id','start_city_place')->where('start_city_place', '=',$v)->first();

        }
        if(!empty($start_city_address)){
            $data[] = $start_city_address;
        }else{
            $data[] = '';
        }

        //日历表的显示
        $start_city_time = DB::table('start_city_place_time')->select('id','start_city_id','start_city_place','start_city_place_time','start_city_place_date','cluster_num','timestamp')->where('route_id', '=',$id)->where('delete',0)->get();
        $year_month = date('Y-m',time());
        foreach($start_city_time as $k=>$v){
            $v->show_date =date("Y-m",$v->start_city_place_date);
            //判断当前日是否在某年某月内
            if ($year_month != $v->show_date) {
                unset($start_city_time[$k]);
                continue;

            }

            $v->new_date =date("Y-m-d H:i:s",$v->start_city_place_date);
            $day =date("Y-m-d",$v->start_city_place_date);
            $day_arr = explode('-',$day);
            $v->new_date_day = $day_arr[1].'-'.$day_arr[2].'-'.$day_arr[0];
        }
        $data[] = json_encode(array_merge($start_city_time));
        return $data;
    }

    //编辑页面上月下月填充日期
    public function padding_date($year,$month,$id){
        $start_city_time = DB::table('start_city_place_time')->select('id','start_city_id','start_city_place','start_city_place_time','start_city_place_date','cluster_num','timestamp')->where('route_id', '=',$id)->where('delete',0)->get();
        $months = array('一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月');
        if($month == $months[0]){
            $month = '01';
        }elseif($month == $months[1]){
            $month = '02';
        }elseif($month == $months[2]){
            $month = '03';
        }elseif($month == $months[3]){
            $month = '04';
        }elseif($month == $months[4]){
            $month = '05';
        }elseif($month == $months[5]){
            $month = '06';
        }elseif($month == $months[6]){
            $month = '07';
        }elseif($month == $months[7]){
            $month = '08';
        }elseif($month == $months[8]){
            $month = '09';
        }elseif($month == $months[9]){
            $month = '10';
        }elseif($month == $months[10]){
            $month = '11';
        }elseif($month == $months[11]){
            $month = '12';
        }
        $year_month = $year.'-'.$month;
        $year_month = (string)$year_month;
        $start_date = array();
        foreach($start_city_time as $k=>$v){
            $v->show_date =date("Y-m",$v->start_city_place_date);
            $v->show_date = (string)$v->show_date;
            //判断当前日是否在某年某月内
            if ($year_month != $v->show_date) {
                //return array($year_month,$v->show_date);die;
                unset($start_city_time[$k]);
                continue;
            }
//            if ($year_month == $v->show_date) {
//                $start_date[]
//            }
            $v->new_date =date("Y-m-d H:i:s",$v->start_city_place_date);
            $day =date("Y-m-d",$v->start_city_place_date);
            $day_arr = explode('-',$day);
            $v->new_date_day = $day_arr[1].'-'.$day_arr[2].'-'.$day_arr[0];
        }
        //必须将数组下标键初始化排序
        return array_merge($start_city_time);
    }






























}
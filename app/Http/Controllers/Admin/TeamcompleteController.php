<?php namespace App\Http\Controllers\Admin;
use Request;
use Crypt;
use DB;
use Input;
use App\Models\Common;
class TeamcompleteController extends Controller
{
    /**
     * 定时任务判断前3天有没有成团
     * 12点以后执行
     */
    public function test()
    {
        $team = DB::table('num')->where('id',3)->increment('num');
    }
    public function index()
    {
        $time = time();
        $datetime = date('Y-m-d',$time);
        $date1 = strtotime($datetime);
        $date2 = $date1 + 120 * 3600;

        //查询3天后出发的所有团
        $start_num = 0;
        $team = DB::table('team_order')->whereBetween('date_departure', [$date1, $date2])->where('delete',0)->get();
        foreach ($team as $k => $v) {
            $order_rate = round($v->travel_num/$v->cluster_num, 3);

            if ($order_rate >= 0.95) {
                $order_status = 8;
                $order_log = '已成团';
                //成团编号
                $start_num++;
                if(strlen($start_num) == 1){
                    $code_num = "00".$start_num;
                }elseif(strlen($start_num) == 2){
                    $code_num =  "0".$start_num;
                }elseif(strlen($start_num) == 3){
                    $code_num = $start_num;
                }
                //目的地
                $route = DB::table('route')->where('id',$v->route_id)->pluck('destination');
                $destination = DB::table('destination')->where('id',$route[0])->pluck('destination');
                $team_code = explode('-',$datetime);
                $team_code = implode('',$team_code);
                $pinyin = new Common();
                $get_pinyin = $pinyin->get_pinyin($destination[0]);
                $get_pinyin = strtoupper($get_pinyin);
                $team_code = 'CITS-'.$team_code.$code_num.$get_pinyin;

                $status = 4;
                $team_complete_date = $time;
                $status_log = '状态变为已封团';

            }else{
                $order_status = 7;
                $order_log = '已推迟';
                //成团编号
                $team_code = '';
                $status = 2;
                $team_complete_date = '';
                $status_log = '状态变为已推迟';
            }

            /*
            * 必须先插入log表再更新主表
            */
            //用户订单状态更新
            if($order_status == 7){
                /*
                * //如果没有顺延
                 */
                $res = DB::table('order')->where('place_id', $v->place_id)->whereIn('status',[2])->get();
                foreach($res as $k2=>$v2){
                    if($v2->status != $order_status){
                        $data0 = DB::table('order_log')->insert([
                            'order_id'=>$v2->id,
                            'time'=>$time,
                            'operation' =>$order_log,
                            'order_status'  =>$order_status,
                            'member_id'  =>$v2->member_id,
                            'route_id'  =>$v2->route_id,
                        ]);
                    }
                }
                $data1  = DB::table('order')->where('place_id', $v->place_id)->whereIn('status',[2])->UPDATE([
                    'status' => $order_status,
                ]);
                $data2 = DB::table('team_log')->insert([
                    'team_id'=>$v->id,
                    'time'=>$time,
                    'operation' =>$status_log,
                    'team_status'  =>$status,
                ]);
                $res3 = DB::table('team_order')->where('id', $v->id)->UPDATE([
                    'status' => 2,// 1:成团中，2：已推迟 3：已成团 4:已封团 6:已关闭 9：已出行
                ]);

                /*
                * //如果有顺延
                 */
                $start_place = DB::table('start_city_place_time')->where('id', $v->place_id)->get();
                for($i=1;$i<5;$i++){
                    //查询1月内出发的同一周期的团
                    $traveltime = $start_place[0]->start_city_place_date+86400*7*$i;
                    $future_place = DB::table('start_city_place_time')->whereBetween('start_city_place_date', [$traveltime, $traveltime+86400])->where('route_id',$start_place[0]->route_id)->where('start_city_id',$start_place[0]->start_city_id)->where('start_city_place',$start_place[0]->start_city_place)->where('delete', 0)->get();
                    if(!empty($future_place)){
                        $future_team = DB::table('team_order')->where('place_id', $future_place[0]->id)->get();
                        if($v->travel_num > $future_team[0]->cluster_num - $future_team[0]->virtual_num){
                            continue;
                        }else{
                            $res = DB::table('order')->where('place_id', $v->place_id)->whereIn('status',[7])->get();
                            foreach($res as $k1=>$v1){
                                $str = "0123456789";//输出字符集
                                $len = strlen($str) - 1;

                                $code='';
                                for ($k = 0; $k < 4; $k++) {
                                    $code.= $str[rand(0, $len)];
                                }
                                $order_code = 'ED'.$traveltime.$code;

                                $order_id = DB::table('order')->insertGetId([
                                    'order_code'=>$order_code,
                                    'class_code'=>$future_team[0]->class_code,
                                    'member_id' =>$v1->member_id,
                                    'route_id'  =>$v1->route_id,
                                    'post_id'  => $v1->post_id,
                                    'place_id'  =>$future_team[0]->place_id,
                                    'status'    =>7,//$v1->status
                                    'order_price'=>$v1->order_price,
                                    'order_time'=>$v1->order_time,
                                    'pay_time'=>$v1->pay_time,
                                    'insurance'=>$v1->insurance,
                                    'pay_way' =>$v1->pay_way,
                                    'sub_way' =>$v1->sub_way,
                                    'delete'  =>0,
                                ]);
                                //将操作过程导入log表
                                DB::table('order_log')->insert([
                                    'order_id'=>$order_id,
                                    'time'=>$time,
                                    'operation' =>'新建顺延订单',
                                    'order_status'  =>7,
                                    'member_id' =>$v1->member_id,
                                    'route_id'  =>$v1->route_id,
                                ]);

                            }
                            //把要推迟的订单全部删除
                            $result = DB::table('order')->where('place_id', $v->place_id)->whereIn('status',[7])->UPDATE([
                                'delete' => 1,
                            ]);
                            //将操作过程导入team_log表
                            //$v->id 这个团如果当前状态和此次插入状态一样，则不再插入
                            $res = DB::table('team_order')->where('id', $v->id)->get();//dd($res);
                            if($res[0]->status != $status){
                                $data = DB::table('team_log')->insert([
                                    'team_id'=>$v->id,
                                    'time'=>$time,
                                    'operation' =>'状态变为已关闭',
                                    'team_status'  =>6,
                                ]);
                            }
                            //过去的团更新
                            $res1 = DB::table('team_order')->where('id', $v->id)->UPDATE([
                                'status' => 6,// 1:成团中，2：已推迟 3：已成团 4:已封团 6:已关闭 9：已出行
                                'travel_num'=>0,
                                'virtual_num' => 0,
                                'order_rate'=>0,
                                'delete' => 1
                            ]);
                            $res2 = DB::table('start_city_place_time')->where('id', $v->place_id)->UPDATE([
                                'delete' => 1
                            ]);
                            //未来的团更新
                            $future_travel = $future_team[0]->travel_num + $v->travel_num;
                            $future_virtual = $future_team[0]->virtual_num + $v->virtual_num;
                            $res3 = DB::table('team_order')->where('id', $future_team[0]->id)->UPDATE([
                                'travel_num' => $future_travel,// 1:成团中，2：已推迟 3：已成团 4:已封团 6:已关闭 9：已出行
                                'virtual_num' => $future_virtual,
                            ]);
                            break;
                        }
                    }
                }

            }else{
                $res = DB::table('order')->where('place_id', $v->place_id)->whereIn('status',[2,7])->get();
                foreach($res as $k2=>$v2){
                    if($v2->status != $order_status){
                        $data = DB::table('order_log')->insert([
                            'order_id'=>$v2->id,
                            'time'=>$time,
                            'operation' =>$order_log,
                            'order_status'  =>$order_status,
                            'member_id'  =>$v2->member_id,
                            'route_id'  =>$v2->route_id,
                        ]);
                    }

                }
                //这里只把已支付的订单推迟或成团，而推迟或已成团订单状态不变
                $result = DB::table('order')->where('place_id', $v->place_id)->whereIn('status',[2,7])->UPDATE([
                    'status' => $order_status,
                    'group_code'=>$team_code,
                ]);


                /*****************************/
                //将操作过程导入team_log表
                //$v->id 这个团如果当前状态和此次插入状态一样，则不再插入
                $res = DB::table('team_order')->where('id', $v->id)->get();//dd($res);
                if($res[0]->status != $status){
                    $data = DB::table('team_log')->insert([
                        'team_id'=>$v->id,
                        'time'=>$time,
                        'operation' =>$status_log,
                        'team_status'  =>$status,
                    ]);
                }
                //团更新
                $res = DB::table('team_order')->where('id', $v->id)->UPDATE([
                    'team_code' => $team_code,
                    'status' => $status,// 1:成团中，2：已推迟 3：已成团 4:已封团 6:已关闭 9：已出行
                    'order_rate' => $order_rate,//成团率
                    'team_complete_date' => $team_complete_date,//成团日期
                ]);
            }



        }

        //更新已出行的团和订单
//        $dateformerly = date('Y-m-d',$time-24*3600);
//        $date3 = strtotime($dateformerly);
//        $date4 = $date3 + 24 * 3600;
//        $formerly = DB::table('team_order')->whereBetween('date_departure', [$date3, $date4])->where('delete', 0)->where('status',4)->get();
//        //dd($formerly);
//        foreach($formerly as $k=>$v){
//            //用户订单状态更新
//            $res = DB::table('order')->where('place_id', $v->place_id)->whereIn('status',[8])->get();
//            foreach($res as $k2=>$v2){
//                $data = DB::table('order_log')->insert([
//                    'order_id'=>$v2->id,
//                    'time'=>$time,
//                    'operation' =>'已出行',
//                    'order_status'  =>9,
//                    'member_id'  =>$v2->member_id,
//                    'route_id'  =>$v2->route_id,
//                ]);
//            }
//            $res = DB::table('order')->where('place_id', $v->place_id)->where('status',8)->UPDATE([
//                'status' => 9,
//            ]);
//
//            //将操作过程导入team_log表
//            $res = DB::table('team_order')->where('id', $v->id)->get();
//            if($res[0]->status != 4){
//                $data = DB::table('team_log')->insert([
//                    'team_id' => $v->id,
//                    'time' => $time,
//                    'operation' => '状态变为已出行',
//                    'team_status' => 9,
//                ]);
//            }
//            //团更新
//            $res = DB::table('team_order')->where('id', $v->id)->whereIn('status',[3])->UPDATE([
//                'status' => 9,// 1:成团中，2：已推迟 3：已成团 4:已封团 9：已出行
//            ]);
//
//        }
    }

    //成团测试 成团测试后出发日期和已定人员（即成团率）都不变
    public function Teamcomplete_test(){
        $time = time();
        $datetime = date('Y-m-d',$time);
        $date1 = strtotime($datetime);
        $date2 = $date1 + 120 * 3600;

        //查询3天后出发的所有团
        $start_num = 0;
        $team = DB::table('team_order')->whereBetween('date_departure', [$date1, $date2])->where('delete', 0)->get();
        foreach ($team as $k => $v) {
            $order_rate = round($v->travel_num/$v->cluster_num, 3);

            if ($order_rate >= 0.95) {
                $order_status = 8;
                $order_log = '已成团';
                //成团编号
                $start_num++;
                if(strlen($start_num) == 1){
                    $code_num = "00".$start_num;
                }elseif(strlen($start_num) == 2){
                    $code_num =  "0".$start_num;
                }elseif(strlen($start_num) == 3){
                    $code_num = $start_num;
                }
                //目的地
                $route = DB::table('route')->where('id',$v->route_id)->pluck('destination');
                $destination = DB::table('destination')->where('id',$route[0])->pluck('destination');
                $team_code = explode('-',$datetime);
                $team_code = implode('',$team_code);
                $pinyin = new Common();
                $get_pinyin = $pinyin->get_pinyin($destination[0]);
                $get_pinyin = strtoupper($get_pinyin);
                $team_code = 'CITS-'.$team_code.$code_num.$get_pinyin;

                $status = 4;
                $team_complete_date = $time;
                $date_departure = $v->date_departure;
                $status_log = '状态变为已封团';

            }else{
                $order_status = 7;
                $order_log = '已推迟';
                //成团编号
                $team_code = '';
                $status = 2;
                $team_complete_date = '';
                $date_departure = $v->date_departure+24*3600;
                $status_log = '状态变为已推迟';
            }

            /*
            * 必须先插入log表再更新主表
            */
            //用户订单状态更新
            if($order_status == 7){
                $res = DB::table('order')->where('place_id', $v->place_id)->whereIn('status',[2])->get();
                foreach($res as $k2=>$v2){
                    if($v2->status != $order_status){
                        $data = DB::table('order_log')->insert([
                            'order_id'=>$v2->id,
                            'time'=>$time,
                            'operation' =>$order_log,
                            'order_status'  =>$order_status,
                            'member_id'  =>$v2->member_id,
                            'route_id'  =>$v2->route_id,
                        ]);
                    }

                }
                //这里只把已支付的订单推迟或成团，而推迟或已成团订单状态不变
                $result = DB::table('order')->where('place_id', $v->place_id)->whereIn('status',[2])->UPDATE([
                    'status' => $order_status,
                    'group_code'=>$team_code,
                ]);
            }else{
                $res = DB::table('order')->where('place_id', $v->place_id)->whereIn('status',[2,7])->get();
                foreach($res as $k2=>$v2){
                    if($v2->status != $order_status){
                        $data = DB::table('order_log')->insert([
                            'order_id'=>$v2->id,
                            'time'=>$time,
                            'operation' =>$order_log,
                            'order_status'  =>$order_status,
                            'member_id'  =>$v2->member_id,
                            'route_id'  =>$v2->route_id,
                        ]);
                    }

                }
                //这里只把已支付的订单推迟或成团，而推迟或已成团订单状态不变
                $result = DB::table('order')->where('place_id', $v->place_id)->whereIn('status',[2,7])->UPDATE([
                    'status' => $order_status,
                    'group_code'=>$team_code,
                ]);
            }

            /*****************************/
            //将操作过程导入team_log表
            //$v->id 这个团如果当前状态和此次插入状态一样，则不再插入
            $res = DB::table('team_order')->where('id', $v->id)->get();//dd($res);
            if($res[0]->status != $status){
                $data = DB::table('team_log')->insert([
                    'team_id'=>$v->id,
                    'time'=>$time,
                    'operation' =>$status_log,
                    'team_status'  =>$status,
                ]);
            }
            //团更新
            $res = DB::table('team_order')->where('id', $v->id)->UPDATE([
                'team_code' => $team_code,
                'status' => $status,// 1:成团中，2：已推迟 3：已成团 4:已封团 9：已出行
                'order_rate' => $order_rate,//成团率
                'team_complete_date' => $team_complete_date,//成团日期
                'date_departure'=>$date_departure//没有成团出发日期推后一天
            ]);

        }

        //更新已出行的团和订单
        $dateformerly = date('Y-m-d',$time-24*3600);
        $date3 = strtotime($dateformerly);
        $date4 = $date3 + 24 * 3600;
        $formerly = DB::table('team_order')->whereBetween('date_departure', [$date3, $date4])->where('delete', 0)->where('status',4)->get();
        //dd($formerly);
        foreach($formerly as $k=>$v){
            //用户订单状态更新
            $res = DB::table('order')->where('place_id', $v->place_id)->whereIn('status',[8])->get();
            foreach($res as $k2=>$v2){
                $data = DB::table('order_log')->insert([
                    'order_id'=>$v2->id,
                    'time'=>$time,
                    'operation' =>'已出行',
                    'order_status'  =>9,
                    'member_id'  =>$v2->member_id,
                    'route_id'  =>$v2->route_id,
                ]);
            }
            $res = DB::table('order')->where('place_id', $v->place_id)->where('status',8)->UPDATE([
                'status' => 9,
            ]);

            //将操作过程导入team_log表
            $res = DB::table('team_order')->where('id', $v->id)->get();
            if($res[0]->status != 4){
                $data = DB::table('team_log')->insert([
                    'team_id' => $v->id,
                    'time' => $time,
                    'operation' => '状态变为已出行',
                    'team_status' => 9,
                ]);
            }
            //团更新
            $res = DB::table('team_order')->where('id', $v->id)->whereIn('status',[3])->UPDATE([
                'status' => 9,// 1:成团中，2：已推迟 3：已成团 4:已封团 9：已出行
            ]);

        }
    }
}

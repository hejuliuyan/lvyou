<?php namespace App\Http\Controllers\Admin;
use App\Models\Admin\Team as TeamModel;
use App\Http\Controllers\Home\WxController;
use Request;
use Crypt;
use DB;
use Input;
use App\Models\Common;
/**
 * 发团管理
 */
class TeamController extends Controller
{
    //订单列表
    public function team_list(){
        $model = new TeamModel();
        if(isset($_GET['team_code']) or isset($_GET['team_start']) or isset($_GET['class_code'])){
            $team_select=$_GET['order_select'];
            $class_code=$_GET['class_code'];
            $team_code=$_GET['team_code'];
            $team_start=$_GET['team_start'];
        }else{
            $team_select = '';
            $team_code = '';
            $team_start = '';
            $class_code='';
        }
        $list = $model->team_list($team_select,$team_code,$team_start,$class_code);//dump($list);die;

        return view('admin.team.index')->with('list',$list);
    }

    //订单详情
    public function team_detail(){
        $model = new TeamModel();
        $list = $model->team_detail($_GET['id']);
        return view('admin.team.detail')->with('list',$list);
    }

    //查看基本信息是否完善
    public function team_examine(){
        $data = Request::all();
        $res = DB::table('team_order')->where('id',$data['team_id'])->get();
        if(empty($res[0]->leader_name) || empty($res[0]->leader_phone) || empty($res[0]->driver_name) || empty($res[0]->driver_phone) || empty($res[0]->vehicle_load) || empty($res[0]->plate_num)){
            echo json_encode(false);
        }else{
            echo json_encode(true);
        }
    }
    //编辑保存
    public function team_edit(){
        $data = Request::all();
//        if(!empty($data['back_team'])){
//            $back_team = strtotime($data['back_team']);
//            $manual_oper = 1;
//        }else{
//            $backtoteam= DB::table('team_order')->where('id',$data['team_id'])->pluck('back_team');
//            $back_team = $backtoteam[0];
//            $manual_oper = 0;
//        }
        $res = DB::table('team_order')->where('id',$data['team_id'])->update([
            'leader_name'=>$data['leader_name'],
            'leader_phone'=>$data['leader_phone'],
            'driver_name'=>$data['driver_name'],
            'driver_phone'=>$data['driver_phone'],
            'vehicle_load'=>$data['vehicle_load'],
            'plate_num'=>$data['plate_num'],
//            'backteam_date'=>$back_team,
//            'manual_oper'=>$manual_oper
        ]);
        if($res){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }

    }
    //已成团发送微信消息
    public function admin_send_message(){
        $data = Request::all();
        $team = DB::table('team_order')->where('id',$data['team_id'])->get();
        $place =  DB::table('start_city_place_time')->where('id',$team[0]->place_id)->get();
        $route = DB::table('route')->where('id',$team[0]->route_id)->select('route_name')->get();

        $res = '';
        //给每一个同行人发送微信
        $model = new WxController();
        if(!empty($data['member_id'])){
            foreach($data['member_id'] as $k=>$v){
                $open_id = DB::table('member')->where('id',$v)->select('open_id')->get();
                if(!empty($open_id[0]->open_id)){
                    $start_date = date('Y-m-d H:i',$team[0]->date_departure);
                    $res = $model->admin_send_message($open_id[0]->open_id,$route[0]->route_name,$team[0]->team_code,$team[0]->leader_name,$team[0]->leader_phone,$team[0]->driver_name,$team[0]->driver_phone,$team[0]->vehicle_load,$team[0]->plate_num,$place[0]->start_city_place,$start_date);
                }
            }
        }
        if($res){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }

    }
    //已推迟发送微信消息
    public function postpone_message(){
        $data = Request::all();
        $team = DB::table('team_order')->where('id',$data['team_id'])->get();
        $route = DB::table('route')->where('id',$team[0]->route_id)->select('route_name')->get();

        $res = '';
        //给每一个同行人发送微信
        $model = new WxController();
        if(!empty($data['member_id'])){
            foreach($data['member_id'] as $k=>$v){
                $open_id = DB::table('member')->where('id',$v)->select('open_id')->get();
                if(!empty($open_id[0]->open_id)){
                    $res = $model->postpone_send_message($open_id[0]->open_id,$route[0]->route_name,$team[0]->class_code,$data['message']);
                }
            }
        }
        if($res){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }

    }

    //关闭团
    public function close_team(){
        $info = Request::all();
        $team = DB::table('team_order')->where('id',$info['team_id'])->get();
        $product_cate = DB::table('route')->where('id',$team[0]->route_id)->get();
        $orders = DB::table('order')->where('route_id',$team[0]->route_id)->where('place_id',$team[0]->place_id)->whereIn('status',[2,7])->get();

        foreach($orders as $key=>$val){
            if($product_cate[0]->product_cate == 2 && $val->pay_way == 1){

                //会员免费订单不需审核
                $data1 = DB::table('member')->where('id',$val->member_id)->increment('balance_num',$product_cate[0]->require_num);
                $data2 = DB::table('member')->where('id',$val->member_id)->increment('virtual_num',$product_cate[0]->require_num);
                $data3 = DB::table('order')->where('id',$val->id)->update([
                    'status' => 5,
                ]);
                //将操作过程导入log表
                $data4 = DB::table('order_log')->insert([
                    'order_id'=>$val->id,
                    'time'=>time(),
                    'operation' =>'【会员机会】后台手动退单退款',
                    'order_status'  =>5,
                    'member_id'  =>$val->member_id,
                    'route_id'  =>$val->route_id,
                ]);

            }else{
                DB::table('order')->where('id',$val->id)->where('member_id',$member_id[0])->update([
                    'status' => 3,
                ]);
                //将操作过程导入log表
                $data = DB::table('order_log')->insert([
                    'order_id'=>$val->id,
                    'time'=>time(),
                    'operation' =>'后台关闭团申请退单',
                    'order_status'  =>3,
                    'member_id'  =>$val->member_id,
                    'route_id'  =>$val->route_id,
                ]);

            }
        }
        //同一时间，同一地点  一个团代号
        //支付订单时团的数据改变
        $order_confirm = DB::table('order')->where('route_id',$team[0]->route_id)->where('place_id',$team[0]->place_id)->whereIn('status',[2,7])->get();

        if(empty($order_confirm)) {
            $data = DB::table('team_log')->insert([
                        'team_id'=>$info['team_id'],
                        'time'=>time(),
                        'operation' =>'后台手动关闭团',
                        'team_status'  =>1,
                    ]);
            $res = DB::table('team_order')->where('id',$info['team_id'])->UPDATE([
                'status' => 6,// // 1:成团中，2：已推迟 3：已成团 4:已封团 6:已关闭 9：已出行
                'order_rate' => 0,//成团率
                'travel_num' => 0,//出行人数
                'delete' =>1

            ]);
            if($res){
                return json_encode(true);
            }else{
                return json_encode(false);
            }
        }else{
            return json_encode(false);
        }
    }


}
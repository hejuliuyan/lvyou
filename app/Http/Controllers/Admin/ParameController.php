<?php namespace App\Http\Controllers\Admin;
use App\Models\Admin\Paramecontent as ParameModel;
use App\Models\Admin\Access as AccessModel;
use Request;
use Crypt;
use DB;
use Input;



/**
 * 参数管理
 */
class ParameController extends Controller
{
    //会员管理页面
    public function member_parame(){
        $res = DB::table('const')->pluck('leader_num');
        $data[] = $res[0];
        $data[] = DB::table('member_label')->get();
        return view('admin.parame.member_parame')->with('data',$data);
    }
    //会员管理页面提交
    public function member_parame_post(){
        $data = Request::all();
        $res = DB::table('const')->update(['leader_num'=>$data['mem_parame']]);
        //所有组长满足的为组长，不满足的角色降为组员
        $leaders = DB::table('member')->whereNotNull('leader_id')->where('reg_check','=',1)->where('active','=',0)->where('delete','=',0)->groupBy('leader_id')->select('leader_id')->get();
        foreach($leaders as $k=>$v){
            $members = DB::table('member')->where('leader_id','=',$v->leader_id)->where('reg_check','=',1)->where('active','=',0)->where('delete','=',0)->count();
            if($members >= $data['mem_parame']){
                $result = DB::table('member')->where('id','=',$v->leader_id)->update(['role'=>0]);
            }else{
                $result = DB::table('member')->where('id','=',$v->leader_id)->update(['role'=>1]);
            }
        }
        echo json_encode($res);
    }
    //用户标签提交
    public function member_label_post(){
        $data = Request::all();
        $val = DB::table('member_label')->where('delete','=',0)->select('member_label')->get();
        $member_label = array();
        foreach($val as $k =>  $v){
            $member_label[] = $v->member_label;
        }
        if(in_array(trim($data['member_label_val']),$member_label)){
            echo json_encode('repeat');die;
        }
        $res = DB::table('member_label')->insertGetId(['member_label'=>$data['member_label_val']]);

        echo json_encode($res);
    }

    public function member_label_del(){
        $data = Request::all();
        $res = DB::table('member_label')->where('id','=',$data['member_label_id'])->update(['delete'=>1]);
        echo json_encode($res);
    }

    //线路管理页面
        public function route_parame(){
            $data = array();
            $route_label = DB::table('route_label')->where('delete','=',0)->get();
            $traffic = DB::table('traffic')->where('delete','=',0)->get();
            $destination = DB::table('destination')->where('delete','=',0)->get();
            $start_city = DB::table('start_city')->where('delete','=',0)->get();
            $data[] = $route_label;
            $data[] = $traffic;
            $data[] = $destination;
            $data[] = $start_city;
            //dd($route_label);
            return view('admin.parame.route_parame')->with('data',$data);
        }
    //线路管理页面提交
    //线路标签提交
    public function route_label_post(){
        $data = Request::all();
        $val = DB::table('route_label')->where('delete','=',0)->select('route_label')->get();
        $route_label = array();
        foreach($val as $k =>  $v){
            $route_label[] = $v->route_label;
        }
        if(in_array($data['route_label'],$route_label)){
            echo json_encode('repeat');die;
        }
        $res = DB::table('route_label')->insertGetId(['route_label'=>$data['route_label']]);

        echo json_encode($res);
    }
    public function route_label_del(){
        $data = Request::all();
        $res = DB::table('route_label')->where('id','=',$data['route_label_id'])->update(['delete'=>1]);
        echo json_encode($res);
    }

    //交通方式提交
    public function traffic_val_post(){
        $data = Request::all();
        $val = DB::table('traffic')->where('delete','=',0)->select('traffic')->get();
        $traffic = array();
        foreach($val as $k =>  $v){
            $traffic[] = $v->traffic;
        }
        if(in_array($data['traffic_val'],$traffic)){
            echo json_encode('repeat');die;
        }
        $res = DB::table('traffic')->insertGetId(['traffic'=>$data['traffic_val']]);

        echo json_encode($res);
    }
    public function traffic_del(){
        $data = Request::all();
        $res = DB::table('traffic')->where('id','=',$data['traffic_id'])->update(['delete'=>1]);
        echo json_encode($res);
    }

    //目的地提交
    public function destination_val_post(){
        $data = Request::all();
        $val = DB::table('destination')->where('delete','=',0)->select('destination')->get();
        $destination = array();
        foreach($val as $k =>  $v){
            $destination[] = $v->destination;
        }
        if(in_array($data['destination_val'],$destination)){
            echo json_encode('repeat');die;
        }
        $res = DB::table('destination')->insertGetId(['destination'=>$data['destination_val']]);
        echo json_encode($res);
    }
    public function destination_del(){
        $data = Request::all();
        $res = DB::table('destination')->where('id','=',$data['destination_id'])->update(['delete'=>1]);
        echo json_encode($res);
    }

    //出发城市提交
    public function start_city_val_post(){
        $data = Request::all();
        $val = DB::table('start_city')->where('delete','=',0)->select('start_city')->get();
        $start_city = array();
        foreach($val as $k =>  $v){
            $start_city[] = $v->start_city;
        }
        if(in_array($data['start_city_val'],$start_city)){
            echo json_encode('repeat');die;
        }
        $res = DB::table('start_city')->insertGetId(['start_city'=>$data['start_city_val']]);
        echo json_encode($res);
    }
    public function start_city_del(){
        $data = Request::all();
        $res = DB::table('start_city')->where('id','=',$data['start_city_id'])->update(['delete'=>1]);
        echo json_encode($res);
    }

}
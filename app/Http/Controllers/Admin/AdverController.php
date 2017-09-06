<?php namespace App\Http\Controllers\Admin;
use App\Models\Admin\Adver as AdverModel;
use Request;
use Crypt;
use DB;
use Input;
/**
 * 广告管理
 */
class AdverController extends Controller
{
    public function advertisement(){
        $res = DB::table('advertise')->where('delete',0)->get();
        return view('admin.adver.adver')->with('data',$res);
    }

    //广告 线路编号提交
    public function adver_post(){
        $data = Request::all();
        $val = DB::table('advertise')->where('delete','=',0)->select('route_code')->get();
        if(count($val)>=3){
            echo json_encode('overflow');die;
        }
        $member_label = array();
        foreach($val as $k =>  $v){
            $member_label[] = $v->route_code;
        }
        if(in_array(trim($data['member_label_val']),$member_label)){
            echo json_encode('repeat');die;
        }

        $result = DB::table('route')->where('code',trim($data['member_label_val']))->where('delete',0)->get();

        if(empty($result[0])){
            echo json_encode('null');die;
        }
        $res = DB::table('advertise')->insertGetId([
            'route_code'=>$data['member_label_val'],
            'route_id' =>$result[0]->id,
            'route_name' =>$result[0]->route_name
        ]);
        $route_name = $result[0]->route_name;
        echo json_encode($route_name);
    }

    public function adver_del(){
        $data = Request::all();
        $res = DB::table('advertise')->where('id','=',$data['member_label_id'])->update(['delete'=>1]);
        echo json_encode($res);
    }
}
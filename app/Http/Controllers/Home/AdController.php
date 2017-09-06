<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use Request;
use Crypt;
use DB;
use Input;
class AdController extends Controller
{
    public function ad(){
        $data = DB::table('advertise')->where('delete',0)->limit(3)->get();
        $res = array();
        foreach($data as $k=>$v){
            $res[]=  DB::table('route')->where('id',$v->route_id)->get();
        }
        return json_encode($res);
    }
}
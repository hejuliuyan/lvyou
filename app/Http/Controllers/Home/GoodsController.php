<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Request;
use Illuminate\Support\Facades\DB;
use App\Models\Home\Goods as GoodsModel;

class GoodsController extends Controller
{
    /**
     *  首页商品加载
     */
    public function goodslist()
    {
            $page=Request::input('page');
            $offset=($page-1)*5;
            $list=DB::table('route')->select('id', 'route_name','picture')
                ->offset($offset)->limit(5)
                ->get();
            echo json_encode($list);
    }
    //查询商品页数总量
    public function num()
    {
        $num=DB::table('route')->count();
        $num=ceil($num/5);
        return $num;
    }
    //门票排序查询
    public function tiaojian()
    {
        header('content-type:text/html;charset=utf-8');
        $tiaojian=Request::input('tiaojian');
        $page=Request::input('page');
        $num=5;
        $paixu=new GoodsModel();
        $rest=$paixu->paixu($tiaojian,$page,$num);
//        print_r($rest);exit;
        echo json_encode($rest);
    }
}
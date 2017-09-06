<?php namespace App\Http\Controllers\Admin;
use App\Models\Admin\Order as OrderModel;
use Request;
use Crypt;
use DB;
use Input;



/**
 * 订单管理
 */
class OrderController extends Controller
{
    //订单列表
    public function order_list(){
        $model = new OrderModel();
        if(isset($_GET['order_code']) or isset($_GET['mobile']) or isset($_GET['class_code']) or isset($_GET['group_code'])){
            $order_select=$_GET['order_select'];
            $order_code=$_GET['order_code'];
            $mobile=$_GET['mobile'];
            $class_code=$_GET['class_code'];
            $group_code=$_GET['group_code'];
        }else{
            $order_select = '';
            $order_code = '';
            $mobile = '';
            $class_code = '';
            $group_code='';
        }
        $list = $model->order_list($order_select,$order_code,$mobile,$class_code,$group_code);//dump($list);die;

        return view('admin.order.index')->with('list',$list);
    }

    //订单详情
    public function order_detail(){
        $model = new OrderModel();
        $list = $model->order_detail($_GET['id']);
        return view('admin.order.detail')->with('list',$list);
    }

    //订单退单审核
    public function order_back_check(){
        $data = Request::all();
        $model = new OrderModel();
        $data = $model->order_back_check($data['order_id']);
        echo json_encode($data);

    }
    //订单退款审核
    public function order_back_money(){
        $data = Request::all();
        $model = new OrderModel();
        $data = $model->order_back_money($data['order_id']);
        echo json_encode($data);

    }









}
<?php namespace App\Http\Controllers\Admin;
use App\Models\Admin\Memcontent as MemModel;
use App\Models\Admin\Access as AccessModel;
use Request;
use Crypt;
use DB;
use Input;
use Illuminate\Support\Facades\Session;


/**
 * 会员管理
 * @task 37
 * @author deng 2016-6-30 19：47
 */
class MemController extends Controller
{
    /**
     * 会员管理页面
     */
    public function ad_members(){
        $model = new Memmodel();
        if(isset($_GET['search_phone']) or isset($_GET['search_idcard'])){
            $search_phone=$_GET['search_phone'];
            $search_idcard=$_GET['search_idcard'];
            Session::put('search_phone',$search_phone);
            Session::put('search_idcard',$search_idcard);
        }else{
            //$data='';
            $search_phone = '';
            $search_idcard = '';
        }
        $list = $model->members($search_phone,$search_idcard);//dump($list);die;
        return view('admin.members.index')->with('list',$list);
    }


    /**
     * 会员编辑页面
     */
    public function mem_edit_view(){
        $data['id']=$_GET['id'];
        $model = new Memmodel();
        $res = $model->mem_edit($data);
        //error_log(print_r($res,true));
        return view('admin.members.edit')->with('data',$res);
    }
    /**
     * 会员密码重置
     */
    public function reset_password(){
        $pass = '';
        $str = "0123456789abcdefghijklmnopqrstuvwxyz";//输出字符集
        $len = strlen($str) - 1;
        $le = 8;
        for($k = 0; $k < $le; $k++) {
            $pass.= $str[rand(0, $len)];
        }
        $password = $pass;
        $pass= Crypt::encrypt($pass);
        $model = new Memmodel();
        $res = $model->pass_post($_POST,$pass);
        if($res == true){
            echo json_encode($password);
        }else{
            echo json_encode(false);
        }

    }
    /**
     * 继续充值
     */
    public function recharge_num(){
        $info = Request::all();
        $res1 = null;
        $res2 = null;
        $res3 = null;
        if(!empty($info['recharge_num'])){
            $res1 = DB::table('member')->where('id',$info['id'])->increment('recharge_num',$info['recharge_num']);
            $res2 = DB::table('member')->where('id',$info['id'])->increment('balance_num',$info['recharge_num']);
            $res3 = DB::table('member')->where('id',$info['id'])->increment('virtual_num',$info['recharge_num']);
        }

        if($res1 && $res2 && $res3){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }

    }
    /**
     * 编辑提交
     */
    public function edit_post(){
        //$data = Input::all();
        $model = new Memmodel();
        $res = $model->edit_post($_POST);
        //dd($res);
        echo json_encode($res);
    }

    public function mem_add_view(){
        $model = new Memmodel();
        $res = $model->add_info();
        return view('admin.members.add')->with('data',$res);
//        if(!$_POST){

//        }else{
//            $data = $_POST;//dd($data);
//            $data['id']=$_GET['id'];
//            $model = new Memmodel();
//            $res = $model->mem_add($data);
//        }

    }
    //新增提交
    public function mem_add()
    {
        //$data = $_POST['account'];
        $data = Request::all();//接受ajax的值
        $model = new Memmodel();
        $res = $model->mem_add_post($data);
        echo json_encode($res);
    }

    //禁用用户
    public function user_stop(){
        $data = Request::all();
        $id = $data['id'];
        $active = $data['active'];

        if($active==1){
            $active=0;
        }elseif($active==0){
            $active=1;
        }

        $d = DB::table('member')->where('id','=',$id)->update(array('active'=>$active));

        if($d){
            echo json_encode($active);
        }else{
            echo json_encode(false);
        }


    }


    /**
     * ajax验证新增会员身份证号是否重复
     */
    public function id_card(){
        $data = Request::all();
        $model = new Memmodel();
        $res = $model->id_card_search($data);
        echo json_encode($res);
    }
    /**
     * ajax验证新增会员身份证号是否重复
     */
    public function ajax_mobile(){
        $data = Request::all();
        $model = new Memmodel();
        $res = $model->mobile_search($data);
        echo json_encode($res);
    }

    //审核用户
    public function reg_check(){
        $data = Request::all();
        $id = $data['id'];
        $reg_check = $data['reg_check'];

        if($reg_check==0){
            $member = DB::table('member')->where(array('id'=>$id))->get();
            //存在leader_id则执行判断是否达到组长标准操作
            if($member[0]->leader_id){
                $rated_num = DB::table('const')->pluck('leader_num');
                $leader_num = DB::table('member')->where(array('leader_id'=> $member[0]->leader_id,'role'=>1,'delete'=>0))->count();
                $leader_num = $leader_num+1;
                if($leader_num >= $rated_num[0]){
                    DB::table('member')->where('id', $member[0]->leader_id)->update(['role' => 0]);
                }
            }
            if($member[0]->old_user){
                $d = DB::table('member')->where('id','=',$id)->update(array('reg_check'=>1));
            }else{
                $d = DB::table('member')->where('id','=',$id)->update(array('reg_check'=>1,'recharge_num'=>3,'balance_num'=>3,'virtual_num'=>3));
            }

            if($d){
                echo json_encode(1);
            }else{
                echo json_encode(false);
            }
        }





    }

    //用户删除
    public function user_delete(){
        $data = Request::all();
        $id = $data['id'];
        //$delete = $data['delete'];

        $d = DB::table('member')->where('id','=',$id)->update(array('delete'=>1));

        if($d){
            echo json_encode(1);
        }else{
            echo json_encode(false);
        }


    }


}
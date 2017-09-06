<?php namespace App\Models\Admin;

use App\Models\Admin\Base;
use DB;
use Crypt;
/**
 * 会员管理
 *
 * @author deng
 */
class Memcontent extends Base
{
    /**
     * 会员管理页面
     */
    public function members($search_phone,$search_idcard)
    {
        if ($search_phone or $search_idcard) {
            $data = DB::table('member')->where(array('mobile'=>$search_phone,'delete'=>0))->orWhere(array('id_card'=>$search_idcard,'delete'=>0))->select('id', 'account','real_name', 'mobile', 'created_at','update_at', 'active','delete','reg_check')->orderBy('update_at', 'desc')->paginate(10);
            foreach ($data as $k => $v) {
                if(empty($v->mobile)){
                    unset( $data[$k] );continue;
                }
                $v->created_at = date('Y-m-d', $v->created_at);
                $v->update_time  =date('Y-m-d H:i:s', $v->update_at);
                if ($v->active == 0) {
                    $v->new_status = '已启用';
                } else {
                    $v->new_status = '已禁用';
                }
                if($v->reg_check ==1){
                    $v->new_check='已审核';
                }else{
                    $v->new_check='未审核';
                }

            }

        } else {
            $data = DB::table('member')->select('id', 'account', 'real_name','mobile', 'created_at','update_at','active','delete','reg_check')->where('mobile','!=','')->where('delete', '=', 0)->orderBy('update_at', 'desc')->paginate(10);
            foreach ($data as $k => $v) {
                $v->created_at = date('Y-m-d', $v->created_at);
                $v->update_time  =date('Y-m-d H:i:s', $v->update_at);
                if ($v->active == 0) {
                    $v->new_status = '已启用';
                } else {
                    $v->new_status = '已禁用';
                }
                if($v->reg_check ==1){
                    $v->new_check='已审核';
                }else{
                    $v->new_check='未审核';
                }
            }
        }

        return $data;
    }


    /**
     * 会员详情
     */
    public function mem_edit($data)
    {
        $data = DB::table('member')->where('id', '=', $data['id'])->get();
        //操作员编号转化为真实姓名
//        $maintainer = $data[0]->maintainer;
//        $maintainer = DB::table('users')->where('id','=',$maintainer)->value('real_name');
//        $data[0]->maintainer = $maintainer;
        //组长手机号：
        if($data[0]->leader_id){
            $leader_id = $data[0]->leader_id;
            $leader_phone =  DB::table('member')->where('id', '=', $leader_id)->pluck('mobile');
            if(!empty($leader_phone)){
                $data[0]->leader_phone = $leader_phone[0];
            }else{
                $data[0]->leader_phone = NULL;
            }
        }else{
            $data[0]->leader_phone = NULL;
        }

        //性别转化
        $sex = $data[0]->sex;
        if($sex == 1){
            $data[0]->sex = '男';
        }elseif($sex == 2){
            $data[0]->sex = '女';
        }else{
            $data[0]->sex = '保密';
        }
        //角色转化
        $role = $data[0]->role;
        if($role == 0){
            $data[0]->role = '组长';
        }else{
            $data[0]->role = '组员';
        }
        //创建时间转化
        $created_at = $data[0]->created_at;
        if(empty($created_at)){
            $data[0]->created_at = date('Y-m-d H:i:s',time());
        }else{
            $data[0]->created_at =date('Y-m-d H:i:s',$data[0]->created_at);
        }
        //更新时间转化
        $update_at = $data[0]->update_at;
        if(empty($update_at)){
            $data[0]->update_at = '暂无更新';
        }else{
            $data[0]->update_at =date('Y-m-d H:i:s',$data[0]->update_at);
        }
        //用户标签
        if(!empty($data[0]->member_label)){
            $label = explode(',',$data[0]->member_label);
            $member_label = array();
            foreach($label as $k2=>$v2){
                $labeltemp = DB::table('member_label')->where('id',$v2)->pluck('member_label');
                $member_label[] = $labeltemp[0];
            }
            $member_label = implode(',',$member_label);
        }else{
            $member_label ='无';
        }


        $data[0]->member_label = $member_label;
        //dump($data);die;
        if ($data) {
            return $data;
        } else {
            return false;
        }

    }
    /**
     * 密码重置
     */
    public function pass_post($id,$pass)
    {
        $data = DB::table('member')->where('id', '=', $id)->update(array('password' =>$pass));
        if ($data) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * 会员修改提交
     */
    public function edit_post($data)
    {
        $datetime = time();
        $data = DB::table('member')->where('id', '=', $data['id'])->update(array('remark' => $data['remark'],'update_at'=>$datetime,'maintainer' =>$data['maintainer']));
        if ($data) {
            return true;
        } else {
            return false;
        }
    }
    //新增前信息初始化
    public function add_info()
    {
        $data = DB::table('users')->select('id')->get();
        return $data;
    }
    public function mem_add_post($data)
    {
        //密码
        $pass = '';
        $token= '';
        $s = '';
        $str = "0123456789abcdefghijklmnopqrstuvwxyz";//输出字符集
        $len = strlen($str) - 1;
        $le = 8;
        $lle= 4;
        $n = 6;//输出串长度
        $time = (string)time();
        for ($k = 0; $k < $le; $k++) {
            $pass.= $str[rand(0, $len)];
        }

        for ($g = 0; $g < $lle; $g++) {
            $token.= $str[rand(0, $len)];
        }

        $pass  =  Crypt::encrypt($pass);
        $token =  $token.$time;
        if(empty($data['account'])){
//            for ($i = 0; $i < $n; $i++) {
//                $s .= $str[rand(0, $len)];
//            }
//            $s = 'el'. $s;
//            $account = $s;
            $account = '';
        }else{
            $account = $data['account'];
        }
        //组长信息：
        //$leader_id =  DB::table('member')->where('mobile', '=', $data['leader_phone'])->pluck('id');
        if(empty($data['leader_phone'])){
            $leader_id = NULL;
        }else{
            $leader_id = DB::table('member')->where('mobile', '=', $data['leader_phone'])->pluck('id');
            if(!empty($leader_id[0])){
                $leader_id = $leader_id[0];
                //改为审核时判断
                //从leader_num数据库查询成为组长所需额定人数
//                $rated_num = DB::table('const')->pluck('leader_num');
//                $leader_num = DB::table('member')->where(array('leader_id'=> $leader_id,'delete'=>0))->count();
//                $leader_num = $leader_num+1;
//                if($leader_num >= $rated_num[0]){
//                    DB::table('member')->where('id', $leader_id)->update(['role' => 0]);
//                }
            }else{
                return 'null';die;
            }
        }
        $datetime = time();
        if(empty($data['sex'])){
            $sex = 1;
        }else{
            $sex = $data['sex'];
        }
        if(empty($data['role'])){
            $role = 1;
        }else{
            $role = $data['role'];
        }
        if(empty($data['active'])){
            $active = 0;
        }else{
            $active = $data['active'];
        }
        $res = DB::table('member')->insert(
            [
            'account' => $account,
            'real_name' => $data['real_name'],
            'member_card' => $data['member_card'],
            'id_card' => $data['id_card'],
            'sex' => $sex,
            'role' => $role,
            'mobile' => $data['mobile'],
            'address' => $data['address'],
            'leader_id' => $leader_id,
            'integral' => $data['integral'],
            'recharge_num' => $data['recharge_num'],
            'balance_num' => $data['balance_num'],
            'scenic01' => $data['scenic01'],
            'scenic02' => $data['scenic02'],
            'scenic03' => $data['scenic03'],
            'active' => $active,
            'remark' => $data['remark'],
            //'maintainer' => $data['maintainer'],
            'created_at' => $datetime,
             'update_at' => $datetime,
            'password' => $pass,
            'token_id' => $token,
            'reg_check'=> 0
            ]);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * ajax验证新增会员身份证号是否重复
     */
    public function id_card_search($data){
        $res = DB::table('member')->where('id_card','=',$data['id_card'])->get();
        if($res){
            return false;
        }else{
            return true;
        }
    }

    /**
     * ajax验证新增会员手机号是否重复
     */
    public function mobile_search($data){
        $res = DB::table('member')->where('mobile','=',$data['mobile'])->get();
        if($res){
            return false;
        }else{
            return true;
        }
    }























    /**
     * 会员编辑
     */
    public function mem_edit_view($data)
    {
        $data = DB::table('member')->where('id','=',$data['id'])->get();
        //$shop = DB::table('shop')->get();
        foreach ($data as $k => $v) {
            foreach ($shop as $key => $val) {
                if ($v->shop_id == $val->id) {
                    $data[$k]->shop_name = $val->shop_name;
                }
            }
        }
        foreach ($data as $k => $v) {
            $v->created_at = date('Y-m-d', $v->created_at);
            $v->updated_at = date('Y-m-d', $v->updated_at);
            if ($v->active == 0) {
                $v->new_status = '启用';
            } else {
                $v->new_status = '禁用';
            }
        }

        return $data;

    }


    /**
     * 会员检索
     */
    public function mem_search($data)
    {
        if ($data['phone']) {
            $data = DB::table('cp_member')->where('mobile', '=', $data['phone'])->select('id', 'account', 'mobile', 'created_at', 'active')->get();

            foreach ($data as $k => $v) {
                $v->created_at = date('Y-m-d', $v->created_at);
                if ($v->active == 0) {
                    $v->new_status = '启用';
                } else {
                    $v->new_status = '禁用';
                }
            }
        } else {
            $data = DB::table('cp_member')->select('id', 'account', 'mobile', 'created_at', 'active')->paginate(3);
            //error_log(print_r($data,true));

            foreach ($data as $k => $v) {
                $v->created_at = date('Y-m-d', $v->created_at);
                if ($v->active == 0) {
                    $v->new_status = '启用';
                } else {
                    $v->new_status = '禁用';
                }
            }
        }


        if ($data) {
            return $data;
        } else {
            return false;
        }

    }

}
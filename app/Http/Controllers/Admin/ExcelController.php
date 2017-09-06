<?php namespace App\Http\Controllers\Admin;

use App\Models\Admin\Excel as ExcelModel;
use Request;
use Log;
use Excel;
use DB;
use Storage;
use Input;
use Crypt;
use Illuminate\Support\Facades\Session;


/**
 * 首页
 *
 * @author deng
 */
class ExcelController extends Controller
{
    /**
     * Excel导出
     */
    public function export(){
        $search_phone = Session::get('search_phone');
        $search_idcard = Session::get('search_idcard');
        if ($search_phone or $search_idcard) {
            $d = DB::table('member')->where(array('mobile'=>$search_phone,'delete'=>0))->orWhere(array('id_card'=>$search_idcard,'delete'=>0))->select('account','id_card','mobile','password','real_name')->orderBy('update_at', 'desc')->paginate(10);
            foreach ($d as $k => $v) {
                if(empty($v->mobile)){
                    unset( $d[$k] );continue;
                }
            }
            $pass = $v->password;
            $v->new_pass =Crypt::decrypt($pass);
            $title = '会员表';
        }else{
            $d = DB::table('member')->select('account','id_card','mobile','password','real_name')->get();//
            $title = '会员表';
            foreach($d as $k=>$val){
                if(empty($val->mobile)){
                    unset( $d[$k] );continue;
                }
                $pass = $val->password;
                $val->new_pass =Crypt::decrypt($pass);
                //echo "<script>alert($val->new_pass);</script>";
            }

        }
        //dd($d);

        //将检索出来的数据导出
        $cellData=[];
        foreach ($d as $key => $value) {
            $cellData[]  = array(
                '账户号' => $value->account,
                '姓名'   => $value->real_name,
                '手机号' => $value->mobile,
                '密码'   => $value->new_pass,
                '身份证' => $value->id_card,
            );

        }

        Session::put('sheet_name',$title);
        Session::forget('search_phone');
        Session::forget('search_idcard');
        Excel::create($title,function($excel) use ($cellData){
            $sheet_name = Session::get('sheet_name');//echo "<script>alert('$sheet_name');</script>";
            $excel->sheet($sheet_name, function($sheet) use ($cellData){
                $sheet->fromArray($cellData);

            });

        })->export('xlsx');

    }

    /**
     * Excel导入
     */
    public function import(){
        //$file = Storage::get('excel');echo "<script>alert('aa');</script>";
        //$file = $_FILES['excel'];//
        $file = Input::file ( 'excel' );//接收文件
        $allowed_extensions = [ //文件类型
            "xlsx",
        ];
        //判断文件类型
        if ($file->getClientOriginalExtension () && ! in_array ( $file->getClientOriginalExtension (), $allowed_extensions )) {
            return [
                'error' => 'You may only upload xlsx.'
            ];
        }
        //文件路径
        $destinationPath = 'uploads/files/';
        $extension = $file->getClientOriginalExtension ();
        $fileName = time () . '.' . $extension;//设置文件名称
        $file->move ( $destinationPath, $fileName );//移动文件
        $filePath = 'public/uploads/files/'.$fileName;
        Excel::load($filePath, function($reader) {

            $count=$reader->getSheetCount();
            $vp=[];//echo "<script>alert('$count');</script>";die;

            for($i=0;$i<$count;$i++){

                $results = $reader ->getSheet($i);
                $edu_title = $results ->getTitle();
                $results = $results ->toArray();
                foreach ($results as $k => $val) {
                    if($k>0){
                        //判断手机号是否重复
                        $phone_info = DB::table('member')->where('delete',0)->select('mobile')->distinct()->get();
                        $vv=[];
                        foreach ($phone_info as $kl => $vo) {
                            $vv[]=$vo->mobile;
                        }

                        if(in_array($val[6], $vv)){

                            $vp[]='第'.($i+1).'张表的第'.$val[0].'号【手机号】已存在';
                            echo "
	        		                <script>
	        			                alert('第'+($i+1)+'张表的第'+$val[0]+'号【手机号】已存在');
	        	 	                </script>
		                         ";
                            continue;
                        }
                        //判断身份证号是否重复
                        $id_card = DB::table('member')->where('delete',0)->select('id_card')->distinct()->get();
                        foreach ($id_card as $k2 => $vo2) {
                            $vv2[]=$vo2->id_card;
                        }
                        if(in_array($val[5], $vv2)){
                            $vp[]='第'.($i+1).'张表的第'.$val[0].'号【身份证号】已存在';
                            echo "
	        		                <script>
	        			                alert('第'+($i+1)+'张表的第'+$val[0]+'号【身份证号】已存在');
	        	 	                </script>
		                         ";
                            continue;
                        }
                        //判断会员卡号是否重复
//                        $member_card = DB::table('member')->select('member_card')->distinct()->get();
//                        foreach ($member_card as $k3 => $vo3) {
//                            $vv3[]=$vo3->member_card;
//                        }
//                        if(in_array($val[2], $vv3)){
//                            $vp[]='第'.($i+1).'张表的第'.$val[0].'号【会员卡号】已存在';
//                            continue;
//                        }
                        //维护人转换
                        //入会创建时间：
                        if($val[8]){
                            $create_time = strtotime($val[8]);
                        }else{
                            $create_time = time();
                        }
                        //性别转换
                        if($val[5] && $val[6]){
                            if($val[4]=='男'){
                                $sex=1;
                            }elseif($val[4]=='女'){
                                $sex=2;
                            }else{
                                $sex=0;
                            }
                            //密码及token随机数
                            $pass = '';
                            $token= '';
                            $str = "0123456789abcdefghijklmnopqrstuvwxyz";//输出字符集
                            $len = strlen($str) - 1;
                            $le = 8;
                            $lle= 4;
                            $n = 6;//输出串长度
                            $time = (string)time();
//                            for ($k = 0; $k < $le; $k++) {
//                                $pass.= $str[rand(0, $len)];
//                            }

                            for ($g = 0; $g < $lle; $g++) {
                                $token.= $str[rand(0, $len)];
                            }
                            //随机account
                            $s = '';
                            for ($i = 0; $i < $n; $i++) {
                                $s .= $str[rand(0, $len)];
                            }
                            if(is_numeric(substr($val[5],-1,1))){
                                $pass = substr($val[5],-6,6);
                            }else{
                                $pass = substr($val[5],-7,6);
                            }

                            $pass  =  Crypt::encrypt($pass);

                            $token =  $token.$time;
                            //随机account
                            for ($i = 0; $i < $n; $i++) {
                                $s .= $str[rand(0, $len)];
                            }
                            $s = 'el'. $s;
                            $account = $s;
                            $dd = DB::table('member')->insertGetId(array(

                                'maintainer'     =>  $val[1],
                                'member_card'    =>  $val[5],
                                'real_name'      =>  $val[3],
                                'sex'            =>  $sex,
                                'id_card'        =>  $val[5],
                                'mobile'         =>  $val[6],
                                'address'        =>  $val[7],
                                'created_at'     =>  $create_time,
                                'recharge_num'	 =>  $val[9],
                                'balance_num'	 =>  $val[10],
                                'virtual_num'	 =>  $val[10],
                                'integral'	     =>  $val[11],
                                'scenic01'		 =>  $val[12],
                                'scenic02'  	 =>  $val[13],
                                'scenic03'		 =>  $val[14],
                                'remark'		 =>  $val[15],
                                'account'        =>  '',
                                'pic'            =>  NULL,
                                'password'	     =>  $pass,
                                'role'           =>  1,
                                'leader_id'		 =>	 NULL,
                                'update_at'	     =>  time(),
                                'open_id'		 =>  NUll,
                                'token_id'	     =>  $token,
                                'old_user'       =>1,
                                'reg_check'       =>0,
                                'active'		 =>  0,


                            ));

                        }

                    }

                }
            }

            //var_dump($vp);die();
            //Session::flash('re_data',$vp);


        });
//        if(!empty($dd)){
        echo "
	        		<script>
	        			alert('导入成功');
	        			location.href='/index.php/ad_members';

	        	 	</script>
		        ";//刷新页面
//        }else{
//            echo "
//	        		<script>
//	        			alert('导入失败');
//	        			location.href='/index.php/ad_members';
//	        	 	</script>
//		        ";//刷新页面
//        }


    }


    /**
     * Excel导入重复数据提示
     */

    public function import_error(){
        if(Session::has('re_data')){
            $data = Session::get('re_data');
            echo json_encode($data);
        }else{
            echo json_encode(false);
        }
    }

    /**
     * 用户禁止
     */

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



}
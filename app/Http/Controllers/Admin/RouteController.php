<?php namespace App\Http\Controllers\Admin;
use App\Models\Admin\Route as RouteModel;
use App\Models\Admin\Access as AccessModel;
use Request;
use Crypt;
use DB;
use Input;



/**
 * 线路管理
 */
class RouteController extends Controller
{

    /**
     * 线路列表管理页面
     */
    public function route_list(){

        $info = [];
        $info['product_cate'] = trim(Request::input('product_cate'));
        $info['route_name'] = trim(Request::input('route_name'));
        $info['route_code'] = trim(Request::input('route_code'));

        $list = DB::table('route')
            ->join('traffic', 'route.traffic', '=', 'traffic.id')
            ->where(function($query) use ($info){
                if(!empty($info['product_cate'])) {
                    $query->where('route.product_cate', $info['product_cate']);
                }
                if(!empty($info['route_name'])) {
                    $query->where('route_name','like',"%".$info['route_name']."%");
                }
                if(!empty($info['route_code'])) {
                    $query->where('route.route_code', $info['route_code']);
                }
            })
            ->select('route.id', 'route.route_name', 'route.play_way','route.product_cate', 'route.journey_day', 'route.product_cate','traffic.traffic','traffic.id as traffic_id')->paginate(10);//

        foreach ($list as $k => $v) {
            $start_date = DB::table('start_city_place_time')->where('route_id','=',$v->id)->where('start_city_place_date','>',time())->orderBy('start_city_place_date', 'asc')->get();
            if(empty($start_date[0]->start_city_place_date) || $start_date[0]->start_city_place_date ==0){
                $v->new_start_date = '未设时间';
            }else{
                if(count($start_date)>1){
                    $v->new_start_date = date('Y-m-d', $start_date[0]->start_city_place_date).'起';
                }else{
                    $v->new_start_date = date('Y-m-d', $start_date[0]->start_city_place_date);
                }
            }

        }
        return view('admin.route.index', compact('info', 'list'));

    }


    public function route_add_view(){
        $model = new RouteModel();
        $res = $model->route_add_view();
        return view('admin.route.add')->with('list',$res);
    }
    //新增线路提交
    public function route_add_post(){

        header("Content-type: text/html; charset=utf-8");
        $data = Request::all();
        print_r($data);
        if(empty($data['code'])){
            echo "<script>alert('编号不能为空');</script>";
            echo "<script>location.href='/index.php/route_add_view';</script>";
            die;
        }
        if(empty($data['route_name'])){
            echo "<script >alert('线路名称不能为空');</script>";
            echo "<script>location.href='/index.php/route_add_view';</script>";
            die;
        }
        if(empty($data['start_city'])){
            echo "<script >alert('出发城市不能为空');</script>";
            echo "<script>location.href='/index.php/route_add_view';</script>";
            die;
        }
        if(empty($data['route_place_address'])){
            echo "<script >alert('出发地址不能为空');</script>";
            echo "<script>location.href='/index.php/route_add_view';</script>";
            die;
        }else{
            foreach($data['route_place_address'] as $k=>$v){
                if(empty($v)){
                    echo "<script >alert('出发地址不能为空');</script>";
                    echo "<script>location.href='/index.php/route_add_view';</script>";
                    die;
                }
                if(empty($data['cluster_num'][$k])){
                    echo "<script >alert('成团人数不能为空');</script>";
                    echo "<script>location.href='/index.php/route_add_view';</script>";
                    die;
                }
            }
        }



        $val = DB::table('route')->where('delete','=',0)->select('code')->get();
        $code = array();
        foreach($val as $k =>  $v){
            $code[] = $v->code;
        }
        if(in_array($data['code'],$code)){
            echo "<script>alert('编号不能重复');</script>";
            echo "<script>location.href='/index.php/route_add_view';</script>";
            die;
        }
        //判断是否有文件上传
        $file = Input::file ( 'pic' );//接收文件
        if(empty($file)){
            $fileName='';
        }else{
             $allowed_extensions = [ //文件类型
                "png",
                "jpg",
                "gif"
            ];
            //判断文件类型
            if ($file->getClientOriginalExtension () && ! in_array ( $file->getClientOriginalExtension (), $allowed_extensions )) {
                return [
                    'error' => 'You may only upload png, jpg or gif.'
                ];
            }
            //文件路径
            $destinationPath = 'Uploads/pic';
            $extension = $file->getClientOriginalExtension ();
            $fileName = time () . '.' . $extension;//设置文件名称
            $file->move ( $destinationPath, $fileName);//把$destinationPath下的$file文件流重命名为$fileName
        }

        if(isset($data['route_journey'])){
            $route_journey = $data['route_journey'];
        }else{
            $route_journey = NULL;
        }
        if(isset($data['cost_explain'])){
            $cost_explain = $data['cost_explain'];
        }else{
            $cost_explain = NULL;
        }
        if(isset($data['schedule_guide'])){
            $schedule_guide = $data['schedule_guide'];
        }else{
            $schedule_guide = NULL;
        }
        if(empty($data['start_date'])){
             $start_date = time();
        }else{
             $start_date = strtotime($data['start_date']);
        }

        $id = DB::table('route')->insertGetId(
            [
                'picture' => $fileName,
                'code' => $data['code'],
                'rated_price' => $data['rated_price'],
                'discount_price' => $data['discount_price'],
                'start_city' => $data['start_city'],
                'journey_day' => $data['journey_day'],
                'traffic' => $data['traffic'],
                'play_way' => $data['play_way'],
                'require_num' => $data['require_num'],
//                'start_date' => $start_date,
                'product_cate' =>$data['product_cate'],
                'destination' => $data['destination'],
                'route_cate' =>$data['route_cate'],
                'route_label' => $data['route_label'],
                'route_name' => $data['route_name'],
                'route_prompt' => $data['route_prompt'],
                'seventy_allow' => $data['seventy_allow'],
                'route_journey' =>$route_journey,
                'cost_explain' =>$cost_explain,
                'schedule_guide' =>$schedule_guide,
            ]);

        if(!empty($data['route_place_address'])){
            foreach($data['route_place_address'] as $k=>$v){

                //班次编号
                $class_date = substr($data['route_place_date'][$k],0,15);
                $class_date = str_replace('-','',$class_date);
                $class_date = str_replace(':','',$class_date);
                $place_address = mb_substr( $v, 0, 4);
                $class_code = $data['code'].'-'.$class_date.$place_address;
                //
                $result = DB::table('start_city_place_time')->insertGetId(
                    [
                        'route_id'=>$id,
                        'class_code'=>$class_code,
                        'start_city_id' => $data['route_place_id'][$k],
                        'start_city_id' => $data['start_city'],
                        'start_city_place' => $v,
                        'start_city_place_time'=> $data['route_place_time'][$k],
                        'start_city_place_date'=> strtotime($data['route_place_date'][$k]),
                        'cluster_num'=>$data['cluster_num'][$k],
                        'timestamp'=>$data['timestamp'][$k],
                    ]);
                //一个palce_id对应一个团
                $res = DB::table('team_order')->insertGetId(
                    [
                        'route_id'  =>$id,
                        'class_code'=>$class_code,
                        'place_id'  =>$result,
                        'status'    =>1,// 1:成团中，2：已推迟 3：已成团 4：已出行
                        'order_rate'=>0,//成团率
                        'travel_num'    =>0,//出行人数
                        'team_start_date'=>time(),//发团日期
                        'cluster_num'=>$data['cluster_num'][$k],
                        'date_departure'=>strtotime($data['route_place_date'][$k]),//出发日期
                    ]);
                //将操作过程导入team_log表
                $log = DB::table('team_log')->insert([
                    'team_id'=>$res,
                    'time'=>time(),
                    'operation' =>'团创建',
                    'team_status'  =>1,
                ]);
            }
        }







        if($id){
            echo "<script>alert('添加成功');</script>";
            echo "<script>location.href='/index.php/route_list';</script>";//刷新页面
        }else{
            echo "<script>alert('添加失败');</script>";
            echo "<script>location.href='/index.php/route_add_view';</script>";//刷新页面
        }
    }

    //编辑页面
    public function route_edit_view(){
        $data = Request::all();
        $id = $data['id'];
        $model = new RouteModel();
        $res = $model->route_edit_view($id);
        return view('admin.route.edit')->with('list',$res);
    }
    //编辑提交
    public function route_edit_post(){
        header("Content-type: text/html; charset=utf-8");
        $data = Request::all();//dd($data);
//        dd($data['cluster_num']);
        $id = $data['id'];
        if(empty($data['route_name'])){
            echo "<script>alert('线路名称不能为空');</script>";
            echo "<script>location.href='/index.php/route_edit_view?id='+$id;</script>";
            die;
        }

        //判断是否有文件上传,如果没有，则数据库$fileName值不变
        $file = Input::file ( 'pic' );//接收文件
        if(empty($file)){
            $fileName=DB::table('route')->where('id','=',$id)->pluck('picture');
            $fileName=$fileName[0];
        }else{
            $fileName=DB::table('route')->where('id','=',$id)->pluck('picture');
            if(!empty($fileName[0])){
                $file_oldname=DB::table('route')->where('id','=',$id)->pluck('picture');
                $file_oldname=$file_oldname[0];
                unlink('Uploads/pic/'.$file_oldname);
            }
            $allowed_extensions = [ //文件类型
                "png",
                "jpg",
                "gif"
            ];
            //判断文件类型
            if ($file->getClientOriginalExtension () && ! in_array ( $file->getClientOriginalExtension (), $allowed_extensions )) {
                return [
                    'error' => 'You may only upload png, jpg or gif.'
                ];
            }
            //文件路径
            $destinationPath = 'Uploads/pic';
            $extension = $file->getClientOriginalExtension ();
            $fileName = time () . '.' . $extension;//设置文件名称
            $file->move ( $destinationPath, $fileName);//把$destinationPath下的$file文件流重命名为$fileName

        }
        if(isset($data['route_journey'])){
            $route_journey = $data['route_journey'];
        }else{
            $route_journey = NULL;
        }
        if(isset($data['cost_explain'])){
            $cost_explain = $data['cost_explain'];
        }else{
            $cost_explain = NULL;
        }
        if(isset($data['schedule_guide'])){
            $schedule_guide = $data['schedule_guide'];
        }else{
            $schedule_guide = NULL;
        }
        if(empty($data['start_date'])){
            $start_date = time();
        }else{
            $start_date = strtotime($data['start_date']);
        }

        $res = DB::table('route')->where('id',$id)->update(
            [
                'picture' => $fileName,
                //'code' => $data['code'],
                'rated_price' => $data['rated_price'],
                'discount_price' => $data['discount_price'],
//                'start_city' => $data['start_city'],
                'journey_day' => $data['journey_day'],
                'traffic' => $data['traffic'],
                'play_way' => $data['play_way'],
                'require_num' => $data['require_num'],
//                'start_date' => $start_date,
                'product_cate' =>$data['product_cate'],
                'destination' => $data['destination'],
                'route_cate' =>$data['route_cate'],
                'route_label' => $data['route_label'],
                'route_name' => $data['route_name'],
                'route_prompt' => $data['route_prompt'],
                'seventy_allow' => $data['seventy_allow'],
                'route_journey' =>$route_journey,
                'cost_explain' =>$cost_explain,
                'schedule_guide' =>$schedule_guide,
            ]);
        //DB::table('start_city_place_time')->where('route_id',$id)->delete();
        if(!empty($data['route_place_address'])) {
            $code = DB::table('route')->where('id',$id)->pluck('code');
            foreach ($data['route_place_address'] as $k => $v) {
                //班次编号
                $class_date = substr($data['route_place_date'][$k],0,15);
                $class_date = str_replace('-','',$class_date);
                $class_date = str_replace(':','',$class_date);
                $place_address = mb_substr( $v, 0, 4);
                $class_code = $code[0].'-'.$class_date.$place_address;
                //

                $result = DB::table('start_city_place_time')->insertGetId(
                    [
                        'route_id'=>$id,
                        'class_code'=>$class_code,
                        'start_city_id' => $data['route_place_id'][$k],
                        'start_city_place' => $v,
                        'start_city_place_time'=> $data['route_place_time'][$k],
                        'start_city_place_date'=> strtotime($data['route_place_date'][$k]),
                        'cluster_num'=>$data['cluster_num'][$k],
                        'timestamp'=>$data['timestamp'][$k],
                    ]);
                //一个palce_id对应一个团
                $res = DB::table('team_order')->insertGetId([
                    'route_id'  =>$id,
                    'class_code'=>$class_code,
                    'place_id'  =>$result,
                    'status'    =>1,// 1:成团中，2：已推迟 3：已成团 4：已出行
                    'order_rate'=>0,//成团率
                    'travel_num'    =>0,//出行人数
                    'team_start_date'=>time(),//发团日期
                    'cluster_num'=>$data['cluster_num'][$k],
                    'date_departure'=>strtotime($data['route_place_date'][$k]),//出发日期
                ]);
                //将操作过程导入team_log表
                $log = DB::table('team_log')->insert([
                    'team_id'=>$res,
                    'time'=>time(),
                    'operation' =>'团创建',
                    'team_status'  =>1,
                ]);
            }
        }
        if($res){
            echo "<script>alert('修改成功');</script>";
            echo "<script>location.href='/index.php/route_list';</script>";//刷新页面
        }else{
            echo "<script>alert('修改失败');</script>";
            echo "<script>location.href='/index.php/route_edit_view?id='$id;</script>";//刷新页面
        }

    }
    //删除线路
    public function route_delete(){
        $data = Request::All();
        $res = DB::table('route')->where('id','=',$data['id'])->update(['delete'=>1]);
        if($res){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }

    }

    //编辑页面上月下月填充日期
    public function padding_date(){
        $data = Request::All();
        $model = new RouteModel();
        $res = $model->padding_date($data['year'],$data['month'],$data['id']);
        if($res){
            echo json_encode($res,true);
        }
    }

    //删除出发地址日期
    public function padding_date_delete(){
        $data = Request::All();
        $man = DB::table('team_order')->where('place_id','=',$data['space_id'])->pluck('travel_num');
        if($man[0]>0){
            echo json_encode('member');die;
        }else{
            $res = DB::table('start_city_place_time')->where('id','=',$data['space_id'])->update(['delete'=>1]);
            $result = DB::table('team_order')->where('place_id','=',$data['space_id'])->update(['delete'=>1]);
        }
        if($result){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }

    }

}
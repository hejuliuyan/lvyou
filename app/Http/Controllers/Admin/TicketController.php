<?php namespace App\Http\Controllers\Admin;
use App\Models\Admin\Ticket as TicketModel;
use App\Models\Admin\Access as AccessModel;
use Illuminate\Support\Facades\Input;
use Request;
use Crypt;
use DB;



/**
 * 线路管理
 */
class TicketController extends Controller
{

    /**
     * 线路列表管理页面
     */
    public function ticket_list(){
        header("Content-type: text/html; charset=utf-8");
        $tj=Request::input('tj');

        if(empty($tj)){
            $list=DB::table('ticket')->paginate(10);
            $rest=DB::table('route_label')->get();
        }else if(is_numeric($tj)){
            $list=DB::table('ticket')->where('route_label',$tj)->paginate(10);
            $rest=DB::table('route_label')->get();
        }else{
            $list=DB::table('ticket')->where('label',$tj)->paginate(10);
            $rest=DB::table('route_label')->get();
        }
        return view('admin.ticket.index',['list'=>$list,'rest'=>$rest]);
    }


    /**
     * 门票添加页面展示
     */
    public function ticket_add_view(){
            $model = new TicketModel();
            $res = $model->ticket_add_view();
            $res=$res[0];
            return view('admin.ticket.add')->with('list',$res);
    }

    //新增门票提交
    public function ticket_add_post(){
        header("Content-type: text/html; charset=utf-8");
        $data = Request::all();
        $type=$data['type'];
        $price=$data['price'];
        $current_price=$data['current_price'];
        if(empty($data['num'])){
            echo "<script>alert('产品编号不能为空');</script>";
            echo "<script>location.href='/ticket_add_view';</script>";
            die;
        }
        if(empty($data['name'])){
            echo "<script >alert('景点名称不能为空');</script>";
            echo "<script>location.href='/ticket_add_view';</script>";
            die;
        }
        if(empty($data['address'])){
            echo "<script >alert('景点地址不能为空');</script>";
            echo "<script>location.href='/ticket_add_view';</script>";
            die;
        }
        $val = DB::table('ticket')->select('num')->get();
        $code = array();
        foreach($val as $k =>  $v){
            $code[] = $v->num;
        }
        if(in_array($data['num'],$code)){
            echo "<script>alert('编号不能重复');</script>";
            echo "<script>location.href='/ticket_add_view';</script>";
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
        $id = DB::table('ticket')->insertGetId(
            array(
                'num' => $data['num'],
                'label'=>$data['label'],
                'route_label'=>$data['route_label'],
                'name'=>$data['name'],
                'address'=>$data['address'],
                'warn'=>$data['warn'],
                'detail'=>$data['detail'],
                'prompt'=>$data['prompt'],
                'sales'=>'',
                'ticket_picture' => $fileName,
                'time'=>time()
            ));
        $num=count($type);
        for($i=0;$i<$num;$i++){
            DB::table('ticket_price')->insertGetId(
                array(
                    'ticket_id' =>$id,
                    'type'=>$type[$i],
                    'price'=>$price[$i],
                    'current_price'=>$current_price[$i]
                ));
        };
        if($id){
            echo "<script>alert('添加成功');</script>";
            echo "<script>location.href='/ticket_add_view';</script>";//刷新页面
        }else{
            echo "<script>alert('添加失败');</script>";
            echo "<script>location.href='/ticket_add_view';</script>";//刷新页面
        }
    }

    //编辑页面
    public function ticket_edit_view(){
        $data = Request::all();
        $id = $data['id'];
        $model = new TicketModel();
        $res = $model->ticket_edit_view($id);
        $res1 = DB::table('route_label')->get();
        return view('admin.ticket.edit',['list'=>$res,'info'=>$res1]);
    }
    //编辑提交
    public function ticket_edit_post(){
        header("Content-type: text/html; charset=utf-8");
        $data = Request::all();
        $id = $data['id'];
        if(empty($data['name'])){
            echo "<script>alert('线路名称不能为空');</script>";
            echo "<script>location.href='/ticket_edit_view?id='+$id;</script>";
            die;
        }

        //判断是否有文件上传,如果没有，则数据库$fileName值不变
        $file = Input::file ( 'pic' );//接收文件
        if(empty($file)){
            $fileName=DB::table('ticket')->where('ticket_id','=',$id)->pluck('ticket_picture');
            $fileName=$fileName[0];
        }else{
            $fileName=DB::table('ticket')->where('ticket_id','=',$id)->pluck('ticket_picture');
            if(!empty($fileName[0])){
                $file_oldname=DB::table('ticket')->where('ticket_id','=',$id)->pluck('ticket_picture');
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

        $res = DB::table('ticket')->where('ticket_id',$id)->update(
            [
                'num' => $data['num'],
                'label'=>$data['label'],
                'route_label'=>$data['route_label'],
                'name'=>$data['name'],
                'address'=>$data['address'],
                'warn'=>$data['warn'],
                'detail'=>$data['route_journey'],
                'prompt'=>$data['cost_explain'],
                'sales'=>'',
                'ticket_picture' => $fileName,
                'time'=>time()
            ]);
        if($res){
            echo "<script>alert('修改成功');</script>";
            echo "<script>location.href='/ticket_list';</script>";//刷新页面
        }else{
            echo "<script>alert('修改失败');</script>";
            echo "<script>location.href='/ticket_edit_view?id='$id;</script>";//刷新页面
        }

    }
    //删除线路
    public function ticket_delete(){
        $data = Request::All();
        $res = DB::table('ticket')->where('ticket_id','=',$data['id'])->delete();
        $rest=DB::table('ticket_price')->where('ticket_id',$data['id'])->delete();
        if($res){
            echo "<script>alert('删除成功');</script>";
            echo "<script>location.href='/ticket_list';</script>";//刷新页面
        }else{
            echo "<script>alert('修改失败');</script>";
            echo "<script>location.href='/ticket_list';</script>";//刷新页面
        }
    }


}
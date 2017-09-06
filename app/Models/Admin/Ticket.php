<?php namespace App\Models\Admin;

use App\Models\Admin\Base;
use DB;
use Crypt;
/**
 * 会员管理
 *
 * @author sun
 */
class Ticket extends Base
{
    //新增线路需求数据
    public function ticket_add_view(){
        //线路标签
        $data=array();
        $data[] = DB::table('route_label')->select('id', 'route_label')->where('delete', '=', 0)->orderBy('id', 'asc')->get();
        return $data;
    }

    //编辑线路需求数据
    public function ticket_edit_view($id){
        $data=DB::table('ticket')->where('ticket_id',$id)->get();
        return $data;
    }































}
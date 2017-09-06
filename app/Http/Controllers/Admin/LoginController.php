<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2016/10/26
 * Time: 13:17
 */

namespace App\Http\Controllers\Admin;
use App\Models\Admin\Login as LoginModel;
use App\Models\Admin\Access as AccessModel;
use Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Redirector;


class LoginController extends dlController
{
    /**
     * @var array
     * 验证规则
     */
    private $rules = [
        'username' => 'required',
        'password' => 'required',
    ];
    private $messages = [
        'required' => '请填写相应数据',
        'email' => '请输入正确邮箱格式',
        'max' => '长度不合适',
        'regex' => '格式不正确',

    ];

    /**
     * 后台登陆
     */
    public function index()
    {
        return view('admin.login.index');
    }

    /**
     * 登录验证
     */
    public function do_login()
    {
        $data = Request::all();
        //验证输入数据
        $validator = Validator::make(
            $data,
            $this->rules,
            $this->messages
        );
        if ($validator->fails()) {
            return $validator->errors();
            exit();
        }

        $model = new LoginModel();
        $res = $model->login($data);//登录信息记录
        if ((isset($res)) && (!empty($res))) {
            session_start();
            Session::put('admin', $res['0']->id);
            Session::put('username', $res['0']->username);
            //$session=Session::get('username');
            //echo json_encode($session);
            echo json_encode(1);
        } else {
            return '0';
        }
    }

    /**
     * 退出登录
     */
    public function out()
    {
        Session::flush();//清除登录信息
        return response()->view('admin.login.index');
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2016/10/26
 * Time: 11:42
 */

namespace App\Http\Controllers\Admin;


use DB;

class UserController extends Controller
{
    public function test(){
        echo "a";
    }
    public function user()
    {
        $users = DB::table('users')->get();
        dump($users);die;

        //return view('user.index', ['users' => $users]);
    }

}
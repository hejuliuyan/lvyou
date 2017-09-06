<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Config;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class IndexController extends Controller
{
    //首页
    public function index()
    {
        $rest=Config::get('app.timezone');
        return $rest;
    }
}

<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Config;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class WxController extends Controller
{
    //判断微信token是否存在
//    public function __construct()
//    {
//        parent::__construct();
//        if(empty($_SESSION['token'])){
//            //1.请求url地址
//            $appid = 'wxf141bb6ee88ebb46';
//            $appsecret =  'cd4c8a2d8cf9b1d3588670882e0862e1';
//            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
//            //2初始化
//            $ch = curl_init();
//            //3.设置参数
//            curl_setopt($ch , CURLOPT_URL, $url);
//            curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
//            //4.调用接口
//            $res = curl_exec($ch);
//            //5.关闭curl
//            curl_close( $ch );
//            $arr = json_decode($res, true);
//            $token=$arr['access_token'];
//            $_SESSION('token',$token,7000);
//        }
//    }
    //微信验证
    public function weiXin(){
        //获得参数 signature nonce token timestamp echostr
        $nonce     = $_GET['nonce'];
        $token     = 'weixin';
        $timestamp = $_GET['timestamp'];
        $echostr   = $_GET['echostr'];
        $signature = $_GET['signature'];
        //形成数组，然后按字典序排序
        $array = array();
        $array = array($nonce, $timestamp, $token);
        sort($array);
        //拼接成字符串,sha1加密 ，然后与signature进行校验
        $str = sha1( implode( $array ) );
        if( $str  == $signature && $echostr ){
            //第一次接入weixin api接口的时候
            echo  $echostr;
            exit;
        }
    }
    //获取用户的code
    public function getCode(){
        $appid = 'wxf141bb6ee88ebb46 ';
        $redirect_uri=urlencode('http://onlinetest.ibctech.cn/home/index.html');
        $scope='snsapi_userinfo';
        $url="Location: https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=".$scope."&state=STATE#wechat_redirect";
        header($url);
    }
}
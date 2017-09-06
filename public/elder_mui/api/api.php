<?php 
header("Content-type: text/html; charset=utf-8");
include "sdk/TopSdk.php";


/**
 * 短信验证码
 *
 * @author deng ‎2016‎年‎8‎月‎24‎日，‏‎17:35:20
 * 帮助文档 https://api.alidayu.com/doc2/apiList.htm?spm=a3142.7802752.1.18.nRAEyR
 */

class msg {
	/**
	 * 短信验证码
	 */
	public function msg_send(){
	    $phone=$_POST['phone'];
	    $code=mt_rand(1000,9999);
	    
	    $c = new TopClient;
	    $c->appkey = '23514566';
	    $c->secretKey = '13c49edd5c34cc47babcb029f4ed7c2d';
	    $req = new AlibabaAliqinFcSmsNumSendRequest;
	    $req->setExtend("");
	    $req->setSmsType("normal");
	    $req->setSmsFreeSignName("个人测试");
	    $req->setSmsParam("{\"code\":\"$code\"}");
	    $req->setRecNum($phone);
	    $req->setSmsTemplateCode("SMS_25255373");
	    $resp = $c->execute($req);
	    
	    echo json_encode($code);
	}
}

	$obj = new msg();
	$obj->msg_send();
	
 ?>
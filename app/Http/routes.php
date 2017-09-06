<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
//微信验证使用
Route::get('/wx','Home\WxController@weiXin');
//获取用户code
Route::get('/','Home\WxController@getCode');
//首页广告
Route::post('/ad', 'Home\AdController@ad');
//首页产品
Route::post('/goods','Home\GoodsController@goodslist');
//产品数量
Route::post('/num','Home\GoodsController@num');
//门票详情产品
Route::post('/paixu','Home\GoodsController@tiaojian');




Route::group(/**
 *
 */
    ['namespace' => 'Admin'], function()
{
Route::get('login', 'LoginController@index'); // 后台登陆页面(后台)
Route::post('do_login', 'LoginController@do_login'); // 后台登陆验证(后台)
Route::get('log_out', 'LoginController@out'); // 退出登录(后台)
Route::get('ad_index', ['as' => 'admin_index', 'uses' => 'IndexController@index']); // 欢迎界面(后台)

Route::get('ad_members', ['as' => 'admin_mem_members', 'uses' => 'MemController@ad_members']); // 会员管理页面
Route::get('export', ['as' => 'admin_mem_export', 'uses' => 'ExcelController@export']); // 会员列表导出
Route::post('import', ['as' => 'admin_mem_import', 'uses' => 'ExcelController@import']); // 会员列表导入
Route::post('mem_search', ['as' => 'admin_mem_search', 'uses' => 'MemController@mem_search']); // 会员检索
Route::get('mem_edit_view', ['as' => 'admin_mem_edit', 'uses' => 'MemController@mem_edit_view']); // 会员编辑页面
Route::post('reset_password', ['as' => 'admin_reset_password', 'uses' => 'MemController@reset_password']); // 会员密码重置
Route::post('recharge_num', ['as' => 'admin_recharge_num', 'uses' => 'MemController@recharge_num']); // 继续充值
Route::post('edit_post', ['as' => 'admin_edit_post', 'uses' => 'MemController@edit_post']); // 编辑会员提交
Route::post('user_stop', ['as' => 'admin_user_stop', 'uses' => 'MemController@user_stop']); // 会员启用禁用
Route::post('user_delete', ['as' => 'admin_user_delete', 'uses' => 'MemController@user_delete']); // 会员删除按钮
Route::get('mem_add_view', ['as' => 'admin_add_view', 'uses' => 'MemController@mem_add_view']); // 新增会员
Route::post('mem_add', ['as' => 'admin_add', 'uses' => 'MemController@mem_add']); // 新增会员提交
Route::post('id_card', ['as' => 'admin_id_card', 'uses' => 'MemController@id_card']); //ajax验证新增会员身份证号是否重复
Route::post('ajax_mobile', ['as' => 'admin_ajax_mobile', 'uses' => 'MemController@ajax_mobile']); //ajax验证新增会员手机号是否重复
Route::post('reg_check', ['as' => 'admin_reg_check', 'uses' => 'MemController@reg_check']); //前台注册，后台审核

Route::post('mem_update', ['as' => 'admin_mem_update', 'uses' => 'MemController@mem_update']); // 会员修改
//Route::get('mem_edit_view', ['as' => 'admin_mem_edit_view', 'uses' => 'Admin\MemController@mem_edit_view']); //
Route::get('ad_member_show', ['as' => 'admin_member_show', 'uses' => 'FinancialController@member_show']); // 后台->个人帐务一览

/**
 * 线路管理
 */
Route::get('route_list', ['as' => 'admin_route_list', 'uses' => 'RouteController@route_list']); // 线路列表管理页面
Route::get('route_add_view', ['as' => 'admin_route_add', 'uses' => 'RouteController@route_add_view']); // 新增线路页面
Route::post('route_add_post', 'RouteController@route_add_post'); // 新增线路页面提交
Route::get('route_edit_view', ['as' => 'admin_route_edit', 'uses' => 'RouteController@route_edit_view']); // 编辑线路页面
Route::post('route_edit_post', ['as' => 'admin_route_edit_post', 'uses' => 'RouteController@route_edit_post']);//编辑线路提交
Route::post('route_delete', ['as' => 'admin_route_delete', 'uses' => 'RouteController@route_delete']);//删除线路
Route::post('city_place_add', ['as' => 'city_place_add', 'uses' => 'RouteController@city_place_add']);//添加具体地址
Route::post('city_detail_place', ['as' => 'city_detail_place', 'uses' => 'RouteController@city_detail_place']);//获取具体地址
Route::post('padding_date', ['as' => 'padding_date', 'uses' => 'RouteController@padding_date']);//编辑页面上月下月填充日期
Route::post('padding_date_delete', ['as' => 'padding_date_delete', 'uses' => 'RouteController@padding_date_delete']);//编辑页面删除数据库的地址数据

/**
 * 门票管理
 */
Route::get('ticket_list', 'TicketController@ticket_list'); // 线路列表管理页面
Route::get('ticket_add_view', 'TicketController@ticket_add_view'); // 新增线路页面
Route::post('ticket_add_post',  'TicketController@ticket_add_post'); // 新增线路页面提交
Route::get('ticket_edit_view', 'TicketController@ticket_edit_view'); // 编辑线路页面
Route::post('ticket_edit_post', 'TicketController@ticket_edit_post');//编辑线路提交
Route::get('ticket_delete',  'TicketController@ticket_delete');//删除线路

//Route::post('city_place_add', ['as' => 'city_place_add', 'uses' => 'TicketController@city_place_add']);//添加具体地址
//Route::post('city_detail_place', ['as' => 'city_detail_place', 'uses' => 'TicketController@city_detail_place']);//获取具体地址
//Route::post('padding_date', ['as' => 'padding_date', 'uses' => 'TicketController@padding_date']);//编辑页面上月下月填充日期
//Route::post('padding_date_delete', ['as' => 'padding_date_delete', 'uses' => 'TicketController@padding_date_delete']);//编辑页面删除数据库的地址数据

/**
 * 订单管理
 */
Route::get('order_list', ['as' => 'admin_order_list', 'uses' => 'OrderController@order_list']); // 订单列表管理页面
Route::get('order_detail', ['as' => 'admin_order_detail', 'uses' => 'OrderController@order_detail']); // 订单详情页面
Route::post('/order_back_check', 'OrderController@order_back_check'); // 退单审核
Route::post('/order_back_money', 'OrderController@order_back_money'); // 退款审核

/**
 * 团管理
 */
Route::get('/team_list', 'TeamController@team_list'); // 发团管理
Route::get('/team_detail', 'TeamController@team_detail'); // 发团详情编辑
Route::post('/team_edit', 'TeamController@team_edit'); //编辑保存
Route::post('/team_examine', 'TeamController@team_examine'); //查看基本信息是否完善
Route::post('/admin_send_message', 'TeamController@admin_send_message'); //发送微信消息
Route::post('/postpone_message', 'TeamController@postpone_message'); //发送微信消息
Route::get('/Teamcomplete', 'TeamcompleteController@index'); // 定时任务测试
Route::get('/Teamcomplete_test', 'TeamcompleteController@index'); // 定时任务测试
Route::post('/close_team', 'TeamController@close_team'); //关闭团
/**
 * 广告管理
 */
//Route::post('/adver_show', 'Home\AdverController@adver_show'); //前台广告显示
Route::get('/advertisement', 'AdverController@advertisement'); // 广告 线路编号显示
Route::post('/adver_post', 'AdverController@adver_post'); //添加广告编号
Route::post('/adver_del', 'AdverController@adver_del'); //删除广告编号


/**
 * 参数管理-线路参数
 */
Route::get('member_parame', ['as' => 'admin_member_parame', 'uses' => 'ParameController@member_parame']); //会员参数
Route::post('member_parame_post', ['as' => 'admin_member_parame_post', 'uses' => 'ParameController@member_parame_post']); //会员参数提交
Route::post('member_label_post', ['as' => 'admin_member_label_post', 'uses' => 'ParameController@member_label_post']); //用户标签提交
Route::post('member_label_del', ['as' => 'admin_member_label_del', 'uses' => 'ParameController@member_label_del']); //线路标签删除

Route::get('route_parame', ['as' => 'admin_route_parame', 'uses' => 'ParameController@route_parame']); //线路参数
Route::post('route_label_post', ['as' => 'admin_route_label_post', 'uses' => 'ParameController@route_label_post']); //线路标签提交
Route::post('route_label_del', ['as' => 'admin_route_label_del', 'uses' => 'ParameController@route_label_del']); //线路标签删除

Route::post('traffic_val_post', ['as' => 'admin_traffic_val_post', 'uses' => 'ParameController@traffic_val_post']); //交通方式提交
Route::post('traffic_del', ['as' => 'admin_traffic_del', 'uses' => 'ParameController@traffic_del']); //交通方式删除

Route::post('destination_val_post', ['as' => 'admin_destination_val_post', 'uses' => 'ParameController@destination_val_post']); //目的地提交
Route::post('destination_del', ['as' => 'admin_destination_del', 'uses' => 'ParameController@destination_del']); //目的地删除

Route::post('start_city_val_post', ['as' => 'admin_start_city_val_post', 'uses' => 'ParameController@start_city_val_post']); //出发城市提交
Route::post('start_city_del', ['as' => 'admin_start_city', 'uses' => 'ParameController@start_city_del']); //出发城市删除
});
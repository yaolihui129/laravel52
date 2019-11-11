<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::controllers ( [
		'auth' => 'Auth\AuthController', // 认证登录
		'password' => 'Auth\PasswordController'  // 重置密码
] );
Route::get ( "/", "Auth\AuthController@getIndex" ); // Index
Route::group(['prefix'=>'camp'],function(){
    Route::get('/webtest',"Campaign\WebController@index");
    Route::get('/apptest',"Campaign\AppController@index");
    Route::get('/u8',"Campaign\U8Controller@index");
});
Route::get ( '/verify/image', 'Verify\VerifyController@index' ); // 图片验证码



//测试工具链接基下载
Route::group ( [
    'prefix'=>'camp',
    'namespace' => 'Campaign',
    'middleware' => 'auth'
], function () {
    Route:: resource( "/ult", "U8Controller@ult" );
    Route:: resource( "/mtt", "U8Controller@mtt" );
    Route:: resource( "/sett", "U8Controller@sett" );
    Route:: resource( "/dult", "U8Controller@dult" );
    Route:: resource( "/pct", "U8Controller@pct" );
    Route:: resource( "/js", "U8Controller@js" );
    Route:: resource( "/lsbcx", "U8Controller@lsbcx" );
    Route:: resource( "/gdi", "U8Controller@gdi" );
    Route:: resource( "/sjkjgdb", "U8Controller@sjkjgdb" );
    Route:: resource( "/wj", "U8Controller@wj" );
    Route:: resource( "/xn", "U8Controller@xn" );
    Route:: resource( "/ylzx", "U8Controller@ylzx" );
} );



/**
 * YonSuite质量全景分析
 */
Route::group ( [
    'prefix'=>'camp',
    'namespace' => 'Campaign',
//    'middleware' => 'auth'
], function () {
    Route::group ( [
        'prefix' => 'ys',
        'namespace' => 'ys'
    ], function () {
        //初始化页面
        Route::get('/ysIndex',"YSController@index");
        //初始化版本号
        Route::get('/getVersion',"YSController@getVersion");
        Route::get('/getYSResource',"YSController@getYSResource");
        Route::resource('/setVersion',"YSController@setVersion");
        //初始化集成号
        Route::get('/getIntegrate',"YSController@getIntegrate");
        Route::resource('/setIntegrate',"YSController@setIntegrate");

        // 专项
        Route::group ( [
            'prefix' => 'pmdLeft'
        ], function () {
            Route::get ( "index", "PmdLeftController@index" );
            Route::get ( "create", "PmdLeftController@create" );
            Route::resource ( "update", "PmdLeftController@update" );
            Route::get ( "getData", "PmdLeftController@getData" );
        } );

        //故事点进度排行
        Route::group ( [
            'prefix' => 'story'
        ], function () {
            Route::get ( "index", "StoryController@index" );
            Route::get ( "create", "StoryController@create" );
            Route::resource ( "update", "StoryController@update" );
            Route::get ( "getData", "StoryController@getData" );
        } );

        //业务流程接口执行分析
        Route::group ( [
            'prefix' => 'newsListLeft'
        ], function () {
            Route::get ( "index", "NewsListLeftController@index" );
            Route::get ( "create", "NewsListLeftController@create" );
            Route::resource ( "update", "NewsListLeftController@update" );
            Route::get ( "getData", "NewsListLeftController@getData" );
        } );

        //整体完成情况
        Route::group ( [
            'prefix' => 'all'
        ], function () {
            Route::get ( "index", "AllController@index" );
            Route::get ( "create", "AllController@create" );
            Route::resource ( "update", "AllController@update" );
            Route::get ( "getData", "AllController@getData" );
        } );

        //水球数据
        Route::group ( [
            'prefix' => 'water'
        ], function () {
            Route::get ( "index", "WaterController@index" );
            Route::get ( "create", "WaterController@create" );
            Route::resource ( "update", "WaterController@update" );
            Route::get ( "getData", "WaterController@getData" );
        } );

        //接口、api、压力、静态代码、安全性
        Route::group ( [
            'prefix' => 'api'
        ], function () {
            Route::get ( "index", "ApiController@index" );
            Route::get ( "create", "ApiController@create" );
            Route::resource ( "update", "ApiController@update" );
            Route::get ( "getData", "ApiController@getData" );
        } );

        //客户验证
        Route::group ( [
            'prefix' => 'pmdRight'
        ], function () {
            Route::get ( "index", "PmdRightController@index" );
            Route::get ( "create", "PmdRightController@create" );
            Route::resource ( "update", "PmdRightController@update" );
            Route::get ( "getData", "PmdRightController@getData" );
        } );

        //缺陷BUG分析
        Route::group ( [
            'prefix' => 'BUG'
        ], function () {
            Route::get ( "index", "BUGController@index" );
            Route::get ( "create", "BUGController@create" );
            Route::resource ( "update", "BUGController@update" );
            Route::get ( "getData", "BUGController@getData" );
        } );

        //公共项目测试
        Route::group ( [
            'prefix' => 'newsListRight'
        ], function () {
            Route::get ( "index", "NewsListRightController@index" );
            Route::get ( "create", "NewsListRightController@create" );
            Route::resource ( "update", "NewsListRightController@update" );
            Route::get ( "getData", "NewsListRightController@getData" );
        } );

    } );
} );


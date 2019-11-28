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
    ], function () {
        //初始化页面
        Route::get('/ysIndex',"YsController@index");
        //初始化版本号
        Route::get('/getVersion',"YsController@getVersion");
        Route::resource('/setVersion',"YsController@setVersion");
        //初始化集成号
        Route::get('/getIntegrate',"YsController@getIntegrate");
        Route::resource('/setIntegrate',"YsController@setIntegrate");
        //获取资源
        Route::get('/getYSResource',"YsController@getYSResource");
    } );
} );


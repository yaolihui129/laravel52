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
//    'middleware' => 'auth'
], function () {
    Route:: get( "/ult", "U8Controller@ult" );
    Route:: get( "/mtt", "U8Controller@mtt" );
    Route:: get( "/sett", "U8Controller@sett" );
    Route:: get( "/dult", "U8Controller@dult" );
    Route:: get( "/pct", "U8Controller@pct" );
    Route:: get( "/js", "U8Controller@js" );
    Route:: get( "/lsbcx", "U8Controller@lsbcx" );
    Route:: get( "/gdi", "U8Controller@gdi" );
    Route:: get( "/sjkjgdb", "U8Controller@sjkjgdb" );
    Route:: get( "/wj", "U8Controller@wj" );
    Route:: get( "/xn", "U8Controller@xn" );
    Route:: get( "/ylzx", "U8Controller@ylzx" );

    //版本号
    Route::get('/version', 'VersionController@index');
    Route::match(['get','post'],'version/{version}/edit','VersionController@edit')->where('version','[0-9]+');
    Route::match(['get','post'],'version/create','VersionController@create');
    Route::get('version/{version}/del','VersionController@destroy')->where('version','[0-9]+');
    //集成号
    Route::get('/integtera/version/{version}', 'IntegrateController@index')->where('version','[0-9]+');
    Route::match(['get','post'],'integrate/{integrate}/edit','IntegrateController@edit')->where('integrate','[0-9]+');
    Route::match(['get','post'],'integrate/create','IntegrateController@create');
    Route::get('integrate/{integrate}/del','IntegrateController@destroy')->where('integrate','[0-9]+');
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
        Route::get('/getVersion',"VersionController@getVersion");
        //初始化集成号
        Route::get('/getIntegrate',"IntegrateController@getIntegrate");
        //获取资源
        Route::get('/getYSResource',"YsController@getYSResource");


    } );
} );


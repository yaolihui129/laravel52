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
Route::get ( "/", "IndexController@getIndex" ); // Index
Route::group([
	'prefix'=>'camp'
	],function(){
    Route::get('/webtest',"Campaign\WebController@index");
    Route::get('/apptest',"Campaign\AppController@index");
    Route::get('/u8',"Campaign\U8Controller@index");
});

// 注册页面
Route::get('/register', '\App\Http\Controllers\RegisterController@index');
// 注册行为
Route::post('/register', '\App\Http\Controllers\RegisterController@register');
// 登陆页面
Route::get('/login', '\App\Http\Controllers\LoginController@index');
// 登陆行为
Route::post('/login', '\App\Http\Controllers\LoginController@login');


Route::group([
	'middleware' => 'auth' 
	],function(){
		//登出行为
		Route::get('/logout','LoginController@logout' );
		
		//个人设置
		Route::get('/user/me/setting','UserController@setting' );
		//个人设置操作
		Route::post('/user/me/setting','UserController@settingStore' );
		
		//文章列表页
		Route::get('/posts','PostController@index' );
		//创建文章
		Route::post('/posts','PostController@store' );
		Route::get('/posts/create','PostController@create' );
		//更新文章
		Route::get('/posts/{post}/edit','PostController@edit')->where('post','[0-9]+');
		Route::put('/posts/{post}','PostController@update' )->where('post','[0-9]+');
		//删除文章
		Route::get('/posts/{post}/delete','PostController@delete' )->where('post','[0-9]+');
		//文章详情页
		Route::get('/posts/{post}','PostController@show')->where('post','[0-9]+');
		//图片上传
		Route::post('/posts/image/upload','PostController@imageUpload');
		//提交评论
		Route::post('/posts/{post}/comment','PostController@comment')->where('post','[0-9]+');
		// 赞
		Route::get('/posts/{post}/zan', 'PostController@zan')->where('post','[0-9]+');
		// 取消赞
		Route::get('/posts/{post}/unzan', 'PostController@unzan')->where('post','[0-9]+');
		
		//个人中心
		Route::get('/user/{user}', 'UserController@show')->where('user','[0-9]+');
		//关注
		Route::post('/user/{user}/fan', 'UserController@fan')->where('user','[0-9]+');
		//取消关注
		Route::post('/user/{user}/unfan', 'UserController@unfan')->where('user','[0-9]+');
		
		//专题详情页
		Route::get('/topic/{topic}', 'TopicController@show')->where('topic','[0-9]+');
		//投稿
		Route::post('/topic/{topic}/submit', 'TopicController@submit')->where('topic','[0-9]+');
});







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
    Route::get('/integrate/version/{version}', 'IntegrateController@index')->where('version','[0-9]+');
    Route::match(['get','post'],'integrate/{integrate}/edit/{version}','IntegrateController@edit')
        ->where(['integrate','[0-9]+'],['version','[0-9]+']);
    Route::match(['get','post'],'integrate/create/{version}','IntegrateController@create')->where('version','[0-9]+');
    Route::get('integrate/{integrate}/del/{version}','IntegrateController@destroy')
        ->where(['integrate','[0-9]+'],['version','[0-9]+']);
    //资源数据
    Route::get('/resource/{integrate}/{version}/{enumType}', 'ResourceController@index')
        ->where(['integrate','[0-9]+'],['version','[0-9]+'],['enumType','[0-9]+']);
    Route::match(['get','post'],'resource/{resource}/show/{integrate}/{version}/{enumType}','ResourceController@show')
        ->where(['resource','[0-9]+'],['integrate','[0-9]+'],['version','[0-9]+'],['enumType','[0-9]+']);
    Route::match(['get','post'],'resource/{resource}/copy/{integrate}/{version}/{enumType}','ResourceController@copy')
        ->where(['resource','[0-9]+'],['integrate','[0-9]+'],['version','[0-9]+'],['enumType','[0-9]+']);
    Route::match(['get','post'],'resource/create/{integrate}/{version}/{enumType}','ResourceController@create')
        ->where(['integrate','[0-9]+'],['version','[0-9]+'],['enumType','[0-9]+']);
    Route::get('resource/{resource}/del/{integrate}/{version}/{enumType}','ResourceController@destroy')
        ->where(['resource','[0-9]+'],['integrate','[0-9]+'],['version','[0-9]+'],['enumType','[0-9]+']);
    Route::match(['get','post'],'resource/upload/{integrate}/{version}/{enumType}','ResourceController@upload');
    Route::match(['get','post'],'resource/download/','ResourceController@download');
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



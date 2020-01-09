<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     * 注册完成后调用
     * @return void
     */
    public function boot()
    {
        //
		\View::composer('layout.sidebar',function($view){
			$topics = \App\Model\Topic::all();
			$view->with('topics',$topics);
		});
    }

    /**
     * Register any application services.
     * 注册前调用
     * @return void
     */
    public function register()
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //登录页面
	public function index(){
		if(\Auth::check()){
			return redirect('/posts');
		}
		return view('login.index');
	}

	//登录行为
	public function login(){
		//验证
		$this->validate(request(),[
			'chrEmail'			=> 'required|email',
			'password'			=> 'required|min:5|max:10',
			'remember_token' 	=> 'integer',
		]);
		//逻辑
		$user = array(
			'chrEmail' => request('chrEmail'),
			'password' => request('password')
		);
		$is_remember = boolval(request('remember_token'));
		$user =\Auth::attempt($user,$is_remember);
		// dd(\Auth::user());
		if ($user) {
			return redirect('/');
		}
		//渲染
		return \Redirect::back()->withError("邮箱密码不匹配");
	}

	//登出行为
	public function logout(){
		\Auth::logout();
		return redirect('/login');
	}

	public function welcome()
    {
        return redirect("/login");
    }

}

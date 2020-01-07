<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class RegisterController extends Controller
{
    //注册页面
	public function index(){
		
            return view('register.index');
	}
	//注册行为
	public function register(){
            //验证
            $this -> validate(request(),[
                    'chrUserName'	=> 'required|min:3|unique:users,chrUserName',
                    'chrEmail'		=> 'required|unique:users,chrEmail|email',
                    'password'		=> 'required|min:5|max:10|confirmed',
            ]);
            //业务逻辑
            $chrUserName = request('chrUserName');
            $chrEmail = request('chrEmail');
            $password =bcrypt(request('password'));
			$user=compact('chrUserName','chrEmail','password');
            $user = User::create($user);
			// dd($user);
            //渲染
            return redirect('/login');
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
class UserController extends Controller
{
    //
	
	public function index(){
		
		
	}
        
	//个人设置页面
	public function setting(){
            $user= Auth::user();
            return view('user.setting', compact('user'));
	}
	//个人设置行为
	public function settingStore(Request $request ){
            //验证
            $this->validate(request(), [
                'chrUserName'=>'required|min:2',
            ]);
            //逻辑
            $chrUserName= request('chrUserName');
            $user = Auth::user();
            //如果更改用户名
            if($chrUserName!=$user->chrUserName){
                if(User::where('chrUserName',$chrUserName)->count()>0){
                    return back()->withErrors('用户名已经被注册');
                }
                $user->chrUserName = $chrUserName;
            }
            //如果有头像上传
            if($request->file('avatar')){
                $path = $request->file('avatar')->storePublicly($user->id);
                $user->avatar = '/storage/'.$path;
            }
            $user->save();
            //渲染
            return back();
            
	}
}

<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


use App\Services\UserService;
use App\Services\VerifyService;
use App\Services\TelEmailService;
use App\Utils\RegHelper;
use App\Services\AuthMenuService;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;


    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(
			$this->guestMiddleware(), ['except' => 'logout']

		);
    }
	
	
	
	public function getIndex() {
		$user=Auth::user();
		$pages=array();
		if(!empty($user)){
			$pages["login"]="1";
		}
		return view ( 'campaign.index' )->with($pages);
	}
	
	public function postLogin(Request $request){
		$email = $request->input ('chrEmail');
		$pwd = $request->input ( 'password' );
		$res=User::where('chrEmail','=',$email)->first();
		if (true) {
			// 存储用户、角色session信息
			$this->setUserAuthSession ();
			$array=array (
				'success' => 1,
				'mgs' => 'ok',
				'url' => "" 
			);
			return response ()->json ($array);
		}
		
	}
	
	
	
	// // 重写 登录
	// public function postLogin(Request $request) {
	// 	try {
	// 		$vercode = $request->input ( 'vercode' );
	// 		$temService = new TelEmailService ();
	// 		$msg = $temService->verImgCodeValidate ( $vercode ); // 验证图片校验码
	// 		$msg = "";
	// 		if (! $msg) { // 返回""则表示验证通过
	// 			$email = $request->input ( 'email' );
	// 			$pwd = $request->input ( 'password' );
	// 			$credentials = array (
	// 					"chrEmail" => $email,
	// 					"password" => $pwd 
	// 			);
	// 			if ($this->auth->attempt ( $credentials, $request->has ( 'remember' ) )) {
	// 				// 存储用户、角色session信息
	// 				$this->setUserAuthSession ();
	// 				$array=array (
	// 					'success' => 1,
	// 					'mgs' => 'ok',
	// 					'url' => "" 
	// 				);
	// 				return response ()->json ($array);
	// 			}
	// 			// 登录失败
	// 			return $this->registerFail ( "用户名或密码错误" );
	// 		}
	// 		return $this->registerFail ( $msg );
	// 	} catch ( \Exception $e ) {
	// 		throw $e;
	// 	}
	// }
	
	
	/**
	 * 成功返回的json信息
	 *
	 * @param $url        	
	 * @return string
	 */
	private function registerSuccess($url) {
		return "{success:1,url:'{$url}'}";
	}

	/**
	 * 注册、登录时将用户信息以及权限信息存入到session中
	 *
	 */
	private function setUserAuthSession() {
		$key = "auth";
		$user = Auth::user ();
		// $amService = new AuthMenuService (); // 获取模块（即菜单）信息
		// $user->menuAuths = $amService->getMenuAuths ( $user );
		// $user->btnAuths = $amService->getButtonAuths ( $user );
		// $user->dataAuths = $amService->getDataAuths ( $user );
		// Session::put ( $key, $user );
	}

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}

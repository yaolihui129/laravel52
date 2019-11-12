<?php

namespace App\Http\Controllers\Verify;

use App\Http\Controllers\Controller;
use App\Services\VerifyService;
use Illuminate\Http\Request;


class VerifyController extends Controller {

    /**
     * 图片验证码
     *
     * @param Request $request
     * @return void
     * @throws \Exception
     */
	public function index(Request $request) {

		// 生成验证码图片
		try {
			$verify = new VerifyService ();
			dd($verify);
			$verify->getImageCode ( 4, 90, 30 );
		} catch ( \Exception $e ) {
			throw ($e);
		}
	}
}

<?php

namespace App\Http\Controllers\Campaign;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function index()
	{
		//
		$user=Auth::user();
		$pages=array();
		if(!empty($user)){
			$pages["login"]="1";
		}
		return view('campaign.apptest')->with($pages);
	}
	
	
	
	
}

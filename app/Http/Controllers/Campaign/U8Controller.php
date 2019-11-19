<?php

namespace App\Http\Controllers\Campaign;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class U8Controller extends Controller
{
	
	public function index(Request $request)
	{
		$user=Auth::user();
		$pages=array();
		if(!empty($user)){
			$pages["login"]="1";
		}
		//return view("campaign.u8")->with($pages);

		$userU8 = $request->user();
		$userID = $userU8->id;
		//权限校验,按userid校验
		if ($userID == '24') {
			return view("campaign.u8")->with($pages);
		}else {
			echo ');window.close();
					}
				   </script>\'';
		}
	}
	
	 /**
	 * @return mixed
	 */
	public function ult()
	{
		$file=storage_path('download/ULT.zip');
		return response()->download($file);
	}
	/**
	 * @return mixed
	 */
	public function mtt()
	{
		$file=storage_path('download/MTT.zip');
		return response()->download($file);
	}
	/**
	 * @return mixed
	 */
	public function sett()
	{
		$file=storage_path('download/SETT.zip');
		return response()->download($file);
	}
	/**
	 * @return mixed
	 */
	public function dult()
	{
		$file=storage_path('download/DULT.zip');
		return response()->download($file);
	}
	/**
	 * @return mixed
	 */
	public function pct()
	{
		$file=storage_path('download/PCT.zip');
		return response()->download($file);
	}
	/**
	 * @return mixed
	 */
	public function js()
	{
		$file=storage_path('download/JS.zip');
		return response()->download($file);
	}
	/**
	 * @return mixed
	 */
	public function lsbcx()
	{
		$file=storage_path('download/LSBCX.zip');
		return response()->download($file);
	}
	/**
	 * @return mixed
	 */
	public function gdi()
	{
		$file=storage_path('download/GDI.zip');
		return response()->download($file);
	}
	/**
	 * @return mixed
	 */
	public function sjkjgdb()
	{
		$file=storage_path('download/SJKJGDB.zip');
		return response()->download($file);
	}
	/**
	 * @return mixed
	 */
	public function wj()
	{
		$file=storage_path('download/WJ.zip');
		return response()->download($file);
	}
	/**
	 * @return mixed
	 */
	public function xn()
	{
		$file=storage_path('download/XN.zip');
		return response()->download($file);
	}
	/**
	 * @return mixed
	 */
	public function ylzx()
	{
		$file=storage_path('download/YLZX.zip');
		return response()->download($file);
	}
	
	
	
}

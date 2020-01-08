<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends Controller
{
	public function index(){
		return view('index');
	}
	
	public function getIndex() {
		$user=\Auth::user();
		$pages=array();
		if(!empty($user)){
			$pages["login"]="1";
		}
		return view ( 'campaign.index' )->with($pages);
	}
	
	/**
	 * WebUI
	 * @param Request $request
	 * @return string
	 */
	public function getTaskPies(Request $request) {
		$user = $request->user ();
		$rcService = new ReportChartService ();
		$rows = $rcService->getWebTaskPieForIndex ( $user );
		return "{success:1,data:{web:'" . json_encode ( $rows ) . "'}}";
	}

	public function getApiTaskPies(Request $request){
		$user = $request->user ();
		$rcService = new ReportChartService ();
		$rows = $rcService->getApiTaskPieForIndex ( $user );
		return "{success:1,data:{web:'" . json_encode ( $rows ) . "'}}";
	}

	public function getAppTaskPies(Request $request){
		$user = $request->user ();
		$rcService = new ReportChartService ();
		$rows = $rcService->getAppTaskPieForIndex ( $user );
		return "{success:1,data:{web:'" . json_encode ( $rows ) . "'}}";
	}

	public function getDispatchTaskPies(Request $request){
		$user = $request->user ();
		$rcService = new ReportChartService ();
		$rows = $rcService->getDispatchTaskPieForIndex ( $user );
		return "{success:1,data:{web:'" . json_encode ( $rows ) . "'}}";
	}

	/**
	 *
	 * @param Request $request
	 * @return string
	 */
	public function getTaskLines(Request $request) {
		$user = $request->user ();
		$cycle = $request->input ( 'cycle' );
		$rcService = new ReportChartService ();
		$rows = $rcService->getWebTaskLine ( $user, $cycle );
		return "{success:1,data:{web:'" . json_encode ( $rows ) . "'}}";
	}

	/**
	 *
	 * @param Request $request
	 * @return string
	 */
	public function getSchemeChart(Request $request) {
		$user = $request->user ();
		$cycle = $request->input ( 'cycle' );
		$rcService = new ReportChartService ();
		$rows = $rcService->getSchemeChart ( $user ,$cycle);
		return "{success:1,data:{web:'" . json_encode ( $rows ) . "'}}";
	}


	/**
	 *
	 * @param Request $request
	 * @return string
	 */
	public function getScriptChart(Request $request) {
		$user = $request->user ();
		$rcService = new ReportChartService ();
		$rows = $rcService->getScriptChart ( $user);
		return "{success:1,data:{web:'" . json_encode ( $rows ) . "'}}";
	}

	
}

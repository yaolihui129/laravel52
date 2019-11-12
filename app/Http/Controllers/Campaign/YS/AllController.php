<?php namespace App\Http\Controllers\Campaign\YS;

use App\Http\Controllers\Controller;
use App\Services\YS\AllService;
use App\Models\Campaign\YS\AllModel;
use http\Client\Response as ResponseAlias;
use Illuminate\Http\Request;

class AllController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return ResponseAlias
     */
	public function index(Request $request)
	{
		$time=time();
        $version    = $request->input('version');
        $integrate  = $request->input('integrate');
        $startTime  = $request->input('startTime',date('Y-m-d',$time-7*24*60*60));
        $endTime    = $request->input('endTime',date('Y-m-d',$time+24*60*60));
        $query      = new AllService();
        $all      = $query->getAllData($version,$integrate,$startTime,$endTime);
        $arr=array();
        if($all){
            $data[] = $all;
            $arr['success'] = 1;
            $arr['data'] = $data;
        }else{
            $arr['success']=0;
        }
        return response($arr,200);
	}

	public function getData(Request $request){
        $time=time();
        $version    = $request->input('version');
        $integrate  = $request->input('integrate');
        $startTime  = $request->input('startTime',date('Y-m-d',$time-7*24*60*60));
        $endTime    = $request->input('endTime',date('Y-m-d',$time+24*60*60));
        $story = AllModel::where('intVersionID','=',$version)
            ->where('intIntegrateID','=',$integrate)
            ->whereBetween('dateAllDate',[$startTime,$endTime])
            ->orderBy('created_at','desc')->first();
        $arr=array();
        if($story){
            $data[] = $story;
            $arr['success'] = 1;
            $arr['data'] = $data;
        }else{
            $arr['success']=0;
        }
        return response($arr,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
	public function create()
	{
		//
        dd(1);
	}

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
	public function store()
	{
		//
	}

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
	public function show($id)
	{
		//
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
	public function edit($id)
	{
		//
	}

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return void
     */
	public function update($id)
	{
		//
        dd('update');
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
	public function destroy($id)
	{
		//
	}

}

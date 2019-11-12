<?php namespace App\Http\Controllers\Campaign\YS;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Campaign\YS\NewslistrightModel;
use App\Services\YS\NewsListRightService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NewsListRightController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
	public function index(Request $request)
	{
	    //
        $version    = $request->input('version');
        $integrate  = $request->input('integrate');
        $startTime  = $request->input('startTime');
        $endTime    = $request->input('endTime');
        $query      = new NewsListRightService();
        $story      = $query->getNewsListRightData($version,$integrate,$startTime,$endTime);
        $arr=array();
        if($story){
            foreach ($story as $rows) {
                $data[] = $rows;
                $arr['success'] = 1;
                $arr['data'] = $data;
            }
        }else{
            $arr['success']=0;
        }
        return response($arr,200);
	}

    /**
     * @param Request $request
     * @return Response
     */
    public function getData(Request $request){
        $time=time();
        $version    = $request->input('version');
        $integrate  = $request->input('integrate');
        $startTime  = $request->input('startTime',date('Y-m-d',$time-7*24*60*60));
        $endTime    = $request->input('endTime',date('Y-m-d',$time+24*60*60));
        $newListRight = NewslistrightModel::where('intVersionID','=',$version)
            ->where('intIntegrateID','=',$integrate)
            ->whereBetween('dateAllDate',[$startTime,$endTime])
            ->orderBy('created_at','desc')->first();
        $arr=array();
        if($newListRight){
            $data[] = $newListRight;
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

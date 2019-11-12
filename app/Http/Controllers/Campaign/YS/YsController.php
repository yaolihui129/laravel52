<?php namespace App\Http\Controllers\Campaign\YS;

use App\Http\Controllers\Controller;
use App\Models\Campaign\YS\AllModel;
use App\Models\Campaign\YS\ApiModel;
use App\Models\Campaign\YS\BugModel;
use App\Models\Campaign\YS\NewslistleftModel;
use App\Models\Campaign\YS\NewslistrightModel;
use App\Models\Campaign\YS\PmdleftModel;
use App\Models\Campaign\YS\PmdrightModel;
use App\Models\Campaign\YS\StoryModel;
use App\Models\Campaign\YS\VersionModel;
use App\Models\Campaign\YS\IntegrateModel;
use App\Services\YS\YSService;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Maatwebsite\Excel\Excel;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class YSController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return string
	 */
	public function index()
	{
		//
        $user=Auth::user();
        $pages=array();
        if(!empty($user)){
            $pages["login"]="1";
        }
        return view("campaign.case05.index")->with($pages);
	}

    /**
     * @return ResponseAlias
     */
	public  function getVersion()
    {
//        $query      =new YSService();
//        $version    =$query->getVersion();
        $version = VersionModel::all();
        $arr=array();
        if($version){
//            foreach ($version as $rows) {
//                $data[] = $rows;
//                $arr['success'] = 1;
//                $arr['data'] = $data;
//            }
            $data = $version;
            $arr['success'] = 1;
            $arr['data'] = $data;

        }else{
            $arr['success']=0;
        }
        return response($arr,200);
    }


    /**
     * @param Request $request
     * @return false|string
     */
    public  function getIntegrate(Request $request)
    {

        $version = $request->input ( 'version');
//        if(!$version){
//            $version=3;
//        }
//        $query=new YSService();
//        $integrate=$query->getIntegrate($version);

        $integrate = IntegrateModel::where('intVersionID','=',$version)->get();

        $arr=array();
        if($integrate){
//            foreach ($integrate as $rows) {
//                $data[] = $rows;
//                $arr['success'] = 1;
//                $arr['data'] = $data;
//            }
            $data = $integrate;
            $arr['success'] = 1;
            $arr['data'] = $data;
        }else{
            $arr['success']=0;
        }
        return response($arr,200);
    }


    public function getYSResource(Request $request){
        $time=time();
        $version    = $request->input('version');
        $integrate  = $request->input('integrate');
        $startTime  = $request->input('startTime',date('Y-m-d',$time-7*24*60*60));
        $endTime    = $request->input('endTime',date('Y-m-d',$time+24*60*60));
        $all = AllModel::where('intVersionID','=',$version)->where('intIntegrateID','=',$integrate)
            ->whereBetween('dateAllDate',[$startTime,$endTime])->orderBy('created_at','desc')->first();
        $api = ApiModel::where('intVersionID','=',$version)->where('intIntegrateID','=',$integrate)
            ->whereBetween('dateApiDate',[$startTime,$endTime])->orderBy('created_at','desc')->first();
        $bug = BugModel::where('intVersionID','=',$version)->where('intIntegrateID','=',$integrate)
            ->whereBetween('dataBugDate',[$startTime,$endTime])->orderBy('created_at','desc')->first();
        $newListLeft = NewslistleftModel::where('intVersionID','=',$version)->where('intIntegrateID','=',$integrate)
            ->whereBetween('dateNewListLeftDate',[$startTime,$endTime])->orderBy('created_at','desc')->first();
        $newListRight = NewslistrightModel::where('intVersionID','=',$version)->where('intIntegrateID','=',$integrate)
            ->whereBetween('dateNewListRightDate',[$startTime,$endTime])->orderBy('created_at','desc')->first();
        $pmdLeft = PmdleftModel::where('intVersionID','=',$version)->where('intIntegrateID','=',$integrate)
            ->whereBetween('dateSpecialDate',[$startTime,$endTime])->orderBy('created_at','desc')->first();
        $pmdRight = PmdrightModel::where('intVersionID','=',$version)->where('intIntegrateID','=',$integrate)
            ->whereBetween('datePmdRightDate',[$startTime,$endTime])->orderBy('created_at','desc')->first();
        $story = StoryModel::where('intVersionID','=',$version)->where('intIntegrateID','=',$integrate)
            ->whereBetween('dateStoryDate',[$startTime,$endTime])->orderBy('created_at','desc')->first();
        $edition= VersionModel::find($version);
        $edition=$edition->dataIssueDate;
//dd($story);
        $arr=array();
        $arr['success'] = 1;
        $arr['data'] = [
            'all'           => $all,
            'api'           => $api,
            'bug'           => $bug,
            'newListLeft'   => $newListLeft,
            'newListRight'  => $newListRight,
            'pmdLeft'       => $pmdLeft,
            'pmdRight'      => $pmdRight,
            'story'         => $story,
            'edition'       => $edition
        ];

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


    /**
     * @return View
     */
    public function getData(){


        $file = Input::file('myfile');
        if($file){
//			$realPath = $file
//			$path = $file -> move(app_path().'/storage/uploads');
            $realPath = $file->getRealPath();
            $entension =  $file -> getClientOriginalExtension(); //上传文件的后缀.
            $tabl_name = date('YmdHis').mt_rand(100,999);
            $newName = $tabl_name.'.'.'xls';//$entension;
            $path = $file->move(base_path().'/uploads',$newName);
            $cretae_path = base_path().'/uploads/'.$newName;

            //dd($cretae_path);
            //dd($file);

            Excel::load($cretae_path, function($reader) use($tabl_name){
                //$data = $reader->all();

                //获取excel的第几张表
                $reader = $reader->getSheet(0);
                //获取表中的数据
                $data = $reader->toArray();

                $result = $this->create_table($tabl_name,$data);
                dd($result);

                //dd($data);
            });

        }

        return view('query.index');
    }


    public function create_table($table_name,$arr_field)
    {

        $tmp = $table_name;
        $va = $arr_field;
        Schema::create("$tmp", function(Blueprint $table) use ($tmp,$va)
        {
            $fields = $va[0];  //列字段
            //$fileds_count =  0; //列数
            $table->increments('id');//主键
            foreach($fields as $key => $value){
                if($key == 0){
                    $table->string($fields[$key]);//->unique(); 唯一
                }else{
                    $table->string($fields[$key]);
                }
                //$fileds_count = $fileds_count + 1;
            }
        });

        $value_str= array();
        $id = 1;
        foreach($va as $key => $value){
            if($key != 0){

                $content = implode(",",$value);
                $content2 = explode(",",$content);
                foreach ( $content2 as $key => $val ) {
                    $value_str[] = "'$val'";
                }
                $news = implode(",",$value_str);
                $news = "$id,".$news;
                DB::insert("insert into db_$tmp values ($news)");
                //$value_str = '';
                $value_str= array();
                $id = $id + 1;
            }
        }
        return 1;
    }




}

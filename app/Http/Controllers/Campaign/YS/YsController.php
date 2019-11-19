<?php namespace App\Http\Controllers\Campaign\YS;

use App\Http\Controllers\Controller;
use App\Models\Campaign\YS\ResourceModel;
use App\Models\Campaign\YS\VersionModel;
use App\Models\Campaign\YS\IntegrateModel;
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
        $version = VersionModel::all();
        $arr=array();
        if($version){
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
        $integrate = IntegrateModel::where('intVersionID','=',$version)->get();
        $arr=array();
        if($integrate){
            $data = $integrate;
            $arr['success'] = 1;
            $arr['data'] = $data;
        }else{
            $arr['success']=0;
        }
        return response($arr,200);
    }


    public function getYSResource(Request $request){
        /**初始换开始时间和结束时间
         * 
         */
        $time=time();
        $version    = $request->input('version');
        $integrate  = $request->input('integrate');
        $startTime  = $request->input('startTime');
        if(!$startTime){
            $startTime = date('Y-m-d',$time-7*24*60*60);
        }
        $endTime    = $request->input('endTime');
        if(!$endTime){
            $endTime = date('Y-m-d',$time+24*60*60);
        }

        /**0-all：整体进度
         * 0-all
         */
        $all        = $this->getResInfo('0',$version,$integrate,$startTime,$endTime);
        /**1-api
         * 1-api
         */
        $api        = $this->getResInfo('1',$version,$integrate,$startTime,$endTime);
        /**2-bug
         * 2-bug
         */
        $bug        = $this->getResInfo('2',$version,$integrate,$startTime,$endTime);
        /**3-listLeft
         * 3-listLeft
         */
        $ListLeft   = $this->getResInfo('3',$version,$integrate,$startTime,$endTime);
        /**4-listRight
         * 4-listRight
         */
        $ListRight  = $this->getResInfo('4',$version,$integrate,$startTime,$endTime);
        /**5-pmdLeft
         * 5-pmdLeft
         */
        $pmdLeft    = $this->getResInfo('5',$version,$integrate,$startTime,$endTime);
        /**6-pmdRight
         * 6-pmdRight
         */
        $pmdRight   = $this->getResInfo('6',$version,$integrate,$startTime,$endTime);
        /**故事点信息
         * 7-story
         */
        $story      = $this->getResInfo('7',$version,$integrate,$startTime,$endTime);
        /**水球信息
         * 8-water
         */
        $water      = $this->getResInfo('8',$version,$integrate,$startTime,$endTime);
        
        /**倒计时信息
         * 发布时间-当天折算成天数
         * 如果大于等于0直接输出
         * 如果小于0 输入当前版本已上线
         */
        $edition= VersionModel::find($version);
        $edition=$edition->IssueDate;
        //计算发布时间到今天的差值
        $edition=strtotime($edition)-$time;
        if($edition > 0){
            //将差值四舍五入保留一位小数
            $edition=round($edition/(24*60*60),1);
            $edition='倒计时：'.$edition.'天';
        }else{
            $edition='版本已上线'; 
        }
        $arr=array();
        $arr['success'] = 1;
        $arr['message']='ok';
        $arr['data'] = [
            'all'           => $all,
            'api'           => $api,
            'bug'           => $bug,
            'newListLeft'   => $ListLeft,
            'newListRight'  => $ListRight,
            'pmdLeft'       => $pmdLeft,
            'pmdRight'      => $pmdRight,
            'story'         => $story,
            'water'         => $water,
            'edition'       => $edition
        ];
        return response()->json($arr);
    }


    function getResInfo($type,$version,$integrate,$startTime,$endTime)
    {
        //通过ORM模型从数据库中查询
        $res = ResourceModel::where('intVersionID','=',$version)
            ->where('intIntegrateID','=',$integrate)
            ->where('enumType','=',$type)
            ->whereBetween('resDate',[$startTime,$endTime])
            ->orderBy('created_at','desc')->first();
        if(!$res){
            return '{"date":{}}';
        }else{
            if($res->textJson){
                return $res->textJson;
            }else{
                return '{"date":{}}'; 
            } 
        }
    }
    


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

<?php
namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use App\Models\Campaign\YS\IntegrateModel;
use App\Models\Campaign\YS\ResourceModel;
use App\Models\Campaign\YS\VersionModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResourceController extends Controller {

    /**
     * 资源数据首页
     * @param $integrate
     * @param $version
     * @param $enumType
     * @return Factory|View
     */
    public function index($integrate,$version,$enumType)
    {
        $user=Auth::user();
        $pages=array();
        if(!empty($user)){
            $pages["login"]="1";
        }
        $res = ResourceModel::where('intVersionID','=',$version)->where('intIntegrateID','=',$integrate)
            ->where('enumType','=',$enumType)->paginate(15);
        $title=[
            '整体数据（0-all）',
            '压力、静态代码、安全、接口、UI（1-Api）',
            '缺陷数据（2-Bug）',
            '流程接口（3-ListLeft）',
            '公共项目（4-ListRight）',
            '专项测试（5-pmdLeft）',
            '客户验证（6-PmdRight）',
            '故事点进度（7-Story）',
            '水球数据（8-Water）'
        ];
        $resVersion=VersionModel::find($version);
        $resIntegrate=IntegrateModel::find($integrate);
        if($resIntegrate){
            $chrIntegrateName=$resIntegrate->chrIntegrateName;
        }else{
            $chrIntegrateName='无';
        }
        return view('campaign.case05.resource.index',[
            'res'=>$res,
            'chrKey'=>$this->chrKey($enumType),
            'title'=>$title[$enumType],
            'version'=>$version,
            'chrVersionName'=>$resVersion->chrVersionName,
            'integrate'=>$integrate,
            'chrIntegrateName'=>$chrIntegrateName,
            'enumType'=>$enumType
        ])->with($pages);
    }

    /**
     * 资源数据详情维护
     * @param Request $request
     * @param int $id
     * @param $integrate
     * @param $version
     * @param $enumType
     * @return Factory|View
     */
    public function show(Request $request,$id,$integrate,$version,$enumType)
    {
        $res            = ResourceModel::find($id);
        $resVersion     = VersionModel::find($version);
        $resIntegrate   = IntegrateModel::find($integrate);
        if($resIntegrate){
            $chrIntegrateName=$resIntegrate->chrIntegrateName;
        }else{
            $chrIntegrateName='无';
        }
        if($request->isMethod('POST')){
            $data['data'] = $request->input('data');
            $res->textJson=json_encode($data);
            if($res->save()){
                return redirect('camp/resource/'.$integrate.'/'.$version.'/'.$enumType)
                    ->with('success','维护成功');
            }else{
                return redirect()->back()->with('error','维护失败');
            }
        }
        $data=json_decode($res->textJson,true);
        //处理新数据
        if(!$data){
            $data=array(
                'data'=>$this->firstArray($enumType)
            );
        }

        return view('campaign.case05.resource.show',[
            'res'=>$res,
            'data'=>$data['data'],
            'chrKey'=>$this->chrKey($enumType),
            'version'=>$version,
            'chrVersionName'=>$resVersion->chrVersionName,
            'integrate'=>$integrate,
            'chrIntegrateName'=>$chrIntegrateName,
            'enumType'=>$enumType,
        ]);
    }

    /**
     * 资源数据复制（已作废）
     * @param Request $request
     * @param $id
     * @param $integrate
     * @param $version
     * @param $enumType
     * @return Factory|RedirectResponse|View
     */
    public function copy(Request $request,$id,$integrate,$version,$enumType){
        $res            = ResourceModel::find($id);
        $resVersion     = VersionModel::find($version);
        $resIntegrate   = IntegrateModel::find($integrate);
        if($resIntegrate){
            $chrIntegrateName=$resIntegrate->chrIntegrateName;
        }else{
            $chrIntegrateName='无';
        }

        if($request->isMethod('POST')){
            $res=$request->input('res');
            $res['enumType']=$enumType;
            $res['intVersionID']=$version;
            $res['intIntegrateID']=$integrate;
            $res['textJson']='{"data":'.json_encode($request->input('data')).'}';
            if(ResourceModel::firstOrCreate($res)){
                return redirect('camp/resource/'.$integrate.'/'.$version.'/'.$enumType)->with('success','复制成功');
            }else{
                return redirect()->back()->with('error','复制失败');
            }
        }
        $data=json_decode($res->textJson,true);
        return view('campaign.case05.resource.copy',[
            'res'=>$res,
            'data'=>$data['data'],
            'chrKey'=>$this->chrKey($enumType),
            'version'=>$version,
            'chrVersionName'=>$resVersion->chrVersionName,
            'integrate'=>$integrate,
            'chrIntegrateName'=>$chrIntegrateName,
            'enumType'=>$enumType,
        ]);
    }

    /**
     * @param $enumType
     * @return mixed
     */
    function chrKey($enumType){
        $arg=['all','api','bug','listLeft','listRight','pmdLeft','pmdRight','story','water'];
        return $arg[$enumType];
    }

    /**
     * 新数据初始化（已作废）
     * @param $enumType
     * @return mixed
     */
    function firstArray($enumType){
        $today=date('Y-m-d',time());
        $arg=array(
            //all
            array('intSum'=>0,'intDone'=>0,'intDoing'=>0),
            //api
            array(
                'intPressureSum'=>'','intPressureFind'=>0,'intPressureResolved'=>0,
                'intStaticSum'=>'','intStaticFind'=>0,'intStaticResolved'=>0,
                'intSafetySum'=>'','intSafetyFind'=>0,'intSafetyResolved'=>0,
                'intApiSum'=>0,'intApiFind'=>0,'intApiResolved'=>0,
                'intUISum'=>0,'intUIFind'=>0,'intUIResolved'=>0
            ),
            array(//bug
                array('chrKey'=>'BPAAS','chrName'=>'平台','intSum'=>"0"),
                array('chrKey'=>'UPESN','chrName'=>'协同','intSum'=>"0"),
                array('chrKey'=>'HRY','chrName'=>'人力','intSum'=>"0"),
                array('chrKey'=>'CGUKC','chrName'=>'供应链','intSum'=>"0"),
                array('chrKey'=>'OMS','chrName'=>'营销云','intSum'=>"0"),
                array('chrKey'=>'YBZ','chrName'=>'财务','intSum'=>"0"),
                array('chrKey'=>'UCMFG','chrName'=>'制造','intSum'=>"0"),
            ),
            array(//listLeft
                array('chrKey'=>'BPAAS','chrName'=>'平台','floatSpeed'=>"0.00"),
                array('chrKey'=>'UPESN','chrName'=>'协同','floatSpeed'=>"0.00"),
                array('chrKey'=>'HRY','chrName'=>'人力','floatSpeed'=>"0.00"),
                array('chrKey'=>'CGUKC','chrName'=>'供应链','floatSpeed'=>"0.00"),
                array('chrKey'=>'OMS','chrName'=>'营销云','floatSpeed'=>"0.00"),
                array('chrKey'=>'YBZ','chrName'=>'财务','floatSpeed'=>"0.00"),
                array('chrKey'=>'UCMFG','chrName'=>'制造','floatSpeed'=>"0.00"),
            ),
            array(//listRight
                array('chrKey'=>'PP1','chrName'=>'公共项目1','floatSpeed'=>"0.00"),
                array('chrKey'=>'PP2','chrName'=>'公共项目2','floatSpeed'=>"0.00"),
                array('chrKey'=>'PP3','chrName'=>'公共项目3','floatSpeed'=>"0.00"),
                array('chrKey'=>'PP4','chrName'=>'公共项目4','floatSpeed'=>"0.00"),
                array('chrKey'=>'PP5','chrName'=>'公共项目5','floatSpeed'=>"0.00"),
                array('chrKey'=>'PP6','chrName'=>'公共项目6','floatSpeed'=>"0.00"),
                array('chrKey'=>'PP7','chrName'=>'公共项目7','floatSpeed'=>"0.00"),
            ),
            array(//pmdLeft
                array('chrKey'=>'ZX1','chrName'=>'专项1','floatSpeed'=>"0.00",'dateDate'=>$today),
                array('chrKey'=>'ZX2','chrName'=>'专项2','floatSpeed'=>"0.00",'dateDate'=>$today),
                array('chrKey'=>'ZX3','chrName'=>'专项3','floatSpeed'=>"0.00",'dateDate'=>$today),
                array('chrKey'=>'ZX4','chrName'=>'专项4','floatSpeed'=>"0.00",'dateDate'=>$today),
                array('chrKey'=>'ZX5','chrName'=>'专项5','floatSpeed'=>"0.00",'dateDate'=>$today),
                array('chrKey'=>'ZX6','chrName'=>'专项6','floatSpeed'=>"0.00",'dateDate'=>$today),
                array('chrKey'=>'ZX7','chrName'=>'专项7','floatSpeed'=>"0.00",'dateDate'=>$today),
            ),
            array(//pmdRight
                array('chrKey'=>'Customer1','chrName'=>'客户1','floatSpeed'=>"0.00",'dateDate'=>$today),
                array('chrKey'=>'Customer2','chrName'=>'客户2','floatSpeed'=>"0.00",'dateDate'=>$today),
                array('chrKey'=>'Customer3','chrName'=>'客户3','floatSpeed'=>"0.00",'dateDate'=>$today),
                array('chrKey'=>'Customer4','chrName'=>'客户4','floatSpeed'=>"0.00",'dateDate'=>$today),
                array('chrKey'=>'Customer5','chrName'=>'客户5','floatSpeed'=>"0.00",'dateDate'=>$today),
                array('chrKey'=>'Customer6','chrName'=>'客户6','floatSpeed'=>"0.00",'dateDate'=>$today),
                array('chrKey'=>'Customer7','chrName'=>'客户7','floatSpeed'=>"0.00",'dateDate'=>$today),
            ),
            array(//story
                array('chrKey'=>'BPAAS','chrName'=>'平台','floatSpeed'=>"0.00"),
                array('chrKey'=>'UPESN','chrName'=>'协同','floatSpeed'=>"0.00"),
                array('chrKey'=>'HRY','chrName'=>'人力','floatSpeed'=>"0.00"),
                array('chrKey'=>'CGUKC','chrName'=>'供应链','floatSpeed'=>"0.00"),
                array('chrKey'=>'OMS','chrName'=>'营销云','floatSpeed'=>"0.00"),
                array('chrKey'=>'YBZ','chrName'=>'财务','floatSpeed'=>"0.00"),
                array('chrKey'=>'UCMFG','chrName'=>'制造','floatSpeed'=>"0.00"),
            ),
            //water
            array("floatDevelop"=>"0.00","floatTest"=>"0.00","floatUser"=>"0.00","floatEditions"=>"0.00"),
        );
        return $arg[$enumType];
    }

    /**
     * 资源数据新增（已作废）
     * @param Request $request
     * @param $integrate
     * @param $version
     * @param $enumType
     * @return Factory|RedirectResponse|View
     */
    public function create(Request $request,$integrate,$version,$enumType)
    {
        $res= new ResourceModel();
        $resVersion=VersionModel::find($version);
        $resIntegrate=IntegrateModel::find($integrate);
        $res->resDate=date('Y-m-d',time());
        if($resIntegrate){
            $chrIntegrateName=$resIntegrate->chrIntegrateName;
        }else{
            $chrIntegrateName='无';
        }
        if($request->isMethod('POST')){
            $this->check($request);
            $data = $request->input('res');
            $data['enumType']=$enumType;
            $data['intVersionID']=$version;
            $data['intIntegrateID']=$integrate;
            $res=ResourceModel::firstOrCreate($data);
            if($res){
                return redirect('camp/resource/'.$res->id.'/show/'.$integrate.'/'.$version.'/'.$enumType)
                    ->with('success','添加成功');
            }else{
                return redirect()->back()->with('error','添加失败');
            }
        }

        return view('campaign.case05.resource.create',[
            'res'=>$res,
            'chrKey'=>$this->chrKey($enumType),
            'version'=>$version,
            'chrVersionName'=>$resVersion->chrVersionName,
            'integrate'=>$integrate,
            'chrIntegrateName'=>$chrIntegrateName,
            'enumType'=>$enumType,
            'heading'=>'新增资源数据',
        ]);
    }

    /**
     * 资源删除
     * @param $id
     * @param $integrate
     * @param $version
     * @param $enumType
     * @return RedirectResponse
     */
    public function destroy($id,$integrate,$version,$enumType)
    {

        $res =ResourceModel::find($id);
        if($res->delete()){
            return redirect('camp/resource/'.$integrate.'/'.$version.'/'.$enumType)->with('success','删除成功-'.$id);
        }else{
            return redirect('camp/resource/'.$integrate.'/'.$version.'/'.$enumType)->with('error','删除失败-'.$id);
        }
    }

    /**
     * 字段校验
     * @param $request
     */
    function check($request){
        $this->validate($request,[
//            'res.chrIntergrateKey'=>'required|min:2|max:15',
//            'res.chrIntegrateName'=>'required|min:2|max:15',
            'res.resDate'=>'required|date',
//            'res.end_at'=>'required|date',
        ],[
            'required'=>':attribute 为必填项',
//            'min'=>':attribute 长度不能低于 2 位',
//            'max'=>':attribute 长度不能超过 15 位',
//            'integer'=>':attribute 必须是整数',
            'date'=>':attribute 必须是日期',
        ],[
//            'res.chrIntergrateKey'=>'Key',
//            'res.chrIntegrateName'=>'版本号',
//            'res.start_at'=>'发版日期',
            'res.resDate'=>'业务日期',
        ]);
    }

    /**
     * 数据上传
     * @param Request $request
     * @param $integrate
     * @param $version
     * @param $enumType
     * @return Factory|RedirectResponse|View
     */
    public function upload(Request $request,$integrate,$version,$enumType){
        $resVersion=VersionModel::find($version);
        $resIntegrate=IntegrateModel::find($integrate);
        if($resIntegrate){
            $chrIntegrateName=$resIntegrate->chrIntegrateName;
        }else{
            $chrIntegrateName='无';
        }

        if($request->isMethod('POST')){
            $file = $request->file('file');
            $res = $request->input('res');
            $fileName=$this->uploadFile($file);
            if($fileName){
                //调用解析方法
                $this->import('storage/app/public/'.$fileName,$version,$integrate,$res['resDate']);
                return redirect('camp/resource/upload/'.$integrate.'/'.$version.'/'.$enumType)
                    ->with('success','上传成功');
            }else{
                return redirect()->back()->with('error','上传失败');
            }
        }
        return view('campaign.case05.resource.upload',[
            'resDate'=>date('Y-m-d',time()),
            'version'=>$version,
            'chrVersionName'=>$resVersion->chrVersionName,
            'integrate'=>$integrate,
            'chrIntegrateName'=>$chrIntegrateName,
            'enumType'=>$enumType,
            'heading'=>'新增资源数据',
        ]);
    }

    /**
     * 处理上传文件
     * @param $file
     * @param string $disk
     * @return bool
     */
    function uploadFile($file, $disk='public'){
        // 1.是否上传成功
        if (! $file->isValid()) {
            return false;
        }
        // 2.是否符合文件类型 getClientOriginalExtension 获得文件后缀名
        $fileExtension = $file->getClientOriginalExtension();
        if(! in_array($fileExtension, ['xlsx', 'xls'])) {
            return false;
        }
        // 3.判断大小是否符合 2M
        $tmpFile = $file->getRealPath();
        if (filesize($tmpFile) >= 2048000) {
            return false;
        }
        // 4.是否是通过http请求表单提交的文件
        if (! is_uploaded_file($tmpFile)) {
            return false;
        }
        // 5.每天一个文件夹,分开存储, 生成一个随机文件名
        $fileName = date('Y_m_d').'/'.md5(time()) .mt_rand(0,9999).'.'. $fileExtension;
        if (Storage::disk($disk)->put($fileName, file_get_contents($tmpFile)) ){
            return $fileName;
        }
    }

    /**
     * 解析Excel文件内容
     * @param string $filePath
     * @param int $version
     * @param int $integrate
     * @param string $resDate
     */
    function import($filePath,$version,$integrate,$resDate){
        Excel::load($filePath, function($reader) use($version,$integrate,$resDate) {
            //处理公共参数
            $data['intVersionID']=$version;
            $data['intIntegrateID']=$integrate;
            $data['resDate']=$resDate;

            //0-all-整体数据
            $data['enumType']=0;
            $res=$this->readExcelSheet($reader,$data['enumType']);
            $obj=ResourceModel::firstOrNew($data);
            $jsonArray=array(
                'data'=>array(
                    $res[0][0]=>$res[2][0],
                    $res[0][1]=>$res[2][1],
                    $res[0][2]=>$res[2][2]
                )
            );
            $obj->textJson=json_encode($jsonArray);
            $obj->save();
            //api
            $data['enumType']=1;
            $res=$this->readExcelSheet($reader,$data['enumType']);
            $obj=ResourceModel::firstOrNew($data);
            $jsonArray=array(
                'data'=>array(
                    $res[0][0]=>$res[2][0],
                    $res[0][1]=>$res[2][1],
                    $res[0][2]=>$res[2][2],
                    $res[0][3]=>$res[2][3],
                    $res[0][4]=>$res[2][4],
                    $res[0][5]=>$res[2][5],
                    $res[0][6]=>$res[2][6],
                    $res[0][7]=>$res[2][7],
                    $res[0][8]=>$res[2][8],
                    $res[0][9]=>$res[2][9],
                    $res[0][10]=>$res[2][10],
                    $res[0][11]=>$res[2][11],
                    $res[0][12]=>$res[2][12],
                    $res[0][13]=>$res[2][13],
                    $res[0][14]=>$res[2][14],
                    $res[0][15]=>$res[2][15],
                    $res[0][16]=>$res[2][16],
                    $res[0][17]=>$res[2][17],
                    $res[0][18]=>$res[2][18],
                    $res[0][19]=>$res[2][19],
                )
            );
            $obj->textJson=json_encode($jsonArray);
            $obj->save();
            //Bug 缺陷数据
            $data['enumType']=2;
            $this->readExcelInDataBase($reader,$data);

            //3-listLeft
            $data['enumType']=3;
            $this->readExcelInDataBase($reader,$data);

            //4-listRight
            $data['enumType']=4;
            $this->readExcelInDataBase($reader,$data);

            //5-pmdLeft
            $data['enumType']=5;
            $this->readExcelInDataBase2($reader,$data);

            //6-pmdRight
            $data['enumType']=6;
            $this->readExcelInDataBase2($reader,$data);

            //7-story故事点进度
            $data['enumType']=7;
            $this->readExcelInDataBase($reader,$data);

            //water-水球数据
            $data['enumType']=8;
            $res=$this->readExcelSheet($reader,$data['enumType']);

            $obj=ResourceModel::firstOrNew($data);
            $jsonArray=array(
                'data'=>array(
                    $res[0][0]=>$res[2][0],
                    $res[0][1]=>$res[2][1],
                    $res[0][2]=>$res[2][2],
                    $res[0][3]=>$res[2][3]
                )
            );
            $obj->textJson=json_encode($jsonArray);
            $obj->save();
        });
    }

    /**
     * 读取Excel并入库
     * @param $reader
     * @param $data
     * @return
     */
    function readExcelInDataBase($reader,$data){
        $obj=ResourceModel::firstOrNew($data);
        $res=readExcelSheet($reader,$data['enumType']);
        $jsonArray=array();
        foreach ($res as $key=>$item){
            if ($key > 1){
                $jsonArray['data'][]=array(
                    $res[0][0]=>$item[0],
                    $res[0][1]=>$item[1],
                    $res[0][2]=>$item[2]
                );
            }
        }
        $obj->textJson=json_encode($jsonArray);
        $arg=$obj->save();
        return $arg;
    }

    /**
     * 读取Excel并入库
     * @param $reader
     * @param $data
     */
    function readExcelInDataBase2($reader,$data){
        $obj=ResourceModel::firstOrNew($data);
        $res=readExcelSheet($reader,$data['enumType']);
        $jsonArray=array();
        foreach ($res as $key=>$item){
            if ($key > 1){
                $jsonArray['data'][]=array(
                    $res[0][0]=>$item[0],
                    $res[0][1]=>$item[1],
                    $res[0][2]=>$item[2],
                    $res[0][3]=>$item[3]
                );
            }
        }
        $obj->textJson=json_encode($jsonArray);
        $obj->save();
    }

    /**
     * Excel解析，按sheet索引解析数据
     * @param $reader
     * @param $sheet
     * @return array
     */
    function readExcelSheet($reader,$sheet){
        $arg=array();
        //获取excel的第几张表
        $reader = $reader->getSheet($sheet);
        //获取表中的数据
        $data = $reader->toArray();
        foreach ($data as $item){
            if($item[0]){
                $arg[]=$item;
            }
        }
        return $arg;
    }


    /**
     * Excel解析按sheet标题解析数据
     * @param $reader
     * @param $title
     * @return array
     */
    function readExcelSheetTitle($reader,$title){
        $arg=array();
        //获取excel的第几张表
        $reader = $reader->getTitle($title);
        //获取表中的数据
        $data = $reader->toArray();
        foreach ($data as $item){
            if($item[0]){
                $arg[]=$item;
            }
        }
        return $arg;
    }

    /**
     * 模板下载
     * @return BinaryFileResponse
     */
    public function download()
    {
        $file=storage_path('download/YS质量分析上传数据模板.xlsx');
        return response()->download($file);
    }


}

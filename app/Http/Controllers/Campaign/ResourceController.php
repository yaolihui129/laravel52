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

class ResourceController extends Controller {

    /**
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
     * Display the specified resource.
     *
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
//            dd($data['data']);
            if($res->save()){
                return redirect('camp/resource/'.$id.'/show/'.$integrate.'/'.$version.'/'.$enumType)->with('success','维护成功');
            }else{
                return redirect()->back()->with('error','维护失败');
            }
        }
        $data=json_decode($res->textJson,true);
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
            $data['data'] = $request->input('data');
            $data['enumType']=$enumType;
            $data['intVersionID']=$version;
            $data['intIntegrateID']=$integrate;
            $res->textJson=json_encode($data);
//            dd($data['data']);
            if(ResourceModel::create($data)){
                return redirect('camp/resource/'.$integrate.'/'.$version.'/'.$enumType)->with('success','复制成功');
            }else{
                return redirect()->back()->with('error','复制失败');
            }
        }
        $data=json_decode($res->textJson,true);
        if(!$data){
            $data=array(
                'data'=>$this->firstArray($enumType)
            );
        }

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
     * 新数据初始化
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
                array('chrKey'=>'BPAAS','chrName'=>'平台','floatSpeed'=>"0.00",'dateDate'=>$today),
                array('chrKey'=>'UPESN','chrName'=>'协同','floatSpeed'=>"0.00",'dateDate'=>$today),
                array('chrKey'=>'HRY','chrName'=>'人力','floatSpeed'=>"0.00",'dateDate'=>$today),
                array('chrKey'=>'CGUKC','chrName'=>'供应链','floatSpeed'=>"0.00",'dateDate'=>$today),
                array('chrKey'=>'OMS','chrName'=>'营销云','floatSpeed'=>"0.00",'dateDate'=>$today),
                array('chrKey'=>'YBZ','chrName'=>'财务','floatSpeed'=>"0.00",'dateDate'=>$today),
                array('chrKey'=>'UCMFG','chrName'=>'制造','floatSpeed'=>"0.00",'dateDate'=>$today),
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
            if(ResourceModel::create($data)){
                return redirect('camp/resource/'.$integrate.'/'.$version.'/'.$enumType)->with('success','添加成功');
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
     * @param Request $request
     * @param $id
     * @param $integrate
     * @param $version
     * @param $enumType
     * @return Factory|RedirectResponse|View
     */
    public function edit(Request $request,$id,$integrate,$version,$enumType)
    {
        $res=ResourceModel::find($id);
        $resVersion=VersionModel::find($version);
        $resIntegrate=IntegrateModel::find($integrate);
        if($resIntegrate){
            $chrIntegrateName=$resIntegrate->chrIntegrateName;
        }else{
            $chrIntegrateName='无';
        }
        if($request->isMethod('POST')){
            $this->check($request);
            $data=$request->input('res');
            $res['resDate']=$data['resDate'];
            if($res->save()){
                return redirect('camp/resource/'.$integrate.'/'.$version.'/'.$enumType)->with('success','修改成功-'.$id);
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
            'heading'=>'编辑资源数据',
        ]);
    }

    /**
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




}

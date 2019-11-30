<?php
namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use App\Models\Campaign\YS\IntegrateModel;
use App\Models\Campaign\YS\ResourceModel;
use App\Models\Campaign\YS\VersionModel;
use Illuminate\Contracts\View\Factory;
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
        //添加分页的查询
        $res = ResourceModel::where('intVersionID','=',$version)->where('intIntegrateID','=',$integrate)
            ->where('enumType','=',$enumType)->paginate(15);
        if($enumType==1){
            $chrKey='api';
            $title='压力、静态代码、安全、接口、UI（1-Api）';
        }elseif ($enumType==2){
            $chrKey='bug';
            $title='缺陷数据（2-Bug）';
        }elseif ($enumType==3){
            $chrKey='listLeft';
            $title='流程接口（3-ListLeft）';
        }elseif ($enumType==4){
            $chrKey='listRight';
            $title='公共项目（4-ListRight）';
        }elseif ($enumType==5){
            $chrKey='pmdLeft';
            $title='专项测试（5-pmdLeft）';
        }elseif ($enumType==6){
            $chrKey='pmdRight';
            $title='客户验证（6-PmdRight）';
        }elseif ($enumType==7){
            $chrKey='story';
            $title='故事点进度（7-Story）';
        }elseif ($enumType==8){
            $chrKey='water';
            $title='水球数据（8-Water）';
        }else{
            $chrKey='all';
            $title='整体数据（0-all）';
        }
        $resVersion=VersionModel::find($version);
        $resIntegrate=IntegrateModel::find($integrate);
        if($resIntegrate){
            $chrIntegrateName=$resIntegrate->chrIntegrateName;
        }else{
            $chrIntegrateName='无';
        }
        return view('campaign.case05.resource.index',[
            'res'=>$res,
            'chrKey'=>$chrKey,
            'title'=>$title,
            'version'=>$version,
            'chrVersionName'=>$resVersion->chrVersionName,
            'integrate'=>$integrate,
            'chrIntegrateName'=>$chrIntegrateName,
            'enumType'=>$enumType
        ])->with($pages);
    }


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
        if($enumType==1){
            $chrKey='api';
        }elseif ($enumType==2){
            $chrKey='bug';
        }elseif ($enumType==3){
            $chrKey='listLeft';
        }elseif ($enumType==4){
            $chrKey='listRight';
        }elseif ($enumType==5){
            $chrKey='pmdLeft';
        }elseif ($enumType==6){
            $chrKey='pmdRight';
        }elseif ($enumType==7){
            $chrKey='story';
        }elseif ($enumType==8){
            $chrKey='water';
        }else{
            $chrKey='all';
        }
        if($request->isMethod('POST')){
            $this->check($request);
            $data = $request->input('res');
            $data['enumType']=$enumType;
            $data['intVersionID']=$version;
            $data['intIntegrateID']=$integrate;
//            dd($data);
            if(ResourceModel::create($data)){
                return redirect('camp/resource/'.$integrate.'/'.$version.'/'.$enumType)->with('success','添加成功');
            }else{
                return redirect()->back()->with('error','添加失败');
            }
        }

        return view('campaign.case05.resource.create',[
            'res'=>$res,
            'chrKey'=>$chrKey,
            'version'=>$version,
            'chrVersionName'=>$resVersion->chrVersionName,
            'integrate'=>$integrate,
            'chrIntegrateName'=>$chrIntegrateName,
            'enumType'=>$enumType,
            'heading'=>'新增资源数据',
        ]);
    }




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
        if($enumType==1){
            $chrKey='api';
        }elseif ($enumType==2){
            $chrKey='bug';
        }elseif ($enumType==3){
            $chrKey='listLeft';
        }elseif ($enumType==4){
            $chrKey='listRight';
        }elseif ($enumType==5){
            $chrKey='pmdLeft';
        }elseif ($enumType==6){
            $chrKey='pmdRight';
        }elseif ($enumType==7){
            $chrKey='story';
        }elseif ($enumType==8){
            $chrKey='water';
        }else{
            $chrKey='all';
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
            'chrKey'=>$chrKey,
            'version'=>$version,
            'chrVersionName'=>$resVersion->chrVersionName,
            'integrate'=>$integrate,
            'chrIntegrateName'=>$chrIntegrateName,
            'enumType'=>$enumType,
            'heading'=>'编辑资源数据',
        ]);
    }

    public function destroy($id,$integrate,$version,$enumType)
    {

        $res =ResourceModel::find($id);
//        dd($res);
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

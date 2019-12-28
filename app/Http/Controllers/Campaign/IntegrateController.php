<?php
namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use App\Model\Campaign\YS\IntegrateModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class IntegrateController extends Controller {

    /**
     * @param $version
     * @return Factory|View
     */
    public function index($version)
    {
        $user=Auth::user();
        $pages=array();
        if(!empty($user)){
            $pages["login"]="1";
        }
        //添加分页的查询
        $res = IntegrateModel::where('intVersionID','=',$version)->paginate(15);
        return view('campaign.case05.integrate.index',[
            'res'=>$res,
            'version'=>$version,
        ])->with($pages);
    }


    public function create(Request $request,$version)
    {
        $res= new IntegrateModel();
        if($request->isMethod('POST')){
            $this->check($request);
            $data = $request->input('res');
            $data['intVersionID']=$version;
            if(IntegrateModel::create($data)){
                return redirect('camp/integrate/version/'.$version)->with('success','添加成功');
            }else{
                return redirect()->back()->with('error','添加失败');
            }
        }

        return view('campaign.case05.integrate.create',[
            'res'=>$res,
            'version'=>$version,
            'heading'=>'新增集成号',
        ]);
    }




    public function edit(Request $request,$id,$version)
    {
        $res=IntegrateModel::find($id);
        if($request->isMethod('POST')){
            $this->check($request);
            $data=$request->input('res');
            $res->chrIntergrateKey = $data['chrIntergrateKey'];
            $res->chrIntegrateName = $data['chrIntegrateName'];
//            $res->chrIntegrateDescribe = $data['chrIntegrateDescribe'];
            $res->start_at = $data['start_at'];
            $res->end_at = $data['end_at'];

            if($res->save()){
                return redirect('camp/integrate/version/'.$version)->with('success','修改成功-'.$id);
            }
        }
        return view('campaign.case05.integrate.create',[
            'res'=>$res,
            'version'=>$version,
            'heading'=>'编辑集成号',
        ]);
    }

    public function destroy($id,$version)
    {

        $teacher =IntegrateModel::find($id);
        if($teacher->delete()){
            return redirect("camp/integrate/version/".$version)->with('success','删除成功-'.$id);
        }else{
            return redirect("camp/integrate/version/".$version)->with('error','删除失败-'.$id);
        }
    }


    function check($request){
        $this->validate($request,[
            'res.chrIntergrateKey'=>'required|min:2|max:15',
            'res.chrIntegrateName'=>'required|min:2|max:15',
            'res.start_at'=>'required|date',
            'res.end_at'=>'required|date',
        ],[
            'required'=>':attribute 为必填项',
            'min'=>':attribute 长度不能低于 2 位',
            'max'=>':attribute 长度不能超过 15 位',
            'integer'=>':attribute 必须是整数',
            'date'=>':attribute 必须是日期',
        ],[
            'res.chrIntergrateKey'=>'Key',
            'res.chrIntegrateName'=>'版本号',
            'res.start_at'=>'发版日期',
            'res.end_at'=>'发版日期',
        ]);
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

}

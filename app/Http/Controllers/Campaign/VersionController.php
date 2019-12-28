<?php
namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use App\Model\Campaign\YS\VersionModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class VersionController extends Controller {

    /**
     * @return Factory|View
     */
    public function index()
    {
        $user=Auth::user();
        $pages=array();
        if(!empty($user)){
            $pages["login"]="1";
        }
        //添加分页的查询
        $res = VersionModel::paginate(15);
        return view('campaign.case05.version.index',[
            'res'=>$res,
        ])->with($pages);
    }


    public function create(Request $request)
    {
        $res= new VersionModel();
        if($request->isMethod('POST')){
            $this->check($request);
            $data = $request->input('res');
            if(VersionModel::create($data)){
                return redirect('camp/version')->with('success','添加成功');
            }else{
                return redirect()->back()->with('error','添加失败');
            }
        }

        return view('campaign.case05.version.create',[
            'res'=>$res,
            'heading'=>'新增版本',
        ]);
    }

    public function edit(Request $request,$id)
    {
        $res=VersionModel::find($id);
        if($request->isMethod('POST')){
            $this->check($request);
            $data=$request->input('res');
            $res->chrVersionKey = $data['chrVersionKey'];
            $res->chrVersionName = $data['chrVersionName'];
            $res->IssueDate = $data['IssueDate'];

            if($res->save()){
                return redirect('camp/version')->with('success','修改成功-'.$id);
            }
        }
        return view('campaign.case05.version.create',[
            'res'=>$res,
            'heading'=>'编辑版本',
        ]);
    }

    public function destroy($id)
    {

        $teacher =VersionModel::find($id);
        if($teacher->delete()){
            return redirect("camp/version")->with('success','删除成功-'.$id);
        }else{
            return redirect("camp/version")->with('error','删除失败-'.$id);
        }
    }


    function check($request){
        $this->validate($request,[
            'res.chrVersionKey'=>'required|min:2|max:15',
            'res.chrVersionName'=>'required|min:2|max:15',
            'res.IssueDate'=>'required|date',
        ],[
            'required'=>':attribute 为必填项',
            'min'=>':attribute 长度不能低于 2 位',
            'max'=>':attribute 长度不能超过 15 位',
            'integer'=>':attribute 必须是整数',
            'date'=>':attribute 必须是日期',
        ],[
            'res.chrVersionKey'=>'Key',
            'res.chrVersionName'=>'版本号',
            'res.IssueDate'=>'发版日期',
        ]);
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

}

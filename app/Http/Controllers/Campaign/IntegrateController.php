<?php
namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use App\Models\Campaign\YS\IntegrateModel;
use App\Models\Campaign\YS\VersionModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class IntegrateController extends Controller {

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
        $data = VersionModel::paginate(15);
        return view('campaign.case05.version',[
            'data'=>$data,
            'version'=>new VersionModel(),
        ])->with($pages);
    }


    public function create(Request $request)
    {
        $teacher= new VersionModel();
        if($request->isMethod('POST')){
            //校验
            $this->check($request);
            $data = $request->input('Teacher');
            if(VersionModel::create($data)){
                return redirect('Test/teacher')->with('success','添加成功');
            }else{
                return redirect()->back()->with('error','添加失败');
            }
        }

        return view('test.teacher.create',[
            'teacher'=>$teacher,
            'heading'=>'新增老师',
        ]);
    }


    public function store(Request $request)
    {
        $this->check($request);
        $data = $request->input('Teacher');
        if(VersionModel::create($data)){
            return redirect('Test/teacher')->with('success','添加成功');
        }else{
            return redirect()->back()->with('error','添加失败');
        }
    }


    public function show($id)
    {

        $teacher = VersionModel::find($id);
        return view('test.teacher.show',[
            'teacher'=>$teacher,
        ]);
    }

    public function edit(Request $request,$id)
    {
        $teacher=VersionModel::find($id);
        if($request->isMethod('POST')){
            $this->check($request);
            $data=$request->input('Teacher');
            $teacher->name = $data['name'];
            $teacher->age = $data['age'];
            $teacher->sex = $data['sex'];

            if($teacher->save()){
                return redirect('Test/teacher')->with('success','修改成功-'.$id);
            }
        }
        return view('test.teacher.create',[
            'teacher'=>$teacher,
            'heading'=>'编辑老师',
        ]);
    }

    public function destroy($id)
    {

        $teacher =VersionModel::find($id);
        if($teacher->delete()){
            return redirect("Test/teacher")->with('success','删除成功-'.$id);
        }else{
            return redirect("Test/teacher")->with('error','删除失败-'.$id);
        }
    }


    function check($request){
        $this->validate($request,[
            'Teacher.name'=>'required|min:2|max:10',
            'Teacher.age'=>'required|integer',
            'Teacher.sex'=>'required|integer',
        ],[
            'required'=>':attribute 为必填项',
            'min'=>':attribute 长度不能低于 2 位',
            'max'=>':attribute 长度不能超过 10 位',
            'integer'=>':attribute 必须是整数',
        ],[
            'Teacher.name'=>'姓名',
            'Teacher.age'=>'年龄',
            'Teacher.sex'=>'性别',
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

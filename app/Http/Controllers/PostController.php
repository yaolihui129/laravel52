<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Post;
class PostController extends Controller
{
    //文章列表
    public function index(){
        $posts = Post::orderBy('created_at','desc')->paginate(6);
        return view('posts/index',compact('posts'));
    }
    //文章详情
    public function show(Post $post){
        return view('posts/show',compact('post'));
    }
    //创建文章页
    public function create(){
        return view('posts/create');
    }
    //创建文章接口
    public function store(){
        //1.验证
        $this->validate(request(),[
            'title'=>'required|string|max:100|min:5',
            'content'=>'required|string|min:10',
        ]);
        //2.逻辑
        $post=Post::create(request(['title','content']));
        //3.渲染
        return redirect("/posts");

    }
    //修改文章接页
    public function edit(){
        return view('posts/edit');
    }
    //修改文章接口
    public function update(){

    }
    //删除文章接口
    public function delete(){

    }
}

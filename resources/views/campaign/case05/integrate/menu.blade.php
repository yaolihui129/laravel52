{{--继承模板--}}
@extends('campaign.common.layouts')

@section('container')
    <div class="row">
        <!-- 左侧菜单区域 -->
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ url('camp/integrate/version/'.$version ) }}" class="list-group-item
                {{ Request::getPathInfo() == '/camp/integrate/version/'.$version  ? 'active' :'' }}
                        "> 集成号列表</a>
                <a href="{{ url('camp/integrate/create/'.$version) }}" class="list-group-item
                {{ Request::getPathInfo() == '/camp/integrate/create/'.$version ? 'active' :'' }}
                        "> 新增集成号</a>
            </div>
        </div>
        <div class="col-md-9">
            @yield('content')
        </div>
    </div>
@stop

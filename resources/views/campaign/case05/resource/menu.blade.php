{{--继承模板--}}
@extends('campaign.common.layouts')

@section('container')
    <div class="row">
        <!-- 左侧菜单区域 -->
{{--        <div class="col-md-3">--}}
{{--            <div class="list-group">--}}
{{--                <a href="{{ url('camp/resource/version/'.$version ) }}" class="list-group-item--}}
{{--                {{ Request::getPathInfo() == '/camp/resource/version/'.$version  ? 'active' :'' }}--}}
{{--                        "> 集成号列表</a>--}}
{{--                <a href="{{ url('camp/resource/create/'.$version) }}" class="list-group-item--}}
{{--                {{ Request::getPathInfo() == '/camp/resource/create/'.$version ? 'active' :'' }}--}}
{{--                        "> 新增集成号</a>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="col-md-12">
            @yield('content')
        </div>
    </div>
@stop

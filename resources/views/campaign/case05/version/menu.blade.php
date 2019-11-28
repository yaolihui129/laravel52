{{--继承模板--}}
@extends('campaign.common.layouts')

@section('container')
    <div class="row">
        <!-- 左侧菜单区域 -->
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ url('camp/version') }}" class="list-group-item
                {{ Request::getPathInfo() == '/camp/version ' ? 'active' :'' }}
                        "> 版本列表</a>
                <a href="{{ url('camp/version/create') }}" class="list-group-item
                {{ Request::getPathInfo() == '/camp/version /create' ? 'active' :'' }}
                        "> 新增版本</a>
            </div>
        </div>
        <div class="col-md-9">
            @yield('content')
        </div>
    </div>
@stop

{{--继承主模板--}}
@extends('campaign.common.master')

{{--改写title--}}
@section('title')
    <title>数据维护</title>
@stop

@section('body')
    @include('campaign.common.header')
    <!-- 中间内容区域 -->
    <div class="container">
        @yield('container')
    </div>
    @include('campaign.common.footer')

@stop

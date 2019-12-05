{{--继承模板--}}
@extends('campaign.common.layouts')

@section('container')
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills" role="tablist">
                <li role="presentation"  class={{  $enumType == 9  ? "active" :"" }}>
                    <a href="{{url('camp/resource/upload/'.$integrate.'/'.$version.'/9')}}">数据上传 </a>
                </li>
                <li role="presentation" class={{  $enumType == 0  ? "active" :"" }}>
                    <a href="{{url('camp/resource/'.$integrate.'/'.$version.'/0')}}">整体</a>
                </li>
                <li role="presentation" class={{  $enumType == 5  ? "active" :"" }}>
                    <a href="{{url('camp/resource/'.$integrate.'/'.$version.'/5')}}">专项测试</a>
                </li>
                <li role="presentation" class={{  $enumType == 6  ? "active" :"" }}>
                    <a href="{{url('camp/resource/'.$integrate.'/'.$version.'/6')}}">客户验证 </a>
                </li>
                <li role="presentation" class={{  $enumType == 7  ? "active" :"" }}>
                    <a href="{{url('camp/resource/'.$integrate.'/'.$version.'/7')}}">故事点进度</a>
                </li>
                <li role="presentation" class={{  $enumType == 8  ? "active" :"" }}>
                    <a href="{{url('camp/resource/'.$integrate.'/'.$version.'/8')}}">水球数据</a>
                </li>
                <li role="presentation" class={{  $enumType == 2  ? "active" :"" }}>
                    <a href="{{url('camp/resource/'.$integrate.'/'.$version.'/2')}}">缺陷分析 </a>
                </li>
                <li role="presentation" class={{  $enumType == 3  ? "active" :"" }}>
                    <a href="{{url('camp/resource/'.$integrate.'/'.$version.'/3')}}">业务流程接口 </a>
                </li>
                <li role="presentation" class={{  $enumType == 1  ? "active" :"" }}>
                    <a href="{{url('camp/resource/'.$integrate.'/'.$version.'/1')}}">压力、静态代码</a>
                </li>
                <li role="presentation" class={{  $enumType == 4  ? "active" :"" }}>
                    <a href="{{url('camp/resource/'.$integrate.'/'.$version.'/4')}}">公共项目测试 </a>
                </li>
            </ul>

            @yield('content')
        </div>
    </div>
@stop

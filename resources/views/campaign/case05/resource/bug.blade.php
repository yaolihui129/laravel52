{{--继承模板--}}
@extends('campaign.case05.resource.menu')
{{--改写内容--}}
@section('content')
    <ul class="nav nav-pills" role="tablist">
        <li role="presentation"><a href="{{url('camp/resource/'.$integrate.'/'.$version.'/0')}}">整体</a></li>
        <li role="presentation"><a href="{{url('camp/resource/'.$integrate.'/'.$version.'/5')}}">专项测试</a></li>
        <li role="presentation"><a href="{{url('camp/resource/'.$integrate.'/'.$version.'/6')}}">客户验证 </a></li>
        <li role="presentation"><a href="{{url('camp/resource/'.$integrate.'/'.$version.'/7')}}">故事点进度</a></li>
        <li role="presentation"><a href="{{url('camp/resource/'.$integrate.'/'.$version.'/8')}}">水球数据</a></li>
        <li role="presentation"  class="active"><a href="{{url('camp/resource/'.$integrate.'/'.$version.'/2')}}">缺陷分析 </a></li>
        <li role="presentation"><a href="{{url('camp/resource/'.$integrate.'/'.$version.'/3')}}">业务流程接口 </a></li>
        <li role="presentation"><a href="{{url('camp/resource/'.$integrate.'/'.$version.'/1')}}">压力、静态代码</a></li>
        <li role="presentation"><a href="{{url('camp/resource/'.$integrate.'/'.$version.'/4')}}">公共项目测试 </a></li>
    </ul>
    <!-- 内容区域 -->
    @include('campaign.common.message')
    <div class="panel panel-default">
        <div class="panel-heading">{{$title}}</div>
        <table class="table table-striped table-hover table-responsive">
            <thead>
            <tr>
                <th>ID</th>
                <th>Key</th>
                <th>版本号</th>
                <th>集成号</th>
                <th>业务日期</th>
                <th>资源数据</th>
                <th>维护者</th>
                <th>维护时间</th>
                <th width="150">操作</th>
            </tr>
            </thead>

            <tbody>
            @foreach($res as $item)
                <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td>{{$chrKey}}</td>
                    <td>{{$chrVersionName}}</td>
                    <td>{{$chrIntegrateName}}</td>
                    <td>{{$item->resDate}}</td>
                    <td>{{$item->textJson}}</td>
                    <td>{{$item->updated_by}}</td>
                    <td>{{$item->updated_at}}</td>
                    <td>
                        <a href="{{ url('camp/integrate/'.$item->id.'/edit/'.$version) }}">修改</a>
                        <a href="{{ url('camp/integrate/'.$item->id).'/del/'.$version }}"
                           onclick="if(confirm('确定要删除吗？')== false) return false;">删除</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    <!-- 分页 -->
    <div>
        <div class="pull-right">
{{--            {!! $res->render() !!}--}}
        </div>
    </div>
@stop

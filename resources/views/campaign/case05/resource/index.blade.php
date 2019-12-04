{{--继承模板--}}
@extends('campaign.case05.resource.menu')
{{--改写内容--}}
@section('content')
    <!-- 内容区域 -->
    @include('campaign.common.message')
    <div class="panel panel-default">
        <div class="panel-heading">
            {{$title}}
            <a href="{{url('/camp/integrate/version/'.$version)}}" class="btn btn-warning btn-xs pull-right">返回</a>
        </div>
        <table class="table table-striped table-hover table-responsive">
            <thead>
            <tr>
                <th>ID</th>
                <th>Key</th>
                <th>版本号</th>
                <th>集成号</th>
                <th>业务日期</th>
{{--                <th>资源数据</th>--}}
                <th>维护者</th>
                <th>维护时间</th>
                <th width="150">操作：
                    <a href="{{url('camp/resource/create/'.$integrate.'/'.$version.'/'.$enumType)}}">新增</a>
                </th>
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
{{--                    <td>{{$item->textJson}}</td>--}}
                    <td>{{$item->updated_by}}</td>
                    <td>{{$item->updated_at}}</td>
                    <td>
                        <a href="{{ url('camp/resource/'.$item->id.'/show/'.$integrate.'/'.$version.'/'.$enumType) }}">详情</a>
                        <a href="{{ url('camp/resource/'.$item->id.'/copy/'.$integrate.'/'.$version.'/'.$enumType) }}">复制</a>
                        <a href="{{ url('camp/resource/'.$item->id).'/del/'.$integrate.'/'.$version.'/'.$enumType}}"
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
            {!! $res->render() !!}
        </div>
    </div>
@stop

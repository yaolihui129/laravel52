{{--继承模板--}}
@extends('campaign.case05.integrate.menu')
{{--改写内容--}}
@section('content')
    <!-- 内容区域 -->
    @include('campaign.common.message')
    <div class="panel panel-default">
        <div class="panel-heading">集成号
            <a href="{{url('/camp/version')}}" class="btn btn-warning btn-xs pull-right">返回</a>
        </div>
        <table class="table table-striped table-hover table-responsive">
            <thead>
            <tr>
                <th>ID</th>
                <th>Key-集成号</th>
                <th>开始日期</th>
                <th>结束日期</th>
                <th>修改时间</th>
                <th width="150">操作:
                    <a href="{{ url('camp/integrate/create/'.$version) }}">新增</a>
                </th>
            </tr>
            </thead>

            <tbody>
                <tr>
                    <th scope="row">0</th>
                    <td><a href="{{ url('camp/resource/0/'.$version.'/0') }}">YS0-无</a></td>
                    <td>--</td>
                    <td>--</td>
                    <td>--</td>
                    <td>
{{--                        <a href="{{ url('camp/resource/0/'.$version.'/0') }}">数据详情</a>--}}
                    </td>
                </tr>
            @foreach($res as $item)
                <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td>
                        <a href="{{ url('camp/resource/'.$item->id.'/'.$version.'/0') }}">
                            {{$item->chrIntergrateKey}}-{{$item->chrIntegrateName}}
                        </a>
                    </td>
                    <td>{{$item->start_at}}</td>
                    <td>{{$item->end_at}}</td>
                    <td>{{$item->updated_at}}</td>
                    <td>
{{--                        <a href="{{ url('camp/resource/'.$item->id.'/'.$version.'/0') }}">数据详情</a>--}}
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
            {!! $res->render() !!}
        </div>
    </div>
@stop

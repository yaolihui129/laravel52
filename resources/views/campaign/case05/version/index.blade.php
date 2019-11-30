{{--继承模板--}}
@extends('campaign.case05.version.menu')
{{--改写内容--}}
@section('content')
    <!-- 内容区域 -->
    @include('campaign.common.message')
    <div class="panel panel-default">
        <div class="panel-heading">版本维护</div>
        <table class="table table-striped table-hover table-responsive">
            <thead>
            <tr>
                <th>ID</th>
                <th>Key</th>
                <th>版本号</th>
                <th>发版时间</th>
                <th>修改时间</th>
                <th width="150">操作:
                    <a href="{{ url('camp/version/create') }}">新增</a>
                </th>
            </tr>
            </thead>

            <tbody>
            @foreach($res as $item)
                <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td>{{$item->chrVersionKey}}</td>
                    <td>{{$item->chrVersionName}}</td>
                    <td>{{$item->IssueDate}}</td>
                    <td>{{$item->updated_at}}</td>
                    <td>
                        <a href="{{ url('camp/integrate/version/'.$item->id) }}">集成号</a>
                        <a href="{{ url('camp/version/'.$item->id.'/edit') }}">修改</a>
                        <a href="{{ url('camp/version/'.$item->id).'/del' }}"
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

@extends('campaign.case05.resource.menu')

@section('content')
    @include('campaign.common.validator')
    <div class="panel panel-default">
        <div class="panel-heading">资源数据上传
            <a href="{{url('camp/resource/download/'.$integrate.'/'.$version.'/'.$enumType)}}">【模板下载】</a>

        </div>
        <div class="panel-body">

        </div>
    </div>
@stop

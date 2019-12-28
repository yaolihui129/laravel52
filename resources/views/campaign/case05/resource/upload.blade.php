@extends('campaign.case05.resource.menu')

@section('content')
    @include('campaign.common.message')
    @include('campaign.common.validator')
    <div class="panel panel-default">
        <div class="panel-heading">资源数据上传
            <a href="{{url('camp/resource/download/')}}">【模板下载】</a>
            <a href="{{url('/camp/integrate/version/'.$version)}}" class="btn btn-warning btn-xs pull-right">返回</a>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action=""  enctype="multipart/form-data">
            {!! csrf_field() !!}
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">版本号</label>
                    <div class="col-sm-5">
                        <input type="text" value="{{ $chrVersionName }}" class="form-control" readonly>
                    </div>
                    <div class="col-sm-5"></div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">集成号</label>
                    <div class="col-sm-5">
                        <input type="text" value="{{ $chrIntegrateName }}" class="form-control" readonly>
                    </div>
                    <div class="col-sm-5">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">业务日期</label>
                    <div class="col-sm-5">
                        <input type="date" name="res[resDate]" value="{{ $resDate }}" class="form-control">
                    </div>
                    <div class="col-sm-5">
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">上传</label>
                    <div class="col-sm-5">
                        <input type="file" name="file" class="form-control">
                    </div>
                    <div class="col-sm-5">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

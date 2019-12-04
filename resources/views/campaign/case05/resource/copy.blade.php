@extends('campaign.case05.resource.menu')

@section('content')
    @include('campaign.common.message')
    @include('campaign.common.validator')
    <div class="panel panel-default">
        <div class="panel-heading">资源数据详情</div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="name" class="col-sm-1 control-label">版本号</label>
                    <div class="col-sm-2">
                        <input type="text" value="{{ $chrVersionName }}" class="form-control" readonly>
                    </div>
                    <label for="name" class="col-sm-2 control-label">集成号</label>
                    <div class="col-sm-2">
                        <input type="text" value="{{ $chrIntegrateName }}" class="form-control" readonly>
                    </div>
                    <label for="name" class="col-sm-1 control-label">业务日期</label>
                    <div class="col-sm-2">
                        <input type="date" name="res[resDate]" value="{{ $res->resDate }}" class="form-control">
                    </div>
                    <label for="name" class="col-sm-1 control-label">chrKey</label>
                    <div class="col-sm-2">
                        <input type="text" value="{{$chrKey}}" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">资源数据（data）</label>
                    <div class="col-sm-10">
                        @include('campaign.case05.resource.'.$chrKey.'_form')
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">提交</button>
                        <a href="{{url('camp/resource/'.$integrate.'/'.$version.'/'.$enumType)}}"
                           type="button" class="btn btn-warning">取消</a>
                    </div>
                </div>

            </form>


        </div>
    </div>
@stop

@extends('campaign.common.layouts')

@section('content')
    @include('campaign.common.validator')
    <div class="panel panel-default">
        <div class="panel-heading">修改版本</div>
        <div class="panel-body">
            @include('campaign.case05.version._form')
        </div>
    </div>

@stop
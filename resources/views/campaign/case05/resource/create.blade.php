@extends('campaign.case05.resource.menu')

@section('content')
    @include('campaign.common.validator')
    <div class="panel panel-default">
        <div class="panel-heading">{{ $heading }}</div>
        <div class="panel-body">
            @include('campaign.case05.resource._form')
        </div>
    </div>
@stop

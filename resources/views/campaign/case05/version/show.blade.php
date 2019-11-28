@extends('campaign.case05.version.menu')

@section('content')
    <div class="panel panel-heading">老师详情</div>
    <table class="table table-bordered table-striped table-hover">
        <tbody>
        <tr>
            <td width="30%">ID</td>
            <td>{{ $teacher->id }}</td>
        </tr>
        <tr>
            <td >姓名</td>
            <td>{{ $teacher->name }}</td>
        </tr>
        <tr>
            <td >年龄</td>
            <td>{{ $teacher->age}}</td>
        </tr>
        <tr>
            <td >性别</td>
            <td>{{ $teacher->sex}}</td>
        </tr>
        <tr>
            <td >添加日期</td>
            <td>{{ $teacher->created_at }}</td>
        </tr>
        <tr>
            <td >最后修改</td>
            <td>{{ $teacher->updated_at }}</td>
        </tr>
        </tbody>
    </table>
@stop

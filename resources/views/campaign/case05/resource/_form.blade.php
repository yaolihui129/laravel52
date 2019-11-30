<form class="form-horizontal" method="post" action="">
    {!! csrf_field() !!}
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">chrKey</label>
        <div class="col-sm-5">
            <input type="text" value="{{$chrKey}}" class="form-control" readonly>
        </div>
        <div class="col-sm-5">
        </div>
    </div>
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
            <input type="date" name="res[resDate]"
                   value="{{ old('res')['resDate']?old('res')['resDate']:$res->resDate }}"
                   class="form-control" id="resDate" placeholder="请输入业务日期">
        </div>
        <div class="col-sm-5">
            <p class="form-control-static text-danger">{{ $errors->first('res.resDate') }}  </p>
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

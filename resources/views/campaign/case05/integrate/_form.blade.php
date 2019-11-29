<form class="form-horizontal" method="post" action="">
    {!! csrf_field() !!}
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Key</label>
        <div class="col-sm-5">
            <input type="text" name="res[chrIntergrateKey]" placeholder="请输入关键字"
                   value="{{old('res')['chrIntergrateKey']?old('res')['chrIntergrateKey']:$res->chrIntergrateKey}} "
                   class="form-control" id="chrIntergrateKey" >
        </div>
        <div class="col-sm-5">
            <p class="form-control-static text-danger">{{ $errors->first('res.chrIntergrateKey') }} </p>
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">集成号</label>
        <div class="col-sm-5">
            <input type="text" name="res[chrIntegrateName]"
                   value="{{ old('res')['chrIntegrateName']?old('res')['chrIntegrateName']:$res->chrIntegrateName }}"
                   class="form-control" id="chrIntegrateName" placeholder="请输入集成号">
        </div>
        <div class="col-sm-5">
            <p class="form-control-static text-danger">{{ $errors->first('res.chrIntegrateName') }}  </p>
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">开始日期</label>
        <div class="col-sm-5">
            <input type="date" name="res[start_at]"
                   value="{{ old('res')['start_at']?old('res')['start_at']:$res->start_at }}"
                   class="form-control" id="start_at" placeholder="请输入开始日期">
        </div>
        <div class="col-sm-5">
            <p class="form-control-static text-danger">{{ $errors->first('res.start_at') }}  </p>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">结束日期</label>
        <div class="col-sm-5">
            <input type="date" name="res[end_at]"
                   value="{{ old('res')['end_at']?old('res')['end_at']:$res->end_at }}"
                   class="form-control" id="end_at" placeholder="请输入结束日期">
        </div>
        <div class="col-sm-5">
            <p class="form-control-static text-danger">{{ $errors->first('res.end_at') }}  </p>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">提交</button>
        </div>
    </div>

</form>

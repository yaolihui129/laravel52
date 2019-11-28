<form class="form-horizontal" method="post" action="">
    {!! csrf_field() !!}
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Key</label>
        <div class="col-sm-5">
            <input type="text" name="res[chrVersionKey]" placeholder="请输入关键字"
                   value="{{old('res')['chrVersionKey']?old('res')['chrVersionKey']:$res->chrVersionKey}} "
                   class="form-control" id="chrVersionKey" >
        </div>
        <div class="col-sm-5">
            <p class="form-control-static text-danger">{{ $errors->first('res.chrVersionKey') }} </p>
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">版本号</label>
        <div class="col-sm-5">
            <input type="text" name="res[chrVersionName]"
                   value="{{ old('res')['chrVersionName']?old('res')['chrVersionName']:$res->chrVersionName }}"
                   class="form-control" id="chrVersionName" placeholder="请输入版本号">
        </div>
        <div class="col-sm-5">
            <p class="form-control-static text-danger">{{ $errors->first('res.chrVersionName') }}  </p>
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">发版时间</label>
        <div class="col-sm-5">
            <input type="date" name="res[IssueDate]"
                   value="{{ old('res')['IssueDate']?old('res')['IssueDate']:$res->IssueDate }}"
                   class="form-control" id="IssueDate" placeholder="请输入发版时间">
        </div>
        <div class="col-sm-5">
            <p class="form-control-static text-danger">{{ $errors->first('res.IssueDate') }}  </p>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">提交</button>
        </div>
    </div>

</form>

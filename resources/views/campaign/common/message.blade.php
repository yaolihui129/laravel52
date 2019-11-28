<!-- 成功提示 -->
@if(Session::has('success'))
    <div class="alert alert-success alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>成功</strong>{{ Session::get('success') }}
    </div>
@endif

<!-- 失败提示 -->
@if(Session::has('error'))
    <div class="alert alert-danger alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>失败</strong>{{ Session::get('error') }}
    </div>
@endif

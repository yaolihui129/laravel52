@if(count($errors)>0)
    <div class="alert alert-danger alert-error" role="alert">
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif

<table class="table table-striped table-hover table-responsive">
    <thead>
    <tr>
        <th>顺序</th>
        <th>关键字</th>
        <th>领域</th>
        <th>Bug总数</th>
    </tr>
    </thead>
    <tbody>
        @foreach($data as $key=>$item)
            <tr>
                <th scope="row">{{$key}}</th>
                <td>
                    <input type="text" name="{{'data['.$key.'][chrKey]'}}" value="{{isset($item['chrKey'])?$item['chrKey']:''}}"
                           class="form-control"  placeholder="请输领域关键字">
                </td>
                <td>
                    <input type="text" name="{{'data['.$key.'][chrName]'}}" value="{{isset($item['chrName'])?$item['chrName']:''}}"
                           class="form-control"  placeholder="请输领域简称">
                </td>
                <td>
                    <input type="number" name="{{'data['.$key.'][intSum]'}}" value="{{isset($item['intSum'])?$item['intSum']:''}}"
                           class="form-control"  placeholder="请输领域Bug数">
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

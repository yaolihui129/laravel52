<table class="table table-striped table-hover table-responsive">
    <thead>
    <tr>
        <th>顺序</th>
        <th>关键字</th>
        <th>领域</th>
        <th>百分比</th>
    </tr>
    </thead>
    <tbody>
        @foreach($data as $key=>$item)
            <tr>
                <th scope="row">{{$key}}</th>
                <td>
                    <input type="text" name="{{'data['.$key.'][chrKey]'}}" value="{{isset($item['chrKey'])?$item['chrKey']:''}}"
                           class="form-control"  placeholder="请输领域关键字" >
                </td>
                <td>
                    <input type="text" name="{{'data['.$key.'][chrName]'}}" value="{{isset($item['chrName'])?$item['chrName']:''}}"
                           class="form-control"  placeholder="请输领域简称" >
                </td>
                <td>
                    <input type="number" name="{{'data['.$key.'][floatSpeed]'}}" min="0.00" max="1.00" step="0.01"
                           value="{{isset($item['floatSpeed'])?$item['floatSpeed']:''}}"
                           class="form-control"  placeholder="请输领域百分比">
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

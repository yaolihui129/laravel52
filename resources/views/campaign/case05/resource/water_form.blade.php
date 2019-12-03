<table class="table table-striped table-hover table-responsive">
    <thead>
    <tr>
        <th>开发完成</th>
        <th>测试完成</th>
        <th>客户验证</th>
        <th>发版完成</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <input type="number" name="data[floatDevelop]" min="0.00" max="1.00" step="0.01"
                   value="{{isset($data['floatDevelop'])?$data['floatDevelop']:''}}"
                   class="form-control" placeholder="开发完成占比（0.00-1.00）">
        </td>
        <td>
            <input type="number" name="data[floatTest]" min="0.00" max="1.00" step="0.01"
                   value="{{isset($data['floatTest'])?$data['floatTest']:''}}"
                   class="form-control" id="intSum" placeholder="测试完成占比（0.00-1.00）">
        </td>
        <td>
            <input type="number" name="data[floatUser]" min="0.00" max="1.00" step="0.01"
                   value="{{isset($data['floatUser'])?$data['floatUser']:''}}"
                   class="form-control"  placeholder="客户验证占比（0.00-1.00）">
        </td>
        <td>
            <input type="number" name="data[floatEditions]" min="0.00" max="1.00" step="0.01"
                   value="{{isset($data['floatEditions'])?$data['floatEditions']:''}}"
                   class="form-control"  placeholder="发版完成占比（0.00-1.00）">
        </td>
    </tr>
    </tbody>
</table>

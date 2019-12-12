<table class="table table-striped table-hover table-responsive">
    <thead>
    <tr>
        <th>已完成（intDone）</th>
        <th>整体完成情况（intSum）</th>
        <th>未完成（intDoing）</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <input type="number" name="data[intDone]"
                   value="{{isset($data['intDone'])?trim($data['intDone']):''}}"
                   class="form-control" id="intDone" placeholder="请输入已完成数据">
        </td>
        <td>
            <input type="number" name="data[intSum]"
                   value="{{isset($data['intSum'])?trim($data['intSum']):''}}"
                   class="form-control" id="intSum" placeholder="请输入整体完成情况">
        </td>
        <td>
            <input type="number" name="data[intDoing]"
                   value="{{isset($data['intDoing'])?trim($data['intDoing']):''}}"
                   class="form-control" id="intDoing" placeholder="请输入未完成数据">
        </td>
    </tr>
    </tbody>
</table>

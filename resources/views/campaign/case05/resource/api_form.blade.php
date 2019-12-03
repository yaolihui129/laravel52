<table class="table table-striped table-hover table-responsive">
    <thead>
    <tr>
        <th>类型</th>
        <th>总数</th>
        <th>发现数</th>
        <th>解决数</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <input type="text" value="压力" class="form-control" readonly>
            </td>
            <td>
                <input type="number" name="data[intPressureSum]"
                       value="{{isset($data['intPressureSum'])?$data['intPressureSum']:''}}"
                       class="form-control" id="intPressureSum" placeholder="总数" readonly>
            </td>
            <td>
                <input type="number" name="data[intPressureFind]"
                       value="{{isset($data['intPressureFind'])?$data['intPressureFind']:''}}"
                       class="form-control" id="intPressureFind" placeholder="发现数">
            </td>
            <td>
                <input type="number" name="data[intPressureResolved]"
                       value="{{isset($data['intPressureResolved'])?$data['intPressureResolved']:''}}"
                       class="form-control" id="intPressureResolved" placeholder="解决数">
            </td>
        </tr>

        <tr>
            <td>
                <input type="text" value="静态代码" class="form-control" readonly>
            </td>
            <td>
                <input type="number" name="data[intStaticSum]"
                       value="{{isset($data['intStaticSum'])?$data['intStaticSum']:''}}"
                       class="form-control" id="intStaticSum" placeholder="总数" readonly>
            </td>
            <td>
                <input type="number" name="data[intStaticFind]"
                       value="{{isset($data['intStaticFind'])?$data['intStaticFind']:''}}"
                       class="form-control" id="intStaticFind" placeholder="发现数">
            </td>
            <td>
                <input type="number" name="data[intStaticResolved]"
                       value="{{isset($data['intStaticResolved'])?$data['intStaticResolved']:''}}"
                       class="form-control" id="intStaticResolved" placeholder="解决数">
            </td>
        </tr>

        <tr>
            <td>
                <input type="text" value="安全性" class="form-control" readonly>
            </td>
            <td>
                <input type="number" name="data[intSafetySum]"
                       value="{{isset($data['intDone'])?$data['intDone']:''}}"
                       value="{{ $data['intSafetySum']?$data['intSafetySum']:'' }}"
                       class="form-control" id="intSafetySum" placeholder="总数" readonly>
            </td>
            <td>
                <input type="number" name="data[intSafetyFind]"
                       value="{{isset($data['intSafetyFind'])?$data['intSafetyFind']:''}}"
                       class="form-control" id="intSafetyFind" placeholder="发现数">
            </td>
            <td>
                <input type="number" name="data[intSafetyResolved]"
                       value="{{isset($data['intSafetyResolved'])?$data['intSafetyResolved']:''}}"
                       class="form-control" id="intSafetyResolved" placeholder="解决数">
            </td>
        </tr>

        <tr>
            <td>
                <input type="text" value="接口自动化" class="form-control" readonly>
            </td>
            <td>
                <input type="number" name="data[intApiSum]"
                       value="{{isset($data['intApiSum'])?$data['intApiSum']:''}}"
                       class="form-control" id="intApiSum" placeholder="总数" >
            </td>
            <td>
                <input type="number" name="data[intApiFind]"
                       value="{{isset($data['intApiFind'])?$data['intApiFind']:''}}"
                       class="form-control" id="intApiFind" placeholder="发现数">
            </td>
            <td>
                <input type="number" name="data[intApiResolved]"
                       value="{{isset($data['intApiResolved'])?$data['intApiResolved']:''}}"
                       class="form-control" id="intApiResolved" placeholder="解决数">
            </td>
        </tr>

        <tr>
            <td>
                <input type="text" value="UI自动化" class="form-control" readonly>
            </td>
            <td>
                <input type="number" name="data[intUISum]"
                       value="{{isset($data['intUISum'])?$data['intUISum']:''}}"
                       class="form-control" id="intPressureSum" placeholder="总数">
            </td>
            <td>
                <input type="number" name="data[intUIFind]"
                       value="{{isset($data['intUIFind'])?$data['intUIFind']:''}}"
                       class="form-control" id="intUIFind" placeholder="发现数">
            </td>
            <td>
                <input type="number" name="data[intUIResolved]"
                       value="{{isset($data['intUIResolved'])?$data['intUIResolved']:''}}"
                       class="form-control" id="intUIFind" placeholder="解决数">
            </td>
        </tr>


    </tbody>
</table>

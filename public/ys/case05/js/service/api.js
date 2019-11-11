ApiUtil = function(me) {
    const reportUrl = "/ys/api";
    return me={
        init : function(version,integrate,startTime,endTime) {
            me.initApi(version,integrate,startTime,endTime);
            console.log('进入API');
        },
        initApi:function (version,integrate,startTime,endTime) {
            let requestData = {
                'version': version,
                'integrate': integrate,
                'startTime': startTime,
                'endTime': endTime
            };
            // ajax通用请求：
            CommonUtil.requestService(reportUrl + "/index" , requestData, true, "get", function(response) {
                if (!response.success) {
                    console.log('没有获取到数据');
                    $("#pressureFind").text('0');
                    $("#pressureResolve").text(0);

                    $("#staticFind").text(0);
                    $("#staticResolved").text(0);

                    $("#safetyFind").text(0);
                    $("#safetyResolved").text(0);

                    $("#apiSum").text(0);
                    $("#apiFind").text(0);
                    $("#apiResolved").text(0);
                    $("#apidate1").text('[0-0]');
                    $("#apidate2").text('[0-0]');

                    $("#uiSum").text(0);
                    $("#uiFind").text(0);
                    $("#uiResolved").text(0);
                    $("#uiDate1").text('[0-0]');
                    $("#uiDate2").text('[0-0]')
                } else {
                    console.log(response.data);
                    $("#pressureFind").text(response.data[0].intPressureFind);
                    $("#pressureResolve").text(response.data[0].intPressureResolved);

                    $("#staticFind").text(response.data[0].intStaticFind);
                    $("#staticResolved").text(response.data[0].intStaticResolved);

                    $("#safetyFind").text(response.data[0].intSafetyFind);
                    $("#safetyResolved").text(response.data[0].intSafetyResolved);

                    $("#apiSum").text(response.data[0].intApiSum);
                    $("#apiFind").text(response.data[0].intApiFind);
                    $("#apiResolved").text(response.data[0].intApiResolved);
                    $("#apidate1").text(response.data[0].dateApiDate);
                    $("#apidate2").text(response.data[0].dateApiDate);

                    $("#uiSum").text(response.data[0].intUISum);
                    $("#uiFind").text(response.data[0].intUIFind);
                    $("#uiResolved").text(response.data[0].intUIResolved);
                    $("#uiDate1").text(response.data[0].dateApiDate);
                    $("#uiDate2").text(response.data[0].dateApiDate)

                }
            }, function(ex) {
                console.log('Api异常：'+ex);
            });
        }
    }
}();
AllUtil = function(me) {
    const reportUrl = "/ys/all";
    return me={
        init : function(version,integrate,startTime,endTime) {
            me.initAll(version,integrate,startTime,endTime);
            console.log('进入ALL');
        },
        initAll:function (version,integrate,startTime,endTime) {
            let requestData = {
                'version': version,
                'integrate': integrate,
                'startTime': startTime,
                'endTime': endTime
            };
            // ajax通用请求：
            CommonUtil.requestService(reportUrl + "/index" , requestData, true, "get", function(response) {
                if (!response.success) {
                    console.log('ALL：没有获取到数据');
                    $("#allDoing").text('0');
                    $("#allDone").text('0');
                    $("#allSum").text('0')
                } else {
                    console.log(response.data);
                    $("#allDoing").text(response.data[0].intDoing);
                    $("#allDone").text(response.data[0].intDone);
                    $("#allSum").text(response.data[0].intSum)
                }
            }, function(ex) {
                console.log('ALL异常：'+ex);
            });
        }
    }
}();
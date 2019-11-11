PmdRightUtil = function(me) {
    const reportUrl = "/ys/pmdRight";
    return me={
        init : function(version,integrate,startTime,endTime) {
            me.initPmdRightModel(version,integrate,startTime,endTime);
            me.initPmdRight();
        },
        initPmdRightModel:function(version,integrate,startTime,endTime){
            const el  = document.getElementById('pmdRight_data');
            let childs = el.childNodes;

            let requestData = {
                'version': version,
                'integrate': integrate,
                'startTime': startTime,
                'endTime': endTime
            };
            // ajax通用请求：
            CommonUtil.requestService(reportUrl + "/index" , requestData, true, "get", function(response) {
                if (response.success) {
                    console.log(response.data);
                    if(childs){
                        for(let i = childs .length - 1; i >= 0; i--) {
                            el.removeChild(childs[i]);
                        }
                    }
                    for (let i = 0; i <response.data.length ; i++) {
                        let model ='' +
                            '<li>' +
                                '<a href="http://www.baidu.com">'+
                                    '<div class="row">' +
                                        '<div class="col-xs-2 pmd">' +
                                            '<img class="leftPng" style="margin-left: 100%;" src="/ys/case05/images/left.png">' +
                                        '</div>' +
                                        '<div class="col-xs-7 text-overflow" >' +
                                            '<div style="color: #8BC0EE;font-size: 18px" title="'+response.data[i].chrPmdRightName+'">'
                                                + response.data[i].chrPmdRightName +
                                            '</div>' +
                                            '<div style="color:#FDD71E;font-size: 15px">' +
                                                response.data[i].datePmdRightDate +
                                            '</div>' +
                                        '</div>' +
                                        '<div class="col-xs-3" >' +
                                            '<div>.</div>' +
                                            '<div style="color:#FDD71E;font-size: 15px">' +
                                                response.data[i].floatPmdRightSpeed.toFixed(4) * 100  +'%'+
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</a>' +
                            '</li>' +
                            '<li><br></li>';
                        $(model).appendTo($("#pmdRight_data"));
                    }
                }else {
                    console.log('pmdRight，没有获取到数据');
                    if(childs){
                        for(let i = childs .length - 1; i >= 0; i--) {
                            el.removeChild(childs[i]);
                        }
                    }
                    for (let i = 0; i < 7 ; i++) {
                        let model = '<li>' +
                            '<a href="http://www.baidu.com">' +
                                '<div class="row">' +
                                    '<div class="col-xs-2 pmd">' +
                                        '<img class="leftPng" style="margin-left: 100%;" src="/ys/case05/images/left.png">' +
                                    '</div>' +
                                    '<div class="col-xs-7 text-overflow" >' +
                                        '<div style="color: #8BC0EE;font-size: 18px">暂无相关数据</div>' +
                                        '<div style="color:#FDD71E;font-size: 15px"></div>' +
                                    '</div>' +
                                    '<div class="col-xs-3" >' +
                                        '<div>.</div>' +
                                        '<div style="color:#FDD71E;font-size: 15px"> 0 %</div>' +
                                    '</div>' +
                                '</div>' +
                            '</a>' +
                        '</li>' +
                        '<li><br></li>';
                        $(model).appendTo($("#pmdRight_data"));
                    }
                }
            }, function(ex) {
                console.log('pmdRight异常：'+ex);
            });
        },
        initPmdRight:function () {
            $('.dowebok_right').liMarquee({
                scrollamount: 10,
                direction: 'up',
                circular: false,
                // scrolldelay:5,
                runshort:false
            });
            $('.dowebok_right').css('height','39%');
            $('.dowebok_right').css('width','84%');
            $('.dowebok_right').css('margin-left','9%');
            $('.dowebok_right').css('margin-top','1.5%');
            $('.dowebok_right a').css('color','#FF9621');
            $('.dowebok_right').css('background-color','transparent');
            $('.dowebok_right a').css('font-size','20px');
            $('.dowebok_right .str_move').css('margin-top','5%');
            console.log('进入客户验证');
        }
    }
}();
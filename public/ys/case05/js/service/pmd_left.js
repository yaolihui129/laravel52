PmdLeftUtil = function(me) {
    const reportUrl = "/ys/pmdLeft";
    return me={
        init : function(version,integrate,startTime,endTime) {
            me.initPmdLeftModel(version,integrate,startTime,endTime);
            me.initPmdLeft();
        },

        initPmdLeftModel:function (version,integrate,startTime,endTime) {
            const el  = document.getElementById('pmdLeft_data');
            let childs = el.childNodes;

            let requestData = {
                'version': version,
                'integrate': integrate,
                'startTime': startTime,
                'endTime': endTime
            };
            //ajax通用请求：
            CommonUtil.requestService(reportUrl + "/index", requestData, true, "get", function(response) {
                if (response.success) {
                    console.table(response.data);
                    if(childs){
                        for(let i = childs .length - 1; i >= 0; i--) {
                            el.removeChild(childs[i]);
                        }
                    }
                    for (let i = 0; i <response.data.length ; i++) {
                        let model =
                            '<li>' +
                                '<a href="http://www.baidu.com">'+
                                    '<div class="row">' +
                                        '<div class="col-xs-2 pmd">' +
                                            '<img class="leftPng" style="margin-left: 100%;"' +
                                            'src="/ys/case05/images/left.png">' +
                                        '</div>' +
                                        '<div class="col-xs-7 text-overflow" >' +
                                            '<div style="color: #8BC0EE;font-size: 18px" title="'+response.data[i].chrSpecialName+'">'
                                                + response.data[i].chrSpecialName +
                                            '</div>' +
                                            '<div style="color:#FDD71E;font-size: 15px">'
                                                + response.data[i].dateSpecialDate +
                                            '</div>' +
                                        '</div>' +
                                        '<div class="col-xs-3" >' +
                                            '<div>.</div>' +
                                            '<div style="color:#FDD71E;font-size: 15px">'
                                                + response.data[i].floatSpecialSpeed.toFixed(4) * 100  +'%'+
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</a>' +
                            '</li>' +
                            '<li><br></li>';
                        $(model).appendTo($('#pmdLeft_data'));
                    }
                }else {
                    console.log('pmdLeft，未获取到值');
                    if(childs){
                        for(let i = childs .length - 1; i >= 0; i--) {
                            el.removeChild(childs[i]);
                        }
                    }
                    for (let i = 0; i < 7 ; i++) {
                        let model ='<li>' +
                            '<a href="http://www.baidu.com">'+
                                '<div class="row">' +
                                    '<div class="col-xs-2 pmd">' +
                                        '<img class="leftPng" style="margin-left: 100%;"' +
                                        'src="/ys/case05/images/left.png">' +
                                    '</div>' +
                                    '<div class="col-xs-7" >' +
                                        '<div style="color: #8BC0EE;font-size: 18px">暂无相关数据</div>' +
                                        '<div style="color:#FDD71E;font-size: 15px">0000-00-00</div>' +
                                    '</div>' +
                                    '<div class="col-xs-3" >' +
                                        '<div>.</div>' +
                                        '<div style="color:#FDD71E;font-size: 15px"> 0% </div>' +
                                    '</div>' +
                                '</div>' +
                            '</a>' +
                        '</li>' +
                        '<li><br></li>';
                        $(model).appendTo($('#pmdLeft_data'));
                    }
                }

            }, function(ex) {
                console.log('pmdLeft异常');
				console.table(ex);
            });
        },
        initPmdLeft:function () {
            $('.dowebok_left').liMarquee({
                scrollamount: 10,
                direction: 'up',
                circular: false,
                // scrolldelay:5,
                runshort:false
            });
            $('.dowebok_left').css('height','39%');
            $('.dowebok_left').css('width','84%');
            $('.dowebok_left').css('margin-left','9%');
            $('.dowebok_left').css('margin-top','1.5%');
            $('.dowebok_left a').css('color','#FF9621');
            $('.dowebok_left').css('background-color','transparent');
            $('.dowebok_left a').css('font-size','20px');
            $('.dowebok_left .str_move').css('margin-top','5%');
        }
    }
}();
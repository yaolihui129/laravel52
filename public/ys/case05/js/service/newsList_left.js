NewsListLeftUtil = function(me) {
    const reportUrl = "/ys/newsListLeft";
    return me={
        init : function(version,integrate,startTime,endTime) {
            me.newsListLeftModel(version,integrate,startTime,endTime);
            me.initNewsListLeft();
        },
        newsListLeftModel:function(version,integrate,startTime,endTime){
            let requestData = {
                'version': version,
                'integrate': integrate,
                'startTime': startTime,
                'endTime': endTime
            };
            // ajax通用请求：
            CommonUtil.requestService(reportUrl + "/index" , requestData, true, "get", function(response) {
                const el  = document.getElementById('left_ul');
                let childs = el.childNodes;
                if (response.success) {
                    console.table(response.data);
                    if(childs){
                        for(let i = childs .length - 1; i >= 0; i--) {
                            el.removeChild(childs[i]);
                        }
                    }
                    for (let i = 0; i <response.data.length ; i++) {
                        let model ='<li class="news-item">'+
                            '<a href="#">'+
                                '<div class="row">'+
                                    '<div class="col-xs-2">'+
                                        '<img style="margin-left: 10%"  src="/ys/case05/images/left3.png">'+
                                    '</div>'+
                                    '<div class="col-xs-7 text-overflow">'+
                                        '<div style="font-size: 20px;color: #20E1DD" title="'+response.data[i].chrNewListLeftName+'">'
                                            + response.data[i].chrNewListLeftName +
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-xs-3">'+
                                        '<div style="font-size: 20px;color: #F1EE74">'
                                            + response.data[i].floatNewListLeftSpeed.toFixed(4) *100 + '%'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</a>'+
                        '</li>';
                        $(model).appendTo($('#left_ul'));
                    }
                }else {
                    console.log('newsListLeft,没有获取到数据');
                    if(childs){
                        for(let i = childs .length - 1; i >= 0; i--) {
                            el.removeChild(childs[i]);
                        }
                    }
                    for (let i = 0; i <7 ; i++) {
                        let model ='<li class="news-item">'+
                            '<a href="#">'+
                                '<div class="row">'+
                                    '<div class="col-xs-2">'+
                                        '<img style="margin-left: 10%"  src="/ys/case05/images/left3.png">'+
                                    '</div>'+
                                    '<div class="col-xs-7 text-overflow">'+
                                        '<div style="font-size: 20px;color: #20E1DD">暂无对应数据</div>'+
                                    '</div>'+
                                    '<div class="col-xs-3">'+
                                        '<div style="font-size: 20px;color: #F1EE74">0%</div>'+
                                    '</div>'+
                                '</div>'+
                            '</a>'+
                        '</li>';
                        $(model).appendTo($('#left_ul'));
                    }
                }
            }, function(ex) {
                console.log("newsListLeft异常");
				console.table(ex);
            });
        },
        initNewsListLeft:function () {
            $(".demo_left").bootstrapNews({
                newsPerPage: 6,
                autoplay: true,
                pauseOnHover:true,
                direction: 'up',
                newsTickerInterval: 4000,
                navigation: false,
                // newsPerPage：每页显示的新闻条数。
                // navigation：是否为导航模式。
                // autoplay：是否自动滚动新闻。
                // direction：新闻的滚动方向。
                // animationSpeed：自动滚动新闻的速度。
                // newsTickerInterval：每隔几秒钟切换到下一条新闻。
                // pauseOnHover：是否在鼠标滑过是暂停新闻滚动。
                // onStop：新闻滚动停止时的回调函数。
                // onPause：新闻滚动暂停时的回调函数。
                // onReset：新闻滚动被重置时的回调函数。
                // onPrev：滚动到前一条新闻时的回调函数。
                // onNext：滚动到下一条新闻时的回调函数。
                // onToDo：回调函数。

            });
            $('#left_ul').css('height','');
            $('#left_ul').css('overflow-y','');
            console.log('进入业务流程接口');
        }
    }
}();
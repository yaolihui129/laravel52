BUGUtil = function(me) {
    const reportUrl = "/ys/BUG";
    return me={
        init : function(version,integrate,startTime,endTime) {
            me.bug(version,integrate,startTime,endTime);
            console.log('进入BUG');
        },
        bug : function(version,integrate,startTime,endTime) {
            let requestData = {
                'version': version,
                'integrate': integrate,
                'startTime': startTime,
                'endTime': endTime
            };
            //ajax通用请求：
            CommonUtil.requestService(reportUrl + "/index" , requestData, true, "get",
                function(response) {
                    let dataYAxis=[];
                    let dataSeries=[];
                    if (response.success) {
                        console.table(response.data);
                        for (let i = 0; i <response.data.length ; i++) {
                            dataYAxis.push(response.data[i].chrBugModel);
                            dataSeries.push(response.data[i].intBugSum);
                        }
                    }else {
                        console.log('BUG，未获取到值');
                        dataYAxis= ['数字化建模', '社交协同', '人力资源', '财务管理', '采购库存', '营销管理'];
                        dataSeries=[0, 0, 0, 0, 0, 0];
                    }
                    console.log(dataYAxis);
                    console.log(dataSeries);
                    me.initBug(dataYAxis,dataSeries);
                },
                function(ex) {
                    console.log('BUG，异常:'+ ex);
					console.table(ex);
                }
            );
        },
        initBug:function (dataYAxis,dataSeries) {
            // 基于准备好的dom，初始化echarts实例
            var myChart = echarts.init(document.getElementById('echart5'));
            var option = {
                //  backgroundColor: '#00265f',
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'
                    }
                },

                grid: {
                    left: '0%',
                    top: '10px',
                    right: '0%',
                    bottom: '2%',
                    containLabel: true
                },
                xAxis: [{
                    type: 'category',
                    data: dataYAxis,
                    axisLine: {
                        show: true,
                        lineStyle: {
                            color: "#F5F5F5",
                            width: 1,
                            type: "solid"
                        },
                    },

                    axisTick: {
                        show: false,
                    },
                    axisLabel: {
                        interval: 0,
                        // rotate:50,
                        show: true,
                        splitNumber: 15,
                        textStyle: {
                            color: "rgba(255,255,255,.6)",
                            fontSize: '12',
                        },
                    },
                }],
                yAxis: [{
                    type: 'value',
                    axisLabel: {
                        //formatter: '{value} %'
                        show: true,
                        textStyle: {
                            color: "rgba(255,255,255,.6)",
                            fontSize: '12',
                        },
                    },
                    axisTick: {
                        show: false,
                    },
                    axisLine: {
                        show: true,
                        lineStyle: {
                            color: "rgba(255,255,255,.1	)",
                            width: 1,
                            type: "solid"
                        },
                    },
                    splitLine: {
                        lineStyle: {
                            color: "rgba(255,255,255,.1)",
                        }
                    }
                }],
                series: [{
                    type: 'bar',
                    data:dataSeries,
                    barWidth: '35%', //柱子宽度
                    // barGap: 1, //柱子之间间距
                    itemStyle: {
                        normal: {
                            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                offset: 0,
                                color: 'rgba(0,244,255,1)' // 0% 处的颜色
                            }, {
                                offset: 1,
                                color: 'rgba(0,77,167,1)' // 100% 处的颜色
                            }], false),
                            barBorderRadius: [30, 30, 30, 30],
                            shadowColor: 'rgba(0,160,221,1)',
                            shadowBlur: 4,
                        }
                    }
                }
                ]
            };
            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);
            window.addEventListener("resize", function () {
                myChart.resize();
            });
        }
    }
}();
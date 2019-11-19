StoryUtil = function(me) {
    const reportUrl = "/ys/story";
    return me={
        init : function(version,integrate,startTime,endTime) {
            me.initStoryModel(version,integrate,startTime,endTime);
        },
        initStoryModel:function(version,integrate,startTime,endTime){
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
                            dataYAxis.push(response.data[i].chrStoryName);
                            dataSeries.push(response.data[i].floatStorySpeed.toFixed(4) * 100);
                        }
                    }else {
                        console.log('story，未获取到值');
                        dataYAxis=["营销管理","采购库存",'财务管理',"人力资源",'协同协同','数字化建模'];
                        dataSeries=[0, 0, 0, 0, 0, 0];
                    }
                    me.initStory(dataYAxis,dataSeries);
                },
                function(ex) {
                    console.log('story异常');
					console.table(ex);
                }
            );
        },
        initStory:function (dataYAxis,dataSeries) {
            // 基于准备好的dom，初始化echarts实例
            const myChart = echarts.init(document.getElementById('echart2'));
            let option = {
                tooltip: {
                    trigger: 'axis',
                    textStyle: {
                        align: 'left',
                        color: '#5cc1ff',
                        // color: '#fff',
                        fontSize: '16'
                    },
                    backgroundColor: 'rgba(15, 52, 135, 0.5)',
                    borderWidth: '1',
                    borderColor: '#5cc1ff',
                    extraCssText: 'box-shadow: 0 0 10px rgba(255, 255, 255, 0.7);',
                    formatter: function (params) {
                        return params[0].name + "<br />" + "<span style='color: white'>进度百分比: </span>" + "<span style='color: white'>" + params[0].value + "%</span>";
                    }
                },
                label: {
                    normal: {
                        textStyle: {
                            color: "rgb(0,255,132)"
                        }
                    },
                    emphasis: {
                        textStyle: {
                            color: "rgb(0,255,132)"
                        }
                    }
                },
                grid: {
                    left: '1%',
                    right: '7%',
                    bottom: '1%',
                    top: '30',
                    containLabel: true
                },
                yAxis: {
                    type: 'category',
                    axisLine: {
                        lineStyle: {
                            color: '#8ac7ff'
                        }
                    },
                    axisTick: {
                        show: false,
                        interval: 0,
                        alignWithLabel: true
                    },
                    axisLabel: {
                        interval: 0,
                        rotate: '0',
                        textStyle: {
                            fontSize: 10,
                            color: '#cee8ff'
                        }
                    },
                    data: dataYAxis,
                    splitLine: {
                        show: false
                    }
                },
                xAxis: {
                    type: 'value',
                    name: '',
                    splitLine: {
                        show: true,
                        lineStyle: {
                            color: ['rgba(138, 199, 255, .2)']
                        }
                    },
                    axisTick: {
                        show: false
                    },
                    axisLabel: {
                        show: false
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#01c2db'
                        }
                    }
                },
                series: [{
                    name: '数量',
                    type: 'bar',
                    stack: '总量',
                    barWidth: 20,
                    label: {
                        normal: {
                            show: true,
                            position: 'right',
                            formatter: "{c}%",
                            //formatter: "{b}:{c}%",
                            color: 'white'
                        }
                    },
                    itemStyle: {
                        normal: {
                            barBorderWidth: '0',
                            barBorderRadius: [10, 10, 10, 10],
                            barBorderColor: 'rgb(0,255,132)',
                            color: new echarts.graphic.LinearGradient(
                                0, 0, 1, 0,
                                [{
                                    offset: 0,
                                    color: '#f05f1c' /*#0085FA*/
                                }, {
                                    offset: 0.7,
                                    color: '#e9ea07' /*#00BBFD*/
                                }]),
                        },
                        emphasis: {
                            barBorderWidth: '1',
                            barBorderColor: 'rgb(0,255,132)'
                            // color: 'rgba(26,177,98,.8)'
                        }
                    },
                    // 顺序 从下向上 传入
                    data: dataSeries
                }]
            };

            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);
            window.addEventListener("resize", function () {
                myChart.resize();
            });
        }
    }
}();
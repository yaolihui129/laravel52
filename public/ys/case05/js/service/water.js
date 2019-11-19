WaterUtil = function(me) {
    const reportUrl = "/ys/water";
    return me={
        init : function(version,integrate,startTime,endTime) {
            me.water(version,integrate,startTime,endTime);
        },
        water : function(version,integrate,startTime,endTime) {
            let requestData = {
                'version': version,
                'integrate': integrate,
                'startTime': startTime,
                'endTime': endTime
            };
            // ajax通用请求：
            CommonUtil.requestService(reportUrl + "/index" , requestData, true, "get", function(response) {
                if (response.success) {
					console.table(response.data);
                    me.initWater1(response.data[0].floatWaterDevelop);
                    me.initWater2(response.data[0].floatWaterTest);
                    me.initWater3(response.data[0].floatWaterUser);
                    me.initWater4(response.data[0].floatWaterEditions);
                }else {
                    console.log('Water：没有获取到数据');
                    me.initWater1(0);
                    me.initWater2(0);
                    me.initWater3(0);
                    me.initWater4(0);
                }
            }, function(ex) {
                console.log('Water异常');
				console.table(ex);
            });
        },
        //water_development
        initWater1:function(value) {
            const myChart = echarts.init(document.getElementById('water_develop'));
            // var value = 0.48;
            let data = [value, value, value, value, value,];
            var option = {
                // backgroundColor: '#fff',
                title: {
                    text: '开发完成:',
                    textStyle: {
                        fontWeight: 'normal',
                        fontSize: 15,
                        color: '#F5F5F5'
                    }
                },
                series: [{
                    type: 'liquidFill',
                    radius: '90%',
                    // center: ['50%', '40%'],
                    data: data,
                    backgroundStyle: {
                        borderWidth: 5,
                        borderColor: '#1daaeb',
                        color: '#fff'
                    },
                    outline: {
                        borderDistance: 0,
                        itemStyle: {
                            borderWidth: 5,
                            borderColor: '#156ACF',
                            shadowBlur: 20
                            // shadowColor: 'rgba(255, 0, 0, 1)'
                        }
                    },
                    label: {
                        normal: {
                            formatter: (value * 100).toFixed(2) + '%',
                            // formatter: '开发完成:'+'\n'+(value * 100).toFixed(2) + '%',
                            textStyle: {
                                fontSize: 5
                            }
                        }
                    }
                }]
            };
            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);
            window.addEventListener("resize", function () {
                myChart.resize();
            });
        },
        //water_test
        initWater2:function(value) {
            var myChart = echarts.init(document.getElementById('water_test'));
            // var value = 0.67;
            var data = [value, value, value, value, value, ];
            var option = {
                // backgroundColor: '#fff',
                title: {
                    text: '测试完成:',
                    textStyle: {
                        fontWeight: 'normal',
                        fontSize: 15,
                        color: '#F5F5F5'
                    }
                },
                series: [{
                    type: 'liquidFill',
                    radius: '90%',
                    // center: ['50%', '40%'],
                    data: data,
                    backgroundStyle: {
                        borderWidth: 5,
                        borderColor: '#1daaeb',
                        color: '#fff'
                    },
                    outline: {
                        borderDistance: 0,
                        itemStyle: {
                            borderWidth: 5,
                            borderColor: '#156ACF',
                            shadowBlur: 20,
                            // shadowColor: 'rgba(255, 0, 0, 1)'
                        }
                    },
                    label: {
                        normal: {
                            formatter: (value * 100).toFixed(2) + '%',
                            textStyle: {
                                fontSize: 5
                            }
                        }
                    }
                }]
            };
            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);
            window.addEventListener("resize", function () {
                myChart.resize();
            });
        },
        //water_user
        initWater3:function(value) {
            var myChart = echarts.init(document.getElementById('water_user'));
            // var value = 0.32;
            var data = [value, value, value, value, value, ];
            var option = {
                // backgroundColor: '#fff',
                title: {
                    text: '客户验证:',
                    textStyle: {
                        fontWeight: 'normal',
                        fontSize: 15,
                        color: '#F5F5F5'
                    }
                },
                series: [{
                    type: 'liquidFill',
                    radius: '90%',
                    // center: ['50%', '40%'],
                    data: data,
                    backgroundStyle: {
                        borderWidth: 5,
                        borderColor: '#1daaeb',
                        color: '#fff'
                    },
                    outline: {
                        borderDistance: 0,
                        itemStyle: {
                            borderWidth: 5,
                            borderColor: '#156ACF',
                            shadowBlur: 20,
                            // shadowColor: 'rgba(255, 0, 0, 1)'
                        }
                    },
                    label: {
                        normal: {
                            formatter: (value * 100).toFixed(2) + '%',
                            textStyle: {
                                fontSize: 5
                            }
                        }
                    }
                }]
            };
            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);
            window.addEventListener("resize", function () {
                myChart.resize();
            });
        },
        //water_editions
        initWater4:function(value) {
            var myChart = echarts.init(document.getElementById('water_editions'));
            // var value = 0.72;
            var data = [value, value, value, value, value ];
            var option = {
                // backgroundColor: '#fff',
                title: {
                    text: '发版完成:',
                    textStyle: {
                        fontWeight: 'normal',
                        fontSize: 15,
                        color: '#F5F5F5'
                    }
                },
                series: [{
                    type: 'liquidFill',
                    radius: '90%',
                    // center: ['50%', '40%'],
                    data: data,
                    backgroundStyle: {
                        borderWidth: 5,
                        borderColor: '#1daaeb',
                        color: '#fff'
                    },
                    outline: {
                        borderDistance: 0,
                        itemStyle: {
                            borderWidth: 5,
                            borderColor: '#156ACF',
                            shadowBlur: 20,
                            // shadowColor: 'rgba(255, 0, 0, 1)'
                        }
                    },
                    label: {
                        normal: {
                            formatter: (value * 100).toFixed(2) + '%',
                            textStyle: {
                                fontSize: 5
                            }
                        }
                    }
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
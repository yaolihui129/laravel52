WaterUtil = function(me) {
    return me={
        init : function(res) {
            me.water(res);
        },
        water:function(res){
            console.table(res.data);
            if (res.data) {
                me.initWater(res.data.floatWaterDevelop,'water_develop','开发完成:');
                me.initWater(res.data.floatWaterTest,'water_test','测试完成:');
                me.initWater(res.data.floatWaterUser,'water_user','客户验证:');
                me.initWater(res.data.floatWaterEditions,'water_editions','发版完成:');
            }else {
                console.log('Water：没有获取到数据');
                me.initWater(0,'water_develop','开发完成:');
                me.initWater(0,'water_test','测试完成:');
                me.initWater(0,'water_user','客户验证:');
                me.initWater(0,'water_editions','发版完成:');
            }
        },
        initWater:function(value,el,arg){
            let myChart = echarts.init(document.getElementById(el));
            // var value = 0.48;
            let data = [value, value, value, value, value,];
            let option = {
                // backgroundColor: '#fff',
                title: {
                    text: arg,
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

    }
}();
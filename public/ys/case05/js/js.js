$(function() {
    /**
     * 定义参数变量
     */
    let version, integrate, startTime, endTime;
    //初始化显示
    init();
    /**
     * 页面初始化函数
     */
    function init() {
        //1. 获取版本列表
        initVersion();
        //2. 获取版本号，集成号，开始时间，结束时间
        getParams();
        //3. 获取集成号列表
        initIntegrate(version);
        //4. 时间戳初始化
        getTime();
        //5. 执行查询渲染
        getYSResource(version, integrate, startTime, endTime);
    }
    /**
     * 当点击查询按钮时
     */
    $('#search').on('click', function() {
        getParams();
        getYSResource(version, integrate, startTime, endTime);
    });

    /**
     * 当版本号变化时，重置集成号和时间
     */
    $("#version").change(function() {
        version = $('#version').val();
        initIntegrate(version);
        $("#integrate").val('0');
        $("#startTime").val('');
        $("#endTime").val('');
    });
    /**
     * 当集成号变化时，置空时间
     */
    $("#integrate").change(function() {
        $("#startTime").val('');
        $("#endTime").val('');
    });

    /**
     * 获取版本号，集成号，开始时间，结束时间
     */
    function getParams() {
        version = $('#version').val();
        integrate = $('#integrate').val();
        startTime = $('#startTime').val();
        endTime = $('#endTime').val();
    }
    /**
     * 初始化版本号
     */
    function initVersion() {
        const reportUrl = "/ys";
        //ajax通用请求：
        CommonUtil.requestService(reportUrl + "/getVersion", '', true, "get", function(response) {
            if (response.success) {
				console.table(response.data);
                const el = document.getElementById('version');
                let childs = el.childNodes;
                if (childs) {
                    for (let i = childs.length - 1; i >= 0; i--) {
                        el.removeChild(childs[i]);
                    }
                }
                for (let i = 0; i < response.data.length; i++) {
                    let model = '<option value="' + response.data[i].id + '">' +
                        response.data[i].chrVersionName +
                        '</option>';
                    $(model).appendTo($('#version'))
                }
            } else {
                console.log('getVersionList未获取到值');
            }
        }, function(ex) {
            console.log('getVersion异常');
            console.table(ex);
        });
    }
    /**
     * 初始化集成号
     * @param version
     */
    function initIntegrate(version) {
        const reportUrl = "/ys";
        let requestData = {
            'version': version,
        };
        //ajax通用请求：
        CommonUtil.requestService(reportUrl + "/getIntegrate", requestData, true, "get",
            function(response) {
                console.table(response.data);
                if (response.success) {
                    const el = document.getElementById('integrate');
                    let childs = el.childNodes;
                    if (childs) {
                        for (let i = childs.length - 1; i >= 0; i--) {
                            el.removeChild(childs[i]);
                        }
                    }
                    let model = '<option value="0">--请选择--</option>';
                    $(model).appendTo($('#integrate'));
                    for (let i = 0; i < response.data.length; i++) {
                        model = '<option value="' + response.data[i].id + '">' +
                            response.data[i].chrIntegrateName +
                            '</option>';
                        $(model).appendTo($('#integrate'))
                    }
                } else {
                    console.log('getIntegrate未获取到值');
                }
            },
            function(ex) {
                console.log('getIntegrate异常');
                console.table(ex);
            });
    }

    /**
     * 获取资源
     * @param version
     * @param integrate
     * @param startTime
     * @param endTime
     */
    function getYSResource(version, integrate, startTime, endTime) {
        const reportUrl = "/ys";
        let requestData = {
            'version': version,
            'integrate': integrate,
            'startTime': startTime,
            'endTime': endTime
        };
        //ajax通用请求
        CommonUtil.requestService(reportUrl + "/getYSResource", requestData, true, "get", function(response) {
            if (response.success) {
                //1-1专项 pmd_left();
                pmd($.parseJSON(response.data.pmdLeft),'pmdLeft_data');
                initPmd('left');
                //1-2故事点进度排行
                story($.parseJSON(response.data.story),'echart2');
                //1-3业务流程接口执行分析 newsList_left();
                newsList($.parseJSON(response.data.newListLeft),'left_ul');
                initNewsList('left','left_ul');
                //2-1整体完成情况 all();
                all($.parseJSON(response.data.all));
                //2-2倒计时
                edition(response.data.edition);
                //2-2水球数据
                water($.parseJSON(response.data.water))
                //2-3接口、UI、压力、静态代码、安全性
                api($.parseJSON(response.data.api));
                //3-1客户验证 pmd_right();
                // PmdRightUtil.init($.parseJSON(response.data.pmdRight));
                pmd($.parseJSON(response.data.pmdRight),'pmdRight_data');
                initPmd('right');
                //3-2缺陷BUG分析
                bug($.parseJSON(response.data.bug),'echart5')
                //3-3公共项目测试分析  newsList_right();
                newsList($.parseJSON(response.data.newListRight),'right_ul');
                initNewsList('right','right_ul');
            } else {
                console.log('getYSResource未获取到值');
            }
        }, function(ex) {
            console.log('getYSResource:Error');
            console.table(ex);
        });
    }

    /**
     * 渲染倒计时数据
     * @param res
     */
    function edition(res) {
        if (!res) {
            console.log('没有倒计时数据');
            $("#edition").text('倒计时：XX.X天');
        }else {
            $("#edition").text(res);
        }
    }

    /**
     * 渲染整体（all）数据
     * @param res
     */
    function all(res) {
        if (!res.data) {
            console.log('ALL：没有获取到数据');
            $("#allDoing").text('0');
            $("#allDone").text('0');
            $("#allSum").text('0')
        } else {
            console.table(res.data);
            $("#allDoing").text(res.data.intDoing);
            $("#allDone").text(res.data.intDone);
            $("#allSum").text(res.data.intSum)
        }
    }

    /**
     * 渲染水球数据
     * @param res
     */
    function water(res) {
        console.table(res.data);
        if (res.data) {
            initWater(res.data.floatDevelop,'water_develop','开发完成:');
            initWater(res.data.floatTest,'water_test','测试完成:');
            initWater(res.data.floatUser,'water_user','客户验证:');
            initWater(res.data.floatEditions,'water_editions','发版完成:');
        }else {
            console.log('Water：没有获取到数据');
            initWater(0,'water_develop','开发完成:');
            initWater(0,'water_test','测试完成:');
            initWater(0,'water_user','客户验证:');
            initWater(0,'water_editions','发版完成:');
        }
    }

    /**
     * 初始化水球
     * @param value
     * @param el
     * @param arg
     */
    function initWater(value,el,arg){
        let myChart = echarts.init(document.getElementById(el));
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

    /**
     * 渲染API数据
     * @param res
     */
    function api(res) {
        if (!res.data) {
            console.log('没有Api数据');
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
            console.table(res.data);
            console.log(res.data.pressureFind);
            $("#pressureFind").text(res.data.intPressureFind);
            $("#pressureResolve").text(res.data.intPressureResolved);

            $("#staticFind").text(res.data.intStaticFind);
            $("#staticResolved").text(res.data.intStaticResolved);

            $("#safetyFind").text(res.data.intSafetyFind);
            $("#safetyResolved").text(res.data.intSafetyResolved);

            $("#apiSum").text(res.data.intApiSum);
            $("#apiFind").text(res.data.intApiFind);
            $("#apiResolved").text(res.data.intApiResolved);
            $("#apidate1").text(res.data.dateApiDate1);
            $("#apidate2").text(res.data.dateApiDate2);

            $("#uiSum").text(res.data.intUISum);
            $("#uiFind").text(res.data.intUIFind);
            $("#uiResolved").text(res.data.intUIResolved);
            $("#uiDate1").text(res.data.dateUIDate1);
            $("#uiDate2").text(res.data.dateUIDate2)
        }
    }

    /**
     * 初始化时间组件
     */
    function getTime() {
        $("#startTime").change(function() {
            $("#endTime").val('');
        });
        $("#startTime").datepicker({
            // showAnim:'blind',
            changeMonth: true,
            defaultDate: '+1w',
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            todayHighlight: 1,
            background: "images/head_list.png",
            onClose: function(selectedDate) {
                $("#endTime").datepicker("option", "minDate", selectedDate);
            },
            monthNamesShort: ['01月', '02月', '03月', '04月', '05月', '06月', '07月', '08月', '09月', '10月', '11月', '12月']
        });
        $("#endTime").datepicker({
            // showAnim:'blind',
            changeMonth: true,
            defaultDate: "+1w",
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            onClose: function(selectedDate) {
                $("#startTime").datepicker("option", "maxDate", selectedDate);
            },
            monthNamesShort: ['01月', '02月', '03月', '04月', '05月', '06月', '07月', '08月', '09月', '10月', '11月', '12月']
        });

    }

    /**
     * 渲染故事点数据
     * @param res
     * @param elementId
     */
    function story(res,elementId) {
        console.table(res.data);
        let dataYAxis=[];
        let dataSeries=[];
        if (res.data) {
            for (let i = 0; i <res.data.length ; i++) {
                dataYAxis.push(res.data[i].chrName);
                dataSeries.push(res.data[i].floatSpeed.toFixed(4) * 100);
            }
        }else {
            console.log('story未获取到值');
            dataYAxis=["营销云","供应链",'财务',"人力",'协同','数字化建模'];
            dataSeries=[0, 0, 0, 0, 0, 0];
        }
        initStory(dataYAxis,dataSeries,elementId);
    }

    /**
     * 初始化故事点柱状图
     * @param dataYAxis
     * @param dataSeries
     * @param elementId
     */
    function initStory (dataYAxis,dataSeries,elementId) {
        // 基于准备好的dom，初始化echarts实例
        let myChart = echarts.init(document.getElementById(elementId));
        let option = {
            tooltip: {
                trigger: 'axis',
                textStyle: {
                    align: 'left',
                    color: '#5cc1ff',
                    fontSize: '16'
                },
                backgroundColor: 'rgba(15, 52, 135, 0.5)',
                borderWidth: '1',
                borderColor: '#5cc1ff',
                extraCssText: 'box-shadow: 0 0 10px rgba(255, 255, 255, 0.7);',
                formatter: function (params) {
                    return params[0].name + "<br />" +
                        "<span style='color: white'>进度百分比: </span>" +
                        "<span style='color: white'>" + params[0].value + "%</span>";
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

    /**
     * 渲染BUG分析数据
     * @param res
     * @param elementId
     */
    function bug(res,elementId){
        let dataYAxis=[];
        let dataSeries=[];
        if (res.data) {
            console.table(res.data);
            for (let i = 0; i <res.data.length ; i++) {
                dataYAxis.push(res.data[i].chrName);
                dataSeries.push(res.data[i].intSum);
            }
        }else {
            console.log('BUG未获取到值');
            dataYAxis= ['平台', '协同', '人力', '财务', '供应链', '营销云'];
            dataSeries=[0, 0, 0, 0, 0, 0];
        }
        initBug(dataYAxis,dataSeries,elementId);
    }

    /**
     * 初始化BUG柱状图
     * @param dataYAxis
     * @param dataSeries
     * @param elementId
     */
    function initBug(dataYAxis,dataSeries,elementId) {
        // 初始化echarts实例
        const myChart = echarts.init(document.getElementById(elementId));
        let option = {
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
                data: dataSeries,
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
            }]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
        window.addEventListener("resize", function () {
            myChart.resize();
        });
    }

    /**
     * 渲染Pmd数据
     * @param res
     * @param elementId
     */
    function pmd(res,elementId){
        let el  = document.getElementById(elementId);
        let childs = el.childNodes;
        if (res.data) {
            console.table(res.data);
            if(childs){
                for(let i = childs .length - 1; i >= 0; i--) {
                    el.removeChild(childs[i]);
                }
            }
            for (let i = 0; i <res.data.length ; i++) {
                let model ='<li>' +
                        '<a href="http://www.baidu.com">'+
                            '<div class="row">' +
                                '<div class="col-xs-2 pmd">' +
                                    '<img class="leftPng" style="margin-left: 100%;" src="/ys/case05/images/left.png">' +
                                '</div>' +
                                '<div class="col-xs-7 text-overflow" >' +
                                    '<div style="color: #8BC0EE;font-size: 18px" title="'+res.data[i].chrName+'">' +
                                        res.data[i].chrName +
                                    '</div>' +
                                    '<div style="color:#FDD71E;font-size: 15px">' +
                                        res.data[i].dateDate +
                                    '</div>' +
                                '</div>' +
                                '<div class="col-xs-3" >' +
                                    '<div>.</div>' +
                                    '<div style="color:#FDD71E;font-size: 15px">' +
                                        res.data[i].floatSpeed.toFixed(4) * 100  +'%'+
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</a>' +
                    '</li>' +
                    '<li><br></li>';
                $(model).appendTo($("#" + elementId));
            }
        }else {
            console.log(elementId + '没有获取到数据');
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
                $(model).appendTo($("#" + elementId));
            }
        }

    }

    /**
     * 初始化pmd轮播
     * @param position ('left' or 'right')
     */
    function initPmd (position) {
        $('.dowebok_'+ position).liMarquee({
            scrollamount: 10,
            direction: 'up',
            circular: false,
            // scrolldelay:5,
            runshort:false
        });
        $('.dowebok_' + position).css('height','39%');
        $('.dowebok_' + position).css('width','84%');
        $('.dowebok_' + position).css('margin-left','9%');
        $('.dowebok_' + position).css('margin-top','1.5%');
        $('.dowebok_' + position +'a').css('color','#FF9621');
        $('.dowebok_' + position).css('background-color','transparent');
        $('.dowebok_' + position +' a').css('font-size','20px');
        $('.dowebok_' + position +' .str_move').css('margin-top','5%');
    }

    /**
     * 渲染newsList数据
     * @param res
     * @param elementId
     */
    function newsList(res,elementId){
        let el  = document.getElementById(elementId);
        let childs = el.childNodes;
        if (res.data) {
            console.table(res.data);
            if(childs){
                for(let i = childs .length - 1; i >= 0; i--) {
                    el.removeChild(childs[i]);
                }
            }
            for (let i = 0; i <res.data.length ; i++) {
                let model ='<li class="news-item">'+
                    '<a href="#">'+
                        '<div class="row">'+
                            '<div class="col-xs-2">'+
                                '<img style="margin-left: 10%"  src="/ys/case05/images/left3.png">'+
                            '</div>'+
                            '<div class="col-xs-7 text-overflow">'+
                                '<div style="font-size: 20px;color: #20E1DD" title="'+res.data[i].chrName+'">' +
                                    res.data[i].chrName +
                                '</div>'+
                            '</div>'+
                            '<div class="col-xs-3">'+
                                '<div style="font-size: 20px;color: #F1EE74">' +
                                    res.data[i].floatSpeed.toFixed(4) *100 + '%'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</a>'+
                '</li>';
                $(model).appendTo($('#' + elementId));
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
                $(model).appendTo($('#' + elementId));
            }
        }
    }

    /**
     * 初始化NewList
     * @param position
     * @param elementId
     */
    function initNewsList(position,elementId) {
        $(".demo_" + position).bootstrapNews({
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
        $("#" + elementId).css('height','');
        $("#" + elementId).css('overflow-y','');
    }



});
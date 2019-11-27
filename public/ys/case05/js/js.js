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
                console.log('getVersionList，未获取到值');
            }
        }, function(ex) {
            console.log('getVersion:' + ex);
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
                    console.log('integrate,未获取到值');
                }
            },
            function(ex) {
                console.log('integrate异常：' + ex);
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
                // console.table($.parseJSON(response.data.bug));
                // console.table($.parseJSON(response.data.newListLeft));
                // console.table($.parseJSON(response.data.newListRight));
                // console.table($.parseJSON(response.data.pmdLeft));
                // console.table($.parseJSON(response.data.pmdRight));
                // console.table($.parseJSON(response.data.story));
                //1-1专项 pmd_left();
                PmdLeftUtil.init(version, integrate, startTime, endTime,$.parseJSON(response.data.pmdLeft));
                //1-2故事点进度排行
                StoryUtil.init(version, integrate, startTime, endTime,$.parseJSON(response.data.story));
                //1-3业务流程接口执行分析 newsList_left();
                NewsListLeftUtil.init(version, integrate, startTime, endTime,$.parseJSON(response.data.newListLeft));
                //2-1整体完成情况 all();
                AllUtil.init($.parseJSON(response.data.all));
                //2-2倒计时
                edition(response.data.edition);
                //2-2水球数据
                WaterUtil.init($.parseJSON(response.data.water));
                //2-3接口、UI、压力、静态代码、安全性
                ApiUtil.init($.parseJSON(response.data.api));
                //3-1客户验证 pmd_right();
                PmdRightUtil.init(version, integrate, startTime, endTime,$.parseJSON(response.data.pmdRight));
                //3-2缺陷BUG分析
                BUGUtil.init(version, integrate, startTime, endTime,$.parseJSON(response.data.bug));
                //3-3公共项目测试分析  newsList_right();
                NewsListRightUtil.init(version, integrate, startTime, endTime,$.parseJSON(response.data.newListRight));
            } else {
                console.log('getYSResource，未获取到值');
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
});
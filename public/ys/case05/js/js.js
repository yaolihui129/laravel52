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
        search();
    }
    /**
     * 当版本号变化时，重置集成号和时间
     */
    $("#version").change(function() {
        version = $('#version').val();
        console.log('version:' + version);
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
     * 当点击查询按钮时
     */
    $('#search').on('click', function() {
        getParams();
        search();
    });
    /**
     * 获取版本号，集成号，开始时间，结束时间
     */
    function getParams() {
        version = $('#version').val();
        integrate = $('#integrate').val();
        startTime = $('#startTime').val();
        endTime = $('#endTime').val();
        console.log('version:' + version);
        console.log('integrate:' + integrate);
        console.log('startTime:' + startTime);
        console.log('endTime:' + endTime);
    }
    /**
     * 执行查询渲染
     */
    function search() {
        //1-1专项 pmd_left();
        PmdLeftUtil.init(version, integrate, startTime, endTime);
        //1-2故事点进度排行
        StoryUtil.init(version, integrate, startTime, endTime);
        //1-3业务流程接口执行分析 newsList_left();
        NewsListLeftUtil.init(version, integrate, startTime, endTime);
        //2-1整体完成情况 all();
        AllUtil.init(version, integrate, startTime, endTime);
        //2-2水球数据、倒计时
        WaterUtil.init(version, integrate, startTime, endTime);
        //2-3接口、UI、压力、静态代码、安全性
        ApiUtil.init(version, integrate, startTime, endTime);
        //3-1客户验证 pmd_right();
        PmdRightUtil.init(version, integrate, startTime, endTime);
        //3-2缺陷BUG分析
        BUGUtil.init(version, integrate, startTime, endTime);
        //3-3公共项目测试分析  newsList_right();
        NewsListRightUtil.init(version, integrate, startTime, endTime);
        // initResource(version,integrate,startTime,endTime);
    }
    /**
     * 初始化版本号
     */
    function initVersion() {
        const reportUrl = "/ys";
        //ajax通用请求：
        CommonUtil.requestService(reportUrl + "/getVersion", '', true, "get", function(response) {
            if (response.success) {
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
     */
    function initIntegrate(version) {
        const reportUrl = "/ys";
        let requestData = {
            'version': version,
        };
        //ajax通用请求：
        CommonUtil.requestService(reportUrl + "/getIntegrate", requestData, true, "get",
            function(response) {
                console.log(response.data);
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
     * 初始化时间组件
     */
    function getTime() {
        // let dt = new Date();
        // let y = dt.getFullYear();
        // let mt = dt.getMonth() + 1;
        // let day = dt.getDate();
        // let nextDay=dt.getDate()+1;
        // let startTime=y + "-" + mt + "-" + day;
        // let endTime=y + "-" + mt + "-" + nextDay;
        // $( "#startTime" ).val(startTime);
        // $( "#endTime" ).val(endTime);
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
        //参数
        //     showAnim: 'slideDown',//show 默认,slideDown 滑下,fadeIn 淡入,blind 百叶窗,bounce 反弹,Clip 剪辑,drop 降落,fold 折叠,slide 滑动
        //     minDate: -1,//最小日期，可以是Date对象，或者是数字（从今天算起，例如+7），或者有效的字符串('y'代表年, 'm'代表月, 'w'代表周, 'd'代表日, 例如：'+1m +7d')。
        //     maxDate: +17,//最大日期，同上
        //     defaultDate : +4, //默认日期，同上
        //     duration : 'fast',//动画展示的时间，可选是"slow", "normal", "fast",''代表立刻，数字代表毫秒数
        //     firstDay : 1 ,//设置一周中的第一天。默认星期天0，星期一为1，以此类推。
        //     nextText : '下一月',//设置“下个月”链接的显示文字。鼠标放上去的时候
        //     prevText : '上一月',//设置“上个月”链接的显示文字。
        //     showButtonPanel: true,//是否显示按钮面板
        //     currentText : '今天',//设置当天按钮的文本内容，此按钮需要通过showButtonPanel参数的设置才显示。
        //     gotoCurrent : false,//如果设置为true，则点击当天按钮时，将移至当前已选中的日期，而不是今天。
    }

    // /**
    //  * 初始化资源组件
    //  */
    // function initResource(version,integrate,startTime,endTime) {
    //     const reportUrl = "/ys";
    //     let requestData = {
    //         'version': version,
    //         'integrate': integrate,
    //         'startTime': startTime,
    //         'endTime': endTime
    //     };
    //
    //     // ajax通用请求：
    //     CommonUtil.requestService(reportUrl + "/getYSResource" , requestData, true, "get", function(response) {
    //         if (!response.success) {
    //             console.log('Resource：没有获取到数据');
    //         } else {
    //             console.log(response.data);
    //             // ALL相关的处理
    //             if(response.data.all){
    //                 $("#allDoing").text(response.data.all.intDoing);
    //                 $("#allDone").text(response.data.all.intDone);
    //                 $("#allSum").text(response.data.all.intSum)
    //             }else {
    //                 console.log('ALL：没有获取到数据');
    //                 $("#allDoing").text('0');
    //                 $("#allDone").text('0');
    //                 $("#allSum").text('0')
    //             }
    //             // API相关的处理
    //             if(response.data.api){
    //
    //             }else {
    //
    //             }
    //
    //             if(response.data.bug){
    //
    //             }else {
    //
    //             }
    //
    //             if(response.data.newListLeft){
    //
    //             }else {
    //
    //             }
    //
    //             if(response.data.newListRight){
    //
    //             }else {
    //
    //             }
    //
    //             if(response.data.pmdLeft){
    //
    //             }else {
    //
    //             }
    //
    //
    //             if(response.data.pmdRight){
    //
    //             }else {
    //
    //             }
    //
    //             if(response.data.story){
    //
    //             }else {
    //
    //             }
    //
    //             if(response.data.edition){
    //
    //             }else {
    //
    //             }
    //
    //
    //
    //         }
    //     }, function(ex) {
    //         console.log('Resource异常：'+ex);
    //     });
    //
    // }
});
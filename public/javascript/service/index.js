IndexUtil = function(util) {
	var chartUrl="/desktop/index/";
	return me = {
		initOwn : function() {
			$("#taskExecCycle li").on("click",function(){
				$(this).siblings().removeClass("active");
				$(this).addClass("active");
				me.loadTaskLines($(this).attr("cycle"));
			});
			$("#schemeExecCycle li").on("click",function(){
				$(this).siblings().removeClass("active");
				$(this).addClass("active");
				me.loadSchemeCharts($(this).attr("cycle"));
			});
		},
		init : function() {
            $("#side-menu4 > a").click();
            $("#side-menu4_1_0 > a").click();
			me.initOwn();
			me.loadTaskPies();
			me.loadTaskLines("day");
			me.loadSchemeCharts("day");
			me.loadScriptCharts();
		},
		loadTaskPies(){
			CommonUtil.requestService(chartUrl+"taskpie", "", true, "get", function(response,
					status) {
				if (response.success) {
					var web=response.data.web;
					me.webTaskPie(web);
				}
			}, function(ex) {
			});
		},
		webTaskPie:function(web){
			web=CommonUtil.parseToJson(web);
			var lgData=[];
			var color=[];
			var webCount=0;
			for(var idx in web){
				$("#webState .mission-"+web[idx].state+"").empty().append("<span></span>"+web[idx].name+"<b>"+web[idx].value+"</b>");
				webCount+=parseInt(web[idx].value);
			}
			$("#webTaskPieCount").text(webCount);
			$("#webState li").each(function(){ 
				var value=$(this).find("b").text();
				if(value!="0"){
					lgData.push($(this).find("b").text());
					color.push($(this).find("span").css("background-color"));
				}
			});
			// 基于准备好的dom，初始化echarts实例
	        var myChart = echarts.init(document.getElementById('webTaskPie'));
	        // 指定图表的配置项和数据
	        var option = {
	        	    tooltip: {
	        	        trigger: 'item',
	        	        formatter: "{b}: {c} ({d}%)"
	        	    },
	        	    legend: {
	            	    show:false,
	        	        orient: 'horizontal',
	        	        x: 'left',
	        	        data:lgData,
	        	        x: 'center',
	        	        y: 'bottom',
	        	        itemWidth:15,
	        	        top:160
	        	    },
	        	    series: [
	        	        {
	        	            type:'pie',
	        	            radius: ['50%', '75%'],
	        	            avoidLabelOverlap: false,
	        	            label: {
	        	                normal: {
	        	                    show: false,
	        	                    position: 'center'
	        	                },
	        	                emphasis: {
	        	                    show: true,
	        	                    textStyle: {
	        	                        fontSize: '20',
	        	                        fontWeight: 'bold'
	        	                    }
	        	                }
	        	            },
	        	            labelLine: {
	        	                normal: {
	        	                    show: false
	        	                }
	        	            },
	        	            data:web,
	        	            color:color// ['#78c8ca','#fcd469','#e78c8e']
	        	        }
	        	    ]
	        	};
	        // 使用刚指定的配置项和数据显示图表。
	        myChart.setOption(option);
		},
		loadTaskLines(cycle){
			CommonUtil.requestService(chartUrl+"taskline", {"cycle":cycle}, true, "get", function(response,
					status) {
				if (response.success) {
					me.taskExecLine(response.data);
				}
			}, function(ex) {
			});
		},
		taskExecLine:function(data){
			var web=CommonUtil.parseToJson(data.web);
			var xAxisData=[];
			var seriesData=[];
			for(var idx in web){
				xAxisData.push(web[idx].name);
				seriesData.push(web[idx].value);
			}
			// 基于准备好的dom，初始化echarts实例
	        var myChart = echarts.init(document.getElementById('taskTrend'));
	        // 指定图表的配置项和数据
	        var option = {
	        	    tooltip : {
	        	        trigger: 'axis',
	        	        formatter: "{a}<br>{b}: {c}"
	        	    },
	        	    legend: {
	        	        data:['web自动化测试'],
	        	        right:"220",
	        	        top:"20"
	        	    },
	        	    toolbox: {
	        	    	show:false,
	        	        feature: {
	        	            saveAsImage: {}
	        	        }
	        	    },
	        	    grid: {
	        	        left: '3%',
	        	        right: '4%',
	        	        bottom: '0%',
	        	        containLabel: true
	        	    },
	        	    xAxis : [
	        	        {
	        	            type : 'category',
	        	            boundaryGap : false,
	        	            data : xAxisData,
	        	            splitLine:{
	        	            	show:true
	        	            }
	        	        }
	        	    ],
	        	    yAxis : [
	        	        {
	        	            type : 'value',
	        	            splitLine:{
	        	            	show:true
	        	            }
	        	        }
	        	    ],
	        	    series : [
	        	        {
	        	            name:'web自动化测试',
	        	            type:'line',
	        	            stack: '总量',
	        	            areaStyle: {normal: {}},
	        	            data:seriesData
	        	        }
	        	    ]
	        	};
	        // 使用刚指定的配置项和数据显示图表。
	        myChart.setOption(option);
		},
		loadSchemeCharts(cycle){
			CommonUtil.requestService(chartUrl+"scheme",{"cycle":cycle}, true, "get", function(response,
					status) {
				if (response.success) {
					var web=CommonUtil.parseToJson(response.data.web);
					var xAxisData=[];
					var seriesData=[];
					for(var idx in web){
						xAxisData.push(web[idx].name);
						seriesData.push(web[idx].value);
					}
					me.schemeChart(xAxisData,seriesData,"schemeBarLine");
					// me.schemeChart(xAxisData,seriesData,"schemeLine","line");
				}
			}, function(ex) {
			});
		},
		schemeChart:function(xAxisData,seriesData,elementId){
			// 基于准备好的dom，初始化echarts实例
	        var myChart = echarts.init(document.getElementById(elementId));
	        // 指定图表的配置项和数据
	        var option = {
	        	    tooltip : {
	        	        trigger: 'axis',
	        	        formatter: "{a}<br>{b}: {c}"
	        	    },
	        	    legend: {
	        	    	show:true,
	        	        data:['案例汇总数','案例执行数'],
	        	        right:"220",
	        	        top:"20"
	        	    },
	        	    toolbox: {
	        	        show : false,
	        	        feature : {
	        	            mark : {show: true},
	        	            dataView : {show: true, readOnly: false},
	        	            magicType : {show: true, type: ['line', 'bar']},
	        	            restore : {show: true},
	        	            saveAsImage : {show: true}
	        	        }
	        	    },
	        	    calculable : false,
	        	    xAxis : [
	        	        {
	        	            type : 'category',
	        	            data :xAxisData
	        	        }
	        	    ],
	        	    grid:{
	        	    	/*
						 * top:40, bottom:20
						 */
	        	    	left: '3%',
 	        	        right: '4%',
 	        	        bottom: '0%',
 	        	        containLabel: true
	        	    },
	        	    yAxis : [
	        	        {
	        	            type : 'value',
	        	            name:"数量"
	        	        }
	        	    ],
	        	    series : [
	        	        {
	        	            name:'案例汇总数',
	        	            type:"bar",
	        	            data:seriesData
	        	        }, {
	        	            name:'案例执行数',
	        	            type:"line",
	        	            data:seriesData,
	        	            itemStyle : {
	    						normal : {
	    							lineStyle:{
	    								color:'blue'
	    							}
	    						}
	    					}
	        	        }
	        	    ]
	        	};
	        // 使用刚指定的配置项和数据显示图表。
	        myChart.setOption(option);
		},
		loadScriptCharts:function(){
			CommonUtil.requestService(chartUrl+"script", "", true, "get", function(response,
					status) {
				if (response.success) {
					var web=response.data.web;
					var web=CommonUtil.parseToJson(response.data.web);
					$("#scriptCount").text(web[0].value);
				}
			}, function(ex) {
			});
		}
	};
}();

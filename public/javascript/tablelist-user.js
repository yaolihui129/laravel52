(function($) {
	// 默认参数
	var setting = {
		"bAutoWidth" : false,// 自动计算列宽
		"bProcessing" : true,
		"bServerSide" : true, // 指定从服务器端获取数据
		"sAjaxSource" : null, // 获取数据的url
		"fnServerData" : null,
		'iDisplayLength' : 15,// 每页显示条数
		'bPaginate' : false, // 是否分页。
		"bLengthChange" : false,// 显示分页选项下拉框
		"bFilter" : false, // 过滤
		"bSort" : false,// 排序
		"aoColumns" : [],
		"aoColumnDefs" : null
	};
	$.fn.TableList = function(ops) {
		var tableId = $(this).attr("id");
		// 将setting\tableArgs进行合并,返回给oSetting
		var oSetting = $.extend({}, setting, ops);
		if (oSetting.fnServerData) {
			// 构造发送到服务端的基础
			var aoData = {
				"controllerid" : tableId,
				"istart" : istart,
				"ilength" : oSetting.iDisplayLength * oSetting.colcount
			};
			// fnServerData 外部传递的函数
			oSetting.fnServerData(oSetting.sAjaxSource, aoData, bindData);
		}

		function bindData(data) {
			$("#" + tableId).empty();// 清空列表
			if (data.iTotalRecords) {
				drawList(data.aaData);// 绘制图文列表
				if (oSetting.bPaginate) {// 分页
					drawPager(tableId, oSetting, data.iTotalRecords, istart,
							$.fn.imgtexttable);
				}
			} else {
				$("#" + tableId).html("列表为空");
			}
		}

		// 绘制列表
		function drawList(data) {
			var listobj = $("#" + tableId);
			for ( var ic = 0; ic < data.length; ic++) {

			}
			listObj
					.append("<tr class='gradeX'>"
							+ "<td>Trident</td><td>Internet Explorer 4.0</td><td>Win 95+</td><td class='center'>4</td>"
							+ "<td class='center'>X</td></tr>"
							+ "<tr class='gradeC'><td>Trident</td><td>Internet Explorer 5.0</td><td>Win 95+</td>"
							+ "<td class='center'>5</td><td class='center'>C</td></tr>"
							+ "<tr class='gradeA'><td>Trident</td><td>Internet Explorer 5.5</td><td>Win 95+</td>"
							+ "<td class='center'>5.5</td><td class='center'>A</td></tr>");
		}
	}
})(jQuery);

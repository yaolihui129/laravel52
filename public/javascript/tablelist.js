var btnAuth = {};

/* Set the defaults for DataTables initialisation */
$.extend(true, $.fn.dataTable.defaults, {
	"sDom" : "<'row'<'col-sm-6'l><'col-sm-6'f>r>" + "t"
			+ "<'row'<'col-sm-6'i><'col-sm-6'p>>"

});

/* Default class modification */
$.extend($.fn.dataTableExt.oStdClasses, {
	"sWrapper" : "dataTables_wrapper form-inline",
	"sFilterInput" : "form-control input-sm",
	"sLengthSelect" : "form-control input-sm"
});

// In 1.10 we use the pagination renderers to draw the Bootstrap paging,
// rather than custom plug-in
if ($.fn.dataTable.Api) {
	$.fn.dataTable.defaults.renderer = 'bootstrap';
	$.fn.dataTable.ext.renderer.pageButton.bootstrap = function(settings, host,
			idx, buttons, page, pages) {
		var api = new $.fn.dataTable.Api(settings);
		var classes = settings.oClasses;
		var lang = settings.oLanguage.oPaginate;
		var btnDisplay, btnClass;
		var attach = function(container, buttons) {
			var i, ien, node, button;
			var clickHandler = function(e) {
				e.preventDefault();
				if (e.data.action !== 'ellipsis') {
					api.page(e.data.action).draw(false);
				}
			};
			for (i = 0, ien = buttons.length; i < ien; i++) {
				button = buttons[i];
				if ($.isArray(button)) {
					attach(container, button);
				} else {
					btnDisplay = '';
					btnClass = '';
					switch (button) {
					case 'ellipsis':
						btnDisplay = '&hellip;';
						btnClass = 'disabled';
						break;

					case 'first':
						btnDisplay = lang.sFirst;
						btnClass = button + (page > 0 ? '' : ' disabled');
						break;

					case 'previous':
						btnDisplay = lang.sPrevious;
						btnClass = button + (page > 0 ? '' : ' disabled');
						break;

					case 'next':
						btnDisplay = lang.sNext;
						btnClass = button
								+ (page < pages - 1 ? '' : ' disabled');
						break;

					case 'last':
						btnDisplay = lang.sLast;
						btnClass = button
								+ (page < pages - 1 ? '' : ' disabled');
						break;

					default:
						btnDisplay = button + 1;
						btnClass = page === button ? 'active' : '';
						break;
					}
					if (btnDisplay) {
						node = $(
								'<li>',
								{
									'class' : classes.sPageButton + ' '
											+ btnClass,
									'aria-controls' : settings.sTableId,
									'tabindex' : settings.iTabIndex,
									'id' : idx === 0
											&& typeof button === 'string' ? settings.sTableId
											+ '_' + button
											: null
								}).append($('<a>', {
							'href' : '#'
						}).html(btnDisplay)).appendTo(container);
						settings.oApi._fnBindAction(node, {
							action : button
						}, clickHandler);
					}
				}
			}
		};
		attach($(host).empty().html('<ul class="pagination"/>').children('ul'),
				buttons);
	}
}

DataTableUtil = function() {
	return Util = {
		load : function(tableid, url, aoColumns, tablekv, requestData) {
			try {
				if (aoColumns.length == 0)
					return;
				/*
				 * $("<div id='shadeform' class='shadeform'></div>").appendTo(
				 * "body");
				 */
				if (tablekv.tabtool) {
					$("#" + tableid).before(
							"<ul class='btn-toolbar clearfix'></ul>");
                    //新建按钮新增脚本
                    if (tablekv.newtool) {
                        var newId = tableid + "_new";
                        /*
                         * $(".btn-toolbar") .append( "<span id='" + addId + "'
                         * class='btn btn-primary'><i class='fa fa-plus'></i>
                         * 添加</span>");
                         */
                        $(".btn-toolbar").append(
                            "<button class='btn btn-info' id='"
                            + newId + "'> 新增</button>");
                        $("#" + newId).off("click");
                        $("#" + newId).on("click", function() {
                            tablekv.newtool();
                        });
                    }
					if (tablekv.addtool) {
						var addId = tableid + "_add";
						/*
						 * $(".btn-toolbar") .append( "<span id='" + addId + "'
						 * class='btn btn-primary'><i class='fa fa-plus'></i>
						 * 添加</span>");
						 */
						//此处判断是否是脚本仓库过来的请求，如果是，第二个按钮改为上传，如果不是则为新增
						if (tablekv.newtool){
                            $(".btn-toolbar").append(
                                "<button class='btn btn-info' id='"
                                + addId + "'>上传</button>");
                            $("#" + addId).off("click");
                            $("#" + addId).on("click", function() {
                                tablekv.addtool();
                            });
						}else{
                            $(".btn-toolbar").append(
                                "<button class='btn btn-info' id='"
                                + addId + "'>新增</button>");
                            $("#" + addId).off("click");
                            $("#" + addId).on("click", function() {
                                tablekv.addtool();
                            });
						}

					}


					if (tablekv.deltool) {
						var delId = tableid + "_del";
						/*
						 * $(".btn-toolbar") .append( "<span id='" + delId + "'
						 * class='btn btn-danger'><i class='fa fa-trash'></i>
						 * 删除</span>");
						 */
						$(".btn-toolbar").append(
								"<button class='btn btn-info' id='"
										+ delId + "'>删除</button>");
						$("#" + delId).off("click");
						$("#" + delId).on("click", function() {
							Util.delRecord(tableid, tablekv.deltool);
						});
					}
					// 默认显示刷新
					if (tablekv.refresh == undefined || tablekv.refresh) {
						var refreshId = tableid + "_refresh";
						/*
						 * $(".btn-toolbar") .append( "<span id='" + refreshId + "'
						 * class='btn btn-success'><i class='fa fa-refresh'></i>
						 * 刷新</span>");
						 */
						$(".btn-toolbar").append(
								"<button class='btn btn-info' id='"
										+ refreshId + "'> 刷新</button>");
						$("#" + refreshId).off("click");
						$("#" + refreshId).on("click", function() {
							Util.refresh(tableid);
						});
					}
				}
				var primary = aoColumns[0]["data"];
				aoColumnDefs = [];
				if (tablekv.chk) {// check列
					aoColumnDefs
							.push({ // 自定义列
								"targets" : [ 0 ], // 目标列位置，下标从0开始
								"data" : primary, // 数据列名
								"sWidth" : "40px",
								"render" : function(data, type, full) { // 返回自定义内容
									full = JSON.stringify(full);
									return "<label class='checkbox-inline i-checks'><input type='checkbox' recordid='"
											+ data
											+ "' row='"
											+ full
											+ "'></label>";
								}
							});
					aoColumns[0]["sTitle"] = "<label class='checkbox-inline i-checks' style='display:none;' for=''><input id='allCheck' type='checkbox'></label>";
					$("#" + tableid).off("ifChecked ifUnchecked", "#allCheck");
					$("#" + tableid).on(
							"ifChecked ifUnchecked",
							"#allCheck",
							function(event) {
								var checklist = $("#" + tableid
										+ " input[type='checkbox']");
								switch (event.type) {
								case "ifUnchecked":
									/*
									 * checklist.each(function() {
									 * Util.check(event, tablekv.chk, this); });
									 */
									checklist.iCheck("uncheck");
									break;
								case "ifChecked":
									/*
									 * checklist.each(function() {
									 * Util.check(event, tablekv.chk, this); });
									 */
									checklist.iCheck("check");
									break;
								case "hover":
									alert(1);
									break;
								}
							});

					$("#" + tableid).off("ifChecked ifUnchecked",
							"input[type='checkbox']");
					$("#" + tableid).on("ifChecked ifUnchecked",
							"input[type='checkbox']", function(event) {
								Util.check(event, tablekv.chk, this);
							});
				}



                if (tablekv.getData) {// 获取步骤
                    aoColumnDefs
                        .push({ // 自定义列
                            "targets" : [ 4 ], // 目标列位置，下标从0开始
                            "data" : 'step', // 数据列名
                            "sWidth" : "40px",
                            "sTitle" : "步骤选择",
                            "render" : function(data, type, full) { // 返回自定义内容
                                full = JSON.stringify(full);
                                return '<select  class="stepInfo" multiple  style="height: 180px">' +
                                    '<option value="14">获取安装盘</option>' +
									'<option value="10">产品安装</option>' +
                                    '<option value="20">设置加密服务器</option>' +
                                    '<option value="15">配置数据源</option>' +
                                    '<option value="16">初始化数据库</option>' +
                                    '<option value="18">账套初始化</option>' +
									'<option value="11">产品升级</option>' +
									'<option value="12">产品卸载</option>' +
									'<option value="19">验盘</option>' +
									'</select>';
                            }
                        });
                    aoColumns[0]["sTitle"] = "<label class='checkbox-inline i-checks' style='display:none;' for=''><input id='allCheck' type='checkbox'></label>";
                }













				if (tablekv.opt) {
					var opt = tablekv.opt;
					var sWidth = 45 * CommonUtil.getLength(opt);
					aoColumnDefs
							.push({ // 自定义列
								"targets" : [ aoColumns.length ], // 目标列位置，下标从0开始
								"data" : primary, // 数据列名
								"sTitle" : "操作",
								"sWidth" : sWidth + "px",
								"render" : function(data, type, full) { // 返回自定义内容
									// alert(data);
									editid = "recordid" + data;
									var optInfo = "<span recordid='" + data
											+ "' row='" + JSON.stringify(full)
											+ "'>";
									for ( var op in opt) {
										// <i class='fa fa-paste'></i>
										optInfo += "<font opt='"
												+ op
												+ "' style='cursor:pointer;' class='text-success'>"
												+ opt[op].info + "</font>  ";
									}
									return optInfo + "</span>";
								}
							});
					Util.optRecord(tableid, opt);
				}
				var columnType;
				for ( var $col in aoColumns) {
					columnType = aoColumns[$col]["columnType"];
					switch (columnType) {
					case "img":
						var index = parseInt($col);
						aoColumnDefs
								.push({ // 自定义列
									"targets" : [ index ], // 目标列位置，下标从0开始
									"data" : aoColumns[$col]["data"], // 数据列名
									"sWidth" : aoColumns[$col]["sWidth"],
									"render" : function(data, type, full) { // 返回自定义内容
										return "<img width='50px' height='50px' alt='缩略图' src='"
												+ data + "'>";
									}
								});
						break;
					default:
						break;
					}
				}
				var tableObj = $('#' + tableid);
				tableObj.fnRowCallback = tablekv.fnRowCallback;
				var datatable = tableObj
						.dataTable({
							"oLanguage" : {
								"sUrl" : CommonUtil.getRootPath()
										+ "/fonts/datatable-zh-cn.txt"
							},
							"bAutoWidth" : false,// 自动计算列宽
							"bProcessing" : false,
							"bServerSide" : true, // 指定从服务器端获取数据
							"sAjaxSource" : url, // 获取数据的url
							"fnServerData" : Util.bind,
							"fnServerParams" : function(aoData, q) {
								if (requestData) {
									for ( var key in requestData) {
										var val = requestData[key];
										if (typeof (val) == "object")
											val = JSON.stringify(val);
										aoData.push({
											"name" : key,
											"value" : val
										});
									}
								}
								aoData = {};
							},
							'iDisplayLength' : tablekv.iDisplayLength ? tablekv.iDisplayLength
									: 1,// 每页显示条数
							'bPaginate' : true, // 是否分页。
							"bLengthChange" : false,// 显示分页选项下拉框
							"bFilter" : false, // 过滤
							"bSort" : false,// 排序
							"aoColumns" : aoColumns,
							"aoColumnDefs" : aoColumnDefs,
							"bDestroy" : true,
							"fnDrawCallback" : Util.fnDrawCallback,
							"fnInitComplete" : function() {// 初始化完毕
							},
							"fnRowCallback" : function(nRow, aData,
									iDisplayIndex, iDisplayIndexFull) {// 创建了行，但还未绘制到屏幕上的时候调用
								if (this.fnRowCallback) {// 外部定义 覆盖预制函数
									this.fnRowCallback(nRow, aData,
											iDisplayIndex, iDisplayIndexFull)
								} else
									// 外部未定义使用预制函数
									Util.fnRowCallback(nRow, aData,
											iDisplayIndex, iDisplayIndexFull)
							}
						});
			} catch (e) {
				// alert(e);
			}
		},
		check : function(event, chk, obj) {
			if (chk !== true) {
				if (obj.id != "allCheck")
					chk(event, obj);
			}
		},
		bind : function(sSource, aoData, fnCallback, oSettings) { // 从后台获取数据后处理数据绑定列表（通用包括分页）
			sSource = oSettings.sAjaxSource;
			var requestData = oSettings.aoSearch;
			for ( var key in requestData) {
				aoData.push(requestData[key]);
			}
			CommonUtil.requestService(sSource, aoData, true, "get", function(
					data) {
				fnCallback(data);
			}, function(data) {
				layer.msg("传输出现错误", {
					offset : "50px"
				});
			});
		},
		fnDrawCallback : function() {// 每次重画完后调用的方法
			$('.i-checks').iCheck({
				checkboxClass : 'icheckbox_square-green',
				radioClass : 'iradio_square-green'
			});
			$('.i-checks').css({
				"display" : ""
			});
		},
		fnRowCallback : function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {// 创建了行，但还未绘制到屏幕上的时候调用
			if (aData.state) {
				$(nRow).children("td").each(function() {
					var state = $(this).html();
					var spell = true;
					var html = "<p>" + state + "</p>";
					switch (state) {
					case "执行成功":
						$(this).addClass("status rsuccess");
						break;
					case "执行失败":
						$(this).addClass("status rfail");
						break;
					case "执行中":
						$(this).addClass("status rmission-ing");
						break;
					case "排队中":
					case "未执行":
						$(this).addClass("status");
						break;
					default:
						spell = false;
						break;
					}
					if (spell) {
						$(this).html(html);
					}
				});
			}
		},
		// 重新加载整个列表
		search : function(tableId, url, requestData) {
			var dataTable = $('#' + tableId).dataTable();
			var aoSearch = [];
			dataTable.fnSettings().sAjaxSource = url;
			for ( var key in requestData) {
				var val = requestData[key];
				if (typeof (val) == "object")
					val = JSON.stringify(val);
				aoSearch.push({
					"name" : key,
					"value" : val
				});
			}
			// dataTable.fnSettings().aoSearch = aoSearch;
			if (!dataTable.fnSettings().aoSearch)
				dataTable.fnSettings().aoSearch = aoSearch;
			else {
				var search = dataTable.fnSettings().aoSearch;
				for ( var key in search) {
					var val = search[key].value;
					search = {
						"search" : JSON.parse(val)
					};
				}
				$.extend(search, requestData);
				var aoSearch = [];
				for ( var key in requestData) {
					var val = requestData[key];
					if (typeof (val) == "object")
						val = JSON.stringify(val);
					aoSearch.push({
						"name" : key,
						"value" : val
					});
				}
				dataTable.fnSettings().aoSearch = aoSearch;
			}
			dataTable.fnDraw();
		},
		// 刷新当前页
		refresh : function(tableid) {
			$("#" + tableid).dataTable().fnDraw(false);
		},
		getChkRecord : function(tableid) {
			var ids = "";
			$("#" + tableid + " tr td label").has(".checked").find("input")
					.each(function() {
						ids += $(this).attr('recordid') + ",";
					});
			return ids.substr(0, ids.length - 1);
		},
		delRecord : function(tableid, bindDel) {
			var ids = Util.getChkRecord(tableid);
			if (ids) {
				parent.layer.confirm('您确定要删除所选？', {
					offset : "50px",
					btn : [ '确定', '取消' ]
				}, function() {
					bindDel(ids);
					parent.layer.msg('删除成功', {
						icon : 1,
						time : 800,
						offset : "50px"
					});
				});
			}
		},
		optRecord : function(tableid, opts) {
			for ( var op in opts) {
				$("#" + tableid).off("click", "font[opt='" + op + "']");
				$("#" + tableid).on(
						"click",
						"font[opt='" + op + "']",
						op,
						function(event) {
							var recordid = $(this).parent().attr("recordid");
							opts[event.data].func(recordid, JSON.parse($(this)
									.parent().attr("row")));
						});
			}
		},
		optListForm : function(tableId, opturl, type, requestData, callbackfn,
				refresh) {
			CommonUtil.requestService(opturl, requestData, true, type,
					function(response, status) {
						if (response.success) {// 成功 重新加载列表
							callbackfn();
							if (refresh) {
								Util.refresh(tableId);
								var checklist = $("#" + tableId
										+ " input[type='checkbox']");
								checklist.iCheck("uncheck");
							}
						} else {
							layer.msg(response.error, {
								offset : "50px"
							});
						}
					}, function(data) {
						layer.msg("传输出现错误", {
							offset : "50px"
						});
					});
		}
	};
}();

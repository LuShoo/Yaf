<!DOCTYPE html> <!--[if IE 8]> <html lang="en" class="ie8"> <![endif]--> <!--[if IE 9]> <html lang="en" class="ie9"> <![endif]--> <!--[if !IE]><!--> <html lang="en"> <!--<![endif]--> <!-- BEGIN HEAD --> <head>
<meta charset="utf-8" />
<title>showboom - 销售管理平台</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
{include ../../Admin/views/top.tpl}
</head>
<body class="fixed-top">
	{include ../../Admin/views/header.tpl}
	<div id="container" class="row-fluid">
		{include ../../Admin/views/menu.tpl}
		<div id="main-content">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<div id="theme-change" class="hidden-phone">
							<i class="icon-cogs"></i> <span class="settings"> <span
								class="text">Theme:</span> <span class="colors"> <span
									class="color-default" data-style="default"></span> <span
									class="color-gray" data-style="gray"></span> <span
									class="color-purple" data-style="purple"></span> <span
									class="color-navy-blue" data-style="navy-blue"></span> </span>
							</span>
						</div>
						{include ../../Admin/views/breadcrumb.tpl}
						<!--
						<h3 class="page-title">
							卡管理 <small>库存管理</small>
						</h3>
						<ul class="breadcrumb" style="float: left;">
							<li style="margin-bottom: 0px;"><a href="/comm/home/index.html"><i
									class="icon-home"></i> </a><span class="divider">&nbsp;</span>
							</li>
							<li style="margin-bottom: 0px;"><a href="/comm/dl/index.html">库存管理</a><span
								class="divider-last">&nbsp;</span></li>
						</ul>
						-->

                        <div class="row-fluid" style="margin-top:10px; width: 30%; float:right;;margin-right: 20px;">
                            <div class="span12">
                                <div id="nestable_list_menu" class="margin-bottom-10 pull-right">


									<a href="javascript:void(0);" title="生成卡秘钥" alt="生成卡秘钥"
									   class="btn btn-primary" id="fileOutput">生成卡秘钥</a>


                                    <a href="/card/type/index.html" data-action="expand-all" class="btn btn-info" type="button">查看卡类型</a>
                                    <a href="javascript:void(0);" title="导入卡信息" alt="导入卡信息"
                                       class="btn btn-primary" id="fileInput">导入卡信息</a>
                                </div>
                            </div>
                        </div>



					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="widget">
							<div class="widget-title">
								<h4>
									<i class="icon-reorder"></i>卡列表
								</h4>
							</div>


                            <!-- 上传文件的弹框start -->
                            <div id="myModal" class="modal hide fade in dialog-upload-card"
                                 style="display: none;">
                                <div class="modal-header">
                                    <button id="close-btn" data-dismiss="modal" class="close"
                                            type="button">×</button>
                                    <h3>导入卡信息</h3>
                                </div>
                                <iframe id="form-iframe" name="upload-form-iframe"
                                        style="display: none;"></iframe>
                                <div class="modal-body" style="text-align: center;">
                                    <div id="uniform-fileInput">
                                        <form target="upload-form-iframe" id="upload-form"
                                              action="/card/info/importDataFromExcel.html" method="post"
                                              enctype="multipart/form-data">
                                            <div>
                                                <input id="file" type="file" name="file-name"
                                                       class="input-file uniform_on" size="19">
                                            </div>
                                        </form>
                                        <a href="{STATIC_SERVER}/templ/CardImport.xlsx">点击下载导入模版</a>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a id="cancel-upload" class="btn" href="javascript:void(0);">取消</a>
                                    <a id="start-upload" class="btn btn-primary"
                                       href="javascript:void(0);">导入</a>
                                </div>
                            </div>
                            <!-- 上传文件的弹框end -->

							<!-- 导出文件的弹框start -->
							<div id="myModalExport" class="modal hide fade in dialog-upload-card"
								 style="display: none;">
								<div class="modal-header">
									<button id="close-btnEXport" data-dismiss="modal" class="close"
											type="button">×</button>
									<h3>生成卡密钥</h3>
								</div>
								<iframe id="form-iframeExport" name="upload-form-iframeExport"
										style="display: none;"></iframe>
								<div class="modal-body" style="text-align: center;">
									<div id="uniform-fileInput">
										<form target="upload-form-iframe" id="download-form"
											  action="/card/info/exportData.html" method="post"
											  enctype="multipart/form-data">
											<div>
												<input id="file2" type="file" name="file-name-export"
													   class="input-file uniform_on" size="19">
											</div>
										</form>
										<a href="{STATIC_SERVER}/templ/getkey.xlsx">点击下载导入模版</a>
									</div>
								</div>
								<div class="modal-footer">
									<a id="cancel-download" class="btn" href="javascript:void(0);">取消</a>
									<a id="start-download" class="btn btn-primary"
									   href="javascript:void(0);">生成</a>
								</div>
							</div>
							<!-- 导出文件的弹框end -->


							<div class="widget-body">
								<div class="row-fluid" style="margin-bottom: 10px;">
									<div class="span2">
										<div>
											<label> <select id="page_rows" size="1" style="width: 60px;">
													<option value="10" selected="selected">10</option>
													<option value="25">25</option>
													<option value="50">50</option>
													<option value="100">100</option>
											</select> 条/页 </label>
										</div>
									</div>
									<div class="span10 list_search">
										<input value="流量卡唯一码" type="text" id="unique_id" style="width:150px;"
											default_val="流量卡唯一码">
										<input value="iccid" type="text" id="iccid"  style="width:150px;"
											default_val="iccid">

                                        <input value="sim卡号" type="text" id="telephone"  style="width:150px;"
                                               default_val="sim卡号">

                                        <input value="入库批次号" type="text" id="batch" style="width:150px;"
                                               default_val="入库批次号">

										&nbsp;&nbsp;是否出库：<select style="width: 80px;" id="status">
											<option value="0">全部</option>
											<option value="1">未出库</option>
											<option value="2">已出库</option>
										</select>

											<input alt="创建开始时间" title="创建开始时间" value="创建开始时间"
											default_val="创建开始时间" class="m-wrap" size="16" type="text"
											value="" id="ui_date_picker_from" /> <input alt="创建结束时间"
											title="创建结束时间" value="创建结束时间" default_val="创建结束时间" class="m-wrap"
											size="16" type="text" value="" id="ui_date_picker_to" /> <a
											id="search-btn" class="btn btn-primary" alt="搜 索" title="搜 索"
											href="javascript:void(0);">搜 索</a>

										&nbsp;&nbsp; &nbsp;&nbsp; <a href="javascript:void(0);" title="导出" alt="导出"
																	 class="btn btn-primary" id="exportData">导出</a>


									</div>
									
								</div>
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<!--<th>ID</th>-->
											<th>卡类型</th>
											<th>流量卡唯一码</th>
											<th>iccid</th>
											<th>sim卡号</th>
                                            <th>入库批次号&nbsp;<img id="batch_img" src="/static/img/help.jpg" style="width:15px;height:15px;" /></th>
											<th>套餐</th>
											<th>是否出库</th>
                                            <th>有效期</th>
											<th>创建时间&nbsp;<img id="cid_time" src="/static/img/help.jpg" style="width:15px;height:15px;" /></th>
											<th>备注</th>
											<th>卡秘钥&nbsp;<img id="cid_tag" src="/static/img/help.jpg" style="width:15px;height:15px;" /></th>
											<th>操作</th>
										</tr>
									</thead>
									<tbody id="list-data">
									</tbody>
								</table>
									<div class="box-content list-loading"
								style="vertical-align: middle; text-align: center;">
								Loading <img title="/static/img/Fancy pants.gif"
									src="/static/img/Fancy pants.gif">
							</div>
							<div class="row-fluid">
								<div class="span8 center">
									<div id="vpage" class=" paging_bootstrap pagination"></div>
								</div>
								<div class="span4" style="text-align: right; line-height: 40px;">
									<div class="dataTables_info" id="DataTables_Table_0_info">
										共计 <span id="vpage-max-page">0</span> 页，<span id="vpage-total">0</span>
										条记录
									</div>
								</div>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	{include ../../Admin/views/footer.tpl}
	<script type="text/javascript" src="/static/js/jquery_vpage.js"></script>
	<script type="text/javascript" src="/static/js/layer/layer.js"></script>
	<script>
        jQuery(document).ready(function() {
            App.init();
            UIJQueryUI.init();
        });
        $(function () {
            $.vpage({
            	  'uri': '/card/info/getlist.html'
            });
            var _unique_id = $("#unique_id");
            var _iccid = $("#iccid");
            var _telephone = $("#telephone");
            var _batch = $("#batch");
      	   var _startTime = $("#ui_date_picker_from");
      	   var _endTime = $("#ui_date_picker_to");
             
             var _list = [_unique_id,_iccid,_telephone,_batch,_startTime,_endTime];
             //循环绑定事件 
             $.each(_list, function(k, v) {
                 $(v).focus(function() {
                     this.value = ''
                 }).blur(function() {
                     if (this.value == '') {
                         this.value = $(this).attr('default_val')
                     }
                 });
             });
             //点击搜索 
             $("#search-btn").click(function(e) {
            	 var unique_id = (_unique_id.val()==_unique_id.attr('default_val')) ? '' : _unique_id.val();
          	    var iccid = (_iccid.val()==_iccid.attr('default_val')) ? '' : _iccid.val();

          	    var telephone = (_telephone.val()==_telephone.attr('default_val')) ? '' : _telephone.val();

          	    var batch = (_batch.val()==_batch.attr('default_val')) ? '' : _batch.val();
				 var status=$('#status').val();


      			var startTime = (_startTime.val()==_startTime.attr('default_val')) ? '' : _startTime.val();
      			var endTime = (_endTime.val()==_endTime.attr('default_val')) ? '' : _endTime.val()+' 23:59:59';	
                 $.vpage({
                	 'uri': '/card/info/getlist.html',
                     'query': "&unique_id="+unique_id+ "&iccid="+iccid+'&telephone='+telephone+"&batch="+batch+"&status="+status+"&start_time="+startTime+"&end_time="+endTime
                 });
             });


			$('#exportData').click(function() {
				var unique_id = (_unique_id.val()==_unique_id.attr('default_val')) ? '' : _unique_id.val();
				var iccid = (_iccid.val()==_iccid.attr('default_val')) ? '' : _iccid.val();
                var telephone = (_telephone.val()==_telephone.attr('default_val')) ? '' : _telephone.val();

				var batch = (_batch.val()==_batch.attr('default_val')) ? '' : _batch.val();
				var status=$('#status').val();
				var startTime = (_startTime.val()==_startTime.attr('default_val')) ? '' : _startTime.val();
				var endTime = (_endTime.val()==_endTime.attr('default_val')) ? '' : _endTime.val()+' 23:59:59';
				window.open("/card/info/exportDatatwo.html?unique_id="+unique_id+ "&iccid="+iccid+'&telephone='+telephone+"&batch="+batch+"&status="+status+"&start_time="+startTime+"&end_time="+endTime);

			});



        });


        $('#fileInput').click(function() {
            $('#myModal').show();
        });
        $('#cancel-upload,#close-btn').click(function() {
            $('#myModal').hide();
        });
        $('#start-upload').click(function() {

            if ($(this).attr('upload-status') == '1')
                return false;
            if ($('#file').val() == '')
			{
				alert('请选择要上传的文件');
				return false;
			}

            $(this).attr('upload-status', '1');

			layer.load(0, {shade: [0.8, '#393D49']});

            $('#upload-form').submit();
        });

		function alertResult(data) {
			layer.closeAll();
			var jsonData = $.parseJSON(data);
			$('#start-upload').attr('upload-status', '0');
			if(jsonData.code == 200){
				alert("导入成功");
			}else{
				alert("导入失败，"+jsonData.msg);
			}
			window.location.href = "/card/info/index.html";
		}

        //导出部分
		$('#fileOutput').click(function() {
			$('#myModalExport').show();
		});
		$('#cancel-download,#close-btnEXport').click(function() {
			$('#myModalExport').hide();
		});
		$('#start-download').click(function() {
			if ($(this).attr('download-status') == '1')
				return false;
			if ($('#file2').val() == '')
			{
				alert('请选择要上传的文件');
				return false;
			}

			$(this).attr('download-status', '1');
			$('#download-form').submit();
		});

		function alertResult2(data) {
			var jsonData = $.parseJSON(data);
			$('#start-download').attr('download-status', '0');
			if(jsonData.code == 200){
				alert("导入成功");
			}else{
				alert("导入失败，"+jsonData.msg);
			}
			window.location.href = "/card/info/index.html";
		}


		$('#cid_time').mouseover(function() {
			layer.closeAll();
			var that = this;
			layer.tips('流量卡导入时间',that,{time:2000});
		}).mouseout(function() {
			layer.closeAll();

		});

		$('#cid_tag').mouseover(function() {
			layer.closeAll();
			var that = this;
			layer.tips('店员绑定流量卡需要扫描的特殊字符，每张卡对应唯一的一个卡秘钥',that,{time:4000});
		}).mouseout(function() {
			layer.closeAll();

		});


        $('#batch_img').mouseover(function() {
            layer.closeAll();
            var that = this;
            layer.tips('入库批次号命名规则-样例说明：<br/>批次号：03-20160509-24G-A<br/>03:广东动力100卡类型号<br/>20160509：开卡时间<br/>24G：套餐大小<br/>A：包年套餐（B：季度套餐  C：月卡套餐）',that,{time:20000});
        }).mouseout(function() {
            layer.closeAll();

        });



    </script>
</body>
</html>

<!DOCTYPE html> <!--[if IE 8]> <html lang="en" class="ie8"> <![endif]--> <!--[if IE 9]> <html lang="en" class="ie9"> <![endif]--> <!--[if !IE]><!--> <html lang="en"> <!--<![endif]--> <!-- BEGIN HEAD --> <head>
        <meta charset="utf-8"/>
        <title>设备列表</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        {include ../../Admin/views/top.tpl}
    </head>
    <body class="fixed-top">
        {include ../../Admin/views/header.tpl}
        <div id="container" class="row-fluid">
            {include ../../Admin/views/menu.tpl}
		<div id="main-content">
			<!-- BEGIN PAGE CONTAINER-->
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN THEME CUSTOMIZER-->
						<div id="theme-change" class="hidden-phone">
							<i class="icon-cogs"></i> <span class="settings"> <span
								class="text">Theme:</span> <span class="colors"> <span
									class="color-default" data-style="default"></span> <span
									class="color-gray" data-style="gray"></span> <span
									class="color-purple" data-style="purple"></span> <span
									class="color-navy-blue" data-style="navy-blue"></span> </span>
							</span>
						</div>
						
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN BORDERED TABLE widget-->
						<div class="widget">
							<div class="widget-title">
								<h4>
									<i class="icon-reorder"></i>设备列表
								</h4>
							</div>

								<!-- 上传文件的弹框start -->
							<div id="myModal" class="modal hide fade in dialog-upload-card"
								style="display: none;">
								<div class="modal-header">
									<button id="close-btn" data-dismiss="modal" class="close"
										type="button">×</button>
									<h3>导入设备</h3>
								</div>
								<iframe id="form-iframe" name="upload-form-iframe"
									style="display: none;"></iframe>
								<div class="modal-body" style="text-align: center;">
									<div id="uniform-fileInput">
										<form target="upload-form-iframe" id="upload-form"
											action="/device/device/importDataFromExcel.html" method="post"
											enctype="multipart/form-data">
											
											<input id="file" type="file" name="upload"
												class="input-file uniform_on" size="19">
										</form>
										<a href="{STATIC_SERVER}/templ/box_import.xlsx">点击下载导入模版</a>
									</div>
								</div>
								<div class="modal-footer">
									<a id="cancel-upload" class="btn" href="javascript:void(0);">取消</a>
									<a id="start-upload" class="btn btn-primary"
										href="javascript:void(0);">导入</a>
								</div>
							</div>
							<!-- 上传文件的弹框end -->
							<div class="widget-body">
								<div class="control-group form-horizontal search">
									<div class="row-fluid">
										<div class="span2" style="width: 90px">
											<label> <select id="page_rows" style="width: 56px;">
													<option value="10" selected="selected">10</option>
													<option value="25">25</option>
													<option value="50">50</option>
													<option value="100">100</option>
											</select> 条/页 </label>
										</div>
										<div class="span8">
											<input style="width: 100px;" style="color:#999999;"
												type="text" id="imei" name="imei"  alt="imei" title="imei" value="imei" default_val="imei"/>  时间: <input class="datepicker" style="width: 130px;"
												onClick="WdatePicker();" id="begin" value="创建开始时间"
												default_val="创建开始时间" style="color:#999999;" type="text"> <input
												class="datepicker" style="width: 130px;"
												onClick="WdatePicker();" id="end" value="创建结束时间"
												default_val="创建结束时间" style="color:#999999;" type="text"> <a
												id="search-btn" class="btn btn-primary"
												style="margin-left: 10px;" href="javascript:void(0);">搜 索</a>
										</div>
											<div class="span2">
										<a href="javascript:void(0);" title="导入设备" alt="导入设备"
											class="btn btn-primary" id="fileInput">导入设备</a>
										
									</div>
									</div>
								</div>
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>ID</th>
											<th>经销商号</th>
											<th>imei</th>
											<th>极光ID</th>
											<th>注释</th>
											<th>创建时间</th>
											<th>操作</th>
										</tr>
									</thead>
									<tbody id="list-data">
									</tbody>
								</table>
								<div class="box-content list-loading"
									style="vertical-align: middle; text-align: center;">
									Loading <img title="img/Fancy pants.gif"
										src="<!--{STATIC_SERVER}-->/img/Fancy pants.gif">
								</div>
								<div class="row-fluid">
									<div class="span8 center">
										<div id="vpage" class=" paging_bootstrap pagination"></div>
									</div>
									<div class="span4"
										style="text-align: right; line-height: 40px;">
										<div class="dataTables_info" id="DataTables_Table_0_info">
											共计 <span id="vpage-max-page">0</span> 页，<span
												id="vpage-total">0</span> 条记录
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
	<script type="text/javascript"
		src="/static/js/jquery_vpage.js?v={STATIC_VERSION}"></script>
<script>
        jQuery(document).ready(function() {
            App.init();
            UIJQueryUI.init();
        });
        $(function () {
            $.vpage({
            	  'uri': '/device/device/getDeviceList.html'
            });
			var _imei = $("#imei");
			var _mac = $("#mac");
			var _status = $("#status");
			var _startTime = $("#ui_date_picker_from");
			var _endTime = $("#ui_date_picker_to");

            var _list = [_imei,_mac, _status,_startTime,_endTime];
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
            	var mac = (_mac.val()==_mac.attr('default_val')) ? '' : _mac.val();
         	    var imei = (_imei.val()==_imei.attr('default_val')) ? '' : _imei.val();
         	    var status = (_status.val()==_status.attr('default_val')) ? '' : _status.val();
     			var startTime = (_startTime.val()==_startTime.attr('default_val')) ? '' : _startTime.val();
     			var endTime = (_endTime.val()==_endTime.attr('default_val')) ? '' : _endTime.val()+' 23:59:59';
                $.vpage({
                	'uri': '/device/device/getDeviceList.html',
                    'query': "mac="+mac+"&imei="+imei+"&status="+status+"&start_time="+startTime+"&end_time="+endTime
                });
            });
        	$('#fileInput').click(function() {
				$('.dialog-upload-card').show();
			});
    		$('#cancel-upload,#close-btn').click(function() {
				$('.dialog-upload-card').hide();
			});
			
            $('#start-upload').click(function() {
            	var group = $('#devicegroup').val()
				if ($(this).attr('upload-status') == '1')
					return false;
				if ($('#file').val() == '')
					alert('请选择要上传的文件');
				$(this).attr('upload-status', '1');
				$('#upload-form').submit();
				alert('导入成功');
				window.location.href = "/device/device/index.html";
				
				
				
			});


			



        });
		
	
    </script>
</body>
<!-- END BODY -->
</html>

<!DOCTYPE html> <!--[if IE 8]> <html lang="en" class="ie8"> <![endif]--> <!--[if IE 9]> <html lang="en" class="ie9"> <![endif]--> <!--[if !IE]><!--> <html lang="en"> <!--<![endif]--> <!-- BEGIN HEAD --> <head>
        <meta charset="utf-8"/>
        <title>广告列表</title>
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
						
						<!--
						<h3 class="page-title">
							广告管理<small>广告列表</small>
						</h3>
						<ul class="breadcrumb" style="float: left;">
							<li style="margin-bottom: 0px;"><a href="/admin/home/index.html"><i
									class="icon-home"></i> </a><span class="divider">&nbsp;</span>
							</li>
							<li style="margin-bottom: 0px;"><a href="/admin/banner/index.html">object列表</a><span
								class="divider-last">&nbsp;</span></li>
						</ul>
						-->
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN BORDERED TABLE widget-->
						<div class="widget">
							<div class="widget-title">
								<h4>
									<i class="icon-reorder"></i>广告列表
								</h4>
							</div>
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
											 状态：<select style="width: 80px;"
												id="status">
												<option value="0">所有</option>
												<option value="1">正常</option>
												<option value="2">暂停</option>
												<option value="10">删除</option>
											</select> 时间: <input class="datepicker" style="width: 130px;"
												onClick="WdatePicker();" id="begin" value="开始时间"
												default_val="开始时间" style="color:#999999;" type="text"> <input
												class="datepicker" style="width: 130px;"
												onClick="WdatePicker();" id="end" value="结束时间"
												default_val="结束时间" style="color:#999999;" type="text"> <a
												id="search-btn" class="btn btn-primary"
												style="margin-left: 10px;" href="javascript:void(0);">搜 索</a>
										</div>
											<div class="span2">
											<a href="/ad/object/addview.html" title="添加广告" alt="添加广告"
											class="btn btn-primary" >添加广告</a>
									</div>
									</div>
								</div>
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>ID</th>
											<th>广告名称</th>
											<th>星级</th>
											<th>顺序</th>
											<th>是否免费</th>
											<th>开始时间</th>
											<th>结束时间</th>
											<th>状态</th>
											<th>标签</th>
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
            	  'uri': '/ad/object/getlist.html'
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
                	'uri': '/ad/object/getlist.html',
                    'query': "mac="+mac+"&imei="+imei+"&status="+status+"&start_time="+startTime+"&end_time="+endTime
                });
            });
        });
    </script>
</body>
<!-- END BODY -->
</html>

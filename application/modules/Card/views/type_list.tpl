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
							卡管理 <small>卡类型列表</small>
						</h3>
						<ul class="breadcrumb" style="float: left;">
							<li style="margin-bottom: 0px;"><a href="/comm/home/index.html"><i
									class="icon-home"></i> </a><span class="divider">&nbsp;</span>
							</li>
							<li style="margin-bottom: 0px;"><a href="/comm/dl/index.html">卡类型列表</a><span
								class="divider-last">&nbsp;</span></li>
						</ul>
						-->


					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="widget">
							<div class="widget-title">
								<h4>
									<i class="icon-reorder"></i>卡类型列表
								</h4>
							</div>

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
										<input value="卡名称" type="text" id="name"
											default_val="卡名称">


											<input alt="创建开始时间" title="创建开始时间" value="创建开始时间"
											default_val="创建开始时间" class="m-wrap" size="16" type="text"
											value="" id="ui_date_picker_from" /> <input alt="创建结束时间"
											title="创建结束时间" value="创建结束时间" default_val="创建结束时间" class="m-wrap"
											size="16" type="text" value="" id="ui_date_picker_to" /> <a
											id="search-btn" class="btn btn-primary" alt="搜 索" title="搜 索"
											href="javascript:void(0);">搜 索</a>
									</div>
									
								</div>
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>ID</th>
											<th>卡名称</th>
											<th>描述</th>
											<th>供应商</th>
											<th>卡状态</th>
                                            <th>创建时间</th>
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
	<script>
        jQuery(document).ready(function() {
            App.init();
            UIJQueryUI.init();
        });
        $(function () {
            $.vpage({
            	  'uri': '/card/type/getlist.html'
            });
            var _name = $("#name");
      	   var _startTime = $("#ui_date_picker_from");
      	   var _endTime = $("#ui_date_picker_to");
             
             var _list = [_name,_startTime,_endTime];
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
            	 var name = (_name.val()==_name.attr('default_val')) ? '' : _name.val();
      			var startTime = (_startTime.val()==_startTime.attr('default_val')) ? '' : _startTime.val();
      			var endTime = (_endTime.val()==_endTime.attr('default_val')) ? '' : _endTime.val()+' 23:59:59';	
                 $.vpage({
                	 'uri': '/card/type/getlist.html',
                     'query': "&name="+name+"&start_time="+startTime+"&end_time="+endTime
                 });
             });
        });


    </script>
</body>
</html>

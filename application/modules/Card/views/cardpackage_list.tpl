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
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="widget">
							<div class="widget-title">
								<h4>
									<i class="icon-reorder"></i>卡套餐列表
								</h4>
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
										<input value="iccid" type="text" id="iccid"  style="width:150px;"
											default_val="iccid">
                                        <input value="sim卡号" type="text" id="telephone"  style="width:150px;"
                                               default_val="sim卡号">
                                        <input value="套餐编码" type="text" id="pack_code" style="width:150px;"
                                               default_val="套餐编码">
										&nbsp;&nbsp;套餐状态：<select style="width: 80px;" id="status">
											<option value="a">所有</option>
											<option value="0">未激活</option>
											<option value="1">未生效</option>
											<option value="2">已生效</option>
										</select>
											&nbsp;&nbsp;生效方式：<select style="width: 80px;" id="effective_type">
											<option value="a">所有</option>
											<option value="0">未指定</option>
											<option value="1">当月生效</option>
											<option value="2">下月生效</option>
											<option value="3">续接套餐</option>
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
											<th>ID</th>
											<th>卡类型</th>
											<th>卡iccid</th>
											<th>手机号</th>
                                            <th>订单号</th>
											<th>套餐名称</th>
											<th>套餐类型</th>
											<th>套餐状态</th>
											<th>售价</th>
                                            <th>生效时间</th>
											<th>到期时间</th>
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
            	  'uri': '/card/cardpackage/getlist.html'
            });
            var _iccid = $("#iccid");
            var _telephone = $("#telephone");
            var _pack_code = $("#pack_code");
      	   var _startTime = $("#ui_date_picker_from");
      	   var _endTime = $("#ui_date_picker_to");
             
             var _list = [_iccid,_telephone,_pack_code,_startTime,_endTime];
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
          	    var iccid = (_iccid.val()==_iccid.attr('default_val')) ? '' : _iccid.val();
          	    var telephone = (_telephone.val()==_telephone.attr('default_val')) ? '' : _telephone.val();
          	    var pack_code = (_pack_code.val()==_pack_code.attr('default_val')) ? '' : _pack_code.val();
				 var status=$('#status').val();
				 var effective_type=$('#effective_type').val();
      			var startTime = (_startTime.val()==_startTime.attr('default_val')) ? '' : _startTime.val();
      			var endTime = (_endTime.val()==_endTime.attr('default_val')) ? '' : _endTime.val()+' 23:59:59';	
                 $.vpage({
                	 'uri': '/card/cardpackage/getlist.html',
                     'query':  "&iccid="+iccid+'&telephone='+telephone+"&pack_code="+pack_code+"&status="+status+"&start_time="+startTime+"&end_time="+endTime+"&effective_type="+effective_type
                 });
             });
			$('#exportData').click(function() {
				var iccid = (_iccid.val()==_iccid.attr('default_val')) ? '' : _iccid.val();
                var telephone = (_telephone.val()==_telephone.attr('default_val')) ? '' : _telephone.val();
				var pack_code = (_pack_code.val()==_pack_code.attr('default_val')) ? '' : _pack_code.val();
				var status=$('#status').val();
				var effective_type=$('#effective_type').val();
				var startTime = (_startTime.val()==_startTime.attr('default_val')) ? '' : _startTime.val();
				var endTime = (_endTime.val()==_endTime.attr('default_val')) ? '' : _endTime.val()+' 23:59:59';
				window.open("/card/cardpackage/exportDatatwo.html?iccid="+iccid+'&telephone='+telephone+"&pack_code="+pack_code+"&status="+status+"&start_time="+startTime+"&end_time="+endTime+"&effective_type="+effective_type);
			});
        });
     

		function alertResult(data) {
			var jsonData = $.parseJSON(data);
			$('#start-download').attr('download-status', '0');
			if(jsonData.code == 200){
				alert("导入成功");
			}else{
				alert("导入失败，"+jsonData.msg);
			}
			window.location.href = "/card/cardpackage/index.html";
		}
		
    </script>
</body>
</html>

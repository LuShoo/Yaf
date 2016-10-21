<!DOCTYPE html> <!--[if IE 8]> <html lang="en" class="ie8"> <![endif]--> <!--[if IE 9]> <html lang="en" class="ie9"> <![endif]--> <!--[if !IE]><!--> <html lang="en"> <!--<![endif]--> <!-- BEGIN HEAD --> <head>
    <meta charset="utf-8"/>
    <title>showboom - 销售管理平台</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    {include ../../Admin/views/top.tpl}
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
    <!-- BEGIN HEADER -->
    {include ../../Admin/views/header.tpl}
    <!-- END HEADER -->
    <!-- BEGIN CONTAINER -->
    <div id="container" class="row-fluid">
        <!-- BEGIN SIDEBAR -->
        {include ../../Admin/views/menu.tpl}
        <!-- END SIDEBAR -->
        <!-- BEGIN PAGE -->
        <div id="main-content">
            <!-- BEGIN PAGE CONTAINER-->
            <div class="container-fluid">
                <!-- BEGIN PAGE HEADER-->
                <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN THEME CUSTOMIZER-->
                        <div id="theme-change" class="hidden-phone">
                            <i class="icon-cogs"></i>
                            <span class="settings">
                                <span class="text">Theme:</span>
                                <span class="colors">
                                    <span class="color-default" data-style="default"></span>
                                    <span class="color-gray" data-style="gray"></span>
                                    <span class="color-purple" data-style="purple"></span>
                                    <span class="color-navy-blue" data-style="navy-blue"></span>
                                </span>
                            </span>
                        </div>
                        <!-- END THEME CUSTOMIZER-->
                        
                        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                        {include ../../Admin/views/breadcrumb.tpl}
                        <!--
                        <h3 class="page-title">
                            渠道管理<small>渠道商列表</small>
                        </h3>
                        <ul class="breadcrumb" style="float: left;">
                            <li style="margin-bottom: 0px;"><a href="/admin/home/index.html"><i class="icon-home"></i></a><span class="divider">&nbsp;</span></li>
                            <li style="margin-bottom: 0px;"><a href="/channel/user/index.html">渠道商列表</a><span class="divider-last">&nbsp;</span></li>
                        </ul>
                        -->
                        <div class="row-fluid" style="margin-top:10px; width: 10%; float:right;;margin-right: 20px;">
                            <div class="span12">
                                <div id="nestable_list_menu" class="margin-bottom-10 pull-right">
                                    <a href="/corp/identify/add.html" data-action="expand-all" class="btn btn-info" type="button">添加企业实名</a>
                                </div>
                            </div>
                        </div>
                        <!-- END PAGE TITLE & BREADCRUMB-->
                    </div>
                </div>
                <!-- END PAGE HEADER-->
                
                <!-- BEGIN PAGE CONTENT-->          
                <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN BORDERED TABLE widget-->
                        <div class="widget">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i>企业实名列表</h4>
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

                                        <input value="实名企业编码" type="text" id="bid"
                                               default_val="实名企业编码" style="width: 120px;">

                                        <input value="企业名称" type="text" id="corp_name"
                                               default_val="企业名称" style="width: 120px;">

                                        &nbsp;&nbsp;业务类型：<select style="width: 80px;" id="type">
                                            <option value="0">全部</option>
                                            <option value="1">渠道</option>
                                            <option value="2">大客户</option>
                                            <option value="3">虚商</option>
                                        </select>

											<input alt="创建开始时间" title="创建开始时间" value="创建开始时间"
											default_val="创建开始时间" class="m-wrap" size="16" type="text"
											value="" id="ui_date_picker_from" style="width: 120px;" /> <input alt="创建结束时间"
											title="创建结束时间" value="创建结束时间" default_val="创建结束时间" class="m-wrap"
											size="16" type="text" value="" id="ui_date_picker_to" style="width: 120px;" /> <a
											id="search-btn" class="btn btn-primary" alt="搜 索" title="搜 索"
											href="javascript:void(0);">搜 索</a>


                                        &nbsp;&nbsp; &nbsp;&nbsp; <a href="javascript:void(0);" title="导出" alt="导出"
                                                                     class="btn btn-primary" id="exportData">导出</a>

									</div>
									
								</div>


                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>业务类型</th>
                                            <th>实名企业编号</th>
                                            <th>实名人姓名</th>
                                            <th>企业法人身份证</th>
                                            <th>企业名称</th>
                                            <th>营业执照号</th>
                                            <th>企业授权人</th>
                                            <th>企业授权人联系方式</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody id="list-data">
                                    </tbody>
                                </table>
                                <div class="box-content list-loading" style="vertical-align: middle; text-align: center;">
                                    Loading <img title="img/Fancy pants.gif" src="<!--{STATIC_SERVER}-->/img/Fancy pants.gif">
                                </div>
                                <div class="row-fluid">
                                    <div class="span8 center">
                                        <div id="vpage"
                                             class=" paging_bootstrap pagination"></div>
                                    </div>
                                    <div class="span4" style="text-align: right; line-height: 40px;">
                                        <div class="dataTables_info" id="DataTables_Table_0_info">
                                            共计 <span id="vpage-max-page">0</span> 页，<span
                                                    id="vpage-total">0</span> 条记录
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END BORDERED TABLE widget-->
                    </div>
                </div>
                <!-- END PAGE CONTENT-->
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
        <!-- END PAGE -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    {include ../../Admin/views/footer.tpl}
    <script type="text/javascript" src="/static/js/jquery_vpage.js?v={STATIC_VERSION}"></script>
    <script type="text/javascript" src="/static/js/div.js?v={STATIC_VERSION}"></script>
    <script type="text/javascript" src="/static/js/layer/layer.js"></script>
    <script>
    jQuery(document).ready(function() {
        App.init();
        UIJQueryUI.init();
    });
    $(function () {
            $.vpage({
                'uri': '/corp/identify/getlist.html'
            });
            var _corp_name = $("#corp_name");
            var _bid = $("#bid");

      	   var _startTime = $("#ui_date_picker_from");
      	   var _endTime = $("#ui_date_picker_to");
             
             var _list = [_corp_name,_bid,_startTime,_endTime];
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
            	 var corp_name = (_corp_name.val()==_corp_name.attr('default_val')) ? '' : _corp_name.val();
            	 var bid = (_bid.val()==_bid.attr('default_val')) ? '' : _bid.val();

      			var startTime = (_startTime.val()==_startTime.attr('default_val')) ? '' : _startTime.val();
      			var endTime = (_endTime.val()==_endTime.attr('default_val')) ? '' : _endTime.val()+' 23:59:59';

                 var type =$('#type').val();

                 $.vpage({
                	 'uri': '/corp/identify/getlist.html',
                     'query': "&corp_name="+corp_name+"&bid="+bid+"&type="+type+"&start_time="+startTime+"&end_time="+endTime
                 });
             });

            $('#exportData').click(function() {
                var corp_name = (_corp_name.val()==_corp_name.attr('default_val')) ? '' : _corp_name.val();
                var bid = (_bid.val()==_bid.attr('default_val')) ? '' : _bid.val();

                var startTime = (_startTime.val()==_startTime.attr('default_val')) ? '' : _startTime.val();
                var endTime = (_endTime.val()==_endTime.attr('default_val')) ? '' : _endTime.val()+' 23:59:59';

                var type =$('#type').val();
                var status =$('#status').val();
                window.open("/corp/identify/exportData.html?corp_name="+corp_name+"&bid="+bid+"&type="+type+"&start_time="+startTime+"&end_time="+endTime);

            });

        });
    </script>
</body>
<!-- END BODY -->
</html>
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
                            系统管理<small>返利配置列表</small>
                        </h3>
                        <ul class="breadcrumb" style="float: left;">
                            <li style="margin-bottom: 0px;"><a href="/admin/home/index.html"><i class="icon-home"></i></a><span class="divider">&nbsp;</span></li>
                            <li style="margin-bottom: 0px;"><a href="/admin/user/index.html">返利配置列表</a><span class="divider-last">&nbsp;</span></li>
                        </ul>
                        -->
                        <div class="row-fluid" style="margin-top:10px; width: 10%; float:right;">
                            <div class="span12">
                                <div id="nestable_list_menu" class="margin-bottom-10 pull-right">
                                    <a href="/admin/rebate/addview.html" data-action="expand-all" class="btn btn-info" type="button">添加返利配置</a>
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
                                <h4><i class="icon-reorder"></i>返利配置列表</h4>
                            </div>
                            <div class="widget-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>返利名称</th>
                                            <th>卡类型</th>
                                            <th>返还比例</th>
                                            <th>创建时间</th>
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
    <script>
        jQuery(document).ready(function() {
            // initiate layout and plugins
            App.init();
            $.vpage({
                'uri': '/admin/rebate/getlist.html'
            });
        });
        function delConfig(id){
			$.delDiv({
				title: '删除配置',					//标题 
				content: '你确定要删除此配置吗？',	//内容框
				data:{												//数据
					id: id
				},
				type:'post',					
				url:'/admin/rebate/delConfig.html',		//回调url	
				returnUrl:'/admin/rebate/index.html'		//删除成功后跳转的url 	
			});
           }
    </script>
</body>
<!-- END BODY -->
</html>
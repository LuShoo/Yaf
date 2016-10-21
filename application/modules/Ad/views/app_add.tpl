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
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="span12">
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
                            {include ../../Admin/views/breadcrumb.tpl}
                            <!--
                            <h3 class="page-title" style='line-height: 50px;font-size: 25px;'>
                                <i class="icon-th-list"></i> 应用管理
                            </h3>
                            <ul style="float: left;" class="breadcrumb">
                                <li style="margin-bottom: 0px;"><a href="/admin/home/index.html"><i class="icon-home"></i></a><span class="divider">&nbsp;</span></li>
                                <li style="margin-bottom: 0px;"><a>添加应用</a><span class="divider-last">&nbsp;</span></li>
                            </ul>
                            -->
                        </div>
                    </div>     
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="widget">
                                <div class="widget-title">
                                    <h4><i class="icon-reorder"></i>修改设备</h4>
                                </div>
                                <div class="widget-body form">
                                    <form class="form-horizontal" id="appForm" action="/ad/app/add.html" method="post">
                                         <div class="control-group">
                                            <label class="control-label">应用标识</label>
                                            <div class="controls">
                                                 <input type="text" id="app_code" name="app_code" >
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div>
                                         <div class="control-group">
                                            <label class="control-label">应用名称</label>
                                            <div class="controls">
                                                 <input type="text" id="app_name" name="app_name" >
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div>
                                          <div class="control-group">
	                                        <label class="control-label">应用平台</label>
	                                        <div class="controls">
	                                           <select  name="platform" id="platform">
												<option  value="iphone">iphone</option>
												<option  value="ipad">ipad</option>
												<option  value="anroid">anroid</option>
												<option  value="showboom">showboom</option>
												<option  value="pc">pc</option>
												<option  value="mobileweb">mobileweb</option>
												</select>
	                                         </div>
	                                    </div>
                                       <div class="control-group">
	                                        <label class="control-label">状态</label>
	                                        <div class="controls">
	                                           <select  name="status" id="status">
												<option  value="1">正常</option>
												<option  value="2">暂停</option>
												</select>
	                                         </div>
	                                    </div>
                                        <div class="form-actions">
                                            <button type="button" class="btn btn-primary" id="add-submit">添加</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {include ../../Admin/views/footer.tpl}
        <script language="javascript" type="text/javascript" src="/static/js/jquery.validate.js"></script>
		<script language="javascript" type="text/javascript" src="/static/js/validate_expand.js"></script>
		<script language="javascript" type="text/javascript" src="/static/js/validate.js"></script>
        <script>
            jQuery(document).ready(function () {
                App.init();
               // initFormValidator();
            });
            // 建立设备
            $("#add-submit").click(function(){
                $("#appForm").submit();
            });
        </script>
    </body>
    <!-- END BODY -->
</html>
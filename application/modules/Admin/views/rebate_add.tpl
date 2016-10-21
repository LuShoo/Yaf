<!DOCTYPE html> <!--[if IE 8]> <html lang="en" class="ie8"> <![endif]--> <!--[if IE 9]> <html lang="en" class="ie9"> <![endif]--> <!--[if !IE]><!--> <html lang="en"> <!--<![endif]--> <!-- BEGIN HEAD --> <head>
        <meta charset="utf-8"/>
        <title>showboom - 销售管理平台</title>
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
                                <i class="icon-th-list"></i> 返利配置管理
                            </h3>
                            <ul style="float: left;" class="breadcrumb">
                                <li style="margin-bottom: 0px;"><a href="/admin/home/index.html"><i class="icon-home"></i></a><span class="divider">&nbsp;</span></li>
                                <li style="margin-bottom: 0px;"><a>返利配置管理</a><span class="divider">&nbsp;</span></li>
                                <li style="margin-bottom: 0px;"><a>添加返利配置</a><span class="divider-last">&nbsp;</span></li>
                            </ul>
                            -->
                        </div>
                    </div>     
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="widget">
                                <div class="widget-title">
                                    <h4><i class="icon-reorder"></i>添加返利配置</h4>
                                </div>
                                <div class="widget-body form">
                                    <form class="form-horizontal" id="rebateForm" action="/admin/rebate/add.html" method="post">
                                      <div class="control-group">
                                            <label class="control-label">标题</label>
                                            <div class="controls">
                                                 <input type="text" id="title" name="title" value="" >
                                                 <span class="help-inline"><i style="color:red">*</i></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">卡类型</label>
                                            <div class="controls">
                                                 <input type="text" id="card_type" name="card_type" value="" >
                                                 <span class="help-inline"><i style="color:red">*</i></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">返还比例</label>
                                            <div class="controls">
                                                 <input type="text" id="rate" name="rate" value="" >
                                                 <span class="help-inline"><i style="color:red">*</i></span>
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
            });
            // 建立返利配置
            $("#add-submit").click(function(){
                $("#rebateForm").submit();
            });
        </script>
    </body>
    <!-- END BODY -->
</html>
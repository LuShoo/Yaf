<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>showboom - 销售管理平台</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
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
                       
                        <!--
                        <h3 class="page-title">
                            系统管理 <small>管理</small>
                        </h3>
                        <ul class="breadcrumb" style="float: left;">
                            <li style="margin-bottom: 0px;"><a href="/admin/home/index.html"><i class="icon-home"></i></a><span class="divider">&nbsp;</span></li>
                            <li style="margin-bottom: 0px;"><a href="/admin/home/menu.html">菜单管理</a><span class="divider">&nbsp;</span></li>
                            <li><a href="#">{$title}</a> <span class="divider-last">&nbsp;</span></li>
                        </ul>
                        -->
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
                                <h4><i class="icon-reorder"></i></h4>
                            </div>
                            <div class="widget-body form">
                                <!-- BEGIN FORM-->
                                <form class="form-horizontal">
                                    <div class="control-group">
                                        <label class="control-label">所属组</label>

                                        <div class="controls">
                                           <select id='pid' tabindex="-1" class="span6 chosen chzn-done">
                                              <!--{loop $list $val}-->
                                              <option >11111</option>
                                              <option >11111</option>
                                              <option >11111</option>
                                              <!--{/loop}-->
                                           </select>
                                        </div>


                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">分组名称</label>
                                        <div class="controls">
                                            <input type="text" name="group_name"  class="span6  popovers">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">是否允许删除</label>
                                        <div class="controls">
                                            <label style="display:inline;float:left;"><input type="radio" name="enable_del" style="margin:0px;padding:0px;"/>是</label>
                                            <label style="display:inline;float:left;"><input type="radio" name="enable_del"  style="margin:0px;padding:0px;"/>否</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">分组描述</label>
                                        <div class="controls"><textarea class="form-control" rows="3" name="description"></textarea></div>
                                    </div>
                                    <div class="form-actions">

                                        <button class="btn btn-success" type="button" onclick="subform();">确认</button>
                                    </div>
                                </form>
                                <!-- END FORM-->
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
    <script>
        jQuery(document).ready(function() {
            // initiate layout and plugins
            App.init();
        });
        function subform()
        {
            var pid = $("#pid").val().trim();
            var group_name = $("input[name='group_name']").val().trim();
            var enable_del = $("input[name='enable_del']:checked").val().trim();
            var description = $("textarea[name='description']").val().trim();
            var upid = $("input[name='updateid']").val().trim();
            var level = $("#pid").find("option:selected").attr('level').trim();
            var data = {'pid':pid,'group_name':group_name,'level':level,'enable_del':enable_del,'description':description};

            if(upid) data.id = upid;
            $.post('/admin/group/createGroup.html',data,function(m){
                if(m.code == '200')
                {
                    alert("操作成功。");
                    location.href = '/admin/group/index.html';
                }
                else alert(m.message);
            },"json");
        }
    </script>
</body>
<!-- END BODY -->
</html>
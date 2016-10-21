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
                        {include ../../Admin/views/breadcrumb.tpl}
                        <!--
                        <h3 class="page-title">
                            系统管理 <small>菜单管理</small>
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
                                <h4><i class="icon-reorder"></i>{$title}</h4>
                            </div>
                            <div class="widget-body form">
                                <!-- BEGIN FORM-->
                                <form class="form-horizontal">
                                    <div class="control-group">
                                        <label class="control-label">菜单位置</label>
                                        <div class="controls">
                                           <select id='pid' tabindex="-1" class="span6 chosen chzn-done">
                                              <option value="0">顶级菜单</option>
                                              <!--{loop $list $val}-->
                                              <option value="{$val['id']}" {if $info['pid'] == $val['id']}selected='selected'{/if}>{$val['name']}</option>
                                              <!--{/loop}-->
                                           </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">菜单名称</label>
                                        <div class="controls">
                                            <input type="text" name="name" value="{$info['name']}" class="span6  popovers">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">菜单路由</label>
                                        <div class="controls">
                                            <input type="text" name="action" value="{$info['action']}" class="span6  popovers">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">是否显示</label>
                                        <div class="controls">
                                            <label style="display:inline;float:left;"><input type="radio" name="status" value="1" {if $info['status']==1}checked='checked'{/if} style="margin:0px;padding:0px;"/>显示</label>
                                            <label style="display:inline;float:left;"><input type="radio" name="status" value="2" {if $info['status']!=1}checked='checked'{/if} style="margin:0px;padding:0px;"/>隐藏</label>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">菜单图标</label>
                                        <div class="controls">
                                            <input type="text" name="icon" value="{$info['icon']}" class="span6  popovers">
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <input type="hidden" name="updateid" value="{$info['id']}"/>
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
            var name = $("input[name='name']").val().trim();
            var action   = $("input[name='action']").val().trim();
            var icon = $("input[name='icon']").val().trim();
            var upid = $("input[name='updateid']").val();
            var status = $("input[name='status']:checked").val();
            if(name.length < 2)
            {
                alert("菜单名不少于2位字符");
                return false;
            }
            if(action.length < 1)
            {
                alert("请填写菜单路由");
                return false;
            }
            var data = {'pid':pid,'name':name,'action':action,'icon':icon,'status':status};
            if(upid) data.id = upid;
            $.post('/admin/home/createmenu.html',data,function(m){
                if(m.code == '200')
                {
                    alert("操作成功。");
                    location.href = '/admin/home/menu.html';
                }
                else alert(m.detail);
            },"json");
        }
    </script>
</body>
<!-- END BODY -->
</html>
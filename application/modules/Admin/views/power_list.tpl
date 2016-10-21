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
                        系统管理 <small>菜单管理</small>
                    </h3>
                    <ul class="breadcrumb" style="float: left;">
                        <li style="margin-bottom: 0px;"><a href="/admin/home/index.html"><i class="icon-home"></i></a><span class="divider">&nbsp;</span></li>
                        <li style="margin-bottom: 0px;"><a href="/admin/user/index.html">菜单管理</a><span class="divider-last">&nbsp;</span></li>
                    </ul>
                    -->
                    <div class="row-fluid" style="margin-top:10px; width: 10%; float:right;;margin-right: 20px;">
                        <div class="span12">
                            <div id="nestable_list_menu" class="margin-bottom-10 pull-right">
                                <a href="/admin/power/addPower.html" data-action="expand-all" class="btn btn-info" type="button">新增权限</a>
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
                            <h4><i class="icon-reorder"></i>菜单列表</h4>
                        </div>
                        <div class="widget-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="">ID</th>
                                    <th>父级ID</th>
                                    <th>功能名称</th>
                                    <th>功能路由</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody id="list-data">
                                <!--{loop $list $val}-->
                                <tr class="odd">
                                    <td width="8%">&nbsp;{$val['id']}</td>
                                    <td width="8%">&nbsp;{$val['parent_id']}</td>
                                    <td width="12%">&nbsp;{$val['perm_name']}</td>
                                    <td width="22%">&nbsp;{$val['action']}</td>
                                    <td width="6%">{if $val['status'] == 1}开启{else}关闭{/if}</td>
                                    <td width="12%">
                                        <a href="/admin/power/editPower.html?id={$val['id']}" class="btn btn-small btn-primary">编辑</a>
                                    </td>
                                </tr>
                                <!--{/loop}-->
                                </tbody>
                            </table>
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
</script>
</body>
<!-- END BODY -->
</html>
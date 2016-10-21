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
                      

                        <div class="row-fluid" style="margin-top:10px; width: 10%; float:right;;margin-right: 20px;">
                            <div class="span12">
                                <div id="nestable_list_menu" class="margin-bottom-10 pull-right">
                                   
                                    <a href="/admin/group/addGroup.html" data-action="expand-all" class="btn btn-info" type="button">添加分组</a>
                                   
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
                                            <th>ID</th>
                                            <th>PID</th>
                                            <th>分组名称</th>
                                            <th>分组级别</th>
                                            <th>分组描述</th>
                                            <th>是否允许删除</th>
                                            <th>创建时间</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody id="list-data">
                                    <!--{loop $list $val}-->
                                        <tr class="odd">
                                            <td width="8%">&nbsp;{$val['id']}</td>
                                            <td width="8%">&nbsp;{$val['parent_id']}</td>
                                            <td width="12%">&nbsp;{$val['group_name']}</td>
                                            <td width="10%">
                                            {if $val['level'] == 1}一级分组
                                                {elseif $val['level'] == 2}二级分组
                                                {elseif $val['level'] == 3}三级分组
                                                {elseif $val['level'] == 4}四级分组
                                                {elseif $val['level'] == 5}五级分组
                                            {/if}

                                            </td>
                                            <td width="22%">&nbsp;{$val['description']}</td>
                                            <td width="8%">{if $val['enable_del'] == 1}是{else}否{/if}</td>
                                            <td width="10%">&nbsp;{$val['created_at']}</td>
                                            <td width="22%">
                                                {if $level !=5}
                                                <a href="/admin/group/editGroup.html?gid={$val['id']}" class="btn btn-small btn-primary">编辑</a>
                                                {if $val['enable_del'] == 1}
                                                <a href="/admin/group/delGroup.html?gid={$val['id']}" class="btn btn-small btn-danger">删除</a>
                                                {/if}
                                                {/if}
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
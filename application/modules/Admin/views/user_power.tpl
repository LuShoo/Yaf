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
                        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                        {include ../../Admin/views/breadcrumb.tpl}
                        <!--
                        <h3 class="page-title">
                            系统管理 <small>用户列表</small>
                        </h3>
                        <ul class="breadcrumb" style="height:32px">
                            <li><a href="/admin/home/index.html"><i class="icon-home"></i></a><span class="divider">&nbsp;</span></li>
                            <li><a href="/admin/user/index.html">用户列表</a><span class="divider">&nbsp;</span></li>
                            <li><a href="#">设置权限：{$userinfo['nickname']}</a> <span class="divider-last">&nbsp;</span></li>
                        </ul>
                        -->
                        <!-- END PAGE TITLE & BREADCRUMB-->
                    </div>
                </div>
                <!-- END PAGE HEADER-->
                <input type="hidden" id="user_id" value="{$userinfo['id']}"/>
                <!-- BEGIN PAGE CONTENT-->
                <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN BORDERED TABLE widget-->
                        <div class="widget">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i>权限列表</h4>
                            </div>
                            <div class="widget-body" id="MenuList">
                                {$menuList}
                            </div>
                        </div>
                        <!-- END BORDERED TABLE widget-->
                        <button class="btn btn-small btn-primary" type="button" onclick="savePower();">保存修改</button>
                    </div>
                </div>

                <!-- END PAGE CONTENT-->
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
        <!-- END PAGE -->
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        {include ../../Admin/views/footer.tpl}
    </div>
    <script>
        jQuery(document).ready(function() {
            // initiate layout and plugins
            App.init();
        });
        function savePower()
        {
            var box = $("#MenuList").find("input[type='checkbox']");
            var power = '';
            box.each(function(){
                if($(this).attr("checked"))
                {
                    power += $(this).val()+',';
                }
            });
            var user_id = $("#user_id").val();
            $.post('/admin/user/savepower.html',{'user_id':user_id,'power':power},function(data){
                if(data == 'ok')
                {
                    alert("设置成功");
                    location.href = '/admin/user/index.html';
                }
                else
                {
                    alert(data);
                }
            });
        }
        //菜单关联关系
        function relation(o,id)
        {
            if(id == '0' && $(o).attr("checked")!='checked')
            {
                var child = $(".belog"+$(o).val());
                child.each(function(){
                    if($(this).attr("checked"))
                    {
                        $(this).attr("checked",false);
                    }
                });
            }
            if(id > 0)
            {
                if($("#Mu"+id).attr("checked")!='checked')
                {
                    $("#Mu"+id).attr("checked","checked");
                }
            }
        }
    </script>
</body>
<!-- END BODY -->
</html>
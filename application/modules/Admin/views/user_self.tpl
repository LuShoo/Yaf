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
                            用户中心 <small>我的信息</small>
                        </h3>
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
                                        <label class="control-label">用户名</label>
                                        <div class="controls">
                                            <input type="text" name="username" value="{$userinfo['username']}" data-original-title="注意" data-content="用户名不少于六个字符" data-trigger="hover" class="span6  popovers">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">昵称</label>
                                        <div class="controls">
                                            <input type="text" name="nickname" value="{$userinfo['nickname']}" class="span6  popovers">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">所属部门</label>
                                        <div class="controls">
                                            <input type="text" name="branch" value="{$userinfo['branch']}" class="span6  popovers">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">密码</label>
                                        <div class="controls">
                                            <input type="password" name="password" data-original-title="注意" data-content="密码不少于六个字符" data-trigger="hover" class="span6  popovers">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">重复密码</label>
                                        <div class="controls">
                                            <input type="password" name="repeat" data-original-title="注意" data-content="两次输入必须一致" data-trigger="hover" class="span6  popovers">
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <input type="hidden" name="updateid" value="{$userinfo['id']}"/>
                                        <button class="btn btn-success" type="button" onclick="subform();">确认</button>
                                        <button class="btn" type="button">取消</button>
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
            var username = $("input[name='username']").val().trim();
            var nickname = $("input[name='nickname']").val().trim();
            var branch   = $("input[name='branch']").val().trim();
            var password = $("input[name='password']").val().trim();
            var repeat   = $("input[name='repeat']").val().trim();
            var updateid = $("input[name='updateid']").val().trim();
            if(username.length < 6)
            {
                alert("用户名不少于六位字符");
                return false;
            }
            if(nickname.length < 1)
            {
                alert("请填写昵称");
                return false;
            }
            if(branch.length < 1)
            {
                alert("请填写所属部门");
                return false;
            }
            var data = {'id':updateid,'username':username,'nickname':nickname,'branch':branch};
            if(password != '')
            {
                if(password.length < 6)
                {
                    alert("密码不少于六位字符");
                    return false;
                }
                if(password != repeat)
                {
                    alert("两次密码不一致");
                    return false;
                }
                data.password = password
            }
            $.post('/admin/user/create.html',data,function(m){
                if(m.code == '200')
                {
                    alert("操作成功。");
                }
                else alert(m.detail);
            },"json");
        }
    </script>
</body>
<!-- END BODY -->
</html>
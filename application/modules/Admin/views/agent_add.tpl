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
                            系统管理 <small>{$title}</small>
                        </h3>-->
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
                                        <label class="control-label">登录账号</label>
                                        <div class="controls">
                                            <input type="text" name="name" value="{$userinfo['name']}" {if $userinfo['id'] > 0}readonly="readonly"{/if} data-original-title="注意" data-content="用户名不少于六个字符" data-trigger="hover" class="span6  popovers">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">客户名称</label>
                                        <div class="controls">
                                            <input type="text" name="agentname" value="{$userinfo['agentname']}" class="span6  popovers">
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
                                    <div class="control-group">
                                        <label class="control-label">联系人</label>
                                        <div class="controls">
                                            <input type="text" name="linkname" value="{$userinfo['linkname']}" class="span6  popovers">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">联系人电话</label>
                                        <div class="controls">
                                            <input type="text" name="telephone" value="{$userinfo['telephone']}" class="span6  popovers">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">联系人地址</label>
                                        <div class="controls">
                                            <input type="text" name="address" value="{$userinfo['address']}" class="span6  popovers">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">状态</label>
                                        <div class="controls">
                                            <label class="radio">
                                                <input type="radio" value="0" name="status" {if $userinfo['status'] == 0}checked="1"{/if} style="opacity: 0;">停用
                                            </label>
                                            <label class="radio">
                                                <input type="radio" value="1" name="status" {if $userinfo['status'] != 0}checked="1"{/if} style="opacity: 0;">可用
                                            </label>  
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
            var name        = $("input[name='name']").val().trim();
            var agentname   = $("input[name='agentname']").val().trim();
            var linkname    = $("input[name='linkname']").val().trim();
            var telephone   = $("input[name='telephone']").val().trim();
            var address     = $("input[name='address']").val().trim();
            var password    = $("input[name='password']").val().trim();
            var repeat      = $("input[name='repeat']").val().trim();
            var updateid    = $("input[name='updateid']").val().trim();
            var status      = $("input[name='status']:checked").val();
            var updateid    = $("input[name='updateid']").val();
            if(name.length < 6)
            {
                alert("用户名不少于六位字符");
                return false;
            }
            if(agentname.length < 1)
            {
                alert("请填写客户名称");
                return false;
            }
            if(linkname.length < 1)
            {
                alert("请填写联系人");
                return false;
            }
            if(telephone.length < 1)
            {
                alert("请填写联系人电话");
                return false;
            }
            var data = {'name':name,'agentname':agentname,'linkname':linkname,'telephone':telephone,'address':address,'status':status};
            if(updateid < 1)
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
                data.password = password;
            }
            else
            {
                data.id = updateid;
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
            }
            $.post('/message/message/create.html',data,function(m){
                if(m.detail == 'ok')
                {
                    alert("操作成功。");
                    //location.href = '/admin/agent/index.html';
                } 
                else {
					alert("失败");
				}
            },"json");
        }
    </script>
</body>
<!-- END BODY -->
</html>
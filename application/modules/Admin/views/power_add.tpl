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
                                    <label class="control-label">权限位置</label>
                                    <div class="controls">
                                        <select id='pid' tabindex="-1" class="span6 chosen chzn-done">
                                            <option value="0">顶级权限</option>
                                            <!--{loop $list $val}-->
                                            <option value="{$val['id']}" {if $info['parent_id'] == $val['id']}selected='selected'{/if}>{$val['perm_name']}</option>
                                            <!--{/loop}-->
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">权限名称</label>
                                    <div class="controls">
                                        <input type="text" name="perm_name" value="{$info['perm_name']}" class="span6  popovers">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">所属模块</label>
                                    <div class="controls">
                                        <input type="text" name="module" value="{$info['module']}" class="span6  popovers">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">所属控制器</label>
                                    <div class="controls">
                                        <input type="text" name="class" value="{$info['class']}" class="span6  popovers">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">请求服务</label>
                                    <div class="controls">
                                        <input type="text" name="action" value="{$info['action']}" class="span6  popovers">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">权限类别</label>
                                    <div class="controls">
                                        <label style="display:inline;float:left;"><input type="radio" name="perm_type" value="SHOW" {if $info['perm_type']!='EDIT'}checked='checked'{/if} style="margin:0px;padding:0px;"/>菜单项</label>
                                        <label style="display:inline;float:left;"><input type="radio" name="perm_type" value="EDIT" {if $info['perm_type']=='EDIT'}checked='checked'{/if} style="margin:0px;padding:0px;"/>管理项</label>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">是否显示</label>
                                    <div class="controls">
                                        <label style="display:inline;float:left;"><input type="radio" name="status" value="1" {if $info['status']!=2}checked='checked'{/if} style="margin:0px;padding:0px;"/>显示</label>
                                        <label style="display:inline;float:left;"><input type="radio" name="status" value="2" {if $info['status']==2}checked='checked'{/if} style="margin:0px;padding:0px;"/>隐藏</label>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">生成按钮</label>
                                    <div class="controls">
                                        <label style="display:inline;float:left;"><input type="radio" name="btn" value="0" {if $button['btn']==0}checked='checked'{/if} style="margin:0px;padding:0px;"/>否</label>
                                        <label style="display:inline;float:left;"><input type="radio" name="btn" value="1" {if $button['btn']==1}checked='checked'{/if} style="margin:0px;padding:0px;"/>是</label>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">生成按钮位置</label>
                                    <div class="controls">
                                        <label style="display:inline;float:left;"><input type="radio" name="btn_position" value="0" {if $button['btn_position'] =='0'}checked='checked'{/if} style="margin:0px;padding:0px;"/>菜单</label>
                                        <label style="display:inline;float:left;"><input type="radio" name="btn_position" value="1" {if $button['btn_position']=='1'}checked='checked'{/if} style="margin:0px;padding:0px;"/>列表</label>
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
        var perm_name = $("input[name='perm_name']").val().trim();
        var module   = $("input[name='module']").val().trim();
        var classs = $("input[name='class']").val().trim();
        var action = $("input[name='action']").val().trim();
        var perm_type = $("input[name='perm_type']").val();
        var upid = $("input[name='updateid']").val();
        var status = $("input[name='status']:checked").val();
        var btn = $("input[name='btn']:checked").val();
        var btn_position = $("input[name='btn_position']:checked").val();
        var data = {'pid':pid,'perm_name':perm_name,'perm_type':perm_type,'module':module,'class':classs,'action':action,'status':status,'btn':btn};
        if(btn_position) data.btn_position = btn_position;
        if(upid) data.id = upid;
        $.post('/admin/power/createPower.html',data,function(m){
            if(m.code == '200')
            {
                alert("操作成功。");
                location.href = '/admin/power/index.html';
            }
            else alert(m.message);
        },"json");
    }
</script>
</body>
<!-- END BODY -->
</html>
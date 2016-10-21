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
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i>修改设备</h4>
                        </div>
                        <div class="widget-body form">
                            <form class="form-horizontal" id="deviceForm" action="/device/device/doedit.html" method="post">
                                <input type="hidden" name="id" id="id" value={$info['id']}>
                                <div class="control-group">
                                    <label class="control-label">所属组</label>
                                    <div class="controls">
                                        <select  name="group" id="group">
                                            {loop $groupinfo $val}
                                                <option value="{$val['id']}_{$val['level']}" {if $val['id']==$devicegroup} selected {/if}>{$val['group_name']}</option>
                                            {/loop}
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">imei</label>
                                    <div class="controls">
                                        <input type="text" id="imei" name="imei" value="{$info['imei']}" disabled>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">imei2</label>
                                    <div class="controls">
                                        <input type="text" id="imei" name="imei" value="{$info['imei2']}" disabled>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">mac</label>
                                    <div class="controls">
                                        <input type="text" id="mac" name="mac" value="{$info['mac']}" disabled>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">状态</label>
                                    <div class="controls">
                                        <select  name="status" id="status">
                                            <option {if $info['status']==1} selected {/if} value="1">未售出</option>
                                            <option {if $info['status']==2} selected {/if} value="2">已售出</option>
                                            <option {if $info['status']==3} selected {/if} value="3">其他</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="button" class="btn btn-primary" id="add-submit">修改</button>
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
    // 建立设备
    $("#add-submit").click(function(){
        $("#deviceForm").submit();
    });
</script>
</body>
<!-- END BODY -->
</html>
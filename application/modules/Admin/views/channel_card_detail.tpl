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
                                <i class="icon-th-list"></i> 渠道管理
                            </h3>
                            <ul style="float: left;" class="breadcrumb">
                                <li style="margin-bottom: 0px;"><a href="/admin/home/index.html"><i class="icon-home"></i></a><span class="divider">&nbsp;</span></li>
                                <li style="margin-bottom: 0px;"><a>渠道管理</a><span class="divider">&nbsp;</span></li>
                                <li style="margin-bottom: 0px;"><a>查看渠道卡详情</a><span class="divider-last">&nbsp;</span></li>
                            </ul>
                            -->
                        </div>
                    </div>     
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="widget">
                                <div class="widget-title">
                                    <h4><i class="icon-reorder"></i>查看渠道卡详情</h4>
                                </div>
                                <div class="widget-body form">
                                    <form class="form-horizontal" id="rebateForm" action="/admin/channelcard/add.html" method="post">
                                      <div class="control-group">
                                            <label class="control-label">iccid</label>
                                            <div class="controls">
                                                 <input type="text" id="iccid" name="iccid" value="{$user_info['iccid']}"  readonly>
                                                 <span class="help-inline"><i style="color:red">*</i></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">流量卡类型</label>
                                            <div class="controls">
                                                 <input type="text" id="telephone" name="telephone" value="{$user_info['type_name']}" readonly >
                                                 <span class="help-inline"><i style="color:red">*</i></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">出库批次号</label>
                                            <div class="controls">
                                                <input type="text" id="telephone" name="telephone" value="{$user_info['batch']}" readonly >
                                                <span class="help-inline"><i style="color:red">*</i></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">手机号</label>
                                            <div class="controls">
                                                 <input type="text" id="cid" name="cid" value="{$user_info['telephone']}" readonly>
                                                 <span class="help-inline"><i style="color:red">*</i></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">SIM卡激活状态</label>
                                            <div class="controls">
                                                <input type="text" id="cid" name="cid" value="{if $user_info['is_active']!=0}已激活{else}未激活{/if}" readonly>
                                                <span class="help-inline"><i style="color:red">*</i></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">SIM卡激活时间</label>
                                            <div class="controls">
                                                <input type="text" id="cid" name="cid" value="{$user_info['actived_at']}" readonly>
                                                <span class="help-inline"><i style="color:red">*</i></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">店员绑定状态</label>
                                            <div class="controls">
                                                <input type="text" id="cid" name="cid" value="{if $user_info['is_binding']!=0}已绑定{else}未绑定{/if}" readonly>
                                                <span class="help-inline"><i style="color:red">*</i></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">店员绑定时间</label>
                                            <div class="controls">
                                                <input type="text" id="cid" name="cid" value="{$user_info['binding_at']}" readonly>
                                                <span class="help-inline"><i style="color:red">*</i></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">店员id</label>
                                            <div class="controls">
                                                <input type="text" id="cid" name="cid" value="{$user_info['clerk_id']}" readonly>
                                                <span class="help-inline"><i style="color:red">*</i></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">充值状态</label>
                                            <div class="controls">
                                                <input type="text" id="cid" name="cid" value="{if $user_info['is_recharge']!=0}已充值{else}未充值{/if}" readonly>
                                                <span class="help-inline"><i style="color:red">*</i></span>
                                            </div>
                                        </div>


                                        <div class="control-group">
                                            <label class="control-label">充值时间</label>
                                            <div class="controls">
                                                <input type="text" id="cid" name="cid" value="{$user_info['recharge_at']}" readonly>
                                                <span class="help-inline"><i style="color:red">*</i></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">渠道号</label>
                                            <div class="controls">
                                                <input type="text" id="cid" name="cid" value="{$user_info['cid']}" readonly>
                                                <span class="help-inline"><i style="color:red">*</i></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">有效期</label>
                                            <div class="controls">
                                                <input type="text" id="cid" name="cid" value="{$user_info['expire_time']}" readonly>
                                                <span class="help-inline"><i style="color:red">*</i></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">创建时间</label>
                                            <div class="controls">
                                                <input type="text" id="cid" name="cid" value="{$user_info['created_at']}" readonly>
                                                <span class="help-inline"><i style="color:red">*</i></span>
                                            </div>
                                        </div>



                                        <!--
                                        <div class="form-actions">
                                            <button type="button" class="btn btn-primary" id="add-submit">添加</button>
                                        </div>-->
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
            // 建立渠道卡
            $("#add-submit").click(function(){
                $("#rebateForm").submit();
            });
        </script>
    </body>
    <!-- END BODY -->
</html>
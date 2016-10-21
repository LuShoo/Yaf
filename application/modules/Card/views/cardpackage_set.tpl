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
                                <i class="icon-th-list"></i> 卡管理
                            </h3>
                            <ul style="float: left;" class="breadcrumb">
                                <li style="margin-bottom: 0px;"><a href="/admin/home/index.html"><i class="icon-home"></i></a><span class="divider">&nbsp;</span></li>
                                <li style="margin-bottom: 0px;"><a>卡管理</a><span class="divider">&nbsp;</span></li>
                                <li style="margin-bottom: 0px;"><a>修改卡套餐信息</a><span class="divider-last">&nbsp;</span></li>
                            </ul>
                            -->
                        </div>
                    </div>     
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="widget">
                                <div class="widget-title">
                                    <h4><i class="icon-reorder"></i>修改卡套餐信息</h4>
                                </div>
                                <div class="widget-body form">
                                    <form class="form-horizontal" id="orderForm" action="/card/cardinfo/set.html" method="post">
                                      <input type="hidden" name="id" id="id" value={$list['id']}>
                                      <div class="control-group">
                                            <label class="control-label">卡类型</label>
                                            <div class="controls">
                                                 <input type="text" id="uid" name="uid" value="{$list['type_name']}" disabled="disabled">
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">卡iccid</label>
                                            <div class="controls">
                                                 <input type="text" id="order_id" name="order_id" value="{$list['iccid']}" disabled="disabled">
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">订单号</label>
                                            <div class="controls">
                                                 <input type="text" id="order_name" name="order_name" value="{$list['order_id']}" disabled="disabled">
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div>
                                      <div class="control-group">
                                            <label class="control-label">手机号</label>
                                            <div class="controls">
                                                 <input type="text" id="code" name="code" value="{$list['telephone']}" disabled="disabled">
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">套餐状态</label>
                                            <div class="controls">
                                                 <input type="text" id="account" name="status" value="{if $list['status'] == 0}未激活 {elseif $list['status'] == 1}未生效 {elseif $list['status'] == 2}已生效 {/if}" disabled="disabled" >
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div>
											 <div class="control-group">
                                            <label class="control-label">套餐编码</label>
                                            <div class="controls">
                                                 <input type="text" id="pack_code" name="pack_code" value="{$list['pack_code']}" disabled="disabled" >
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div>
                                         <div class="control-group">
                                            <label class="control-label">套餐名称</label>
                                            <div class="controls">
                                                 <input type="text" id="pack_name" name="pack_name" value="{$list['pack_name']}" disabled="disabled" >
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div>
                                           <div class="control-group">
                                            <label class="control-label">套餐类型</label>
                                            <div class="controls">
                                                 <input type="text" id="pack_type" name="pack_type" value="{$list['pack_type']}" disabled="disabled">
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div>
                                           <div class="control-group">
                                            <label class="control-label">套餐售价</label>
                                            <div class="controls">
                                                 <input type="text" id="pack_price" name="pack_price" value="{$list['pack_price']}" disabled="disabled">
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div>
                                           <div class="control-group">
                                            <label class="control-label">流量值</label>
                                            <div class="controls">
                                                 <input type="text" id="pack_flow" name="pack_flow" value="{$list['pack_flow']}" disabled="disabled">
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div>
                                         <div class="control-group">
                                            <label class="control-label">套餐有效时限</label>
                                            <div class="controls">
                                                 <input type="text" id="pack_duration" name="pack_duration" value="{$list['pack_duration']}" disabled="disabled">
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div>
                                         <div class="control-group">
                                            <label class="control-label">赠送套餐编码</label>
                                            <div class="controls">
                                                 <input type="text" id="give_pack_code" name="give_pack_code" value="{$list['give_pack_code']}" disabled="disabled">
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div> 
 									<div class="control-group">
                                            <label class="control-label">赠送时限 </label>
                                            <div class="controls">
                                                 <input type="text" id="give_pack_duration" name="give_pack_duration" value="{$list['give_pack_duration']}" disabled="disabled">
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div> 
                                         <div class="control-group">
                                            <label class="control-label">是否到月清零</label>
                                            <div class="controls">
                                                 <input type="text" id="monthly_clearing" name="monthly_clearing" value="{if $list['monthly_clearing'] == 1}清零 {elseif $list['monthly_clearing'] == 2}不清零 {/if}" disabled="disabled">
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div> 
                                         <div class="control-group">
                                            <label class="control-label">生效方式</label>
                                            <div class="controls">
                                                 <input type="text" id="effective_type" name="effective_type" value="{if $list['effective_type'] == 0}未指定 {elseif $list['effective_type'] == 1}当月生效 {elseif $list['effective_type'] == 2}下月生效 {elseif $list['effective_type'] == 3}续接套餐 {/if}" disabled="disabled">
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div> 
  										<div class="control-group">
                                            <label class="control-label">生效时间 </label>
                                            <div class="controls">
                                                 <input type="text" id="effective_time" name="effective_time" value="{$list['effective_time']}" disabled="disabled">
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div> 
                                        <div class="control-group">
                                            <label class="control-label">套餐到期时间 </label>
                                            <div class="controls">
                                                 <input type="text" id="expire_time" name="expire_time" value="{$list['expire_time']}" disabled="disabled">
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div> 
                                        <div class="control-group">
                                            <label class="control-label">添加时间 </label>
                                            <div class="controls">
                                                 <input type="text" id="created_at" name="created_at" value="{$list['created_at']}" disabled="disabled">
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div> 
									  <div class="control-group">
                                            <label class="control-label">更新时间 </label>
                                            <div class="controls">
                                                 <input type="text" id="updated_at" name="updated_at" value="{$list['updated_at']}" disabled="disabled">
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div> 
                                        <div class="control-group">
                                            <label class="control-label"> </label>
                                            <div class="controls">
                                                 <div style="color: red;">{$list['typeHtml']}</div>
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div> 
                                        <div class="form-actions">
<!--                                            <button type="button" class="btn btn-primary" id="add-submit">修改</button>-->
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
               // initFormValidator();
            });
            // 建立订单
            $("#add-submit").click(function(){
                $("#orderForm").submit();
            });
        </script>
    </body>
    <!-- END BODY -->
</html>
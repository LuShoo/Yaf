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
                                <li style="margin-bottom: 0px;"><a>修改卡库存信息</a><span class="divider-last">&nbsp;</span></li>
                            </ul>
                            -->
                        </div>
                    </div>     
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="widget">
                                <div class="widget-title">
                                    <h4><i class="icon-reorder"></i>修改卡库存信息</h4>
                                </div>
                                <div class="widget-body form">
                                    <form class="form-horizontal" id="orderForm" action="/card/info/set.html" method="post">
                                      <input type="hidden" name="id" id="id" value={$list['id']}>
                                      <div class="control-group">
                                            <label class="control-label">卡类型</label>
                                            <div class="controls">
                                                 <input type="text" id="uid" name="uid" value="{$list['type_name']}" disabled="disabled">
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">流量卡唯一码</label>
                                            <div class="controls">
                                                 <input type="text" id="cid" name="cid" value="{$list['unique_id']}" disabled="disabled">
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">iccid</label>
                                            <div class="controls">
                                                 <input type="text" id="order_id" name="order_id" value="{$list['iccid']}" disabled="disabled">
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">入库批次号</label>
                                            <div class="controls">
                                                 <input type="text" id="order_name" name="order_name" value="{$list['batch']}" disabled="disabled">
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div>
                                      <div class="control-group">
                                            <label class="control-label">sim卡号</label>
                                            <div class="controls">
                                                 <input type="text" id="code" name="code" value="{$list['telephone']}" disabled="disabled">
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">套餐</label>
                                            <div class="controls">
                                                 <input type="text" id="account" name="account" value="{$list['set_meal']}" disabled="disabled" >
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div>

                                           <div class="control-group">
                                            <label class="control-label">创建时间</label>
                                            <div class="controls">
                                                 <input type="text" id="give_score" name="give_score" value="{$list['created_at']}" disabled="disabled">
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div>
                                           <div class="control-group">
                                            <label class="control-label">过期时间</label>
                                            <div class="controls">
                                                 <input type="text" id="pay_type" name="pay_type" value="{$list['expire_time']}" disabled="disabled">
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div>
                                           <div class="control-group">
                                            <label class="control-label">备注</label>
                                            <div class="controls">
                                            <textarea rows="5" cols="5" id="remarks" name="remark">{$list['remark']}</textarea>
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div>
                                               <div class="control-group">
	                                        <label class="control-label">是否出库</label>
	                                        <div class="controls">
	                                           <select  name="status" id="status">
													<option {if $list['status']==1} selected {/if} value="1">未出库</option>
													<option {if $list['status']==2} selected {/if} value="2">已出库</option>
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
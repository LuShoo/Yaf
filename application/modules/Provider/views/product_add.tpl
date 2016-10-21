<!DOCTYPE html> <!--[if IE 8]>
<html lang="en" class="ie8"> <![endif]--> <!--[if IE 9]>
<html lang="en" class="ie9"> <![endif]--> <!--[if !IE]><!-->
<html lang="en"> <!--<![endif]--> <!-- BEGIN HEAD -->
<head>
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
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i>添加产品</h4>
                        </div>
                        <div class="widget-body form">
                            <form class="form-horizontal" id="productForm" action="/provider/product/add.html"
                                  method="post">
                                <div class="control-group">
                                    <label class="control-label">卡类型</label>
                                    <div class="controls">
                                        <select style="width: 220px;" id="card_type" name="card_type">
                                            {loop $cardType $key $row}
                                                <option value={$row['id']}>{$row['name']}</option>
                                            {/loop}
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">运营商</label>
                                    <div class="controls">
                                        <select style="width: 90px;" id="provider" name="provider">
                                            <option value="CM">中国移动</option>
                                            <option value="CN">中国联通</option>
                                            <option value="CT">中国电信</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">充值编码</label>
                                    <div class="controls">
                                        <input type="text" id="code" name="code" value="">
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">套餐名称</label>
                                    <div class="controls">
                                        <input type="text" id="pack_name" name="pack_name" value="">
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">套餐类型</label>
                                    <div class="controls">
                                        <select name="pack_type" id="pack_type">
                                            <option value="1">月套餐</option>
                                            <option value="2">季度包</option>
                                            <option value="3">半年包</option>
                                            <option value="4">年包</option>
                                            <option value="5">加油包</option>
                                            <option value="0">无</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">流量值</label>
                                    <div class="controls">
                                        <input type="text" id="pack_flow" name="pack_flow"
                                               value="">
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">有效期限</label>
                                    <div class="controls">
                                        <input type="text" id="pack_duration" name="pack_duration"
                                               value="" data-original-title="注意" data-content="年/季/半年包：天；月套餐/加油包：月" data-trigger="hover" class="popovers">
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">成本价</label>
                                    <div class="controls">
                                        <input type="text" id="cost_price" name="cost_price"
                                               value="">元
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">是否清零</label>
                                    <div class="controls">
                                        <select name="monthly_clearing" id="monthly_clearing">
                                            <option value="0">否</option>
                                            <option value="1">是</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">生效方式</label>
                                    <div class="controls">
                                        <select name="effective_type" id="effective_type">
                                            <option value="0">未指定</option>
                                            <option value="1">当月生效</option>
                                            <option value="2">下月生效</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary" id="submit">添加</button>
                                    <button type="button" class="btn btn-primary" id="back">返回</button>
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
    $('#back').click(function () {
        history.back();
    });
</script>
</body>
<!-- END BODY -->
</html>
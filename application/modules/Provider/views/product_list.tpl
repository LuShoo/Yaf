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
                            <h4><i class="icon-reorder"></i>产品管理</h4>
                        </div>

                        <div class="widget-body">
                            <div class="row-fluid" style="margin-bottom: 10px;">
                                <div class="span2">
                                    <div>
                                        <label> <select id="page_rows" size="1" style="width: 60px;">
                                                <option value="10" selected="selected">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select> 条/页 </label>
                                    </div>
                                </div>

                                <div class="span10 list_search">
                                    <span id="cardType" style="width: 80px;">卡类型</span>
                                    <select style="width: 120px;" id="card_type">
                                        <option value="0" selected>全部</option>
                                        {loop $cardType $key $row}
                                            <option value={$row['id']}>{$row['name']}</option>
                                        {/loop}
                                    </select>

                                    <span id="providerSp" style="width: 80px;">运营商</span>
                                    <select style="width: 90px;" id="provider">
                                        <option value="0" selected>全部</option>
                                        <option value="CM">中国移动</option>
                                        <option value="CN">中国联通</option>
                                        <option value="CT">中国电信</option>
                                    </select>

                                    <span id="packType" style="width: 80px;">套餐类型</span>
                                    <select style="width: 80px;" id="pack_type">
                                        <option value="0" selected>全部</option>
                                        <option value="1">月套餐</option>
                                        <option value="2">季度包</option>
                                        <option value="3">半年包</option>
                                        <option value="4">年包</option>
                                        <option value="5">加油包</option>
                                    </select>

                                    <span id="activeType" style="width: 80px;">生效方式</span>
                                    <select style="width: 90px;" id="effective_type">
                                        <option value="0" selected>全部</option>
                                        <option value="1">未指定</option>
                                        <option value="2">当月生效</option>
                                        <option value="3">下月生效</option>
                                    </select>&nbsp;&nbsp;

                                    <a id="search-btn" class="btn btn-primary" alt="搜 索" title="搜 索"
                                       href="javascript:void(0);">搜 索</a>

                                    <div id="nestable_list_menu" class="margin-bottom-10 pull-right">
                                        {if $_SESSION['user_info']['user_id'] == 1}
                                            <a href="/provider/product/addView.html" title="添加" alt="添加"
                                               class="btn btn-primary" id="add">添加</a>
                                        {/if}
                                        &nbsp;&nbsp;
                                        <a href="javascript:void(0);" title="导出" alt="导出"
                                           class="btn btn-primary" id="exportData">导出</a>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <!-- <th>ID</th>-->
                                    <th>卡类型</th>
                                    <th>运营商</th>
                                    <th>套餐编码</th>
                                    <th>套餐名称</th>
                                    <th>套餐类型</th>
                                    <th>流量值</th>
                                    <th>有效时限</th>
                                    <th>成本价</th>
                                    <th>是否清零</th>
                                    <th>生效方式</th>
                                    <th>操作时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody id="list-data">
                                </tbody>
                            </table>
                            <div class="box-content list-loading" style="vertical-align: middle; text-align: center;">
                                Loading <img title="img/Fancy pants.gif"
                                             src="<!--{STATIC_SERVER}-->/img/Fancy pants.gif">
                            </div>
                            <div class="row-fluid">
                                <div class="span8 center">
                                    <div id="vpage"
                                         class=" paging_bootstrap pagination"></div>
                                </div>
                                <div class="span4" style="text-align: right; line-height: 40px;">
                                    <div class="dataTables_info" id="DataTables_Table_0_info">
                                        共计 <span id="vpage-max-page">0</span> 页，<span
                                                id="vpage-total">0</span> 条记录
                                    </div>
                                </div>
                            </div>
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
<script type="text/javascript" src="/static/js/jquery_vpage.js?v={STATIC_VERSION}"></script>
<script type="text/javascript" src="/static/js/div.js?v={STATIC_VERSION}"></script>
<script type="text/javascript" src="/static/js/layer/layer.js"></script>
<script>
    jQuery(document).ready(function () {
        // initiate layout and plugins
        App.init();
        UIJQueryUI.init();

    });
    $(function () {
        $.vpage({
            'uri': '/provider/product/getList.html'
        });

        //点击搜索
        $("#search-btn").click(function (e) {
            var card_type = $("#card_type option:selected").val();
            var provider = $("#provider option:selected").val();
            var pack_type = $("#pack_type option:selected").val();
            var effective_type = $("#effective_type option:selected").val();
            $.vpage({
                'uri': '/provider/product/getList.html',
                'query': "&card_type=" + card_type + "&provider=" + provider + "&pack_type=" + pack_type + "&effective_type=" + effective_type
            });
        });
        $(document).keydown(function (event) {
            if (event.keyCode == 13) {
                $('#search-btn').click();
            }
        });
    });

    //导出
    $('#exportData').click(function () {
        var card_type = $("#card_type option:selected").val();
        var provider = $("#provider option:selected").val();
        var pack_type = $("#pack_type option:selected").val();
        var effective_type = $("#effective_type option:selected").val();

        var url = '/provider/product/DataToExcel.html?card_type=' + card_type + '&provider=' + provider + '&pack_type=' + pack_type + '&effective_type=' + effective_type;
        window.open(url);
    });
</script>
</body>
<!-- END BODY -->
</html>
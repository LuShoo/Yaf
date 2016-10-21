<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8">
<![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9">
<![endif]-->
<!--[if !IE]>
<html lang="en">
<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>用户信息 - 销售管理平台</title>
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
                        <i class="icon-cogs"></i> <span class="settings"> <span
                                    class="text">Theme:</span> <span class="colors"> <span
                                        class="color-default" data-style="default"></span> <span
                                        class="color-gray" data-style="gray"></span> <span
                                        class="color-purple" data-style="purple"></span> <span
                                        class="color-navy-blue" data-style="navy-blue"></span> </span>
							</span>
                    </div>
                    {include ../../Admin/views/breadcrumb.tpl}
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget">
                        <div class="widget-title">
                            <h4>
                                <i class="icon-reorder"></i>用户信息
                            </h4>
                        </div>
                        <div class="widget-body">
                            <div class="row-fluid" style="margin-bottom: 10px;">
                                <div class="span1">
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
                                    <span id="uidSp" style="width: 80px;">账号ID</span>
                                    <input type="text" id="uid" placeholder="请输入账号ID" default_val="" value=""/>

                                    <span id="nickSp" style="width: 80px;">微信昵称</span>
                                    <input type="text" id="nick_name" placeholder="请输入微信昵称" default_val="" value=""/>

                                    <span id="phoneSp" style="width: 80px;">手机号</span>
                                    <input type="text" id="telephone" placeholder="请输入手机号" default_val="" value=""/>
                                    <!--
                                    <span id="statusSp" style="width: 80px;">是否实名</span>
                                    <select id="status" name="status" style="width: 80px;">
                                        <option value=""></option>
                                        <option value="1">已实名</option>
                                        <option value="0">未实名</option>
                                    </select>
                                    -->
                                    <a id="search-btn" class="btn btn-primary" alt="搜 索" title="搜 索"
                                       href="javascript:void(0);">搜 索</a>
                                </div>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>序号</th>
                                    <th>账号ID</th>
                                    <th>微信昵称</th>
                                    <th>手机号</th>
                                    <!--
                                    <th>是否实名</th>
                                    -->
                                    <th>牛币</th>
                                    <th>流量卡</th>
                                </tr>
                                </thead>
                                <tbody id="list-data">
                                </tbody>
                            </table>
                            <div class="box-content list-loading"
                                 style="vertical-align: middle; text-align: center;">
                                Loading <img title="/static/img/Fancy pants.gif"
                                             src="/static/img/Fancy pants.gif">
                            </div>
                            <div class="row-fluid">
                                <div class="span8 center">
                                    <div id="vpage" class=" paging_bootstrap pagination"></div>
                                </div>
                                <div class="span4" style="text-align: right; line-height: 40px;">
                                    <div class="dataTables_info" id="DataTables_Table_0_info">
                                        共计 <span id="vpage-max-page">0</span> 页，<span id="vpage-total">0</span>
                                        条记录
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{include ../../Admin/views/footer.tpl}
<script type="text/javascript" src="/static/js/jquery_vpage.js"></script>
<script type="text/javascript" src="/static/js/layer/layer.js"></script>
<script>
    jQuery(document).ready(function () {
        App.init();
        UIJQueryUI.init();
    });
    $(function () {
        $.vpage({
            'uri': '/custom/customer/getList.html'
        });
        var _uid = $('#uid');
        var _nick_name = $('#nick_name');
        var _status = $('#status');
        var _telephone = $('#telephone');
        var _list = [_uid, _nick_name, _telephone, _status];
        //循环绑定事件
        $.each(_list, function (k, v) {
            $(v).focus(function () {
                this.value = ''
            }).blur(function () {
                if (this.value == '') {
                    this.value = $(this).attr('default_val')
                }
            });
        });
        //点击搜索
        $("#search-btn").click(function (e) {
            var uid = (_uid.val() == _uid.attr('default_val')) ? '' : _uid.val();
            var nick_name = (_nick_name.val() == _nick_name.attr('default_val')) ? '' : _nick_name.val();
            var telephone = (_telephone.val() == _telephone.attr('default_val')) ? '' : _telephone.val();
            var status = (_status.val() == _status.attr('default_val')) ? '' : _status.val();
            $.vpage({
                'uri': '/custom/customer/getList.html',
                'query': "&uid=" + uid + "&nick_name=" + nick_name + "&telephone=" + telephone + "&status=" + status
            });
        });
        $(document).keydown(function (event) {
            if (event.keyCode == 13) {
                $('#search-btn').click();
            }
        });
    });

    /**
     * 查看积分详情
     * @param id        用户ID
     */
    function viewScoreDetail(id) {
        layer.open({
            type: 2,
            title: '积分记录',
            shadeClose: true,
            shade: 0.6,
            area: ['60%', '60%'],
            skin: 'layui-layer-molv',
            closeBtn: '2',
            content: '/custom/customer/getScoreDetail.html?id=' + id
        });
    }

    /**
     * 查看卡详情
     * @param id        用户ID
     */
    function viewCardDetail(id) {
        layer.open({
            type: 2,
            title: '流量卡',
            shadeClose: true,
            shade: 0.6,
            area: ['60%', '60%'],
            skin: 'layui-layer-molv',
            closeBtn: '2',
            content: '/custom/customer/getCardDetail.html?id=' + id
        });
    }
</script>
</body>
</html>

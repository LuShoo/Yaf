<!DOCTYPE html> <!--[if IE 8]>
<html lang="en" class="ie8"> <![endif]--> <!--[if IE 9]>
<html lang="en" class="ie9"> <![endif]--> <!--[if !IE]><!-->
<html lang="en"> <!--<![endif]--> <!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>用户管理 - 销售管理平台</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    {include ../../Admin/views/top.tpl}
    <link rel="stylesheet" href="/static/css/layer_css.css">
    <style>
        .form-control {
            width: 120px;
        }

        .td {
            border: 1px solid lightgray;
        }
    </style>
</head>
<body>
<div id="container" class="row-fluid">
    <div id="main-content">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <h2 style="margin-top: 10px">用户信息</h2>
                    <div style="text-align: center">
                        <table class="table-bordered table-condensed" style="margin: auto;">
                            <tr>
                                <td class="td">
                                    <label class="control-label">账号ID</label>
                                </td>
                                <td class="td">
                                    <input class="form-control" type="text" value="{$list['id']}" readonly>
                                </td>
                                <td class="td" style="width: 60px;">
                                    <label class="control-label">微信昵称</label>
                                </td>
                                <td class="td">
                                    <input class="form-control" type="text" value="{$list['nick_name']}" readonly>
                                </td>
                                <td class="td">
                                    <label class="control-label">手机号</label>
                                </td>
                                <td class="td">
                                    <input class="form-control" type="text" value="{$list['mobil']}" readonly>
                                </td>
                                <!--
                            <td class="td">
                                <label class="control-label">身份证号</label>
                            </td>
                            <td class="td">
                                <input class="form-control" type="text" value="{$list['real_nric']}" readonly>
                            </td>
                            <td class="td">
                                <label class="control-label">结算金额</label>
                            </td>
                            <td class="td">
                                <input class="form-control" type="text" value="{$list['amount']}" readonly>
                            </td>
                            -->
                            </tr>
                            <br>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget">
                        <div class="widget-title">
                            <h4>
                                <i class="icon-reorder"></i>充值记录
                            </h4>
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
                                <div class="span8 list_search">
                                    <input alt="开始时间" title="开始时间" value="开始时间"
                                           default_val="开始时间" class="m-wrap" size="10" type="text"
                                           value="" id="ui_date_picker_from"/>
                                    <input alt="结束时间"
                                           title="结束时间" value="结束时间"
                                           default_val="结束时间" class="m-wrap"
                                           size="10" type="text" value=""
                                           id="ui_date_picker_to"/>
                                    <a id="search-btn" class="btn btn-primary" alt="搜 索" title="搜 索"
                                       href="javascript:void(0);">搜 索</a>
                                </div>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>时间</th>
                                    <th>摘要</th>
                                    <th>牛币</th>
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
{include layer_footer.tpl}
<script type="text/javascript" src="/static/js/jquery_vpage.js"></script>
<script>
    jQuery(document).ready(function () {
        App.init();
        UIJQueryUI.init();
    });
    $(function () {
        var uid = {$id};
        $.vpage({
            'uri': '/custom/customer/getScoreList.html',
            'query': '&id=' + uid
        });

        var _start_time = $('#ui_date_picker_from');
        var _end_time = $('#ui_date_picker_to');
        var _list = [_start_time, _end_time];
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
            var start_time = (_start_time.val() == _start_time.attr('default_val')) ? '' : _start_time.val();
            var end_time = (_end_time.val() == _end_time.attr('default_val')) ? '' : _end_time.val();
            $.vpage({
                'uri': '/custom/customer/getScoreList.html',
                'query': "&start_time=" + start_time + "&end_time=" + end_time + "&id=" + uid
            });
        });
        $(document).keydown(function (event) {
            if (event.keyCode == 13) {
                $('#search-btn').click();
            }
        });

    });
</script>
</body>
</html>

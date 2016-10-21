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

                    <div class="row-fluid" style="margin-top:10px; width: 30%; float:right;;margin-right: 20px;">
                        <div class="span12">
                            <div id="nestable_list_menu" class="margin-bottom-10 pull-right">
                                <!--<a href="/admin/channelcard/addview.html" data-action="expand-all" class="btn btn-info" type="button">添加渠道卡</a>-->
                                <a href="javascript:void(0);" title="导入新建卡分配" alt="导入新建卡分配"
                                   class="btn btn-primary" id="fileInput">渠道卡分配</a>

                                <a href="javascript:void(0);" title="导入修改卡分配" alt="导入修改卡分配"
                                   class="btn btn-primary" id="fileInput_edit">渠道卡转移</a>

                            </div>
                        </div>
                    </div>
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
                            <h4><i class="icon-reorder"></i>渠道卡列表</h4>
                        </div>
                        <!-- 上传文件的弹框start -->
                        <div id="myModal" class="modal hide fade in dialog-upload-card"
                             style="display: none;">
                            <div class="modal-header">
                                <button id="close-btn" data-dismiss="modal" class="close"
                                        type="button">×
                                </button>
                                <h3>渠道卡分配</h3>
                            </div>
                            <iframe id="form-iframe" name="upload-form-iframe"
                                    style="display: none;"></iframe>
                            <div class="modal-body" style="text-align: center;">
                                <div id="uniform-fileInput">
                                    <form target="upload-form-iframe" id="upload-form"
                                          action="/admin/channelcardnew/importDataFromExcel.html" method="post"
                                          enctype="multipart/form-data">
                                        <div>
                                            <input id="file" type="file" name="file-name"
                                                   class="input-file uniform_on" size="19">
                                        </div>
                                    </form>
                                    <a href="{STATIC_SERVER}/templ/channel_card.xls">点击下载导入模版</a>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a id="cancel-upload" class="btn" href="javascript:void(0);">取消</a>
                                <a id="start-upload" class="btn btn-primary"
                                   href="javascript:void(0);">导入</a>
                            </div>
                        </div>
                        <!-- 上传文件的弹框end -->


                        <!-- 上传修改文件的弹框start -->
                        <div id="myModal_edit" class="modal hide fade in dialog-upload-card"
                             style="display: none;">
                            <div class="modal-header">
                                <button id="close-btn_edit" data-dismiss="modal" class="close"
                                        type="button">×
                                </button>
                                <h3>渠道卡转移</h3>
                            </div>
                            <iframe id="form-iframe" name="upload-form-iframe"
                                    style="display: none;"></iframe>
                            <div class="modal-body" style="text-align: center;">
                                <div id="uniform-fileInput">
                                    <form target="upload-form-iframe" id="upload-form_edit"
                                          action="/admin/channelcardnew/editDataFromExcel.html" method="post"
                                          enctype="multipart/form-data">
                                        <div>
                                            <input id="file_edit" type="file" name="file-name"
                                                   class="input-file uniform_on" size="19">
                                        </div>
                                    </form>
                                    <a href="{STATIC_SERVER}/templ/channel_card_edit.xls">点击下载导入模版</a>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a id="cancel-upload_edit" class="btn" href="javascript:void(0);">取消</a>
                                <a id="start-upload_edit" class="btn btn-primary"
                                   href="javascript:void(0);">导入</a>
                            </div>
                        </div>
                        <!-- 上传文件的弹框end -->


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
                                    <input value="iccid" type="text" id="iccid"
                                           default_val="iccid" style="width:150px;">

                                    <input value="渠道号" type="text" id="cid"
                                           default_val="渠道号" style="width:80px;">


                                    &nbsp;&nbsp;激活状态：<select style="width: 60px;" id="is_active">
                                        <option value="0">全部</option>
                                        <option value="1">未激活</option>
                                        <option value="2">已激活</option>
                                    </select>

                                    &nbsp;&nbsp;绑定状态：<select style="width: 60px;" id="is_binding">
                                        <option value="0">全部</option>
                                        <option value="1">未绑定</option>
                                        <option value="2">已绑定</option>
                                    </select>&nbsp;&nbsp;

                                    &nbsp;&nbsp;充值状态：<select style="width: 60px;" id="is_recharge">
                                        <option value="0">全部</option>
                                        <option value="1">未充值</option>
                                        <option value="2">已充值</option>
                                    </select>&nbsp;&nbsp;

                                    <a id="search-btn" class="btn btn-primary" alt="搜 索" title="搜 索"
                                       href="javascript:void(0);">搜 索</a>

                                    <div id="nestable_list_menu" class="margin-bottom-10 pull-right">
                                        <a href="javascript:void(0);" title="导出" alt="导出"
                                           class="btn btn-primary" id="exportData">导出</a>
                                    </div>
                                </div>

                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <!-- <th>ID</th>-->
                                    <th>iccid</th>
                                    <th>流量卡类型</th>
                                    <th>手机号</th>
                                    <th>出库批次号&nbsp;<img id="batch_img" src="/static/img/help.jpg"
                                                        style="width:15px;height:15px;"/></th>
                                    <th>SIM卡激活状态</th>
                                    <th>店员绑定状态</th>
                                    <th>充值状态</th>
                                    <th>渠道号</th>
                                    <th>渠道商</th>
                                    <th>有效期</th>
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
            'uri': '/admin/channelcardnew/getlist.html'
        });
        var _iccid = $("#iccid");
        var _cid = $("#cid");

        //var _is_active = $("#is_active");
        // var _is_binding = $("#is_binding");

        var _list = [_iccid, _cid];
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
            var iccid = (_iccid.val() == _iccid.attr('default_val')) ? '' : _iccid.val();
            var cid = (_cid.val() == _cid.attr('default_val')) ? '' : _cid.val();

            var is_active = $('#is_active').val();
            var is_binding = $('#is_binding').val();
            var is_recharge = $('#is_recharge').val();

            $.vpage({
                'uri': '/admin/channelcardnew/getlist.html',
                'query': "&iccid=" + iccid + "&cid=" + cid + "&is_active=" + is_active + '&is_binding=' + is_binding + "&is_recharge=" + is_recharge
            });
        });

        $('#exportData').click(function () {

            var iccid = (_iccid.val() == _iccid.attr('default_val')) ? '' : _iccid.val();
            var cid = (_cid.val() == _cid.attr('default_val')) ? '' : _cid.val();

            var is_active = $('#is_active').val();
            var is_binding = $('#is_binding').val();
            var is_recharge = $('#is_recharge').val();


            window.open("/admin/channelcardnew/exportData.html?iccid=" + iccid + "&cid=" + cid + "&is_active=" + is_active + '&is_binding=' + is_binding + "&is_recharge=" + is_recharge);

        });


        $('#fileInput').click(function () {
            $('#myModal').show();
        });
        $('#cancel-upload,#close-btn').click(function () {
            $('#myModal').hide();
        });
        $('#start-upload').click(function () {
            if ($('#file').val() == '') {
                alert('请选择要上传的文件');
                return false;
            }
            layer.load(0, {shade: [0.8, '#393D49']});
            $('#upload-form').submit();
        });


        //导入修改弹窗系列

        $('#fileInput_edit').click(function () {
            $('#myModal_edit').show();
        });
        $('#cancel-upload_edit,#close-btn_edit').click(function () {
            $('#myModal_edit').hide();
        });
        $('#start-upload_edit').click(function () {
            if ($('#file_edit').val() == '') {
                alert('请选择要上传的文件');
                return false;
            }

            layer.load(0, {shade: [0.8, '#393D49']});
            $('#upload-form_edit').submit();
        });

    });
    function delConfig(id) {
        $.delDiv({
            title: '删除配置',					//标题
            content: '你确定要删除此配置吗？',	//内容框
            data: {												//数据
                id: id
            },
            type: 'post',
            url: '/admin/channelcardnew/delConfig.html',		//回调url
            returnUrl: '/admin/channelcardnew/index.html'		//删除成功后跳转的url
        });
    }

    function alertResult(data) {
        layer.closeAll();
        var jsonData = $.parseJSON(data);
        if (jsonData.code == 200) {
            alert(jsonData.countMsg);
            window.location.href = "/admin/channelcardnew/index.html";
        } else if (jsonData.code == 0) {
            alert("导入失败," + jsonData.msg);
        } else {
            var html = '<br/>';
            html += jsonData.countMsg;
            html += '<br/>';
            html += '<br/>';
            $.each(jsonData.msg, function (k, v) {
                html += v.msg + '<br/>';
            });

            //页面层
            layer.open({
                type: 1,
                skin: 'layui-layer-rim', //加上边框
                area: ['600px', '240px'], //宽高
                content: html
            });
        }
    }

    $('#batch_img').mouseover(function () {
        layer.closeAll();
        var that = this;
        layer.tips('出库批次号命名规则-样例说明：<br/>批次号：03-20160509-24G-A-ZC <br/>03:广东动力100卡类型号<br/>20160509：导入时间<br/>24G：套餐大小<br/>A：包年套餐（B：季度套餐  C：月卡套餐）<br/>ZC：北京中创佳联（渠道商简称首字母）', that,{time:20000});
    }).mouseout(function () {
        layer.closeAll();

    });


</script>
</body>
<!-- END BODY -->
</html>
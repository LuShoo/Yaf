<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
  <meta charset="utf-8" />
  <title>经销商列表</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" /> {include ../../Admin/views/top.tpl}
</head>

<body class="fixed-top">
  {include ../../Admin/views/header.tpl}
  <div id="container" class="row-fluid">
    {include ../../Admin/views/menu.tpl}
    <div id="main-content">
      <!-- BEGIN PAGE CONTAINER-->
      <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
          <div class="span12">
            <!-- BEGIN THEME CUSTOMIZER-->
            <div id="theme-change" class="hidden-phone">
              <i class="icon-cogs"></i> <span class="settings"> <span
								class="text">Theme:</span> <span class="colors"> <span
									class="color-default" data-style="default"></span> <span class="color-gray" data-style="gray"></span> <span class="color-purple" data-style="purple"></span> <span class="color-navy-blue" data-style="navy-blue"></span> </span>
              </span>
            </div>
          </div>
          <div id="myModal" class="modal hide fade in dialog-upload-card" style="display: none;">
            <div class="modal-header">
              <button id="close-btn" data-dismiss="modal" class="close" type="button">×</button>
              <h3>提示</h3>
            </div>
            <iframe id="form-iframe" name="upload-form-iframe" style="display: none;"></iframe>
            <div class="modal-body" style="text-align: center;">
              <div id="uniform-delApp">
                <h4>确定删除吗?</h4>
              </div>
            </div>
            <div class="modal-footer">
              <a id="cancel-del" class="btn" href="javascript:void(0);">取消</a>
              <a id="start-del" class="btn btn-primary" href="javascript:void(0);">确定</a>
            </div>
          </div>
          <div class="row-fluid">
            <div class="span12">
              <!-- BEGIN BORDERED TABLE widget-->
              <div class="widget">
                <div class="widget-title">
                  <h4>
									<i class="icon-reorder"></i>经销商列表
								</h4>
                </div>
                <div class="widget-body">

                  <a href="/push/app/addApp.html" data-action="expand-all" class="btn btn-info" type="button">添加经销商</a><br/><br>

                  <div class="control-group form-horizontal search">
                    <div class="row-fluid">
                      <div class="span2" style="width: 90px">
                        <label>
                          <select id="page_rows" style="width: 56px;">
                            <option value="10" selected="selected">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                          </select> 条/页 </label>
                      </div>
                      <div class="span8">
                        <input style="width: 100px;" style="color:#999999;" type="text" id="partnerid" name="partnerid" alt="商户ID" title="商户ID" value="商户ID" default_val="商户ID" />
                        <input style="width: 100px;" style="color:#999999;" type="text" id="app_key" name="app_key" alt="app_key" title="app_key" value="app_key" default_val="app_key" />
                        时间:
                        <input class="datepicker" style="width: 130px;"  id="ui_date_picker_from" value="创建开始时间" default_val="创建开始时间" style="color:#999999;" type="text">
                        <input class="datepicker" style="width: 130px;"  id="ui_date_picker_to" value="创建结束时间" default_val="创建结束时间" style="color:#999999;" type="text">

                      </div>
                      <div class="span2">
                        <a id="search-btn" class="btn btn-primary" style="margin-left: 10px;" href="javascript:void(0);">搜 索</a>
                      </div>
                    </div>
                  </div>
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>经销商ID</th>
                        <th>App-key</th>
                        <th>App-key秘钥</th>
                        <th>状态标识</th>
                        <th>创建日期</th>
                        <th>更新日期</th>
                        <th>操作</th>
                      </tr>
                    </thead>
                    <tbody id="list-data">
                    </tbody>
                  </table>
                  <div class="box-content list-loading" style="vertical-align: middle; text-align: center;">
                    Loading <img title="img/Fancy pants.gif" src="<!--{STATIC_SERVER}-->/img/Fancy pants.gif">
                  </div>
                  <div class="row-fluid">
                    <div class="span8 center">
                      <div id="vpage" class=" paging_bootstrap pagination"></div>
                    </div>
                    <div class="span4" style="text-align: right; line-height: 40px;">
                      <div class="dataTables_info" id="DataTables_Table_0_info">
                        共计 <span id="vpage-max-page">0</span> 页，<span id="vpage-total">0</span> 条记录
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
    <script type="text/javascript" src="/static/js/jquery_vpage.js?v={STATIC_VERSION}"></script>
    <script>
      jQuery(document).ready(function() {
        App.init();
        UIJQueryUI.init();
      });
      $(function() {
        $.vpage({
          'uri': '/push/app/getAppList.html'
        });
        //搜索
        var _partnerid = $("#partnerid");
        var _app_key = $("#app_key");
        var _startTime = $("#ui_date_picker_from");
        var _endTime = $("#ui_date_picker_to");

        var _list = [_partnerid, _app_key, _startTime, _endTime];
        //循环绑定事件
        $.each(_list, function(k, v) {
            $(v).focus(function() {
                this.value = ''
            }).blur(function() {
                if (this.value == '') {
                    this.value = $(this).attr('default_val')
                }
            });
        });
        //点击搜索
        $("#search-btn").click(function(e) {
          var partnerid = (_partnerid.val()==_partnerid.attr('default_val')) ? '' : _partnerid.val();
          var app_key = (_app_key.val()==_app_key.attr('default_val')) ? '' : _app_key.val();
          var startTime = (_startTime.val()==_startTime.attr('default_val')) ? '' : _startTime.val();
          var endTime = (_endTime.val()==_endTime.attr('default_val')) ? '' : _endTime.val()+' 23:59:59';
          $.vpage({
            'uri': '/push/app/getAppList.html',
              'query': "partnerid="+partnerid+"&app_key="+app_key+"&start_time="+startTime+"&end_time="+endTime
          });
        });

        $('.delapp').click(function() {
          $('.dialog-upload-card').show();
          mid = $(this).attr('data-id')
        });
        $('#cancel-del,#close-btn').click(function() {
          $('.dialog-upload-card').hide();
        });
        $('#start-del').click(function() {
          var data = {
            'id': mid
          };
          $.post('/push/app/delApp.html', data, function(r) {
            if (r.detail == 'ok') {
              $('.dialog-upload-card').hide();
              alert("操作成功。");
              location.href = '/push/app/index.html';
            } else {
              alert("失败");
            }
          }, 'json');
        });

      });


    </script>
</body>
<!-- END BODY -->

</html>

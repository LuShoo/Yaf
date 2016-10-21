<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
  <meta charset="utf-8" />
  <title>消息列表</title>
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
              <div id="uniform-checkMsg">
                <h4>确定删除吗?</h4>
              </div>
            </div>
            <div class="modal-footer">
              <a id="cancel-check" class="btn" href="javascript:void(0);">取消</a>
              <a id="start-check" class="btn btn-primary" href="javascript:void(0);">确定</a>
            </div>
          </div>
		  
		  
		  
          <div class="row-fluid">
            <div class="span12">
              <!-- BEGIN BORDERED TABLE widget-->
              <div class="widget">
                <div class="widget-title">
                  <h4>
									<i class="icon-reorder"></i>坏词列表
								</h4>
                </div>
                <div class="widget-body">

                  <a href="/push/badword/addMsg.html" data-action="expand-all" class="btn btn-info" type="button">添加坏词</a><br/><br>
				   

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
                        <input style="width: 100px;" style="color:#999999;" type="text" id="badword" name="badword" alt="商户ID" title="商户ID" value="坏词" default_val="坏词" />
                       
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
                        <th style="text-align:center">ID</th>
                        <th style="text-align:center">坏词</th>
                        <th style="text-align:center">创建者</th>
                        <th style="text-align:center">创建时间</th>
                        <th style="text-align:center">操作</th>
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
          'uri': '/push/badword/getMsgList.html'
        });
        //搜索
        var _badword = $("#badword");
        var _msg_title = $("#msg_title");
        var _status = $("#status");
        var _startTime = $("#ui_date_picker_from");
        var _endTime = $("#ui_date_picker_to");

        var _list = [_badword,_msg_title, _status,_startTime,_endTime];
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
          var badword = (_badword.val()==_badword.attr('default_val')) ? '' : _badword.val();
          var msg_title = (_msg_title.val()==_msg_title.attr('default_val')) ? '' : _msg_title.val();
          var status = (_status.val()==_status.attr('default_val')) ? '' : _status.val();
          var startTime = (_startTime.val()==_startTime.attr('default_val')) ? '' : _startTime.val();
          var endTime = (_endTime.val()==_endTime.attr('default_val')) ? '' : _endTime.val()+' 23:59:59';
          $.vpage({
            'uri': '/push/badword/getMsgList.html',
              'query': "badword="+badword+"&msg_title="+msg_title+"&status="+status+"&start_time="+startTime+"&end_time="+endTime
          });
        });

		
		
		
		//弹出提示框
        $('.deletebadword').click(function() {
          $('.dialog-upload-card').show();
          mid = $(this).attr('data-id')
        });
		
		//点击确定
		$('#start-check').click(function() {
          var data = {
            'id': mid
          };
          $.post('/push/badword/deleteMsg.html', data, function(r) {
            if (r.detail == 'ok') {
              $('.dialog-upload-card').hide();
					alert("操作成功。");
              location.href = '/push/badword/index.html';
            } else {
              alert("删除失败");
            }
          }, 'json');
        });
		
		//关闭提示窗
        $('#cancel-check,#close-btn').click(function() {
          $('.dialog-upload-card').hide();
        });
       
	   
	   
	   
      });

      
    </script>
</body>
<!-- END BODY -->

</html>

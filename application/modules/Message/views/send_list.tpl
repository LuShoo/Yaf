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
                <h4>确定发送吗?</h4>
              </div>
            </div>
            <div class="modal-footer">
              <a id="cancel-send" class="btn" href="javascript:void(0);">取消</a>
              <a id="start-send" class="btn btn-primary" href="javascript:void(0);">确定</a>
            </div>
          </div>
		  
		   <div id="myModaly" class="modal hide fade in dialog-upload-cardy" style="display: none;">
            <div class="modal-header">
              <button id="close-btny" data-dismiss="modal" class="close" type="button">×</button>
              <h3>提示</h3>
            </div>
            <iframe id="form-iframe" name="upload-form-iframe" style="display: none;"></iframe>
            <div class="modal-body" style="text-align: center;">
              <div id="uniform-checkMsg">
					<form>
						请输入imei:<input id="imei" type="text" name="imei" />
					</form>
              </div>
            </div>
            <div class="modal-footer">
              <a id="cancel-sendy" class="btn" href="javascript:void(0);">取消</a>
              <a id="start-sendy" class="btn btn-primary" href="javascript:void(0);">确定</a>
            </div>
          </div>
		  
		  
		  
          <div class="row-fluid">
            <div class="span12">
              <!-- BEGIN BORDERED TABLE widget-->
              <div class="widget">
                <div class="widget-title">
                  <h4>
									<i class="icon-reorder"></i>消息列表
								</h4>
                </div>
                <div class="widget-body">
                  <div class="control-group form-horizontal search">
                    <div class="row-fluid">
                      <div class="span2" style="width: 100px">
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
                        <input style="width: 100px;" style="color:#999999;" type="text" id="msg_title" name="msg_title" alt="标题" title="标题" value="标题" default_val="标题" />
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
                        <th>合作商户ID</th>
                        <th>消息标题</th>
                        <th>消息内容</th>
                        <th>消息类别</th>
                        <th>即时发送</th>
                        <th>创建时间</th>
                        <th>审核状态</th>
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
          'uri': '/message/message/getSendList.html'
        });
        //搜索
        var _partnerid = $("#partnerid");
        var _msg_title = $("#msg_title");
        var _status = $("#status");
        var _startTime = $("#ui_date_picker_from");
        var _endTime = $("#ui_date_picker_to");

        var _list = [_partnerid,_msg_title, _status,_startTime,_endTime];
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
          var msg_title = (_msg_title.val()==_msg_title.attr('default_val')) ? '' : _msg_title.val();
          var status = (_status.val()==_status.attr('default_val')) ? '' : _status.val();
          var startTime = (_startTime.val()==_startTime.attr('default_val')) ? '' : _startTime.val();
          var endTime = (_endTime.val()==_endTime.attr('default_val')) ? '' : _endTime.val()+' 23:59:59';
          $.vpage({
            'uri': '/message/message/getCheckList.html',
              'query': "partnerid="+partnerid+"&msg_title="+msg_title+"&status="+status+"&start_time="+startTime+"&end_time="+endTime
          });
        });
       
        $('.sendMsg').click(function() {
          $('.dialog-upload-card').show();
          mid = $(this).attr('data-id');
        });
		//预览
		$('.sendMsgy').click(function() {
          $('.dialog-upload-cardy').show();
          mid = $(this).attr('datay-id');
        });
		$('#start-sendy').click(function() {
			var imei=$("#imei").val();
			  var data = {
				'id': mid,
				'imeis':imei
			  };
          $.post('/message/message/sendMsgy.html', data, function(r) {
            if (r.detail == 'ok') {
              $('.dialog-upload-cardy').hide();
              var data1 = {
                'partnerid':r.message.partnerid,
                'imeis':r.message.imeis,
                'send_type':1,
                'msg_title':r.message.msg_title,
                'msg_type':r.message.msg_type,
                'msg_data':r.message.msg_data,
                'send_scope':2,
                'tags':r.message.tags,
                'release':r.message.release,
                'expire_time':r.message.expire_time,
                'is_immediate':r.message.is_immediate,
                'service':r.message.server,
                'sign':r.message.sign,
				'callerid':r.message.callerid
                };
                $.post('/message/message/sendto.html/',data1,function(f){
                  if(f.code == 1){
                    alert(f.message);
                    location.href = '/message/message/send.html';
                  }else{
					alert('失败');
				  }
                  
                },'json');
            } else {
              $('.dialog-upload-cardy').hide();
              alert(r.detail);
            }
          }, 'json');
        });
		
		//重发
		$('.sendMsgr').click(function() {
			//alert('1111111');
			mid = $(this).attr('datas-id');
			var data = {
				'id': mid
			};
			$.post('/message/message/sendMsgr.html', data, function(r) {
				if(r.code==0){
					alert('消息重发成功');
				}else{
					alert('消息重发失败');
				}
			},'json');
        });
		
		
		
		//fas发送
        $('#cancel-send,#close-btn').click(function() {
          $('.dialog-upload-card').hide();
        });
		 $('#cancel-sendy,#close-btny').click(function() {
          $('.dialog-upload-cardy').hide();
        });
		
        $('#start-send').click(function() {
          var data = {
            'id': mid
          };
          $.post('/message/message/sendMsg.html', data, function(r) {
            if (r.detail == 'ok') {
              $('.dialog-upload-card').hide();
              var data1 = {
                'partnerid':r.message.partnerid,
                'imeis':r.message.imeis,
                'send_type':0,
                'msg_title':r.message.msg_title,
                'msg_type':r.message.msg_type,
                'msg_data':r.message.msg_data,
                'send_scope':r.message.send_scope,
                'tags':r.message.tags,
                'release':r.message.release,
                'expire_time':r.message.expire_time,
                'is_immediate':r.message.is_immediate,
                'service':r.message.server,
                'sign':r.message.sign,
				'callerid':r.message.callerid
                };
                $.post('/message/message/sendto.html/',data1,function(f){
                  if(f.code == 1){
                    alert(f.message);
                    location.href = '/message/message/send.html';
                  }else{
					alert('失败');
				  }
                  
                },'json');
            } else {
              $('.dialog-upload-card').hide();
              alert(r.detail);
            }
          }, 'json');
        });
      });
    </script>
</body>
<!-- END BODY -->

</html>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
  <meta charset="utf-8" />
  <title>showboom - 销售管理平台</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
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

            <!--
                        <h3 class="page-title">
                            系统管理 <small>{$title}</small>
                        </h3>-->
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
                <h4><i class="icon-reorder"></i>{$title}</h4>
              </div>
              <div class="widget-body form">
                <!-- BEGIN FORM-->
                <form class="form-horizontal">
				<div class="control-group">
                    <label class="control-label">经销商名称</label>
                    <div class="controls">
                      <input type="text" name="name" value="{$appInfo['name']}" class="span6  popovers">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">经销商ID</label>
                    <div class="controls">
                      <input type="text" name="partnerid" value="{$appInfo['partnerid']}" class="span6  popovers">
                    </div>
                  </div>
                  <div class="control-group" id="msgtags">
                    <label class="control-label">App-key</label>
                    <div class="controls">
                      <input type="text" name="app_key" value="{$appInfo['app_key']}" class="span6  popovers">
                    </div>
                  </div>
                  <div class="control-group" id="msgdevice">
                    <label class="control-label">App-key秘钥</label>
                    <div class="controls">
                      <input type="text" name="master_secret" value="{$appInfo['master_secret']}" class="span6  popovers">
                    </div>
                  </div>
                  <div class="form-actions">
                    <input type="hidden" name="updateid" value="{$appInfo['id']}" />
                    <button class="btn btn-success" type="button" onclick="subform();">确认</button>
                    <button class="btn" type="button" onclick="subcancle()">取消</button>
                  </div>
                </form>
                <!-- END FORM-->
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
  <script>
    jQuery(document).ready(function() {
      // initiate layout and plugins
      App.init();
    });
    //提交
    function subform() {
	  var name = $("input[name='name']").val().trim();
      var partnerid = $("input[name='partnerid']").val().trim();
      var app_key = $("input[name='app_key']").val().trim();
      var master_secret = $("input[name='master_secret']").val().trim();
      var updateid = $("input[name='updateid']").val().trim();

      var data = {
		 'name': name,
        'partnerid': partnerid,
        'app_key': app_key,
        'master_secret': master_secret,
        'id': updateid
      };

      $.post('/app/app/create.html', data, function(m) {
        if (m.detail == 'ok') {
          alert("操作成功。");
          location.href = '/app/app/index.html';
        } else {
          alert("失败");
        }
      }, "json");
    }
    function subcancle(){
      location.href = '/app/app/index.html';
    }
  </script>
</body>
<!-- END BODY -->

</html>

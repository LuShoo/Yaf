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
                    <label class="control-label">合作商户ID</label>
                    <div class="controls">
                      <input type="text" name="partnerid" value="{$msginfo['partnerid']}" class="span6  popovers">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">发送范围标记</label>
                    <div class="controls">
                      <label class="radio">
                        <input type="radio" value="0" name="scope" {if $msginfo['send_scope']==0}checked="1" {/if} style="opacity: 0;">全部
                      </label>
                      <label class="radio">
                        <input type="radio" value="1" name="scope" {if $msginfo['send_scope']==1}checked="1" {/if} style="opacity: 0;">标签
                      </label>
                      <label class="radio">
                        <input type="radio" value="2" name="scope" {if $msginfo['send_scope']==2}checked="1" {/if} style="opacity: 0;">imei
                      </label>
                    </div>
                  </div>
                  <div class="control-group hidden" id="msgtags">
                    <label class="control-label">标签编号集合</label>
                    <div class="controls">
                      <input type="text" name="tags" value="{$msginfo['tags']}" class="span6  popovers">
                    </div>
                  </div>
                  <div class="control-group hidden" id="msgdevice">
                    <label class="control-label">设备列表</label>
                    <div class="controls">
                      <input type="text" name="imeis" value="{$msginfo['imeis']}" class="span6  popovers">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">消息类别</label>
                    <div class="controls">
                      <label class="radio">
                        <input type="radio" value="1001" name="msg_type" {if $msginfo['msg_type']==1001}checked="1" {/if} style="opacity: 0;" checked="checked">仅展示
                      </label>
                      <label class="radio">
                        <input type="radio" value="1002" name="msg_type" {if $msginfo['msg_type']==1002}checked="1" {/if} style="opacity: 0;">打开链接
                      </label>
                      <label class="radio">
                        <input type="radio" value="1003" name="msg_type" {if $msginfo['msg_type']==1003}checked="1" {/if} style="opacity: 0;">打开应用
                      </label>
                    </div>
                  </div>
                  <div class="control-group hidden" id="msg-url">
                    <label class="control-label">链接地址</label>
                    <div class="controls">
                      <input type="text" name="msg_url" value="{$msginfo['msg_url']}" class="span6  popovers">
                    </div>
                  </div>
                  <div class="control-group hidden" id="msg-app">
                    <label class="control-label">App名</label>
                    <div class="controls">
                      <input type="text" name="app" value="{$msginfo['msg_app']}" class="span6  popovers">
                    </div>
                  </div>
                  <div class="control-group hidden" id="msg-app-con">
                    <label class="control-label">页面类名</label>
                    <div class="controls">
                      <input type="text" name="page" value="{$msginfo['msg_page']}" class="span6  popovers">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">消息标题</label>
                    <div class="controls">
                      <input type="text" name="title" value="{$msginfo['msg_title']}" class="span6  popovers">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">消息图标URL地址</label>
                    <div class="controls">
                      <input type="text" name="image" value="{$msginfo['msg_image']}" class="span6  popovers">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">消息内容</label>
                    <div class="controls">
                      <input type="text" name="content" value="{$msginfo['msg_content']}" class="span6  popovers">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">是否置顶</label>
                    <div class="controls">
                      <label class="radio">
                        <input type="radio" value="1" name="top" {if $msginfo['is_top']==1 }checked="1" {/if} style="opacity: 0;">是
                      </label>
                      <label class="radio">
                        <input type="radio" value="0" name="top" {if $msginfo['is_top']==0 }checked="1" {/if} style="opacity: 0;">否
                      </label>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">有效期</label>
                    <div class="controls">
                      <input name="e_time" class="datepicker" style="width: 130px;" onClick="WdatePicker();" id="end" value="{$msginfo['expire_time']}" default_val="发送时间" style="color:#999999;" type="text">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">是否即时发送</label>
                    <div class="controls">
                      <label class="radio">
                        <input type="radio" value="0" name="immediate" {if $msginfo['is_immediate']==0 }checked="1" {/if} style="opacity: 0;">否
                      </label>
                      <label class="radio">
                        <input type="radio" value="1" name="immediate" {if $msginfo['is_immediate']==1 }checked="1" {/if} style="opacity: 0;">是
                      </label>
                    </div>
                  </div>
                  <div class="control-group" id="send-time">
                    <label class="control-label">发送时间</label>
                    <div class="controls">
                      <input name="release" class="datepicker" style="width: 130px;" onClick="WdatePicker();" id="begin" value="{$msginfo['release']}" default_val="发送时间" style="color:#999999;" type="text"> </div>
                  </div>
                  <div class="form-actions">
                    <input type="hidden" name="updateid" value="{$msginfo['id']}" />
                    <button class="btn btn-success" type="button" onclick="subform();">确认</button>
                    <button class="btn" type="button" onclick="cancle()">取消</button>
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
    //发送范围
    $("input[name='scope']").click(function(){
      if($(this).val() == 1){
        $('#msgtags').removeClass('hidden');
        $('#msgdevice').addClass('hidden');
      }else if($(this).val() == 2){
        $('#msgdevice').removeClass('hidden');
        $('#msgtags').addClass('hidden');
      }else{
        $('#msgtags').addClass('hidden');
        $('#msgdevice').addClass('hidden');
      }
    });
    //消息类别
    $("input[name='msg_type']").click(function(){
      if($(this).val() == 1002){
        $('#msg-url').removeClass('hidden');
        $('#msg-app').addClass('hidden');
        $('#msg-app-con').addClass('hidden');
      }else if($(this).val() == 1003){
        $('#msg-app').removeClass('hidden');
        $('#msg-app-con').removeClass('hidden');
        $('#msg-url').addClass('hidden');
      }else if($(this).val() == 1001){
        $('#msg-url').addClass('hidden');
        $('#msg-app').addClass('hidden');
        $('#msg-app-con').addClass('hidden');
      }
    });
    //即时发送
    $("input[name='immediate']").click(function(){
      if($(this).val() == 1){
        $("#send-time").addClass('hidden');
      }else{
        $("#send-time").removeClass('hidden');
      }
    });
    //提交
    function subform() {

      var partnerid = $("input[name='partnerid']").val().trim();
      var scope = $("input[name='scope']").val().trim();
      var tags = $("input[name='tags']").val().trim();
      var imeis = $("input[name='imeis']").val().trim();
      var msg_type = $("input[name='msg_type']:checked").val().trim();
      var image = $("input[name='image']").val().trim();
      var title = $("input[name='title']").val().trim();
      var content = $("input[name='content']").val().trim();
      var msg_url = $("input[name='msg_url']").val().trim();
      var msg_app = $("input[name='app']").val().trim();
      var msg_page = $("input[name='page']").val().trim();
      var is_top = $("input[name='top']:checked").val().trim();
      var e_time = $("input[name='e_time']").val().trim();
      var immediate = $("input[name='immediate']:checked").val().trim();
      var release = $("input[name='release']").val().trim();
      var updateid = $("input[name='updateid']").val().trim();

      var urltest = /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;

      if(partnerid == ""){
        alert('商户ID不能为空!');
        return false;
      }

      if(msg_type == 1002){
        if(!urltest.test(msg_url)){
          alert('url格式不正确!');
          return false;
        }
      }else if(msg_type == 1003){
        if(msg_app == '' || msg_page == ''){
          alert('aap名称不能为空!');
          return false;
        }
      }

      if(title.length < 6){
        alert('标题长度不得小于6个字符');
        return false;
      }

      if(content.length <10){
        alert('内容长度不得小于10个字符');
        return false;
      }

      if(immediate == 0){
        if(release == ''){
          alert("时间不能为空");
          return false;
        }
      }

      var data = {
        'partnerid': partnerid,
        'send_scope': scope,
        'tags': tags,
        'imeis': imeis,
        'msg_type': msg_type,
        'msg_title': title,
        'msg_image': image,
        'msg_content': content,
        'msg_url': msg_url,
        'msg_app': msg_app,
        'msg_page': msg_page,
        'is_top': is_top,
        'expire_time': e_time,
        'is_immediate': immediate,
        'release': release,
        'id': updateid
      };
      $.post('/message/message/create.html', data, function(m) {
        if (m.detail == 'ok') {
          alert("操作成功。");
          location.href = '/message/message/index.html';
        } else {
          alert("失败");
        }
      }, "json");
    }
    function cancle() {
      location.href = '/message/message/index.html';
    }
  </script>
</body>
<!-- END BODY -->

</html>

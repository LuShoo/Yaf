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
               <form action="/message/message/addMsg1.html" method="post" class="form-horizontal" enctype="multipart/form-data">
					<input  type="file" name="upload" />
					<input type="submit" name="sub" value="导入" />
                </form>
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
      if(msg_type == 1002){
        if(!urltest.test(msg_url)){
          alert('url is wrong');
          return false;
        }
      }else if(msg_type == 1003){
        if(msg_app == '' || msg_page == ''){
          alert('app so short');
          return false;
        }
      }

      if(title.length < 6){
        alert('title so short');
        return false;
      }

      if(content.length <10){
        alert('content is so short');
        return false;
      }

      if(immediate == 0){
        if(release == ''){
          alert("time is't null");
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

      /*
      if(updateid < 1)
      {
          if(password.length < 6)
          {
              alert("密码不少于六位字符");
              return false;
          }
          if(password != repeat)
          {
              alert("两次密码不一致");
              return false;
          }
          data.password = password;
      }
      else
      {
          data.id = updateid;
          if(password != '')
          {
              if(password.length < 6)
              {
                  alert("密码不少于六位字符");
                  return false;
              }
              if(password != repeat)
              {
                  alert("两次密码不一致");
                  return false;
              }
              data.password = password
          }
      }
      */
      $.post('/message/message/create.html', data, function(m) {
        if (m.detail == 'ok') {
          alert("操作成功。");
          location.href = '/message/message/index.html';
        } else {
          alert("失败");
        }
      }, "json");
    }
  </script>
</body>
<!-- END BODY -->

</html>

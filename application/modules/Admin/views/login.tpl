<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html
	lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8" />
<title>showboom - 销售管理平台</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<link href="/static/assets/bootstrap/css/bootstrap.min.css"
	rel="stylesheet" />
<link href="/static/assets/font-awesome/css/font-awesome.css"
	rel="stylesheet" />
<link href="/static/css/style.css" rel="stylesheet" />
<link href="/static/css/style_responsive.css" rel="stylesheet" />
<link href="/static/css/style_default.css" rel="stylesheet"
	id="style_color" />
<!-- Generated by Revive Adserver v3.2.2-dev -->
<script type='text/javascript'
	src='http://www.adserver.com/www/delivery/spcjs.php?id=1'></script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body id="login-body">
	<div class="login-header">
		<!-- BEGIN LOGO -->
		<div id="logo" class="center">
			<img src="/static/img/logo.png" alt="logo" class="center" />
		</div>
		<!-- END LOGO -->
	</div>
	<!-- BEGIN LOGIN -->
	<div id="login">
		<!-- BEGIN LOGIN FORM -->
		<form id="loginform" class="form-vertical no-padding no-margin">

			<div class="control-wrap">
				<h4>用户登录</h4>

				<div class="alert alert-info">
					{if $mode == 1} <span style="color: red">操作超时，请重新登陆</span> {else} <span>请输入用户名和密码登陆系统</span>
					{/if}
				</div>
				<div class="control-group">
					<div class="controls">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-user"></i> </span><input
								id="username" type="text" name="username" placeholder="请输入用户名" />
						</div>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-key"></i> </span><input
								id="password" type="password" name="password"
								placeholder="请输入密码" />
						</div>
						<div class="mtop10">
							<div class="block-hint pull-left small">
								<input type="checkbox" id="remember"> 记住我的登陆状态
							</div>
							<div class="block-hint pull-right">
								<a href="javascript:;" class="" id="forget-password">忘记密码?</a>
							</div>
						</div>
						<div class="clearfix space5"></div>
					</div>
				</div>
			</div>
			<input type="button" id="login-btn" class="btn btn-block login-btn"
				value="登陆" />
		</form>
					<div class="lock">
	<script type='text/javascript'><!--// <![CDATA[
    /* [id2] bj - octopus */
// ]]> --></script><noscript><a target='_blank' href='http://www.adserver.com/www/delivery/ck.php?n=c9ff4b6'><img border='0' alt='' src='http://www.adserver.com/www/delivery/avw.php?zoneid=2&amp;n=c9ff4b6' /></a></noscript>
			</div>
		<!-- END LOGIN FORM -->
		<!-- BEGIN FORGOT PASSWORD FORM -->
		<form id="forgotform" class="form-vertical no-padding no-margin hide"
			action="index.html">
			<p class="center">输入你的email,重置密码!</p>
			<div class="control-group">
				<div class="controls">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-envelope"></i> </span><input
							id="input-email" type="text" placeholder="Email" />
					</div>
				</div>
				<div class="space20"></div>
			</div>
			<input type="button" id="forget-btn" class="btn btn-block login-btn"
				value="确定" />
		</form>
		<!-- END FORGOT PASSWORD FORM -->
	</div>
	<!-- END LOGIN -->
	<!-- BEGIN COPYRIGHT -->
	<div id="login-copyright">
		<p class="pull-left">
			©<a href="javascript:void(0);"> 黑米科技 </a>2013
		</p>
		<p class="pull-right">
			Powered by <a href="http://x.747.cn">747技术团队</a>
		</p>
	</div>
	<!-- END COPYRIGHT -->
	<!-- BEGIN JAVASCRIPTS -->
	<script src="/static/js/jquery-1.8.3.min.js"></script>
	<script src="/static/assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="/static/js/jquery.validate.js"></script>
	<script src="/static/js/validate_expand.js"></script>
	<script src="/static/js/validate.js"></script>
	<script src="/static/js/jquery.blockui.js"></script>
	<script src="/static/js/scripts.js"></script>
	<script type="text/javascript">
		$('#password').keyup(function(event) {
			var e = event || window.event || arguments.callee.caller.arguments[0];
			if(e && e.keyCode==13){ // enter 键
				$('#login-btn').trigger('click');
			}
		});

	$('#login-btn').click(function() {
		var rememberStatus = document.getElementById("remember").checked ? 1 : 0;
		var params = {
			"username":$('input[name="username"]').val(),
			"password":$('input[name="password"]').val(),
			"record":rememberStatus
		};
		$.post('/admin/auth/login.html', params, function(data) {
			if (data.code == 0) {
				location.href='/admin/home/index.html';
			} else {
				var messageHtml = '<span style="color:red">';
				messageHtml += data.message+'</span>';
				$('.alert-info').html(messageHtml);
			}
		}, 'json');
	});
    jQuery(document).ready(function() {       
        // initiate layout and plugins
        App.initLogin();
       // initValidator();
     });
</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>

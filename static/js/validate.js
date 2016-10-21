/**
 * @author Administrator
 */
function initValidator(base){
	
	$("#loginform").validate({
		onkeyup:false,
		//设置验证规则   
		rules: {
			"userName": {
				required: true,
				userNameCheck: true
			},
			"passWord": {
				required: true,
				rangelength: [6, 12]
			}
		},
		//设置错误信息  
		messages: {
			"userName": {
				required: "请输入用户名",
				userNameCheck: "请输入4-20位字母开头的字母或数字和下划线"
			},
			"passWord": {
				required: "请输入密码",
				rangelength: "密码长度为6-12位"
			}
		},
		errorElement:"font",
		errorPlacement: function(error, element){
			error.appendTo($(".alert-info"));
		},success:"valid"
	});
	$("#forgotform").validate({
		onkeyup:false,
		//设置验证规则   
		rules: {
			"email": {
				required: true,
				isEmail: true
			}
		},
		//设置错误信息  
		messages: {
			"email": {
				required: "请输入邮箱",
				isEmail: "请正确填写邮箱格式"
			}
		},
		errorElement:"font",
		errorPlacement: function(error, element){
			error.appendTo($(".alert-info"));
		},success:"valid"
	});
}

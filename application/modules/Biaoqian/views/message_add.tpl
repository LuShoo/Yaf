<!DOCTYPE html> <!--[if IE 8]> <html lang="en" class="ie8"> <![endif]--> <!--[if IE 9]> <html lang="en" class="ie9"> <![endif]--> <!--[if !IE]><!--> <html lang="en"> <!--<![endif]--> <!-- BEGIN HEAD --> <head>
    <meta charset="utf-8"/>
    <title>showboom - 销售管理平台</title>
	<script src="/static/js/jquery-1.8.3.min.js"></script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
   
    <form method="post" action="/message/message/create.html" class="form-horizontal" id="form3">
		<input type="text" name="name" />
		<input type="submit" name="sub" value="提交" />
		<div >
			 <a href="javascript:;" onclick="subf();">确定</a> 
		</div>
	</form>
    <script type="text/javascript">
        function subf(){
			var f=document.getElementById("form3");
		
		var name = $("input[name='name']").val().trim();
		  var data = {'name':name};
		//alert(name);
		
		$.post('/message/message/create.html',$(f).serialize(),function(m){
               alert(m.detail);
            },"json");
	}
       
    </script>
</body>
<!-- END BODY -->
</html>
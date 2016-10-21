<!DOCTYPE html> <!--[if IE 8]> <html lang="en" class="ie8"> <![endif]--> <!--[if IE 9]> <html lang="en" class="ie9"> <![endif]--> <!--[if !IE]><!--> <html lang="en"> <!--<![endif]--> <!-- BEGIN HEAD --> <head>
<meta charset="utf-8" />
<title>广告列表</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
{include ../../Admin/views/top.tpl}
</head>
<body class="fixed-top">
	{include ../../Admin/views/header.tpl}
	<div id="container" class="row-fluid">
		{include ../../Admin/views/menu.tpl}
		<div id="main-content">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<div id="theme-change" class="hidden-phone">
							<i class="icon-cogs"></i> <span class="settings"> <span
								class="text">Theme:</span> <span class="colors"> <span
									class="color-default" data-style="default"></span> <span
									class="color-gray" data-style="gray"></span> <span
									class="color-purple" data-style="purple"></span> <span
									class="color-navy-blue" data-style="navy-blue"></span> </span>
							</span>
						</div>
					
						<!--
						<h3 class="page-title" style='line-height: 50px; font-size: 25px;'>
							<i class="icon-th-list"></i> 广告管理
						</h3>
						<ul style="float: left;" class="breadcrumb">
							<li style="margin-bottom: 0px;"><a href="/admin/home/index.html"><i
									class="icon-home"></i> </a><span class="divider">&nbsp;</span>
							</li>
							<li style="margin-bottom: 0px;"><a>添加广告/a><span
									class="divider-last">&nbsp;</span>
							
							</li>
						</ul>
						-->
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="widget">
							<div class="widget-title">
								<h4>
									<i class="icon-reorder"></i>添加广告
								</h4>
							</div>
							<div class="widget-body form">
								<form class="form-horizontal" id="objectForm"
									action="/ad/object/add.html" method="post">
								
									<div class="control-group">
										<label class="control-label" for="name">广告名称</label>
										<div class="controls">
											<input class="input-xlarge focused" value="" name="name"
												type="text" vid="name"> <span class="help-inline"></span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="desc">广告内容</label>
										<div class="controls">
											<textarea class="input-xlarge focused"
												style="width: 270px; height: 100px;" name="content" vid="content"></textarea>
											<span class="help-inline"></span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="star">广告星级</label>
										<div class="controls">
										<select id="star" name="star" class="input-large m-wrap" tabindex="1">
											<option value="1">☆</option>
											<option value="2">☆☆</option>
											<option value="3">☆☆☆</option>
											<option value="4">☆☆☆☆</option>
											<option value="5" selected>☆☆☆☆☆</option>
										</select>
											 <span class="help-inline"></span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="is_free">是否免费</label>
										<div class="controls">
											<select style="width: 130px; margin-top: 8px;" name="is_free"
												vid="is_free">
												<option value="1">免费</option>
												<option value="2">收费</option>
											</select> <span class="help-inline"></span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="app">开始时间</label>
										<div class="controls">
											<input class="datepicker" style="width: 130px;"
												onClick="WdatePicker();" id="start_at" value="开始时间"  name="start_at"
												default_val="开始时间" style="color:#999999;" type="text"> <span
												class="help-inline"></span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="app">结束时间</label>
										<div class="controls">
											<input class="datepicker" style="width: 130px;"
												onClick="WdatePicker();" id="end_at" value="结束时间" name="end_at"
												default_val="结束时间" style="color:#999999;" type="text"> <span
												class="help-inline"></span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="mac">mac地址</label>
										<div class="controls">
											<input class="input-xlarge focused" value="-mac-" name="mac"
												id="mac" type="text" vid="mac"> <span class="help-inline"></span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="idfa">idfa</label>
										<div class="controls">
											<input class="input-xlarge focused" value="-idfa-"
												name="idfa" id="idfa" type="text" vid="idfa"> <span
												class="help-inline"></span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="idfv">idfv</label>
										<div class="controls">
											<input class="input-xlarge focused" value="-idfv-"
												name="idfv" id="idfv" type="text" vid="idfv"> <span
												class="help-inline"></span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="imei">imei</label>
										<div class="controls">
											<input class="input-xlarge focused" value="-imei-"
												name="imei" id="imei" type="text" vid="imei"> <span
												class="help-inline"></span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="phone">号码</label>
										<div class="controls">
											<input class="input-xlarge focused" value="-phone-"
												name="phone" id="phone" type="text" vid="phone"> <span
												class="help-inline"></span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="sort">广告顺序</label>
										<div class="controls">
											<input class="input-xlarge focused" value="1" name="sort"
												type="text" vid="sort"> <span class="help-inline"></span>
										</div>
									</div>
										<div class="control-group">
										<label class="control-label" for="desc">备注</label>
										<div class="controls">
											<textarea class="input-xlarge focused"
												style="width: 270px; height: 100px;" name="mark" vid="mark"></textarea>
											<span class="help-inline"></span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">状态</label>
										<div class="controls">
											<select name="status" id="status">
												<option value="1">正常</option>
												<option value="2">暂停</option>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="url">跳转地址</label>
										<div class="controls">
											<input class="input-xlarge focused" value="" name="url"
												type="text" vid="url"> <span class="help-inline"></span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="turn_url">请求接口</label>
										<div class="controls">
											<input class="input-xlarge focused" name="req_url"
												type="text" vid="req_url"
												value="http://mobapi.showboom.cn/adapi/click/index"> <span
												class="help-inline"></span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="status">标签名称</label>
										<div class="controls">
										<table>
											{loop $taglist $key $row}
											<tr>
											 <td><input type="checkbox" name="tag_{$row['id']}"  id="tag_id"  value="{$row['id']}"> </td>
											 <td>{$row['tag_code']}</td>
											  <td>{$row['tag_name']}</td>
											</tr>
											{/loop}
										
										</table>
										 <span class="help-inline"></span>
										</div>
									</div>
									<input type="hidden" name="imageurl" id="imageurl" value="" />
								</form>
								<form id="img-form" target="upload_iframe" method="post"
									enctype="multipart/form-data" class="form-horizontal"
									action="/ad/tag/uploadImage.html">
									<fieldset>
										<input type="hidden" name="image" value="2">
										<div class="control-group">
											<label for="fileInput" class="control-label">产品图片</label>
											<div class="controls">
												<div class="uploader" id="uniform-fileInput">
													<input name="img" type="file" id="file_input"
														class="input-file uniform_on" size="19"
														style="opacity: 0;" accept="image/*"> <span id="filename"
														class="filename">请选择图片</span> <span class="action"
														style="-moz-user-select: none;">产品图片</span>
												</div>
												<span id="img_msg"></span>
											</div>
										</div>
										<div class="control-group">
											<label for="fileInput" class="control-label"></label>
											<div class="controls">
												<div
													style="width: 200px; padding: 2px; border: 1px solid #ddd;">
													<img id="id_img"
														src="<!--{STATIC_SERVER}-->/img/default.png"
														style="width: 200px; height: 120px; display: block;" />
												</div>
												<span id="img_msg"></span>
											</div>
										</div>
										<iframe style="display: none" name="upload_iframe"></iframe>
										<div class="form-actions">
											<button type="button" class="btn btn-primary" id="add-submit">新增</button>
											<button type="button" class="btn"
												onclick="javascript:window.location.href='/ad/object/index.html';return false;">取消</button>
										</div>
									</fieldset>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	{include ../../Admin/views/footer.tpl}
	<script language="javascript" type="text/javascript"
		src="/static/js/jquery.validate.js"></script>
	<script language="javascript" type="text/javascript"
		src="/static/js/validate_expand.js"></script>
	<script language="javascript" type="text/javascript"
		src="/static/js/validate.js"></script>
	<script>
            jQuery(document).ready(function () {
                App.init();
               // initFormValidator();
            });
            $(function() {
            	  $("#add-submit").click(function(){
                      $("#objectForm").submit();
                  });
            	$('#file_input').change(function () {
    				$('#img-form').submit();
    			});
            });
        	function refreshImage(status,id,name,url) {
    			if (status) {
    				$('#'+id+'').attr('src', url);
    				$('input[name="'+name+'"]').val(url);
    			}
    		}
        </script>
</body>
<!-- END BODY -->
</html>

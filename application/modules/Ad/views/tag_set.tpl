<!DOCTYPE html> <!--[if IE 8]> <html lang="en" class="ie8"> <![endif]--> <!--[if IE 9]> <html lang="en" class="ie9"> <![endif]--> <!--[if !IE]><!--> <html lang="en"> <!--<![endif]--> <!-- BEGIN HEAD --> <head>
        <meta charset="utf-8"/>
        <title>设备列表</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>
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
                            {include ../../Admin/views/breadcrumb.tpl}
                            <!--
                            <h3 class="page-title" style='line-height: 50px;font-size: 25px;'>
                                <i class="icon-th-list"></i> tag管理
                            </h3>
                            <ul style="float: left;" class="breadcrumb">
                                <li style="margin-bottom: 0px;"><a href="/admin/home/index.html"><i class="icon-home"></i></a><span class="divider">&nbsp;</span></li>
                                <li style="margin-bottom: 0px;"><a>修改tag</a><span class="divider-last">&nbsp;</span></li>
                            </ul>
                            -->
                        </div>
                    </div>     
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="widget">
                                <div class="widget-title">
                                    <h4><i class="icon-reorder"></i>修改tag</h4>
                                </div>
                                <div class="widget-body form">
                                    <form class="form-horizontal" id="tagForm" action="/ad/tag/set.html" method="post">
                                    	 <input type="hidden" name="id" id="id" value={$list['id']}>
                                           <div class="control-group">
	                                        <label class="control-label">应用id</label>
	                                        <div class="controls">
	                                           <select  name="app_id" id="app_id">
												{loop $applist $key $row}
													<option {if $list['app_id']==$row['id']} selected {/if}  value="{$row['id']}" >{$row['app_name']}</option>
												{/loop}
												</select>
	                                         </div>
	                                    </div>
                                         <div class="control-group">
                                            <label class="control-label">tag标识</label>
                                            <div class="controls">
                                                 <input type="text" id="tag_code" name="tag_code"  value={$list['tag_code']}>
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div>
                                         <div class="control-group">
                                            <label class="control-label">tag名称</label>
                                            <div class="controls">
                                                 <input type="text" id="tag_name" name="tag_name"  value={$list['tag_name']}>
                                                 <span class="help-inline"></span>
                                            </div>
                                        </div>
                                        
                                       <div class="control-group">
	                                        <label class="control-label">状态</label>
	                                        <div class="controls">
	                                           <select  name="status" id="status">
												<option {if $list['status']==1} selected {/if} value="1">正常</option>
												<option {if $list['status']==2} selected {/if} value="2">暂停</option>
												<option {if $list['status']==10} selected {/if} value="10">删除</option>
												</select>
	                                         </div>
	                                    </div>
                                        <input type="hidden" name="imageurl"  id="imageurl" value="{$list['tag_pic']}" />
                                    </form>
                                    <form id="img-form" target="upload_iframe" method="post"
								enctype="multipart/form-data" class="form-horizontal"
								action="/ad/tag/uploadImage.html">
								<fieldset>
								<input type="hidden" name="image" value="2" >
									<div class="control-group">
										<label for="fileInput" class="control-label">产品图片</label>
										<div class="controls">
											<div class="uploader" id="uniform-fileInput">
												<input name="img" type="file" id="file_input"
													class="input-file uniform_on" size="19" style="opacity: 0;" accept="image/*">
												<span id="filename" class="filename">请选择图片</span> <span
													class="action" style="-moz-user-select: none;">产品图片</span>
											</div>
											<span id="img_msg"></span>
										</div>
									</div>
									<div class="control-group">
										<label for="fileInput" class="control-label"></label>
										<div class="controls">
											<div
												style="width: 200px; padding: 2px; border: 1px solid #ddd;">
												<img id="id_img"   {if empty($list['tag_pic'])} src="<!--{STATIC_SERVER}-->/img/default.png" {else} src="{$list['tag_pic']}" {/if}
												style="width: 200px; height: 120px; display: block;" />
											</div>
											<span id="img_msg"></span>
										</div>
									</div>
									<iframe style="display: none" name="upload_iframe"></iframe>
									<div class="form-actions">
										<button type="button" class="btn btn-primary" id="add-submit">修改</button>
										<button type="button" class="btn"
											onclick="javascript:window.location.href='/ad/tag/index.html';return false;">取消</button>
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
        <script language="javascript" type="text/javascript" src="/static/js/jquery.validate.js"></script>
		<script language="javascript" type="text/javascript" src="/static/js/validate_expand.js"></script>
		<script language="javascript" type="text/javascript" src="/static/js/validate.js"></script>
        <script>
            jQuery(document).ready(function () {
                App.init();
               // initFormValidator();
            });
            $(function() {
            	  $("#add-submit").click(function(){
                      $("#tagForm").submit();
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
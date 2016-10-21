(function($) {
    $.delDiv = function(options) {
    	//追加弹框
    	var _body = $('body');
    	
    	var _cardTypeDiv = '';
    	_cardTypeDiv += '<div id="del_dialog" class="modal-backdrop fade in dialog-upload-card" style="display:none;"></div>';
    	_cardTypeDiv += '<div style="display: hidden;" class="modal hide fade in" id="del_div">';
    	_cardTypeDiv += '<div class="modal-header">';
    	_cardTypeDiv += '<button id="del_btn" type="button" class="close btn-del-cancel" data-dismiss="modal">×</button>';
    	_cardTypeDiv += '<h3 id="del_title"></h3>';
    	_cardTypeDiv += '</div>';
    	_cardTypeDiv += '<div class="modal-body">';
    	_cardTypeDiv += '<p>';
    	_cardTypeDiv += '<span style="float:left" class="icon32 icon-red icon-alert"></span>';
    	_cardTypeDiv += '<span id="del_content" style="line-height:32px;display:block;float:left;font-size:14px;padding-left:10px;"></span>';
    	_cardTypeDiv += '</p>';
    	_cardTypeDiv += '</div>';
    	_cardTypeDiv += '<div class="modal-footer">';
    	_cardTypeDiv += '<a href="javascript:void(0);" class="btn btn-del-cancel" id="del_cancel">取消</a>';
    	_cardTypeDiv += '<a href="javascript:void(0);" class="btn btn-primary btn-del-access" id="del_ok">确定</a>';
    	_cardTypeDiv += '</div>';
    	_cardTypeDiv += '</div>';
    	
    	_body.append(_cardTypeDiv);
    	
    	//默认参数 
		var _default = {
			title: '删除操作',
			content: '你确定要执行此删除操作吗？',
			async: true,
			type: 'post'
		};
		
		var _options = $.extend(_default, options);
		
    	var _delDiv = $('#del_div');			//div
    	var _delOk = $('#del_ok');				//删除ok
    	var _delCancel = $('#del_cancel');		//删除取消
    	var _delBtn = $('#del_btn');			//删除取消
		var _delTitle = $('#del_title');		//删除title	
		var _delContent = $('#del_content');	//删除content
		var _delStatus = true;					//提交状态 
		var _dialog = $('#del_dialog');				
		
		_delTitle.text(_options.title);		
		_delContent.text(_options.content);	
    	_delDiv.show();					    	//显示div
    	_dialog.show();
    	
    	_delCancel.click(function(){
    		_delStatus = true;				
    		_dialog.remove();
    		_delDiv.remove();
	    });
    	_delBtn.click(function(){				//×隐藏div
    		_delStatus = true;				
    		_dialog.remove();
    		_delDiv.remove();
	    });
	    
    	_delOk.click(function(){
	    	if (_delStatus) {
		    	_delStatus = false;			//提交状态  
				$.ajax({
					'type': _options.type,
					'url': _options.url,
					'data': _options.data,
					'async': _options.async,
					'success': function(response){
						_delStatus = true;
			    		_dialog.remove();
			    		_delDiv.remove();
						if (response.code == 200) {
							window.location.href = _options.returnUrl;
						} else {
							_delStatus = true;
				    		_dialog.remove();
				    		_delDiv.remove();
							alert('更新失败.');
						}
					},
					'error': function(){
						_delStatus = true;
			    		_dialog.remove();
			    		_delDiv.remove();
						alert('网络异常.');
					}
				});
		    }
		});
    };
})(jQuery);
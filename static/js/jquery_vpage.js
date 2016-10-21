/**
 * AJAX 和列表，分页渲染（基于Bootstrap）
 * 
 * 使用方法:
 * 
 *     $.vpage({
 *         'uri':string,	         //要请求的后台地址,后台要求返回一个JSON
 *         'size'：integer,          //可选，每页大小,默认获取page_rows的值
 *         'query':string,           //可选，附带的查询值，默认为空
 *         'left':integer,           //可选，左边显示页数，默认3
 *         'right':integer           //可选，右边显示页数，默认4
 *         'show':string             //显示位置
 *         'showpage':string         //分页显示位置
 *     });
 */
$.extend({
	vpage:function(option) {
		var uri = option.uri;
		this.page = 1;
		var size = (option.size == undefined) ? 10 : option.size;
		var query = (option.query == undefined) ? '' : '&'+option.query;
		var leftPageSize = option.left == undefined ? 3 : option.left;
		var rightPageSize = option.right == undefined ? 4 : option.right;
		var showData = (option.show == undefined) ? '#list-data' : option.show;
        var showTotal = (option.show == undefined) ? '' : option.showtotal;
        var showPage = (option.showpage == undefined) ? '#vpage' : option.showpage;
		vpageRun = function(page, size) {
			$(showData).html('');
			$(showPage).html('');
			$('.list-loading').show();
			var url = uri+'?page='+page+'&size='+size+query;
             $.ajax({
                url : url,
                dataType:'json',
                async:false,//这里选择异步为false，那么这个程序执行到这里的时候会暂停，等待
                            //数据加载完成后才继续执行
                success : function(response){
                    $('.list-loading').hide();
                    $(showData).html(response.html);
                    if(!response.total) response.total = 1;
                    vpageRender(page, size, response.total, showPage);
                }
            });
		};
		
		vpageRender = function(page, size, total, showPage) {
			$.vpage.page = page;
            $.vpage.showPage = showPage;
			$('#vpage-total' + showTotal).text(total);
			this.maxPage = Math.ceil(total / size);
			this.maxPage = this.maxPage == 0 ? 1 : this.maxPage;
			$('#vpage-max-page' + showTotal).text(this.maxPage);
		
			var page_link_html = '';
			if (this.maxPage > 1) {
				if (page > 1) {
					page_link_html += '<li class="prev"><a href="javascript:vpageRun('+(page-1)+', '+size+');">← 上一页</a></li>';
				} else {
					page_link_html += '<li class="prev disabled"><a href="javascript:void(0);">← 上一页</a></li>';
				}
			}
			var startPage = parseInt(page) - parseInt(leftPageSize);
			var endPage = parseInt(page) + parseInt(rightPageSize);
			startPage = (startPage < 1) ? 1 : startPage;
			endPage = (endPage > this.maxPage) ? this.maxPage : endPage;
			for (i=startPage;i<=endPage;i++) {
				if (i == page)
					page_link_html += '<li class="active" style="display:inline;line-height:18px;"><a href="javascript:void(0)">'+i+'</a></li>';
				else
					page_link_html += '<li style="display:inline;line-height:18px;"><a href="javascript:vpageRun('+i+', '+size+');">'+i+'</a></li>';
			}
			if (this.maxPage > 1) {
				if (page < this.maxPage) {
					page_link_html += '<li class="next"><a href="javascript:vpageRun('+(parseInt(page)+1)+', '+size+');">下一页 → </a></li>';
				} else {
					page_link_html += '<li class="next disabled"><a href="javascript:void(0);">下一页 → </a></li>';
				}
			}
			var page_html = '<ul><span id="vpage_link">';
			page_html += page_link_html;
			page_html += '</span><span><li style="margin-left:5px;display:inline;line-height:18px;padding:0px;">';
			page_html += '<input type="text" style="color:#999999;padding:padding:0px;margin:0px;width:41px;height:25px;" value="跳转" id="vpage_input">';
			page_html += '</li></span>';
			$(showPage).html(page_html);
		};
		
		$('#vpage_input').die().live('keydown', function(e){
			if(e.keyCode==13){
				var queryPage = $(this).val();
				var reg = /^[1-9][0-9]*$/;
				if ((queryPage != undefined) && reg.test(queryPage)) {
					if (queryPage > window.maxPage) {
						alert('没有这一页');
						return false;
					}
				} else {
					alert('页数不合法');
					return false;
				}
			    vpageRun(queryPage, size);
			}
		}).live('focus', function() {
			$(this).val('');
		}).live('blur', function() {
			$(this).val('跳转');
		}); 
		
		$('#page_rows').unbind('change').change(function() {
			size = $(this).val();
			vpageRun(1, size);
		});
		
		vpageRun(this.page, size);
	}
});
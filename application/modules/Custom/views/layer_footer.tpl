<!--
<div id="footer">
    <p class="pull-right">Powered by <a href="http://x.747.cn">747技术团队</a></p>
    <p class="pull-right">©<a href="javascript:void(0);"> 黑米科技 </a>2013</p>
</div>
<hr style="clear: both">
-->
<!-- END FOOTER -->

<!-- ie8 fixes -->
<!--[if lt IE 9]>
<script src="js/excanvas.js"></script>
<script src="js/respond.js"></script>
<![endif]-->
<script type="text/javascript" src="/static/assets/uniform/jquery.uniform.min.js"></script>
<script type="text/javascript" src="/static/assets/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="/static/assets/data-tables/DT_bootstrap.js"></script>
<script type="text/javascript" src="/static/assets/highcharts/highcharts.js"></script>
<script type="text/javascript" src="/static/assets/highcharts/modules/exporting.js"></script>
 <script src="/static/assets/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="/static/js/scripts.js"></script>
<script src="/static/js/ui-jqueryui.js"></script>
<script type="text/javascript" src="/static/js/html5media.min.js"></script>
<script type="text/javascript" src="/static/js/date/WdatePicker.js"></script>
<script type="text/javascript" src="/static/js/jquery_vpage.js?v={STATIC_VERSION}"></script>
<script type="text/javascript" src="/static/js/jquery_vset.js?v={STATIC_VERSION}"></script>
 <script type="text/javascript" src="/static/assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var getConds = function() {
            var _telephone  = ($("#telephone").val() == '') ? '' : $("#telephone").val();
            var _uname      = ($("#uname").val() == '') ? '' : $("#uname").val();
            var _sn         = ($("#sn").val() == '') ? '' : $("#sn").val();
            var _imei       = ($("#imei").val() == '') ? '' : $("#imei").val();
            var _simtelephone = ($("#simtelephone").val() == '') ? '' : $("#simtelephone").val();
            var _ccid       = ($("#ccid").val() == '') ? '' : $("#ccid").val();
            return 'telephone=' + _telephone + "&uname=" + _uname + "&sn=" + _sn + "&imei=" + _imei + "&simtelephone=" + _simtelephone + "&ccid=" + _ccid;
        };
        // 搜索用户信息
        $("#search_user").click(function() {
            var conds = getConds();
            window.location.href = "/custom/info/index.html?" + conds;
        });
        // 搜索订单信息
        $("#search_order").click(function() {
            var url=window.location.href;
            var index=url.indexOf('flow');
            if(index>0){
					return;
                }
            var conds = getConds();
            window.location.href = "/order/manage/index.html?" + conds;
        });
    });
</script>

<script type="text/javascript">
    $(function () {
        //回到顶部 
        var upObj = $('#goTopBtn');
        _window = $(window);
        _window.scroll(function () {
            var upHeight = _window.scrollTop();
            upHeight > 5 ? upObj.show() : upObj.hide();
        });
        upObj.click(function () {
            var upObjScroll = setInterval(function () {
                _window.scrollTop(_window.scrollTop() / 1.1);
                if (_window.scrollTop() < 5)
                    clearInterval(upObjScroll);
            }, 10);
        });
        //匹配菜单
//        var url = window.location.pathname;
//        var array = url.split('/');
//        var path="/"+array[1]+"/"+array[2]+"/";
//        var obj=$(".sidebar-menu a[href^='"+path+"']");
//        var menuObj=obj.parent().parent();
//        obj.css("background-color","#008888");
//	   	 $(".sidebar-menu li").each(function(){
//			  $(this).removeClass("open");
//		});
//		 $(".has-sub ul").each(function(){
//			 $(this).attr('style','display: none');
//		});
//      	//添加open
//		menuObj.parent().addClass('open');
//		menuObj.attr('style','display: block');
//		menuObj.prev().children('span[class="arrow"]').addClass('open');
    });

    
</script>
